<?php

if (!$_SESSION['cart']) die('empty cart');

$from_zip = '11354';
$to_zip = $_POST['zipcode'];

if (!$to_zip) die('[]');


$weight = 0;
foreach($_SESSION['cart'] as $p)
{
	if (intval($p['weight']) > 0) $weight += $p['weight']*$p['qty'];
}
if (!$weight) $weight = 1;
if ($weight > 150) $weight = 150;

$server="http://www.ups.com/using/services/rave/qcostcgi.cgi?accept_UPS_license_agreement=yes&10_action=4&13_product=3DS&14_origCountry=US&15_origPostal={$from_zip}&&19_destPostal=".$to_zip."&22_destCountry=US&23_weight=".$weight."&47_rate_chart=Customer Counter&48_container=00&&49_residential=1";

$s = file_get_contents($server);


$arr = explode("\n", $s);

$re = array();
for($i=0; $i<count($arr)-1; $i++)
{
	if (!trim($arr[$i])) continue;
	$_arr = explode('%',$arr[$i]);
	if ($_arr[1] && $_arr[10])
	{
		$re[] = array('code'=>$_arr[1],'name'=>get_ups($_arr[1]),'price'=>$_arr[10]);
	}
}
echo json_encode($re);


function get_ups($s)
{
		switch($s)
		{
			case "1DM":
				return "UPS Next Day Air Early AM";
			break;
			case "1DA":
				return "UPS Next Day Air";
			break;
			case "1DP";
				return "UPS Next Day Air Saver";
			break;
			case "2DA":
				return "UPS 2nd Day Air";
			break;
			case "3DS":
				return "UPS 3 Days Selected";
			break;
			default:
				return "UPS Ground";
			break;
	}
}

die;