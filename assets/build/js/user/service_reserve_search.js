$(document).ready(function () {

	/*
	* Category***
	* */
	var key_id = $('#view_keyword_id').val();		//For client view

	if (isRealValue($("#reserve_match_type")))
		new Choices("#reserve_match_type", {removeItemButton: true});

	var table = false, destroyed = false;
	initializeTable();

	function initializeTable(search_min='', search_max='', pro_min='', pro_max='', score_min='', score_max='', organic_min='', organic_max='', amz_min='', amz_max='', sponsored_min='', sponsored_max='', ex_keys='', in_keys='', match_type='')
	{
		if (table)
		{
			table.clear().draw();
			table.destroy();
			destroyed = true;
		}

		table = $('#table_reverse_asin').DataTable( {
			responsive: true,
			"ajax": {
				"url": base_url+"user/services/ReverseAsinSearch/getDetailInfo",
				"type": "POST",
				"data": {
					keyword_id: key_id,
					search_min: search_min,
					search_max: search_max,
					pro_min: pro_min,
					pro_max: pro_max,
					score_min: score_min,
					score_max: score_max,
					organic_min: organic_min,
					organic_max: organic_max,
					amz_min: amz_min,
					amz_max: amz_max,
					sponsored_min: sponsored_min,
					sponsored_max: sponsored_max,
					ex_keys: ex_keys,
					in_keys: in_keys,
					match_type: match_type
				}
			},
			"columns": [
				{ "data": 'no' },
				{ "data": 'keyword' },
				{ "data": 'rank_url' },
				{ "data": 'iq_score' },
				{ "data": 'search_volume' },
				{ "data": 'sponsored_asin' },
				{ "data": 'competing_product' },
				{ "data": 'give_aways' },
				{ "data": 'amz_recommended' },
				{ "data": 'sponsored' },
				{ "data": 'organic' },
				{ "data": 'amz_recommended_rank' },
				{ "data": 'sponsored_rank' },
				{ "data": 'organic_rank' },
			],
			columnDefs: [
				{
					targets: 1,
					orderable: false,
					render: function (data) {
						return `
                            <div>
                                <p>`+data['phrase']+`&nbsp;&nbsp;<a href="`+data['view_url']+`" target="_blank"><i class="fa fa-external-link"></i></a></p>
                            </div>
                            `;
					}
				},
				{
					targets: 2,
					orderable: false,
					render: function (data) {
						return `
                            <div>
                                <a href="`+data+`" target="_blank"><i class="fa fa-link"></i></a>
                            </div>
                            `;
					}
				},
				{
					targets: 3,
					type: "num-fmt"
				},
				{
					targets: 4,
					type: "num-fmt"
				},
				{
					targets: 5,
					type: "num-fmt"
				},
				{
					targets: 6,
					type: "num-fmt"
				},
				{
					targets: 7,
					type: "num-fmt"
				},
				{
					targets: -6,
					orderable: false,
					render: function (data) {
						var str = '';
						if (data == '1')
							str = '<i class="fa fa-check-circle-o" style="font-size: 20px; color: #65a035"></i>';

						return `
                            <div>`+str+`</div>
                            `;
					}
				},
				{
					targets: -5,
					orderable: false,
					render: function (data) {
						var str = '';
						if (data == '1')
							str = '<i class="fa fa-check-circle-o" style="font-size: 20px; color: #65a035"></i>';

						return `
                            <div>`+str+`</div>
                            `;
					}
				},
				{
					targets: -4,
					orderable: false,
					render: function (data) {
						var str = '';
						if (data == '1')
							str = '<i class="fa fa-check-circle-o" style="font-size: 20px; color: #65a035"></i>';

						return `
                            <div>`+str+`</div>
                            `;
					}
				},
				{
					targets: -3,
					type: "num-fmt"
				},
				{
					targets: -2,
					type: "num-fmt"
				},
				{
					targets: -1,
					type: "num-fmt"
				},
			],
			"order": [[0, 'asc']],
			"initComplete": function( settings, json ) {
				console.log('Status::'+$('#cur_status').val());
				if ($('#cur_status').val() == "complete" && !destroyed)
					$('#table_reverse_asin .dataTables_empty').html('<p style="color:red;">There are no results for the criteria you have entered. Try removing some criteria to get better search results.<br/>PS: Your Credits for this search has been refunded</p>');
			}
		} );

	}

	var table_reverse_history = $('#table_reverse_history').DataTable( {
		responsive: true,
		stateSave: true,
		"ajax": {
			"url": base_url+"user/services/ReverseAsinSearch/getHistory",
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
				render: function (data) {

					var view_url = base_url + 'services/reserve_search/resultView/'+data['id'];

					var str_div = '<div>';
					str_div += '<a href="'+view_url+'"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';

					if (data['status'] == 'complete')
						str_div += '<a href="javascript:;" d-id="'+data['id']+'" class="reverse_delete"><i class="fa fa-trash" style="color: red"></i></a>';

					str_div += '</div>';

					return str_div;
				}
			}
		],
		"order": [[0, 'asc']],
		dom: 'Brtip'
	} );

	$("#table_reverse_history tbody").on("click", ".reverse_delete", function () {

		table_reverse_history.ajax.reload();

		var task_id = $(this).attr('d-id');

		var tr = $(this).closest('tr');
		var data = table_reverse_history.row( tr ).data();
		var status = data['status'];
		if (status=='working')
		{
			popUpToast('warning', 'You can\'t delete this current working task.');

			return;
		}

		if (!confirm('Are you sure you want to delete this?'))
			return;

		$.ajax({
			url: base_url + 'user/services/ReverseAsinSearch/deleteHistory',
			type: 'POST',
			data: {
				id: task_id
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {

					if (data == 'success')
						table_reverse_history.ajax.reload(null, false);
				}
		});
	});

	$('#reverse_search_form').on('submit', function () {

		var market_id = $('#reverse_search_market_place').val();
		var asin = $('#reverse_search_asin').val();

		if (market_id==='' || market_id==null || asin=='')
			return false;

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

		if (format.test(asin))
		{
			popUpToast('warning', 'Don\'t input special characters.');
			return;
		}

		if (asin.length!=10)
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		$.ajax({
			url: base_url + 'user/services/ReverseAsinSearch/isExistAlready',
			method: 'POST',
			data:{
				market_id: market_id,
				asin: asin
			},
			dataType: 'json',
			async: false,
			success: function (data) {

				if (data['status'] == 'NO')
				{
					startSearch(market_id, asin, table_reverse_history);
				}
				else {
					if (data['status'] == 'complete')
					{
						var view_url = base_url+'services/reserve_search/resultView/'+data['task_id'];

						var $toast = popUpToast('warning', '<div>You have searched before;<br/> would you like to perform a new search or view the results of your previous search?<br/>' +
							'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id="continue_search" style="color: blue; font-weight: bold">New Search</a>' +
							'&nbsp;&nbsp;&nbsp;&nbsp;<a href="'+view_url+'" style="color: blueviolet; font-weight: bold">View Previous Result</a></div>');

						if ($toast.find('#continue_search').length) {
							$toast.delegate('#continue_search', 'click', function () {
								startSearch(market_id, asin, table_reverse_history);
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

	function startSearch(market_id, asin, table_history)
	{
		$.ajax({
			url: base_url + 'user/services/ReverseAsinSearch/searchKeyword',
			method: 'POST',
			data:{
				market_id: market_id,
				asin: asin
			},
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

	var search_volume_min='', search_volume_max='', competing_product_min='', competing_product_max='', key_score_min='', key_score_max='',
		organic_min='', organic_max='', amz_min='', amz_max='', sponsored_min='', sponsored_max='', reverse_in_keywords='', reverse_ex_keywords='', reverse_type='';
	$('#reverse_filter_btn').on('click', function () {

		search_volume_min = $('#search_volume_min').val();
		search_volume_max = $('#search_volume_max').val();
		if (search_volume_min!='' && search_volume_max!='' && Number(search_volume_min) > Number(search_volume_max))
		{
			popUpToast('warning', 'Search Volume Min must be smaller than Search Volume Max.');
			return;
		}

		competing_product_min = $('#competing_product_min').val();
		competing_product_max = $('#competing_product_max').val();
		if (competing_product_min!='' && competing_product_max!='' && Number(competing_product_min) > Number(competing_product_max))
		{
			popUpToast('warning', 'Competing Products Min must be smaller than Competing Products Max.');
			return;
		}

		key_score_min = $('#key_score_min').val();
		key_score_max = $('#key_score_max').val();
		if (key_score_min!='' && key_score_max!='' && Number(key_score_min) > Number(key_score_max))
		{
			popUpToast('warning', 'Keyword SCORE Min must be smaller than Keyword SCORE Max.');
			return;
		}

		organic_min = $('#organic_min').val();
		organic_max = $('#organic_max').val();
		if (organic_min!='' && organic_max!='' && Number(organic_min) > Number(organic_max))
		{
			popUpToast('warning', 'Organic Rank Min must be smaller than Organic Rank Max.');
			return;
		}

		amz_min = $('#amz_min').val();
		amz_max = $('#amz_max').val();
		if (amz_min!='' && amz_max!='' && Number(amz_min) > Number(amz_max))
		{
			popUpToast('warning', 'Amazon Recommended Rank Min must be smaller than Amazon Recommended Rank Max.');
			return;
		}

		sponsored_min = $('#sponsored_min').val();
		sponsored_max = $('#sponsored_max').val();
		if (sponsored_min!='' && sponsored_max!='' && Number(sponsored_min) > Number(sponsored_max))
		{
			popUpToast('warning', 'Sponsored Rank Rank Min must be smaller than Sponsored Rank Rank Max.');
			return;
		}

		reverse_in_keywords = $('#reverse_in_keywords').val();
		reverse_ex_keywords = $('#reverse_ex_keywords').val();

		if ($('#reserve_match_type').val()!=null)
			reverse_type = $('#reserve_match_type').val().toString();

		initializeTable(search_volume_min, search_volume_max, competing_product_min, competing_product_max, key_score_min, key_score_max,
			organic_min, organic_max, amz_min, amz_max, sponsored_min, sponsored_max, reverse_ex_keywords, reverse_in_keywords, reverse_type);
	});

	$('#reverse_reset_btn').on('click', function () {
		search_volume_min=''; search_volume_max='';
		competing_product_min=''; competing_product_max='';
		key_score_min=''; key_score_max='';
		organic_min=''; organic_max='';
		amz_min=''; amz_max='';
		sponsored_min=''; sponsored_max='';
		reverse_in_keywords=''; reverse_ex_keywords=''; reverse_type='';
	});

	$('#reverse_file_export').on('click', function () {

		var url = base_url+"user/services/ReverseAsinSearch/downloadExportFile";
		url += "?keyword_id="+key_id;
		url += "&search_min="+search_volume_min;
		url += "&search_max="+search_volume_max;
		url += "&pro_min="+competing_product_min;
		url += "&pro_max="+competing_product_max;
		url += "&score_min="+key_score_min;
		url += "&score_max="+key_score_max;
		url += "&organic_min="+organic_min;
		url += "&organic_max="+organic_max;
		url += "&amz_min="+amz_min;
		url += "&amz_max="+amz_max;
		url += "&sponsored_min="+sponsored_min;
		url += "&sponsored_max="+sponsored_max;
		url += "&ex_keys="+reverse_ex_keywords;
		url += "&in_keys="+reverse_in_keywords;
		url += "&match_type="+reverse_type;

		window.location.replace(url);
	});

	setInterval(function () {

		if (table_reverse_history !== 'null'){
			console.log('table_reverse_history');

			table_reverse_history.ajax.reload( null, false );
		}
	}, 60000);

	function isRealValue(obj)
	{
		return obj && obj !== 'null' && obj !== 'undefined' && obj.length > 0;
	}

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
