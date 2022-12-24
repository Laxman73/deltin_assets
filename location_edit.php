<?php
include "includes/common.php";

$PAGE_TITLE2 = 'Location';

$PAGE_TITLE .= $PAGE_TITLE2;

$disp_url = 'location_disp.php';
$edit_url = 'location_edit.php';

if(isset($_GET['mode'])) $mode = $_GET['mode'];
elseif(isset($_POST['mode'])) $mode = $_POST['mode'];
else $mode ='A';

if(isset($_GET['id'])) $txtid = $_GET['id'];
elseif(isset($_POST['txtid'])) $txtid = $_POST['txtid'];
else $mode ='A';

if($mode=='I' || $mode=='U' || $mode=='D' || $mode=='DELPIC')
{
	$user_token = (isset($_POST['user_token']))?$_POST['user_token']:'';
	if(empty($user_token) || $user_token!=$sess_user_token)
	{
		header('location:'.$disp_url);
		exit;
	}
}

$USER_REF_ID = array();
$valid_modes = array("A", "I", "E", "U", "D", "DELPIC");
$mode = EnsureValidMode($mode, $valid_modes, "A");
if($mode=='A')
{
	$txtid ='0';
	$txtname = '';
	$txtrank = '0';
	$rdstatus = 'A';

	$modalTITLE ='New '.$PAGE_TITLE2;
	$form_mode ='I';
}
else if($mode=='I')
{
	$txtid = NextID('iLocID', 'location');
	$txtname = db_input2($_POST['txtname']);
	$txtrank = $txtid;
	$rdstatus =  db_input($_POST['rdstatus']);	

	$q = "INSERT INTO location (iLocID, vName, iRank, cStatus) VALUES ($txtid, '$txtname', '$txtrank', '$rdstatus')";
	$r = sql_query($q, "COMPANY.70");
	
	$_SESSION[PROJ_SESSION_ID]->success_info = "Location Details Successfully Inserted";
}
else if($mode=='E')
{
	$dataArr = GetDataFromID("location", "iLocID", $txtid);
	if(empty($dataArr))
	{
		header("location: $disp_url");
		exit;
	}
	
	$txtname = db_output2($dataArr[0]->vName);
	$rdstatus= db_output2($dataArr[0]->cStatus);

	$modalTITLE ='Edit '.$PAGE_TITLE2;
	$form_mode ='U';
}
else if($mode=='U')
{
	$txtname = db_input2($_POST['txtname']);
	$rdstatus =  db_input($_POST['rdstatus']);	

	$values = " vName='$txtname', cStatus='$rdstatus' ";
	$QUERY = UpdataData('location',$values, "iLocID=$txtid");
	$_SESSION[PROJ_SESSION_ID]->success_info = "Location Details Successfully Updated";
}
elseif($mode=='D')
{
	$chk_arr = array();
	$loc_str = $edit_url.'?mode=E&id='.$txtid;

	$chk_arr['Property'] = GetCounts('property', " and iLocID=$txtid");

	$chk = array_sum($chk_arr);

	if(!$chk)
	{
		DeleteData('location', 'iLocID', $txtid);
		$_SESSION[PROJ_SESSION_ID]->success_info = "Location Deleted Successfully";
		$loc_str = $disp_url;
	}
	else
	{
		$_SESSION[PROJ_SESSION_ID]->alert_info = "Location Could Not Be Deleted Because of Existing ".(CHK_ARR2Str($chk_arr))." Dependencies";
	}
	
	header("location: $loc_str");
	exit;
}

if($mode == "I" || $mode == "U")
{
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
        <div class="row col-md-6">
          <div class="main-card mb-3 card col-md-12">
            <div class="card-header-tab card-header">
              <div class="card-header-title font-size-lg text-capitalize font-weight-normal"> <i class="header-icon pe-7s-map-marker mr-3 text-muted opacity-6"> </i><?php echo $modalTITLE; ?> </div>
            </div>
            <div class="card-body">
              <form class="" id="dsgFrom" name="dsgFrom" method="post" action="<?php echo $edit_url; ?>" enctype="multipart/form-data">
                <input type="hidden" name="txtid" id="txtid" value="<?php echo $txtid; ?>">
                <input type="hidden" name="mode" id="mode" value="<?php echo $form_mode; ?>">
                <input type="hidden" name="add_mode" id="add_mode" value="N">
                <input type="hidden" name="user_token" id="user_token" value="<?php echo $sess_user_token; ?>">
                <div class="col-md-12">
                  <div class="form-row">
                    <div class="col-md-12">
                      <div class="position-relative form-group">
                        <label for="txtname" class="">Name <span class="text-danger">*</span></label>
                        <input name="txtname" id="txtname" type="text" value="<?php echo $txtname; ?>" class="form-control">
                      </div>
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
                  	<button type="button" onClick="SubmitIncludeForm('<?php echo $edit_url; ?>','D','<?php echo $txtid; ?>','Location');" class="mt-2 btn btn-danger">Delete</button>
                  <?php
										}
									?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer Comes Here -->
      <?php include "load.footer.php"; ?>
      <!-- Footer End -->
    </div>
  </div>
</div>
<div class="app-drawer-overlay d-none animated fadeIn"></div>
<?php include "load.scripts.php"; ?>
<script type="text/javascript" src="../scripts/ajax.js"></script>
<script type="text/javascript" src="../scripts/common.js"></script>
<script type="text/javascript" src="../scripts/md5.js"></script>
<script type="text/javascript">
//form validation
$( document ).ready(function() {
	$("#dsgFrom").submit( function() {
		err = 0;
		err_arr = new Array();
		ret_val = true;

		var md = "<?php echo $mode ?>";
		var txtname = $(this).find('#txtname');

		if($.trim(txtname.val()) == 0 || $.trim(txtname.val()) == '') {
			ShowError( txtname, "Please enter name");
			err_arr[err] = txtname;
			err ++;
		}
		else
			HideError(txtname);

		if(err > 0) {
			err_arr[0].focus();
			ret_val = false;
		}

		return ret_val;
	});
});
</script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files 
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>-->
</body>
</html>
