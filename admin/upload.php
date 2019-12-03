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
	else echo '<div class="alert alert-dismissible alert-danger"><strong>Lỗi:</strong> Bạn không có quyền vào trang này</div>';

	require('../incf/foot.php');
?>
