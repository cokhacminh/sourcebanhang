<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
function tinhhoahong($calamviec,$chinhanh,$doanhthu)
{
	$hoahong_casang = array("150000000","220000000","310000000","375000000","560000000");
	$hoahong_catoi_saigon = array("95000000","130000000","190000000","230000000","350000000");
	$hoahong_catoi_nhatrang = array("85000000","120000000","175000000","210000000","315000000");
	$tile_hoahong = array("0.5","0.6","0.7","0.8","1","1.5");
	if($calamviec == "Ca Sáng")
	$hoahong = $hoahong_casang;
	elseif($calamviec == "Ca Tối" && $chinhanh =="Sài Gòn")
	$hoahong = $hoahong_catoi_saigon;
	elseif($calamviec == "Ca Tối" && $chinhanh =="Nha Trang")
	$hoahong = $hoahong_catoi_nhatrang;
	
	//Bậc 1
	if($doanhthu < $hoahong[0])
		 return $bachoahong = $tile_hoahong[0];
	//Bậc 2
	elseif($doanhthu >= $hoahong[0] && $doanhthu < $hoahong[1])
		return $bachoahong = $tile_hoahong[1];
	//Bậc 3
	elseif($doanhthu >= $hoahong[1] && $doanhthu < $hoahong[2])
		return $bachoahong = $tile_hoahong[2];
		//Bậc 4
	elseif($doanhthu >= $hoahong[2] && $doanhthu < $hoahong[3])
		return $bachoahong = $tile_hoahong[3];
		//Bậc 5
	elseif($doanhthu >= $hoahong[3] && $doanhthu < $hoahong[4])
		return $bachoahong = $tile_hoahong[4];
		//Bậc 6
	elseif($doanhthu >= $hoahong[4])
		return $bachoahong = $tile_hoahong[5];

}

$a = tinhhoahong("Ca Sáng","Sài Gòn","100000000");
echo $a;











?>