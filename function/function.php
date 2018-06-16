<?php 
	function getname($userid){
        $sql = mysql_query("select fullname from user where id='{$userid}'");
        $data = mysql_fetch_array($sql);
        return $data['fullname'];
    }
    function getnamebyusername($username){
        $sql = mysql_query("select fullname from user where username='{$username}'");
        $data = mysql_fetch_array($sql);
        return $data['fullname'];
    }
    function laymasanpham($id){
        $sql = mysql_query("select masanpham,size from sanpham where id='{$id}'");
        $data = mysql_fetch_array($sql);
        $masanpham = $data['masanpham'];
        $size = $data['size'];
        $sanpham = $masanpham." ".$size;
        return $sanpham;
    }
    function thongtinsanpham($id){
        $sql = mysql_query("select masanpham,size from sanpham where id='{$id}'");
        $data = mysql_fetch_array($sql);
        $masanpham = $data['masanpham'];
        $size = $data['size'];
        $tensanpham = $masanpham." ".$size;
        return $data=array("tensanpham"=>$tensanpham,"masanpham"=>$masanpham);
    }
    function info_sanpham($idsanpham){
        $sql = mysql_query("select masanpham,size from sanpham where id='{$idsanpham}'");
        $data = mysql_fetch_array($sql);
        $size = $data['size'];
        $masanpham = $data['masanpham'];
        $a = mysql_query("select hinhanh from masanpham where masanpham='{$masanpham}'");
        $b = mysql_fetch_array($a);
        $anhsanpham = $b['hinhanh'];
        if($anhsanpham =="")$anhsanpham = "noimage.png";
        return $array=array("masanpham"=>$masanpham,"size"=>$size,"anhsanpham"=>$anhsanpham);
    }
    function giasanpham($masanpham){
        $sql = mysql_query("select giaban from masanpham where masanpham='{$masanpham}'");
        $data = mysql_fetch_array($sql);
        return $data['giaban'];
    }
    function laysizesanpham($id){
        $sql = mysql_query("select size from sanpham where id='{$id}'");
        $data = mysql_fetch_array($sql);
        return $data['size'];
    } 
    function CreatDate($a){
        $b = explode("/", $a);
        $c = $b[1]."/".$b[0]."/".$b[2];
        return $c;
    }
    function CreatFromDate($a){
        $b = explode("/", $a);
        $c = $b[2]."-".$b[0]."-".$b[1]." 00:00:00";
        return $c;
    }
    function tentinh($id){
        $sql = mysql_query("select ten from add_tinh where id='{$id}'");
        $data = mysql_fetch_array($sql);
        return $data['ten'];
    }
    function tenhuyen($id){
        $sql = mysql_query("select ten from add_huyen where id='{$id}'");
        $data = mysql_fetch_array($sql);
        return $data['ten'];
    }
	function taoformdate($a){
        $b = explode("/", $a);
        $c = $b[2]."-".$b[0]."-".$b[1];
        return $c;
    }
    function CreatToDate($a){
        $b = explode("/", $a);
        $c = $b[2]."-".$b[0]."-".$b[1]." 23:59:59";
        return $c;
    }
    function getNamedvgh($id)
    {
        $sql = mysql_query("select ten from donvigiaohang where id='{$id}'");
        $data = mysql_fetch_array($sql);
        return $data['ten'];
    }
    function CreatShortName($str){
  if(!$str) return false;
   $unicode = array(
      'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
      'd'=>'đ|Đ',
      'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
      'i'=>'í|ì|ỉ|ĩ|ị',
      'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
      'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
      'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
   );
foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
$str1 = preg_replace('/\s+/', '', $str);
return $str1;
}
function getNameAddress($id,$khuvuc)
{
    $a = mysql_query("select ten from {$khuvuc} where id='{$id}'");
    $b = mysql_fetch_array($a);
    return $b['ten'];
}
function laylogodvgh($id)
{
    $a = mysql_query("select logo,ten,ghichu from donvigiaohang where id='{$id}'");
    $b = mysql_fetch_array($a);
    $hinhanh = $b['logo'];
    $tendvgh = $b['ten'];
    $ghichu = $b['ghichu'];
    global $site_url;
        $c = "<a href=\"{$site_url}/images/logo/{$hinhanh}\" data-plugin-lightbox data-plugin-options='{ \"type\":\"image\" }' title=\"{$tendvgh} \n{$ghichu}\">
                                                <img class=\"img-responsive listdvgh hvr-grow\" src=\"{$site_url}/images/logo/{$hinhanh}\">
                                            </a>";
    return $c;                                      

}
function getData($a,$b){
    $query = mysql_query("select {$a} from {$b}");
    $result = mysql_fetch_array($query);
    return $result;
}
function getDataWhere($a,$b,$c,$d){
    $query = mysql_query("select {$a} from {$b} where {$c}='{$d}'");
    $result = mysql_fetch_array($query);
    return $result;
}
function getDataWhereNot($a,$b,$c,$d){
    $query = mysql_query("select {$a} from {$b} where {$c}!='{$d}'");
    $result = mysql_fetch_array($query);
    return $result;
}
function thongtinnhom($idnhanvien){
    $sql = mysql_query("select id,ten from team where leader='{$idnhanvien}'");
    $b = mysql_fetch_array($sql);
    return $b;
}
function thuocnhom($teamid){

    if($teamid =="0")
        $tennhom = "Chưa vào nhóm";
    else
    {
        $a = mysql_query("select ten from team where id='{$teamid}'");
        $b = mysql_fetch_array($a);
        $tennhom = $b['ten'];
    }
    return $tennhom;
}
function laytensanpham($idsanpham)
{
    $a = mysql_query("select masanpham,size from sanpham where id='{$id}'");
    $b = mysql_fetch_array($a);
    $masanpham = $b['masanpham'];
    $size = $b['size'];
    $tensanpham = $masanpham." ".$size;
    return $tensanpham;
}
function masanpham($id){
    $a = mysql_query("select masanpham from sanpham where id='{$id}'");
    $b = mysql_fetch_array($a);
    $c = $b['masanpham'];
    return $c;
}

//////////////
function info2($id_nhanvien)
{
	$a = mysql_query("select chinhanh,calamviec from user where id='{$id_nhanvien}'");
	$b = mysql_fetch_array($a);
	$c = $b['chinhanh'];
	$d = $b['calamviec'];
	$sql = mysql_query("select ten from team where id in ( select team_id from user where id ='{$id_nhanvien}')");
	$team = mysql_fetch_array($sql);
	$nhom = $team['ten'];
	return $e = array($c,$d,$nhom);
	
}
//////////////
function delete_cache( $modname )
{
	$cache_file = md5($modname) . '.cache';
	if( $dh = opendir( ROOTDIR . '/' . CACHEDIR  ) )
	{
		
			
				unlink( ROOTDIR . '/' . CACHEDIR . '/' .  $cache_file );
		
		closedir( $dh );
	}
	return 'ok';
}

function vndes_get_cache( $module_name, $filename )
{
	if( empty( $filename ) or ! preg_match( '/([a-z0-9\_]+)\.cache/', $filename ) ) return false;

	if( ! file_exists( ROOTDIR . '/' . CACHEDIR . '/' . $filename ) ) return false;

	return file_get_contents( ROOTDIR . '/' . CACHEDIR . '/' .  $filename );
	
}
function vndes_set_cache( $module_name, $filename, $content )
{
	if( empty( $filename ) or ! preg_match( '/([a-z0-9\_]+)\.cache/', $filename ) ) return false;

	mkdir( ROOTDIR . '/' . CACHEDIR , 0777, true );
//	mkdir( ROOTDIR . '/' . CACHEDIR .'/' . $module_name , 0777, true );

	return file_put_contents( ROOTDIR . '/' . CACHEDIR . '/' .  $filename, $content, LOCK_EX );
}

function db_cache( $sql, $key = '', $modname = '' )
{
	global $conn;
	$list = array();

	if( empty( $sql ) ) return $list;

	if( empty( $modname ) ) $modname = 'donhang';

	$cache_file = md5($modname) . '.cache';

	if( ( $cache = vndes_get_cache( $modname, $cache_file ) ) != false )
	{
		$list = unserialize( $cache );
	}
	else
	{
		if( ( $result = mysql_query( $sql ) ) !== false )
		{
			$a = 0;
			while( $row = mysql_fetch_array($result) )
			{
				$key2 = ( ! empty( $key ) and isset( $row[$key] ) ) ? $row[$key] : $a;
				$list[$key2] = $row;
				++$a;
			}

			$cache = serialize( $list );
			vndes_set_cache( $modname, $cache_file, $cache );
		}
	}

	return $list;
}
function taolink($str){
  if(!$str) return false;
   $unicode = array(
      'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
      'd'=>'đ|Đ',
      'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
      'i'=>'í|ì|ỉ|ĩ|ị',
      'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
      'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
      'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
   );
foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
$string = str_replace(" ", "", $str );
return strtolower($string);

}
function taoformselectmasanpham()
{
    
            $query1 = mysql_query("select * from sanpham order by masanpham");
            while($do1 = mysql_fetch_array($query1))
                {
                    $id_nhomsanpham = $do1['id'];
                    $masanpham = $do1['masanpham'];
                    $size = $do1['size'];
                    $ten_nhomsanpham = $masanpham." ".$size;
                    $form_select.= "<option value=\"{$id_nhomsanpham}\">{$ten_nhomsanpham}</option>";
                }
           
    return $form_select;
}
function taomaughichu()
{
    $option = "";
    $a = mysql_query("select id,ghichu from ghichu");
    while ($b = mysql_fetch_array($a)) {
        $option.="<option value=\"{$b['id']}\">{$b['ghichu']}</option>";
    }
    return $option;
}
function tenpage($idpage){
    $a = mysql_query("select page from listpage where id='{$idpage}'");
    $b = mysql_fetch_array($a);
    return $b['page'];
}
function taoformselectpage(){
    $a = mysql_query("select * from listpage");
    $form_select = "";
    while ($b = mysql_fetch_array($a)) {
        $id = $b['id'];
        $tenpage = $b['page'];
        $form_select.= "<option value=\"{$id}\">{$tenpage}</option>";
    }
    return $form_select;
}
function laymadonhang($id){
    $a = mysql_query("select madonhang from donhang where id = '{$id}'");
    $b = mysql_fetch_array($a);
    return $b['madonhang'];
}
?>