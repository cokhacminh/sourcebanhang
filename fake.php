<?php
include("db.php");
include("function/function.php");
$a = mysql_query("select * from user");
echo "<form method='get'><select name='id'>";
while($b = mysql_fetch_array($a))
{
	echo "<option value='{$b['id']}'>{$b['fullname']}</option>";
}
echo "</select><input type='submit' value='xem'></form>";
echo "<br />";
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	
	$sql = mysql_query("select sum(cod) as tiendoisoat from donhang where id_nhanvien ='{$id}' and doisoat='1' and ( thoigian between '2018-01-01 00:00:00' and '2018-01-27 23:59:59' )");
	$kq = mysql_fetch_array($sql);
	$tiendoisoat = $kq['tiendoisoat'];
	echo number_format($tiendoisoat);
	$sql = mysql_query("select sum(tongtien) as tien from donhang where id_nhanvien ='{$id}' and ( thoigian between '2018-01-28 00:00:00' and '2018-01-31 23:59:59' )");
	$kq = mysql_fetch_array($sql);
	echo " : ".number_format($kq['tien']);
	$tien = $kq['tien'];
	$tongtien = $tien + $tiendoisoat;
	echo " : ".number_format($tongtien);
	
}
echo "<form method='get'>
<input type='text' name='mdh' />
<input type='submit' value='OK' />
</form>
";
if(isset($_GET['mdh']))
{
	$mdh = $_GET['mdh'];
	$do = mysql_query("update donhang set status_id='99' where madonhang = '{$mdh}'");
	if($do) echo "Hoan Tat";
}




$a = mysql_query("select fullname,username from user");
echo "<form method='get'><select name='idlogin'>";
while($b = mysql_fetch_array($a))
{
	echo "<option value='{$b['username']}'>{$b['fullname']}</option>";
}
echo "</select><input type='submit' value='Đăng Nhập'></form>";
echo "<br />";
if(isset($_GET['idlogin']))
{
	    // Khởi động phiên làm việc (session)
	$username = $_GET['idlogin'];
	$sql_query = @mysql_query("SELECT id, username, passwd,groupid,fullname,mavandon,team_id,avatar FROM user WHERE username='{$username}'");
    $member = @mysql_fetch_array( $sql_query );
	if($member['groupid'] == 1)
			{
				$quyenhan['admin'] = TRUE;
				$quyenhan['smod'] = TRUE;
				$quyenhan['mod'] = TRUE;
				$quyenhan['banhang'] = TRUE;
				$quyenhan['xuatkho'] = TRUE;
				$quyenhan['nhapkho'] = TRUE;
				$quyenhan['carebill'] = TRUE;
				$group = "Giám Đốc";
			}
		else
			{
				$check_db_usergroup = getDataWhere("*","usergroup","id",$member['groupid']);
				$group = $check_db_usergroup['ten'];
				if ($check_db_usergroup['quanlynhanvien'] == "1" && $check_db_usergroup['nhapkho'] == "1" && $check_db_usergroup['banhang'] == "1" && $check_db_usergroup['xuatkho'] == "1")
				$quyenhan['smod'] = TRUE;
				$quyenhan['xuatkho'] = ($check_db_usergroup['xuatkho'] == '1') ? true : false;
				$quyenhan['nhapkho'] = ($check_db_usergroup['nhapkho'] == '1') ? true : false;
				$quyenhan['banhang'] = ($check_db_usergroup['banhang'] == '1') ? true : false;
				$quyenhan['mod'] = ($check_db_usergroup['quanlynhanvien'] == '1') ? true : false;
				$quyenhan['carebill'] = ($check_db_usergroup['carebill'] == '1') ? true : false;
				$quyenhan['admin'] = FALSE;
			}
		$fullname = $member['fullname'];
		$id_nhanvien = $member['id'];
		$mavandon_nhanvien = $member['mavandon'];
		$avatar_nhanvien = $member['avatar'];
		//Lấy thông tin team 
		$teamID = $member['team_id'];
		$a = mysql_query("select mavandon,hotline,idapi from team where id='{$teamID}'");
		$b = mysql_fetch_array($a);
		if($b['mavandon'] == "")$mavandon_team = "ER";
		else $mavandon_team = $b['mavandon'];
		$hotline = $b['hotline'];
		$idapi = $b['idapi'];
		$c = mysql_query("select maapi from api where id='{$idapi}'");
		$d = mysql_fetch_array($c);
		$myapi = $d['maapi'];
		$canhan = array("id_nhanvien"=>$id_nhanvien,"username"=>$username,"fullname"=>$fullname,"mavandon_nhanvien"=>$mavandon_nhanvien,"avatar_nhanvien"=>$avatar_nhanvien,"teamID"=>$teamID,"myapi"=>$myapi,"group"=>$group);
		$nhom = array("mavandon_team"=>$mavandon_team,"hotline"=>$hotline);
		//Tổng hợp
		$thongtintaikhoan = array("canhan"=>$canhan,"nhom"=>$nhom,"quyenhan"=>$quyenhan);
    // Khởi động phiên làm việc (session)
	
	setcookie("login","1",time() + 3600*5);
	setcookie("thongtintaikhoan",serialize($thongtintaikhoan),time() + 3600*5);
    // Thông báo đăng nhập thành công
           echo "<script>
alert('Đăng nhập thành công tài khoản {$username}');
window.location = \"index.php\"
</script>";
}
echo "<br><hr />";
echo "<form method='get'>
<input type='text' name='mdhfix' />
<input type='submit' value='OK' />
</form>
";
if(isset($_GET['mdhfix']))
{
	$mdhfix = $_GET['mdhfix'];
	$do = mysql_query("update donhang set goihang='0' where madonhang = '{$mdhfix}'");
	if($do) echo "Hoan Tat".$mdhfix;
}
?>