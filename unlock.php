<?php
require_once("db.php");
   
if(isset($_POST['dosomething']))
{
  if(isset($_POST['passwd']))
{
     // Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
    $username = addslashes( $_POST['user'] );
    $password = md5( addslashes( $_POST['passwd'] ) );
    // Lấy thông tin của username đã nhập trong table members
    $sql_query = @mysql_query("SELECT id, username, passwd,groupid FROM user WHERE username='{$username}'");
    $member = @mysql_fetch_array( $sql_query );
    // Nếu username này không tồn tại thì....

    // Nếu username này tồn tại thì tiếp tục kiểm tra mật khẩu
   
    if ( $password == $member['passwd'] )
    {
      setcookie("login","1",time() + 3600*5);
           echo "<script>
swal({
  title: 'Mở khóa thành công',
  type: 'success',
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Vào trang bán hàng'
}).then(function () {
  window.location = \"index.php\"
})
</script>";

}
 else
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
}
}
?>