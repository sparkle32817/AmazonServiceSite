
$(document).ready(function () {

	$('#table_client_session').DataTable();
	$('#table_membership_history').DataTable();
	var table_history = $('#table_history').DataTable();

	$("#table_history tbody").on("click", ".history-delete", function () {

		if (!confirm('Are you sure you want to delete this?'))
			return;

		var task_id = $(this).attr('d-id');
		var service = $(this).attr('d-service');

		$.ajax({
			url: base_url + 'user/Home/deleteHistory',
			type: 'POST',
			data: {
				id: task_id,
				service: service
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {

					if (data == 'success')
						$('#table_history').DataTable().ajax.reload(null, false);
				}
		});
	});

	var demo1 = document.querySelector('#scroller_history_pending');
	if (demo1 != null)
		new PerfectScrollbar(demo1);

	var demo2 = document.querySelector('#scroller_history_complete');
	if (demo2 != null)
		new PerfectScrollbar(demo2);

	var demo3 = document.querySelector('#scroller_history_info');
	if (demo3 != null)
		new PerfectScrollbar(demo3);

	/*
	*
	* Service
	* */
	//--- Promote Brand ---//
	$('#promote_form').on('submit', function () {
		var market_place = $("#promote_market_place option:selected").html();
		var brand = $('#promote_brand').val();
		var keywords = $('#promote_keywords').val().trim();
		var asin = $('#promote_asin').val();
		var min_price = $('#promote_min_price').val();
		var max_price = $('#promote_max_price').val();

		if ($("#promote_market_place option:selected").val()=='' || brand=='' || keywords=='')
			return;

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,`.<>\/?]/;
		if (format.test(asin))
		{
			popUpToast('warning', 'Don\'t input special characters in ASIN.');
			return;
		}

		if (asin!='' && asin.length!=10)
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		var format2 = /[0-9.]/;
		if ( (min_price!='' && !format2.test(min_price)) || (max_price!='' && !format2.test(max_price)) )
		{
			popUpToast('warning', 'Price must only contain numbers.');
			return;
		}

		var str_url = 'https://www.'+market_place+'/s/ref=nb_sb_noss_2?url=search-alias%3Daps'
						+'&field-keywords='+keywords+'&field-brand='+brand;

		if (asin != '')
			str_url += '&field-asin='+asin;

		if (min_price != '')
			str_url += '&low-price='+min_price;

		if (max_price != '')
			str_url += '&high-price='+max_price;

		$('#promote_url').val(str_url);

		return false;
	});
	
	$('#promote_btn_go').click(function () {

		var str_url = $('#promote_url').val();
		if (str_url == '')
			return;

		window.open(str_url, '_blank');
	});

	$('#promote_btn_copy').click(function () {

		if ($('#promote_url').val() == '')
			return;

		$('#promote_url').select();
		document.execCommand("copy");

		alert('Successfully copied.');
	});

	//--- ASIN KEYWORD URL ---//
	$('#asin_form').on('submit', function () {
		var market_place = $("#asin_market_place option:selected").html();
		var asin = $('#asin_asin').val();
		var keywords = $('#asin_keywords').val().trim();

		if ($("#asin_market_place option:selected").val()=='' || asin=='' || keywords=='')
			return;

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,`.<>\/?]/;
		if (format.test(asin))
		{
			popUpToast('warning', 'Don\'t input special characters in ASIN.');
			return;
		}

		if (asin.length!=10)
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		var str_url = 'https://www.'+market_place+'/s/?keywords='+keywords+'&ie=UTF8&field-asin='+asin+'&rh=i:aps,ssx:relevance';

		$('#asin_url').val(str_url);

		return false;
	});

	$('#asin_btn_go').click(function () {

		var str_url = $('#asin_url').val();
		if (str_url == '')
			return;

		window.open(str_url, '_blank');
	});

	$('#asin_btn_copy').click(function () {

		if ($('#asin_url').val() == '')
			return;

		$('#asin_url').select();
		document.execCommand("copy");

		alert('Successfully copied.');
	});

	//--- ASIN KEYWORD URL (SPECIAL) ---//
	$('#asin_special_form').on('submit', function () {
		var market_place = $("#asin_special_market_place option:selected").html();
		var asin = $('#asin_special_asin').val();
		var keywords = $('#asin_special_keywords').val().trim();

		if ($("#asin_special_market_place option:selected").val()=='' || asin=='' || keywords=='')
			return;

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,`.<>\/?]/;
		if (format.test(asin))
		{
			popUpToast('warning', 'Don\'t input special characters in ASIN.');
			return;
		}

		if (asin.length!=10)
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		var str_url = 'https://www.'+market_place+'/s/ref=nb_sb_noss_1?url=search-alias%3Daps&field-keywords='+keywords+'&hidden-keywords='+asin;

		$('#asin_special_url').val(str_url);

		return false;
	});

	$('#asin_special_btn_go').click(function () {

		var str_url = $('#asin_special_url').val();
		if (str_url == '')
			return;

		window.open(str_url, '_blank');
	});

	$('#asin_special_btn_copy').click(function () {

		if ($('#asin_special_url').val() == '')
			return;

		$('#asin_special_url').select();
		document.execCommand("copy");

		alert('Successfully copied.');
	});

	//--- SEARCH ENGINE AMAZON URL ---//
	$('#search_form').on('submit', function () {
		var market_place = $("#search_market_place option:selected").html();
		var asin = $('#search_asin').val().trim();
		var keyword1 = $('#search_keyword1').val().trim();
		var keyword2 = $('#search_keyword2').val().trim();
		var keyword3 = $('#search_keyword3').val().trim();
		var keyword4 = $('#search_keyword4').val().trim();
		var keyword5 = $('#search_keyword5').val().trim();

		if ($("#search_market_place option:selected").val()=='' || asin=='' || keyword1=='' || keyword2=='' || keyword3=='' || keyword4=='' || keyword5=='')
			return;

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,`.<>\/?]/;
		if (format.test(asin))
		{
			popUpToast('warning', 'Don\'t input special characters in ASIN.');
			return;
		}

		if (asin.length!=10)
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		var str_url = 'https://www.'+market_place+'/'+keyword1+'-'+keyword2+'-'+keyword3+'-'+keyword4+'-'+keyword5+'-'+'/dp/'+asin;

		$('#search_url').val(str_url);

		return false;
	});

	$('#search_btn_go').click(function () {

		var str_url = $('#search_url').val();
		if (str_url == '')
			return;

		window.open(str_url, '_blank');
	});

	$('#search_btn_copy').click(function () {

		if ($('#search_url').val() == '')
			return;

		$('#search_url').select();
		document.execCommand("copy");

		alert('Successfully copied.');
	});

	//--- ADD TO CART ---//
	$('#cart_form').on('submit', function () {
		var market_place = $("#cart_market_place option:selected").html();
		var asin = $('#cart_asin').val().replace(/\s/g, '');
		var quantity = $('#cart_quantity').val();

		if ($("#cart_market_place option:selected").val()=='' || asin=='' || quantity=='')
			return;

		var format1 = /[!@#$%^&*()_+\-=\[\]{};':"\\|,`.<>\/?]/;
		if (format1.test(asin))
		{
			popUpToast('warning', 'Don\'t input special characters in ASIN.');
			return;
		}

		if (asin.length!=10)
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		var format2 = /[0-9]/;
		if ( !format2.test(quantity) )
		{
			popUpToast('warning', 'Quantity must only contain numbers.');
			return;
		}

		var str_url = 'https://www.'+market_place+'/gp/aws/cart/add.html?ASIN.1='+asin+'&Quantity.1='+quantity;

		$('#cart_url').val(str_url);

		return false;
	});

	$('#cart_btn_go').click(function () {

		var str_url = $('#cart_url').val();
		if (str_url == '')
			return;

		window.open(str_url, '_blank');
	});

	$('#cart_btn_copy').click(function () {

		if ($('#cart_url').val() == '')
			return;

		$('#cart_url').select();
		document.execCommand("copy");

		alert('Successfully copied.');
	});

	//--- ADD TO CART MULTIPLE ASIN ---//
	$('#cart_multi_form').on('submit', function () {
		var market_place = $("#cart_multi_market_place option:selected").html();
		var asin1 = $('#cart_multi_asin1').val().replace(/\s/g, '');
		var quantity1 = $('#cart_multi_quantity1').val();
		var asin2 = $('#cart_multi_asin2').val().replace(/\s/g, '');
		var quantity2 = $('#cart_multi_quantity2').val();
		var asin3 = $('#cart_multi_asin3').val().replace(/\s/g, '');
		var quantity3 = $('#cart_multi_quantity3').val();
		var asin4 = $('#cart_multi_asin4').val().replace(/\s/g, '');
		var quantity4 = $('#cart_multi_quantity4').val();

		if ($("#cart_multi_market_place option:selected").val()==''
			|| asin1=='' || quantity1==''
			|| asin2=='' || quantity2=='')
			return;
		
		if (asin3 != '' && quantity3=='')
		{
			popUpToast('warning', 'You have to input value in Quantity3 field.');
			return;
		}

		if (asin3=='' && quantity3!='')
		{
			popUpToast('warning', 'You have to input value in ASIN3 field.');
			return;
		}

		if (asin4 != '' && quantity4=='')
		{
			popUpToast('warning', 'You have to input value in Quantity4 field.');
			return;
		}

		if (asin4=='' && quantity4!='')
		{
			popUpToast('warning', 'You have to input value in ASIN4 field.');
			return;
		}

		if (asin3 =='' && asin4!='')
		{
			popUpToast('warning', 'First, you have to fill value in ASIN3 field.');
			return;
		}

		if (asin1.length!=10
			|| asin2.length!=10
			|| (asin3!='' && asin3.length!=10)
			|| (asin4!='' && asin4.length!=10))
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		var format1 = /[!@#$%^&*()_+\-=\[\]{};':"\\|,`.<>\/?]/;
		if (format1.test(asin1)
			|| format1.test(asin2)
			|| (asin3!='' && format1.test(asin3))
			|| (asin4!='' && format1.test(asin4)))
		{
			popUpToast('warning', 'Don\'t input special characters in ASIN.');
			return;
		}

		var format2 = /[0-9]/;

		if ( !format2.test(quantity1)
			|| !format2.test(quantity2)
			|| (quantity3!='' && !format2.test(quantity3))
			|| (quantity4!='' && !format2.test(quantity4)))
		{
			popUpToast('warning', 'Quantity must only contain numbers.');
			return;
		}

		var str_url = 'https://www.'+market_place+'/gp/aws/cart/add.html?ASIN.1='+asin1+'&Quantity.1='+quantity1+'&ASIN.2='+asin2+'&Quantity.2='+quantity2;

		if (asin3 != '')
			str_url += '&ASIN.3='+asin3+'&Quantity.3='+quantity3;

		if (asin4 != '')
			str_url += '&ASIN.4='+asin4+'&Quantity.4='+quantity4;

		console.log(str_url);
		$('#cart_multi_url').val(str_url);

		return false;
	});

	$('#cart_multi_btn_go').click(function () {

		var str_url = $('#cart_multi_url').val();
		if (str_url == '')
			return;

		window.open(str_url, '_blank');
	});

	$('#cart_multi_btn_copy').click(function () {

		if ($('#cart_multi_url').val() == '')
			return;

		$('#cart_multi_url').select();
		document.execCommand("copy");

		alert('Successfully copied.');
	});

	//--- SEARCH MULTI ASIN ---//
	$('#search_multi_form').on('submit', function () {
		var market_place = $("#search_multi_market_place option:selected").html();
		var first_asin = $('#search_multi_asin1').val();
		var multi_asin = $('#search_multi_text_area').val();

		if ($("#search_multi_market_place option:selected").val()=='' || first_asin=='')
			return;

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,`.<>\/?]/;
		if (format.test(first_asin) || format.test(multi_asin))
		{
			popUpToast('warning', 'Don\'t input special characters in ASIN.');
			return;
		}

		if (first_asin.length!=10)
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		var arr_asin = multi_asin.split('\n');console.log(arr_asin);
		for (var i=0; i<arr_asin.length; i++)
		{
			asin = checkCorrectAsin(arr_asin[i]);
			if (!asin)
			{
				arr_asin.splice(i, 1);
			}
			else
				arr_asin.splice(i, 1, asin);
		}

		var str_url = '';
		if (arr_asin.length == 0) {
			console.log('here');
			str_url = 'https://www.amazon.com/s/?k=' + first_asin + '&ref=nb_sb_noss';
			console.log(''+str_url);
		}
		else
		{
			console.log('there');
			str_url = 'https://www.'+market_place+'/s/?k='+first_asin+'%7C+';
			if (arr_asin.length==1)
			{
				str_url += arr_asin[0] + '&ref=nb_sb_noss';
			}
			else
			{
				for (var j=0; j<arr_asin.length-1; j++){
					str_url += arr_asin[j] + '%7C';
				}
				str_url += '+' + arr_asin[arr_asin.length-1] + '&ref=nb_sb_noss';
			}
		}
		$('#search_multi_url').val(str_url);

		return false;
	});

	$('#search_multi_btn_go').click(function () {

		var str_url = $('#search_multi_url').val();
		if (str_url == '')
			return;

		window.open(str_url, '_blank');
	});

	$('#search_multi_btn_copy').click(function () {

		if ($('#search_multi_url').val() == '')
			return;

		$('#search_multi_url').select();
		document.execCommand("copy");

		alert('Successfully copied.');
	});

	checkCorrectAsin = function(check_asin)
	{
		var asin = check_asin.replace(/\s/g, '');
		if (asin == '')
			return false;
		
		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,`.<>\/?]/;
		if (format.test(asin))
		{
			return false;
		}

		if (asin.length!=10)
		{
			return false;
		}

		return asin;
	}


	/*
	*
	* Profile Edit & Save
	* */

	$( "#edit_profile" ).click(function() {
		var edit_button_str = $("#edit_profile").text();
		var icon = $('<i class="fa fa-edit m-right-xs"></i>');

		if ( edit_button_str == "Edit Profile " || edit_button_str == "编辑资料 " )
		{
			$('#input-avatar-change').prop("disabled",false);
			$('#div-avatar-change').attr('class', 'view view-first');
			$('#pen-avatar-change').attr('style', 'display: block;');

			if (edit_button_str=="Edit Profile ")
				$('#edit_profile').text('Save ').append(icon);
			else
				$('#edit_profile').text('保存 ').append(icon);

			$('#full_name').removeAttr('readonly');
			$('#email').removeAttr('readonly');
			$('#phone_number').removeAttr('readonly');
			$('#address').removeAttr('readonly');
			$('#market_place').removeAttr('disabled');
			$('#invitation_code').removeAttr('readonly');
			$('#amazon_id').removeAttr('readonly');
			$('#qq').removeAttr('readonly');
			$('#other_service').removeAttr('readonly');
			$('#img_chg_btn_group').attr('style', 'display: inline-block;');
		}
		else
		{
			$('#input-avatar-change').prop("disabled",true);
			$('#div-avatar-change').removeAttr('class');
			$('#pen-avatar-change').attr('style', 'display: none;');

			var username = $("#user_name").val();
			var email = $("#email").val();
			var full_name = $("#full_name").val();
			var phone = $("#phone_number").val();
			var address = $("#address").val();
			var market_place = $("#market_place").val();
			var amazon = $("#amazon_id").val();
			var invitation = $("#invitation_code").val()?$("#invitation_code").val():'';
			var qq = $("#qq").val();
			var other_service = $("textarea#other_service").val();

			if (username == "" || email == "" || full_name === "" || phone == "" || address == "" || market_place == "" || amazon == "" || other_service == "" || qq == "") return;

			var response='';
			if (is_change==1)
			{
				var base64data=$("#avatar-img").attr('src');

				$.ajax({
					url:  base_url + 'profile/image_upload',
					method: 'POST',
					data: {image: base64data},
					dataType: 'text',
					async: false,
					success: function(data){
						$("#side_user_avatar").attr('src', base64data);
						$("#top_user_avatar").attr('src', base64data);
						is_change = 0;
					}
				});
			}

			// var response;
			$.ajax({
				url: base_url + 'profile/update',
				type: 'POST',
				data: {
					user_name: username,
					email: email,
					full_name: full_name,
					phone_number: phone,
					address: address,
					market_id: market_place,
					amazon_id: amazon,
					invitation_code: invitation,
					qq: qq,
					other_service: other_service
				},
				dataType: 'text',
				async: false,
				success:
					function (data) {
						response = data;
					}
			});

			var btn_txt='Edit Profile ';
			if (edit_button_str != "Save ")
				btn_txt = '编辑资料 ';

			if (response == "ok")
			{
				form_init(btn_txt, icon);

				popUpToast("success", "Successfully updated.");
			}
			else if (response == "fail") {
				popUpToast("warning", "Update is failed. Try again.");
			}
			else
			{
				form_init(btn_txt, icon);
			}

		}
	});

	form_init = function(btn_txt, icon){

		$("#edit_profile").text(btn_txt).append(icon);

		$('#full_name').attr('readonly', 'readonly');

		$('#email').attr('readonly', 'readonly');
		$('#phone_number').attr('readonly', 'readonly');
		$('#address').attr('readonly', 'readonly');
		$('#market_place').attr('readonly', 'readonly');
		$('#amazon_id').attr('readonly', 'readonly');
		$('#invitation_code').attr('readonly', 'readonly');
		$('#qq').attr('readonly', 'readonly');
		$('#other_service').attr('readonly', 'readonly');
		$('#img_chg_btn_group').attr('style', 'display: none;');
	}

	/*
	*
	* Change Password
	* */
	$('#pass_change_form').on('submit', function () {

		var username = $("#user_name").val();
		var old = $("#old_password").val();
		var new_pass = $("#password").val();
		var confirm_pass = $("#password2").val();

		if (old==new_pass)
		{
			return false;
		}
		if (new_pass!=confirm_pass)
			return false;

		var response;
		$.ajax({
			url: base_url + 'profile/password_update',
			type: 'POST',
			data: {
				user_name: username,
				old_password: old,
				password: new_pass
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {
					response = data;
				}
		});

		if (response == "ok")
		{
			popUpToast("success", "Successfully updated.");

			console.log('ok');
			$("#old_password").val('');
			$("#password").val('');
			$("#password2").val('');

			$('#m_modal_5').modal('hide');

		}
		else {
			popUpToast("warning", "Current password is wrong. Try again.");
		}

		return false;
	});

	/*
	*
	* Manage Membership
	* */
	var membership_id, amount, status;
	$('.membership_row').on('click', '.membership_upgrade', function () {
		membership_id = $(this).attr('id');
		amount = $(this).attr('amount');
		status = $.trim($(this).text());
		$('#payment_modal').modal('show');
	});

	$('#go_pay').on('click', function () {

		var radioValue = $("input[name='payment']:checked").val();
		var user_name = $("#top_user_avatar").attr('alt');

		var pay_id;
		if (radioValue=="Alipay")
		{
			pay_id = 2;
			// window.location.replace("https://login.aliexpress.com/?return_url=https://login.aliexpress.com/ipay_login.htm");
		}
		else
		{
			pay_id = 1;
			// window.location.replace("https://app.walkthechat.com/login");
		}

		// var response;
		$.ajax({
			url: base_url + 'billing/payment',
			type: 'POST',
			data: {
				user_name: user_name,
				member_id: membership_id,
				status: status,
				payment_id: pay_id
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {
					// response = data;
				}
		});

		$('#payment_modal').modal('hide');
		$("#pay_modal_form").attr('action', base_url + 'billing/membership');
		$("#pay_modal_form").submit();
	});

	//--- Common ---//
	function popUpToast(status, message){

		// Counter for dashboard stats
		// $('.counter').counterUp({
		//     delay: 10,
		//     time: 1000
		// });

		// Welcome notification
		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-top-right",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
		toastr[status]( message );

		// alert(status+":"+message);
	}

});
