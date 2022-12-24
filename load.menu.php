<?php

$CSS_SIDEBAR = '';

if(isset($SIDEBAR_CSS[$sess_ref_type]))

	$CSS_SIDEBAR = $SIDEBAR_CSS[$sess_ref_type];

?>



<div class="app-sidebar sidebar-shadow<?php echo $CSS_SIDEBAR; ?>">

  <div class="app-header__logo">

    <div class="logo-src"></div>

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

    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav"> <span class="btn-icon-wrapper"> <i class="fa fa-ellipsis-v fa-w-6"></i> </span> </button>

    </span> </div>

  <div class="scrollbar-sidebar">

    <div class="app-sidebar__inner"> <br />

      <ul class="vertical-nav-menu">

        <?php 

            //active class = mm-active;

			//DFA($MENU_ARR);

			if($sess_user_level == 2){

				unset($MENU_ARR[2]);

				unset($MENU_ARR[3]);

			} else if(in_array($sess_user_level, array(3,7))){

				unset($MENU_ARR[2]);
				if($sess_user_level == 7){
				unset($MENU_ARR[3]['SUB_MENU'][0]);				

				unset($MENU_ARR[3]['SUB_MENU'][1]);					

				unset($MENU_ARR[3]['SUB_MENU'][2]);					

				unset($MENU_ARR[3]['SUB_MENU'][3]);					

				unset($MENU_ARR[3]['SUB_MENU'][4]);					

				unset($MENU_ARR[3]['SUB_MENU'][5]);	
				
				unset($MENU_ARR[3]['SUB_MENU'][6]);		
				
				unset($MENU_ARR[3]['SUB_MENU'][7]);		
										
				} else {
				unset($MENU_ARR[3]);				
				}

				//unset($MENU_ARR[1]['SUB_MENU'][0]);				

				unset($MENU_ARR[1]['SUB_MENU'][1]);				

			} else if($sess_user_level == 5){

				unset($MENU_ARR[3]);	

				//unset($MENU_ARR[1]['SUB_MENU'][0]);				

				unset($MENU_ARR[1]['SUB_MENU'][1]);					

				unset($MENU_ARR[1]['SUB_MENU'][2]);					

				//unset($MENU_ARR[1]);				

			} else if(in_array($sess_user_level, array(4,8))){

				//unset($MENU_ARR[3]);				

				//unset($MENU_ARR[1]['SUB_MENU'][0]);				

				unset($MENU_ARR[1]['SUB_MENU'][1]);					

				unset($MENU_ARR[1]['SUB_MENU'][2]);					



				unset($MENU_ARR[3]['SUB_MENU'][0]);				

				unset($MENU_ARR[3]['SUB_MENU'][1]);					

				unset($MENU_ARR[3]['SUB_MENU'][2]);					

				unset($MENU_ARR[3]['SUB_MENU'][3]);					

				unset($MENU_ARR[3]['SUB_MENU'][4]);					

				unset($MENU_ARR[3]['SUB_MENU'][5]);		
				
				unset($MENU_ARR[3]['SUB_MENU'][7]);		
				
				unset($MENU_ARR[3]['SUB_MENU'][8]);					

			} else if($sess_user_level == 6){

				unset($MENU_ARR[3]['SUB_MENU'][0]);				

				unset($MENU_ARR[3]['SUB_MENU'][1]);					

				unset($MENU_ARR[3]['SUB_MENU'][2]);					

				unset($MENU_ARR[3]['SUB_MENU'][3]);					

				unset($MENU_ARR[3]['SUB_MENU'][4]);					

				unset($MENU_ARR[3]['SUB_MENU'][5]);		
				
				unset($MENU_ARR[3]['SUB_MENU'][6]);	
				
				unset($MENU_ARR[3]);						

				//unset($MENU_ARR[1]['SUB_MENU'][0]);				

				//unset($MENU_ARR[1]['SUB_MENU'][1]);				

			}



			foreach($MENU_ARR as $mKEY=>$mVALUE)

			{

				echo '<li class="app-sidebar__heading">'.$mVALUE['TEXT'].'</li>';

				if($mVALUE['IS_SUB']=='Y' && !empty($mVALUE['SUB_MENU']) && count($mVALUE['SUB_MENU']))

				{

					foreach($mVALUE['SUB_MENU'] as $sKEY=>$sVALUE)

					{

						$drop = ($sVALUE['IS_SUB']=='Y' && !empty($sVALUE['MENU']) && count($sVALUE['MENU']))?'<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>':'';

						

						$active = GetActiveLink(basename($_SERVER['SCRIPT_FILENAME']),$sVALUE);

						//$active = (basename($_SERVER['SCRIPT_FILENAME'])==$sVALUE['HREF'])?' class="mm-active"':'';

						$sVALUE['HREF'] = (!empty($sVALUE['HREF']))?$sVALUE['HREF']:'underconstruction.php';



						echo '<li'.$active.'>';

						echo '<a href="'.$sVALUE['HREF'].'"> <i class="metismenu-icon '.$sVALUE['ICON'].'"></i> '.$sVALUE['TEXT'].' '.$drop.'</a>';

						

						if($sVALUE['IS_SUB']=='Y' && !empty($sVALUE['MENU']) && count($sVALUE['MENU']))

						{

							echo '<ul>';

							foreach($sVALUE['MENU'] as $sKEY2=>$sVALUE2)

							{

								$active2 = GetActiveLink(basename($_SERVER['SCRIPT_FILENAME']),$sVALUE2);

								//$active2 = (basename($_SERVER['SCRIPT_FILENAME'])==$sVALUE2['HREF'])?' class="mm-active"':'';

							

								echo '<li> <a href="'.$sVALUE2['HREF'].'"'.$active2.'> <i class="metismenu-icon"> </i>'.$sVALUE2['TEXT'].'</a> </li>';

							}

							echo '</ul>';

						}

						

						echo '</li>';

					}

				}

			}

            ?>

      </ul>

    </div>

  </div>

</div>

<div class="mobile-name">

  <div class="designation"> <i class="fa fa-business-time <?php echo (isset($HEADER_ICON_ARR[$sess_ref_type]))?$HEADER_ICON_ARR[$sess_ref_type]:'fa-user'; ?>"></i> <?php echo (isset($HEADER_HEADING_ARR[$sess_ref_type]))?$HEADER_HEADING_ARR[$sess_ref_type]:''; ?> </div>

  <div class="name"><?php echo $sess_user_name; ?></div>

  <div class="clear"></div>

</div>

