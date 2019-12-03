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

	/*** Chỉ Admin được xem ***/
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		$ini_max  = str_replace('M', '', ini_get('post_max_size')); // Biến check size max
		$ini_perl = ini_get('PCRE (Perl Compatible Regular Expressions) Support');
		echo '<div class="alert alert-dismissible alert-info">Một số thông tin về Source Cydia của bạn</div>';
		echo '<ul class="list-group"><li class="list-group-item">Quản Trị: <b><font color="red">' .$_SESSION['nickname']. '</font></b></li>' .
			 '<li class="list-group-item"><span class="badge">' .count(glob('../debs/*.deb')). '</span>Số File DEB</li>' .
			 '<li class="list-group-item"><span class="badge">' .(count(glob('../control/*')) - 1). '</span>Số File control<br/>' .
			 '→ Khi số File control nhiều hơn file DEB, bạn nên chạy dọn dẹp tập tin tạm.</li>' .
			 '<li class="list-group-item"><span class="badge">' .$ini_max. 'MB</span>Upload Max Size</li>' .
			 '<li class="list-group-item"><span class="badge">?</span>Perl Support</li></ul>';
		echo '<center><ul class="breadcrumb">' .
			 '<li><a href="../admin/index.php">Admin CP</a></li>' .
			 '<li class="active">Thông tin</li>' .
			 '</ul></center>';
	}
	else echo '<div class="alert alert-dismissible alert-danger"><strong>Lỗi:</strong> Bạn không có quyền vào trang này</div>';
	require('../incf/foot.php');
?>