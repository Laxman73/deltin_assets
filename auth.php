<?php

//print_r($_POST);

$NO_PRELOAD = $NO_REDIRECT = '1';

require_once('includes/common.php');

require_once('includes/ti-salt.php');

include("includes/recaptchalib.php");



/*$secret = "6LeULAgbAAAAANCpGnhyhdopqY2RFkh4VV-dfCLE";

$response = null;

$reCaptcha = new ReCaptcha($secret);

if($_POST["g-recaptcha-response"]) {

    $response = $reCaptcha->verifyResponse(

        $_SERVER["REMOTE_ADDR"],

        $_POST["g-recaptcha-response"]

    );

}*/



//if($response != null && $response->success)  

if(true)

{

	if($_SERVER['REQUEST_METHOD']=="POST")

	{	

		####################################################################################

		// First, make sure the form was posted from a browser.

		// For basic web-forms, we don't care about anything  other than requests from a browser:    

		if(!isset($_SERVER['HTTP_USER_AGENT']))

			ForceOut(5);

		

		// Make sure the form was indeed POST'ed: (requires your html form to use: action="post") 

		if(!$_SERVER['REQUEST_METHOD'] == "POST")

			ForceOut(5);

	

		#########################################################################################  

		if(isset($_POST["txtusername"]) && isset($_POST["txtpassword"])) // && isset($_POST["btnlogin"]))

		{	

			$username = db_input($_POST["txtusername"]);

			$txtpassword = htmlspecialchars_decode(db_input($_POST["txtpassword"]));		

	

			// $salt_obj = new SaltIT;

			// $txtpassword = $salt_obj->EnCode($txtpassword);

	

			$ret=0; //error flag

	

			if($txtpassword=='')   

				ForceOut(8);

			elseif($username=='')   

				ForceOut(7);

			else

			{

				$u_id = $u_level = 0;

				// $q = "select iUserID, vName, vPassword, vPic, iLevel, cRefType, iRefID from users where vUName='".$username."' and cStatus='A' ";

				$q = "select iUserID, vName, vPassword,iLevel from users where vUName='$username' and cStatus='A'"; //  and iLocID in (0, $cmblocid) and iLevel!=$USER_LEVEL_STAFF

				$r = sql_query($q, 'AUTH.61');

				if(sql_num_rows($r))

				{

					list($u_id, $u_name, $u_pass, $u_level) = sql_fetch_row($r);

					$ret = ($u_pass==($txtpassword))? 1: -1;	// 1 - txtpassword Matches ::  -1 - txtpassword MisMatch

					// echo $u_pass.'<br>'.$txtpassword;

					// exit;

					// if($ref_type=='A') $ref_id = $u_id;

				}

				else

					$ret=-2;	//No User Found

	

				if($ret == -1 || $ret == -2)

				{

					ForceOut(4);	

				}

				elseif($ret == 1)

				{			

					session_destroy();

					session_start();

					session_regenerate_id();

					${PROJ_SESSION_ID} = new userdat;

					

					$randomtoken = base64_encode(uniqid(rand(), true));

					

					$_SESSION[PROJ_SESSION_ID] = new userdat;

					$_SESSION[PROJ_SESSION_ID]->log_time = NOW2;	

					$_SESSION[PROJ_SESSION_ID]->log_stat = "A";	

					$_SESSION[PROJ_SESSION_ID]->user_id = $u_id;	

					$_SESSION[PROJ_SESSION_ID]->user_pic = '';//$u_pic;	

					$_SESSION[PROJ_SESSION_ID]->user_name = $u_name;	

					$_SESSION[PROJ_SESSION_ID]->user_level = $u_level;

					$_SESSION[PROJ_SESSION_ID]->user_reftype = '';//$ref_type;

					$_SESSION[PROJ_SESSION_ID]->loc_id = '';//$ref_id;

					$_SESSION[PROJ_SESSION_ID]->sess = session_id();

					$_SESSION[PROJ_SESSION_ID]->rmadr = $_SERVER['REMOTE_ADDR'];

					$_SESSION[PROJ_SESSION_ID]->lhs_menu = true;

					$_SESSION[PROJ_SESSION_ID]->sess_token = $randomtoken;

					$_SESSION[PROJ_SESSION_ID]->sess_active = 'Y';

	

					// $q = "update users set dtLastLogin='".NOW."', vLastLoginIP='".$_SERVER['REMOTE_ADDR']."', vToken='$randomtoken', cActive='Y' where iUserID=$u_id";

					$q = "update users set dtLastLogin='".NOW."' where iUserID=$u_id";

					$r = sql_query($q, 'AUTH.78');

					

					$browser = '';

					$browser2 = getBrowser();

					if(!empty($browser2) && count($browser2))

						$browser = $browser2['name'].' '.$browser2['version'];



					$ipaddress = $_SERVER['REMOTE_ADDR'];
					$browser = $_SERVER['HTTP_USER_AGENT'];

					$ip = $_SERVER['REMOTE_ADDR'];
					// sql_query("insert into log_signin (dDate, cRefType, iRefID, dtEntry, vIPAddress, vBrowser, cStatus) values ('".TODAY."', '$ref_type', '$ref_id', '".NOW."', '$ipaddress', '$browser', 'A')", "");

					$ql = "insert into log_login(iUserID, dtLog, vBrowser, vIP, cType)values('$u_id', NOW(), '$browser', '$ip', 'IN')";

					$rl = sql_query($ql, "auth.88");

					header("location:".SITE_ADDRESS."home.php");

					exit;

				}

			}

		}

		else

			ForceOut(4);

	}

	else

	{

		session_destroy(); // destroy all data in session

		die("Forbidden - You are not authorized to view this page");

		exit;

	}

}

else

{

	session_destroy(); // destroy all data in session

	die("Forbidden - You are not authorized to view this page");

	exit;

}

?>