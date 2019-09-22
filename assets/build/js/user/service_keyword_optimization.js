$(document).ready(function () {


	var table_key_optimization_history = $('#table_key_optimization_history').DataTable( {
		responsive: true,
		stateSave: true,
		"ajax": {
			"url": base_url+"user/services/SearchTermOptimization/getHistory",
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

					var view_url = base_url + 'services/keyword_optimization/resultView/'+data['id'];

					var str_div = '<div>';
					str_div += '<a href="'+view_url+'"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';

					if (data['status'] == 'complete')
						str_div += '<a href="javascript:;" d-id="'+data['id']+'" class="key_optimization_delete"><i class="fa fa-trash" style="color: red"></i></a>';

					str_div += '</div>';

					return str_div;
				}
			}
		],
		"order": [[0, 'asc']],
		dom: 'Brtip'
	} );

	$("#table_key_optimization_history tbody").on("click", ".key_optimization_delete", function () {

		table_key_optimization_history.ajax.reload();

		var task_id = $(this).attr('d-id');

		var tr = $(this).closest('tr');
		var data = table_key_optimization_history.row( tr ).data();
		var status = data['status'];
		if (status=='working')
		{
			popUpToast('warning', 'You can\'t delete this current working task.');

			return;
		}

		if (!confirm('Are you sure you want to delete this?'))
			return;

		$.ajax({
			url: base_url + 'user/services/SearchTermOptimization/deleteHistory',
			type: 'POST',
			data: {
				id: task_id
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {

					if (data == 'success')
						table_key_optimization_history.ajax.reload(null, false);
				}
		});
	});

	$("#key_optimization_form button").click(function (ev) {
		ev.preventDefault() // cancel form submission

		var market_id = $('#key_optimization_market_place').val();
		var product_asin = $('#key_optimization_product_asin').val();
		var txt_keywords = $('#key_optimization_textarea').val();

		if (market_id==='' || market_id==null || product_asin=='')
		{
			$("#key_optimization_form").submit();

			return false;
		}

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?`]/;

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

		var type = 1;
		if ($(this).attr("value") == "special")
		{
			type = 2;
		}
		else
		{
			$("#key_optimization_textarea").prop('required',true);

			if (txt_keywords=='')
			{
				$("#key_optimization_form").submit();

				return false;
			}
		}

		$("#key_optimization_textarea").prop('required',false);

		var dataArr = {
			market_id: market_id,
			asin: product_asin,
			keywords: arr_keywords,
			search_type: type
		};

		$.ajax({
			url: base_url + 'user/services/SearchTermOptimization/isExistAlready',
			method: 'POST',
			data: {dataArr},
			dataType: 'json',
			async: false,
			success: function (data) {

				if (data['status'] == 'NO')
				{
					startSearch(dataArr, table_key_optimization_history);
				}
				else {
					if (data['status'] == 'complete')
					{
						var view_url = base_url+'services/keyword_optimization/resultView/'+data['task_id'];

						var $toast = popUpToast('warning', '<div>You have searched before;<br/> would you like to perform a new search or view the results of your previous search?<br/>' +
							'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id="continue_search" style="color: blue; font-weight: bold">New Search</a>' +
							'&nbsp;&nbsp;&nbsp;&nbsp;<a href="'+view_url+'" style="color: blueviolet; font-weight: bold">View Previous Result</a></div>');

						if ($toast.find('#continue_search').length) {
							$toast.delegate('#continue_search', 'click', function () {
								startSearch(dataArr, table_key_optimization_history);
								$toast.remove();
							});
						}
					}
					else
					{
						var url = base_url + 'home/history';
						popUpToast('warning', '<div>You have a pending Search inquiry for the same product and criteria.<br/> Please wait.&nbsp;&nbsp;&nbsp;&nbsp;' +
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
			url: base_url + 'user/services/SearchTermOptimization/findKeyword',
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

	setInterval(function () {

		if (table_key_optimization_history !== 'null'){
			console.log('table_key_optimization_history');

			table_key_optimization_history.ajax.reload( null, false );
		}
	}, 60000);

	$('#key_optimization_textarea').keydown(function(e) {

		if(e.keyCode == 13 && $(this).val().split("\n").length >= 20) {
			return false;
		}
	});

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

});
