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
	    /*** Kiểm tra đã submit file chưa ***/
        if(isset($_FILES['deb']['tmp_name'])){
			$trang_dir= '../debs';
			/*** Kiểm tra định dạng ***/
            $trang_ext   = explode(".", $_FILES['deb']['name']);
		    $trang_ext_c = count($trang_ext) - 1;
			if($trang_ext[$trang_ext_c] != 'deb') $error[] = 'Phải chọn file .DEB'; // Lỗi định dạng
			foreach (glob('../debs/*.deb') as $trang_f){
				$trang_c = strlen($trang_f);
				$trang_s = substr($trang_f, 8, $trang_c);
				if($_FILES['deb']['name'] == $trang_s) $error[] = 'File DEB đã tồn tại'; // Lỗi file đã tồn tại
			}
			/*** Trống lỗi thì hành động ***/
			if(empty($error)){
				if(@copy($_FILES['deb']['tmp_name'],$trang_dir.'/'.$_FILES['deb']['name'])){
					echo '<div class="alert alert-dismissible alert-success">Tải tệp <strong>' .$_FILES['deb']['name']. '</strong> thành công</div>';
					/*** Form nhập file control ***/
					echo '<div class="panel panel-default">' .
						 '<div class="panel-heading">Upload Tweak mới</div>' .
						 '<div class="panel-body">' .
						 '<form enctype="multipart/form-data" action="./upload_control.php" method="post">';
					echo '<input name="control" type="file" />' .
					     '<input name="trang_control" type="hidden" value="' .$_FILES['deb']['name']. '">' .
						 '<input name="trang_md5" type="hidden" value="' .md5_file($trang_dir.'/'.$_FILES['deb']['name']). '">';
					echo ' Chọn File control ứng với file DEB trên và nhấn Upload' .
						 '</div><div class="panel-body">' .
					     '<center><input class="btn btn-success" type="submit" name="submit" value="Tải lên" /></center>' .
						 '</form></div></div>';
			    }
			}
			else
			{
				
				echo '<div class="alert alert-dismissible alert-danger"><button class="close" type="button" data-dismiss="alert">×</button><strong>Đã phát hiện lỗi:</strong> ';
				foreach($error as $errors){
					echo $errors. ', ';
				}
				echo '</div>';
				echo '<div class="panel panel-default">' .
					 '<div class="panel-heading">Upload Tweak mới</div>' .
					 '<div class="panel-body">' .
					 '<form enctype="multipart/form-data" action="./upload_deb.php" method="post">';
				echo '<input type="file" name="deb"/>';	
				echo ' Chọn File deb và nhấn Upload<br/>' .
					 '' .
					 '<center><input class="btn btn-success" type="submit" name="submit" value="Tải lên" /></center></form></div></div>';
				echo '<center><ul class="breadcrumb">' .
					 '<li><a href="../admin/index.php">Admin CP</a></li>' .
					 '<li class="active">Upload Tweak</li>' .
					 '</ul></center>';
			}
		}
		else echo '<br/><div class="item"><font color="#800000">- Lỗi: Bấm <a>Quay lại</a> và chọn một file DEB!</font></div>';
	
	}
	else echo '<div class="alert alert-dismissible alert-danger"><strong>Lỗi:</strong> Bạn không có quyền vào trang này</div>';

	require('../incf/foot.php');
?>