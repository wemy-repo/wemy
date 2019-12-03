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
	
	/*** Kiểm tra nick Admin ***/
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		/*** Sao lưu Packages cũ ***/
		if(file_exists('../Packages') && file_exists('../Packages.gz')){
			rename('../Packages', '../Packages~');
			rename('../Packages.gz', '../Packages.gz~');
		}
		/*** Tạo file Packages và ghi data ***/
		$trang_p = $trang_p = fopen("../Packages","w+");
		foreach (glob('../control/*.deb') as $trang_f){ //$trang_f là các tệp control
		    fwrite($trang_p, file_get_contents($trang_f));
			fwrite($trang_p, "\n\n");
		}
		fclose($trang_p);
		/*** Chuỗi hàm tạo file gz ***/
		$trang_f = "../Packages";
		$gzfile = "../Packages.gz";
		$fp = gzopen($gzfile, 'w9');
		gzwrite($fp, file_get_contents($trang_f));
		gzclose($fp);
		/*** Hết ***/
		/*** Thông báo hoàn thành ***/
		$trang_c = count(glob('../control/*.deb'));
		echo '<div class="alert alert-dismissible alert-success"><center>Đã hoàn thành <strong>' .$trang_c. '</strong> mục!</center></div>';
		echo '<center><ul class="breadcrumb">' .
			 '<li><a href="../admin/index.php">Admin CP</a></li>' .
			 '<li class="active">Cập nhật Package</li>' .
			 '</ul></center>';
	}
	else echo '<div class="alert alert-dismissible alert-danger"><strong>Lỗi:</strong> Bạn không có quyền vào trang này</div>';
	
	require('../incf/foot.php');
?>