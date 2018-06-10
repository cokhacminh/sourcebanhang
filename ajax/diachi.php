<?php
include("../db.php");
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
	echo "<input name=\"tinh\" type=\"text\" class=\"form-control\" readonly=\"readonly\" value=\"{$tentinh}\" required>";
}
if(isset($_POST['themthongtin_huyen']))
{
	$huyen = $_POST['themthongtin_huyen'];
	$tenhuyen = tenhuyen($huyen);
	echo "<input name=\"huyen\" type=\"text\" class=\"form-control\" readonly=\"readonly\" value=\"{$tenhuyen}\" required>";
}
?>