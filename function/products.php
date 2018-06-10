<?php
function danhsachsanpham($nhomsanpham)
{
	global $quyenhan;
	global $site_url;
	$html = "";
										if($nhomsanpham == "all")
										$sql = mysql_query("select * from masanpham");
										else
										$sql = mysql_query("select * from masanpham where nhomsanpham='{$nhomsanpham}'");
										while($do = mysql_fetch_array($sql))
										{
											if($do['hinhanh'] =="")$hinhanh = "noimage.png";else $hinhanh = $do['hinhanh'];
											$nhomsanpham = $do['nhomsanpham'];
											$id = $do['id'];
											$giasanpham = number_format($do['giaban']);
											$giale = number_format($do['giale']);
											$tensanpham = $do['ten'];
											$masanpham = $do['masanpham'];
											$ghichu = $do['ghichu'];
											$sql2 = mysql_query("select ten from nhomsanpham where id='{$nhomsanpham}'");
											$kqnhomsanpham = mysql_fetch_array($sql2);
											$ten_nhomsanpham = $kqnhomsanpham['ten'];
											$sql2 = mysql_query("select id,size,soluong from sanpham where masanpham='{$masanpham}'");
											$tongsoluong = 0;
											$show_soluong = "";
											while($data_soluong = mysql_fetch_array($sql2))
											{
												$size = $data_soluong['size'];
												$soluong = $data_soluong['soluong'];
												if($quyenhan['smod'] =="1")

												$button = " <button type=\"button\"  style=\"font-size:10px;\"  data-toggle=\"modal\" data-target=\"#Modal_nhaphang\" onclick=\"nhaphang({$data_soluong['id']})\"><i class=\"fa fa-plus\"></i></button> <button onclick=\"xoasize({$data_soluong['id']})\" style=\"font-size:10px;\"><i class=\"fa fa-times\"></i></button>";
												else 
												$button = "";	
												$show_soluong .="Size ".$size." còn : <font color=\"red\">".$soluong."</font> cái . ".$button."<br />";
												$tongsoluong+=$soluong;
											}
											if($quyenhan['smod'] =="1")
											$button_2 = "<a href=\"#modalForm_editproduct\" class=\"hvr-float modal-with-form mb-xs mt-xs mr-xs btn btn-success\" onclick=\"suasanpham({$id})\"><i class=\"fa fa-pencil-square-o\"></i> CHỈNH SỬA</a> <a class=\"hvr-float mb-xs mt-xs mr-xs btn btn-danger\" title=\"Xóa sản phẩm này\" onclick=\"xoasanpham({$id})\"><i class=\"fa fa-user-times\"></i> XÓA</a>";
											else
											$button_2 = "";
											if($quyenhan['smod'] =="1")	
												$thaotac = "<td style=\"vertical-align: middle;text-align:center\">{$button_2}</td>";
											else $thaotac = "";
											$html .=  "
											<tr class=\"gradeX\">
											
											<td style=\"vertical-align: middle;text-align:center\">
	<a href=\"{$site_url}/images/sanpham/{$hinhanh}\" data-plugin-lightbox data-plugin-options='{ \"type\":\"image\" }' title=\"{$tensanpham} \nMã sản phẩm : {$masanpham}\">
												<img class=\"img-responsive listproducts hvr-grow\" src=\"{$site_url}/images/sanpham/{$hinhanh}\">
											</a>
											</td>
											
											<td style=\"vertical-align: middle;text-align:center\">{$masanpham}</td>
											<td style=\"vertical-align: middle;text-align:center\">{$ten_nhomsanpham}</td>
											<td style=\"vertical-align: middle;text-align:center\">Giá bán : <font color='red'>{$giasanpham}</font><br />Giá 1 bộ : <font color='red'>{$giale}</font></td>
											<td style=\"vertical-align: middle;text-align:center\"><font color='blue'>{$show_soluong}</font></td>
											<td style=\"vertical-align: middle;text-align:center\"><font color='blue'>{$tongsoluong}</font></td>
											
											{$thaotac}
										</tr>
											";

										}
										return $html;

}
?>