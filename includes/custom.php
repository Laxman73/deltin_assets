<?php

function GetDataFromID($table, $pk_field, $pk_id, $cond="")
{
    $q = "select * from ".$table." where ".$pk_field." = '".$pk_id."' ".$cond;
    $r = sql_query($q,"CUSTOM.05");

    if(sql_num_rows($r))
    {
        while($row = sql_fetch_object($r))
        {
            $arr[] = $row;
        }

        return $arr;
    }
}

function GetDataFromCOND($table, $cond="")
{
    $q = "select * from ".$table." where 1 ".$cond;
    $r = sql_query($q,"CUSTOM.21");

    if(sql_num_rows($r))
    {
        while($row = sql_fetch_object($r))
        {
            $arr[] = $row;
        }

        return $arr;
    }
}

function InsertData($table,$values)
{
    $str ='';

    if(!empty($values))
    {
        $q = "insert into $table values(".$values.")";
        $r = sql_query($q, "CUSTOM.37");
    }

    //$str = $q.'<br />'; 
    $str = $r; 

    return $str;
}

function UpdataData($table,$values,$cond)
{
    $str ='';

    if(!empty($values))
    {
        $q = "update $table set $values where $cond";
        $r = sql_query($q, "CUSTOM.56");
    }

    $str = $q; 

    return $str;
}

function UpdateData($table,$values,$cond)
{
    $str ='';

    if(!empty($values))
    {
        $q = "update $table set $values where $cond";
        $r = sql_query($q, "CUSTOM.56");
    }

    $str = $q; 

    return $str;
}

function DeleteData($table, $field, $pk, $cond="")
{
    $str ='';

    $q = "delete from $table where $field=$pk and 1 $cond";
    $r = sql_query($q, "CUSTOM.56");

    $str = $q;

    return $str;
}

function UpdateField($table, $field, $field_val, $cond="")
{
    $q = "update $table set $field='".$field_val."' where 1 and $cond";
    $r = sql_query($q,'CUSTOM.351');
    $count = sql_affected_rows($r);

    return $count;
}

function HelpIcon($mesg)
{
    $str = '<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="'.$mesg.'"></i>';

    return $str;
}

function GetCountFromTable($table, $cond="")
{
    $count = GetXFromYID ("select count(*) from ".$table." where 1 ".$cond);

    return $count;
}

function GetXArrFromYID2($table, $values, $cond='', $mode="1")
{
    $q  = "select $values from $table where 1 $cond";
    $arr = array();
    $r = sql_query($q, 'COM39');
    
    if(sql_num_rows($r))
    {
        if($mode == "2")
            for($i=0; list($x) = sql_fetch_row($r); $i++)
                $arr[$i] = $x;
        else if($mode == "3")
            for($i=0; list($x, $y) = sql_fetch_row($r); $i++)
                $arr[$x] = $y;
        else if($mode == "4")
            while($a = sql_fetch_assoc($r))
                $arr[$a['I']] = $a;
        else
            while(list($x) = sql_fetch_row($r))
                $arr[$x] = $x;
    }

    return $arr;
}

function GetCounts($table, $cond)
{    
    $q = GetXFromYID("select count(*) from $table where 1 $cond");

    return $q;
}

function GetStatusPills($status="", $status_arr="")
{
    $pill_str = $bd_col = "";
    $text = isset($status_arr[$status])?$status_arr[$status]:'';

    if(!empty($text))
    {
        if($status=='U') $bd_col = 'badge-primary';
        else if($status=='D') $bd_col = 'badge-danger';
        else if($status=='A') $bd_col =  'badge-success';
        
        $pill_str = '<div class="mb-2 mr-2 badge '.$bd_col.'">'.$text.'</div>';
    }

    return $pill_str;
}

function phplogstr($str)
{
    echo "<b>Log</b>: <monospace>".$str."</monospace><br/>";
}

######################## MRFARMER related functions ##########################

function updateWebPusherId($pat_id, $pusher_id="")
{
    $notif_id = "";
    if(is_numeric($pat_id) )
    {
        $notif_id = GetXFromYID("SELECT vWebPushrID FROM patient WHERE iPatID=$pat_id");

        if($notif_id!=$pusher_id)
            UpdateField('patient', 'vWebPushrID', $pusher_id, "iPatID=$pat_id");
    }
}

function PostRequest($url, $referer, $_data) 
{
    // convert variables array to string:
    $data = array(); while(list($n,$v) =
    each($_data)) {
        $data[] = "$n=$v";
    }

    $data = implode('&', $data);
    
    $url = parse_url($url);
    if ($url['scheme'] != 'http') {
        die('Only HTTP request are supported !');
    }
    // extract host and path:
    $host = $url['host'];
    $path = $url['path'];

    // open a socket connection on port 80
    $fp = fsockopen($host, 80);
    
    // send the request headers:
    fputs($fp, "POST $path HTTP/1.1\r\n");
    fputs($fp, "Host: $host\r\n");
    fputs($fp, "Referer: $referer\r\n");
    fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
    fputs($fp, "Content-length: ". strlen($data) ."\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $data);
    
    $result = '';
    
    while(!feof($fp)) {
        // receive the results of the request
        $result .= fgets($fp, 128);
    }
    
    // close the socket connection:
    fclose($fp);
    
    // split the result header from the content
    $result = explode("\r\n\r\n", $result, 2);
    $header = isset($result[0]) ? $result[0] : '';
    $content = isset($result[1]) ? $result[1] : '';
    
    // return as array:
    return array($header, $content);
}

function addStaffGroup($cmbgroupid, $txtid) // adding group to staff;
{
    if(!empty($txtid) && is_numeric($txtid))
    {
        DeleteData("group_staff", "iStaffID", $txtid); // delete the existing data;

        if(!empty($cmbgroupid) && count($cmbgroupid))
        {
            foreach ($cmbgroupid as $GID) 
            {
                $q = "INSERT INTO group_staff (iGroupID, iStaffID, dtAssign, dtRelease, cStatus) VALUES ($GID, $txtid, now(), NULL, 'A')";
                $r = sql_query($q, "CUSTOM.343");
            }
        }
    }
}

function getStaffGroup($id="")
{
    $gstaff_arr = GetXArrFromYID("select g.vName from group_staff gs left join gen_group g on g.iGroupID=gs.iGroupID where gs.iStaffID=$id", "2");
    $gstaff_str = (!empty($gstaff_arr) && count($gstaff_arr))?implode(",", $gstaff_arr):NA;

    return $gstaff_str;
}

function StaffHeaderTabs($id=0)
{
    $str = "";
    if(!empty($id) && is_numeric($id))
    {
        $_filename = basename($_SERVER["SCRIPT_NAME"]);
        $edit_url = 'staff_edit.php';

        $q = "select vName, cStatus from gen_staff where iStaffID=$id";
        $r = sql_query($q, "CUSTOM.368");

        $staff_name = $staff_status = '';
        if(sql_num_rows($r))
            list($staff_name, $staff_status) = sql_fetch_row($r);

        //$staff_name = GetXFromYID("select vName from gen_staff where iStaffID=$id");

        $staffoverview = $staffedit = $staffnok = $staffdocs = '';

        if($_filename=='staff_overview.php') $staffoverview = 'active';
        else if($_filename=='staff_edit.php') $staffedit = 'active';
        else if($_filename=='staff_nok.php') $staffnok = 'active';
        else if($_filename=='staff_docs.php') $staffdocs = 'active';

        $str = '<div class="page-title-wrapper">
                  <div class="page-title-heading">
                      <div>
                          <div class="page-title-head center-elem">
                              <h4>## '.$staff_name.' '.getStaffStatus($staff_status).'</h4>
                          </div>
                      </div>
                  </div>
                </div>
                <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                    <li class="nav-item"><a class="nav-link show '.$staffoverview.'" href="staff_view.php?id='.$id.'"><span>Overview</span></a></li>
                    <li class="nav-item"><a class="nav-link show '.$staffedit.'" href="'.$edit_url.'?mode=E&id='.$id.'"><span>Edit Detail</span></a></li>
                    <li class="nav-item"><a class="nav-link show '.$staffnok.'" href="staff_nok.php?id='.$id.'"><span>Next Of Kin</span></a></li>
                    <li class="nav-item"><a class="nav-link show '.$staffdocs.'" href="staff_docs.php?id='.$id.'"><span>Documents</span></a></li>
                </ul>';
    }

    return $str;
}


function getLastNDays($days, $format = 'd/m'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)); 
    }
    return array_reverse($dateArray);
}

function isOffDay($staffid, $date, $weeklyoff) {
    $is_offday = "N";

    // staff_offday
    $thisday = date('w', strtotime($date));
    $is_offday = ($thisday==$weeklyoff)?'Y':'N';

    return $is_offday;
}

function isHoliday($staffid, $date) {
    $is_holiday = "N";

    return $is_holiday;
}

function isLeaveDay($staffid, $date) {
    $is_onleave = "N";

    $leave_id = GetXFromYID("select iLeaveID from leaves where '".$date."' between dFrom and dTo and cStatus='A' and iStaffID=$staffid");
    $is_onleave = (!empty($leave_id) && is_numeric($leave_id))?'Y':'N';

    return $is_onleave;
}

function getStaffAttendance($staffid, $date) {
    $st_attendance = array('ID'=>'', 'STAFF_ID'=>'', 'DATE'=>'', 'IN'=>'', 'LUNCH_OUT'=>'', 'LUNCH_IN'=>'', 'OUT'=>'', 'LOC_ID'=>'', 'STATUS'=>'');

    $q = "SELECT iAttID, iStaffID, dAtt, tIn, tLunchOut, tLunchIn, tOut, iLocID, cStatus from staff_attendance where iStaffID=$staffid and dAtt='".$date."' LIMIT 1";
    $r = sql_query($q, "CUSTOM.428");

    // echo $q.'<br/>';

    if(sql_num_rows($r))
    {
        $o = sql_fetch_object($r);

        $att_id = $o->iAttID;
        $att_staffid = $o->iStaffID;
        $att_att = $o->dAtt;
        $att_in = $o->tIn;
        $att_luncout = $o->tLunchOut;
        $att_lunchin = $o->tLunchIn;
        $att_out = $o->tOut;
        $att_locid = $o->iLocID;
        $att_status = $o->cStatus;

        $st_attendance = array('ID'=>$att_id, 'STAFF_ID'=>$att_staffid, 'DATE'=>$att_att, 'IN'=>$att_in, 'LUNCH_OUT'=>$att_luncout, 'LUNCH_IN'=>$att_lunchin, 'OUT'=>$att_out, 'LOC_ID'=>$att_locid, 'STATUS'=>$att_status);        
    }

    return $st_attendance;
}

function getStaffDetails($id="", $cond=" ", $date="", $staff_group="N", $post_condstr="") {
    
    $STAFF_ARR = array();
    $cond .= (!empty($id) && is_numeric($id))?" and s.iStaffID=$id":'';
    $join = " left join group_staff gs on gs.iStaffID=s.iStaffID";

    $q = "SELECT s.iStaffID, s.iUID, s.iLocID, s.iStaffDesigID, s.vName, s.vAddress, s.vEmailID, s.vPhone, s.vPhoto, s.iNumLeaves_wp, s.iNumLeaves_wop, s.iLeaveCount, s.iWeeklyOff, s.cStatus FROM gen_staff s $join WHERE 1 $cond $post_condstr ";
    $r = sql_query($q, "CUSTOM.408");

    if(sql_num_rows($r))
    {
        while (list($s_staffid, $s_uid, $s_locid, $s_staffdesigid, $s_name, $s_address, $s_emailid, $s_phone, $s_photo, $s_numleaves_wp, $s_numleaves_wop, $s_leavecount, $s_weeklyoff, $s_status) = sql_fetch_row($r)) 
        {
            $STAFF_ARR[] = array(
                                'STAFFID'=>$s_staffid,
                                'SUID'=>$s_uid,
                                'LOCID'=>$s_locid,
                                'STAFFDESIGID'=>$s_staffdesigid,
                                'NAME'=>$s_name,
                                'ADDRESS'=>$s_address,
                                'EMAILID'=>$s_emailid,
                                'PHONE'=>$s_phone,
                                'PHOTO'=>$s_photo,
                                'NUMLEAVES_WP'=>$s_numleaves_wp,
                                'NUMLEAVES_WOP'=>$s_numleaves_wop,
                                'LEAVECOUNT'=>$s_leavecount,
                                'WEEKLYOFF'=>$s_weeklyoff,
                                'STATUS'=>$s_status,
                                'IS_OFFDAY'=>isOffDay($s_staffid, $date, $s_weeklyoff),
                                'ON_LEAVE'=>isLeaveDay($s_staffid, $date),
                                'IS_HOLIDAY'=>isHoliday($s_staffid, $date),
                                'ATTENDANCE_ARR'=>getStaffAttendance($s_staffid, $date),
                            );
        }
    }

    return $STAFF_ARR;
}

function getStaffAttendanceDisp($fromdate, $todate, $staffid="", $cond="", $staff_group="N", $post_condstr="")
{
    $num_days = DateDiff($fromdate, $todate);
    $DATES_ARR = getLastNDays($num_days, 'Y-m-d');
    $STAFF_ARR = array();
    $ATTENDANCE_ARR = array();

    if(!empty($DATES_ARR) && count($DATES_ARR))
    {
      foreach($DATES_ARR as $_DATE)
      {
        $ATTENDANCE_ARR[$_DATE] = array();
        $STAFF_ARR = getStaffDetails($staffid, $cond, $_DATE, $staff_group, $post_condstr);
        $ATTENDANCE_ARR[$_DATE] = $STAFF_ARR; 
      }
    }

    return $ATTENDANCE_ARR;
}

function getStaffLeavesDisp($cond="") 
{
  $LEAVES_ARR = array();

  $q = "select l.*, s.vName from leaves l left join gen_staff s on s.iStaffID=l.iStaffID where 1 $cond order by field(l.cStatus, 'D','A','C','R'), l.dFrom";
  $r = sql_query($q, "STL.D.62");
  $record_count = sql_num_rows($r);

  if(!empty($record_count))
  {
    for ($i=1; $o = sql_fetch_object($r) ; $i++) 
    { 
      $sl_leaveid = $o->iLeaveID;
      $sl_apply = $o->dtApply;
      $sl_staffid = $o->iStaffID;
      $sl_ltypeid = $o->iLTypeID;
      $sl_from = $o->dFrom;
      $sl_to = $o->dTo;
      $sl_partflag = db_output($o->cPartFlag);
      $sl_numdays = db_output($o->iNumDays);
      $sl_leaveavailable = db_output($o->iLeaveAvailable);
      $sl_user_sanctioned = db_output($o->iUser_sanctioned);
      $sl_notes = db_output2($o->vNotes);
      $sl_officenotes = db_output2($o->vOfficeNotes);
      $sl_mode = db_output($o->cMode);
      $sl_dtstatus = FormatDate($o->dtStatus, "C");
      $sl_status = db_output($o->cStatus);
      $sl_name = db_output($o->vName);

      $leave_type = isset($LEAVE_TYPE_ARR[$sl_ltypeid])?$LEAVE_TYPE_ARR[$sl_ltypeid]:NA;
      $user_sanctioned = isset($USERS_ARR[$sl_user_sanctioned])?$USERS_ARR[$sl_user_sanctioned]:NA;
      $staff_pic_str = NOIMAGE;

      $LEAVES_ARR[] = array('ID'=>$sl_leaveid, 'NAME'=>$sl_name, 'PIC'=>$staff_pic_str, 'APPLIED'=>FormatDate($sl_apply, "C"), 'FROM'=>FormatDate($sl_from, "B"), 'TO'=>FormatDate($sl_to, "B"), 'NOTES'=>$sl_notes, 'OFFICENOTES'=>$sl_officenotes, 'LEAVE_TYPE'=>$leave_type, 'APPROVED_ON'=>$sl_dtstatus, 'APPROVED_BY'=>$user_sanctioned, 'STATUS'=>$sl_status);
    }
  }

  return $LEAVES_ARR;
}

function chkStaffNokVerf($phone="")
{
    $verified = "N";

    if(!empty($phone))
    {
        $verified = GetXFromYID("select cVerified from comm_staff_nok where vPhone='$phone'");
    }

    return $verified;
}
?>