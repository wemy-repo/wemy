<?php
    /*
     *
     * @ Cydia Source Create
     *
     * @ DEB file Upload
	 * @ Lib   : Kevin Waterson
     * @ Author: Tí Nhí Nhố (tonghoai)
     *
     *
     *
     * @ Vui lòng không chỉnh sửa bản quyền
     *
     */

	include('../incf/db.php');
	require('../incf/head.php');

	if(isset($_SESSION['username']) && isset($_SESSION['password'])){
		if(isset($_POST['submit'])){
			if(empty($_POST['origin']) || empty($_POST['label']) || empty($_POST['version']) || empty($_POST['codename']) || empty($_POST['descriptoion'])){
			    echo '<div class="alert alert-dismissible alert-danger"><strong>Lỗi:</strong> Bạn không được bỏ trống bất kì ô nào</div>';
		    }
			else{
		        $origin       = $_POST['origin'];
		        $label        = $_POST['label'];
		        $version      = $_POST['version'];
		        $codename     = $_POST['codename'];
		        $descriptoion = $_POST['descriptoion'];
                $trang_o = fopen("../Release","w+");
                fwrite($trang_o, "Origin: " .$origin. "\n");
			    fwrite($trang_o, "Label: " .$label. "\n");
			    fwrite($trang_o, "Suite: stable\n");
			    fwrite($trang_o, "Version: " .$version. "\n");
			    fwrite($trang_o, "Codename: " .$codename. "\n");
			    fwrite($trang_o, "Architectures: iphoneos-arm\n");
			    fwrite($trang_o, "Components: main\n");
			    fwrite($trang_o, "Descriptoion: " .$descriptoion. "\n");
                fclose($trang_o);
			    echo '<div class="alert alert-dismissible alert-success">Đã cập nhật Release nguồn của bạn!</div>';
				echo '<center><ul class="breadcrumb">' .
					 '<li><a href="../admin/index.php">Admin CP</a></li>' .
					 '<li class="active">Release</li>' .
					 '</ul></center>';
				require('../incf/foot.php');
				exit;
		    }
	  	}
		
		
		echo '<div class="alert alert-dismissible alert-info"><strong>Tip:</strong> Chỉ nhập vào các ô Origin, Label, Version, Codename, Descriptoion để đặt thông tin cho file Release.</div>';
		echo '<form enctype="multipart/form-data" action="./release.php" method="post">' .
			 '<div class="form-group"><label class="control-label" for="inputDefault">Origin</label><input class="form-control" id="inputDefault" type="text" name="origin"/></div>' .
			 '<div class="form-group"><label class="control-label" for="inputDefault">Label</label><input class="form-control" id="inputDefault" type="text" name="label"/></div>' .
			 '<div class="form-group"><label class="control-label" for="disabledInput">Suite</label><input disabled="" class="form-control" id="disabledInput" type="text" value="stable"/></div>' .
			 '<div class="form-group"><label class="control-label" for="inputDefault">Codename</label><input class="form-control" id="inputDefault" type="text" name="codename"/></div>' .
			 '<div class="form-group"><label class="control-label" for="disabledInput">Architectures</label><input disabled="" class="form-control" id="disabledInput" type="text" value="iphoneos-arm"/></div>' .
			 '<div class="form-group"><label class="control-label" for="disabledInput">Components</label><input disabled="" class="form-control" id="disabledInput" type="text" value="main"/></div>' .
			 '<div class="form-group"><label class="control-label" for="inputDefault">Descriptoion</label><input class="form-control" id="inputDefault" type="text" name="descriptoion"/></div>' .
			 '<div class="form-group"><label class="control-label" for="inputDefault">Version</label><input class="form-control" id="inputDefault" type="text" name="version"/></div>' .
			 '<div class="form-group"><center><input class="btn btn-success" type="submit" name="submit" value="Hoàn Thành" /></center></div>';
		echo '<center><ul class="breadcrumb">' .
			 '<li><a href="../admin/index.php">Admin CP</a></li>' .
			 '<li class="active">Release</li>' .
			 '</ul></center>';
	}
	else echo '<div class="alert alert-dismissible alert-danger"><strong>Lỗi:</strong> Bạn không có quyền vào trang này</div>';
	require('../incf/foot.php');
?>