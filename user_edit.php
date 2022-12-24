<?php

include "includes/common.php";

include "includes/thumbnail.php";



$PAGE_TITLE2 = 'User';



$PAGE_TITLE .= $PAGE_TITLE2;



$disp_url = 'user_disp.php';

$edit_url = 'user_edit.php';



if(isset($_GET['mode'])) $mode = $_GET['mode'];

elseif(isset($_POST['mode'])) $mode = $_POST['mode'];

else $mode ='A';



if(isset($_GET['id'])) $txtid = $_GET['id'];

elseif(isset($_POST['txtid'])) $txtid = $_POST['txtid'];

else $mode ='A';



if($mode=='I' || $mode=='U' || $mode=='D' || $mode=='DELPIC' || $mode=='DELSIGNATURE')

{

	$user_token = (isset($_POST['user_token']))?$_POST['user_token']:'';

	if(empty($user_token) || $user_token!=$sess_user_token)

	{

		header('location:'.$disp_url);

		exit;

	}

}

$PROPERTY_ARR = GetXArrFromYID("select iPropertyID, vName from property where cStatus = 'A'",3);

$DEPT_ARR = GetXArrFromYID("select iDeptID, vName from department where cStatus = 'A' order by vName",3);

$USER_REF_ID = array();

$valid_modes = array("A", "I", "E", "U", "DELPIC", "DELSIGNATURE");

$mode = EnsureValidMode($mode, $valid_modes, "A");

if($mode=='A')

{

	$txtid ='0';

	$txtname = '';

	$txtusername = '';

	$txtpassword = '';

	$txtemail = '';

	$txtphone = '';

	$cmblevel = '';

	$cmbproperty = '';

	$cmbdepartment = '';

	$txtdtlogin = '';

	$rdstatus = 'A';



	$modalTITLE ='New '.$PAGE_TITLE2;

	$form_mode ='I';

	$code_flag = '0';

}

else if($mode=='I')

{

	$txtid = NextID('iUserID', 'users');

	$txtname = db_input($_POST['txtname']);

	$txtusername = db_input($_POST['txtusername']);

	$txtpassword = htmlspecialchars_decode($_POST['txtpassword']);

	$txtemail = db_input($_POST['txtemail']);

	$txtphone = db_input($_POST['txtphone']);

	$cmblevel= db_input($_POST['cmblevel']);	

	$rdstatus =  db_input($_POST['rdstatus']);



	$cmbproperty = $_POST['cmbproperty'];

	$cmbdepartment = $_POST['cmbdepartment'];



/* 	if(!empty($cmbproperty)){



		for($i=0;$i<sizeof($cmbproperty);$i++){

			$property = $cmbproperty[$i];

			$location = GetXFromYID("select iLocID from property where iPropertyID = '$property'");

			$department = $cmbdepartment[$i];



			$qp = "insert into users_assoc(iUserID, iPropertyID, iLocationID, iDepartmentID)values('$txtid', '$property', '$location', '$department')";

			$rp = sql_query($qp, "user_edit.73");



		}





	} */





	$code_flag = IsUniqueEntry('iUserID', $txtid, 'vUName', $txtusername, 'users');

	if(!$code_flag) $txtusername = SetCode($txtname,'B');



	$q = "INSERT INTO users (iUserID, vName, vUName, vPassword, vEmail, vPhone, iDesignation, cStatus) VALUES ($txtid, '$txtname', '$txtusername', '$txtpassword', '$txtemail', '$txtphone', '$cmblevel', '$rdstatus')";

	$r = sql_query($q, "USERS.123");

	

	$_SESSION[PROJ_SESSION_ID]->success_info = "User Details Successfully Inserted";

}

else if($mode=='E')

{

	$dataArr = GetDataFromID("users", "iUserID", $txtid);

	if(empty($dataArr))

	{

		header("location: $disp_url");

		exit;

	}

	

	$txtname = db_output2($dataArr[0]->vName);

	$txtusername = db_output2($dataArr[0]->vUName);

	$txtpassword = db_output2($dataArr[0]->vPassword);

	$txtemail = db_output2($dataArr[0]->vEmail);

	$txtphone = db_output2($dataArr[0]->vPhone);

	$cmblevel = db_output2($dataArr[0]->iDesignation);

	$rdstatus= db_output2($dataArr[0]->cStatus);



	$qp = "select iPropertyID, iDepartmentID from users_assoc where iUserID = '$txtid'";

	$rp = sql_query($qp, "user_edit.91");

/* 	if(sql_num_rows($rp)){



		while($rowp = sql_fetch_assoc($rp)){



			$cmbproperty[] = $rowp->iPropertyID;

			$cmbdepartment[] = $rowp->iDepartmentID;



		}



	} */



	$modalTITLE ='Edit '.$PAGE_TITLE2;

	$form_mode ='U';

	$code_flag = '1';

}

else if($mode=='U')

{

	$txtid = db_input($_POST['txtid']);

	$txtname = db_input($_POST['txtname']);

	$txtusername = db_input($_POST['txtusername']);

	$txtpassword = htmlspecialchars_decode($_POST['txtpassword']);

	$txtcode = db_input($_POST['txtcode']);

	$txtemail = db_input($_POST['txtemail']);

	$txtphone = db_input($_POST['txtphone']);

	$cmblevel= db_input($_POST['cmblevel']); 

	$rdstatus =  db_input($_POST['rdstatus']);

	$code_flag = IsUniqueEntry('iUserID', $txtid, 'vUName', $txtusername, 'users');

	if(!$code_flag) $txtusername = SetCode($txtname,'B');



	$pass='';

	if(!empty($txtpassword))

		$pass = " , vPassword='".$txtpassword."'";



	$values = " vName='$txtname', vUName='$txtusername', vEmail='$txtemail', vPhone='$txtphone', iDesignation='$cmblevel', cStatus='$rdstatus' ".$pass;

	$QUERY = UpdataData('users',$values, "iUserID=$txtid");

	$_SESSION[PROJ_SESSION_ID]->success_info = "User Details Successfully Updated";

}

/*elseif($mode=='DELPIC')

{

	$file_name = GetXFromYID("select vPic from users where iUserID=$txtid");

	if(!empty($file_name))

		DeleteFile($file_name, USER_UPLOAD);



	UpdateField('users', 'vPic', '', "iUserID=$txtid");

	$_SESSION[PROJ_SESSION_ID]->success_info = "Image Deleted Successfully";

	

	header("location: $edit_url?mode=E&id=$txtid");

	exit;

}

elseif($mode=='DELSIGNATURE')

{

	$file_name = GetXFromYID("select vSignature from users where iUserID=$txtid");

	if(!empty($file_name))

		DeleteFile($file_name, USER_UPLOAD);



	UpdateField('users', 'vSignature', '', "iUserID=$txtid");

	$_SESSION[PROJ_SESSION_ID]->success_info = "Signature Deleted Successfully";

	

	header("location: $edit_url?mode=E&id=$txtid");

	exit;

}*/

elseif($mode=='D')

{

	// $file_name = GetXFromYID("select vPic from users where iUserID=$txtid");

	// if(!empty($file_name))

	// 	DeleteFile($file_name, USER_UPLOAD);



	// $file_name = GetXFromYID("select vSignature from users where iUserID=$txtid");

	// if(!empty($file_name))

	// 	DeleteFile($file_name, USER_UPLOAD);



	DeleteData('users', 'iUserID', $txtid);

	$_SESSION[PROJ_SESSION_ID]->success_info = "User Deleted Successfully";

	

	header("location: $edit_url?mode=E&id=$txtid");

	exit;

}



if($mode == "I" || $mode == "U")

{

	if(is_uploaded_file($_FILES["file_pic"]["tmp_name"]))

	{

		$uploaded_pic = $_FILES["file_pic"]["name"];

		$name = basename($_FILES['file_pic']['name']);

		$file_type = $_FILES['file_pic']['type'];

		$size = $_FILES['file_pic']['size'];

		$extension = substr($name, strrpos($name, '.') + 1);



		if(IsValidFile($file_type, $extension, 'P') && $size<=3000000)

		{

			$pic_name = GetXFromYID('select vPic from users where iUserID='.$txtid);



			if(!empty($pic_name))

				DeleteFile($pic_name, USER_UPLOAD);



			if(RANDOMIZE_FILENAME==0)

			{

				$newname = NormalizeFilename($uploaded_pic); // normalize the file name

				$pic_name = $txtid. "_UserProfile".$newname;

			}

			else

				$pic_name = $txtid.'_UserProfile'.NOW3.'.'.$extension;



			$tmp_name = "TMP_". $pic_name;



			$dir = opendir(USER_UPLOAD);

			copy($_FILES["file_pic"]["tmp_name"], USER_UPLOAD.$tmp_name);

			ThumbnailImage($tmp_name,$pic_name, USER_UPLOAD, 640, 480);

			DeleteFile($tmp_name, USER_UPLOAD);

			closedir($dir);   // close the directory



			$q = "update users set vPic='$pic_name' where iUserID=$txtid"; 

			$r = sql_query($q, 'User.E.126');

		}

		else

		{

			if($size>3000000)

				$_SESSION[PROJ_SESSION_ID]->error_info = "Profile Image Could Not Be Uploaded as the File Size is greate then 3MB";

			elseif(!in_array($extension,$IMG_TYPE))

				$_SESSION[PROJ_SESSION_ID]->error_info = "Please only upload files that end in types: ".implode(',',$IMG_TYPE).". Please select a new file to upload and submit again.";

		}

	}

	

	if(is_uploaded_file($_FILES["file_signature"]["tmp_name"]))

	{

		$uploaded_pic = $_FILES["file_signature"]["name"];

		$name = basename($_FILES['file_signature']['name']);

		$file_type = $_FILES['file_signature']['type'];

		$size = $_FILES['file_signature']['size'];

		$extension = substr($name, strrpos($name, '.') + 1);



		if(IsValidFile($file_type, $extension, 'P') && $size<=3000000)

		{

			$pic_name = GetXFromYID('select vSignature from users where iUserID='.$txtid);



			if(!empty($pic_name))

				DeleteFile($pic_name, USER_UPLOAD);



			if(RANDOMIZE_FILENAME==0)

			{

				$newname = NormalizeFilename($uploaded_pic); // normalize the file name

				$pic_name = $txtid. "_UserSignature".$newname;

			}

			else

				$pic_name = $txtid.'_UserSignature'.NOW3.'.'.$extension;



			$tmp_name = "TMP_". $pic_name;



			$dir = opendir(USER_UPLOAD);

			copy($_FILES["file_signature"]["tmp_name"], USER_UPLOAD.$tmp_name);

			ThumbnailImage($tmp_name,$pic_name, USER_UPLOAD, 640, 480);

			DeleteFile($tmp_name, USER_UPLOAD);

			closedir($dir);   // close the directory



			$q = "update users set vSignature='$pic_name' where iUserID=$txtid"; 

			$r = sql_query($q, 'User.E.126');

		}

		else

		{

			if($size>3000000)

				$_SESSION[PROJ_SESSION_ID]->error_info = "Signature Image Could Not Be Uploaded as the File Size is greate then 3MB";

			elseif(!in_array($extension,$IMG_TYPE))

				$_SESSION[PROJ_SESSION_ID]->error_info = "Please only upload files that end in types: ".implode(',',$IMG_TYPE).". Please select a new file to upload and submit again.";

		}

	}



	$add_mode = (isset($_POST['add_mode']))?$_POST['add_mode']:'N';

	$loc_str = $edit_url.'?mode=E&id='.$txtid;

	if($add_mode=='Y') $loc_str = $edit_url;



	header("location: $loc_str");

	exit;

}

?>

<!doctype html>

<html lang="en">

<head>

<?php include "load.links.php"; ?>

</head>

<?php require_once("_include_form.php"); ?>

<body>

<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">

  <?php include "load.header.php"; ?>

  <?php //include "loadtheme.settings.php"; ?>

  <div class="app-main">

    <?php include "load.menu.php"?>

    <!-- load side menu: end -->

    <div class="app-main__outer">

      <div class="app-main__inner">

        <div id="LBL_INFO"><?php echo $sess_info_str; ?></div>

        <div class="row col-md-12">

          <div class="main-card mb-3 card col-md-12">

            <div class="card-header-tab card-header">

              <div class="card-header-title font-size-lg text-capitalize font-weight-normal"> <i class="header-icon pe-7s-users mr-3 text-muted opacity-6"> </i><?php echo $modalTITLE; ?> </div>

            </div>

            <div class="card-body">

              <form class="" id="usersForm" name="usersForm" method="post" action="<?php echo $edit_url; ?>" enctype="multipart/form-data">

                <input type="hidden" name="txtid" id="txtid" value="<?php echo $txtid; ?>">

                <input type="hidden" name="code_flag" id="code_flag" value="<?php echo $code_flag; ?>">

                <input type="hidden" name="mode" id="mode" value="<?php echo $form_mode; ?>">

                <input type="hidden" name="txtcode" id="txtcode" value="<?php echo $txtcode; ?>">

                <input type="hidden" name="add_mode" id="add_mode" value="N">

                <input type="hidden" name="user_token" id="user_token" value="<?php echo $sess_user_token; ?>">

                <div class="col-md-12">

                  <div class="form-row">

                    <div class="col-md-6">

                      <div class="position-relative form-group">

                        <label for="txtname" class="">Name <span class="text-danger">*</span></label>

                        <input name="txtname" id="txtname" type="text" value="<?php echo $txtname; ?>" class="form-control">

                      </div>

                    </div>

                    <div class="col-md-6">

                      <div class="position-relative form-group">

                        <label for="txtphone" class="">Phone <span class="text-danger">*</span></label>

                        <input name="txtphone" id="txtphone" type="tel" maxlength="15" onKeyPress="return numbersonly(event);" value="<?php echo $txtphone; ?>" class="form-control">

                      </div>

                    </div>

                  </div>

                  <div class="form-row">

                    <div class="col-md-6">

                      <div class="position-relative form-group">

                        <label for="txtusername" class="">Username <span class="text-danger">*</span></label>

                        <input name="txtusername" id="txtusername" onKeyUp="IsCodeUnique(<?php echo $txtid; ?>, this, 'USERS');" onBlur="IsCodeUnique(<?php echo $txtid; ?>, this, 'USERS');" type="text" value="<?php echo $txtusername; ?>" class="form-control">

                      </div>

                    </div>

                    <div class="col-md-6">

                      <div class="position-relative form-group">

                        <label for="txtpassword" class="">Password <span class="text-danger">*</span></label>

                        <input name="txtpassword" id="txtpassword"  type="password" value="" class="form-control">

                      </div>

                    </div>

                  </div>

                  <div class="form-row">

                    <div class="col-md-6">

                      <div class="position-relative form-group">

                        <label for="txtemail" class="">Email <span class="text-danger">*</span></label>

                        <input name="txtemail" id="txtemail" type="email" value="<?php echo $txtemail; ?>" class="form-control">

                      </div>

                    </div>

                    <div class="col-md-6">

                      <div class="position-relative form-group">

                        <label for="examplePassword11" class="">Designation <span class="text-danger">*</span></label>

                        <?php echo FillCombo($cmblevel, 'cmblevel', 'COMBO', '-1', $DESIGNATION_ARR, 'onchange="ShowReference(this.value);"', 'form-control'); ?> </div>

                    </div>

                  </div>

                  <div class="form-row">

                    <div class="col-md-6">

                      <div class="position-relative form-group">

                        <label for="examplePassword11" class="">Status</label>

                        <?php echo FillRadios($rdstatus, 'rdstatus', $STATUS_ARR); ?> </div>

                    </div>

                  </div>

                  <button type="button" onClick="location.href='<?php echo $disp_url; ?>?srch_mode=MEMORY';" class="mt-2 btn btn-secondary">Back</button>

                  <button type="submit" class="mt-2 btn btn-success">Save</button>

                  <button type="button" class="mt-2 btn btn-info" onClick="AddAnother(this.form);">Save & Add Another</button>

                  <?php 

										if($mode=='E' && $txtid)

										{

									?>

                  	<!-- <button type="button" onClick="SubmitIncludeForm('<?php echo $edit_url; ?>','D','<?php echo $txtid; ?>','User');" class="mt-2 btn btn-danger">Delete</button> -->

                  <?php

										}

									?>

                </div>

              </form>

            </div>

          </div>

        </div>

		<?php

		if($mode == 'E'){

		?>

        <div class="row col-md-12">

          <div class="main-card mb-3 card col-md-12">

            <div class="card-header-tab card-header">

              <div class="card-header-title font-size-lg text-capitalize font-weight-normal"> <i class="header-icon pe-7s-users mr-3 text-muted opacity-6"> </i><?php echo "Roles"; ?> </div>

            </div>

            <div class="card-body">

			<div class="form-row">

                    <div class="col-md-4">

                      <div class="position-relative form-group">

                        <label for="txtname" class="">Property <span class="text-danger">*</span></label>
						<br>
						<select name="cmbproperty[]" multiple id="cmbproperty" class="form-control multiselect">
							<option value="0">All</option>
							<?php

							if(!empty($PROPERTY_ARR)){

								foreach($PROPERTY_ARR as $pk=>$pv){

								$selected_property = '';

								if(in_array($pk, $cmbproperty)){

									$selected_property = 'selected';

								}

							?>

							<option value="<?php echo $pk ?>" <?php echo $selected_property; ?>><?php echo $pv; ?></option>

							<?php

								}

							}

							?>

						</select>

                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="position-relative form-group">

                        <label for="txtphone" class="">Department <span class="text-danger">*</span></label>

								<select name="cmbdepartment" id="cmbdepartment" class="form-control">

									<?php

									if(!empty($DEPT_ARR)){

										foreach($DEPT_ARR as $dk=>$dv){

											$selected_department = '';

											if(in_array($dk, $cmbdepartment)){

												$selected_department = 'selected';

											}

									?>

									<option value="<?php echo $dk ?>" <?php echo $selected_department; ?>><?php echo $dv; ?></option>

									<?php

										}

									}

									?>

								</select>

                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="position-relative form-group">

					  	<label style="visibility:hidden;" for="txtphone" class="">Add</label><br>

						  <button onclick="AddRole()" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>					

                      </div>

                    </div>					

                  </div>	

				  <dv class="row">

                  <div class="col-sm-12">

                    <table style="width: 100%;" id="" class="table table-hover table-striped table-bordered load-more-table">

                      <thead>

                        <tr>

                          <th width="5%">Designation</th>

                          <th>Property</th>

                          <th>Department</th>

                          <th>Actions</th>

                        </tr>

                      </thead>

                      <tbody id="roles-data">

                        <?php 

								$dataArr = GetDataFromCOND("users_assoc", " and iUserID = $txtid");

                  				if(!empty($dataArr))

                  				{

                  					for ($d=0; $d < sizeof($dataArr); $d++) 

                  					{ 

                  						$i=$d+1;

                  						$x_id =  $dataArr[$d]->iUserID;

                  						$x_prop = $dataArr[$d]->iPropertyID;

                  						$x_dept = $dataArr[$d]->iDepartmentID;



						            ?>

                        <tr>

                          <td><?php echo $DESIGNATION_ARR[$cmblevel]; ?></td>

                          <td>

							<!--<select name="cmbproperty" id="cmbproperty_<?php echo $i ?>" class="form-control">

								<?php

								if(!empty($PROPERTY_ARR)){

									foreach($PROPERTY_ARR as $pk=>$pv){

									$selected_property = '';

									if($pk == $x_prop){

										$selected_property = 'selected';

									}

								?>

								<option value="<?php echo $pk ?>" <?php echo $selected_property; ?>><?php echo $pv; ?></option>

								<?php

									}

								}

								?>

							</select>-->							  
							<?php echo ($x_prop == 0)?"All":GetXFromYID("select vName from property where iPropertyID = '$x_prop'") ?>					  
						  </td>

                          <td>

						  	<!--<select name="cmbdepartment" id="cmbdepartment_<?php echo $i ?>" class="form-control">

									<?php

									if(!empty($DEPT_ARR)){

										foreach($DEPT_ARR as $dk=>$dv){

											$selected_department = '';

											if($dk == $x_dept){

												$selected_department = 'selected';

											}

									?>

									<option value="<?php echo $dk ?>" <?php echo $selected_department; ?>><?php echo $dv; ?></option>

									<?php

										}

									}

									?>

							</select>-->		
							<?php echo GetXFromYID("select vName from department where iDeptID = '$x_dept'") ?>					  

						  </td>

                          <td><button style="display:none;" data-property="<?php echo $x_prop ?>" data-department="<?php echo $x_dept ?>" data-element="<?php echo $i ?>" class="btn btn-sm btn-primary" onclick="SaveRole(this)">Save</button> <button data-property="<?php echo $x_prop; ?>" data-department="<?php echo $x_dept; ?>" data-element="<?php echo $i ?>" class="btn btn-sm btn-danger" onclick="DeleteRole(this)">Delete</button></td>

                        </tr>

                        <?php

					                 }

				                  }

				                ?>

                      </tbody>

                    </table>

                    <?php

				              if(count($dataArr)>10)

                        echo '<a href="#" class="load_more" id="table-load-more">Load more</a>';

                    ?>

                  </div>

                </dv>				  			

            </div>

          </div>

        </div>	

		<?php

		}

		?>	

      </div>

      <!-- Footer Comes Here -->

      <?php include "load.footer.php"; ?>

      <!-- Footer End -->

    </div>

  </div>

</div>

<div class="app-drawer-overlay d-none animated fadeIn"></div>

<?php include "load.scripts.php"; ?>

<script type="text/javascript" src="scripts/ajax.js"></script>

<script type="text/javascript" src="scripts/common.js"></script>

<script type="text/javascript" src="scripts/md5.js"></script>

<script type="text/javascript">

//form validation

$( document ).ready(function() {

	$("#usersForm").submit( function() {

		err = 0;

		err_arr = new Array();

		ret_val = true;



		var md = "<?php echo $mode ?>";

		var txtname = $(this).find('#txtname');

		var txtphone = $(this).find('#txtphone');

		var cmblevel = $(this).find('#cmblevel');



		var txtusername = $(this).find('#txtusername');

		var txtpassword = $(this).find('#txtpassword');

		var txtemail = $(this).find('#txtemail');

		var code = $(this).find('#code_flag');


		if($.trim(txtname.val()) == 0 || $.trim(txtname.val()) == '') {

			ShowError( txtname, "Please enter name");

			err_arr[err] = txtname;

			err ++;

		}
		else
			HideError(txtname);



			if($.trim(cmblevel.val()) == 0 || $.trim(cmblevel.val()) == '') {

			ShowError( cmblevel, "Please select designation");

			err_arr[err] = cmblevel;

			err ++;

			} else 
			HideError(txtname);


		if($.trim(txtphone.val()) == 0 || $.trim(txtphone.val()) == '') {

			ShowError( txtphone, "Please enter phone no");

			err_arr[err] = txtphone;

			err ++;

		}

		else

			HideError(txtphone);



		if($.trim(txtusername.val()) == 0 || $.trim(txtusername.val()) == '') {

			ShowError( txtusername, "Please enter username");

			err_arr[err] = txtusername;

			err ++;

		}

		else

			HideError(txtusername);

		if($.trim(txtemail.val()) == 0 || $.trim(txtemail.val()) == '') {

			ShowError( txtemail, "Please enter email address");

			err_arr[err] = txtemail;

			err ++;

		}

		else

			HideError(txtusername);



		if(code.val()=='0' && $.trim(txtusername.val())!='')

		{

			ShowError( u, "Username already taken, <br>Please select another username")

			ret= false;

		}



		if(md!='E')

		{

			if($.trim(txtpassword.val()) == '')

			{

				ShowError(txtpassword,"Please enter password");

				err_arr[err] = txtpassword;

				err ++;

			}

			else

				HideError(txtpassword);

		}



		if(err > 0) {

			err_arr[0].focus();

			ret_val = false;

		}

		else

		{

			if($.trim(txtpassword.val()) != '')

			{

				p_str = hex_md5(txtpassword.val());//GenerateNewPass(b64_md5(txtpassword.val()));

				txtpassword.val(p_str);

			}

		}



		return ret_val;

	});

});

</script>

<!-- Latest compiled and minified CSS -->

<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">-->

<!-- Latest compiled and minified JavaScript -->

<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>-->

<!-- (Optional) Latest compiled and minified JavaScript translation files 

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>-->
        <link rel="stylesheet" href="dist/assets/css/bootstrap-multiselect.css">  
        <script src="dist/assets/js/vendors/bootstrap-multiselect.js"></script>
<script type="text/javascript">
          function MultiSelectInit()
          {
            $('.multiselect').multiselect({
              inheritClass: true,
              enableFiltering: true,
            });
          }
        $(function () {
          MultiSelectInit();
        });
/* $(function () {

    $('.selectpicker').selectpicker();

});



function SelectPicker()

{

	$('.selectpicker').selectpicker();

} */





function GetRefDetails(type)

{

	var data = 'mode=GET_REFID&type='+type;

	$.ajax({

		url: '_get_details.php',

		type: 'GET',

		data: data,

		success: function(data){

			$('#REFID_HTML').html(data);

			SelectPicker();

		},

		error: function(data) {

			alert(data.responseText); //or whatever

		}

	});

}



function AddRole(){



	property = $("#cmbproperty").val();
	properties = JSON.stringify(property);

	department = $("#cmbdepartment").val();

	user_id = '<?php echo $txtid; ?>';

	$.ajax({

		url: '_add_role.php',

		type: 'POST',

		data: {properties: properties, department: department, user_id: user_id},

		success: function(data){
			if(data == 0){

				alert("Role already exists for this user");

			} else {

			$('#roles-data').html(data);

			}

		},

	});	

}


function SaveRole(ele){

element = $(ele).data('element');

property = $("#cmbproperty_"+element).val();

department = $("#cmbdepartment_"+element).val();

old_property = $(ele).data('property');

old_department = $(ele).data('department');

user_id = '<?php echo $txtid; ?>';

$.ajax({

	url: '_update_role.php',

	type: 'POST',

	data: {property: property, department: department, user_id: user_id, old_property: old_property, old_department: old_department},

	success: function(data){
		if(data == 0){

			alert("Role already exists for this user");

		} else {

		$('#roles-data').html(data);

		}

	},

});

}



function DeleteRole(ele){

element = $(ele).data('element');

//property = $("#cmbproperty_"+element).val();

//department = $("#cmbdepartment_"+element).val();
property = $(ele).data('property');
department = $(ele).data('department');

user_id = '<?php echo $txtid; ?>';

if(confirm("Are you sure you want to delete this record?")){

$.ajax({

	url: '_delete_role.php',

	type: 'POST',

	data: {property: property, department: department, user_id: user_id},

	success: function(data){

		$('#roles-data').html(data);

	},

});

}

}

</script>

</body>

</html>

