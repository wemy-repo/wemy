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
	
	/*** Lỗi nếu thấy file db.php ***/
	if(file_exists('./incf/db.php')) {
		echo 'DB is created!';
		exit;
	}
	/*** Nếu bấm submit ***/
	if(isset($_POST['submit'])){
		$username = isset($_POST['username']) ? trim($_POST['username']) : '';
		$nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		$url      = isset($_POST['url']) ? trim($_POST['url']) : '';
		if(empty($username) || empty($nickname) || empty($password) || empty($url)){
			$error = 'Bạn phải điền đầy đủ các ô!';
		}
		if(empty($error)){
			$dbfile = "<?php\r\n" .
					  "SESSION_START();\r\n" .
			          "    /*** Thông tin Admin ***/\r\n" .
					  '    $trang_useradmin = ' . "'$username';\r\n" .
					  '    $trang_nickadmin = ' . "'$nickname';\r\n" .
					  '    $trang_passadmin = ' . "'$password';\r\n\r\n" .
					  "    /*** Trang chủ ***/\r\n" .
					  '    $trang_url = ' . "'$url';\r\n\r\n" .
					  "?>";
			if (file_put_contents('./incf/db.php', $dbfile)){
				require('./incf/head.php');
				echo '<br/><div class="item"><font color="#800000">Ghi dữ liệu thành công! Lưu ý xóa file install.php sau khi thiết lập song!</font></div><br/>';
				require('./incf/foot.php');
				exit;
			}
		}
	}
	/*** Trang chủ ***/
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"' .
	'"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' .
    '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">' .
    '<head>' .
	'<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8"/>' .
	'<link href="./themes/style.css" rel="stylesheet" type="text/css" />' .
	'<link rel="shortcut icon" href="./favicon.ico" />' .
    '<title>My Cydia Install</title>' .
    '</head>' .
    '<body>' .
	'<div id="body"><div class="logo"></div><div class="header"><a href="/index.php">Trang chủ</a></div>';
	
	if(isset($error)) echo '<br/><div class="item"><b><font color="#800000">- Đã phát hiện lỗi:</font></b><br/><font color="#8B4513">+ ' .$error. '</font><br/></div>';
	echo '<center><h3><b><font color="#800000">Nhập thông tin Admin</font></b></h3></center>';
	echo '<div class="item"><form action="install.php" method="post"> Tên đăng nhập:<br/><input type="text" name="username"/><br/> Tên hiển thị:<br/><input type="text" name="nickname"/><br/>Mật khẩu:<br/><input type="password" name="password"/><br/> Trang chủ:<br/><input type="text" name="url" value="http://"/><br/><br/><center><input type="submit" name="submit" value="Đăng nhập"></center></form></div>';

	require('./incf/foot.php');
?>