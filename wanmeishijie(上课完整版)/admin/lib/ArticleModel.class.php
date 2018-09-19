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

		public function get_arc_list ( $p = '', $page_size = '' ) {	
			$sql = "SELECT a.*, c.cat_name FROM {$this->arc_tb_name} a LEFT JOIN {$this->cat_tb_name} c ON a.cat_id = c.cat_id";
			if ( !empty( $p ) && !empty( $page_size ) ) {
				$sql .= " LIMIT " . ( $p - 1 ) * $page_size . ',' . $page_size;
			}
			return $this->db->get_all( $sql );
		}

		public function count_article () {
			return $this->db->get_col( "SELECT COUNT(*) AS nums FROM {$this->arc_tb_name}" );
		}

	}
?>