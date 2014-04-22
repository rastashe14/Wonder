<?php
     session_start();
	 
     if ($_SESSION['wspanel_user']['nombre']==''&& !strpos($_SERVER['PHP_SELF'], "form_login.php")){ 
	     echo "<META HTTP-EQUIV=\"refresh\" content=\"0; URL=form_login.php\">";
	     die();
     }
?>