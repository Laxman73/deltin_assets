<?php
if(isset($logged) && !empty($logged))
{
	$LINK_ARR = array();
	if(count($MENU_ARR) && !empty($MENU_ARR))
	{
		foreach($MENU_ARR as $mKEY=>$mVALUE)
		{
			if(!empty($mVALUE['HREF']) && $mVALUE['HREF']!='javascript:;')
			{
				if(strpos($mVALUE['HREF'],'?') === false)
					array_push($LINK_ARR,$mVALUE['HREF']);
				else
				{
					$l = explode('?',$mVALUE['HREF']);
					array_push($LINK_ARR,$l['0']);
				}
			}
			
			if(isset($mVALUE['URLS']) && count($mVALUE['URLS']) && !empty($mVALUE['URLS']))
			{
				foreach($mVALUE['URLS'] as $k=>$v)
					array_push($LINK_ARR,$v);
			}
			
			if(!empty($mVALUE['IS_SUB']) && $mVALUE['IS_SUB']=='Y')
			{
				if(isset($mVALUE['SUB_MENU']) && count($mVALUE['SUB_MENU']) && !empty($mVALUE['SUB_MENU']))
				{
					foreach($mVALUE['SUB_MENU'] as $k=>$v)
					{
						if(isset($v['HREF'])) array_push($LINK_ARR,$v['HREF']);

						if(isset($v['URLS']) && count($v['URLS']) && !empty($v['URLS']))
						{
							foreach($v['URLS'] as $k2=>$v2)
								array_push($LINK_ARR,$v2);
						}

						if(!empty($v['IS_SUB']) && $v['IS_SUB']=='Y')
						{
							if(isset($v['SUB_MENU']) && count($v['SUB_MENU']) && !empty($v['SUB_MENU']))
							{
								foreach($v['SUB_MENU'] as $k3=>$v3)
								{
									if(isset($v2['HREF'])) array_push($LINK_ARR,$v3['HREF']);
								}
							}
						}
					}
				}
			}
		}

		if(in_array('home.php',$LINK_ARR))
		{
			
		}
		
		array_push($LINK_ARR,'_get_details.php');
		array_push($LINK_ARR,'ajax.inc.php');
		array_push($LINK_ARR,'logout.php');
		array_push($LINK_ARR,'test.php');
		array_push($LINK_ARR,'volunteer_patient_disp.php');
	}

	if(!empty($LINK_ARR) && count($LINK_ARR))
	{
		if(!in_array(basename($_SERVER["SCRIPT_NAME"]),$LINK_ARR))
		{
			header('location:home.php');
			exit;
		}
	}
}
?>