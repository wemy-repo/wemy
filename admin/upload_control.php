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
	require('../incf/head.php');
	
	/*** Kiểm tra Session ***/
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		$error = array();
		$trang_control = $_POST['trang_control']; // Tên tệp control
		$trang_md5 = $_POST['trang_md5']; // Check MD5
	    /*** Kiểm tra đã submit file chưa ***/
        if(isset($_FILES['control']['tmp_name'])){
			$trang_dir    = '../control';
			$trang_dir_d  = '../debs';
			$trang_dir_de = '../depiction';
			/*** Bắt đầu check lỗi ***/
			if($_FILES['control']['name'] != 'control') $error[] = 'Không đúng file control';
			/*** Trống lỗi thì thực thi ***/
			if(empty($error)){
				if(@copy($_FILES['control']['tmp_name'],$trang_dir.'/'.$trang_control. '~')){
					/*** Tạo depiction ***/
					$trang_c_d = fopen($trang_dir_de.'/'.$trang_control.'.html', "w+");
					fclose($trang_c_d);
					/*** Ghi thêm vào File ***/
					$trang_depic   = 'Depiction: ' .$trang_url. '/depiction.php?deb=' .$trang_control. '.html'; // Depiction
					$trang_fileurl = 'Filename: ' .substr($trang_dir_d.'/'.$trang_control, 1); // Filename
					$trang_md5     = 'MD5sum: ' . $trang_md5; // MD5 file
					$trang_size    = 'Size: ' . filesize($trang_dir_d.'/'.$trang_control); // Size file
					$trang_f = fopen($trang_dir.'/'.$trang_control. '~', "a");
					fwrite($trang_f, "\n" .$trang_depic);
					fwrite($trang_f, "\n" .$trang_fileurl);
					fwrite($trang_f, "\n" .$trang_size);
					fwrite($trang_f, "\n" .$trang_md5);
					fclose($trang_f);
					/*** Fix xuống dòng ***/
					$i = 0;
					$trang_f = file($trang_dir.'/'.$trang_control. '~');
					$trang_c = count($trang_f);
					$trang_o = fopen($trang_dir.'/'.$trang_control, "w+");
					while($i<=$trang_c){
						if($trang_f[$i] != "\n"){
							fwrite($trang_o, $trang_f[$i]);
						}
						$i++;
					}
					echo '<div class="alert alert-dismissible alert-success">Tải tệp control của File <strong>' .$trang_control. '</strong> thành công!</div>';
					echo '<div class="panel panel-default">' .
						 '<div class="panel-heading">Thông tin File control:</div>' .
						 '<div class="panel-body">';
					$trang_f = fopen($trang_dir.'/'.$trang_control, "r");
					while(!feof($trang_f)){
						echo fgets($trang_f). "<br/>";
					}
					fclose($trang_f);
					echo '</div>' .
						 '<div class="panel-body"><b>Chú ý:</b> Nếu bạn thấy nội dung file control trên có khoảng xuống dòng ở giữa thì nhấn vào <a href="../admin/edit.php?control=' .$trang_control. '">Chỉnh Sửa Control</a> để sửa lại! <b>Chỉ được sửa khoảng xuống dòng!</b></div>' .
						 '<div class="panel-body"><center>» <a href="../admin/update.php">Update Now</a> «</center></div></div>';
				}
			}
			else
			{
				/*** Xóa File ***/
				unlink($trang_dir_d.'/'.$trang_control);
				/*** Thông báo lỗi ***/
				echo '<div class="alert alert-dismissible alert-danger"><strong>Đã phát hiện lỗi: </strong>';
				foreach($error as $errors){
					echo $errors. ', ';
				}
				echo 'Quay lại trang <a class="alert-link" href="upload.php">Upload Tweak</a> và thực hiên lại</div>';
			}
		}
	}
	else echo '<div class="alert alert-dismissible alert-danger"><strong>Lỗi:</strong> Bạn không có quyền vào trang này</div>';
	
	require('../incf/foot.php');
?>