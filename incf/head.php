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
	 

	/*** Trang chủ ***/
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"' .
	'"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' .
    '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">' .
    '<head>' .
	'<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8"/>' .
	'<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">' .
	'<script src="http://code.jquery.com/jquery-latest.js"></script>' .
	'<script src="../js/bootstrap.file-input.js"></script>' .
	'<link rel="shortcut icon" href="../favicon.ico" />' .
    '<title>RepoCms.XyZ - Tự tạo Source Cydia cho bạn</title>' .
	'<meta name="viewport" content="width=device-width, initial-scale=1.0">' .
    '</head>' .
    '<body>' .
	'<br/>';
	/*** Themes ***/
    echo '<div class="col-lg-3"></div>' .
		 '<div class="col-lg-6">' .
		 '<ul class="nav nav-pills">' .
		 '<li class="active"><a href="../index.php">Home</a></li>' .
		 '<li><a href="../admin/index.php">Admin CP</a></li>';
	/*** Hiện nick Admin nếu là Admin ***/
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		echo '<li class="active"><a href="../admin/exit.php">' .$_SESSION['nickname']. '</a></li>';
	}
	else echo '<li class="active"><a href="../RepoCms_v2.3.2~b.zip">Download 2.3.2~b</a></li>';
	echo '</ul><br/>';
	
?>