<script>

function DomainName()
	{
		var is_url = /^([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/;
	var domainName = document.domain;
	//domainName = domainName.replace(/www\./g, '');
	return location.protocol + "//" + domainName ;

	}function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}
function Load_Datadonhang(id_page,s_page,time)
	{
		
		var timer = 0;
	  $('#list_capnhat').html('');
	  
						   $.ajax({
					      url: "../ajax/donhang.php",
					      
					      type : "POST",
					     
						  dataType:"json",
					      data: { id_ghtk_up : time, //$('#chonngayupdate').val(),
						      page: id_page,
						      per_page: s_page
						       },
					      success : function (result){
	                    if(result.data == null) {
		                    $.ajax({
					      url: "../ajax/donhang.php",
					      
					      type : "POST",
					     
						  dataType:"json",
					      data: { del_cache : time
						       },
					      success : function (result){
						      $('#capnhat_page').html('Đã xử lý xong');
						      
						  				}
						  			
						  				});
						  	return true;
	                    }
$('#loadingmessage').hide();
					
					html = '';
					$.each(result.data, function(i, row) {
						html +='<tr data-id="'+row.madh+'" data-value="'+row.ghtk+'" id="dh_'+row.madh+'"><td>'+row.madh+'</td><td id="msg"></td><td id="vndes_result"></td></tr>';
						
					/*	 setInterval(function(){
						update_withmadh(row.madh,row.ghtk,this);
						},500);
						$(function () {
						
						});
						*/
						
						
					});
					clearTimeout(timer);
					
                    $('#list_capnhat').html(html);	
						

	                   var list = $('tbody#list_capnhat tr'),
	                   		list = parseInt(list);
						var i = 0;
						var div_check1 = $('tbody#list_capnhat tr').first(); 
                             var check1 = $('tbody#list_capnhat tr:nth-child(0) td#vndes_result').html(); 	
						 	var id1 = div_check1.attr('data-id');
						 	var ghtk1 = div_check1.attr('data-value');
						 	
						if(i < 1)
						 {
						 		setTimeout(function(){
							 		update_withmadh(id1,ghtk1,this);
							 		
							 		}, 1000);
							 	
							 	i++;
							 	
						}
						
						setInterval(function(){
						
							
			 			
							if(i > 0)
								{
									var a = parseInt(i)-1;
								}
							else {
								var a = i;
							
							
							}

					 var div_check = $('tbody#list_capnhat tr:eq('+i+')'); 
			 var check = $('tbody#list_capnhat tr:eq('+a+') td#vndes_result').html();	
			 
			 	var id = div_check.attr('data-id');
					var ghtk = div_check.attr('data-value');
					//var abc2=update_withmadh(id,ghtk,this);
					
			  if(check =='ok')
			  	{
				  
				  	var abc=update_withmadh(id,ghtk,this);
				  	
				  	 i++;
			  	}
	
		  },1000);
						
			
					
						
						
                    }
					   
					   });	
		
	}
function update_status(value){
	 $('#bangcapnhat').show();
	 var div = $('#bangcapnhat');
	
	 var total_resget = $('#capnhat_page').attr('data-id'),
	 			total_res = total_resget;
	
	  $('#bangdulieu').hide();
	  var hr = window.location.href;
	  var interval = null;
//$('#loadingmessage').show();
//var total_records =  0; 

$.ajax({
                    url : "../ajax/donhang.php",
                    type : "POST",

                    dataType:"json",
                    data : {
                    	date : $('#chonngayupdate').val(),
                    	result_total : 1
		  },
                    success : function (result){
	                  var total_records =   result;
	                 
	                  $('#capnhat_note').html('Còn <b>'+total_records+'</b> đơn hàng').addClass('alert alert-danger');
	                 if (total_records == 0)
	                 	{
		                 	$('#capnhat_page').html('Đã xử lý xong');
		                 	
	                 	}
	                 var get_page = getUrlParameter('page');
	                 if( get_page == undefined)
	                 	{
		                 	var i = 0;
	                 	}
	                 else {
		               
		                 	var i = parseInt(get_page);
	                 }
	                 var per_page = 50;
	                // total_res = total_res + per_page;
	                  var get_total_res = getUrlParameter('total_res');
	                   if( get_total_res == undefined)
	                 	{
		                 	total_ress = per_page;
	                 	}
	                 else {
		                 	total_ress = get_total_res;
	                 }
	                  $('#capnhat_page').html('Kết quả: <span>'+total_ress+'</span>/'+total_records).addClass('alert alert-success');
					var total_pages = Math.floor(total_records / per_page);
					 var count =0;
					if(count < 1)
					{
						setTimeout(function(){
							 		Load_Datadonhang(i,per_page,$('#chonngayupdate').val());
							 		
							 		}, 1000);
					
					count++;
					//console.log(i);
					}
					
					
		  setInterval(function(){
			 
			// check = $('tbody#list_capnhat tr:eq('+per_page+')  td#vndes_result').html(); 
			 // var check1 = $('tbody#list_capnhat tr:nth-child(0) td#vndes_result').html(); 	
					if(count > 0)
								{
									var a = parseInt(count)-1;
								}
							else {
								var a = count;
							
							
							}

					 var div_check = $('tbody#list_capnhat tr:eq('+count+')'); 
			 var check = $('tbody#list_capnhat tr td#vndes_result').last().html();			 	
						
			 
			// count = count+1;
			  if(check =='ok')
			  	{
				  	
				  	
				  	var abc = Load_Datadonhang(i,per_page,$('#chonngayupdate').val());
				  	 
				  	  count++;
				  	  console.log(count);
				  	 var currentUrl = window.location.href;
				  	 	total_ress=(parseInt(per_page)+parseInt(total_ress));
						 i++;	
						 var a1 = DomainName() +'/v3/mod/donhang?autorun='+ $('#chonngayupdate').val();
						 	a1 += '&total_res='+ total_ress;
						 	a1 += '&page='+ i; 
						
						window.location.href =  a1;
						
						
						
			  	}
			
		  },1000);	
					
				
					
					
       
       
        
        
 
   
  
					/*for(var i = 0; i < total_pages; i++) {
					 
					 
					}*/
						
                    }
                   
                  
                });

				  clearInterval(interval);

 
}
function update_withmadh(mdh,ghtk,divtr)
	{
		 var div = $('#bangcapnhat');
		
		
		 $('tbody#list_capnhat tr#dh_' + mdh +' td#msg').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');	
		$.ajax({
                    url : "../ajax/donhang.php",
                    type : "POST",
                    dataType:"json",
                    
                    data : {
                    	update_withmadh : ghtk,
		  },
                    success : function (result){
					
                   $('tbody#list_capnhat tr#dh_' + mdh +' td#msg').html(result.note);	
				   $('tbody#list_capnhat tr#dh_' + mdh +' td#vndes_result').html('ok');
				    
				 
                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    },
                    error : function (result){
					
                   $('tbody#list_capnhat tr#dh_' + mdh +' td#msg').html('Lỗi hệ thống');	
				   $('tbody#list_capnhat tr#dh_' + mdh +' td#vndes_result').html('ok');
				   update_withmadh(mdh,ghtk,divtr);
                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    }
                });
               
	}
$(document).ready(function() {
    $('#table_donhang').DataTable();
});
//Sửa
$("form#edit_donhang").submit(function(){

    var formData = new FormData(this);

    $.ajax({
        url: '../ajax/donhang.php',
        type: 'POST',
        data: formData,
        async: false,
        success: function (data) {
             
           $('.mfp-ready').remove();
             $('#test_result').html(data);

        },
        cache: false,
        contentType: false,
        processData: false
    });

    return false;
});
 function suadonhang(value){

                  $.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	donhang : value,
                    	
                    },
                    success : function (result){
                    	$('#div_edit_donhang').html(result)
                    }
                });
}

             function xoadonhangapi(value){
					$('#loadingmessage').show();
                  $.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
					
                    dataType:"text",
                    data : {
                    	token: 'xoadonhang_api',
                    	donhang : value,
                    	
                    },
                    success : function (result){
						 
                    	$('#test_result').html(result)
						$('#loadingmessage').hide();
                    },

                });
}
             function xoadonhang(value){
					$('#loadingmessage').show();
                  $.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
					
                    dataType:"text",
                    data : {
                    	token: 'xoadonhang',
                    	donhang : value,
                    	
                    },
                    success : function (result){
						 
                    	$('#test_result').html(result)
						$('#loadingmessage').hide();
                    },

                });
}
 function xacnhan(value){

                  $.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	xacnhandonhang : value,
                    	
                    },
                    success : function (result){
                    	$('#result').html(result)

                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    }
                });
}
            function change_view(value){
                $.ajax({
                    url : "ajax_product.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         view_type : value,

                    },
                    success : function (result){
                        $('#list_products').html(result);
                    }
                });
            }
removeDiv = function(el) {
    $(el).parents(".RemoveDiv").remove()       
}
 function addInput(){

                  $.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	addinputid : $('#SelectToAdd').val(),
                    	
                    },
                    success : function (result){
						//(result).appendTo( "#toAddInput" );
                    	//$('#result').html(result)
							$("#toAddInput").append(result);
                    	//$('.mfp-ready').remove()
                        //$('#test_result').html(result);
                    }
                });
}

//Search Đơn Hàng
 function searchdon(){
	 $('#loadingmessage').show();
var table = $('#table_donhang').DataTable();
                  $.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	searchdonhang : $('#searchdonhang').val(),
                    	 },
                    success : function (result){
						$('#loadingmessage').hide();
                    	$('#bangdulieu').html(result);
                    	$('#table-all').DataTable();
                    	
                    }
                });
}

 function info_ghtk(value){

                  $.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	status_ma_ghtk : value,
                    	
                    },
                    success : function (result){
                    	$('#result').html(result)
                    }
                });
}
 function api_id(value){
//$('#loadingmessage').show();
                  $.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                    	api_id: value,
                    	
                    },
                    success : function (result){
			$('#loadingmessage').hide();
                    	$('#result').html(result)

                    }
                });
}
 function apiall(){
//$('#loadingmessage').show();
	$('#bangcapnhat').show();
	 var div = $('#bangcapnhat');
	 $('#capnhat_page').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Đang xử lý dữ liệu ...').addClass('alert alert-success');
	 var total_resget = $('#capnhat_page').attr('data-id'),
	 			total_res = parseInt(total_resget);
	 var count =0;
	 var s_page = 20;
	  $('#bang_donhang').remove();
                  $.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
                    dataType:"json",
                     cache: false,
						  async: true,
                    data : {
                    	apiall: "yes",
                    	limit : s_page,
                    	
                    },
                    success : function (result){
			$('#loadingmessage').hide();
				html ='';
                    	$.each(result.data, function(i, row) {
						html +="<tr id='dh_"+row.madonhang+"' data-content='"+ JSON.stringify(row) +"' data-id='"+row.madonhang+"'><td>"+row.madonhang+"</td>"
						+'<td>'+row.khachhang+'</td>'
						+'<td>'+row.sdt+'</td>'
						+'<td id="msg"></td><td id="vndes_result"></td></tr>';

					});
					$('#list_dangapi').html(html);	
					var i = 0,count = 0;
						
						var div_check1 = $('tbody#list_dangapi > tr').first(); 
                             var check1 = $('tbody#list_dangapi tr:nth-child(0) td#vndes_result').html(); 	
						 	var content1 = div_check1.attr('data-content');
						 	var mdh1 = div_check1.attr('data-id');
						 
						 if(i < 1)
						 {
						 		setTimeout(function(){
							 		update_apiwithmadh(content1,mdh1,this);
							 		
							 		}, 1000);
							 	
							 	i++;
							 	
						}
						
						setInterval(function(){
						
							
			 			
							if(i > 0)
								{
									var a = parseInt(i)-1;
								}
							else {
								var a = i;
							
							// i++;
							}
							
								 var div_check = $('tbody#list_dangapi tr:eq('+i+')'); 
								 var check = $('tbody#list_dangapi tr:eq('+a+') td#vndes_result').html();	
								var content = div_check.attr('data-content'); 
								var mdh = div_check.attr('data-id');
								//var abc2=update_apiwithmadh(content,mdh,this);
							  	
							  
							console.log(a+ '_' + check);  	
						  if(check == 'ok')
						  	{
							  		var abc=update_apiwithmadh(content,mdh,this);
							  	
								count = count+1;
							  	i++;
						  	}
						 
						  	
				  	 var currentUrl = window.location.href;
				  	// clearInterval(interval_obj);
				  	 
				  	 if(count >= s_page)
						{
							window.location.href = updateQueryStringParameter(currentUrl, 'autorun', 'yes');
						}
						 
					  },1000);
									
						
                    }
                });
}
function update_apiwithmadh(content,mdh,divapi)
	{
		 var div = $('#bangcapnhat');
		
		
		 $('tbody#list_dangapi tr#dh_' + mdh +' td#msg').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');	
	$.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
                    dataType:"json",
                    cache: false,
                     async: true,
                    data : {
                    	update_apiwithmadh : content,
		  },
                    success : function (result){
					
                   $('tbody#list_dangapi tr#dh_' + mdh +' td#msg').html(result.note);	
				   $('tbody#list_dangapi tr#dh_' + mdh +' td#vndes_result').html('ok');

                    },
                    error : function (result){
					
                   $('tbody#list_dangapi tr#dh_' + mdh +' td#msg').html('Lỗi hệ thống');	
				   $('tbody#list_dangapi tr#dh_' + mdh +' td#vndes_result').html('error');
				   msg ='er';
				   update_apiwithmadh(content);

                    }
                });
              
	}
 function fixapi(){
$('#bangcapnhat').show();
	 var div = $('#bangcapnhat');
	 $('#capnhat_page').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Đang xử lý dữ liệu ...').addClass('alert alert-success');
	 var total_resget = $('#capnhat_page').attr('data-id'),
	 			total_res = parseInt(total_resget);
	 var count =0;
	 var s_page = 20;
	  $('#bang_donhang').remove();
                  $.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
                    dataType:"json",
                    data : {
                    	fixapi: "yes",
                    	limit : s_page
                    	
                    },
                    success : function (result){
	                    $('#capnhat_page').html('Có tổng cộng ' +result.total+' đơn hàng ');
			$('#loadingmessage').hide();
				html ='';
                    	$.each(result.data, function(i, row) {
						html +="<tr id='dh_"+row.madonhang+"' data-id='"+row.madonhang+"'><td>"+row.madonhang+"</td>"
						+'<td></td>'
						+'<td></td>'
						+'<td id="msg"></td><td id="vndes_result"></td></tr>';
					});
					$('#list_dangapi').html(html);	
					var i = 0,count = 0;
						
						var div_check1 = $('tbody#list_dangapi > tr').first(); 
                             var check1 = $('tbody#list_dangapi tr:nth-child(0) td#vndes_result').html(); 	
						 	var content1 = div_check1.attr('data-content');
						 	var mdh1 = div_check1.attr('data-id');
						 
						 if(i < 1)
						 {
						 		setTimeout(function(){
							 		update_fixapiwithmadh(mdh1);
							 		
							 		}, 1000);
							 	
							 	i++;
							 	
						}
						
						setInterval(function(){
						
							
			 			
							if(i > 0)
								{
									var a = parseInt(i)-1;
								}
							else {
								var a = i;
							
							// i++;
							}
							
								 var div_check = $('tbody#list_dangapi tr:eq('+i+')'); 
								 var check = $('tbody#list_dangapi tr:eq('+a+') td#vndes_result').html();	
								var content = div_check.attr('data-content'); 
								var mdh = div_check.attr('data-id');
							console.log(a+ '_' + check);  	
						  if(check == 'ok')
						  	{
							  		var abc=update_fixapiwithmadh(mdh);
							  	
								count = count+1;
							  	i++;
						  	}
						 
						  	
				  	 var currentUrl = window.location.href;
				  	// clearInterval(interval_obj);
				  	 
				  	 if(count >= s_page)
						{
							//window.location.href = updateQueryStringParameter(currentUrl, 'autorun_fix', 'yes');
						}
						 
					  },1000);
									
						
                    }
                });
}
function update_fixapiwithmadh(mdh)
	{
		 var div = $('#bangcapnhat');
		
		
		 $('tbody#list_dangapi tr#dh_' + mdh +' td#msg').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');	
	$.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
                    dataType:"json",
                    cache: false,
                     async: true,
                    data : {
                    	capnhatmaapi : mdh,
		  },
                    success : function (result){
					
                   $('tbody#list_dangapi tr#dh_' + mdh +' td#msg').html(result.note);	
				   $('tbody#list_dangapi tr#dh_' + mdh +' td#vndes_result').html('ok');

                    },
                    error : function (result){
					
                   $('tbody#list_dangapi tr#dh_' + mdh +' td#msg').html('Lỗi hệ thống');	
				   $('tbody#list_dangapi tr#dh_' + mdh +' td#vndes_result').html('error');
				   msg ='er';
				   update_fixapiwithmadh(mdh);

                    }
                });
              
	}
 function change_ghichu(value){
                $.ajax({
                    url : "../ajax/donhang.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         idghichu : value,

                    },
                    success : function (result){
                        $('#ghichu').html(result);
                    }
                });
            }
</script>