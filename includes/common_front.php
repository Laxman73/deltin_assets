<?php
include "config.inc.php"; // db configurations
include "define.inc.php"; // # defines
include "generic.inc.php"; // # common functions
include "common.inc.php"; // # project specific functions
include "userdat_front.php"; // #
include "sql.inc.php"; // # sql functions
include "custom.php"; // custom functions created for this project
include "dynamic_front.inc.php"; // */

if(!$logged && $NO_REDIRECT==0)
{
	session_destroy();
	ForceOut(9);
	exit;
}

/*if($logged)
	include "access.inc.php"; // */

?>
