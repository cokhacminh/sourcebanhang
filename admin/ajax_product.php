<?php
include("../config.php");
include("../check_access.php");

if(isset($_POST['tensanpham']))
{
	$url_image = $site_url."/images/sanpham/";
	$tensanpham = $_POST['tensanpham'];
	$masanpham = $_POST['masanpham'];
	$giasanpham = $_POST['giasanpham'];
	$nhomsanpham = $_POST['nhomsanpham'];
	
	if(!isset($_POST['ghichu']))$ghichu = "";
	else $ghichu = $_POST['ghichu'];
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

    $result = mysql_query("insert into sanpham (masanpham,ten,hinhanh,gia,IDnhomsanpham,ghichu) values ('{$masanpham}','{$tensanpham}','{$hinhanh}','{$giasanpham}','{$nhomsanpham}','{$ghichu}')");
    if($result)echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã thêm sản phẩm {$tensanpham} ! ',
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
  title: 'LỖI',
  text: 'Vui lòng kiểm tra lại thông tin ! ',
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

//Sửa sản phẩm
if(isset($_POST['token_edit']))
{
	$url_image = $site_url."/images/sanpham/";
	$idsanpham = $_POST['edit_idsanpham'];
  $data_sanpham = getDataWhere('hinhanh','sanpham','id',$idsanpham);
  $hinhanhcu = $data_sanpham['hinhanh'];
	$tensanpham = $_POST['edit_tensanpham'];
	$masanpham = $_POST['edit_masanpham'];
	$giasi = $_POST['edit_giasi'];
  $giale= $_POST['edit_giale'];
	$nhomsanpham = $_POST['edit_nhomsanpham'];
	
	if(!isset($_POST['edit_ghichu']))$ghichu = "";
	else $ghichu = $_POST['edit_ghichu'];
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
                move_uploaded_file($tmp_name,$path."/".$newname);
              
        }
    }
        if(isset($newname)) $hinhanh = $newname;
        else $hinhanh = $hinhanhcu;

    $result = mysql_query("update sanpham set masanpham='{$masanpham}',ten='{$tensanpham}',hinhanh='{$hinhanh}',gia='{$giasi}',giale='{$giale}',IDnhomsanpham='{$nhomsanpham}',ghichu='{$ghichu}' where id='{$idsanpham}' ");
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

//
//Thêm ngành hàng
if(isset($_POST['tencataloge']))
{
	$tencataloge = $_POST['tencataloge'];
	$ghichu = $_POST['ghichu'];
	if($_FILES['anhcataloge']['name'] != NULL)
  	{ // Đã chọn file
        // Tiến hành code upload file
        if($_FILES['anhcataloge']['type'] == "image/jpeg"
        || $_FILES['anhcataloge']['type'] == "image/png"
        || $_FILES['anhcataloge']['type'] == "image/jpg"
        || $_FILES['anhcataloge']['type'] == "image/gif")
        {
        // là file ảnh
        // Tiến hành code upload    
          
                // file hợp lệ, tiến hành upload
                $path = "../images/cataloge"; // file sẽ lưu vào thư mục data
                $tmp_name = $_FILES['anhcataloge']['tmp_name'];
                $name = $_FILES['anhcataloge']['name'];
                $type = $_FILES['anhcataloge']['type']; 
                $size = $_FILES['anhcataloge']['size']; 
                // Upload file
                $tach_name = explode(".",$name);
                $duoi_file = $tach_name[1];
                $newname = $tensanpham.".".$duoi_file;
                move_uploaded_file($tmp_name,$path."/".$newname);
              
        }
    }
        if(isset($newname)) $hinhanh = $newname;
        else $hinhanh = "noimage.png";
	if(!isset($_POST['edit_ghichu']))$ghichu = "";
	else $ghichu = $_POST['edit_ghichu'];
	// Nếu người dùng có chọn file để upload

    $result = mysql_query("insert into cataloge (ten,image,ghichu) values ('{$tencataloge}','{$hinhanh}','{$ghichu}') ");
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

//Thêm nhóm sản phẩm
if(isset($_POST['ten_nhomsanpham']))
{
	$ten_nhomsanpham = $_POST['ten_nhomsanpham'];
  $hinhcu = $_POST['hinhcu'];
	$cataloge = $_POST['cataloge'];
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

    $result = mysql_query("insert into nhomsanpham (ten,image,catalogeid,ghichu) values ('{$ten_nhomsanpham}','{$hinhanh}','{$cataloge}','{$ghichu}') ");
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
	$sql = mysql_query("select * from sanpham where id='{$idsanpham}'");
	$kq = mysql_fetch_array($sql);
	$tensanpham = $kq['ten'];
	$masanpham = $kq['masanpham'];
	$giasanpham = $kq['gia'];
  $giale = $kq['giale'];
	$hinhanh = $kq['hinhanh'];
	$ghichu = $kq['ghichu'];
	$nhomsanpham = $kq['IDnhomsanpham'];
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
														<label class=\"col-sm-3 control-label\">Tên Sản Phẩm</label>
														<div class=\"col-sm-9\">
														<input type=\"text\" name=\"token_edit\" value=\"1\" style=\"display:none;\" />
														<input type=\"text\" name=\"edit_idsanpham\" value=\"{$idsanpham}\" style=\"display:none;\" />
															<input type=\"text\" id=\"suatensanpham\" name=\"edit_tensanpham\" class=\"form-control\" value=\"{$tensanpham}\" required/>
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
														<label class=\"col-sm-3 control-label\">Mã Sản Phẩm</label>
														<div class=\"col-sm-9\">
															<input type=\"text\" style=\"text-transform: uppercase;\" name=\"edit_masanpham\"  class=\"form-control\" value=\"{$masanpham}\" required/>
														</div>
													</div>
													<div class=\"form-group\">
														<label class=\"col-sm-3 control-label\">Giá Sỉ</label>
														<div class=\"col-sm-9\">
															<input type=\"number\" name=\"edit_giasi\" class=\"form-control\" value=\"{$giasanpham}\" required=\"\" />
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
														<label class=\"col-sm-3 control-label\">Ghi chú</label>
														<div class=\"col-sm-9\">
															<textarea name=\"edit_ghichu\" rows=\"5\" class=\"form-control\">{$ghichu}</textarea>
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
	$sanpham = getProduct($id);
	$tensanpham = $sanpham['ten'];
	$do = mysql_query("delete from sanpham where id='{$id}'");
	if($do)
		echo "
<script>
swal({
  title: 'HOÀN TẤT',
  text: 'Đã xóa sản phẩm {$tensanpham} ! ',
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
  title: 'CÓ LỖI XẢY RA',
  text: 'Vui lòng kiểm tra lại dữ liệu ! ',
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
//Chế độ xem
if(isset($_POST['view_type']))
{
	$IDnhomsanpham = $_POST['view_type'];
	if($IDnhomsanpham =="all")
	$sql = mysql_query("select * from sanpham");
	else	
	$sql = mysql_query("select * from sanpham where IDnhomsanpham='{$IDnhomsanpham}'");
										while($do = mysql_fetch_array($sql))
										{
											if($do['hinhanh'] =="")$hinhanh = "noimage.png";else $hinhanh = $do['hinhanh'];
											$id_nhomsanpham = $do['IDnhomsanpham'];
											$id = $do['id'];
											$giasanpham = number_format($do['gia']);
											$tensanpham = $do['ten'];
											$masanpham = $do['masanpham'];
											$ghichu = $do['ghichu'];
											$sql2 = mysql_query("select * from nhomsanpham where id='{$id_nhomsanpham}'");
											$kqnhomsanpham = mysql_fetch_array($sql2);
											$ten_nhomsanpham = $kqnhomsanpham['ten'];
											if(!isset($do['soluong']))$soluong = 0;
											else $soluong = $do['soluong'];

											echo "
											<tr class=\"gradeX\">
											
											<td style=\"vertical-align: middle;text-align:center\"><img class=\"listproducts hvr-grow\" src=\"{$site_url}/images/sanpham/{$hinhanh}\" /></td>
											<td style=\"vertical-align: middle;text-align:center\">{$tensanpham}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$masanpham}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$ten_nhomsanpham}</td>
											<td style=\"vertical-align: middle;text-align:center\"><font color='red'>{$giasanpham}</font></td>
											<td style=\"vertical-align: middle;text-align:center\"><font color='blue'>{$soluong}</font></td>
											<td style=\"vertical-align: middle;text-align:center;white-space:pre-wrap;\">{$ghichu}</td>
											<td style=\"vertical-align: middle;text-align:center\"><a href=\"#modalForm_editproduct\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-success\" title=\"Chỉnh sửa sản phẩm này\" onclick=\"suasanpham({$id})\"><i class=\"fa fa-pencil-square-o\"></i> EDIT</a> <a class=\"hvr-float mb-xs mt-xs mr-xs btn btn-danger\" title=\"Xóa sản phẩm này\" onclick=\"xoasanpham({$id})\"><i class=\"fa fa-user-times\"></i> XÓA</a></td>
										</tr>
											";

										}

}


?>