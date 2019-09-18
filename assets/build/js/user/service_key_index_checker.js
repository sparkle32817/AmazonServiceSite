$(document).ready(function () {

	var view_asin_id = $('#view_asin_id').val();		//For client view
	var cur_status = $('#cur_status').val();

	$('#table_key_checker').DataTable( {
		responsive: true,
		processing: true,
		"ajax": {
			"url": base_url+"user/services/ProductKeywordIndexChecker/getKeywordDetailInfo",
			"type": "POST",
			"data": {
				asin_id: view_asin_id,
				status: cur_status
			}
		},
		"columns": [
			{ "data": 'num' },
			{ "data": 'keyword' },
			{ "data": 'index1' },
			{ "data": 'index2' },
			{ "data": 'index3' },
			{ "data": 'cumulative' },
		],
		columnDefs: [
			{
				targets: 2,
				orderable: false,
				render: function (data, type, full, meta) {

					var str = '<i class="fa fa-times-circle" style="font-size: 20px; color: red"></i>';
					if (data == 'indexed')
					{
						str = '<i class="fa fa-check-circle" style="font-size: 20px; color: #65a035"></i>';
					}

					return `<div>`+str+`</div>`;
				}
			},
			{
				targets: 3,
				orderable: false,
				render: function (data, type, full, meta) {

					var str = '<i class="fa fa-times-circle" style="font-size: 20px; color: red"></i>';
					if (data == 'indexed')
					{
						str = '<i class="fa fa-check-circle" style="font-size: 20px; color: #65a035"></i>';
					}

					return `<div>`+str+`</div>`;
				}
			},
			{
				targets: 4,
				orderable: false,
				render: function (data, type, full, meta) {

					var str = '<i class="fa fa-times-circle" style="font-size: 20px; color: red"></i>';
					if (data == 'indexed')
					{
						str = '<i class="fa fa-check-circle" style="font-size: 20px; color: green"></i>';
					}
					else if (data == 'not checked')
					{
						str = '<i class="fa fa-minus-circle" style="font-size: 20px; color: blue"></i>';
					}

					return `<div>`+str+`</div>`;
				}
			},
			{
				targets: 5,
				orderable: false,
				render: function (data, type, full, meta) {

					var str = '<i class="fa fa-times-circle" style="font-size: 20px; color: red"></i>';
					if (data == 'indexed')
					{
						str = '<i class="fa fa-check-circle" style="font-size: 20px; color: #65a035"></i>';
					}

					return `<div>`+str+`</div>`;
				}
			}
		],
		"order": [[0, 'asc']],
		"initComplete": function( settings, json ) {
			if ($('#cur_status').val() == "complete")
				$('#table_key_checker .dataTables_empty').html('<p style="color:red;">There are no results for the criteria you have entered. Try removing some criteria to get better search results.<br/>PS: Your Credits for this search has been refunded</p>');
		}
	} );

	var table_key_checker_history = $('#table_key_checker_history').DataTable( {
		responsive: true,
		stateSave: true,
		"ajax": {
			"url": base_url+"user/services/ProductKeywordIndexChecker/getHistory",
			"type": "POST"
		},
		"columns": [
			{ "data": 'no' },
			{ "data": 'market_place' },
			{ "data": 'asin' },
			{ "data": 'date_searched' },
			{ "data": 'status' },
			{ "data": 'action' }
		],
		columnDefs: [
			{
				targets: -1,
				orderable: false,
				render: function (data, type, full, meta) {

					var view_url = base_url + 'services/keyword_index_checker/resultView/'+data['id'];

					var str_div = '<div>';
					str_div += '<a href="'+view_url+'"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';

					if (data['status'] == 'complete')
						str_div += '<a href="javascript:;" d-id="'+data['id']+'" class="key_checker_delete"><i class="fa fa-trash" style="color: red"></i></a>';

					str_div += '</div>';

					return str_div;
				}
			}
		],
		"order": [[0, 'asc']],
		dom: 'Brtip'
	} );

	$("#table_key_checker_history tbody").on("click", ".key_checker_delete", function () {

		table_key_checker_history.ajax.reload();

		var task_id = $(this).attr('d-id');

		var tr = $(this).closest('tr');
		var data = table_key_checker_history.row( tr ).data();
		var status = data['status'];
		if (status=='working')
		{
			popUpToast('warning', 'You can\'t delete this current working task.');

			return;
		}

		if (!confirm('Are you sure you want to delete this?'))
			return;

		$.ajax({
			url: base_url + 'user/services/ProductKeywordIndexChecker/deleteHistory',
			type: 'POST',
			data: {
				id: task_id
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {

					if (data == 'success')
						table_key_checker_history.ajax.reload(null, false);
				}
		});
	});

	$('#key_checker_form').on('submit', function () {

		var market_id = $('#key_checker_market_place').val();
		var product_asin = $('#key_checker_product_asin').val();
		var seller = $('#key_checker_seller_id').val();
		var txt_keywords = $('#key_checker_textarea').val();

		if (market_id==='' || market_id==null || product_asin=='' || txt_keywords=='')
			return false;

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

		if (format.test(txt_keywords) || format.test(product_asin))
		{
			popUpToast('warning', 'Don\'t input special characters.');
			return;
		}

		if (product_asin.length!=10)
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		var arr_keywords = txt_keywords.split('\n');

		var dataArr = {
			market_id: market_id,
			asin: product_asin,
			seller_id: seller,
			keywords: arr_keywords
		};

		$.ajax({
			url: base_url + 'user/services/ProductKeywordIndexChecker/isExistAlready',
			method: 'POST',
			data:{dataArr},
			dataType: 'json',
			async: false,
			success: function (data) {

				if (data['status'] == 'NO')
				{
					startSearch(dataArr, table_key_checker_history);
				}
				else {
					if (data['status'] == 'complete')
					{
						var view_url = base_url+'services/keyword_index_checker/resultView/'+data['task_id'];

						var $toast = popUpToast1('warning', '<div>You have searched before;<br/> would you like to perform a new search or view the results of your previous search?<br/>' +
							'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id="continue_search" style="color: blue; font-weight: bold">New Search</a>' +
							'&nbsp;&nbsp;&nbsp;&nbsp;<a href="'+view_url+'" style="color: blueviolet; font-weight: bold">View Previous Result</a></div>');

						if ($toast.find('#continue_search').length) {
							$toast.delegate('#continue_search', 'click', function () {
								startSearch(dataArr, table_key_checker_history);
								$toast.remove();
							});
						}
					}
					else
					{
						var url = base_url + 'home/history';
						popUpToast1('warning', '<div>You have a pending Search inquiry for the same product and criteria.<br/> Please wait.&nbsp;&nbsp;&nbsp;&nbsp;' +
							'<a href="'+url+'" class="" style="color: blueviolet; font-weight: bold">View</a></div>');
					}
				}
			}
		});

		return false;
	});

	function startSearch(dataArr, table_history)
	{
		$.ajax({
			url: base_url + 'user/services/ProductKeywordIndexChecker/checkKeyword',
			method: 'POST',
			data:{dataArr},
			type: 'text',
			async: false,
			success: function (data) {

				if (data == 'success')
				{
					table_history.ajax.reload();

					popUpToast('success', 'Start Checking Keyword!');

					window.setTimeout(redirectToHistory, 500);

				}
			}
		});
	}

	$("#key_checker_textarea").keyup(function (event) {

		var remain = parseInt(5000 - $(this).val().length);

		$('#remain_txt').text(remain);
	});

	setInterval(function () {

		if (table_key_checker_history !== 'null'){
			console.log('table_key_checker_history');

			table_key_checker_history.ajax.reload( null, false );
		}
	}, 60000);

	function  redirectToHistory()
	{
		window.location.href=base_url+'home/history';
	}

	//--- Common ---//
	function popUpToast(status, message){

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
		return toastr[status]( message );
	}

	function popUpToast1(status, message){

		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-top-center",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "0",
			"extendedTimeOut": "0",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
		return toastr[status]( message );
	}

});
