/*
Name: 			UI Elements / Charts - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.4.1
*/

(function( $ ) {

	'use strict';






	/*
	Morris: Bar
	*/
	Morris.Bar({
		resize: true,
		element: 'morrisBar',
		data: morrisBarData,
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['Đơn Hàng', 'Tỉ Lệ Chốt'],
		hideHover: true,
		barColors: ['#009206', '#e60c0c']
	});



}).apply( this, [ jQuery ]);