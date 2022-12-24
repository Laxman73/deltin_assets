<?php
include "includes/common.php";
$PAGE_TITLE2 = 'Users';
$MEMORY_TAG = "USERS";

$PAGE_TITLE .= $PAGE_TITLE2;

$disp_url = 'user_disp.php';
$edit_url = 'user_edit.php';

$execute_query = $is_query = true;
$txtkeyword = $cond = $params = $params2 = '';
$cmbstatus = 'A';
$cmbdesignation = '';
$srch_style = 'display:none;';

if(isset($_POST['srch_mode']) && $_POST['srch_mode']=='SUBMIT')
{
	$txtkeyword = $_POST['txtkeyword'];
	$cmbstatus = $_POST['cmbstatus'];
	$cmbdesignation = $_POST['cmbdesignation'];

	$params = '&keyword='.$txtkeyword.'&status='.$cmbstatus.'&designation='.$cmbdesignation;
	header('location: '.$disp_url.'?srch_mode=QUERY'.$params);
}
else if(isset($_GET['srch_mode']) && $_GET['srch_mode']=='QUERY')
{
	$is_query = true;
	
	if(isset($_GET['keyword'])) $txtkeyword = $_GET['keyword'];
	if(isset($_GET['status'])) $cmbstatus = $_GET['status'];
	if(isset($_GET['designation'])) $cmbdesignation = $_GET['designation'];

	$params2 = '?keyword='.$txtkeyword;
}
else if(isset($_GET['srch_mode']) && $_GET['srch_mode']=='MEMORY')
	SearchFromMemory($MEMORY_TAG, $disp_url);

if(!empty($txtkeyword))
{
	$cond .= " and (vName LIKE '%".$txtkeyword."%' or vUName like '%".$txtkeyword."%')";
	$execute_query = true;
}
if(!empty($cmbstatus))
{
	$cond .= " and (cStatus = '".$cmbstatus."')";
	$execute_query = true;
}
if(!empty($cmbdesignation))
{
	$cond .= " and (iDesignation = '".$cmbdesignation."')";
	$execute_query = true;
}

//if($execute_query)
	//$srch_style = '';

$dataArr = GetDataFromCOND("users", $cond.' and iDesignation NOT IN (0,1) order by vName');

$_SESSION[PROJ_SESSION_ID]->srch_ctrl_arr[$MEMORY_TAG] = $_GET;
?>
<!doctype html>
<html lang="en">
<head>
<?php include "load.links.php"; ?>
<style>
table tr { display: none; }
table tr.active { display: table-row; }
</style>
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
  <?php include "load.header.php"; ?>
  <div class="app-main">
    <?php include "load.menu.php"?>
    <div class="app-main__outer">
      <div class="app-main__inner">
        <div class="app-inner-layout">
          <div id="LBL_INFO"><?php echo $sess_info_str; ?></div>
          <div class="patient-disp app-inner-layout__header-boxed p-0" id="SEARCH_RECORDS" style="<?php echo $srch_style; ?>">
            <div class="app-inner-layout__header page-title-icon-rounded text-white bg-premium-dark mb-4">
              <div class="app-page-title">
                <div class="page-title-wrapper">
                  <form class="form-inline" name="frmSearch" id="frmSearch" action="<?php echo $disp_url; ?>" method="post">
                    <input type="hidden" name="srch_mode" id="srch_mode" value="SUBMIT" />
                    <div class="wm-100 mrm-50 position-relative form-group">
                      <input type="text" name="txtkeyword" id="txtkeyword" value="<?php echo $txtkeyword; ?>" placeholder="Keywords"  class="form-control" />
                    </div>
                    <div class="wm-100 mrm-50 position-relative form-group">
                      <select name="cmbdesignation" id="cmbdesignation" class="form-control">
                        <option value="">Select Designation</option>
                        <?php
                        if(!empty($DESIGNATION_ARR)){
                          foreach($DESIGNATION_ARR as $key=>$val){
                            $selected_designation = '';
                            if($key == $cmbdesignation){
                              $selected_designation = 'selected';
                            }
                        ?>
                        <option value="<?php echo $key ?>" <?php echo $selected_designation ?>><?php echo $val ?></option>

                        <?php  
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="wm-100 mrm-50 position-relative form-group">
                      <select name="cmbstatus" id="cmbstatus" class="form-control">
                        <option value="">Select Status</option>
                        <?php
                        if(!empty($STATUS_ARR)){
                          foreach($STATUS_ARR as $k=>$v){
                            $selected_status = '';
                            if($k == $cmbstatus){
                              $selected_status = 'selected';
                            }
                        ?>
                        <option value="<?php echo $k ?>" <?php echo $selected_status ?>><?php echo $v ?></option>

                        <?php  
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="page-title-actions">
                      <div class="d-inline-block dropdown">
                        <button type="submit" class="btn-shadow btn btn-info"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-search fa-w-20"></i> </span> Search </button>
                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger" onClick="GoToPage('<?php echo $disp_url; ?>');"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-times fa-w-20"></i> </span> Reset </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Begin Page Content Here :: -->
          <div class="card mb-3">
            <div class="card-header-tab card-header">
              <div class="card-header-title font-size-lg text-capitalize font-weight-normal"> <i class="header-icon pe-7s-users mr-3 text-muted opacity-6"> </i><?php echo $PAGE_TITLE2;  ?> </div>
              <div class="btn-actions-pane-right actions-icon-btn">
                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-alternate btn-sm" onClick="ToggleVisibility('SEARCH_RECORDS');"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-search fa-w-20"></i> </span> Search </button>
                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info btn-sm" onClick="GoToPage('<?php echo $edit_url; ?>');"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-plus fa-w-20"></i> </span> Add New </button>
              </div>
            </div>
            <div class="card-body">
              <div id="usersTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                  <div class="col-sm-12 col-md-6"> </div>
                  <div class="col-sm-12 col-md-6">
                    <div id="usersTable_filter" class="dataTables_filter">
                      <label>Search:
                      <input type="search" class="form-control form-control-sm" id="userSearch" placeholder="" aria-controls="usersTable">
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <table style="width: 100%;" id="usersTable" class="table table-hover table-striped table-bordered load-more-table">
                      <thead>
                        <tr>
                          <th width="5%">#</th>
                          <th>Name</th>
                          <th>Property</th>
                          <th>Department</th>
                          <th>Designation</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                  				if(!empty($dataArr))
                  				{
                  					for ($u=0; $u < sizeof($dataArr); $u++) 
                  					{ 
                  						$i=$u+1;
                  						$x_id =  !empty($dataArr[$u]->iUserID)?db_output($dataArr[$u]->iUserID):'- Na -';
                  						$x_name = !empty($dataArr[$u]->vName)?db_output($dataArr[$u]->vName):'- Na -';
                  						$x_email = !empty($dataArr[$u]->vEmail)?db_output($dataArr[$u]->vEmail):'- Na -';
                  						$x_phone =  !empty($dataArr[$u]->vPhone)?db_output($dataArr[$u]->vPhone):'- Na -';
                  						$x_level =  $dataArr[$u]->iDesignation;
                  						$dt_login =  $dataArr[$u]->dtLastLogin;
                  						$stat = $dataArr[$u]->cStatus;
										
										$qd = "select iDepartmentID from users_assoc where iUserID = '$x_id'";
										$rd = sql_query($qd, "user_disp.188");
										
										if(sql_num_rows($rd)){
										$dept_arr1 = array();	
										$dept_str = '';
											while($rowd = sql_fetch_object($rd)){
												
												$dept_arr1[] = GetXFromYID("select vName from department where iDeptID = '$rowd->iDepartmentID'");
												
											}
											
											$dept_str = implode(",", $dept_arr1);
										}										
										
										$qp = "select iPropertyID from users_assoc where iUserID = '$x_id'";
										$rp = sql_query($qp, "user_disp.188");
										
										if(sql_num_rows($rp)){
										$prop_arr1 = array();	
										$prop_str = '';
											while($rowp = sql_fetch_object($rp)){
												
												$prop_arr1[] = GetXFromYID("select vName from property where iPropertyID = '$rowp->iPropertyID'");
												
											}
											$prop_str = implode(",", $prop_arr1);
										}
                  						
                  						$x_level_str = isset($DESIGNATION_ARR[$x_level])?$DESIGNATION_ARR[$x_level]:'- Na -';
                  						$status_str = GetStatusImageString('USERS', $stat, $x_id, true);
                  						$url = $edit_url.'?mode=E&id='.$x_id;
						            ?>
                        <tr>
                          <td><?php echo $i.'.' ?></td>
                          <td><a href="<?php echo $url; ?>"><?php echo $x_name; ?></a></td>
                          <td><?php echo $prop_str; ?></td>
                          <td><?php echo $dept_str; ?></td>
                          <td><?php echo $x_level_str; ?></td>
                          <td><?php echo $status_str; ?></td>
                        </tr>
                        <?php
					                 }
				                  }
				                ?>
                      </tbody>
                    </table>
                    <?php
				              if(count($dataArr)>50)
                        echo '<a href="#" class="load_more" id="table-load-more">Load more</a>';
                    ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-5"> </div>
                  <div class="col-sm-12 col-md-7"> </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Page Content Here :: -->
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
<script type="text/javascript">
$(document).ready(function(){
    $('#userSearch').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        $('#usersTable tbody tr').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    });
});

$('table tr:nth-child(n+1):nth-child(-n+50)').addClass('active');

$('#table-load-more').on('click', function(e)
{
	e.preventDefault();  
	var $rows = $('.load-more-table tr');
	var lastActiveIndex = $rows.filter('.active:last').index();
	$rows.filter(':lt(' + (lastActiveIndex + 10) + ')').addClass('active');
});
</script>
</body>
</html>
