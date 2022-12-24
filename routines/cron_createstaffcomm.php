<?php
$NO_REDIRECT = 1;
include "../includes/common_front.php";

$new_rec = 0;
$upd_rec = 0;

$q = "SELECT iStaffID, vName, vPhone, vNOK_father, vNOK_father_phone, vNOK_mother, vNOK_mother_phone, vNOK_spouse, vNOK_spouse_phone, vICE_name, vICE_phone from gen_staff where cStatus='A' and cVerified='N' "; 
$r = sql_query($q, "CRON.STCOMM.5");
if (sql_num_rows($r)) 
{
	while (list($s_staffid, $s_name, $s_phone, $s_nok_father, $s_nok_father_phone, $s_nok_mother, $s_nok_mother_phone, $s_nok_spouse, $s_nok_spouse_phone, $s_ice_name, $s_ice_phone) = sql_fetch_row($r)) 
	{
		if(!empty($s_phone))
		{
			$STAFF_NOK = array($s_nok_father=>$s_nok_father_phone, $s_nok_mother=>$s_nok_mother_phone, $s_nok_spouse=>$s_nok_spouse_phone, $s_ice_name=>$s_ice_phone);
			$chk_sms_logged = GetXFromYID("select count(*) from comm_sms where vMobile='$s_phone'");

			if(!$chk_sms_logged)
			{
				// sms was not logged
				$com_nxtid = NextID('iSMSID', 'comm_sms');
				$s_linkcode = EncodeParam('staff-'.$s_staffid.'-'.$s_phone);
				$s_link = urldecode(SITE_ADDRESS.'verification.php?code='.$s_linkcode);
				$find_arr = array('<STAFF_NAME>', '<LINK>');
				$replace_arr = array($s_name, $s_link);
				$message_str = str_replace($find_arr, $replace_arr, $SMS_TEMPLATE['STAFF_OTP_VERF']);
				$q1 = "INSERT INTO comm_sms (iSMSID, vContactName, vMobile, iRefID, cRefType, vMsg, dtCreate, dtSched) VALUES ($com_nxtid, '$s_name', '$s_phone', '$s_staffid', 'STF', '$message_str', now(), now())";
				$r1 = sql_query($q1, "CRON.STCOMM.19");
				$new_rec++;

				// add NOK details
				if(!empty($STAFF_NOK) && count($STAFF_NOK))
				{
					foreach ($STAFF_NOK as $NOK_NAME => $NOK_NUM) 
					{
						if(!empty($NOK_NUM))
						{
							$com_stnxtid = NextID('iSComID', 'comm_staff_nok');
							$nok_linkcode = EncodeParam('nok-'.$com_stnxtid.'-'.$s_phone);
							$nok_link = urldecode(SITE_ADDRESS.'verification.php?code='.$s_linkcode);
							$q2 = "INSERT INTO comm_staff_nok (iSComID, iStaffID, vPhone, vLink, cOTP, cVerified) VALUES ($com_stnxtid, $s_staffid, '$NOK_NUM', '$nok_link', '', 'N')";
							$r2 = sql_query($q2, "CRON.STCOMM.34");

							// add to sms logg
							$com_nxtid = NextID('iSMSID', 'comm_sms');
							$find_arr = array('<NOK_NAME>', '<STAFF_NAME>', '<LINK>');
							$replace_arr = array($NOK_NAME, $s_name, $nok_link);
							$message_str = str_replace($find_arr, $replace_arr, $SMS_TEMPLATE['NOK_OTP_VERF']);
							$q3 = "INSERT INTO comm_sms (iSMSID, vContactName, vMobile, iRefID, cRefType, vMsg, dtCreate, dtSched) VALUES ($com_nxtid, '$NOK_NAME', '$NOK_NUM', '$s_staffid', 'NOK', '$message_str', now(), now())";
							$r3 = sql_query($q3, "CRON.STCOMM.46");
							$new_rec++;
						}
					}
				}
			}
			else
			{
				// sms was logged

				// add missing NOK details
				if(!empty($STAFF_NOK) && count($STAFF_NOK))
				{
					foreach ($STAFF_NOK as $NOK_NAME => $NOK_NUM) 
					{
						$chk_nok_logged = GetXFromYID("select count(*) from comm_sms where vMobile='$NOK_NUM'");
						if(!empty($NOK_NUM) && !$chk_nok_logged)
						{
							$com_stnxtid = NextID('iSComID', 'comm_staff_nok');
							$nok_linkcode = EncodeParam('nok~'.$com_stnxtid.'~'.$s_phone);
							$nok_link = urldecode(SITE_ADDRESS.'verification.php?code='.$nok_linkcode);
							$q4 = "INSERT INTO comm_staff_nok (iSComID, iStaffID, vPhone, vLink, cOTP, cVerified) VALUES ($com_stnxtid, $s_staffid, '$NOK_NUM', '$nok_link', '', 'N')";
							$r4 = sql_query($q4, "CRON.STCOMM.68");

							// add to sms logg
							$com_nxtid = NextID('iSMSID', 'comm_sms');
							$find_arr = array('<NOK_NAME>', '<STAFF_NAME>', '<LINK>');
							$replace_arr = array($NOK_NAME, $s_name, $nok_link);
							$message_str = str_replace($find_arr, $replace_arr, $SMS_TEMPLATE['NOK_OTP_VERF']);
							$q5 = "INSERT INTO comm_sms (iSMSID, vContactName, vMobile, iRefID, cRefType, vMsg, dtCreate, dtSched) VALUES ($com_nxtid, '$NOK_NAME', '$NOK_NUM', '$s_staffid', 'NOK', '$message_str', now(), now())";
							$r5 = sql_query($q5, "CRON.STCOMM.76");
							$upd_rec++;
						}
					}
				}
			}

		}
	}
}

phplogstr("new records added: $new_rec");
phplogstr("records updated: $upd_rec");
?>