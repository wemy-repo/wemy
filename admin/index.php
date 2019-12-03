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
	
	$error = array();
	
	/*** Nếu nhấn Đăng Nhập ***/
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		/*** Bắt đầu check lỗi ***/
		if(empty($username) || empty($password)) $error[] = 'Phải nhập Tên và Mật khẩu';
		if($username != $trang_useradmin || $password != $trang_passadmin) $error[] = 'Sai Tên hoặc Mật khẩu';
		else
		{
			$_SESSION['username'] = $trang_useradmin;
			$_SESSION['nickname'] = $trang_nickadmin;
			$_SESSION['password'] = $trang_passadmin;
		}
	}
	/*** Thông báo login nếu chưa ***/
	if(empty($_SESSION['username']) && empty($_SESSION['password'])){
		require('../incf/head.php');
		/*** Hiện lỗi nếu gặp ***/
		if(sizeof($error) != 0){
			echo '<div class="alert alert-dismissible alert-danger"><button class="close" type="button" data-dismiss="alert">×</button><strong>Đã phát hiện lỗi: </strong>';
			foreach($error as $errors){
				echo $errors. ', ';
			}
			echo '</div>';
		}
		/*** Hết lỗi ***/
		//echo '<center><h3><b><font color="#800000">Bạn cần phải đăng nhập</font></b></h3></center>';
		//echo '<div class="item"><form action="./index.php" method="post"> Tên đăng nhập:<br/><input type="text" name="username"/><br>Mật khẩu:<br/><input type="password" name="password"/><br/><br/><center><input type="submit" name="submit" value="Đăng nhập"></center></form></div>';
		echo '<form class="form-horizontal" action="./index.php" method="post"><fieldset>' .
			 '<legend>Đăng nhập và quản lý source</legend>' .
			 '<div class="form-group"><label class="col-lg-3 control-label" for="inputEmail">Username:</label><div class="col-lg-9"><input class="form-control" id="inputEmail" type="text" placeholder="Username" name="username"></div></div>' .
			 '<div class="form-group"><label class="col-lg-3 control-label" for="inputPassword">Password:</label><div class="col-lg-9"><input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password"></div></div>' .
			 '<div class="form-group"><div class="col-lg-10 col-lg-offset-5"><button class="btn btn-primary" type="submit" name="submit">Login</button></div></div>' .
			 '</fieldset><form>';
	}
	else
	{
		require('../incf/head.php');
		/*** Bảng quản trị ***/
		echo '<div class="alert alert-dismissible alert-info">Quản lý Source của bạn tại đây, chỉ tài khoản Admin mới được phép truy cập, bấm vào NickName để đăng xuất.</div>';
		echo '<div class="list-group"><a class="list-group-item active" href="#">Bảng Quản Trị</a>' .
			 '<a class="list-group-item" href="upload.php">» Upload tweak mới</a>' .
		     '<a class="list-group-item" href="#">» Upload tweak mới (Perl Support)</a>' .
			 '<a class="list-group-item" href="./update.php">» Cập nhật Packages</a>' .
			 '<a class="list-group-item" href="./packages.php">» Duyệt các Packages</a>' .
		     '<a class="list-group-item" href="./release.php">» Thiết lập File Release</a>' .
             '<a class="list-group-item" href="./cydiaicon.php">» Upload file CydiaIcon.png mới</a>' .
			 '<a class="list-group-item" href="./packages.php?packages=clean">» Phục hồi lại Packages.gz trước</a>' .
			 '<a class="list-group-item" href="./info.php"><font color="green">» Thông tin về Source Cydia của bạn</font></a>' .
			 '<a class="list-group-item" href="./delete.php">» Xóa các tập tin rác và các gói DEB không thực thi</a>' .
			 '<a class="list-group-item" href="./delete.php?act=reset"><font color="red">» Đặt lại Source Cydia (xóa tất cả nội dung và thiết lập)</font></a>' .
			 '</div>';
	}
	
	require('../incf/foot.php');
?>