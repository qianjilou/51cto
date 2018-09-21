<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		.page{width: 500px;height: 30px;}
		.page li{list-style:none;float: left;margin:0 4px;}
	</style>
</head>
<body>
	
</body>
</html>

<?php
	class Page{
		private $total;//总页数
		private $page_size;//每页记录数
		private $page_nums; //总的页数
		private $cur_page; //当前页
		private $url; //分页的页面
		private $page_step = 8;
		private $page_offset = 5;


		public function __construct( $total, $page_size){
			$this->total = $total ? $total : 0;
			$this->page_size = $page_size ? $page_size : 5;
			$this->page_nums = ceil( $this->total / $this->page_size );

			$this->set_cur_page();

			$this->set_cur_url();
			$this->build_page_list();


		}

		public function set_cur_page(){
			$p = !empty( $_REQUEST['p']) ? intval( $_REQUEST['p'] ) : 1;
			if ( !empty( $p ) ) {
				if ( $p > 0 ) {
					if ($p > $this->page_nums ) {
						$this->cur_page = $this->page_nums;
					}else{
						$this->cur_page = $p;
					}
				}else{
					$this->cur_page = 1;
				}
			}else{
				$this->cur_page = 1;
			}
		}

		public function set_cur_url() {
			
			$page_url = $_SERVER['REQUEST_URI'];
			$url_parts = parse_url( $page_url );
			$new_url = '';

			if ( isset( $url_parts['query'] )) {
				$args = array();
				parse_str( $url_parts['query'], $args );
				if ( isset( $args['p']) ) {
					unset( $args['p']);
				}
				$new_url = $url_parts['path'] . '?' . http_build_query( $args ) . '&';
			}else{
				$new_url = $url_parts['path'] . '?' ;
			}
			$this->url = $new_url;

		}

		//显示 生成分页页码
		public function build_page_list(){
			echo "<a>总共有{$this->total}记录{$this->page_nums}页数</a>";
			echo "<a>总共有".$this->total."记录".$this->page_nums."页数</a>";
			echo $this->first_page();
			echo $this->prev();

			$start = '';
			$end = '';
			if ($this->cur_page < $this->page_step - 1) {
				$start = 1;
				$end = $this->page_step;
				if ($end > $this->page_nums) {
					$end = $this->page_nums;
				}else{
					$start = $this->cur_page - $this->page_offset;
					$end = $this->cur_page + $this->page_step - $this->page_offset -1;
					if ($end > $this->page_nums) {
						$end = $this->page_nums;
					}
				}
			}

		for ($ind=$start; $ind < $end; $ind++) { 
			echo "<a href='". $this->url ."p=".$ind."'>" . $ind . "</a>";
		}

			// echo "<ul class = 'page'>";
			// for ($ind = 1; $ind <= $this->page_nums; $ind++) { 
			// 	echo "<li><a href='". $this->url ."p=". $ind ."'>" . $ind . "</a></li>";

			// }
			// echo "</ul>";
			echo $this->next();
			echo $this->last_page();
		}

		public function first_page(){
			return "<a href='". $this->url ."p=1'>" . "首页" . "</a>";
		}
		
		public function last_page(){
			return "<a href='". $this->url ."p=" . $this->page_nums . "'>" . "尾页" . "</a>";
			// return "<a href='". $this->url ."p={$this->page_nums}'>" . "尾页" . "</a>";
		}

		public function prev(){
			if ($this->cur_page > 1) {
				return "<a href='". $this->url ."p=".($this->cur_page - 1)."'>" . "上一页" . "</a>";
			}else{
				return "<a>上一页</a>";
			}
		}

		public function next(){
			if ($this->cur_page < $this->page_nums) {
				return "<a href='". $this->url ."p=".($this->cur_page + 1)."'>" . "下一页" . "</a>";
			}else{
				return "<a>下一页</a>";
			}
		}
	}

	$page = new Page(100,6);
	// print_r($page);
