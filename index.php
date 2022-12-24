<?php
$NO_REDIRECT = 1;
include 'includes/common.php';
$done ='';

if(isset($_GET['err']) && is_numeric($_GET['err']))
{
    $done = $_GET['err'];
}

/*$link = "0";
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "1";
	
if(empty($link))
{
	header('location:https://www.imacares.in/ctrl');
	exit;
}

if(strpos($_SERVER['HTTP_HOST'],'www')===false)
{
	header('location:https://www.imacares.in/ctrl');
	exit;
}*/
?>
<!doctype html>
<html lang="en">
<head>
<meta name="googlebot" content="noindex,nofollow,noarchive,nosnippet,noodp" />
<meta name="robots" content="noindex,nofollow,noarchive,nosnippet,noodp" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Language" content="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo SITE_NAME ?> | Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
<link href="dist/assets/css/base.min.css" rel="stylesheet">
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow">
  <div class="app-container">
    <div class="h-100">
      <div class="h-100 no-gutters row">
        <div class="d-none d-lg-block col-lg-4">
          <div class="slider-light">
            <div class="slick-slider">
              <div>
                <div class="position-relative h-100 d-flex justify-content-center align-items-center" tabindex="-1">
                  <div class="slide-img-bg" style="background-image: url('images/sidebar.jpg');"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="h-100 d-flex bg-dark justify-content-center align-items-center col-md-12 col-lg-8">
          <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
            <div class="app-logo" style="background-image: url('assets/img/deltin.png');  background-repeat: no-repeat; width: 100%;"></div>
            <div id="LBL_INFO"></div>
            <h3 class="d-block text-white">Surveillance Control Panel</h3>
            <span class="text-white">Please sign in to your account.</span>
            <div class="divider row"></div>
            <div>
              <form class="" id="login" method="post" action="auth.php">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="position-relative form-group">
                      <label for="exampleEmail" class="text-white">Username</label>
                      <input name="txtusername" id="txtusername" placeholder="Username here..." type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="position-relative form-group">
                      <label for="examplePassword" class="text-white">Password</label>
                      <input name="txtpassword" id="txtpassword" placeholder="Password here..." type="password" class="form-control">
                    </div>
                  </div>
                </div>
                <!--div class="form-row">
                  <div class="recaptcha_holder">
                    <div id="recaptcha" class="g-recaptcha" data-sitekey="6LeULAgbAAAAAKQ16M9NJfsGssfdvVyM5Rk4HkBC" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                  </div>
                </div-->
                <!-- <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Keep me logged in</label></div> -->
                <div class="divider row"></div>
                <div class="d-flex align-items-center">
                  <div class="ml-auto">
                    <!-- <a href="javascript:void(0);" class="btn-lg btn btn-link">Recover Password</a> -->
                    <button type="submit" class="btn btn-warning btn-lg text-white">Login to Dashboard</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="text-center text-white opacity-8 mt-3">&copy; <?php echo date('Y') ?> Deltin Group</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
<script type="text/javascript" src="scripts/jquery-3.4.1.js"></script>
<?php //include "scripts.php"; ?>
<!-- <script type="text/javascript" src="./assets/scripts/main.8d288f825d8dffbbe55e.js"></script> -->
<!-- <script type="text/javascript" src="src/app.js"></script> -->
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/md5.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){

	$('#txtusername').focus();
	done = "<?php echo $done; ?>";

	if(done !='')
		$('#LBL_INFO').html(NotifyThis('Invalid Username or Password','error'));

	
	$('#login').submit(function(){
		err = 0;
		ret_val = true;

		var u = $(this).find('#txtusername');
		if($.trim(u.val()) == '') {
			ShowError( u, "Username cannot be empty");
			err++;
		}

		var p = $(this).find('#txtpassword');
		if($.trim(p.val()) == '') {
			ShowError( p, "Password cannot be empty");
			err++;
		}
		
		/*var captcha = $(this).find('#recaptcha');
		var response = grecaptcha.getResponse();
		if(response.length === 0)
		{
			alert('Captcha is compulsory');
			//err++;
		}*/	

		if(err > 0)
		{
			ret_val = false;
		}
		else
		{
			p_str = hex_md5(p.val());
			p.val(p_str);
		}

		return ret_val;
	});
});
</script>
</body>
</html>