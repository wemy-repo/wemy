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

	/*** Check Session ***/
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        $error    = array();
        $messages = array();
        if(isset($_FILES['trangfile']['tmp_name'])){
			$trang_ext   = explode(".", $_FILES['trangfile']['name']);
			$trang_ext_c = count($trang_ext) - 1;
			if(!is_uploaded_file($_FILES['trangfile']['tmp_name'])) $error[] = 'Bạn chưa chọn File ảnh';
			elseif($trang_ext[$trang_ext_c] != 'png') $error[] = 'File ảnh phải có đuôi PNG';
			if(empty($error)) {
				if(@copy($_FILES['trangfile']['tmp_name'],"../CydiaIcon.png")){
					$messages[] = 'CydiaIcon đã được cập nhật';
				}
			}			
		}
		/*** Báo Tin ***/
		if(sizeof($messages) != 0)
		{
			echo '<div class="alert alert-dismissible alert-success">';
			foreach($messages as $message)
			{
				echo $message.'<br/>';
			}
			echo '</div>' .
				 '<center><ul class="breadcrumb">' .
				 '<li><a href="../admin/index.php">Admin CP</a></li>' .
				 '<li><a href="../admin/cydiaicon.php">Upload CydiaIcon</a></li>' .
				 '<li class="active">Updated CydiaIcon</li>' .
				 '</ul></center>';
		exit;
		}
		/*** Mặc định ***/
		echo '<div class="alert alert-dismissible alert-info"><strong>Tip:</strong> Tải lên tập tin hình ảnh có đuôi .png để làm biểu tượng cho nguồn Cydia của bạn</div>';
		if(file_exists('../CydiaIcon.png')) echo '<center><img src="../CydiaIcon.png" /></center><br/><br/>';
		if(sizeof($error) != 0)
		{
			echo '<div class="alert alert-dismissible alert-danger"><strong>Đã phát hiện lỗi: </strong>';
			foreach($error as $err)
			{
				echo $err. ', ';
			}
			echo '</div>';
		}
		echo '<div class="panel panel-default">' .
			 '<div class="panel-heading">Upload biểu tượng Cydia</div>' .
			 '<div class="panel-body">';
		echo '<form enctype="multipart/form-data" action="./cydiaicon.php" method="post">' .
		     '<input name="trangfile" type="file"/>' .
			 '<center><input class="btn btn-success" type="submit" name="submit" value="Tải lên" /></center></form></div></div>';
		echo '<center><ul class="breadcrumb">' .
			 '<li><a href="../admin/index.php">Admin CP</a></li>' .
			 '<li class="active">Upload CydiaIcon</li>' .
			 '</ul></center>';
	}
	else echo '<div class="alert alert-dismissible alert-danger"><strong>Lỗi:</strong> Bạn không có quyền vào trang này</div>';
	require('../incf/foot.php');
?>