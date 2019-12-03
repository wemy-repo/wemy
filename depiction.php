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
	 
	include('./incf/db.php');
	
	/*** Gán biến GET ***/
	$deb = $_GET['deb'];

    echo '<html>' .
         '<head>' .
		 '<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8"/>'.
         '<title>Depiction</title>' .
         '<link rel="stylesheet" type="text/css" href="../themes/d-style.css"/>' .
         '<link rel="stylesheet" type="text/css" href="../themes/f-style.css"/>' .
         '<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0"/>' .
         '</head>';
		 
    echo '<body class="pinstripe">' .
         '<panel>' .
         '<fieldset style="background:#365896; clear:left; width: 300px;">' .
         '<div>' .
         '<a href="./" target="_blank"><img style="margin-top: -4px; margin-left: -5px; margin-bottom: -2px; height: 59px; width: 276px" alt="Cydia Repo" src="logo.png"></a>' .
         '</div>' .
         '</fieldset>' .
		 '<center>' .
         '</center> <fieldset style="background:#DDEEFF">' .
         '<div>' .
         '<p>Kéo xuống để xem hình.</p>' .
         '</div>' .
         '</fieldset>';
	// Hiện thông tin Packages
	if(!empty($deb)){
		$trang_t = file_get_contents("./depiction/$deb");
		echo '<fieldset style="background:#FFFFFF"><div><p><div style="text-align:left">' .$trang_t. '</div></p></div></fieldset>';
	}
		 
    echo '<fieldset>' .
         '<a href="http://twitter.com/">' .
         '<img class="icon" src="images/twitter7.png"/>' .
         '<div>' .
         '<label>Follow on Twitter</label>' .
         '</div>' .
         '</a>' .
         '<a href="http://facebook.com/">' .
         '<img class="icon" src="images/facebook7.png"/>' .
         '<div>' .
         '<label>Like on Facebook</label>' .
         '</div>' .
         '</a>' .
         '</fieldset>';


?>