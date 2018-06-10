<?php
include("../db.php");
$homnay = date("Y-m-d");

//Hàm xử lý top đơn hàng
function topdon($time_start,$time_end)
{
$html = "";
$topdon = "";
$sql_statisday = mysql_query("SELECT COUNT(madonhang) as tongdon,id_nhanvien FROM `donhang` WHERE thoigian BETWEEN '{$time_start} 00:00:00' and '{$time_end} 23:59:59' GROUP BY id_nhanvien ORDER BY tongdon desc");
while($statis_today = mysql_fetch_array($sql_statisday))
{
	$userid = $statis_today['id_nhanvien'];
	$tongdon = $statis_today['tongdon'];
	$tennhanvien = getname($userid);
	$html .= "<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$tennhanvien}</td><td><font color='red'>{$tongdon} </font>đơn</td></tr>";
}
	$topdon = "<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>{$html}</table>";
	return $topdon;

}
//Danh sách nhóm
function listteam($time)
{
	$html = "";
	$html_listteam = "";
	$sql_team = mysql_query("select id,ten from team");
	while($data_team = mysql_fetch_array($sql_team))
	{										
		$html .= "<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td><button class='btn btn-sm btn-success' onclick=\"viewteam('{$time}-{$data_team['id']}')\">{$data_team['ten']}</button></td></tr>";
	}
		$html_listteam =  "<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>{$html}</table>";  
		echo $html_listteam;
}

//
if(isset($_POST['xemthongke']))
{
  
  $thoigian = $_POST['xemthongke'];
  $time = time();
  $homnay = date("Y-m-d");
  $homqua = $time-(24*60*60);
  $homqua = date("Y-m-d",$homqua);
  if($thoigian =="today")
    {
		$topsales = topdon($homnay,$homnay);
    }
    
    elseif($thoigian =="lastday")
    {
		$topsales = topdon($homqua,$homqua);
    }
	echo $topsales;
}
if(isset($_POST['viewbybuttonteam']))
{
  
  $thoigian = $_POST['viewbybuttonteam'];
  if($thoigian =="today")
    {
		$button = listteam($thoigian);
    }
    
    elseif($thoigian =="lastday")
    {
		$button = listteam($thoigian);
    }
	echo $button;
}
if(isset($_POST['xemtheongay']) && $_POST['xemtheongay'] == "true")
{
  $fromdate = $_POST['tungay'];
  $tungay = CreatFromDate($fromdate);
  $todate = $_POST['denngay'];
  $denngay = CreatToDate($todate);
   $sql_tilechot = mysql_query("select sum(comments) as total_comments from tilechot where ngay between '{$tungay}' and '{$denngay}'");  
      $sql = mysql_query("select id from donhang where thoigian between '{$tungay}' and '{$denngay}'");
      $sql2 = mysql_query("select id from donhang where guihang='1' and ( thoigian between '{$tungay}' and '{$denngay}' )");
      $sql3 = mysql_query("select id from donhang where tinhtrang='1' and (  thoigian between '{$tungay}' and '{$denngay}' )");
    $tongdon = mysql_num_rows($sql);
    $hangdagui = mysql_num_rows($sql2);
    $hanghoan = mysql_num_rows($sql3);
    $data = mysql_fetch_array($sql_tilechot);
    $tongcomments = $data['total_comments'];
    //Xu ly danh sach ngay
    
    $tilechottrungbinh = round($tongcomments/$tongdon,2);
    $thang = date("Y-m");
    $dauthang = $thang."-1";
    $strdauthang = strtotime($dauthang);
    $showviewbydate = showviewbydate($strdauthang);
    $showstatisbydate = showstatisbydate($strdauthang);
    $data_topthang = topthang();
    $option_danhsachngay = $data_topthang['option_ngay'];
    echo "
<div class=\"col-md-12\" style=\"margin-bottom: 20px;\">
        <div class=\"col-md-3\">
                  <div class=\"panel-body panel-featured-top panel-featured-danger\">
                    <div class=\"widget-summary widget-summary-md\">
                      <div class=\"widget-summary-col widget-summary-col-icon\">
                        <div class=\"summary-icon bg-danger\">
                          <i class=\"fa fa-shopping-cart\"></i>
                        </div>
                      </div>
                      <div class=\"widget-summary-col\">
                        <div class=\"summary\">
                          <h4 class=\"title\" style=\"font-size: 15px;font-weight: 600\">Tổng Đơn</h4>
                          <div class=\"info\">
                            <strong class=\"amount\"><font color=\"red\">{$tongdon} đơn</font> </strong>
                           
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
        </div>
        <div class=\"col-md-3\">
                  <div class=\"panel-body panel-featured-top panel-featured-success\">
                    <div class=\"widget-summary widget-summary-md\">
                      <div class=\"widget-summary-col widget-summary-col-icon\">
                        <div class=\"summary-icon bg-success\">
                          <i class=\"fa fa-comments\"></i>
                        </div>
                      </div>
                      <div class=\"widget-summary-col\">
                        <div class=\"summary\">
                          <h4 class=\"title\" style=\"font-size: 15px;font-weight: 600\">Tổng Comments</h4>
                          <div class=\"info\">
                            <strong class=\"amount\"><font color=\"red\">{$tongcomments} </font>Comments</strong>
                            <span class=\"text-primary\"></span>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
        </div>        
        <div class=\"col-md-3\">
                  <div class=\"panel-body panel-featured-top panel-featured-primary\">
                    <div class=\"widget-summary widget-summary-md\">
                      <div class=\"widget-summary-col widget-summary-col-icon\">
                        <div class=\"summary-icon bg-primary\">
                          <i class=\"fa fa-life-ring\"></i>
                        </div>
                      </div>
                      <div class=\"widget-summary-col\">
                        <div class=\"summary\">
                          <h4 class=\"title\" style=\"font-size: 15px;font-weight: 600\">Tỉ lệ chốt</h4>
                          <div class=\"info\">
                            <strong class=\"amount\" style=\"padding-left: 10px;\"><font color=\"red\">{$tilechottrungbinh}</font></strong>
                            
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
        </div>  
        <div class=\"col-md-3\">
                  <div class=\"panel-body panel-featured-top panel-featured-danger\">
                    <div class=\"widget-summary widget-summary-md\">
                      <div class=\"widget-summary-col widget-summary-col-icon\">
                        <div class=\"summary-icon bg-danger\">
                          <i class=\"fa fa-shopping-cart\"></i>
                        </div>
                      </div>
                      <div class=\"widget-summary-col\">
                        <div class=\"summary\">
                          <h4 class=\"title\" style=\"font-size: 15px;font-weight: 600\">Đơn Đã Gửi</h4>
                          <div class=\"info\">
                            <strong class=\"amount\"><font color=\"red\">{$hangdagui} đơn</font></strong>
                            
                          </div>
                        </div>
                        <div class=\"summary-footer\">
                          
                        </div>
                      </div>
                    </div>
                  </div>
        </div>  

        </div>  
        
        <div class=\"col-md-12\"> 
      <div class=\"col-md-3\" id=\"accordion\">

        <div class=\"col-md-12\">
              
              <div class=\"tabs\">
                
                <div class=\"tab-content\" style=\"height: 300px;line-height: 45px;padding-top: 30px\">
                  <div id=\"popular10\" class=\"tab-pane active\">
                  <div style=\"margin-bottom:5px;margin-top:-50px\">
                  
                  <div class=\"col-md-12 form-group\">
                  <select data-plugin-selectTwo class=\"form-control populate placeholder\" data-plugin-options='{ \"placeholder\": \"Chọn ngày\", \"allowClear\": true }' onchange=\"statisbydate(this.value)\">
                                {$option_danhsachngay}
                                  
                              </select>
                   </div> 
                   </div>       
                  <hr />
                  <div class=\"scrollable visible-slider colored-slider\" data-plugin-scrollable=\"\" style=\"height: 200px;\">
                  <div id=\"result_statisbydate\" class=\"scrollable-content\">
            {$showstatisbydate}
                  </div>
                  </div>
                  </div>
                </div>
              </div>
          
            </div>
      </div>
      <div class=\"col-md-6\" id=\"accordion\">

        <div class=\"col-md-12\">
              
              <div class=\"tabs\">
                
                <div class=\"tab-content\" style=\"height: 300px;line-height: 45px;padding-top: 30px\">
                  <div id=\"popular10\" class=\"tab-pane active\">
                  <div style=\"margin-bottom:5px;margin-top:-50px\">
                  <div class=\"col-md-5 form-group\">
                  CHỌN NGÀY :
                  </div>
                  <div class=\"col-md-7 form-group\">
                  <select data-plugin-selectTwo class=\"form-control populate placeholder\" data-plugin-options='{ \"placeholder\": \"Chọn ngày\", \"allowClear\": true }' id=\"viewbydate\" onchange=\"viewbydate(this.value)\" name=\"viewbydate\">
                                {$option_danhsachngay}
                                  
                              </select>
                   </div> 
                   </div>       
                  <hr />
                  <div class=\"scrollable visible-slider colored-slider\" data-plugin-scrollable=\"\" style=\"height: 200px;\">
                  <div id=\"result_viewbydate\" class=\"scrollable-content\">
                  {$showviewbydate}
                  </div>
                  </div>
                  </div>
                </div>
              </div>
          
            </div>
      </div>
      <div class=\"col-md-3\" id=\"accordion\">
        <div class=\"col-md-12\">
              
              <div class=\"tabs\">
                <ul class=\"nav nav-tabs nav-justified\">
                  <li class=\"active\">
                    <a href=\"#popular1\" data-toggle=\"tab\" class=\"text-center\" aria-expanded=\"true\"><i class=\"fa fa-star\"></i>TOP NHÂN VIÊN TRONG THÁNG </a>
                  </li>

                </ul>
                <div class=\"tab-content\" style=\"height: 250px;\">
                  <center><strong>TOP ĐƠN HÀNG TRONG THÁNG</strong></center>  
                  <div id=\"popular1\" class=\"tab-pane active\">
                  <div class=\"scrollable visible-slider colored-slider\" data-plugin-scrollable style=\"height: 200px;\">
                    <div class=\"scrollable-content\">                  
                   {$top_thang}
                    
                    </div>
                  </div>
                  </div>
                  <div id=\"recent1\" class=\"tab-pane\">
                <center><strong>TOP NHÂN VIÊN TRONG THÁNG</strong></center> 
                  </div>
                </div>
              </div>
            
            </div>
      </div>  
  </div>
    ";
}
if(isset($_POST['viewteam']))
{
	$namnay = date("Y");
	$homnay = date("Y-m-d");
	$thangnay = date("m");
	if($thangnay =="1")
	{
		
		$namngoai = $namnay - 1;
		$lastmonth = $namngoai."-12";
	}
	elseif($thangnay !="1")
	{
		$thangtruoc = $thangnay - 1;
		$lastmonth = $namnay."-".$thangtruoc;
	}
	$thistime = time();
	$time_lastday = $thistime - (60*60*24);
	$lastday = date("Y-m-d",$time_lastday);
	$thismonth = date("Y-m");
	$viewteam = $_POST['viewteam'];
	$tach_viewteam = explode("-",$viewteam);
	$time = $tach_viewteam[0];
	$teamid = $tach_viewteam[1];
	switch($time)
	{
		case "today" : $time_start = $homnay;$time_end=$homnay;break;
		case "lastday" : $time_start = $lastday;$time_end=$lastday;break;
		case "thismonth" : $time_start = $thismonth."-01";$time_end=$thismonth."-31";break;
		case "lastmonth" : $time_start = $lastmonth."-01";$time_end=$lastmonth."-31";break;
		default : $time_start = $homnay;$time_end=$homnay;break;
	}
	$html = "";
	$sql_statis_by_team = mysql_query("SELECT COUNT(madonhang) as tongdon,id_nhanvien FROM `donhang` WHERE ( thoigian BETWEEN '{$time_start} 00:00:00' and '{$time_end} 23:59:59' ) and id_nhanvien in ( select id from user where team_id='{$teamid}') GROUP BY id_nhanvien ORDER BY tongdon desc");
	while($statis_by_team = mysql_fetch_array($sql_statis_by_team))
	{
		$idnhanvien = $statis_by_team['id_nhanvien'];
		$tennhanvien = getname($idnhanvien);
		$tongdon = $statis_by_team['tongdon'];
		$html.="<tr style='border-bottom:0.01em dashed  rgba(0, 0, 0, 0.41);'><td>{$tennhanvien}</td><td><font color='red'>{$tongdon}</font></td></tr>";
	}
	$html_show = "<table style='width:100%;margin:10px auto;color:black;font-size:20px;line-height:35px'>{$html}</table>"; 

	echo $html_show;
	
}
?>