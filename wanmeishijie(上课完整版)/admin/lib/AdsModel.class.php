<?php
	class AdsModel {

		public $db;
		private $slide_tb_name = 'slideshow';

		public function __construct ( &$db ) {
			$this->db = $db;
		}

		public function add_ads ( $data ) {
			return $this->db->add( $this->slide_tb_name, $data );
		}

		public function update_ads ( $ads_id, $data ) {
			return $this->db->update( $this->slide_tb_name, $data, "WHERE ads_id = $ads_id" );
		}

		public function delete_ads ( $ads_id ) {
			return $this->db->query( "DELETE FROM {$this->slide_tb_name} WHERE ads_id = $ads_id" );
		}

		public function get_ads_list ( $p = '', $page_size = '' ) {
			$sql = "SELECT * FROM {$this->slide_tb_name}";
			if ( !empty( $p ) && !empty( $page_size ) ) {
				$sql .= " LIMIT " . ( $p - 1 ) * $page_size . ',' . $page_size;
			}
			return $this->db->get_all( $sql );
		}

		public function get_ads_info ( $ads_id ) {
			return $this->db->get_row( "SELECT * FROM {$this->slide_tb_name} WHERE ads_id = $ads_id" );
		}

		public function count_ads () {
			return $this->db->get_col( "SELECT COUNT(*) AS nums FROM {$this->slide_tb_name}" );
		}
	}

?>