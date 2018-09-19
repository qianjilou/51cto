<?php	
	class ArticleModel {

		public $db;
		private $arc_tb_name = 'article';
		private $cat_tb_name = 'category';
		
		public function __construct ( &$db ) {
			$this->db = $db;
		}

		public function add_article ( $data ) {
			if ( $this->has_article( $data['title'] ) ) {
				return false;
			} else {

				return $this->db->add( $this->arc_tb_name, $data );
			}
		}

		public function has_article ( $title ) {
			$sql = "SELECT * FROM {$this->arc_tb_name} WHERE title = '$title'";
			$row = $this->db->get_row( $sql );
			if ( $row ) {
				return true;
			} else {
				return false;
			}
		}

		public function get_arc_info ( $arc_id ) {
			$sql = "SELECT * FROM {$this->arc_tb_name} WHERE article_id = $arc_id";
			return $this->db->get_row( $sql );
		}

		public function update_article ( $arc_id, $data ) {
			return $this->db->update( $this->arc_tb_name, $data, "WHERE article_id = $arc_id" );
		}

		public function delete_article ( $arc_id ) {
			return $this->query( "DELETE FROM {$this->arc_tb_name} WHERE article_id = $arc_id" );
		}

		public function get_arc_list ( $cat_id, $p = '', $page_size = '' ) {	
			$sql = "SELECT a.*, c.cat_name FROM {$this->arc_tb_name} a LEFT JOIN {$this->cat_tb_name} c ON a.cat_id = c.cat_id
			 WHERE 1 =1 ";
		 	if ( !empty( $cat_id ) ) {
				$sql .= " AND a.cat_id = $cat_id AND a.is_show = 1";
			}
			if ( !empty( $p ) && !empty( $page_size ) ) {
				$sql .= " LIMIT " . ( $p - 1 ) * $page_size . ',' . $page_size;
			}			
			
			return $this->db->get_all( $sql );
		}

		public function count_article ( $cat_id ) {
			return $this->db->get_col( "SELECT COUNT(*) AS nums FROM {$this->arc_tb_name} WHERE is_show = 1 AND cat_id = $cat_id" );
		}

		public function get_index_articles () {
			$sql = "SELECT * FROM {$this->arc_tb_name} WHERE is_show = 1 AND img_center <> '' AND rec_to_index = 1
			 ORDER BY sort ASC LIMIT 0, 4";
			 return $this->db->get_all( $sql );
		}

		// public function get_articles_bycatid( $cat_id ) {
		// 	$sql = "SELECT c.cat_name, a.* FROM {$this->cat_tb_name} c INNER JOIN {$this->arc_tb_name} a ON c.cat_id = a.cat_id
		// 	 AND a.is_show = 1 SORT ";
		// }

		/**
		 * 截取UTF-8编码下字符串的函数
		 *
		 * @param   string      $str        被截取的字符串
		 * @param   int         $length     截取的长度
		 * @param   bool        $append     是否附加省略号
		 *
		 * @return  string
		 */
		function sub_str($str, $length = 0, $append = true)
		{
		    $str = trim($str);
		    $strlength = strlen($str);

		    if ($length == 0 || $length >= $strlength)
		    {
		        return $str;
		    }
		    elseif ($length < 0)
		    {
		        $length = $strlength + $length;
		        if ($length < 0)
		        {
		            $length = $strlength;
		        }
		    }

		    if (function_exists('mb_substr'))
		    {
		        $newstr = mb_substr($str, 0, $length, "utf8");
		    }
		    elseif (function_exists('iconv_substr'))
		    {
		        $newstr = iconv_substr($str, 0, $length, "utf8");
		    }
		    else
		    {
		        //$newstr = trim_right(substr($str, 0, $length));
		        $newstr = substr($str, 0, $length);
		    }

		    if ($append && $str != $newstr)
		    {
		        $newstr .= '...';
		    }

		    return $newstr;
		}

		public function next_article ( $id ) {
			$sql = "SELECT * FROM {$this->arc_tb_name} WHERE article_id > {$id} ORDER BY article_id ASC LIMIT 0, 1";
			return $this->db->get_row( $sql );
		}

		public function prev_article ( $id ) {
			$sql = "SELECT * FROM {$this->arc_tb_name} WHERE article_id < {$id} ORDER BY article_id DESC LIMIT 0, 1";
			return $this->db->get_row( $sql );
		}

	}
?>