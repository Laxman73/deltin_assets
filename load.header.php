<?php

$CSS_HEADER = '';

if(isset($HEADER_CSS[$sess_ref_type]))

	$CSS_HEADER = $HEADER_CSS[$sess_ref_type];

	

	//bg-happy-green

?>

<?php

$cond = '';

if($sess_user_level == '2'){

	$cond .= " and (r.cStage = 'D')";

	//$cond .= " and rd.cActionTaken = 'R'";

}

if($sess_user_level == '3'){

	$cond .= " and (r.cStage = 'N')";

	//$cond .= " and rd.cActionTaken = 'R'";

}

if($sess_user_level == '7'){

	$cond .= " and (r.cStage = 'V')";

	//$cond .= " and rd.cActionTaken = 'R'";

}

if($sess_user_level == '4' || $sess_user_level == '8'){

	$cond .= " and r.cStage = 'R'";

}

$_tq = "select * from log_report lr join report r on lr.iReportID = r.iReportID join report_dept rd on lr.iReportID = rd.iReportID where lr.cRefType IN ('COM','SB') and lr.iRefID = '$sess_user_id' and (lr.vDesc <> '' or lr.vDesc <> NULL)  $cond group by lr.iLogID, lr.iRefID order by lr.dtLog DESC limit 5";
//echo "<p>".$_tq."</p>";
$_tr = sql_query($_tq, "load.header.14");

$task_arr = array();

$task_count = sql_num_rows($_tr);

if($task_count)

{

  	while($row = sql_fetch_assoc($_tr))

	{

    	$task_arr[] = $row;

	}

}

?>
<style>
.bg-orange{
	background-color: #f74f24
}
</style>
<div class="app-header header-shadow <?php echo $CSS_HEADER; ?> mobile-ima-logo">

  <div class="app-header__logo">

    <div class="logo-src" onclick="window.location.href='home.php'" style="cursor:pointer; background-image: url('assets/img/deltin-logo.png'); background-size: contain;

background-repeat: no-repeat; height: 39px; width: 133px;"></div>

    <div class="header__pane ml-auto">

      <div>

        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar"> <span class="hamburger-box"> <span class="hamburger-inner"></span> </span> </button>

      </div>

    </div>

  </div>

  <div class="app-header__mobile-menu">

    <div>

      <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"> <span class="hamburger-box"> <span class="hamburger-inner"></span> </span> </button>

    </div>

  </div>

  <div class="app-header__menu"> <span>

    <div class="d-inline-block dropdown">

      <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn-shadow dropdown-toggle btn btn-info"> </button>

      <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute !important; min-width: 300px !important; top: 30px !important; left: -260px !important;">

        <ul class="nav flex-column">

          <li class="nav-item"> <a href="logout.php" class="badge badge-info"> Logout </a> </li>

        </ul>

      </div>

    </div>

    </span> </div>

  <!--<div class="app-header__menu"> <span>

    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav"> <span class="btn-icon-wrapper"> <i class="fa fa-ellipsis-v fa-w-6"></i> </span> </button>

    </span> </div>-->

  <div class="app-header__content">

    <?php if(isset($HEADER_HEADING_ARR[$sess_ref_type])) echo '<div class="app-header-left"><ul class="header-megamenu nav"><li class="nav-item"><a href="javascript:void(0);" class="nav-link"><strong>'.strtoupper($HEADER_HEADING_ARR[$sess_ref_type]).'</strong></a></li></ul></div>'; ?>

    <div class="app-header-right">

	<!-- NOTIFICATION AREA -->

                    <div class="dropdown" <?php echo (in_array($sess_user_level, array(1,5,6)))?'style="display:none;"':'' ?>>

                        <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="p-0 mr-2 btn btn-link">

                            <span class="icon-wrapper icon-wrapper-alt rounded-circle" style="margin:0;width:44px;height:44px;text-align:center;overflow:visible;">

                                <span class="icon-wrapper-bg bg-danger"></span>

                                <i class="icon text-danger ion-android-notifications"></i>

                                <?php

                                if(!empty($task_arr)){

                                ?>  

                                <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span>

                                <?php

                                }

                                ?>

                            </span>

                        </button>

                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">

                            <div class="dropdown-menu-header mb-0">

                                <div class="dropdown-menu-header-inner bg-deep-blue">

                                    <div class="menu-header-image opacity-1" style="background-image: url('../assets/images/dropdown-header/city3.jpg');"></div>

                                    <div class="menu-header-content text-dark">

                                        <h5 class="menu-header-title">Notifications</h5>

                                        <h6 class="menu-header-subtitle">You have <b><?php echo count($task_arr) ?></b> notifications</h6>

                                    </div>

                                </div>

                            </div>

                            <div class="tab-content">

                                <div class="tab-pane active" id="tab-messages-header" role="tabpanel">

                                <?php

                                  if(!empty($task_arr)){

                                ?>

                                    <div class="scroll-area-sm">

                                        <div class="scrollbar-container">

                                            <div class="p-3">

                                                <div class="notifications-box">

                                                    <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">

                                                    <?php

                                                        for($t=0;$t<sizeof($task_arr);$t++){

                                                            $dot = "dot-warning";

                                                            $badge = "badge-warning";

                                                            if(date('Y-m-d H:i:s') > $task_arr[$t]['dtLog']){

                                                                $dot = "dot-danger";

                                                                $badge = "badge-danger";

                                                            }
															
															$prefix = '';
															if($task_arr[$t]['cRefType'] == 'SB'){
																$prefix = 'Sent Back: ';
															}

                                                    ?>    

                                                        <div class="vertical-timeline-item <?php echo $dot ?> vertical-timeline-element">

                                                            <div><span class="vertical-timeline-element-icon bounce-in"></span>

                                                                <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title"><a href="report_view.php?mode=E&id=<?php echo $task_arr[$t]['iReportID'] ?>"><?php echo $task_arr[$t]['vReportCode']; ?></a> <?php echo $prefix." ".$task_arr[$t]['vDesc']; ?><span class="badge <?php echo $badge ?> ml-2"><?php echo date('d M Y', strtotime($task_arr[$t]['dtLog'])) ?></span></h4><span class="vertical-timeline-element-date"></span></div>

                                                            </div>

                                                        </div>

                                                    <?php

                                                        }

                                                    ?>    

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <?php } else { ?>

                                    <div class="scroll-area-sm">

                                        <div class="scrollbar-container">

                                            <div class="no-results pt-3 pb-0">

                                                <div class="swal2-icon swal2-success swal2-animate-success-icon">

                                                    <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>

                                                    <span class="swal2-success-line-tip"></span>

                                                    <span class="swal2-success-line-long"></span>

                                                    <div class="swal2-success-ring"></div>

                                                    <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>

                                                    <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>

                                                </div>

                                                <div class="results-subtitle">All caught up!</div>

                                                <div class="results-title">No pending notifications!</div>

                                            </div>

                                        </div>

                                    </div>

                                    <?php } ?>



                                </div>

                            </div>

                            <!--<ul class="nav flex-column">

                                <li class="nav-item-divider nav-item"></li>

                                <li class="nav-item-btn text-center nav-item">

                                    <button onclick="window.location.href='task_disp.php'" class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Calendar</button>

                                </li>

                            </ul>-->

                        </div>

                    </div>

	<!-- NOTIFICATION AREA END -->	

      <div class="d-inline-block dropdown ml-2 mobile-hide">

        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn-shadow dropdown-toggle btn btn-info"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-business-time <?php echo (isset($HEADER_ICON_ARR[$sess_ref_type]))?$HEADER_ICON_ARR[$sess_ref_type]:'fa-user'; ?>"></i> </span> <span class="nme"><?php echo $sess_user_name; ?></span></button>

        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-70px, 33px, 0px);">

          <ul class="nav flex-column">

            <li class="nav-item"> <a class="nav-link"> <?php echo $DESIGNATION_ARR[$sess_user_level]; ?> </a> </li>

		    <li class="nav-item"> <a href="change_password.php" class="badge badge-info"> Change Password </a> </li>

            <li class="nav-item"> <a href="logout.php" class="badge badge-info"> Logout </a> </li>

          </ul>

        </div>

      </div>

    </div>

  </div>

</div>