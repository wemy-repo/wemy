<?php
    /*
     *
     * @ Cydia Source Create
     *
     * @ Author: Tí Nhí Nhố (tonghoai)
     *
     * @ Vui lòng không chỉnh sửa bản quyền
     *
     */
	 
	include('../incf/db.php');
	/*** Ẩn Chú ý ***/
	error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);
	require('../incf/head.php');
	/*** Gọi đường dẫn cho Perl ***/
	ini_set("include_path", '/home/tonghoai/php:' . ini_get("include_path")  );
	/*** Hết ***/
	require_once "File/Archive.php";
	 
	/*** Kiểm tra Session ***/
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		/*** Kiểm tra đã submit file chưa ***/
		if(isset($_FILES['deb']['tmp_name'])){
			echo '<div class="item">';
			$trang_dir   = '../debs';
			$trang_dir_c = '../control';
			$trang_dir_t = '../temp';
			/*** Check File trùng ***/
			foreach (glob('../debs/*.deb') as $trang_f){
				$trang_c = strlen($trang_f);
				$trang_s = substr($trang_f, 8, $trang_c);
				if($_FILES['deb']['name'] == $trang_s){
					echo '<font color="red">Lỗi: File deb đã tồn tại.</font>';
					echo '</div><div class="item">« <a href="upload_perl.php">Quay lại</a></div></div>';
					exit;
				}
			}
			/*** Di chuyển file DEB ***/
			if(@copy($_FILES['deb']['tmp_name'],$trang_dir.'/'.$_FILES['deb']['name'])){
				$trang_md5 = md5_file($trang_dir.'/'.$_FILES['deb']['name']);
				/*** Lấy file control trong DEB ***/
				File_Archive::extract(File_Archive::read($trang_dir.'/'.$_FILES['deb']['name'] . '/control.tar.gz/'), File_Archive::toFiles($trang_dir_t));
				if(file_exists($trang_dir_t. '/control')){
					$trang_deb = $_FILES['deb']['name'];
					/*** Tạo depiction ***/
					$trang_c_d = fopen('../depiction/'.$trang_deb.'.html', "w+");
					fclose($trang_c_d);
					/*** Copy file control vào thư mục control ***/
					copy($trang_dir_t. '/control', $trang_dir_c . '/' . $_FILES['deb']['name'] . '~');
					/*** Ghi vào file control ***/
					$trang_depic   = 'Depiction: ' .$trang_url. '/depiction.php?deb=' .$trang_deb. '.html'; // Depiction
					$trang_fileurl = 'Filename: ' .substr($trang_dir.'/'.$trang_deb, 1); // Filename
					$trang_md5     = 'MD5sum: ' . $trang_md5; // MD5 file
					$trang_size    = 'Size: ' . filesize($trang_dir.'/'.$trang_deb); // Size file
					$trang_f = fopen($trang_dir_c.'/'.$trang_deb. '~', "a");
					fwrite($trang_f, "\n" .$trang_depic);
					fwrite($trang_f, "\n" .$trang_fileurl);
					fwrite($trang_f, "\n" .$trang_size);
					fwrite($trang_f, "\n" .$trang_md5);
					fclose($trang_f);
					/*** Fix xuống dòng ***/
					$i = 0;
					$trang_f = file($trang_dir_c.'/'.$trang_deb. '~');
					$trang_c = count($trang_f);
					$trang_o = fopen($trang_dir_c.'/'.$trang_deb, "w+");
					while($i<=$trang_c){
						if($trang_f[$i] != "\n"){
							fwrite($trang_o, $trang_f[$i]);
						}
						$i++;
					}
					/*** Hết ***/
					unlink($trang_dir_t.'/control');
					echo 'Tải tệp <font color="#800000"><b>' .$_FILES['deb']['name']. '</b></font> và trích xuất thành công!';
					echo '<div class="item"><center>»<a href="../admin/update.php">Update Now</a>«</center></div></div>';
					exit;
				}
				else
				{
					unlink($trang_dir.'/'.$_FILES['deb']['name']);
					unlink($trang_dir_t.'/control');
					echo '<font color="red">Lỗi: File DEB lỗi hoặc Hosting không hỗ trợ Perl!</font>';
					echo '</div><div class="item">« <a href="upload_perl.php">Quay lại</a></div></div>';
					exit;
				}
			}
			echo '</div>';
		}
		/*** Form up tweak ***/
		echo '<br/><form enctype="multipart/form-data" action="upload_perl.php" method="post">';
		echo '<div class="item"><div><input name="deb" type="file" style="border:0px #fff solid !important;"/></div></div>' .
			'<div class="item"><font color="#8B4513">+ Chọn File DEB và nhấn Upload</font><br/>' .
			'<div class="item"><center><input type="submit" name="submit" value="Upload" /></center></div>' .
			'</form>';
		echo '</div><div class="item">« <a href="index.php">Quay lại</a></div>';
	}
	else echo '<div class="item"><font color="red">Lỗi: Bạn không có quyền vào trang này</font></div>';

	require('../incf/foot.php');
?>