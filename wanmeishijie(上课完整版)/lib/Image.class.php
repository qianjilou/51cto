<?php
	class Image {

		public $upload_data;
		public $allow_filetype = array( "jpg", "jpeg", "png", "gif", "bmp" );
		public $upload_dir;

		//初始化 把$_FILES['文章上传域的name值']
		public function __construct ( $upload_data, $upload_dir ) {
			$this->upload_data = $upload_data;
			$this->upload_dir = $upload_dir;
		}

		//检查是否有错误
		public function check_error () {
			if ( $this->upload_data['error'] > 0 ) {
				switch ( $this->upload_data['error'] ) {
					case 1:
						//超过文件上传最大值
						return 1001;
					case 2:
						//上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值
						return 1002;
					case 3:
						//文件只有部分被上传
						return 1003;
					case 4:
						//没有文件被上传
						return 1004;
					default:
						return 1000;
				}
			}
			//没有错误就是0
			return 0;
		}

		//获取上传文件的后缀
		public function get_file_ext () {
			list ( $file_pre, $file_suf ) = explode( ".", $this->upload_data['name'] );
			return $file_suf;
		}

		public function check_filetype () {
			$file_ext = strtolower( $this->get_file_ext() );
			if ( !in_array( $file_ext, $this->allow_filetype ) ) {
				return false;
			} else {
				return true;
			}
		}

		public function mk_dir () {
			if ( !is_dir( $this->upload_dir ) ) {
				if ( mkdir( $this->upload_dir ) ) {
					return true;
				} else {
					return false;
				}
			}
			return true;
		}

		//上传		
		public function upload_img () {
			$error_no = $this->check_error();
			if ( $error_no != 0 ) {
				die( $error_no );
			}

			if ( !$this->check_filetype() ) {
				die( "不支持的文件类型:" . $this->get_file_ext() );
			}

			if ( !$this->mk_dir() ) {
				die( $this->upload_dir . "创建失败或者不存在!<br/>" );
			}

			if ( move_uploaded_file( $this->upload_data['tmp_name'], $this->upload_dir . $this->upload_data['name'] ) ) {
				return $this->upload_data['name'];
			} else {
				return false;
			}
		}


		//缩放
		public function make_thumb ( $img_path, $dst_img_path, $dst_width, $dst_heigth ) {
			$file_types = array( 1 => "gif", 2 => "jpeg", 3 => "png" );
			list( $src_width, $src_height, $file_type, $attr ) = getimagesize( $img_path );
			$imagecreatefrom = "imagecreatefrom" . $file_types[$file_type];
			$output = "image" . $file_types[$file_type];

			$src_im = $imagecreatefrom( $img_path );
			$dst_im = imagecreatetruecolor( $dst_width, $dst_heigth );
			$flag = imagecopyresampled ( $dst_im , $src_im , 0 , 0 , 0 , 0 , $dst_width , $dst_heigth ,
				$src_width , $src_height );
			if ( !$flag ) {
				die( "缩放失败" );
			}
			$output( $dst_im, $dst_img_path );			
			imagedestroy( $src_im );
			imagedestroy( $dst_im );
			return $dst_img_path;
		}
	}

	// if ( isset( $_FILES['upload_img'] ) ) {
	// 	$image = new Image( $_FILES['upload_img'], "../../upload/" );
	// 	$upload_img = $image->upload_img();
	// 	list( $file_pre, $file_suf ) = explode( ".", $upload_img );
	// 	$image->make_thumb( "../../upload/" . $upload_img, "../../upload/" . $file_pre . '_center.' . $file_suf, 300, 200 );
	// }

?>