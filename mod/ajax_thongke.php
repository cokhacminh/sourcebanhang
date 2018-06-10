<?php
include("../config.php");
include("../check_access.php");
$homnay = date("Y-m-d");
    function timthu($weekday){
    switch($weekday) {
        case 'monday':
            $array[0] = 'Thứ hai';$array[1] = 0;
            break;
        case 'tuesday':
            $array[0] = 'Thứ ba';$array[1] = 1;
            break;
        case 'wednesday':
            $array[0] = 'Thứ tư';$array[1] = 2;
            break;
        case 'thursday':
            $array[0] = 'Thứ năm';$array[1] = 3;
            break;
        case 'friday':
            $array[0] = 'Thứ sáu';$array[1] = 4;
            break;
        case 'saturday':
            $array[0] = 'Thứ bảy';$array[1] = 5;
            break;
        case 'sunday':
            $array[0] = 'Chủ Nhật';$array[1] = 6;
            break;
    }
    return $array;
     }
if(isset($_GET['userid']))
{
	$userid = $_GET['userid'];
	$weekday_func = timthu($weekday);
    $dautuan = $weekday_func[1];
    $today = date("Y-m-d");
    $today_str = strtotime($today);
    $ngaydautuan = $today_str - ($dautuan*60*60*24);
    $html_ngaydautuan = date("d-m-Y",$ngaydautuan);
    $total_order_of_week = 0;
    for ($i=0; $i < 7; $i++) 
    { 
	  	$ngay = $ngaydautuan + ($i*60*60*24);
	  	$ngay_bd = date("Y-m-d 00:00:00",$ngay);
	  	$ngay_kt = date("Y-m-d 23:59:59",$ngay);
	  	$sql = mysql_query("select id from donhang where id_nhanvien='{$userid}' and ( thoigian between '{$ngay_bd}' and '{$ngay_kt}')");
	  	$total_dh = mysql_num_rows($sql);
	  	$total_order_of_week+= $total_dh;
	  	$thu = strtolower(date("l",$ngay));
	  	$thu_func = timthu($thu);
	  	$thu_ht = $thu_func[0];
	  	$array_total[$thu_ht] = $total_dh;
	  	$result = "";

    }    
    	foreach ($array_total as $key=>$value) 
    	{
			$result.= "[\"{$key}\", $value],";
		}
		echo "
													

														var flotDashSales1Data = [{
														    data: [

		{$result}
														        
														    ],
														    color: \"#0088cc\"
														}];
			";
}


if(isset($_POST['viewstats']) && $_POST['viewstats'] != "")
{
    $userid = $_POST['viewstats'];
    $weekday = date("l");
    $weekday = strtolower($weekday);
    $weekday_func = timthu($weekday);
    $dautuan = $weekday_func[1];
    $today = date("Y-m-d");
    $today_str = strtotime($today);
    $ngaydautuan = $today_str - ($dautuan*60*60*24);
    $html_ngaydautuan = date("d-m-Y",$ngaydautuan);
    $total_order_of_week = 0;
	$thang = date("Y-m");
	$dauthang = $thang."-1";
	$homnay = date("Y-m-d");
    for ($i=0; $i < 7; $i++) 
    { 
        $ngay = $ngaydautuan + ($i*60*60*24);
        $ngay_bd = date("Y-m-d 00:00:00",$ngay);
        $ngay_kt = date("Y-m-d 23:59:59",$ngay);
        $tilechot_ngay = date("Y-m-d",$ngay);
        $sql = mysql_query("select id from donhang where id_nhanvien='{$userid}' and ( thoigian between '{$ngay_bd}' and '{$ngay_kt}')");
        $total_dh = mysql_num_rows($sql);
		$tongdoanhthu = 0;
        $thu_ht = date("d/m",$ngay);
        $array_tilechot[$thu_ht] = array($total_dh,$tongdoanhthu);
    }    
    $html_chart = "";
    foreach($array_tilechot as $chart_thu=>$mangcon)
    {


            $html_chart.= "{ y: '{$chart_thu}', a: {$mangcon[0]}, b: {$mangcon[1]} },";

    }

    echo "

                        
<script type=\"text/javascript\">
                        
                                            Morris.Bar({
  element: 'bar-example',
  data: [
{$html_chart}

  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Số Đơn', ''],
 barColors: [\"green\", \"red\", \"#1AB244\", \"#B29215\"],
});
                        
                                        </script>
                        
                                            

    ";

}
if(isset($_POST['viewstats']) && $_POST['viewstats'] == "")
{
    
    $weekday = date("l");
    $weekday = strtolower($weekday);
    $weekday_func = timthu($weekday);
    $dautuan = $weekday_func[1];
    $today = date("Y-m-d");
    $today_str = strtotime($today);
    $ngaydautuan = $today_str - ($dautuan*60*60*24);
    $html_ngaydautuan = date("d-m-Y",$ngaydautuan);
    $total_order_of_week = 0;
    for ($i=0; $i < 7; $i++) 
    { 
        $ngay = $ngaydautuan + ($i*60*60*24);
        $ngay_bd = date("Y-m-d 00:00:00",$ngay);
        $ngay_kt = date("Y-m-d 23:59:59",$ngay);
        $tilechot_ngay = date("Y-m-d",$ngay);
        $sql = mysql_query("select id from donhang where ( thoigian between '{$ngay_bd}' and '{$ngay_kt}')");
        $total_dh = mysql_num_rows($sql);
        $sql1 = mysql_query("select sum(comments) as total_comments from tilechot where ngay='{$tilechot_ngay}'");
        $sql_tlc = mysql_fetch_array($sql1);
        $tongcomments = $sql_tlc['total_comments'];    
        if($tongcomments == NULL) $tongcomments = 0;
        
        
        if($total_dh > 0)
            $tilechot = round($tongcomments/$total_dh,2);
        else
            $tilechot = 0;
       
        $thu_ht = date("d/m",$ngay);
        $array_tilechot[$thu_ht] = array($total_dh,$tilechot);
    }    
    $html_chart = "";
    foreach($array_tilechot as $chart_thu=>$mangcon)
    {


            $html_chart.= "{ y: '{$chart_thu}', a: {$mangcon[0]}, b: {$mangcon[1]} },";

    }
    

    echo "

                        
<script type=\"text/javascript\">
                        
                                            Morris.Bar({
  element: 'bar-example',
  data: [
{$html_chart}

  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Số Đơn', 'Tỉ Lệ Chốt'],
 barColors: [\"green\", \"red\", \"#1AB244\", \"#B29215\"],
});
                        
                                        </script>";
                                            
}
<?php
if($quyenhan['mod'] != "1")
echo "<script>
swal({
  title: 'Bạn không có quyền truy cập trang này',
  type: 'warning',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Thoát Ra'
}).then(function () {
  window.location = \"{$site_url}/template/errors.php\"
})
  
</script>";
?>	
?>