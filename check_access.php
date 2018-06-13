<?php
include("db.php");
include("config.php");
if(!isset($_COOKIE['login']) or $_COOKIE['login'] == 0)
{
	include("template/login.php");
}
elseif($_COOKIE['login'] == "2")
{
echo "<script type=\"text/javascript\">
           window.location = \"{$site_url}/template/lockscreen.php\"
      </script>";	
}
elseif(isset($_COOKIE['thongtintaikhoan']))
{
	$thongtintaikhoan = unserialize($_COOKIE['thongtintaikhoan']);
	$thongtincanhan = $thongtintaikhoan['canhan'];
	$username = $thongtincanhan['username'];
	$fullname = $thongtincanhan['fullname'];
	$id_nhanvien = $thongtincanhan['id_nhanvien'];
	$mavandon_nhanvien = $thongtincanhan['mavandon_nhanvien'];
	$avatar_nhanvien = $thongtincanhan['avatar_nhanvien'];
	if($avatar_nhanvien =="")$avatar_nhanvien = "noavatar.png";
	$teamID = $thongtincanhan['teamID'];
	$thongtinnhom = $thongtintaikhoan['nhom'];
	$mavandon_team = $thongtinnhom['mavandon_team'];
	$hotline = $thongtinnhom['hotline'];
	$myapi = $thongtincanhan['myapi'];
	$quyenhan = $thongtintaikhoan['quyenhan'];
	$group = $thongtincanhan['group'];
}
if(isset($_GET['dosomething']))
{
	$do = $_GET['dosomething'];
	if($do =="lockscreen")
	{
		setcookie("login","2",time()+3600*5);
		echo "<script type=\"text/javascript\">
           window.location = \"{$site_url}/template/lockscreen.php\"
      </script>";	
	}
	if($do =="logout")
	{
		setcookie("login","",time()-3600*5,"/");
		setcookie("thongtintaikhoan","",time()-3600*5,"/");
		echo "<script type=\"text/javascript\">
           window.location = \"{$site_url}\"
      </script>";	
	}
}
?>
