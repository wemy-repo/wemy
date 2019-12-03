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
		$act = $_GET['act'];
		// Mặc định là xóa file rác
		if(empty($act)){
			echo '<div class="alert alert-dismissible alert-info">Tùy chọn này sẽ xóa các tập tin tạm và không thực thi ra khỏi Source của bạn</div>';
			/*** Xóa control rác ***/
			echo '<ul class="list-group">';
			foreach (glob('../control/*.deb~') as $trang_f){
				unlink($trang_f);
				echo '<li class="list-group-item">Đã xóa ' .$trang_f. '...</li>';
			}
			/*** Xóa file deb mà không có control ***/
			foreach (glob('../debs/*.deb') as $trang_d){
				$trang_d = substr($trang_d, 8);
				$i = 0;
				foreach (glob('../control/*.deb') as $trang_f){
					$trang_f = substr($trang_f, 11);
					if($trang_d == $trang_f) $i++;
				}
				if($i == 0){
					unlink('../debs/' .$trang_d);
					echo '<li class="list-group-item">Đã xóa ' .$trang_d. '...</li>';
				}
			}
			echo '</li>';
			/*** Thông báo không có gì ***/
			if(count($trang_f) == 0 || count($trang_d) == 0) echo '<div class="alert alert-dismissible alert-success">Source của bạn đã sạch</div>';
			echo '<center><ul class="breadcrumb">' .
				 '<li><a href="../admin/index.php">Admin CP</a></li>' .
				 '<li class="active">Xóa rác</li>' .
				 '</ul></center>';
		}
		/*** act = control là xóa 1 packages ***/
		elseif($act == 'control'){
			$f = $_GET['f'];
			/*** Phải có $f mới thực thi ***/
			if(isset($f)){
				if(file_exists('../control/' .$f) && file_exists('../debs/' .$f)){
					unlink('../control/' .$f);
					unlink('../debs/' .$f);
					unlink('../depiction/' .$f. '.html');
					echo '<div class="alert alert-dismissible alert-success"><center>Đã xóa Package <strong>' .$f. '</strong> thành công!</center></div>';
				}
				else
				{
					echo '<div class="alert alert-dismissible alert-danger"><center>Lỗi Package không tồn tại!</center></div>';
				}
			echo '<center><ul class="breadcrumb">' .
				 '<li><a href="../admin/index.php">Admin CP</a></li>' .
				 '<li><a href="../admin/packages.php">Packages</a></li>' .
				 '<li class="active">Xóa Packages</li>' .
				 '</ul></center>';
			}
		}
		/*** act = reset là đặt lại source ***/
		elseif($act == 'reset'){
			$confirm = $_GET['confirm'];
			if(isset($confirm)){
				if(file_exists('../Packages')) unlink('../Packages');
				if(file_exists('../Packages~')) unlink('../Packages~');
				if(file_exists('../Packages.gz')) unlink('../Packages.gz');
				if(file_exists('../Packages.gz~')) unlink('../Packages.gz~');
				if(file_exists('../CydiaIcon.png')) unlink('../CydiaIcon.png');
				if(file_exists('../Release')) unlink('../Release');
				/*** Xóa toàn bộ thư mục control ***/
				foreach (glob('../control/*.deb') as $trang_f){
					unlink($trang_f);
				}
				foreach (glob('../control/*.deb~') as $trang_f){
					unlink($trang_f);
				}
				/*** Xóa toàn bộ thư mục debs ***/
				foreach (glob('../debs/*.deb') as $trang_f){
					unlink($trang_f);
				}
				/*** Xóa toàn bộ thư mục depiction ***/
				foreach (glob('../depiction/*.html') as $trang_f){
					unlink($trang_f);
				}
				echo '<div class="alert alert-dismissible alert-success"><strong>Đã xóa tất cả!</strong></div>';
				echo '<center><ul class="breadcrumb">' .
					 '<li><a href="../admin/index.php">Admin CP</a></li>' .
					 '<li class="active">Xóa tất cả</li>' .
					 '</ul></center>';
			}
			else
			{
				echo '<div class="alert alert-dismissible alert-danger"><strong>Chú ý: </strong>Điều này sẽ làm mất hết dữ liệu Source của bạn</div>';
				echo '<div class="panel panel-default"><div class="panel-body"><font color="red"><center><b>Bạn có muốn đặt lại Source? Tất cả file sẽ bị xóa và đưa source về mặc định</b></center></font><center><a class="btn btn-primary" href="../admin/index.php">Hủy</a>  <a class="btn btn-success" href="../admin/delete.php?act=reset&confirm=ok">Xác nhận</a></center></div></div>';
			}
		}
	}
	else echo '<div class="item"><font color="red">Lỗi: Bạn không có quyền vào trang này</font></div>';
	require('../incf/foot.php');
?>