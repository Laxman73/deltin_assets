<?php
$NO_REDIRECT = 1;
include 'includes/common.php';
$LIMIT = '50';
$NOW = date('Y-m-d H:i:s');
$q = "select * from comm_sms where (cStatus = 'D' or cStatus_WA = 'D') and dtSched >= '$NOW' LIMIT $LIMIT";
$r = sql_query($q, "cron_send_messages.6");

if(sql_num_rows($r)){
    
    while($row = sql_fetch_object($r)){
        $sms_msg = $row->vMsg;
        $sms_id = $row->iSMSID;
        $sms_mobile_no = strlen($row->vMobile == 10)?'91'.$row->vMobile:$row->vMobile;
        $data_arr = array("ApiKey"=>"farmer9876", "ClientId"=>"Mr Farmer", "SenderId"=>"MRFARM", "Message"=>$sms_msg, "MobileNumbers"=>$sms_mobile_no);
        $data_str = json_encode($data_arr);
        $response = SendSMSMessage1($data_str);
        	//echo $response;
	$response_arr = json_decode($response, true);
	//DFA($response_arr);
		$sms_status = 'I';
        $trans_id = '';
		if($response_arr['Data'][0]['MessageErrorDescription'] != 'Success')
		{
			continue;
		}
		else
		{
			$is_success = false;
			$trans_id = '';
			if(!empty($response_arr['Data'][0]['MessageId'])){
				$trans_id = $response_arr['Data'][0]['MessageId'];
			}
			if($response_arr['Data'][0]['MessageErrorDescription'] == 'Success'){
				$is_success = true;
			}
			
			if($is_success)
				$sms_status = 'A';
			
		}
        $qsms = "update comm_sms set dtSent = NOW(), cStatus = '$sms_status', 'vTransID = '$trans_id' where iSMSID = '$sms_id'";
        $rsms = sql_query($qsms, "cron_send_messages.42");

        $data_arr1 = array('token'=>'60ed718014cdb46c3f474bdc', 'phone'=>$sms_mobile_no, 'message'=>$sms_msg);
		$waresponse = SendWhatsappMessage1($data_arr1);
        $sms_status_wa == 'I';
        $trans_id_wa = '';
		if(!empty($waresponse)){

			if($waresponse['status'] == 'success'){

				$sms_status_wa == 'A';
				$trans_id_wa = $waresponse['data']['messageIDs'][0];

			} else {

				$sms_status_wa == 'I';
				$trans_id_wa = '';

			}

		}        
        $qwa = "update comm_sms set dtSent_WA = NOW(), cStatus_WA = '$sms_status_wa', 'vTransID_WA = '$trans_id_wa' where iSMSID = '$sms_id'";
        $rwa = sql_query($qwa, "cron_send_messages.42");
    }
    
    
    
}

function SendWhatsappMessage1($data_arr=array()){
    $response_arr = array();
    $data_str = http_build_query($data_arr);
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://wtsapp.aronertech.com/api/sendText?'.$data_str,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    $response_arr = json_decode($response, true);
        
    return $response_arr;	
        
}

function SendSMSMessage1($data_str){
    $response = '';
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.smslane.com/api/v2/SendSMS',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $data_str,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;    
}
?>