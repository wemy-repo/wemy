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
	
	$packages = $_GET['packages'];
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		/*** Nếu là phục hồi lại Packages ***/
		if($packages == 'clean'){
			if(file_exists('../Packages~') && file_exists('../Packages.gz~')){
				if(file_exists('../Packages')) unlink('../Packages'); // Xóa File Packages cũ
				if(file_exists('../Packages.gz')) unlink('../Packages.gz'); // Xóa File Packages.gz cũ
				rename('../Packages~', '../Packages');
				rename('../Packages.gz~', '../Packages.gz');
				echo '<div class="alert alert-dismissible alert-success"><center>Phục hồi <strong>Packages</strong> và <strong>Packages.gz</strong> thành công</center></div>';
				echo '<center><ul class="breadcrumb">' .
					 '<li><a href="../admin/index.php">Admin CP</a></li>' .
					 '<li class="active">Phục hồi Packages</li>' .
					 '</ul></center>';
				require('../incf/foot.php');
				exit;
			}
			else
			{
				echo '<div class="alert alert-dismissible alert-danger"><strong>Lỗi:</strong> Không tìm thấy Packages cũ</div>';
				echo '<center><ul class="breadcrumb">' .
					 '<li><a href="../admin/index.php">Admin CP</a></li>' .
					 '<li class="active">Phục hồi Packages</li>' .
					 '</ul></center>';
			}
			require('../incf/foot.php');
			exit;
		}
		echo '<div class="alert alert-dismissible alert-info"><strong>Tip:</strong> Bấm vào file DEB để xem thông tin, chỉnh sửa và xóa Packages!</div>';
		if(empty($packages)){
			echo '<div class="list-group"><a class="list-group-item active" href="#">Danh sách Package</a>';
			foreach (glob('../control/*.deb') as $trang_p){
				echo '<a class="list-group-item" href="packages.php?packages=' .substr($trang_p, 11). '">' .$trang_p. '</a>';
			}
			echo '</div>';
			echo '<center><ul class="breadcrumb">' .
				 '<li><a href="../admin/index.php">Admin CP</a></li>' .
				 '<li class="active">Packages</li>' .
				 '</ul></center>';
		}
		else
		{
			echo '<div class="list-group"><a class="list-group-item active" href="#">Packages: ' .$packages. '</a>';
			echo '<a class="list-group-item" href="edit.php?control=' .$packages. '">» Chỉnh sửa file control</a>';
			echo '<a class="list-group-item" href="depiction.php?control=' .$packages. '">» Chỉnh sửa depiction</a>';
			echo '<a class="list-group-item" href="delete.php?act=control&f=' .$packages. '">» Xóa Packages</a>';
			echo '</div>';
			echo '<center><ul class="breadcrumb">' .
				 '<li><a href="../admin/index.php">Admin CP</a></li>' .
				 '<li><a href="../admin/packages.php">Packages</a></li>' .
				 '<li class="active">' .$packages. '</li>' .
				 '</ul></center>';
		}
	}
	else echo '<div class="alert alert-dismissible alert-danger"><strong>Lỗi:</strong> Bạn không có quyền vào trang này</div>';
	require('../incf/foot.php');
?>