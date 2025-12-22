function checkmyCart(){
	if($('.product_price').val()){
		var price = parseInt($('.product_price').val());
	}else{
		var price = 0;
	}
	$('.myinput:checked').each(function(key, val){
		if($(val).val()){
			var quantity = $(this).parents('.mall-label').find('.quantity').val();
			price += quantity * parseInt($(val).val());
		}
	});
	$('.total_price').html(price);
	$('.total_price').simpleMoneyFormat();
	checkMax();
}
function checkMax(){
	var html = '';
	$('.nk-config-group').each(function(key2,val2){
		var max = $(this).find('.floatRight').attr('data-max');
		var data_name = $(this).find('.floatRight').attr('data-name');
		var check_max = 0;
		$(this).find('.myinput:checked').each(function(key, val){
			var quantity = parseInt($(this).parents('.mall-label').find('.quantity').val());
			check_max = check_max + quantity;
		});
		if(check_max > max && max >0){
			html += '<div class="error">'+data_name+' max qty '+max+' ('+check_max+' selected)</div>';
		}
	});
	$('#config-warnings').html(html);
}