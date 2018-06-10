<?php
include("config.php");
include("check_access.php");
$a = mysql_query("select * from user where id='{$id_nhanvien}'");
$data = mysql_fetch_array($a);
if(isset($_POST['token']))
{
    if($_POST['token'] == "thongtinchung")
    {

       
        $tennhanvien = $_POST['tennhanvien'];
        $sodienthoai = $_POST['sodienthoai'];
        $diachi = $_POST['diachi'];
        $ngaysinh = $_POST['ngaysinh'];
        $email = $_POST['email'];
        $facebook = $_POST['facebook'];
          if($_FILES['avatar']['name'] != NULL)
    { // Đã chọn file
        // Tiến hành code upload file
        if($_FILES['avatar']['type'] == "image/jpeg"
        || $_FILES['avatar']['type'] == "image/png"
        || $_FILES['avatar']['type'] == "image/jpg"
        || $_FILES['avatar']['type'] == "image/gif")
        {
        // là file ảnh
        // Tiến hành code upload    
          
                // file hợp lệ, tiến hành upload
                $path = "images/avatar"; // file sẽ lưu vào thư mục data
                $tmp_name = $_FILES['avatar']['tmp_name'];
                $name = $_FILES['avatar']['name'];
                $type = $_FILES['avatar']['type']; 
                $size = $_FILES['avatar']['size']; 
                // Upload file
                $tach_name = explode(".",$name);
                $duoi_file = $tach_name[1];
                $newname = $username.".".$duoi_file;
                move_uploaded_file($tmp_name,$path."/".$newname);
               chmod($path, 0755);
        }
        if(isset($newname)) $hinhanh = $newname;
        else $hinhanh = "noavatar.png";
        $import = ",avatar='{$hinhanh}'";
    }

        $do = mysql_query("update user set fullname='{$tennhanvien}'{$import},sodienthoai='{$sodienthoai}',diachi='{$diachi}',ngaysinh='{$ngaysinh}',email='{$email}',facebook='{$facebook}' where id='{$id_nhanvien}'");

}
}
?>