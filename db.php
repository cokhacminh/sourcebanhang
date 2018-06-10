<?php
	define( 'ROOTDIR', pathinfo( str_replace( DIRECTORY_SEPARATOR, '/', __file__ ), PATHINFO_DIRNAME ) );
define( 'CACHEDIR', 'cache' );
$sys_info = array();
$sys_info['str_compress'] = array();

if( $sys_info['zlib_support'] )
{
	if( function_exists( 'gzcompress' ) and function_exists( 'gzuncompress' ) )
	{
		$sys_info['str_compress'] = array( 'gzcompress', 'gzuncompress' );
	}
	elseif( function_exists( 'gzdeflate' ) and function_exists( 'gzinflate' ) )
	{
		$sys_info['str_compress'] = array( 'gzdeflate', 'gzinflate' );
	}
}
    $ketnoi['host'] = 'localhost'; //Tên server, nếu dùng hosting free thì cần thay đổi
    $ketnoi['dbname'] = 'hethong'; //Đây là tên của Database
    $ketnoi['username'] = 'root'; //Tên sử dụng Database
    $ketnoi['password'] = '123456789';//Mật khẩu của tên sử dụng Database
    $conn = mysql_connect(
        "{$ketnoi['host']}",
        "{$ketnoi['username']}",
        "{$ketnoi['password']}")
    or
        die("Không thể kết nối database");
    @mysql_select_db(
        "{$ketnoi['dbname']}") 
    or
        die("Không thể chọn database");
        mysql_set_charset('utf8',$conn);

date_default_timezone_set("Asia/Ho_Chi_Minh");
?>