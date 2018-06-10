<?php

include("../config.php");
include("../check_access.php");

if(isset($_POST['masanpham']))
{
	$url_image = $site_url."/images/sanpham/";
	$masanpham = $_POST['masanpham'];
	$giaban = $_POST['giaban'];
	$nhomsanpham = $_POST['nhomsanpham'];
	$giale = $_POST['giale'];
  if($_POST['size'] == NULL)
  echo "
<script>
swal({
  title: 'LỖI',
  text: 'PHẢI THÊM ÍT NHẤT 1 SIZE CHO SẢN PHẨM ! ',
  type: 'success',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
    location.reload();})
</script>
  ";
  else
{


	// Nếu người dùng có chọn file để upload
  if($_FILES['anhsanpham']['name'] != NULL)
  	{ // Đã chọn file
        // Tiến hành code upload file
        if($_FILES['anhsanpham']['type'] == "image/jpeg"
        || $_FILES['anhsanpham']['type'] == "image/png"
        || $_FILES['anhsanpham']['type'] == "image/jpg"
        || $_FILES['anhsanpham']['type'] == "image/gif")
        {
        // là file ảnh
        // Tiến hành code upload    
          
                // file hợp lệ, tiến hành upload
                $path = "../images/sanpham"; // file sẽ lưu vào thư mục data
                $tmp_name = $_FILES['anhsanpham']['tmp_name'];
                $name = $_FILES['anhsanpham']['name'];
                $type = $_FILES['anhsanpham']['type']; 
                $size = $_FILES['anhsanpham']['size']; 
                // Upload file
                $tach_name = explode(".",$name);
                $duoi_file = $tach_name[1];
                $newname = $masanpham.".".$duoi_file;
                move_uploaded_file($tmp_name,$path."/".$newname);
              
        }
    }
        if(isset($newname)) $hinhanh = $newname;
        else $hinhanh = "noimage.png";
 
    $do = mysql_query("insert into masanpham (masanpham,hinhanh,giaban,giale,nhomsanpham) values ('{$masanpham}','{$hinhanh}','{$giaban}','{$giale}','{$nhomsanpham}')");
    if(!$do or $do == "") $errors = "Không thêm mã sản phẩm {$masanpham} được";
    else
    {
    foreach($_POST['size'] as $size)
    {
      $result = mysql_query("insert into sanpham (size,masanpham) values ('{$size}','{$masanpham}')");
      if(!$result)
      $errors = "Không thêm size {$size} cho mã sản phẩm {$masanpham} được";
    }
    }
    if(!$errors)echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã thêm sản phẩm {$masanpham}! ',
  type: 'success',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>
    	";
    else

     echo "

<script>
swal({
  title: 'LỖI',
  text: '{$errors} ! ',
  type: 'success',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
    location.reload();})
</script>
      
      ";
    
   }
}   
//

//Sửa sản phẩm
if(isset($_POST['token_edit']))
{
	$url_image = $site_url."/images/sanpham/";
	$idsanpham = $_POST['edit_idsanpham'];
	$masanpham = $_POST['edit_masanpham'];
	$giaban = $_POST['edit_giaban'];
  $giale = $_POST['edit_giale'];
	$nhomsanpham = $_POST['edit_nhomsanpham'];
	// Nếu người dùng có chọn file để upload
  if($_FILES['edit_anhsanpham']['name'] != NULL)
  	{ // Đã chọn file
        // Tiến hành code upload file
        if($_FILES['edit_anhsanpham']['type'] == "image/jpeg"
        || $_FILES['edit_anhsanpham']['type'] == "image/png"
        || $_FILES['edit_anhsanpham']['type'] == "image/jpg"
        || $_FILES['edit_anhsanpham']['type'] == "image/gif")
        {
        // là file ảnh
        // Tiến hành code upload    
          
                // file hợp lệ, tiến hành upload
                $path = "../images/sanpham"; // file sẽ lưu vào thư mục data
                $tmp_name = $_FILES['edit_anhsanpham']['tmp_name'];
                $name = $_FILES['edit_anhsanpham']['name'];
                $type = $_FILES['edit_anhsanpham']['type']; 
                $size = $_FILES['edit_anhsanpham']['size']; 
                // Upload file
                $tach_name = explode(".",$name);
                $duoi_file = $tach_name[1];
                $newname = $masanpham.".".$duoi_file;
                $copied = copy($_FILES['image']['tmp_name'], $newname);
                if (!$copied)
                {
                  $random = rand(1,1000);
                  $newname = $masanpham."-".$random.".".$duoi_file;
                }
                move_uploaded_file($tmp_name,$path."/".$newname);
              
        }
    }
        if(isset($newname)) $hinhanh = $newname;
        else $hinhanh = "noimage.png";

    $result = mysql_query("update masanpham set masanpham='{$masanpham}',hinhanh='{$hinhanh}',giaban='{$giaban}',giale='{$giale}',nhomsanpham='{$nhomsanpham}' where id='{$idsanpham}
      '");
    if(!$result or $result =="")
      $errors = "Không thể sửa sản phẩm {$masanpham}";
    else
    {
      
    }


  echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã chỉnh sửa sản phẩm {$tensanpham} ! ',
  type: 'success',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>
    	";
   
    
}

//


//Thêm nhóm sản phẩm
if(isset($_POST['ten_nhomsanpham']))
{
	$ten_nhomsanpham = $_POST['ten_nhomsanpham'];
  $hinhcu = $_POST['hinhcu'];
	$ghichu = $_POST['ghichu'];
	if($_FILES['anhnhomsanpham']['name'] != NULL)
  	{ // Đã chọn file
        // Tiến hành code upload file
        if($_FILES['anhnhomsanpham']['type'] == "image/jpeg"
        || $_FILES['anhnhomsanpham']['type'] == "image/png"
        || $_FILES['anhnhomsanpham']['type'] == "image/jpg"
        || $_FILES['anhnhomsanpham']['type'] == "image/gif")
        {
        // là file ảnh
        // Tiến hành code upload    
          
                // file hợp lệ, tiến hành upload
                $path = "../images/nhomsanpham"; // file sẽ lưu vào thư mục data
                $tmp_name = $_FILES['anhnhomsanpham']['tmp_name'];
                $name = $_FILES['anhnhomsanpham']['name'];
                $type = $_FILES['anhnhomsanpham']['type']; 
                $size = $_FILES['anhnhomsanpham']['size']; 
                // Upload file
                $tach_name = explode(".",$name);
                $duoi_file = $tach_name[1];
                $newname = $tensanpham.".".$duoi_file;
                move_uploaded_file($tmp_name,$path."/".$newname);
              
        }
    }
        if(isset($newname)) $hinhanh = $newname;
        else $hinhanh = $hinhcu;
	if(!isset($_POST['edit_ghichu']))$ghichu = "";
	else $ghichu = $_POST['edit_ghichu'];
	// Nếu người dùng có chọn file để upload

    $result = mysql_query("insert into nhomsanpham (ten,image,ghichu) values ('{$ten_nhomsanpham}','{$hinhanh}','{$ghichu}') ");
    if($result)echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã chỉnh sửa sản phẩm {$tensanpham} ! ',
  type: 'success',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>
    	";
    else echo "
<script>
swal({
  title: 'LỖI !!',
  text: 'Vui lòng kiểm tra lại thông tin nhập vào ! ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>
";
    
   }


//Sửa sản phẩm
if(isset($_POST['idsanpham']))
{
	$idsanpham = $_POST['idsanpham'];
	$sql = mysql_query("select * from masanpham where id='{$idsanpham}'");
	$kq = mysql_fetch_array($sql);
	$masanpham = $kq['masanpham'];
	$giaban = $kq['giaban'];
	$hinhanh = $kq['hinhanh'];
  if($hinhanh == NULL) $hinhanh = "noimage.png";
	$ghichu = $kq['ghichu'];
  $giale = $kq['giale'];
	$nhomsanpham = $kq['nhomsanpham'];
	$query = mysql_query("select * from cataloge");
	$form_select = "";
																while($do = mysql_fetch_array($query))
																{
																	$cataloge = $do['id'];
																	$cataloge_name = $do['ten'];
																	$form_select.= "<optgroup label=\"{$cataloge_name}\">";
																	$query1 = mysql_query("select * from nhomsanpham where catalogeid = '{$cataloge}'");
																	while($do1 = mysql_fetch_array($query1))
																	{
																		$id_nhomsanpham = $do1['id'];
																		$ten_nhomsanpham = $do1['ten'];
																		if($nhomsanpham == $id_nhomsanpham)$form_select.= "<option value=\"{$id_nhomsanpham}\" checked=\"checked\">{$ten_nhomsanpham}</option>";
																		else $form_select.= "<option value=\"{$id_nhomsanpham}\">{$ten_nhomsanpham}</option>";

																	}
																	$form_select.= "</optgroup>";
																}

	echo "

											<div class=\"panel-body\">
												
													<div class=\"form-group mt-lg\">
														<label class=\"col-sm-3 control-label\">Mã Sản Phẩm</label>
														<div class=\"col-sm-9\">
														<input type=\"text\" name=\"token_edit\" value=\"1\" style=\"display:none;\" />
														<input type=\"text\" name=\"edit_idsanpham\" value=\"{$idsanpham}\" style=\"display:none;\"/>
															<input type=\"text\" style=\"text-transform: uppercase;\" name=\"edit_masanpham\"  class=\"form-control\" value=\"{$masanpham}\" required/>
														</div>
													</div>
														<div class=\"form-group mt-lg\">
														<label class=\"col-sm-3 control-label\">Ảnh Sản Phẩm</label>
														<div class=\"col-sm-9\" style=\"margin-bottom:20px;\">
                            <input style=\"display:none;\" type=\"text\" name=\"anhcu\" value=\"{$hinhanh}\" disabled>
															<img class=\"hvr-grow\" src=\"{$site_url}/images/sanpham/{$hinhanh}\" width=\"100px\" height=\"150px\" title=\"Hình ảnh sản phẩm {$tensanpham}\" />
                            
														</div>
														<div class=\"form-group mt-lg\">
														<label class=\"col-sm-3 control-label\">Tải Ảnh Mới</label>
														<div class=\"col-sm-9\">
															<input type=\"file\" name=\"edit_anhsanpham\" accept=\"image/*\">
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Giá Bán</label>
														<div class=\"col-sm-9\">
															<input type=\"number\" name=\"edit_giaban\" class=\"form-control\" value=\"{$giaban}\" required=\"\" />
														</div>
													</div>
                          <div class=\"form-group\">
                            <label class=\"col-sm-3 control-label\">Giá Lẻ</label>
                            <div class=\"col-sm-9\">
                              <input type=\"number\" name=\"edit_giale\" class=\"form-control\" value=\"{$giale}\" required=\"\" />
                            </div>
                          </div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Nhóm</label>
														<div class=\"col-sm-9\">
															<select data-plugin-selectTwo class=\"form-control populate\" name=\"edit_nhomsanpham\">
																{$form_select}
																	
															</select>
																
														</div>
													</div>
												
													<div class=\"form-group\">
														
														<div class=\"col-sm-12\" style=\"text-align: center\">
															<button class=\"btn btn-primary\">Sửa Sản Phẩm</button> <button class=\"btn btn-danger modal-dismiss\">Hủy</button>
														</div>
													</div>
												
											</div>
			
									";
}
//Xóa sản phẩm
if(isset($_POST['deleteproductid']))
{
	$id = $_POST['deleteproductid'];
	$a = mysql_query("select * from masanpham where id='{$id}'");
	$sanpham = mysql_fetch_array($a);
  $masanpham = $sanpham['masanpham'];
  $b = mysql_query("select * from sanpham where masanpham ='{$masanpham}'");
  $content = "";
  $tongsoluong = 0;
  while ($c = mysql_fetch_array($b)) {
    $size = $c['size'];
    $soluong = $c['soluong'];
    $tongsoluong += $soluong;
    $content.="Size ".$size." : ".$soluong." | ";
  }
	$do = mysql_query("delete from masanpham where id='{$id}'");
  if(!$do)
    $errors = "Không thể xóa rows {$masanpham} từ table masanpham";
  @mysql_query("delete from sanpham where masanpham = '{$masanpham}'");
	if(!$errors or $errors == "")
  {
  $date = date("d-m-Y");
  $text_date = date("H:i:s - d/m/Y");
  $file_name = $date.".txt";
  $dir_file = "../admin/logs/sanpham/".$file_name;
  $file = fopen($dir_file,'a');
  $text = $text_date." : ".$fullname." Đã xóa sản phẩm {$masanpham} - {$content} - Tổng số lượng :  {$tongsoluong}\n";
  fwrite($file,$text);
  fclose($file);

		echo "
  }
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã xóa sản phẩm {$masanpham} ! ',
  type: 'success',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>
	";
}
	else echo "
<script>
swal({
  title: 'CÓ LỖI XẢY RA',
  text: '{$errors} !! ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
  	location.reload();})
</script>
		";

}


//Nhập Hàng
if(isset($_POST['idnhaphang']))
{
  $idsanpham = $_POST['idnhaphang'];
  $sql = mysql_query("select * from sanpham where id='{$idsanpham}'");
  $kq = mysql_fetch_array($sql);
  $masanpham = $kq['masanpham'];
  $size = $kq['size'];
  $soluong = $kq['soluong'];
  $sql_msp = mysql_query("select hinhanh from masanpham where masanpham = '{$masanpham}'");
  $kq_msp = mysql_fetch_array($sql_msp);
  $hinhanh = $kq_msp['hinhanh'];
  if($hinhanh =="")
    $hinhanh = "noimage.png";
  echo "
 <div class=\"modal-dialog\">
                      <div class=\"panel-body\">
                        
                                                      
                            <div class=\"form-group mt-lg\">
                            <div class=\"col-sm-4\" style=\"border:1px black dashed;border-radius:20px;box-shadow:0px 0px 5px;height:200px;\">
                             <img class=\"hvr-grow\" src=\"{$site_url}/images/sanpham/{$hinhanh}\"  height=\"200px\" />
                             </div>
                            <div class=\"col-sm-8\" style=\"color:black;padding-left:30px;padding-top:2px;font-size:25px;line-height:30px\">
                            <input style=\"display:none;\" type=\"text\" name=\"idsanpham_nhaphang\" class=\"form-control\" value=\"{$idsanpham}\" />
                              <p> Mã sản phẩm : <b><font color=\"red\">{$masanpham}</font></b> </p>
                              <p>Size : <b><font color=\"red\">{$size}</font></b></p>
                              <p> Số lượng : <b><font color=\"red\">{$soluong}</font></b> bộ</p>
                              <p> Nhập thêm : <input style=\"display:inline;width:100px\" type=\"number\" name=\"soluong\" class=\"form-control\" required=\"\" /></p>
                              <p> <button type = \"submit\" class=\"btn btn-primary\">Nhập Thêm</button>   <button class=\"btn btn-danger\" data-dismiss=\"modal\">Hủy</button></p>
                            </div>
                          </div>
                         
                        </div>
                      </div>
      
                  ";
}
if(isset($_POST['idsanpham_nhaphang']))
{
  $idsanpham = $_POST['idsanpham_nhaphang'];
  $soluongnhap = $_POST['soluong'];
  $sql = mysql_query("select * from sanpham where id='{$idsanpham}'");
  $kq = mysql_fetch_array($sql);
  $masanpham = $kq['masanpham'];
  $size = $kq['size'];
  $soluong = $kq['soluong'];
  $ngay = date("Y-m-d h:i:s");
  if($soluongnhap < 0 )
  {
    $soluongxuat = ($soluongnhap * (-1));
    if($soluongxuat > $soluong)
    {
      echo "
<script>
swal({
  title: 'CÓ LỖI XẢY RA',
  text: 'TRONG KHO CHỈ CÒN {$soluong} KHÔNG ĐỦ ĐỂ XUẤT {$soluongxuat} CÁI !! ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
    location.reload();})
</script>
    ";
    }
    else
    {
       @mysql_query("update sanpham set soluong = soluong - {$soluongnhap} where id = '{$idsanpham}'");
       @mysql_query("INSERT INTO `lichsuxuatnhaphang` (`id`,`thoigian`, `username`, `thaotac`, `idsanpham`, `soluong`) VALUES ('NULL',{$ngay}', '{$username}', 'xuathang', '{$idsanpham}', '{$soluongnhap}')");
       $text_content = "đã XUẤT KHO sản phẩm ".$masanpham." Size ".$size." số lượng ".$soluongnhap." bộ";
    }
 
  }
  else
  {
    @mysql_query("update sanpham set soluong = soluong + {$soluongnhap} where id = '{$idsanpham}'");
    @mysql_query("INSERT INTO `lichsuxuatnhaphang` (`thoigian`, `username`, `thaotac`, `idsanpham`, `soluong`) VALUES ('{$ngay}', '{$username}', 'nhaphang', '{$idsanpham}', '{$soluongnhap}')");
    $text_content = "đã NHẬP KHO sản phẩm ".$masanpham." Size ".$size." số lượng ".$soluongnhap." bộ . ID : ".$ngay; 
    

  }
    $text_date = date("H:i:s - d/m/Y");
    $date = date("d-m-Y");
    $file_name = $date.".txt";
    $dir_file = "../admin/logs/xuatkho/".$file_name;
    $file = fopen($dir_file,'a');
    $text = $text_date." : ".$username." ".$text_content.".\n";
    fwrite($file,$text);
    fclose($file);



    echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: '{$username} {$text_content} ',
  type: 'warning',
  showCancelButton: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'OK !!!'
}).then(function () {
    location.reload();})
</script>
    ";  

}
//Xoá size mã sản phẩm
if(isset($_POST['idxoasize']))
{
  $idsanpham = $_POST['idxoasize'];
  $sql = mysql_query("select * from sanpham where id='{$idsanpham}'");
  $kq = mysql_fetch_array($sql);
  $masanpham = $kq['masanpham'];
  $size = $kq['size'];
  $soluong = $kq['soluong'];
  echo "
<script>
swal({
  title: 'CHÚ Ý',
  text: 'BẠN MUỐN XOÁ {$masanpham} SIZE {$size} PHẢI KHÔNG ? ',
  type: 'warning',
  showCancelButton: true,
  cancelButtonColor: '#d33',
  confirmButtonText: 'Đúng vậy !!!',
  cancelButtonText: 'Để xem lại !!!'
}).then(function () {
  deletesize({$idsanpham});
  swal(
    'Đã Xóa!',
    'ĐÃ XOÁ {$masanpham} SIZE {$size}.',
    'success'
  ).then(function () {
    location.reload();})
}, function (dismiss) {
  // dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'
  if (dismiss === 'cancel') {
    swal(
      'Đã Hủy',
      'Cẩn thận kẻo mất dữ liệu bạn nhé',
      'error'
    )
  }
})
</script>
  ";
}
if(isset($_POST['deletesize']))
{
  $idsanpham = $_POST['deletesize'];
  $sql = mysql_query("select * from sanpham where id='{$idsanpham}'");
  $kq = mysql_fetch_array($sql);
  $masanpham = $kq['masanpham'];
  $size = $kq['size'];
  $soluong = $kq['soluong'];
  @mysql_query("delete from sanpham where id='{$idsanpham}'");
      $text_date = date("H:i:s - d/m/Y");
    $date = date("d-m-Y");
    $file_name = $date.".txt";
    $dir_file = "../admin/logs/sanpham/".$file_name;
    $file = fopen($dir_file,'a');
    $text = $text_date." : ".$username." XOÁ ".$masanpham." size ".$size." - SỐ LƯỢNG ".$soluong." - ID : ".$idsanpham."\n";
    fwrite($file,$text);
    fclose($file);
}

//Xoá Sản Phẩm
if(isset($_POST['idxoasanpham']))
{
  $idsanpham = $_POST['idxoasanpham'];
  $sql = mysql_query("select * from masanpham where id='{$idsanpham}'");
  $kq = mysql_fetch_array($sql);
  $masanpham = $kq['masanpham'];
  $nhomsanpham = $kq['nhomsanpham'];
  
  echo "
<script>
swal({
  title: 'CHÚ Ý',
  text: 'BẠN MUỐN XOÁ SẢN PHẨM {$masanpham} PHẢI KHÔNG ? ',
  type: 'warning',
  showCancelButton: true,
  cancelButtonColor: '#d33',
  confirmButtonText: 'Đúng vậy !!!',
  cancelButtonText: 'Để xem lại !!!'
}).then(function () {
  deletesanpham({$idsanpham});
  swal(
    'Đã Xóa!',
    'ĐÃ XOÁ SẢN PHÂM {$masanpham} .',
    'success'
  ).then(function () {
    location.reload();})
}, function (dismiss) {
  // dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'
  if (dismiss === 'cancel') {
    swal(
      'Đã Hủy',
      'Cẩn thận kẻo mất dữ liệu bạn nhé',
      'error'
    )
  }
})
</script>
  ";
}
if(isset($_POST['deletesanpham']))
{
  $idsanpham = $_POST['deletesanpham'];
  $sql = mysql_query("select * from masanpham where id='{$idsanpham}'");
  $kq = mysql_fetch_array($sql);
  $masanpham = $kq['masanpham'];
  $nhomsanpham = $kq['nhomsanpham'];
  
  @mysql_query("delete from masanpham where id='{$idsanpham}'");
      $text_date = date("H:i:s - d/m/Y");
    $date = date("d-m-Y");
    $file_name = $date.".txt";
    $dir_file = "../admin/logs/sanpham/".$file_name;
    $file = fopen($dir_file,'a');
    $text = $text_date." : ".$username." XOÁ SẢN PHẨM ".$masanpham." - NHÓM SẢN PHẨM : ".$nhomsanpham." - ID : ".$idsanpham."\n";
    fwrite($file,$text);
    fclose($file);
}
?>