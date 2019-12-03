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
	 
	/*** Thông báo lỗi nếu chưa chạy install ***/
	if(!file_exists('./incf/db.php')) {
		echo 'Please run install.php!';
		exit;
	}
	
	include('./incf/db.php');
	require('./incf/head.php');

	
	
	/*** Main ***/
	echo '<center><h3>Chào mừng các bạn đến với RepoCms.XyZ</h3></center>' .
	     '<center>Một công cụ hữu ích tạo Source Cydia cho bạn</center><br/>';
		 
	echo '<div class="list-group"><a class="list-group-item" href="#"><h4 class="list-group-item-heading"><font color="#800000">» Giới thiệu về RepoCms</font></h4><p class="list-group-item-text"> RepoCms là mã nguồn mở giúp bạn tạo một source cydia có Admin CP dễ dàng quản lý.</p></a>' .
	     '<a class="list-group-item" href="#"><h4 class="list-group-item-heading"><font color="#800000">» Hướng dẫn cài đặt RepoCms</font></h4><p class="list-group-item-text"> Tham khảo bài viết tại http://heaveniphone.com/threads/230187-huong-dan-tao-source-cydia-tren-hosting-update-v2-x-x.html</p></a>' .
		 '<a class="list-group-item" href="#"><h4 class="list-group-item-heading"><font color="#800000">» Báo Lỗi RepoCms</font></h4><p class="list-group-item-text"> Email: <font color="#800000"><b>ti.sohotmelody@live.com</b></font> hoặc SMS: <font color="#800000"><b>0984064912</b></font></p></a>' .
		 '<a class="list-group-item" href="#"><h4 class="list-group-item-heading"><font color="#800000">» Bản quyền RepoCms</font></h4><p class="list-group-item-text"> RepoCms được viết bởi <font color="#800000"><b>Tống Hoài</b></font>(tonghoai) và được cung cấp miễn phí tại RepoCms.XyZ. Khi bạn sử dụng mã nguồn này, hãy tôn trọng tác giả!</p></a></div>';

	/*** End ***/
	echo '<div class="item"><center><font color="#800000"><b>© RepoCms 2015 v2.3.2</b></font></center></div>';
	require('./incf/foot.php');
?>