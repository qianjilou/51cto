<?php	
	class CategoryModel {

		public $db;
		private $cat_tb_name = 'category';
		private $arc_tb_name = 'article';

		public function __construct ( &$db ) {
			$this->db = $db;
		}

		public function add_category ( $data ) {
			if ( $this->has_category( $data['cat_name'] ) ) {
				return false;
			} else {
				return $this->db->add( $this->cat_tb_name, $data );
			}
		}

		public function has_category ( $cat_name ) {
			$sql = "SELECT * FROM {$this->cat_tb_name} WHERE cat_name = '$cat_name'";
			$row = $this->db->get_row( $sql );
			if ( $row ) {
				return true;
			} else {
				return false;
			}
		}

		public function update_category ( $cat_id, $data ) {
			return $this->db->update( $this->cat_tb_name, $data, "WHERE cat_id = $cat_id" );
		}

		public function del_category ( $cat_id ) {
			if ( $this->has_son_category( $cat_id )
			|| $this->has_article_in_cat( $cat_id ) ){
				return false;
			}
			$sql = "DELETE FROM {$this->cat_tb_name} WHERE cat_id = $cat_id";
			return $this->db->query( $sql );
		}

		public function has_son_category ( $cat_id ) {
			$sql = "SELECT * FROM {$this->cat_tb_name} WHERE pid = $cat_id";
			$res = $this->db->get_row( $sql );
			if ( $res ) {
				return true;
			} else {
				return false;
			}
		}

		public function has_article_in_cat ( $cat_id ) {
			$sql = "SELECT * FROM {$this->arc_tb_name} WHERE cat_id = $cat_id";
			$row = $this->db->get_row( $sql );
			if ( $row ) {
				return true;
			} else {
				return false;
			}
		}

		/*
		 [0] => Array
        (
            [cat_id] => 1
            [cat_name] => 数码
            [pid] => 0
            [is_show] => 1
        )

	    [1] => Array
	        (
	            [cat_id] => 2
	            [cat_name] => 摄影&摄像
	            [pid] => 1
	            [is_show] => 1
	        )
			
			array (
				array(
					'cat_id' => cat_id,
					'cat_name' => cat_name
					'pid' => pid,
					'has_son' => array(
						'cat_id' => cat_id,
						'cat_name' => cat_name
						'pid' => pid,
					)
				),
				array(
					'cat_id' => cat_id,
					'cat_name' => cat_name
					'pid' => pid,
					'has_son' => array(
						'cat_id' => cat_id,
						'cat_name' => cat_name
						'pid' => pid,
					)
				),
			);

		 */

		public function get_cat_list () {
			$sql = "SELECT * FROM {$this->cat_tb_name}";
			$list = $this->db->get_all( $sql );
			// print_r( $list );

			$count = 0;
			$arr = array();
			if ( !empty( $list ) ) {
				while ( $list ) {
					//第一次先找出父类
					if ( $count == 0 ) {
						foreach ( $list as $k => $v ) {
							if ( $v['pid'] == 0 ) {
								$arr[] = $v;
								unset( $list[$k] );
							}
						}
					}
					$count++;
					
					// print_r( $arr );
					// print_r( $list );

					//再为每个父类找出对应的子类
					if ( !empty( $arr ) ) {
						foreach ( $arr as $p_k => $p_v ) {
							foreach ( $list as $s_k => $s_v ) {
								if ( $s_v['pid'] == $p_v['cat_id'] ) {
									$arr[$p_k]['has_son'][] = $s_v;
									unset( $list[$s_k] );
								}
							}
						}
						
						//再找三级分类
						foreach ( $arr as $p_k => $p_v ) {
							if ( !empty( $p_v['has_son'] ) ) {
								foreach ( $p_v['has_son'] as $sk => $sv ) {
									foreach ( $list as $k => $v ) {
										if ( $sv['cat_id'] == $v['pid'] ) {
											$arr[$p_k]['has_son'][$sk]['has_son2'][] = $v;
											unset( $list[$k] );
										}
									}
								}
							}	
						}
					}

				}
			}
			return $arr;
		}

		public function get_cat_detail ( $cat_id ) {
			$sql = "SELECT * FROM {$this->cat_tb_name} WHERE cat_id = $cat_id";
			return $this->db->get_row( $sql );			
		}
	}
?>