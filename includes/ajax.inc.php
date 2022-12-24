<?php
$NO_PRELOAD = true;
require_once("common.php");

if(isset($_POST["response"])) $response = $_POST["response"];
else if(isset($_GET["response"])) $response = $_GET["response"];
else $response = "";

$result = 'false'; //0~0~0~0";

if($response == "UNIQUE_CODE") 
{
	if(isset($_GET["id"]) && isset($_GET['val']) && isset($_GET['mode']))
	{
		$id = $_GET["id"];
		$val = trim($_GET["val"]);
		$mode = $_GET['mode'];
		
		if($mode == 'USERS')
		{  
			$pk_fld = 'iUID';
			$code_fld = 'cCode';
			$tbl = 'gen_user';
		}
		elseif($mode == 'EMPLOYEE_CODE')
		{  
			$pk_fld = 'iUserID';
			$code_fld = 'vCode';
			$tbl = 'users';
		}
		elseif($mode == 'PATIENT_MOBILE')
		{  
			$pk_fld = 'iPatInviteID';
			$code_fld = 'vMobile';
			$tbl = 'patinvite';
		}

		$flag = IsUniqueEntry($pk_fld, $id, $code_fld, $val, $tbl);
		$result = ($flag=='0')? '0': '1';
	}
}
else if($response == 'UPDATE_STATUS')
{
	if(isset($_GET["mode"]) && isset($_GET["status"]) && isset($_GET["id"]))
	{
		$mode = $_GET["mode"];
		$status = $_GET["status"];
		$id = $_GET["id"];

		$valid_modes = array('USERS', 'AREA', 'DEPARTMENT', 'DESIGNATION', 'LOCATIONS', "PROPERTY", "STAFF", "TEMPLATE");
		if(in_array($mode, $valid_modes))
		{
			$cmbreftable = $cmbreftype = $cmbrefid = '';
			$cmbreftable2 = $cmbreftype2 = $cmbrefid2 = $cmbref_fld = '';
			if($mode == 'USERS')
			{
				$pk_fld = 'iUserID';
				$tbl = 'users';
				$msg = 'User';
			}
			elseif($mode == 'AREA')
			{
				$pk_fld = 'iAreaID';
				$tbl = 'area';
				$msg = 'Area';
			}
			elseif($mode == 'DEPARTMENT')
			{
				$pk_fld = 'iDeptID';
				$tbl = 'department';
				$msg = 'Department';
			}
			elseif($mode == 'DESIGNATION')
			{
				$pk_fld = 'iDesigID';
				$tbl = 'designation';
				$msg = 'Designation';
			}
			elseif($mode == 'LOCATIONS')
			{
				$pk_fld = 'iLocID';
				$tbl = 'location';
				$msg = 'Location';
			}
			elseif($mode == 'INCIDENTS')
			{
				$pk_fld = 'iIncidentID';
				$tbl = 'incident';
				$msg = 'Incident';
			}			
			elseif($mode == 'PROPERTY')
			{
				$pk_fld = 'iPropertyID';
				$tbl = 'property';
				$msg = 'Property';
			}
			elseif($mode == 'STAFF')
			{
				$pk_fld = 'iStaffID';
				$tbl = 'staff';
				$msg = 'Staff';
			}
			elseif($mode == 'TEMPLATE')
			{
				$pk_fld = 'iTemplateID';
				$tbl = 'template';
				$msg = 'Template';
			}

			$q = "update ".$tbl." set cStatus='$status' where ".$pk_fld."=".$id;
			$r = sql_query($q, 'AJX.68');

			if(sql_affected_rows())
			{
				$str = GetStatusImageString($mode, $status, $id);
				$result = "$str~$msg Status Has Been Changed";
			}	// */
		}
	}
}
else if($response == 'UPDATE_YESNO')
{
	if(isset($_GET["mode"]) && isset($_GET["status"]) && isset($_GET["id"]))
	{
		$mode = $_GET["mode"];
		$status = $_GET["status"];
		$id = $_GET["id"];

		$valid_modes = array('PROGRAMME_TARIFF');
		if(in_array($mode, $valid_modes))
		{
			$cond = '';			
			if($mode == 'PROGRAMME_TARIFF')
			{
				$pk_fld = 'iTariffID';
				$tbl = 'tariff';
				$msg = 'Programme Tariff Package Default Value';
				$fld = 'cDefault';
			}
			
			$q = "update ".$tbl." set ".$fld."='$status' where ".$pk_fld."=".$id;
			$r = sql_query($q, 'AJX.68');
	
			if(sql_affected_rows())
			{
				$str = GetYesNoImageString($mode, $status, $id);
				$result = "$str~$msg Has Been Changed";
			}
			
			// */
		}
	}
}
else if($response=='UPDATE_SORT')
{
	if(isset($_GET["mode"]) && isset($_GET['id_str']))
	{
		$mode = $_GET["mode"];
		$id_str = $_GET['id_str'];
		$ref_id = (!empty($_GET["ref_id"]))? $_GET["ref_id"]: 0;

		$valid_modes = array('PLANES', 'MUSCLES', 'PATTERNS', 'TYPES', 'WARMUPS', 'COOLDOWNS', 'FAQ', 'MEASUREMENT');
		if(strpos($id_str,',') && in_array($mode, $valid_modes))
		{
			$qref_str = '';
			
			if($mode == 'PLANES')
			{
				$pk_fld = 'iPlaneID';
				$tbl = 'planes';
				$msg = 'Planes';
			}
			elseif($mode == 'MUSCLES')
			{
				$pk_fld = 'iMuscleID';
				$tbl = 'muscles';
				$msg = 'Muscles';
			}
			elseif($mode == 'PATTERNS')
			{
				$pk_fld = 'iPatternID';
				$tbl = 'patterns';
				$msg = 'Patterns';
			}
			elseif($mode == 'TYPES')
			{
				$pk_fld = 'iTypeID';
				$tbl = 'types';
				$msg = 'Types';
			}
			elseif($mode == 'WARMUPS')
			{
				$pk_fld = 'iWarmupID';
				$tbl = 'warmups';
				$msg = 'Warmups';
			}
			elseif($mode == 'COOLDOWNS')
			{
				$pk_fld = 'iCooldownID';
				$tbl = 'cooldowns';
				$msg = 'Cooldowns';
			}
			elseif($mode == 'FAQ')
			{
				$pk_fld = 'iFaqID';
				$tbl = 'faq';
				$msg = 'FAQ';
			}
			elseif($mode == 'MEASUREMENT')
			{
				$pk_fld = 'iMeasurementID';
				$tbl = 'gen_measurement';
				$msg = 'Measurement';
			}

			$i=0;
			$id_arr=explode(",",$id_str);

			foreach($id_arr as $id) {
				if(empty($id) || !is_numeric($id)) continue;
				
				$q = "UPDATE ".$tbl." SET iRank= '".(++$i)."' WHERE ".$pk_fld."=".$id.$qref_str;
				$r = sql_query($q, 'AJX.5086');
			}

	        // $result = 1;
	        $result = "1~$msg Order Has Been Changed.";
		}
	}
}
else if($response=='BULK_ACTION')
{
	$result = 0;
	if(isset($_GET['mode']) && !empty($_GET['id_arr']))
	{
		$mode = $_GET['mode'];
		$id_arr = $_GET['id_arr'];

		$valid_modes = array('ACTIVATE', 'DEACTIVATE');	
		if(in_array($mode, $valid_modes))
		{
			if($mode == 'ACTIVATE')
			{
				$pk_fld = 'iMemberID';
				$tbl = 'member';
				$msg = 'Member Activated';
				$status= 'A';
			}
			else if($mode == 'DEACTIVATE')
			{
				$pk_fld = 'iMemberID';
				$tbl = 'member';
				$msg = 'Member Deactivated';
				$status='I';
			}

			foreach($id_arr as $id)
			{
				if(empty($id) || !is_numeric($id)) continue;
				
				$q = "UPDATE ".$tbl." SET cStatus='".$status."' WHERE ".$pk_fld."=".$id;
				$r = sql_query($q, 'AJX.5086');

				//echo $q.'<br>';
			}

			$message = '1~~**~~'.count($id_arr)." ".$msg.'~~**~~'.'success';
		}
		else
			$message = "0~~**~~Invalid Mode".'~~**~~'.'error';
		
		$result = $message;
	}
}

else if($response=='MAILER_TEMPLATE')
{
	$result="No Template Available";

	if(isset($_GET['template']) && $_GET['template']!=0)
	{
		$template_id = $_GET['template'];

		$template_str = GetXFromYID("select vTemplate from mail_templates where iTemplateID=$template_id and cStatus='A' ");

		if(!empty($template_str))
			$result = db_output2($template_str);
	}
}

else if($response=='QUEE_MAIL')
{
	$result = "0"; // invalid mail id
	if(isset($_GET['mailid']) && is_numeric($_GET['mailid']) && $_GET['mailid']!=0 )
	{
		$txtmailid = $_GET['mailid'];

		$m = UpdateField("mail", "cStatus", "Q", "iMailID=$txtmailid");
		$dtquee = UpdateField("mail", "dtQueedate", date('Y-m-d H:i:s'), "iMailID=$txtmailid");

		if($m!=0)
			$md = UpdateField("log_email", "cStatus", "Q", "iMailID=$txtmailid");

		if($md!=0)
			$result="1"; // success
		else
			$result="2"; // failed mail could not be queed
	}
}

else if($response=='VALIDATE_MAIL_BODY')
{
	if(!empty($_GET['template']) && !empty($_GET['content']))
	{
		$templateid = $_GET['template'];
		$temp_type = GetXFromYID("select cCode from mail_templates where iTemplateID=$templateid");
		$content = db_output2($_GET['content']);

		// Validating the Member Name
		$matched = strpos($content, '##MEMBER_FNAME##');

		if(!$matched)
		  $result = '0~~**~~Member Name not Matched';

		// Validating Links Area start :: If memebr Name is found only then proceed
		if($matched)
		{
		  $sess = preg_match_all('/(?:\#\#SESSION_LINK\-)[0-9]+(?:\#\#)/', $content, $out, PREG_PATTERN_ORDER);

		  $sid_arr = array();
		  $tot_c = sizeof($out[0]);

		  if(empty($out[0]) && $temp_type!="UST")
		  	$result = '1~~**~~No Links Found';
		  else if(empty($out[0]) && $temp_type=="UST")
		  	$result = '0~~**~~No Session Links Found For Upcoming Session Template!!';

		  if(!empty($out[0]))
		  {
		    for ($i=0; $i < sizeof($out[0]); $i++) 
		    { 
		        $link =  explode("-", $out[0][$i]);

		        $result = '0~~**~~Link Place Holder Not Proper Please Check The Link Place Holder';

		        if(!empty($link[1]))
		        {
		          $link_id = str_replace("##", "", $link[1]);
		          $sid_arr[$i] = $link_id;
		        }
		    }

		    $sid_str = implode(",", $sid_arr);

		    $result = '0~~**~~Session ID Not Found For The Link!!';

		    if(!empty($sid_str))
		    {
		      $count = GetXFromYID("select count(*) from session where iSessionID in(".$sid_str.")");
		    }

		    if($count==$tot_c)
		      $result = '1~~**~~Valid Parameters Passed'; // success session id valid
		    else
		      $result = '0~~**~~Session ID Not Proper For Links';
		  }
		}

	}

}

else if($response=='EDIT_OPTION')
{
	$html = "";
	$edit_url = 'session_assesment_edit.php';

	if(isset($_GET['ans']))
	{
		$ans_id = $_GET['ans'];
		$session_id = $_GET['sessid'];


		if(is_numeric($ans_id) && $ans_id!=0)
		{
			$q = "select vAnswer, iQuesID, cRightAns from assmt_answer where iAnsID=$ans_id";
			$r = sql_query($q, "ERR.AJAX.332");

			list($txtanswer, $ques_id, $rdansstatus) = sql_fetch_row($r);

			$html .= '<form class="" id="tag_frm" method="post" action="'.$edit_url.'" enctype="multipart/form-data">
					   <input type="hidden" name="txtopid" id="txtopid" value="'.$ans_id.'">
					   <input type="hidden" name="txtid" id="txtid" value="'.$ques_id.'">
					   <input type="hidden" name="session_id" id="session_id" value="'.$session_id.'">
					   <input type="hidden" name="mode" id="mode" value="EDIT_OP">

					   <div class="form-row">
					        <div class="col-md-12">
					            <div class="position-relative form-group">
					               <label for="txtanswer" class="">Option/Answer</label>
					               <textarea name="txtanswer" id="txtanswer" class="form-control ckeditor" style="max-height: 200px; height: 150px;">'.$txtanswer.'</textarea>
					             </div>
					        </div>
					   </div>

					   <div class="form-row">
					        <div class="col-md-6">
					            <div class="position-relative form-group">
					               <label for="examplePassword11" class="">Correct Answer</label>

					               '.FillRadios($rdansstatus, 'rdansstatus', $YES_ARR).'
					             </div>
					        </div>
					   </div>

					   <button type="submit" class="mt-2 btn btn-success">Save Option</button>

					</form>';
		}
	}

	$result = $html;
}

elseif($response=='SAVE_MED_LOG_DETAILS')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && is_numeric($_POST['p_id']) && isset($_POST['date']) && !empty($_POST['date']) && IsDate($_POST['date']))
	{
		$p_id = $_POST['p_id'];
		$day = $_POST['day'];
		$date = $_POST['date'];
		$id_str = $_POST['id_str'];
	
		$SLOT_ARR = array();
		foreach($LOG_ENTRY_ARR as $TYPE)
		{
			foreach($LOG_ENTRY_TYPE_ARR as $TIME)
			{
				$VALUE = (isset($_POST['txt_'.strtolower($TYPE).'_'.$TIME]))?$_POST['txt_'.strtolower($TYPE).'_'.$TIME]:'0';
				
				if(!isset($SLOT_ARR[$TIME])) $SLOT_ARR[$TIME] = array();
				$SLOT_ARR[$TIME][$TYPE] = $VALUE;
			}
		}

		foreach($LOG_ENTRY_ARR2 as $TYPE2)
		{
			foreach($LOG_ENTRY_TYPE_ARR as $TIME)
			{
				$VALUE = (isset($_POST['chk_'.strtolower($TYPE2).'_'.$TIME]))?$_POST['chk_'.strtolower($TYPE2).'_'.$TIME]:'N';
				
				if(!isset($SLOT_ARR[$TIME])) $SLOT_ARR[$TIME] = array();
				$SLOT_ARR[$TIME][$TYPE2] = $VALUE;
			}
		}
		
		if(!empty($SLOT_ARR) && count($SLOT_ARR))
		{
			foreach($SLOT_ARR as $sKEY=>$sVALUE)
			{
				$mode = 'I'; $txtid = 0;
				if(!empty($id_str))
				{
					$id_arr = explode(',',$id_str);
					foreach($id_arr as $ids)
					{
						if(strpos($ids,$sKEY)!==false)
						{
							$mode = 'U';
							list($sKEY2,$txtid) = explode('~',$ids);
							break;
						}
					}
				}
				
				if($mode=='I')
				{
					LockTable('pat_medlog');
					$txtid = NextID('iMedLogid', 'pat_medlog');
					$q = "insert into pat_medlog (iMedLogid, iPatID, dDate, cType, dtEntry, iSession, iOxy, iTemp, iPulse, cCough, cHeadAche, cShortnessBreath, cTiredness, cChestPain, cDrowsiness, vNotes, cFlagAlert) values ($txtid, '$p_id', '$date', '$sKEY', '".NOW."', 0, '".$sVALUE['OxygenSpO2']."', '".$sVALUE['TEMPERATURE']."', '".$sVALUE['PULSE']."', '".$sVALUE['COUGH']."', '".$sVALUE['HEADACHE']."', '".$sVALUE['SHORTNESS_BREATH']."', '".$sVALUE['TIREDNESS']."', '".$sVALUE['CHEST_PAIN']."', '".$sVALUE['DROWSINESS']."', '', 'N')";
					$r = sql_query($q,'');
					UnLockTable();
				}
				else
				{
					$q = "update pat_medlog set iOxy='".$sVALUE['OxygenSpO2']."', iTemp='".$sVALUE['TEMPERATURE']."', iPulse='".$sVALUE['PULSE']."', cCough='".$sVALUE['COUGH']."', cHeadAche='".$sVALUE['HEADACHE']."', cShortnessBreath='".$sVALUE['SHORTNESS_BREATH']."', cTiredness='".$sVALUE['TIREDNESS']."', cChestPain='".$sVALUE['CHEST_PAIN']."', cDrowsiness='".$sVALUE['DROWSINESS']."' where iMedLogid='$txtid' and iPatID='$p_id' and dDate='$date' and cType='$sKEY'";
					$r = sql_query($q,'');
				}
			}
		}

		$MED_LOG = array();
		$_mq = 'select iMedLogid, dDate, cType, dtEntry, iOxy, iTemp, iPulse, cCough, cHeadAche, cShortnessBreath, cTiredness, cChestPain, cDrowsiness, vNotes, cFlagAlert from pat_medlog where iPatID='.$p_id.' and dDate="'.$date.'" order by FIELD(cType,"M","A","N")';
		$_mr = sql_query($_mq,'');
		if(sql_num_rows($_mr))
		{
			while(list($m_logid,$m_date,$m_type,$m_entry,$m_oxy,$m_temp,$m_pulse,$m_cough,$m_headache,$m_shortbreath,$m_tired,$m_chestpain,$m_drowsiness,$m_notes,$m_flag) = sql_fetch_row($_mr))
			{
				if(!isset($MED_LOG[$m_date])) $MED_LOG[$m_date] = array();
				$MED_LOG[$m_date][$m_type] = array('ENTRY'=>$m_entry, 'OxygenSpO2'=>$m_oxy, 'TEMPERATURE'=>$m_temp, 'PULSE'=>$m_pulse, 'COUGH'=>$m_cough, 'HEADACHE'=>$m_headache, 'SHORTNESS_BREATH'=>$m_shortbreath, 'TIREDNESS'=>$m_tired, 'CHEST_PAIN'=>$m_chestpain, 'DROWSINESS'=>$m_drowsiness, 'NOTES'=>htmlspecialchars_decode($m_notes), 'FLAG'=>$m_flag);
			}
		}
	
		$html = '';
		$DAY = $day.' - '.FormatDate($date,'A');
		$UPDATE = 'N';
		$html .= '<td style="text-align:center;">'.$DAY.'</td>';
		foreach($LOG_ENTRY_ARR as $TYPE)
		{
			foreach($LOG_ENTRY_TYPE_ARR as $TIME)
			{
				$DATA = ' - ';
				if(isset($MED_LOG[$date][$TIME][$TYPE]))
				{
					$DATA = $MED_LOG[$date][$TIME][$TYPE];
					$UPDATE = 'Y';
				}
				
				$STYLE = '';
				if($TIME=='N')
					 $STYLE = ' border-right-width: 3px !important;';

				$html .= '<td style="text-align:center;'.$STYLE.'">'.$DATA.'</td>';
			}										
		}
		foreach($LOG_ENTRY_ARR2 as $TYPE2)
		{
			foreach($LOG_ENTRY_TYPE_ARR as $TIME)
			{
				$DATA = ' - ';
				if(isset($MED_LOG[$date][$TIME][$TYPE2]))
				{
					$DATA = $MED_LOG[$date][$TIME][$TYPE2];
					$UPDATE = 'Y';
				}
				
				if($DATA!=' - ')
				{
					$CLASS = ($DATA=='Y')?'danger':'success';
					//$DATA = '<span class="badge badge-dot badge-dot-sm badge-'.$CLASS.'">Notifications</span>';
					$DATA = '<span class="text-'.$CLASS.'">'.$DATA.'</span>';
				}
				
				$STYLE = '';
				if($TIME=='N')
					 $STYLE = ' border-right-width: 3px !important;';

				$html .= '<td style="text-align:center;'.$STYLE.'">'.$DATA.'</td>';
			}										
		}
		
		$ACTION = '<i class="fa fa-plus" style="cursor:pointer;" onClick="GetPatientMedLogDetails(\''.$date.'\');"></i>';
		if($UPDATE=='Y') $ACTION = '<i class="fa fa-edit" style="cursor:pointer;" onClick="GetPatientMedLogDetails(\''.$date.'\');"></i>';
		$html .= '<td style="text-align:center;">'.$ACTION.'</td>';
		
		$result = '1~*~Self Health Monitoring Log Sheet Successfully Updated~*~'.$html;
	}
}

elseif($response=='SAVE_PATIENT_DOCTOR_DETAILS')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && is_numeric($_POST['p_id']) && isset($_POST['d_id']) && !empty($_POST['d_id']) && is_numeric($_POST['d_id']))
	{
		$p_id = $_POST['p_id'];
		$d_id = $_POST['d_id'];

		$q = "update patient set iDocID='$d_id' where iPatID='$p_id'";
		$r = sql_query($q,'');
		
		UpdateDoctorList($d_id);
		
		/*$allocated = GetXFromYID('select count(*) from patient where iDocID='.$d_id);
		$active = GetXFromYID('select count(*) from patient where iDocID='.$d_id.' and cStage IN ("I","H")'); //cStage NOT IN ("C","D")
		$q2 = "update doctors set iNumPat_allocated=$allocated, iNumActivePatients=$active where iDoctorID='$d_id'";
		$r2 = sql_query($q2,'');*/

		$DOCTOR = GetXfromYID('select vName from doctors where iDoctorID='.$d_id);
		$html = '<a href="javascript:void(0);" onClick="AssignDoctorToPatient();" class="mb-2 mr-2 btn btn-link monitor-shadow">Dr: '.htmlspecialchars_decode($DOCTOR).'</a>';
		
		$result = '1~*~Doctor Successfully Assigned~*~'.$html;
	}
}

elseif($response=='SEND_ADVICE_TO_RECEIVER')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && is_numeric($_POST['p_id']))
	{
		$p_id = $_POST['p_id'];
		$rdadviceto_modal = $_POST['rdadviceto_modal'];
		$txtadvice_modal = db_input($_POST['txtadvice_modal']);

		$ref_id = $p_id;
		if($rdadviceto_modal=='V') $ref_id = GetXFromYID('select iVolunteerID from patient where iPatID='.$p_id);
		elseif($rdadviceto_modal=='D') $ref_id = GetXFromYID('select iDocID from patient where iPatID='.$p_id);

		LockTable('pat_advice');
		$txtid = NextID('iPatAdviceID', 'pat_advice');
		$q = "insert into pat_advice (iPatAdviceID, iPatID, dtCreation, cSenderRefType, iSenderRefID, vAdvice, cRefType, iRefID, iRank, cStatus) values ($txtid, '$p_id', '".NOW."', '$sess_ref_type', '$sess_ref_id', '$txtadvice_modal', '$rdadviceto_modal', '$ref_id', '$txtid', 'N')";
		$r = sql_query($q,'');
		UnLockTable();
		
		$result = '1~*~Note Sent Successfully';
	}
}

elseif($response=='SEND_NOTIFICATION_TO_PATIENT')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && is_numeric($_POST['p_id']))
	{
		$p_id = $_POST['p_id'];
		$txtnotification_title = db_input($_POST['txtnotification_title']);
		$txturlname = strtolower(GetUrlName($txtnotification_title));
		$txtnotification_content = db_input($_POST['txtnotification_content']);
		$target_url = PWA_SITE_ADDRESS;

		LockTable('notifications');
		$txtid = NextID('iNID', 'notifications');
		$q = "insert into notifications values ('$txtid', '".NOW."', '$sess_ref_type', '$sess_ref_id', '$txtnotification_title', '$txturlname', '$txtnotification_content', '$target_url', '', 'P', 'S', NULL, '0', 'A')";
		$r = sql_query($q,'');
		UnLockTable();

		LockTable('notifications_dat');
		$txtid2 = NextID('iNDatID', 'notifications_dat');
		$q2 = "insert into notifications_dat values ('$txtid2', '$txtid', '".NOW."', '$p_id', '".NOW."', 'A')";
		$r2 = sql_query($q2,'');
		UnLockTable();
		
		$sender_id = GetXFromYID('select vWebPushrID from patient where iPatID='.$p_id);
		if(!empty($sender_id))
			SendWebPushrPushNotifications($txtnotification_title,$txtnotification_content,$target_url,'',$sender_id);
		
		$result = '1~*~Notification Sent Successfully to Patient';
	}
}

elseif($response=='UPDATE_PATIENT_TEST_STATUS')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && is_numeric($_POST['p_id']))
	{
		$p_id = $_POST['p_id'];
		$rdteststatus_modal = db_input($_POST['rdteststatus_modal']);

		$q = "update patient set cPositive='$rdteststatus_modal' where iPatID='$p_id'";
		$r = sql_query($q,'');
	
		LockTable('pat_statuslog');
		$txtid = NextID('iPSLogID', 'pat_statuslog');
		$text = $TEST_STATUS_ARR[$rdteststatus_modal];
		$q2 = "insert into pat_statuslog values ('$txtid', '$p_id', '".NOW."', '$sess_ref_type', '$sess_ref_id', '$rdteststatus_modal', '$text')";
		$r2 = sql_query($q2,'');
		UnLockTable();
	
		$html = '<a href="javascript:void(0);" class="mb-2 mr-2 badge badge-'.$TEST_STATUS_CSS_ARR[$rdteststatus_modal].'" onClick="GetUpdateTestStatusModal();">'.strtoupper($TEST_STATUS_ARR[$rdteststatus_modal]).'</a>';

		$result = '1~*~Patient test status successfully updated~*~'.$html;
	}
}

elseif($response=='UPDATE_PATIENT_STAGE_STATUS')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && is_numeric($_POST['p_id']) && isset($_POST['rdstagestatus_modal']) && $_POST['rdstagestatus_modal']!='')
	{
		$p_id = $_POST['p_id'];
		$rdstagestatus_modal = db_input($_POST['rdstagestatus_modal']);

		$q = "update patient set cStage='$rdstagestatus_modal' where iPatID='$p_id'";
		$r = sql_query($q,'');
	
		LockTable('pat_statuslog');
		$txtid = NextID('iPSLogID', 'pat_statuslog');
		$text = $PATIENT_STAGE_ARR[$rdstagestatus_modal];
		$q2 = "insert into pat_statuslog values ('$txtid', '$p_id', '".NOW."', '$sess_ref_type', '$sess_ref_id', '$rdstagestatus_modal', '$text')";
		$r2 = sql_query($q2,'');
		UnLockTable();
	
		$html = '<br /><a href="javascript:void(0);" class="mb-2 mr-2 badge badge-'.$PATIENT_STAGE_CSS_ARR[$rdstagestatus_modal].'" onClick="GetUpdateStageStatusModal();">'.htmlspecialchars_decode($PATIENT_STAGE_ARR[$rdstagestatus_modal]).'</a>';

		$result = '1~*~Patient stage status successfully updated~*~'.$html;
	}
}

elseif($response=='DELETE_FILE_IMPORT')
{
	if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
	{
		$id = $_GET['id'];

		$chk_arr['Patient Invite'] = GetXFromYID('select count(*) from patinvite where iFileRefID='.$id.' and dtInvite IS NOT NULL');
		$chk_arr['Patient Active'] = GetXFromYID('select count(*) from patinvite where iFileRefID='.$id.' and iPatID!=0');

		$chk = array_sum($chk_arr);
		if(!$chk)
		{
			$q = 'delete from patinvite where iFileRefID='.$id;
			$r = sql_query($q,'');

			$q3 = 'delete from sms_comm where iImportLogID='.$id;
			$r3 = sql_query($q3,'');
			
			$q2 = 'delete from sys_importlog where iImportLogID='.$id;
			$r2 = sql_query($q2,'');
			
			UpdateVolunteerList();
			
			$result = '1~File Entry Successfully Deleted';
		}
		else
			$result = '0~File Entry Details Could Not Be Deleted Because of Existing '.(CHK_ARR2Str($chk_arr)).' Dependencies';
	}
	else
		$result = '2~Invalid Access Detected';
}

elseif($response=='SAVE_PATIENT_VOLUNTEER_DETAILS')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && isset($_POST['v_id']) && !empty($_POST['v_id']) && is_numeric($_POST['v_id']))
	{
		$type = $_POST['type'];
		$p_id = $_POST['p_id'];
		$v_id = $_POST['v_id'];

		$html = '';
		$id_arr = explode(',',$p_id);
		for($i=0;$i<sizeof($id_arr);$i++)
		{
			$x_id = trim($id_arr[$i]);
			if(empty($x_id))
					continue;

			$PATIENT_NAME = $patient_mobile = $invite_otp = '';
			$v_id2 = $patient_id = $invite_id = $file_refid = 0;
			if($type=='INVITE')
			{
				$invite_id = $x_id;
				$_iq = 'select iPatID, vName, vMobile, iVolunteerID, iFileRefID, cOTP from patinvite where iPatInviteID='.$invite_id;
				$_ir = sql_query($_iq,'');
				if(sql_num_rows($_ir))
					list($patient_id,$PATIENT_NAME,$patient_mobile,$v_id2,$file_refid,$invite_otp) = sql_fetch_row($_ir);
			}
			else
			{
				$patient_id = $x_id;
				$_iq = 'select iPatInviteID, vName, vMobile, iVolunteerID, iFileRefID, cOTP from patinvite where iPatID='.$patient_id;
				$_ir = sql_query($_iq,'');
				if(sql_num_rows($_ir))
					list($invite_id,$PATIENT_NAME,$patient_mobile,$v_id2,$file_refid,$invite_otp) = sql_fetch_row($_ir);
			}
			
			//$fld = '';
			if(!empty($patient_id))
			{
				$q = "update patient set iVolunteerID='$v_id' where iPatID='$patient_id'";
				$r = sql_query($q,'');
			
				//$doc_id2 = GetXfromYID('select iDoctorID from patient where iPatID='.$patient_id);
				//if(empty($doc_id2) || $doc_id2=='-1')
				//{
					$doc_id = GetXFromYID('select iDoctorID from volunteer where iVolunteerID='.$v_id);
					if(!empty($doc_id) && $doc_id!='-1')
					{
						$q2 = "update patient set iDocID='$doc_id' where iPatID='$patient_id'";
						$r2 = sql_query($q2,'');

						UpdateDoctorList($doc_id);
						/*$allocated = GetXFromYID('select count(*) from patient where iDocID='.$doc_id);
						$active = GetXFromYID('select count(*) from patient where iDocID='.$doc_id.' and cStage IN ("I","H")'); //cStage NOT IN ("C","D")
						sql_query("update doctors set iNumPat_allocated=$allocated, iNumActivePatients=$active where iDoctorID='$doc_id'",'');*/
					}
				//}
				
				//$fld .= "iNumActivePatients=iNumActivePatients + 1, ";
			}
	
			if(!empty($invite_id))
			{
				if(empty($invite_otp)) $invite_otp = GenerateRandomCode('6','cOTP','patinvite');
			
				$q2 = "update patinvite set iVolunteerID='$v_id', cOTP='$invite_otp' where iPatInviteID='$invite_id'";
				$r2 = sql_query($q2,'');
				
				$VOLUNTEER_NAME = $VOLUNTEER_MOBILE = '';
				$_vq = 'select vName, vMobile from volunteer where iVolunteerID='.$v_id;
				$_vr = sql_query($_vq,'');
				if(sql_num_rows($_vr))
					list($VOLUNTEER_NAME,$VOLUNTEER_MOBILE) = sql_fetch_row($_vr);

				if(!empty($PATIENT_NAME) && !empty($VOLUNTEER_MOBILE))
				{
					$VOLUNTEER_NAME2 = explode(' ',trim($VOLUNTEER_NAME));
					$PATIENT_NAME2 = explode(' ',trim($PATIENT_NAME));
				
					$sms_content = $SMS_TEMPLATE['SEND_VOLUNTEER_SMS'];
					$sms_content = str_replace('{#VOLUNTEER_NAME#}',htmlspecialchars_decode($VOLUNTEER_NAME2[0]),$sms_content);
					$sms_content = str_replace('{#PATIENT_NAME#}',htmlspecialchars_decode($PATIENT_NAME2[0]),$sms_content);
					$sms_content = str_replace('{#OTHERS#}','',$sms_content);
					$template_id = $TEMPLATE_ID['SEND_VOLUNTEER_SMS'];
					$page_url = SITE_ADDRESS;
					
					if(!empty($v_id2)) $response = SendSMS($VOLUNTEER_MOBILE, $sms_content, $template_id, $page_url);
					else
					{
						sql_query("insert into sms_comm (dtEntry, iImportLogID, cRefType, iRefID, vMobile, vSMSTemplateID, vSMSContent, cStatus) values ('".NOW."', '$file_refid', 'V', '$v_id', '$VOLUNTEER_MOBILE', '$template_id', '$sms_content', 'A')");
					}
				}
				
				if(empty($v_id2))
				{
					if(!empty($PATIENT_NAME) && !empty($patient_mobile))
					{
						$PATIENT_NAME2 = explode(' ',trim($PATIENT_NAME));

						$sms_content2 = $SMS_TEMPLATE['SEND_LINK'];
						$sms_content2 = str_replace('{#name#}',htmlspecialchars_decode($PATIENT_NAME2[0]),$sms_content2);
						$sms_content2 = str_replace('{#id#}',enCodeParamSMS($invite_id),$sms_content2);
						$sms_content2 = str_replace('{#OTHERS#}','',$sms_content2);
						$template_id2 = $TEMPLATE_ID['SEND_LINK'];
						$sms_content2 = db_input($sms_content2);
						
						sql_query("insert into sms_comm (dtEntry, iImportLogID, cRefType, iRefID, vMobile, vSMSTemplateID, vSMSContent, cStatus) values ('".NOW."', '$file_refid', 'P', '$invite_id', '$patient_mobile', '$template_id2', '$sms_content2', 'A')");
					}
				}
				
				//$fld .= "iNumPat_allocated=iNumPat_allocated + 1, ";
			}
			
			if(!empty($v_id))
			{
				UpdateVolunteerList($v_id);
				/*//$fld = substr($fld,0,'-2');
				$allocated = GetXFromYID('select count(*) from patinvite where iVolunteerID='.$v_id);
				$active = GetXFromYID('select count(*) from patient where iVolunteerID='.$v_id.' and cStage IN ("I","H")'); //cStage NOT IN ("C","D")

				$q3 = "update volunteer set iNumPat_allocated='$allocated', iNumActivePatients='$active' where iVolunteerID='$v_id'";
				$r3 = sql_query($q3,'');*/
			}
			
			if(count($id_arr==1))
			{
				$VOLUNTEER = GetXfromYID('select vName from volunteer where iVolunteerID='.$v_id);
				$html = htmlspecialchars_decode($VOLUNTEER);
			}
		}
		
		if(count($id_arr>1))
			$html = 'M';
		
		$result = '1~*~Volunteer Successfully Assigned~*~'.$html;
	}
}

elseif($response=='SEND_PATIENT_INVITE')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && is_numeric($_POST['p_id']))
	{
		$p_id = $_POST['p_id'];
		
		$q = "select vName, iAge, cGender, vMobile, vTestDate, vSampleTest, iPHCID, iSCID, cOTP, iPatID from patinvite where cStatus!='X' and iPatInviteID=$p_id";
		$r = sql_query($q,'');
		list($name,$age,$gender,$mobile,$testdate,$sampletest,$phcid,$scid,$otp,$pat_id) = sql_fetch_row($r);
		$name = stripslashes($name);

		if(empty($pat_id))
		{
			if(empty($otp))
			{
				$otp = GenerateRandomCode('6','cOTP','patinvite');
				$q2 = "update patinvite set dtInvite='".NOW."', cOTP='$otp' where iPatInviteID='$p_id'";
				$r2 = sql_query($q2,'');
			}
			else
			{
				$q2 = "update patinvite set dtInvite='".NOW."' where iPatInviteID='$p_id'";
				$r2 = sql_query($q2,'');
			}
			
			$sms_content = $SMS_TEMPLATE['SEND_LINK'];
			$sms_content = str_replace('{#name#}',htmlspecialchars_decode($name),$sms_content);
			$sms_content = str_replace('{#id#}',enCodeParamSMS($p_id),$sms_content);
			//$sms_content = str_replace('{#area#}','Bardez',$sms_content);
			$sms_content = str_replace('{#OTHERS#}','',$sms_content);
			$template_id = $TEMPLATE_ID['SEND_LINK'];
			$page_url = SITE_ADDRESS;
			
			$response = SendSMS($mobile, $sms_content, $template_id, $page_url);
			
			$html = 'Invite Sent Successfully~*~Y~*~'.$otp.'~*~<a href="javascript:void(0);" onClick="SendInviteToPatient(\''.$p_id.'\');" class="mb-2 mr-2 badge badge-warning">Send</a>';
		}
		else
			$html = 'Patient already Registered~*~N~*~'.$otp.'~*~<a href="patient_view.php?id='.$pat_id.'" class="mb-2 mr-2 badge badge-success">Registered</a>';
		
		$result = '1~*~'.$html;
	}
}

elseif($response=='MARK_NOTE_READ')
{
	if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
	{
		$id = $_GET['id'];
		$q = "update pat_advice set cStatus='A' where iPatAdviceID='$id'";
		$r = sql_query($q,'');
		
		$result = '1';
	}
}

elseif($response=='MARK_DISMISS')
{
	if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
	{
		$id = $_GET['id'];
		$q = "update log_trigger set cDismiss='Y' where iMedLogid='$id'";
		$r = sql_query($q,'');
		
		$result = '1';
	}
}

elseif($response=='MARK_NONCRITICAL')
{
	if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
	{
		$id = $_GET['id'];
		$q = "update patient set cAlertFlag='N' where iPatID='$id'";
		$r = sql_query($q,'');
		
		$result = '1';
	}
}

elseif($response=='SAVE_NEW_PATIENT_INVITE')
{
	if(isset($_POST['txtnew_name']) && !empty($_POST['txtnew_name']) && isset($_POST['txtnew_age']) && !empty($_POST['txtnew_age']) && isset($_POST['txtnew_mobile']) && !empty($_POST['txtnew_mobile']))
	{
		$txtnew_name = db_input($_POST['txtnew_name']);
		$txtnew_age = db_input($_POST['txtnew_age']);
		$rdnew_gender = db_input($_POST['rdnew_gender']);
		$txtnew_mobile = db_input($_POST['txtnew_mobile']);
		$txtnew_address = db_input($_POST['txtnew_address']);
		$txtnew_testdate = db_input($_POST['txtnew_testdate']);
		$txtnew_sampletest = db_input($_POST['txtnew_sampletest']);
		$cmbnew_phc = db_input($_POST['cmbnew_phc']);
		$cmbnew_sc = db_input($_POST['cmbnew_sc']);
		$rdnew_positive = db_input($_POST['rdnew_positive']);
		$rdnew_sendinvite = db_input($_POST['rdnew_sendinvite']);

		$name = db_input(trim($txtnew_name));
		$age = trim(intval($txtnew_age));
		$gender = db_input(trim($rdnew_gender));
		$address = db_input(trim($txtnew_address));
		$mobile = db_input(trim($txtnew_mobile));
		$date = trim($txtnew_testdate);
		$scid = db_input(trim($cmbnew_sc));
		$sampletest = db_input(trim($txtnew_sampletest));
		$positive = db_input(trim($rdnew_positive));
		$txtdtInvite = ($rdnew_sendinvite=='Y')?"'".NOW."'":'NULL';
		$txtvolunteer = ($sess_ref_type=='V')?$sess_ref_id:0;
		
		$rdpositive = 'A';
		if(!empty($positive) && array_key_exists($positive,$TEST_STATUS_ARR))
			$rdpositive = $positive;

		$INSERT = $UPDATE = "N";
		$chkExist = GetXFromYID('select iPatInviteID from patinvite where iAge="'.$age.'" and cGender="'.$gender.'" and vMobile="'.$mobile.'"');
		if(!empty($chkExist) && $chkExist!='-1')
		{
			$patinvite_id = $chkExist;
			$chkExist2 = GetXFromYID('select iPatInviteID from patinvite where iAge="'.$age.'" and cGender="'.$gender.'" and vMobile="'.$mobile.'" and vName="'.$name.'"');
			if(!empty($chkExist2) && $chkExist2!='-1')
			{
				$patinvite_id = $chkExist2;
				$UPDATE = 'Y';
			}
			else
				$INSERT = 'Y';	
		}
		else
			$INSERT = 'Y';
			
		if($INSERT=='Y')
		{
			LockTable('patinvite');
			$patinvite_id = NextID('iPatInviteID', 'patinvite');
			$otp = ($rdnew_sendinvite=='N')?'':GenerateRandomCode('6','cOTP','patinvite');
			$q = "insert into patinvite (iPatInviteID, vName, iAge, cGender, vMobile, vAddress, vTestDate, vSampleTest, iPHCID, iSCID, iFileRefID, dtEntry, dtInvite, dtOnboarding, iVolunteerID, iPatID, cOTP, cPositive, cStatus) values ('$patinvite_id', '$name', '$age', '$gender', '$mobile', '$address', '$date', '$sampletest', '$cmbnew_phc', '$scid', '0', '".NOW."', $txtdtInvite, NULL, '$txtvolunteer', '0', '$otp', '$rdpositive', 'D')";
			$r = sql_query($q, "PHC.I.123");
			UnLockTable();

			if(!empty($txtvolunteer))
			{
				UpdateVolunteerList($txtvolunteer);
				/*$allocated = GetXFromYID('select count(*) from patinvite where iVolunteerID='.$txtvolunteer);
				$active = GetXFromYID('select count(*) from patient where iVolunteerID='.$txtvolunteer.' and cStage NOT IN ("I","H")'); //cStage NOT IN ("C","D")

				sql_query("update volunteer set iNumPat_allocated='$allocated', iNumActivePatients='$active' where iVolunteerID='$txtvolunteer'","");*/
			}

			if($rdnew_sendinvite=='Y')
			{
				$sms_content = $SMS_TEMPLATE['SEND_LINK'];
				$sms_content = str_replace('{#name#}',htmlspecialchars_decode($name),$sms_content);
				$sms_content = str_replace('{#id#}',enCodeParamSMS($patinvite_id),$sms_content);
				$sms_content = str_replace('{#area#}','Bardez',$sms_content);
				$sms_content = str_replace('{#OTHERS#}','',$sms_content);
				$template_id = $TEMPLATE_ID['SEND_LINK'];
				$page_url = SITE_ADDRESS;
				
				$response = SendSMS($mobile, $sms_content, $template_id, $page_url);
				
				$result = '1~*~Patient details have beed added and Invite Sent Successfully';
			}
			else
				$result = '1~*~Patient details have beed added';
		}
		else
			$result = '2~*~Patient details already exists';
	}
}

elseif($response=='MARK_PATIENT_CONTACTED')
{
	if(isset($_GET['p_id']) && !empty($_GET['p_id']) && is_numeric($_GET['p_id']) && isset($_GET['v_id']) && !empty($_GET['v_id']) && is_numeric($_GET['v_id']))
	{
		$p_id = $_GET['p_id'];
		$v_id = $_GET['v_id'];

		$q = "update patient set cContactedPatient='Y' where iPatID='$p_id' and iVolunteerID='$v_id'";
		$r = sql_query($q,'');
		
		$result = '1';
	}
}

elseif($response=='SAVE_PATIENT_TO_INVITE')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && is_numeric($_POST['p_id']))
	{
		$p_id= $_POST['p_id'];
		
		$q = "select vName, iAge, cGender, vMobile, vAddress, vTestDate, vSampleTest, iPHCID, iSCID, cPositive from patrequest where cStatus='D' and iPatInviteID=0 and iRequestID=$p_id";
		$r = sql_query($q,'');
		if(sql_num_rows($r))
		{
			list($name,$age,$gender,$mobile,$address,$testdate,$sampletest,$phcid,$scid,$positive) = sql_fetch_row($r);
	
			$name = db_input(trim($name));
			$age = trim(intval($age));
			$gender = db_input(trim($gender));
			$address = db_input(trim($address));
			$mobile = db_input(trim($mobile));
			$date = trim($testdate);
			$scid = db_input(trim($scid));
			$sampletest = db_input(trim($sampletest));
			$positive = db_input(trim($positive));

			$INSERT = $UPDATE = "N";
			$chkExist = GetXFromYID('select iPatInviteID from patinvite where iAge="'.$age.'" and cGender="'.$gender.'" and vMobile="'.$mobile.'"');
			if(!empty($chkExist) && $chkExist!='-1')
			{
				$patinvite_id = $chkExist;
				$chkExist2 = GetXFromYID('select iPatInviteID from patinvite where iAge="'.$age.'" and cGender="'.$gender.'" and vMobile="'.$mobile.'" and vName="'.$name.'"');
				if(!empty($chkExist2) && $chkExist2!='-1')
				{
					$patinvite_id = $chkExist2;
					$UPDATE = 'Y';
				}
				else
					$INSERT = 'Y';	
			}
			else
				$INSERT = 'Y';
				
			if($INSERT=='Y')
			{
				LockTable('patinvite');
				$patinvite_id = NextID('iPatInviteID', 'patinvite');
				$q = "insert into patinvite (iPatInviteID, vName, iAge, cGender, vMobile, vAddress, vTestDate, vSampleTest, iPHCID, iSCID, iFileRefID, dtEntry, dtInvite, dtOnboarding, iVolunteerID, iPatID, cOTP, cPositive, cStatus) values ('$patinvite_id', '$name', '$age', '$gender', '$mobile', '$address', '$date', '$sampletest', '$phcid', '$scid', '0', '".NOW."', NULL, NULL, '0', '0', '', '$positive', 'D')";
				$r = sql_query($q, "PHC.I.123");
				UnLockTable();

				sql_query("update patrequest set cStatus='A', iPatInviteID='$patinvite_id', dtInvite='".NOW."' where iRequestID='$p_id'",'');
			}
			
			if($UPDATE=='Y')
				sql_query("update patrequest set cStatus='A', iPatInviteID='$patinvite_id', dtInvite='".NOW."' where iRequestID='$p_id'",'');
				
			$result = "1~*~Patient details added to invite";
		}
		else
			$result = '2~*~Invalid Access Detected';
	}
}

elseif($response=='MARK_PATIENT_INVITE_DROPOUT')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && isset($_POST['rdmpid_reason']) && !empty($_POST['rdmpid_reason']))
	{
		$p_id = db_input($_POST['p_id']);
		$rdmpid_reason = db_input($_POST['rdmpid_reason']);

		sql_query("update patinvite set cStatus='X', iReason='$rdmpid_reason' where iPatInviteID='$p_id'",'');

		$result = '1~*~Patient has been marked as dropped out';
	}
}

elseif($response=='SAVE_NEW_PATIENT_ONBOARD')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && isset($_POST['txtonboard_name']) && !empty($_POST['txtonboard_name']) && isset($_POST['txtonboard_age']) && !empty($_POST['txtonboard_age']) && isset($_POST['txtonboard_mobile']) && !empty($_POST['txtonboard_mobile']))
	{
		$p_id = $_POST['p_id'];
		$txtonboard_name = db_input($_POST['txtonboard_name']);
		$txtonboard_age = db_input($_POST['txtonboard_age']);
		$rdonboard_gender = db_input($_POST['rdonboard_gender']);
		$txtonboard_mobile = db_input($_POST['txtonboard_mobile']);
		$cmbonboard_symptom = (isset($_POST['cmbonboard_symptom']))?$_POST['cmbonboard_symptom']:array();
		$txtonboard_dsymptom = db_input($_POST['txtonboard_dsymptom']);
		$cmbonboard_comobidity = (isset($_POST['cmbonboard_comobidity']))?$_POST['cmbonboard_comobidity']:array();
		$txtonboard_currentmedication = db_input($_POST['txtonboard_currentmedication']);
		$rdonboard_vaccination = db_input($_POST['rdonboard_vaccination']);
		$cmbonboard_vaccine = (isset($_POST['cmbonboard_vaccine']))?db_input($_POST['cmbonboard_vaccine']):0;
		$txtonboard_vaccine = (isset($_POST['txtonboard_vaccine']))?"'".db_input($_POST['txtonboard_vaccine'])."'":'NULL';
		$cmbonboard_vaccine2 = (isset($_POST['cmbonboard_vaccine2']))?db_input($_POST['cmbonboard_vaccine2']):0;
		$txtonboard_vaccine2 = (isset($_POST['txtonboard_vaccine2']))?"'".db_input($_POST['txtonboard_vaccine2'])."'":'NULL';
		$txtonboard_address = db_input($_POST['txtonboard_address']);
		$txtonboard_city = db_input($_POST['txtonboard_city']);
		$cmbonboard_taluka = db_input($_POST['cmbonboard_taluka']);
		$txtonboard_pincode = db_input($_POST['txtonboard_pincode']);
		$cmbonboard_district = db_input($_POST['cmbonboard_district']);

		$cSympt_fever = $cSympt_cough = $cSympt_bodyache = $cSympt_throatpain = $cSympt_lossofsmell = $cSympt_lossoftaste = $cCond_diab = $cCond_HT = $cCond_Asth = $cCond_HC = $cCond_COPD = 'N';
		if(!empty($cmbonboard_symptom) && count($cmbonboard_symptom))
		{
			foreach($cmbonboard_symptom as $sym)
			{
				if($sym=='1')
					$cSympt_fever = 'Y';
				if($sym=='2')
					$cSympt_cough = 'Y';
				if($sym=='3')
					$cSympt_bodyache = 'Y';
				if($sym=='4')
					$cSympt_throatpain = 'Y';
				if($sym=='5')
					$cSympt_lossofsmell = 'Y';
				if($sym=='6')
					$cSympt_lossoftaste = 'Y';
			}
		}

		if(!empty($cmbonboard_comobidity) && count($cmbonboard_comobidity))
		{
			foreach($cmbonboard_comobidity as $co)
			{
				if($co=='1')
					$cCond_diab = 'Y';
				if($co=='2')
					$cCond_HT = 'Y';
				if($co=='3')
					$cCond_Asth = 'Y';
				if($co=='4')
					$cCond_HC = 'Y';
				if($co=='5')
					$cCond_COPD = 'Y';
			}
		}
		

		$q = 'select iPHCID, iSCID, dtInvite, cPositive, iVolunteerID, iPatID from patinvite where iPatInviteID='.$p_id;
		$r = sql_query($q,'');
		if(sql_num_rows($r))
		{
			list($phcid,$scid,$dtinvite,$positive,$v_id,$patient_id) = sql_fetch_row($r);
			
			$rdpositive = 'A';
			if($positive=='Y') $rdpositive = 'Y'; 

			LockTable('patient');
			$txtid = NextID('iPatID','patient');
			sql_query("insert into patient (iPatID, iPHCID, iSCID, vName, iAge, cGender, vMobile, cSympt_fever, cSympt_cough, cSympt_bodyache, cSympt_throatpain, cSympt_lossofsmell, cSympt_lossoftaste, cCond_diab, cCond_HT, cCond_Asth, cCond_HC, cCond_COPD, iVaccinationStatus, vCurrentMeds, vAddress1, vTown, iTalukaID, iDistrictID, vPinCode, dtInvite, dtOnboarding, dSympt, iVolunteerID, cPositive, cAlertFlag, cStage, cContactedPatient, cStatus) values ('$txtid', '$phcid', '$scid', '$txtonboard_name', '$txtonboard_age', '$rdonboard_gender', '$txtonboard_mobile', '$cSympt_fever', '$cSympt_cough', '$cSympt_bodyache', '$cSympt_throatpain', '$cSympt_lossofsmell', '$cSympt_lossoftaste', '$cCond_diab', '$cCond_HT', '$cCond_Asth', '$cCond_HC', '$cCond_COPD', '$rdonboard_vaccination', '$txtonboard_currentmedication', '$txtonboard_address', '$txtonboard_city', '$cmbonboard_taluka', '$cmbonboard_district', '$txtonboard_pincode', '$dtinvite', '".NOW."', '$txtonboard_dsymptom', '$v_id', '$rdpositive', 'N', 'I', 'N', 'A')",'');
			UnLockTable();
			
			sql_query("update patinvite set iPatID='$txtid' where iPatInviteID='$p_id'",'');

			if(!empty($v_id))
			{
				$doc_id = GetXFromYID('select iDoctorID from volunteer where iVolunteerID='.$v_id);
				if(!empty($doc_id) && $doc_id!='-1')
				{
					sql_query("update patient set iDocID='$doc_id' where iPatID='$txtid'",'');
					
					UpdateDoctorList($doc_id);
					/*$allocated = GetXFromYID('select count(*) from patient where iDocID='.$doc_id);
					$active = GetXFromYID('select count(*) from patient where iDocID='.$doc_id.' and cStage IN ("I","H")'); //cStage NOT IN ("C","D")
					sql_query("update doctors set iNumPat_allocated=$allocated, iNumActivePatients=$active where iDoctorID='$doc_id'",'');*/
				}
			}
			
			LockTable('pat_statuslog');
			$sid = NextID('iPSLogID','pat_statuslog');
			sql_query("insert into pat_statuslog values ('$sid', '$txtid', '".NOW."', 'P', '$txtid', '$rdpositive', '".$TEST_STATUS_ARR[$rdpositive]."')",'');
			UnLockTable();
	
			LockTable('pat_statuslog');
			$sid2 = NextID('iPSLogID','pat_statuslog');
			sql_query("insert into pat_statuslog values ('$sid2', '$txtid', '".NOW."', 'P', '$txtid', 'I', '".$PATIENT_STAGE_ARR['I']."')",'');
			UnLockTable();
			
			if($rdonboard_vaccination=='1' || $rdonboard_vaccination=='2')
				sql_query("insert into pat_vaccine (iPatID, iDose, iVaccine, dDate) values ('$txtid', '1', '$cmbonboard_vaccine', $txtonboard_vaccine)",'');		
			if($rdonboard_vaccination=='2')
				sql_query("insert into pat_vaccine (iPatID, iDose, iVaccine, dDate) values ('$txtid', '2', '$cmbonboard_vaccine2', $txtonboard_vaccine2)",'');
				
			$_SESSION[PROJ_SESSION_ID]->success_info = "Patient Onboarded Successfully";
			$result = '1~*~'.$txtid;
		}
		else
			$result = '2~*~Invalid Patient details entered';
	}
}

elseif($response=='UPDATE_PATIENT_DETAILS')
{
	if(isset($_POST['p_id']) && !empty($_POST['p_id']) && isset($_POST['txtedit_name']) && !empty($_POST['txtedit_name']) && isset($_POST['txtedit_age']) && !empty($_POST['txtedit_age']) && isset($_POST['txtedit_mobile']) && !empty($_POST['txtedit_mobile']))
	{
		$p_id = $_POST['p_id'];
		$txtedit_name = db_input($_POST['txtedit_name']);
		$txtedit_age = db_input($_POST['txtedit_age']);
		$rdedit_gender = db_input($_POST['rdedit_gender']);
		$txtedit_mobile = db_input($_POST['txtedit_mobile']);
		$txtedit_mobile2 = db_input($_POST['txtedit_mobile2']);
		$cmbedit_phc = db_input($_POST['cmbedit_phc']);
		$cmbedit_sc = db_input($_POST['cmbedit_sc']);

		sql_query("update patient set iPHCID='$cmbedit_phc', iSCID='$cmbedit_sc', vName='$txtedit_name', iAge='$txtedit_age', cGender='$rdedit_gender', vMobile='$txtedit_mobile', vAltNum='$txtedit_mobile2' where iPatID='$p_id'",'');

		sql_query("update patinvite set iPHCID='$cmbedit_phc', iSCID='$cmbedit_sc', vName='$txtedit_name', iAge='$txtedit_age', cGender='$rdedit_gender', vMobile='$txtedit_mobile' where iPatID='$p_id'",'');
	
		$_SESSION[PROJ_SESSION_ID]->success_info = "Patient details updated successfully";
		$result = '1~*~'.$txtid;
	}
}

elseif($response=='EDIT_PATIENT_INVITE_DETAILS')
{
	if(isset($_POST['txtedit_name']) && !empty($_POST['txtedit_name']) && isset($_POST['txtedit_age']) && !empty($_POST['txtedit_age']) && isset($_POST['txtedit_mobile']) && !empty($_POST['txtedit_mobile']) && isset($_POST['id']) && is_numeric($_POST['id']))
	{
		$patinvite_id = $_POST['id'];
		$txtedit_name = db_input($_POST['txtedit_name']);
		$txtedit_age = db_input($_POST['txtedit_age']);
		$rdedit_gender = db_input($_POST['rdedit_gender']);
		$txtedit_mobile = db_input($_POST['txtedit_mobile']);
		$txtedit_address = db_input($_POST['txtedit_address']);
		$txtedit_testdate = db_input($_POST['txtedit_testdate']);
		$txtedit_sampletest = db_input($_POST['txtedit_sampletest']);
		$cmbedit_phc = db_input($_POST['cmbedit_phc']);
		$cmbedit_sc = db_input($_POST['cmbedit_sc']);
		$rdedit_positive = db_input($_POST['rdedit_positive']);

		$name = db_input(trim($txtedit_name));
		$age = trim(intval($txtedit_age));
		$gender = db_input(trim($rdedit_gender));
		$address = db_input(trim($txtedit_address));
		$mobile = db_input(trim($txtedit_mobile));
		$date = trim($txtedit_testdate);
		$scid = db_input(trim($cmbedit_sc));
		$sampletest = db_input(trim($txtedit_sampletest));
		$positive = db_input(trim($rdedit_positive));
		$txtvolunteer = ($sess_ref_type=='V')?$sess_ref_id:0;
		
		$rdpositive = 'A';
		if(!empty($positive) && array_key_exists($positive,$TEST_STATUS_ARR))
			$rdpositive = $positive;

		$q = "update patinvite set vName='$name', iAge='$age', cGender='$gender', vMobile='$mobile', vAddress='$address', vTestDate='$date', vSampleTest='$sampletest', iPHCID='$cmbedit_phc', iSCID='$scid', cPositive='$rdpositive' where iPatInviteID='$patinvite_id'";
		$r = sql_query($q, "PHC.I.123");

		$_SESSION[PROJ_SESSION_ID]->success_info = "Patient details updated successfully";
		$result = '1~*~Patient details updated successfully';
	}
}

echo $result;
exit;
?>