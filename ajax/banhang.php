<?php
include("../db.php");
include("../config.php");
include("../function/function.php");
if(isset($_POST['id_tinh']))
{
  $id_tinh = $_POST['id_tinh'];
  echo "<option value=\"0\">Vui lòng chọn Huyện</option>";
  $sql = mysql_query("select * from add_huyen where id_tinh='{$id_tinh}' order by ten desc");
  while($huyen = mysql_fetch_array($sql))
  {
    echo "
      <option value=\"{$huyen['id']}\">
      {$huyen['ten']}
      </option>
    ";
  }

}
if(isset($_POST['themthongtin_tinh']))
{
  $tinh = $_POST['themthongtin_tinh'];
  $tentinh = tentinh($tinh);
  echo "<input name=\"add_tinh\" type=\"text\" class=\"form-control\" readonly=\"readonly\" value=\"{$tentinh}\" required>";
}
if(isset($_POST['themthongtin_huyen']))
{
  $huyen = $_POST['themthongtin_huyen'];
  $tenhuyen = tenhuyen($huyen);
  echo "<input name=\"add_huyen\" type=\"text\" class=\"form-control\" readonly=\"readonly\" value=\"{$tenhuyen}\" required>";
}
if(isset($_POST['selectsanpham']))
{
	global $site_url;
	$arraysanpham = $_POST['selectsanpham'];
	foreach ($arraysanpham  as $value) {
		$idsanpham = $value;
		$info_sanpham = info_sanpham($idsanpham);

		echo "
	
	<div style=\"border: 1px solid #00000073;height: 250px;width: 200px;text-align: center;display: inline-block;margin-bottom:10px;border-radius:10px\">
	<div style=\"font-size: 20px;margin-top: 15px;font-weight: bolder;color: black;\">{$info_sanpham['masanpham']} {$info_sanpham['size']}</div>
	<div style=\"margin-top:5px;margin-bottom:5px\"><img src=\"{$site_url}/images/sanpham/{$info_sanpham['anhsanpham']}\" style=\"border:1px solid #00000042\" width=\"150px\" /> </div>
	<div class=\"col-xs-12\">
	
		<div style=\"display:inline-block;width:85px;text-align:left;padding-left:15px;margin-bottom:5px;float:left\">
		
		<input type=\"number\" name=\"{$value}\" class=\"form-control\" style=\"width:70px;display:inline;text-align:center\" value=\"1\" readonly=\"readonly\">
		</div>
		<div class=\"btn-group btn-block\" role=\"group\" aria-label=\"plus-minus\" style=\"width:50px;display:inline\">
			<button style=\"margin-top:3px\" type=\"button\" class=\"btn btn-sm btn-danger minus-button merge-top-left-button\"><span class=\"glyphicon glyphicon-minus\"></span></button>
			<button style=\"margin-top:3px\" type=\"button\" class=\"btn btn-sm btn-success plus-button merge-top-right-button\"><span class=\"glyphicon glyphicon-plus\"></span></button>
		</div>
   	
	</div>
												
	</div>

	";
}
	echo "

   										 <script>
$(document).ready( () => {
  $('.minus-button').click( (e) => {
    
    // change this to whatever minimum you'd like
    const minValue = 0

    const currentInput = $(e.currentTarget).parent().prev()[0];

    let minusInputValue = $(currentInput).find('input').val();

    if (minusInputValue > minValue) {
      minusInputValue --;
      $($(e.currentTarget).next()).removeAttr('disabled');
      $(currentInput).find('input').val(minusInputValue);

      if (minusInputValue <= minValue) {
        $(e.currentTarget).attr('disabled', 'disabled');
      }
    }
  });

  $('.plus-button').click( (e) => {
      
    const maxValue = 1000

    const currentInput = $(e.currentTarget).parent().prev()[0];

    let plusInputValue = $(currentInput).find('input').val();

    if (plusInputValue < maxValue) {
      plusInputValue ++;
      $($(e.currentTarget).prev()[0]).removeAttr('disabled');
      $(currentInput).find('input').val(plusInputValue);

      if (plusInputValue >= maxValue) {
        $(e.currentTarget).attr('disabled', 'disabled');
      }
    }
  });
}); 

</script>										 
												";
	
	
}
if(isset($_GET['do']) && $_GET['do'] =="banhang")
{
  /*
  $today_sql = date('Y-m-d');
  $thismonth = date("Y-m");

                      $check_session_orderCode = mysql_query("select max(date) as max_date from session_donhang");

                      if(mysql_num_rows($check_session_orderCode)>0)
                      {
                        $do_sql_check = mysql_fetch_array($check_session_orderCode);
                        $max_date = strtotime($do_sql_check['max_date']);
                        $max_date = date("Y-m-d",$max_date);
                        if($max_date!=$today_sql or $max_date =="")
                          {
                            $sql_delete_session_date = 'delete from session_donhang where id >0';
                            @mysql_query($sql_delete_session_date);
                            @mysql_query("ALTER TABLE session_donhang AUTO_INCREMENT = 1");
                            @mysql_query("insert into session_donhang (date) values ('{$today_sql}')");
                          }
                      }
                      if(isset($_POST['tenkhachhang']))$tenkhachhang = $_POST['tenkhachhang'];else $tenkhachhang = "";
                      if(isset($_POST['sdtkhachhang']))$sdtkhachhang = $_POST['sdtkhachhang'];else $sdtkhachhang = "";
                      if(isset($_POST['diachi']))$diachi = $_POST['diachi'];else $diachi = "";
                      if(isset($_POST['page']))$page = $_POST['page'];else $page = "";
                      if(isset($_POST['ghichu']))$ghichu = $_POST['ghichu'];else $ghichu = "";
                      if(isset($_POST['add_tinh']))$add_tinh = $_POST['add_tinh'];else $add_tinh="NULL";
                      if(isset($_POST['add_huyen']))$add_huyen = $_POST['add_huyen'];else $add_huyen="NULL";
                      if($add_tinh !="NULL"){$diachi_tinh = getaddress('add_tinh',$add_tinh);}else $diachi_tinh = "NULL";
                      if($add_huyen !="NULL"){$diachi_huyen = getaddress('add_huyen',$add_huyen);}else $diachi_huyen = "NULL";
                       unset($_POST['tenkhachhang']);
                       unset($_POST['sdtkhachhang']);
                       unset($_POST['diachi']);
                       unset($_POST['add_tinh']);
                       unset($_POST['add_huyen']);
                       unset($_POST['ghichu']);
                      
                      $madonhang[1] = "TK";
                      $donhang = "";
                      $tongtien = 0;
                      $thanhtien = 0;
                      $sanpham = "";
                      $show_phiship = number_format($phiship);
                      $donhang_html = "";
                      $count_sp = count($_POST);
                      $tongsanpham = 0;
                    if($count_sp > 1)
                    {
                      foreach ($_POST as $key => $value) 
                      {
                        $sql = mysql_query("select masanpham,size from sanpham where id='{$key}'");
                        $kq = mysql_fetch_array($sql);
                        $masanpham = $kq['masanpham'];
                        $size = $kq['size'];
                        $tensanpham = $masanpham." ".$size;
                        $sql = mysql_query("select giaban from masanpham where masanpham='{$masanpham}'");
                        $kq = mysql_fetch_array($sql);
                        $giaban = $kq['giaban'];
                        $thanhtien = $value * $giaban;
                        $show_thanhtien = number_format($thanhtien);
                        $tongtien += $thanhtien;
                        $donhang_html_a= "<b><font color='black'>".$tensanpham."</font></b> : <b><font color='red'>".number_format($giaban)." x ".$value." = ".$show_thanhtien." Đ</font></b><br /> ";
                        $donhang_html.=$donhang_html_a;
                        $donhang .= $tensanpham." : <b>".$value." bộ </b><br>";
                        $sanpham .=$key."-".$value."|";
                        $tongsanpham+=$value;
                        if($tongsanpham >= $freeship)
                         $phiship = 0;
                         else
                         $phiship = 30000; 
                      }
                    }
                    elseif($count_sp = 1)
                    {
                      foreach ($_POST as $key => $value) 
                      {
                        $sql = mysql_query("select masanpham,size from sanpham where id='{$key}'");
                        $kq = mysql_fetch_array($sql);
                        $masanpham = $kq['masanpham'];
                        $size = $kq['size'];
                        $tensanpham = $masanpham." ".$size;
                        $sql = mysql_query("select giaban from masanpham where masanpham='{$masanpham}'");
                        $kq = mysql_fetch_array($sql);
                        if($value >1 )
                        $gia = $kq['giaban'];
                        else
                        $gia = $kq['giale'];
                        $tensanpham = $masanpham." ".$size;
                        $thanhtien = $value * $gia;
                        $show_thanhtien = number_format($thanhtien);
                        $tongtien += $thanhtien;
                        $donhang_html_a= "<b><font color='black'>".$tensanpham."</font></b> : <b><font color='red'>".number_format($gia)." x ".$value." = ".$show_thanhtien." Đ</font></b><br /> ";
                        $donhang_html.=$donhang_html_a;
                        $donhang .= $tensanpham." : <b>".$value." bộ </b><br>";
                        $sanpham .=$key."-".$value."|";
                        if($value >= $freeship)
                         $phiship = 0;
                         else
                         $phiship = 30000; 
                      }
                    }           
                    //Nhân viên chăm đơn
                      $array_list_user = array();
                      $a = mysql_query("select id from user where groupid ='7'");
                      while($b = mysql_fetch_array($a))
                      {
                        $array_list_user[$b['id']] = 0; 
                      }
                      foreach ($array_list_user as $carebill => $value) {
                        $sql_count_bill = mysql_query("select count(madonhang) as total_bill from donhang where thoigian between '{$thismonth}-01 00:00:00' and '{$thismonth}-31 23:59:59' and carebill='{$carebill}'");
                        $count_bill = mysql_fetch_array($sql_count_bill);
                        $total_bill = $count_bill['total_bill'];
                        $array_list_user[$carebill] = $total_bill;
                      }
                      arsort($array_list_user);
                      $key_max = key($array_list_user);
                      $maximum = $array_list_user[$key_max];
                      $nhanviencarebill = 0;
                      foreach ($array_list_user as $carebill => $value) {
                        if($value < $maximum)
                         $nhanviencarebill = $carebill;
                        }
                        if($nhanviencarebill ==0)
                        $nhanviencarebill = $key_max;
                      $tennhanviencarebill = getname($nhanviencarebill);
                    //        
                      $tongtien += $phiship;
                      $show_tongtien = number_format($tongtien);
                      $donhang = rtrim($donhang,"|");
                      $madonhang[0] = $mavandon_team;
                      $madonhang[2] = date('dm');
                      $madonhang[3] = $mavandon_nhanvien;
                      $sql_maxid = mysql_query("select max(id) as max_id from session_donhang");
                      $maxid = mysql_fetch_array($sql_maxid);
                      $madonhang[4] = $maxid['max_id'];
                      @mysql_query("insert into session_donhang (date) values ('{$today_sql}')");
                      if($madonhang[4] <10 ) $madonhang[4] = "0".$madonhang[4];
                      $madonhang = $madonhang[0].$madonhang[1].$madonhang[2].$madonhang[3].$madonhang[4];
                      $today_donhang = date("Y-m-d H:i:s");

                      $insert_a = "madonhang,nhanvien,id_nhanvien,khachhang,thoigian,diachi,sdt,sanpham,phiship,tongtien,ghichu,carebill";
$insert_b = "'{$madonhang}','{$username}','{$id_nhanvien}','{$tenkhachhang}','{$today_donhang}','{$diachi}','{$sdtkhachhang}','{$donhang}','{$phiship}','{$tongtien}','{$ghichu}','{$nhanviencarebill}'";
$do = mysql_query("insert into donhang ({$insert_a}) values ({$insert_b})");
                      
                      //Check members
                      $sql_check_members = mysql_query("select * from khachhang where sdt = '{$sdtkhachhang}'");
                      $num_rows = mysql_num_rows($sql_check_members);
                      if(mysql_num_rows($sql_check_members) >0)
                      {
                        $kq_members = mysql_fetch_array($sql_check_members);
                        $order_id_members = $kq_members['order_id'];
                        if($order_id_members == "")
                        
                          $new_order_id_members = $madonhang;
                        else $new_order_id_members = $order_id_members."-".$madonhang;                      
                        @mysql_query("update khachhang set order_id='{$new_order_id_members}' where sdt = '{$sdtkhachhang}'");

                      }


if(isset($do)) {
  
echo "                      

                      
                       <div class='form-group'>
                        <label class='col-md-3 control-label'>Mã đơn hàng</label>
                        <div class='col-md-9'>
                          <input class='col-md-12 input_confirm' name='tenkhachhang' value='{$madonhang}' />
                        </div>
                      </div><hr />
                       <div class='form-group'>
                        <label class='col-md-3 control-label'>Nhân viên bán hàng</label>
                        <div class='col-md-9'>
                          <input class='col-md-12 input_confirm' name='tenkhachhang' value='{$fullname}' />
                        </div>
                      </div><hr />
                      <div class='form-group'>
                        <label class='col-md-3 control-label'>Nhân viên chăm sóc đơn hàng</label>
                        <div class='col-md-9'>
                          <input class='col-md-12 input_confirm' name='tenkhachhang' value='{$tennhanviencarebill}' />
                        </div>
                      </div><hr />
                      <div class='form-group'>
                        <label class='col-md-3 control-label'>Tên Khách Hàng</label>
                        <div class='col-md-9'>
                          <input class='col-md-12 input_confirm' name='tenkhachhang' value='{$tenkhachhang}' />
                        </div>
                      </div><hr />

                      <div class='form-group'>
                        <label class='col-md-3 control-label'>Địa chỉ Khách Hàng</label>
                        <div class='col-md-9'>
                          <input class='col-md-12 input_confirm' name='tenkhachhang' value='{$diachi}' />
                        </div>
                      </div><hr />
                      <div class='form-group'>
                        <label class='col-md-3 control-label'>Số Điện Thoại Khách Hàng</label>
                        <div class='col-md-9'>
                          <input class='col-md-12 input_confirm' name='tenkhachhang' value='{$sdtkhachhang}' />
                        </div><hr />
                      </div><hr />
                      <div class='form-group'>
                        <label class='col-md-3 control-label'>Đơn Hàng</label>
                        <div class='col-md-9' style='text-align:right'>
                          {$donhang_html}
                        </div>
                      </div><hr />
                      <div class='form-group'>
                        <label class='col-md-3 control-label'>Phí Ship</label>
                        <div class='col-md-9'>
                          <input class='col-md-12 input_confirm' name='tenkhachhang' value='{$show_phiship} Đ' />
                        </div>
                      </div><hr />
                      <div class='form-group'>
                        <label class='col-md-3 control-label'>Tổng Tiền</label>
                        <div class='col-md-9'>
                          <input class='col-md-12 input_confirm' name='tenkhachhang' value='{$show_tongtien} Đ' />
                        </div>
                      </div><hr />
                      <div class='form-group'>
                        <label class='col-md-3 control-label'>Ghi Chú</label>
                        <div class='col-md-9'>
                          <input class='col-md-12' style='height: 100px;border: black 1px solid;color: black;font-weight: 600;font-size: 20px;' type='textarea' name='tenkhachhang' value='{$ghichu}' />
                        </div>
                      </div>
                      <hr />
                      <a class='col-md-12 mb-xs mt-xs mr-xs btn btn-danger' href='banhang.php'><i class='fa fa-home'></i> VỀ TRANG BÁN HÀNG</a>
                      ";
}
*/
echo "123123";
}
?>