<?php

##	DEFINES 		###################################################################################

define('TODAY',date("Y-m-d"));

define('NOW',date("Y-m-d H:i:s"));

define('TOMMORROW', date("Y-m-d", strtotime("+1 day")));

define('YESTERDAY', date("Y-m-d", strtotime("-1 day")));

define('CURRENTTIME',date("H:i:s"));



define('TODAY2',date("d-m-Y"));

define('NOW2',date("d-m-Y H:i:00"));

define('TOMMORROW2', date("d-m-Y", strtotime("+1 day")));

define('YESTERDAY2', date("d-m-Y", strtotime("-1 day")));

define('LAST7DAYS', date("Y-m-d", strtotime("-7 day")));



define('NOW3', date("Ymd.Hi"));

// define('PAYROLL_PROCESS_START', '2014-03');

define('THIS_WEEK', date("W"));

define('THIS_MONTH', date("m"));

define('THIS_YEAR', date("Y"));



define('LAST_WEEK', date("W", strtotime("-1 week")));

define('LAST_MONTH', date("m", strtotime("-1 month")));

define('LAST_YEAR', date("Y", strtotime("-1 year")));



define('CURRENT_MONTH', date("m"));

define('CURRENT_YEAR', date("Y"));



define('FINANCIAL_YEAR_STARTDAY', '04-01');

define('FINANCIAL_YEAR_ENDDAY', '03-31');



define('MONTH_START', date("Y-m-01"));

define('MONTH_START2', date("01-m-Y"));



define('MONTH_YEAR', date("mY"));

define('TODAY1',date("Ymd"));



define('URL_REWRITTING','OFF');

define('PROJ_DELIMITER', '[DCC_BREAK]');

$STARTOFMONTH="01-".THIS_MONTH."-".THIS_YEAR;



// define('SEND_MAILER', 0);

define('OFFICIAL_EMAILID','support@thatlifestylecoach.com');

define('NUTRITIONIST_EMAILID','nutritionist@thatlifestylecoach.com');

define('PROJ_SESSION_ID', 'udat_FSTAFF');

define('PROJ_FRONT_SESSION_ID', 'sdat_FSTAFF');

define('PROJ_APP_SESSION_ID', 'sdat_STAFF');

define('PROJ_AUTHORISE_SESSION_ID', 'udat_AUTHDCC');

define('PROJ_ALERT_SESSION_ID', 'udat_ADCC');

define('THUMBNAIL_ALLOWED', 1);	// 1 - Yes, 0 - No.

define('RANDOMIZE_FILENAME', 1); // 0 - Randomize Uploaded Image Name, 1 - Customize Uploaded Image Name

define('SQL_ERROR', 1);

define('NEWLINE', "\r\n");

define('TAB_SPACE', "\t");

define('FORCE_PRINT_DOWNLOAD', 1); // default is 0

define('IS_WAMP_SETUP', 1);

define('WEEK_START_DAY', 1); // 0: Sunday, 1: Monday...

define('QTR_START_MONTH', 1); // Jan

define('QTR_MONTH_OFFSET', 0); // Jan

define('ADD_SLASHES', 0);

define('NA', '- n/a -');

define('IS_INTERNET', false);



##	PATH DEFINES	###################################################################################

define('AJAX_INC_URL',SITE_ADDRESS.'includes/ajax.inc.php');



define('IMAGE_PATH',SITE_ADDRESS.'images/');

define('IMAGE_UPLOAD',DOCROOT.'images/');



define('USER_PATH',SITE_ADDRESS.'uploads/users/');

define('USER_UPLOAD',DOCROOT.'uploads/users/');



define('STAFF_PATH',SITE_ADDRESS.'uploads/staff/');

define('STAFF_UPLOAD',DOCROOT.'uploads/staff/');



define('STAFF_DOCS_PATH',SITE_ADDRESS.'uploads/staff_docs/');

define('STAFF_DOCS_UPLOAD',DOCROOT.'uploads/staff_docs/');



define("SURVEILLANCE_UPLOAD", DOCROOT."uploads/surveillance/");

define("SURVEILLANCE_PATH", SITE_ADDRESS."uploads/surveillance/");



define("TEMPLATE_UPLOAD", DOCROOT."uploads/template/");

define("TEMPLATE_PATH", SITE_ADDRESS."uploads/template/");



##	IMAGE DEFINES	###################################################################################

define("PRINT_RECORD_IMG", "<img src='" . IMAGE_PATH . "print.png' alt='Print' border='0' align='absmiddle'>");

define("EXPORT_CSV_RECORD_IMG", "<img src='" . IMAGE_PATH . "csv-export.png' alt='CSV Export' border='0' align='absmiddle'>");

define("IMPORT_CSV_RECORD_IMG", '<i class="fa fa-upload"></i>');

define("BARCODE_RECORD_IMG", "<img src='" . IMAGE_PATH . "barcode.png' alt='Print Labels' border='0' align='absmiddle'>");

define("FEATURED_IMG", "<img src='" . IMAGE_PATH . "featured.gif' border='0' alt='featured' align='absmiddle'>");

define("UNFEATURED_IMG", "<img src='" . IMAGE_PATH . "unfeatured.gif' border='0' align='absmiddle'>");

define("EDIT_IMG_SMALL", '<i class="fa fa-edit"></i>');

define("EDIT_IMG", '<span class="glyphicon glyphicon-edit"> </span>');

define("DELETE_IMG_SMALL", '<i class="fa fa-remove"></i>');

define("DELETE_IMG", '<span class="glyphicon glyphicon-remove"> </span>');



define("NOIMAGE", IMAGE_PATH."no-image.png");



//define("EDIT_IMG", "<img src='" . IMAGE_PATH . "edit.gif' alt='Edit Record' border='0' align='absmiddle'>");

//define("DELETE_IMG", "<img src='" . IMAGE_PATH . "delete.gif' alt='Delete Record' border='0' align='absmiddle'>");

define("ACTIVE_IMG", "<img src='" . IMAGE_PATH . "active.png'  alt='Active' border='0' align='absmiddle'>");

define("INACTIVE_IMG", "<img src='" . IMAGE_PATH . "inactive.png' alt='Blocked' border='0' align='absmiddle'>");

define("STARRED_IMG", "<img src='" . IMAGE_PATH . "star.png'  alt='Starred' border='0' align='absmiddle'>");

define("UNSTARRED_IMG", "<img src='" . IMAGE_PATH . "not-star.png' alt='UnStarred' border='0' align='absmiddle'>");

define("YES_IMG", "<img src='" . IMAGE_PATH . "yes-ico.gif'  alt='Yes' border='0' align='absmiddle'>");

define("NO_IMG", "<img src='" . IMAGE_PATH . "no-ico.gif' alt='No' border='0' align='absmiddle'>");

define("ADD_IMG", "<img src='" . IMAGE_PATH . "add.gif' alt='Add' border='0' align='absmiddle'>");

define("RMV_IMG", "<img src='" . IMAGE_PATH . "remove.gif' alt='Remove' border='0' align='absmiddle'>");



define("MOD_BLOCK_IMG", "<img src='" . IMAGE_PATH . "mod_block.gif'  alt='Active' border='0' align='absmiddle'>");

define("MOD_VIEW_IMG", "<img src='" . IMAGE_PATH . "mod_view.gif' alt='Blocked' border='0' align='absmiddle'>");

define("MOD_EDIT_IMG", "<img src='" . IMAGE_PATH . "mod_edit.gif' alt='Blocked' border='0' align='absmiddle'>");



define('TSK_ICON', '<img src="images/icons/default/tasks.png" alt="task" border="0" align="absmiddle" />');

define('MTG_ICON', '<img src="images/icons/default/meeting.png" alt="meeting" border="0" align="absmiddle" />');

define('RFI_ICON', '<img src="images/icons/default/rfi.png" alt="rfi" border="0" align="absmiddle" />');

define('INS_ICON', '<img src="images/icons/default/inspection.png" alt="inspection" border="0" align="absmiddle" />');

define('PROJECT_ICON', '<img src="images/icons/default/project.png" alt="project" border="0" align="absmiddle" />');

define('USERS_ICON', '<img src="images/icons/default/users.png" alt="users" border="0" align="absmiddle" />');

define('INSPECTION_PICS_ICON', '<img src="images/icons/default/media.png" alt="users" border="0" align="absmiddle" />');



define('GEN_SERVICES_ICON', '<img src="images/icons/default/gen_services.png" alt="services" border="0" align="absmiddle" />');

define('GEN_LOCATION_ICON', '<img src="images/icons/default/gen_location.png" alt="locations" border="0" align="absmiddle" />');

define('DOCUMENTS_ICON', '<img src="images/icons/default/documents.png" alt="documents" border="0" align="absmiddle" />');



define('ADD_ICON', '<img src="images/icons/default/add_new.png" alt="New Record" border="0" align="absmiddle" />');

define('PRINT_ICON', '<img src="images/icons/default/print.png" alt="Print" border="0" align="absmiddle" />');

define('EXCEL_ICON', '<img src="images/icons/default/excel_file.png" alt="Excel Export" border="0" align="absmiddle" />');

define('FUNCTION_ICON', '<img src="images/icons/default/settings.png" border="0" align="absmiddle" />');

define('BARCODE_ICON', '<img src="images/icons/default/barcode.png" border="0" align="absmiddle" />');

define('RESET_ICON', '<img src="images/icons/default/reset.png" border="0" align="absmiddle" />');

define('ARCHIVE_ICON', '<img src="images/icons/default/error.png" title="Archive This" border="0" align="absmiddle" />');

define('UNARCHIVE_ICON', '<img src="images/icons/default/alert.png" title="Restore This" border="0" align="absmiddle" />');

define('UPLOAD_ICON', '<img src="images/icons/default/upload.png" title="Upload This" border="0" align="absmiddle" />');

define("PRELOAD_BAR", "<img src='" . IMAGE_PATH . "preloader_bar.png' alt='Loading Now...' border='0' align='absmiddle'>");

define('DOWNLOAD_ICON', '<img src="images/icons/default/download.png" title="Download This" border="0" align="absmiddle" />');



##	NO IMAGE DEFINES	###################################################################################

define('NO_PHOTO_SML', '<img src="images/avatar.png" alt="" class="radius2" />');

// define('NO_ALBUM', '<img src="'.IMAGE_PATH.'artist-img.jpg" border="0">');



##	DEFINED ARRAYs	###################################################################################

$IMG_TYPE = array('gif','png','pjpeg','jpeg','jpg','JPG');

$DOC_TYPE = array('txt','doc','docx','pdf','xls','xlsx');

$IMG_FILE_TYPE = array('image/gif','image/png','image/pjpeg','image/jpeg','image/jpg');

$DOC_FILE_TYPE = array('text/plain','application/msword','application/vnd.ms-word','application/pdf','application/vnd.ms-excel');



$DISPLAY_ARR = array("Y"=>"Yes","N"=>"No");



$MODE_ARR = array('A'=>'Add','E'=>'Edit');

$WEEKDAY_ARR = array('0'=>'Sunday', '1'=>'Monday', '2'=>'Tuesday', '3'=>'Wednesday', '4'=>'Thursday', '5'=>'Friday', '6'=>'Saturday');

$WEEKDAY_ARR2 = array('SUN'=>'Sunday', 'MON'=>'Monday', 'TUE'=>'Tuesday', 'WED'=>'Wednesday', 'THU'=>'Thursday', 'FRI'=>'Friday', 'SAT'=>'Saturday');

$WEEKDAY_ORDER_ARR = array("'SUN'", "'MON'", "'TUE'", "'WED'", "'THU'", "'FRI'", "'SAT'");

$WEEKDAY_ARR3 = array('0'=>'SUN', '1'=>'MON', '2'=>'TUE', '3'=>'WED', '4'=>'THU', '5'=>'FRI', '6'=>'SAT');

$MONTH_ARR = array("1"=>"January", "2"=>"February", "3"=>"March", "4"=>"April", "5"=>"May", "6"=>"June", "7"=>"July", "8"=>"August", "9"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");

$SHORT_MONTH_ARR = array("1"=>"Jan", "2"=>"Feb", "3"=>"Mar", "4"=>"Apr", "5"=>"May", "6"=>"Jun", "7"=>"Jul", "8"=>"Aug", "9"=>"Sep", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec");

$SHORT_MONTH_ARR = array("1"=>"Jan", "2"=>"Feb", "3"=>"Mar", "4"=>"Apr", "5"=>"May", "6"=>"Jun", "7"=>"Jul", "8"=>"Aug", "9"=>"Sep", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec");



$EMAIL_TYPE_ARR = array('CC'=>'CC', 'BCC'=>'BCC');

$PAYMENT_STATUS_ARR = array('N'=>'Not Paid','P'=>'Paid');

$LOGIN_TYPE_ARR = array('F'=>'Facebook', 'T'=>'Twitter', 'G'=>'Google+', 'E'=>'Website');

$USER_LEVEL_ARR = array('1'=>'Admin', '2'=>'HR Manager', '3'=>'HR Staff/Accounts');

$YES_ARR = array('Y'=>'Yes', 'N'=>'No');

$AUTH_MODE_ARR = array("N"=>"Normal Login");

$YES_ARR2 = array('Y'=>YES_IMG, 'N'=>NO_IMG);



$ONLINE_ARR = array('Y'=>'Online', 'N'=>'Offline');

$DIFFICULTY_ARR = array('B'=>'Basic', 'I'=>'Intermediate', 'A'=>'Advanced');

$DIFFICULTY_ARR_CSS = array('B'=>'alternate', 'I'=>'warning', 'A'=>'danger');

$STATUS_ARR = array("A"=>"Active", "I"=>"Inactive");//, "P"=>"Pending", "X"=>"Ended/Cancelled");

$LEAVES_STATUS_ARR = array("D"=>"Pending", "A"=>"Approved", "R"=>"Rejected", "C"=>"Cancelled");//, "P"=>"Pending", "X"=>"Ended/Cancelled");

$LEAVES_STATUSCSS_ARR = array("D"=>"bg-strong-bliss text-white", "A"=>'bg-grow-early text-white', "R"=>"bg-danger text-white", "C"=>"bg-danger text-white");

$STATUS_ARR2 = array("D"=>'Draft', "A"=>"Active", "I"=>"Inactive");

$STATUS_CLASS_ARR = array("A"=>"success", "I"=>"danger", "P"=>"warning", "X"=>"secondary");



// 

$VIDEO_SRC_ARR = array("Y"=>"Youtube");

$BMTYPE_ARR = array("B"=>"Biometric", "F"=>"Fortius Software", "A"=>"Web App");

$DOC_TYPE_ARR = array("0"=>'Voter\'s Card', '1'=>'Aadhaar Card', '2'=>'Driving Lisence');



$PERIOD_ARR = array("M"=>"Month","Y"=>"Year");

$RULE_TYPE_ARR = array("M"=>"Module","C"=>"Course");

$SECTION_TYPE_ARR = array("H"=>"Home Page","L"=>"Listing Page");

$BANNER_TYPE_ARR = array("V"=>"Video", "I"=>"Image");

$OFFER_TYPE_ARR = array("P"=>"Price Drop", "C"=>"Coupons");

$OFFER_TARGET_ARR = array("A"=>"All", "M"=>"Modules", "C"=>"Courses");

$FEATURE_TYPE_ARR = array("M"=>"Module", "C"=>"Course");

$BLOOD_GROUP_ARR = array('A+'=>'A+', 'A-'=>'A-', 'B+'=>'B+', 'B-'=>'B-', 'AB+'=>'AB+', 'AB-'=>'AB-', 'O+'=>'O+', 'O-'=>'O-');



$LOG_TYPE_ARR = array('MODULE'=>'Module','COURSE'=>'Course','LESSON'=>'Lesson');

$LOG_CSS_ARR = array("I"=>"success","U"=>"alternate","D"=>"danger","UP"=>"alternate","DELPIC"=>"warning","DELVIDEO"=>"warning","CONVERT"=>"info","PUBLISH"=>"","DELRAW"=>"warning","DELCONVERT"=>"warning","CMA"=>"secondary",'TAG'=>'','UV'=>'alternate','CV'=>'warning','PV'=>'success','DV'=>'danger','P'=>'focus','CF'=>'secondary','RE'=>'secondary','RC'=>'secondary','F'=>'warning'); 



$STATUS_ARR2_2 = array('A'=>'Published', 'C'=>'Ready', 'U'=>'Pending Conversion', 'X'=>'Unavailable');

$STATUS_ARR2_CSS_BG = array('A'=>'tempting-azure', 'C'=>'warm-flame', 'U'=>'plum-plate', 'X'=>'asteroid');

$STATUS_ARR2_CSS_TEXT = array('A'=>'dark', 'C'=>'white', 'U'=>'white', 'X'=>'white');

$COMM_TYPE_ARR = array('MO'=>'MANUAL','SO'=>'OFFERS','SA'=>'ALERTS','SP'=>'PROMPTS');



$NOTIFICATION_TITLE_ARR = array("CO"=>"New Course", "MD"=>"New Module", "RG"=>"Welcome", "EX"=>"Expiry Alert", "SO"=>"New Offer", "SP"=>"Alert", "SA"=>"Alert");



$CLIENT_LISTING_TYPE_ARR = array("M"=>"Monthly", "Y"=>"Yearly");

$GENDER_ARR = array("M"=>"Male", "F"=>"Female");

$GENDER_ARR2 = array("M"=>"pe-7s-male icon-gradient bg-malibu-beach", "F"=>"pe-7s-female icon-gradient bg-warm-flame");

$FREE_TRIAL_ARR = array("7"=>"7 Days", "15"=>"15 Days", "30"=>"30 Days");

$EMAIL_TYPE_ARR2 = array("WEL"=>"Welcome", "UST"=>"Upcoming Session", "PST"=>"Past Session");

$RES_REF_ARR = array('RS' => 'Session Intro Video', 'RSD'=>'Session Self based Video', 'RF'=>'FAQ', 'RCS'=>'Cheet Sheet', 'RCC'=>'Club Curates');

// $SESSION_TYPE_ARR = array("LM"=>"Live Masterclasses", "SP"=>"Self-Paced Sessions", "MS"=>"Motivational Series", "GC"=>"Group Coaching Series");

$SESSION_TYPE_ARR = array("LM"=>"Live Masterclasses", "MO"=>"Motivational Series", "GO"=>"Group Coaching Series");

$MAIL_STATUS_ARR = array("D"=>"Draft", "Q"=>"Queed For Sending", "A"=>"Sent Successfully", "F"=>"Sending Failed", "I"=>"Inactive");

$QSTN_TYPE_ARR = array("S"=>"MCQ");

$LINK_TYPE_ARR = array("I"=>"Internal", "E"=>"External", "N"=>"No Link");

$BANNER_AREA = array("D"=>"Dashboard", "LO"=>"Live Online Classes", "SP"=>"Self Paced", "MO"=>"Motivation", "CO"=>"Coaching");

$QNA_STATUS_ARR = array("U"=>"Un-answered", "D"=>"Draft", "A"=>"Answered");

$VACCINATED_ARR = array('0'=>'NO', '1'=>'First Dose', '2'=>'Both Doses');

$DISTRICT_ARR = array('1'=>'North Goa', '2'=>'South Goa');

$TALUKA_ARR = array('1'=>'North Goa', '2'=>'South Goa');

$VACCINE_TYPE = array('1'=>'Covaxin', '2'=>'Sputnik', '3'=>'Covishield', '4'=>'Johnson & Johnson');



##	DEFINED ERROR MSGS	###################################################################################



define('NO_RECORDS_IN_TABLE', 'No Data Records Found In Table');

define('READONLY_ACCESS', '<div class="err_lbl1" align="center">You Can No Longer Add/ Modify Records For This Module Locally. Inorder To Do So, You Need To Login To The Online Module.</div>');

define('INVALID_ACCESS', 'Invalid Access Detected. Script Terminated.');

define('MODULE_ACCESS_DENIED', 'Invalid Access: You Do Not Have The Necessary Permissions To View This Module');

define('MODULE_EDIT_DENIED', 'Invalid Access: You Do Not Have The Necessary Permissions To Edit This Process');

define('INVALID_PARAMETER', 'Invalid Parameter Detected. Script Terminated.');



//Google Login API credentials

/* define('GOOGLE_CLIENT_ID', '603940379452-3ckhco8ncjakhuqftrghshq218678g9j.apps.googleusercontent.com');

define('GOOGLE_CLIENT_SECRET', 'd4egVFd1TeAilevK3fn27b0b'); */

/* define('GOOGLE_CLIENT_ID', '53169737742-18lud081nc4rvt7640rufbmbu5lv10rh.apps.googleusercontent.com');

define('GOOGLE_CLIENT_SECRET', '3foKjIh9ggdop9dz9vSCij-l');

define('GOOGLE_REDIRECT_URL', 'https://compute01.sirji.net/register.php');



define('FACEBOOK_CLIENT_ID', '2589233021188750');

define('FACEBOOK_CLIENT_SECRET', 'd683bcdfad8f2af8f729280f4fc18968');

define('FACEBOOK_REDIRECT_URL', 'https://compute01.sirji.net/fb-callback.php'); */

#######################################################################################################

$FULL_MONTH_ARR = array("01"=>"January", "02"=>"February", "03"=>"March", "04"=>"April", "05"=>"May", "06"=>"June", "07"=>"July", "08"=>"August", "09"=>"September", "10"=>"October", "11"=>"November", "12"=>"December");

#######################################################################################################



$PROGRAMTYPE_ARR = array('B'=>'Basic', 'P'=>'Premium', 'X'=>'Both');

$PROGRAMTYPE_ARR2 = array('B'=>'Basic', 'P'=>'Premium');

$PROGRAMSUBSCRIPTIONTYPE_ARR = array('B'=>'Basic', 'P'=>'Premium');

//$PROGRAM_TARIFFTYPE_ARR = array('P'=>'Programme', 'D'=>'Diet Plan', 'U'=>'Upgrade');

$PROGRAM_TARIFFTYPE_ARR = array('P'=>'Programme', 'D'=>'Diet Plan');

$DURATIONTYPE_ARR = array('D'=>'Days', 'M'=>'Months');

$PACKAGE_DURATIONTYPE_ARR = array('D'=>'Day(s)', 'W'=>'Week(s)', 'M'=>'Month(s)', 'Y'=>'Year(s)');

$PROGRAM_SECTION_ARR = array('W'=>'Warmup', 'E'=>'Exercise', 'C'=>'Cooldown');

$TIME_DURATION_ARR = array('S'=>'Seconds', 'M'=>'Minutes');



// $TSHIRT_SIZE_ARR = array('1'=>'-S (40)', '2'=>'L (42)', '3'=>'XL (44)');

$TSHIRT_SIZE_ARR = array('1'=>'XS (84-87 cm)', '2'=>"S (88-91 cm)", "3"=>"M (92-95 cm)", "4"=>"L (96-103 cm)", "5"=>"XL (104-113)", "6"=>"2XL (114-123 cm)");

$NOTIFICATION_SENDTO = array('A'=>'All', 'L'=>'List');

$MEASUREMENT_UNIT_ARR = array('1'=>'INCH','2'=>'CM','3'=>'KG');

$GRAPH_COLOR_ARR = array('1'=>'red', '2'=>'orange', '3'=>'yellow', '4'=>'green', '5'=>'blue', '6'=>'purple', '7'=>'grey', '8'=>'black');

$GRAPH_STAGE_COLOR_ARR = array('H'=>'red', 'Q'=>'orange', '3'=>'yellow', 'C'=>'green', '5'=>'blue', '6'=>'purple', 'X'=>'grey', 'D'=>'black');



$TRIAL_ARR = array('Y'=>'Free Trial', 'G'=>'Gifted', 'N'=>'Paid');

$TEMPLATE_TYPE_ARR = array('E'=>'Email', 'A'=>'App Notifications');

$ENC_CHARARR = array('1'=>'r', '2'=>'j', '3'=>'e', '4'=>'a', '5'=>'c', '6'=>'y', '7'=>'p', '8'=>'o', '9'=>'z', '0'=>'x');



$TEMPLATE_ID['STAFF_OTP_VERF'] = "1207162485485151568";

$SMS_TEMPLATE['STAFF_OTP_VERF'] = 'Dear <STAFF_NAME>, click here <LINK> to verify your mobile number. It is mandatory as per our employment guidelines. Regards, Mr. Farmer';



$TEMPLATE_ID['NOK_OTP_VERF'] = "1207162485485151568";

$SMS_TEMPLATE['NOK_OTP_VERF'] = 'Dear <NOK_NAME>, <STAFF_NAME> is in employment with Mr. Farmer, who has given your number to contact in case of emergency. Click here <LINK> to verify your mobile number. Regards, Mr. Farmer';









$DIFFICULTY_SUB_LEVEL = array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10', '11'=>'11', '12'=>'12');



$USER_REF_TYPE = array('A'=>'Admin', 'P'=>'PHC', 'V'=>'Volunteer', 'D'=>'Doctor');



$UPLOAD_TYPE_ARR = array('T'=>'Test Patients', 'P'=>'Covid +ve');



$TEST_STATUS_ARR = array('A'=>'Awaiting Results', 'Y'=>'Positive', 'N'=>'Negative');

$TEST_STATUS_CSS_ARR = array('A'=>'warning', 'Y'=>'danger', 'N'=>'success');



$PATIENT_STAGE_ARR = array('I'=>'Quarantined', 'H'=>'Hospitalised', 'D'=>'Deceased', 'X'=>'Dropped Out', 'C'=>'Monitoring Complete');

$PATIENT_STAGE_CSS_ARR = array('I'=>'alternate', 'H'=>'warning', 'D'=>'danger', 'X'=>'secondary', 'C'=>'success');



$PATIENT_STATUS_ARR = array('A'=>'Active', 'I'=>'Inactive');



$LOG_ENTRY_ARR = array('TEMPERATURE','OxygenSpO2','PULSE');

$LOG_ENTRY_ARR2 = array('COUGH','HEADACHE','SHORTNESS_BREATH','TIREDNESS','CHEST_PAIN','DROWSINESS');

$LOG_ENTRY_TYPE_ARR = array('M','A','N');

$LOG_ENTRY_TYPE_ARR2 = array('M'=>'Morning','A'=>'Afternoon','N'=>'Night');



$ADVICE_TYPE_ARR = array('P'=>'Note to Patient', 'V'=>'Note to Volunteer', 'D'=>'Note to Doctor', 'S'=>'Note to Self');

$TIMELINE_TYPE_CSS_ARR = array('NOTE'=>'color: #f7b924 !important;', 'TRIGGER'=>'color: #d92550 !important', 'LOG'=>'color: #3f6ad8 !important;'); 





$BACKGROUND_CSS_ARR = array('bg-warm-flame','bg-night-fade', 'bg-sunny-morning', 'bg-tempting-azure' ,'bg-amy-crisp', 'bg-heavy-rain', 'bg-mean-fruit' ,'bg-malibu-beach', 'bg-deep-blue', 'bg-ripe-malin', 'bg-arielle-smile', 'bg-plum-plate', 'bg-happy-fisher', 'bg-happy-itmeo', 'bg-mixed-hopes', 'bg-strong-bliss', 'bg-grow-early', 'bg-love-kiss', 'bg-premium-dark', 'bg-happy-green', 'bg-vicious-stance', 'bg-midnight-bloom', 'bg-night-sky', 'bg-slick-carbon', 'bg-royal', 'bg-asteroid', 'bg-transparent');



$PULSE_ARR = array('0-1'=>'80-160', '1-3'=>'80-130','3-6'=>'80-120','6-11'=>'70-110','11-14'=>'60-105','14-110'=>'60-100');



//$MIS_DASHBOARD_ARR = array('TP'=>'Total Invited', 'AA'=>'Awaiting Activation', 'X2'=>'Dropped Out', 'VU'=>'Volunteer Unassigned', 'AC'=>'Active Cases', 'Q'=>'Quarantine', 'H'=>'Hospitalised', 'D'=>'Deceased', 'X'=>'Dropped Out', 'C'=>'Monitoring Complete', 'PC'=>'Pending Contact', 'DU'=>'Doctor Unassigned', 'Y'=>'Total Positive', 'A'=>'Total Awaiting', 'N'=>'Total Negative', 'PN'=>'New Onboarded', 'PD'=>'Dormant Patient', 'CP'=>'Critical Patients', 'PL'=>'Patient Logs', 'CT'=>'Critical Triggers', 'TD'=>'Total Doctors', 'TV'=>'Total Volunteers', 'IV'=>'Inactive Volunteers', 'AT'=>'Attention');



$MIS_DASHBOARD_ARR = array('TP'=>'Total Invited', 'AA'=>'Awaiting Activation', 'X2'=>'Dropped Out', 'X'=>'Dropped Out', 'PC'=>'Pending Contact', 'VU'=>'Volunteer Unassigned', 'DU'=>'Doctor Unassigned', 'C'=>'Monitoring Complete', 'AC'=>'Active Cases', 'Q'=>'Quarantine', 'H'=>'Hospitalised', 'D'=>'Deceased', 'Y'=>'Total Positive', 'A'=>'Total Awaiting', 'N'=>'Total Negative', 'PN'=>'New Onboarded', 'PD'=>'Dormant Patient', 'CP'=>'Critical Patients', 'PL'=>'Patient Logs', 'CT'=>'Critical Triggers', 'TD'=>'Total Doctors', 'TV'=>'Total Volunteers', 'IV'=>'Inactive Volunteers', 'AT'=>'Attention');



$MIS_APPROVED_DASHBOARD_ARR = array('AC'=>'Active Cases', 'Q'=>'Home Isolated', 'CT'=>'Critical Triggers', 'H'=>'Hospitalised');



$MIS_APPROVED_DASHBOARD_ARR2 = array('TD'=>'Total Doctors', 'TV'=>'Total Volunteers', 'IV'=>'Inactive Volunteers', 'AT'=>'Attention');



$MIS_DASHBOARD_CSS_ARR = array('TP'=>'bg-warm-flame', 'AA'=>'bg-night-fade', 'X2'=>'bg-vicious-stance', 'VU'=>'bg-sunny-morning', 'AC'=>'bg-tempting-azure', 'Q'=>'bg-amy-crisp', 'H'=>'bg-love-kiss', 'D'=>'bg-asteroid', 'X'=>'bg-slick-carbon', 'C'=>'bg-happy-green', 'PC'=>'bg-mean-fruit', 'DU'=>'bg-midnight-bloom', 'Y'=>'bg-deep-blue', 'A'=>'bg-ripe-malin', 'N'=>'bg-arielle-smile', 'PN'=>'bg-premium-dark', 'PD'=>'bg-happy-itmeo', 'CP'=>'bg-mixed-hopes', 'PL'=>'bg-midnight-bloom', 'CT'=>'bg-plum-plate', 'TD'=>'bg-strong-bliss', 'TV'=>'bg-grow-early', 'IV'=>'bg-mean-fruit', 'AT'=>'bg-happy-fisher');



$AGE_GROUP_ARR = array('1'=>'0-10', '2'=>'11-20', '3'=>'21-30', '4'=>'31-40', '5'=>'51-60', '6'=>'61-70', '7'=>'71-80', '8'=>'81-90', '9'=>'91-100', '10'=>'101-200');

$AGE_GROUP_ARR2 = array('1'=>'0-10', '2'=>'11-20', '3'=>'21-30', '4'=>'31-40', '5'=>'51-60', '6'=>'61-70', '7'=>'71-80', '8'=>'81-90', '9'=>'91-100', '10'=>'101+');



$PIE_STAGE_ARR = array('Q'=>'Quarantined', 'H'=>'Hospitalised', 'D'=>'Deceased', 'X'=>'Dropped Out', 'C'=>'Monitoring Complete');



$MIS_DASHBOARD_LINK_ARR = array('TP'=>'invite_list.php', 'AA'=>'invite_list.php?srch_mode=QUERY&active=N', 'X2'=>'invite_list.php?srch_mode=QUERY&active=X', 'VU'=>'invite_list.php?srch_mode=QUERY&volassigned=N', 'AC'=>'patient_disp.php', 'Q'=>'patient_disp.php?srch_mode=QUERY&stage=I', 'H'=>'patient_disp.php?srch_mode=QUERY&stage=H', 'D'=>'patient_disp.php?srch_mode=QUERY&stage=D', 'X'=>'patient_disp.php?srch_mode=QUERY&stage=X', 'C'=>'patient_disp.php?srch_mode=QUERY&stage=C', 'PC'=>'patient_disp.php?srch_mode=QUERY&contacted=N', 'DU'=>'Doctor Unassigned', 'Y'=>'patient_disp.php?srch_mode=QUERY&teststatus=Y', 'A'=>'patient_disp.php?srch_mode=QUERY&teststatus=A', 'N'=>'patient_disp.php?srch_mode=QUERY&teststatus=N', 'PN'=>'patient_disp.php?srch_mode=QUERY&from=', 'PD'=>'dormant_list.php', 'CP'=>'patient_disp.php?srch_mode=QUERY&critical=Y', 'PL'=>'', 'CT'=>'risk_monitor_list.php?srch_mode=QUERY&date=', 'TD'=>'doctor_disp.php', 'TV'=>'volunteer_disp.php', 'IV'=>'report_volunteer_enagagement.php?srch_mode=QUERY&inactive=Y', 'AT'=>'report_patient_attention.php');



$COMORBIDITY_ARR = array('1'=>'Diabetes', '2'=>'Hypertension', '3'=>'Asthma', '4'=>'Heart Condition', '5'=>'Lungs/COPD');



$HEADER_CSS = array('A'=>' bg-secondary header-text-light', 'V'=>' bg-warning header-text-dark', 'D'=>' bg-warm-flame bg-flamed header-text-dark');

$SIDEBAR_CSS = array('A2'=>' bg-danger sidebar-text-light', 'V2'=>' bg-warning sidebar-text-dark', 'D2'=>' bg-warm-flame sidebar-text-dark');

$HEADER_HEADING_ARR = array('A'=>'Administrator', 'V'=>'Volunteer', 'D'=>'Doctor');

$HEADER_ICON_ARR = array('A'=>'fa-gavel', 'V'=>'fa-user', 'D'=>'fa-stethoscope');



$DROPOUT_REASON_ARR = array('1'=>'Patient is not interested in monitoring', '2'=>'Patient has recovered', '3'=>'Patient is deceased', '4'=>'Patient is not reachable', '5'=>'Patient is not responding');



$PATIENT_ONBOARD_SYMPTOM_ARR = array('1'=>'Fever', '2'=>'Cough', '3'=>'Bodyache', '4'=>'Throat Pain', '5'=>'Loss of Smell', '6'=>'Loss of Taste');



$DESIGNATION_ARR = array("1"=>"Administrator", "2"=>"Surveillance Staff", "3"=>"Surveillance Shift Manager", "4"=>"HOD", "5"=>"HR", '6'=>'Management', '7'=>'Surveillance HOD', '8'=>'Deputy HOD');



$RPT_STAGE_ARR = array("D"=>"Draft", "N"=>"Pending Review", "V"=>"Pending Verification", "R"=>"Action Pending", "P"=>"Closed"); //, "C"=>"Archived" // (New for the Surveillance HOD)



$RECOVERY_STATUS_ARR = array("R"=>"Recovered", "U"=>"Unrecovered", "NA"=>"N/A");



$DOC_TYPES_ARR = array("E"=>"Evidence", "W"=>"Warning Letter", "T"=>"Termination Letter", "S"=>"Salary Deduction");

?>