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
			
    	}
		else
		{
			/*** Nếu mà bấm Sửa ***/
			if(isset($_POST['submit'])){
				$trang_f = '../control/' .$control;
				$trang_o = fopen($trang_f, "w+");
				fwrite($trang_o, $_POST['text']);
				fclose($trang_o);
				echo '<div class="alert alert-dismissible alert-success"><center>Cập nhật file control thành công</center></div><div class="panel-body"><center>» <a href="../admin/update.php">Update Now</a> «</center></div></div>';
				require('../incf/foot.php');
				exit;
			}
			/*** Mặc định ***/
			echo '<div class="alert alert-dismissible alert-info"><strong>Tip:</strong> Mục này chỉ để chỉnh sửa kí tự xuống hàng (thừa) và chỉnh sửa Depiction...Những chỉnh sửa khác với trong file DEB có thể dẫn đến lỗi.</div>';
			$trang_f = '../control/' .$control;
			echo '<form action="edit.php?control=' .$control. '" method="post">';
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
				 '<li class="active">Sửa control</li>' .
				 '</ul></center>';
		}
	}
	else echo '<div class="alert alert-dismissible alert-danger"><strong>Lỗi:</strong> Bạn không có quyền vào trang này</div>';
	require('../incf/foot.php');
?>