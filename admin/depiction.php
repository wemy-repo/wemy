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
	 
	/*** Biến GET DATA ***/
	$control = $_GET['control'];
	/*** Chỉ Admin đc sửa ***/
	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		/*** Kiểm tra sự tồn tại file control ***/
    	if(empty($control)){
			echo '<div class="item"><font color="red">Lỗi: Không tồn tại control.</font></div>';
    	}
		else
		{
			/*** Nếu mà bấm Sửa ***/
			if(isset($_POST['submit'])){
				$trang_f = '../depiction/' .$control. '.html';
				$trang_o = fopen($trang_f, "w+");
				fwrite($trang_o, $_POST['text']);
				fclose($trang_o);
				echo '<div class="alert alert-dismissible alert-success"><center>Cập nhật depiction của package <strong>' .$control. '</strong> thành công</center></div>';
				echo '<center><ul class="breadcrumb">' .
					 '<li><a href="../admin/index.php">Admin CP</a></li>' .
					 '<li><a href="../admin/packages.php?packages=' .$control. '">' .$control. '</a></li>' .
					 '<li class="active">Sửa depiction</li>' .
					 '</ul></center>';
				require('../incf/foot.php');
				exit;
			}
			/*** Mặc định ***/
			echo '<div class="alert alert-dismissible alert-info"><strong>Tip:</strong> Ghi nội dung giới thiệu package vào ô dưới đây.</div>';
			$trang_f = '../depiction/' .$control. '.html';
			echo '<form action="depiction.php?control=' .$control. '" method="post">';
			$trang_o = fopen($trang_f, "r");
			if(!$trang_o) echo 'Lỗi';
			else
			{
				echo '<div class="form-group"><textarea class="form-control" id="textArea" rows="15" name="text">';
				while(!feof($trang_o)){
				    echo fgets($trang_o);
				}
				echo '</textarea></div>';
			}
			fclose($trang_o);
			echo '<center><input class="btn btn-success" type="submit" name="submit" value="Hoàn tất" /></center>';
			echo '</form>';
			echo '<center><ul class="breadcrumb">' .
				 '<li><a href="../admin/index.php">Admin CP</a></li>' .
				 '<li><a href="../admin/packages.php?packages=' .$control. '">' .$control. '</a></li>' .
				 '<li class="active">Sửa depiction</li>' .
				 '</ul></center>';
		}
	}
	else echo '<div class="item"><font color="red">Lỗi: Bạn không có quyền vào trang này</font></div>';
	require('../incf/foot.php');
?>