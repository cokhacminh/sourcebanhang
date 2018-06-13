<?php
include("../function/function.php");
include("../db.php");
include("../config.php");
if(isset($_POST['user']) && isset($_POST['passwd']) && $_POST['user'] != "" && $_POST['passwd'] !="")
{

    // Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
    $username = addslashes( $_POST['user'] );
    $password = md5( addslashes( $_POST['passwd'] ) );
    // Lấy thông tin của username đã nhập trong table members
    $sql_query = @mysql_query("SELECT id, username, passwd,groupid,fullname,mavandon,team_id,avatar FROM user WHERE username='{$username}'");
    $member = @mysql_fetch_array( $sql_query );
    // Nếu username này không tồn tại thì....
    if ( @mysql_num_rows( $sql_query ) <= 0 )
    {
       echo "<script>
				swal(
				  'CÓ LỖI !',
				  'Tên đăng nhập {$username} không tồn tại !',
				  'warning'
				)
				</script>";
        exit;
    }
    // Nếu username này tồn tại thì tiếp tục kiểm tra mật khẩu
    if ( $password != $member['passwd'] )
    {
              echo "<script>
					swal(
					  'CÓ LỖI !',
					  'Sai mật khẩu !',
					  'warning'
					)
					</script>";
        exit;
    }
    elseif($password == $member['passwd'])
    {
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
	
	setcookie("login","1",time() + 3600*5, "/");
	setcookie("thongtintaikhoan",serialize($thongtintaikhoan),time() + 3600*5,"/");

    // Thông báo đăng nhập thành công
           echo "<script>
swal({
  title: 'Đăng nhập thành công',
  type: 'success',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Vào trang bán hàng'
}).then(function () {
  window.location = \"index.php\"
})
</script>";
}
}
else
echo "<script>
swal(
  'CÓ LỖI !',
  'Bạn nhập thiếu tên đăng nhập hoặc mật khẩu !',
  'warning'
)
</script>";

?>