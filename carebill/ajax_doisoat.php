<?php
include("config.php");
include("check_access.php");
include("api.php");
//Đối soát đơn hàng
if(isset($_POST['doisoatdonhang']))
{
	$ketqua ="";
	$thangnay = date("Y-m");
	$homnay = date("Y-m-d");
	$doisoat = $_POST['doisoatdonhang'];
	$solan = 0;
	if($doisoat =="0")
	{

			$sql = mysql_query("select ghtk from donhang where ( thoigian between '2018-03-01 00:00:00' and '{$homnay} 23:59:59' ) and  ( status_id ='6' or  status_id ='11' ) and id_nhanvien='{$id_nhanvien}' and doisoat='0'");	

		while($do = mysql_fetch_array($sql))
		{
			$ghtk = $do['ghtk'];
			$update = doisoat($ghtk);
			$ketqua .= $update;
		}
		echo "<script>
						swal({
						  title: ' KẾT QUẢ!!',
						  html:'{$ketqua}',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							location.reload();
						  	})
						</script>";
	}
	else
	{

			$sql = mysql_query("select ghtk from donhang where ( thoigian between '2018-03-01 00:00:00' and '{$thangnay}-{$update} 23:59:59' ) and  status_id !='6' and  status_id !='99' AND status_id !='9' and status_id !='11' and (ghtk != '') and id_nhanvien='{$id_nhanvien}'");	

		
		//$sql = mysql_query("select ghtk from donhang where ( thoigian between '{$thangnay}-01 00:00:00' and '{$homnay} 23:59:59' ) and  status_id !='6' and  status_id !='99' AND status_id !='9' and status_id !='11' and (ghtk != '')");
		while($do = mysql_fetch_array($sql))
		{
			$ghtk = $do['ghtk'];
			$update = doisoat($ghtk);
			$ketqua .= $update;
			$solan ++;
		}
		if($ketqua =="")$ketqua = "Đã đối soát toàn bộ đơn hàng";
		if($solan == 0)$ketqua_title = "KẾT QUẢ !!";
		else $ketqua_title = "ĐÃ ĐỐI SOÁT {$solan} ĐƠN HÀNG !!";
		echo "<script>
						swal({
						  title: ' {$ketqua_title}!!',
						  html:'{$ketqua}',
						  type: 'success',
						  showCancelButton: false,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: 'OK !!!'
						}).then(function () {
							location.reload();
						  	})
						</script>";
	}
}
?>