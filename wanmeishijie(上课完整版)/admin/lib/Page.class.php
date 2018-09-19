<?php
	class Page {

		private $total; //总记录
		private $page_size; //每页显示的条数
		private $cur_page; //当前页码
		private $page_nums; //总的页码数
		private $url; //当前分页的连接
		private $page_step = 8;
		private $page_offset = 5;

		public function __construct ( $total, $page_size ) {
			$this->total = $total ? $total : 0;
			$this->page_size = $page_size ? $page_size : 5;
			$this->page_nums = ceil( $this->total / $this->page_size );	

			$this->set_cur_page();
			$this->set_cur_url();
		}

		//处理当前页码
		public function set_cur_page () {
			$p = !empty( $_REQUEST['p'] ) ? intval( $_REQUEST['p'] ) : 1;
			if ( !empty( $p ) ) {
				if ( $p > 0 ) {
					if ( $p > $this->page_nums ) {
						$this->cur_page = $this->page_nums;
					} else {
						$this->cur_page = $p;
					}
				} else {
					$this->cur_page = 1;
				}
			} else {
				$this->cur_page = 1;
			}
		}

		public function set_cur_url () {
			$args = array();
			$new_url = '';
			$cur_url = $_SERVER['REQUEST_URI'];
			
			$parse_url = parse_url( $cur_url );

			if ( isset( $parse_url['query'] ) ) {
				parse_str( $parse_url['query'], $args );
				if ( isset( $args['p'] ) ) {
					unset( $args['p'] );
				}

				if ( !count( $args ) ) {
					$new_url = $parse_url['path'] . '?';
				} else {
					$new_url = $parse_url['path'] . '?' . http_build_query( $args ) . '&';
				}
			} else {
				$new_url = $parse_url['path'] . '?';
			}
			// echo $new_url . "<br/>";
			$this->url = $new_url;
		}

		//生成页码
		public function build_page_list () {
			echo "<div class='page'>";
			echo "<a class='active'>总共有:{$this->total}条记录</a>";
			if ( !$this->total ) {
				echo "</div>";
				return;
			}
			echo $this->first_page();
			echo $this->prev();

			$start = '';
			$end = '';
			if ( $this->cur_page < $this->page_step - 1 ) {
				$start = 1;
				$end = $this->page_nums;
				if ( $end > $this->page_step ) {
					$end = $this->page_step;
				}
			} else {
				$start = $this->cur_page - $this->page_offset;
				$end = $start + $this->page_step - 1;
				if ( $end >= $this->page_nums ) {
					$end = $this->page_nums;
					$start = $end - $this->page_offset;
				}
			}
			for ( $ind = $start; $ind <= $end; $ind++ ) {
				if ( $this->cur_page == $ind ) {
					$active = "class='active'";
				} else {
					$active = '';
				}				
				echo "<a $active href='" . $this->url . 'p=' . $ind . "'>" . $ind . "</a>";
			}
			echo $this->next();
			echo $this->last_page();
			echo "</div>";
		}

		//上一页
		public function prev() {
			if ( $this->cur_page > 1 ) {
				return ( "<a href='" . $this->url . 'p=' . ( $this->cur_page - 1 ) . "'>" . "上一页" . "</a>" );
			} else {
				return ( "<a>上一页</a>" );
			}			
		}

		//下一页
		public function next() {
			if ( $this->cur_page < $this->page_nums ) {
				return ( "<a href='" . $this->url . 'p=' . ( $this->cur_page + 1 ) . "'>" . "下一页" . "</a>" );
			} else {
				return ( "<a>下一页</a>" );
			}
			
		}

		public function first_page () {
			return ( "<a href='" . $this->url . 'p=1' . "'>" . "首页" . "</a>" );
		}

		public function last_page () {
			return ( "<a href='" . $this->url . 'p=' . $this->page_nums . "'>" . "尾页" . "</a>" );	
		}
	}
?>