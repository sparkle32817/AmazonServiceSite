$(document).ready(function () {

	/*
	* Category***
	* */
	var key_id = $('#view_keyword_id').val();		//For client view

	if (isRealValue($("#magnet_type")))
		new Choices("#magnet_type", {removeItemButton: true});

	var table = false, destroyed = false;
	initializeTable();

	function initializeTable(search_min='', search_max='', pro_min='', pro_max='', score_min='', score_max='', ex_keys='', in_keys='', match_type='')
	{
		if (table)
		{
			table.clear().draw();
			table.destroy();
			destroyed = true;
		}

		table = $('#table_magnet').DataTable( {
			responsive: true,
			"ajax": {
				"url": base_url+"user/services/MagnetRelatedKeywordSearch/getDetailInfo",
				"type": "POST",
				"data": {
					keyword_id: key_id,
					search_min: search_min,
					search_max: search_max,
					pro_min: pro_min,
					pro_max: pro_max,
					score_min: score_min,
					score_max: score_max,
					ex_keys: ex_keys,
					in_keys: in_keys,
					match_type: match_type
				}
			},
			"columns": [
				{ "data": 'no' },
				{ "data": 'keyword' },
				{ "data": 'iq_score' },
				{ "data": 'search_volume' },
				{ "data": 'sponsored_asin' },
				{ "data": 'headline_asin' },
				{ "data": 'competing_product' },
				{ "data": 'give_aways' },
				{ "data": 'amz_recommended' },
				{ "data": 'smart_complete' },
				{ "data": 'organic' },
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
					type: "num-fmt"
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
					targets: -3,
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
					targets: -2,
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
					targets: -1,
					orderable: false,
					render: function (data) {
						var str = '';
						if (data == '1')
							str = '<i class="fa fa-check-circle-o" style="font-size: 20px; color: #65a035"></i>';

						return `
                            <div>`+str+`</div>
                            `;
					}
				}
			],
			"order": [[0, 'asc']],
			"initComplete": function( settings, json ) {
				console.log('Status::'+$('#cur_status').val());
				if ($('#cur_status').val() == "complete" && !destroyed)
					$('#table_magnet .dataTables_empty').html('<p style="color:red;">There are no results for the criteria you have entered. Try removing some criteria to get better search results.<br/>PS: Your Credits for this search has been refunded</p>');
			}
		} );

	}

	var table_magnet_history = $('#table_magnet_history').DataTable( {
		responsive: true,
		stateSave: true,
		"ajax": {
			"url": base_url+"user/services/MagnetRelatedKeywordSearch/getHistory",
			"type": "POST"
		},
		"columns": [
			{ "data": 'no' },
			{ "data": 'market_place' },
			{ "data": 'keyword' },
			{ "data": 'date_searched' },
			{ "data": 'status' },
			{ "data": 'action' }
		],
		columnDefs: [
			{
				targets: -1,
				orderable: false,
				render: function (data) {

					var view_url = base_url + 'services/magnet_search/resultView/'+data['id'];

					var str_div = '<div>';
					str_div += '<a href="'+view_url+'"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';

					if (data['status'] == 'complete')
						str_div += '<a href="javascript:;" d-id="'+data['id']+'" class="magnet_delete"><i class="fa fa-trash" style="color: red"></i></a>';

					str_div += '</div>';

					return str_div;
				}
			}
		],
		"order": [[0, 'asc']],
		dom: 'Brtip'
	} );

	$("#table_magnet_history tbody").on("click", ".magnet_delete", function () {

		table_magnet_history.ajax.reload();

		var task_id = $(this).attr('d-id');

		var tr = $(this).closest('tr');
		var data = table_magnet_history.row( tr ).data();
		var status = data['status'];
		if (status=='working')
		{
			popUpToast('warning', 'You can\'t delete this current working task.');

			return;
		}

		if (!confirm('Are you sure you want to delete this?'))
			return;

		$.ajax({
			url: base_url + 'user/services/MagnetRelatedKeywordSearch/deleteHistory',
			type: 'POST',
			data: {
				id: task_id
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {

					if (data == 'success')
						table_magnet_history.ajax.reload(null, false);
				}
		});
	});

	$('#magnet_form').on('submit', function () {

		var market_id = $('#magnet_market_place').val();
		var magnet_keyword = $('#magnet_keyword').val();

		if (market_id==='' || market_id==null || magnet_keyword=='')
			return false;

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

		if (format.test(magnet_keyword))
		{
			popUpToast('warning', 'Don\'t input special characters.');
			return;
		}

		$.ajax({
			url: base_url + 'user/services/MagnetRelatedKeywordSearch/isExistAlready',
			method: 'POST',
			data:{
				market_id: market_id,
				keyword: magnet_keyword
			},
			dataType: 'json',
			async: false,
			success: function (data) {

				if (data['status'] == 'NO')
				{
					startSearch(market_id, magnet_keyword, table_magnet_history);
				}
				else {
					if (data['status'] == 'complete')
					{
						var view_url = base_url+'services/magnet_search/resultView/'+data['task_id'];

						var $toast = popUpToast('warning', '<div>You have searched before;<br/> would you like to perform a new search or view the results of your previous search?<br/>' +
							'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id="continue_search" style="color: blue; font-weight: bold">New Search</a>' +
							'&nbsp;&nbsp;&nbsp;&nbsp;<a href="'+view_url+'" style="color: blueviolet; font-weight: bold">View Previous Result</a></div>');

						if ($toast.find('#continue_search').length) {
							$toast.delegate('#continue_search', 'click', function () {
								startSearch(market_id, magnet_keyword, table_magnet_history);
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

	function startSearch(market_id, magnet_keyword, table_history)
	{
		$.ajax({
			url: base_url + 'user/services/MagnetRelatedKeywordSearch/searchKeyword',
			method: 'POST',
			data:{
				market_id: market_id,
				keyword: magnet_keyword
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

	var search_volume_min='', search_volume_max='', competing_product_min='', competing_product_max='', key_score_min='', key_score_max='', magnet_in_keywords='', magnet_ex_keywords='',magnet_type='';
	$('#filter_btn').on('click', function () {

		search_volume_min = $('#search_volume_min').val();
		search_volume_max = $('#search_volume_max').val();
		if (search_volume_max!='' && search_volume_min!='' && Number(search_volume_min)> Number(search_volume_max))
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
		if (key_score_min!='' && key_score_max!='' && Number(key_score_min)> Number(key_score_max))
		{
			popUpToast('warning', 'Keyword SCORE Min must be smaller than Keyword SCORE Max.');
			return;
		}

		magnet_in_keywords = $('#magnet_in_keywords').val();
		magnet_ex_keywords = $('#magnet_ex_keywords').val();

		if ($('#magnet_type').val()!=null)
			magnet_type = $('#magnet_type').val().toString();

		initializeTable(search_volume_min, search_volume_max, competing_product_min, competing_product_max, key_score_min, key_score_max,
			magnet_ex_keywords, magnet_in_keywords, magnet_type);
	});

	$('#magnet_reset_btn').on('click', function () {
		search_volume_min=''; search_volume_max='';
		competing_product_min=''; competing_product_max='';
		key_score_min=''; key_score_max='';
		magnet_in_keywords=''; magnet_ex_keywords=''; magnet_type='';
	});

	$('#magnet_file_export').on('click', function () {

		var url = base_url+"user/services/MagnetRelatedKeywordSearch/downloadExportFile";
		url += "?keyword_id="+key_id;
		url += "&search_min="+search_volume_min;
		url += "&search_max="+search_volume_max;
		url += "&pro_min="+competing_product_min;
		url += "&pro_max="+competing_product_max;
		url += "&score_min="+key_score_min;
		url += "&score_max="+key_score_max;
		url += "&ex_keys="+magnet_ex_keywords;
		url += "&in_keys="+magnet_in_keywords;
		url += "&match_type="+magnet_type;

		window.location.replace(url);

	});

	setInterval(function () {

		if (table_magnet_history !== 'null'){
			console.log('table_magnet_history');

			table_magnet_history.ajax.reload( null, false );
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
		return toastr[status]( message );

		// alert(status+":"+message);
	}

});
