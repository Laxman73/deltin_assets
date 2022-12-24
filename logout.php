<?php

	require_once('includes/common.php');

	require_once("includes/userdat.php");

	

	// UpdateField('users', 'cActive', 'N', " iUserID=$sess_user_id");//setting active status to N;

	$browser = $_SERVER['HTTP_USER_AGENT'];

	$ip = $_SERVER['REMOTE_ADDR'];

	$ql = "insert into log_login(iUserID, dtLog, vBrowser, vIP, cType)values('$sess_user_id', NOW(), '$browser', '$ip', 'OUT')";

	$rl = sql_query($ql, "auth.88");

	session_destroy();

	

	header('location:index.php');

?>