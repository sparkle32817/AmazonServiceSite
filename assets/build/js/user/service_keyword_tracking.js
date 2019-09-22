
var asinHistoryChart = null;

function drawHistoryChart(asin_id, startDate, endDate) {

	if (asinHistoryChart!=null)
		asinHistoryChart.destroy();

	var response='';
	$.ajax({
		url: base_url+'user/services/keywordRankTracking/getHistoryChartData',
		type: 'post',
		data: {asin_id: asin_id, start: startDate, end: endDate},
		dataType: 'json',
		async: false,
		success:
			function (data) {
				response = data;
			}
	});

	var data = [];
	var dataset = [];
	var labels = [];
	$.each(response.labels, function (i, val) {
		labels.push(val);
	});
	data['labels'] = labels;

	$.each(response.datasets, function (i, val) {

		var product = [];
		var datas = [];
		$.each(val.data, function (j, data) {
			datas.push(data);
		});
		product['data'] = datas;
		product['label'] = val.label;
		product['borderColor'] = val.borderColor;
		product['fill'] = val.fill;

		dataset.push(product) ;
	});
	data['datasets'] = dataset;

	var chatSetting = {
		responsive: true,
		scales: {
			xAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Date'
				}
			}],
			yAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Keywords #'
				}
			}]
		}
	};

	var ChatConfig = [];
	ChatConfig['type'] = "line";
	ChatConfig['data'] = data;
	ChatConfig['options'] = chatSetting;

	console.log(ChatConfig);
	asinHistoryChart = new Chart($('#chart_view_rank'), ChatConfig);
};

$(document).ready(function() {
	var sub_table;
	var asin_id, keyword, key_asin_id;
	var keywordHistoryChart = null;

	function format ( d )  {
		// `d` is the original data object for the row
		sub_table = $('<table class="table table-striped table-bordered dt-responsive nowrap sub_table_keyword" cellspacing="0" width="100%">\n' +
			'   <thead style="background-color: #25bf85; color: #d6d6d6;">\n' +
			'        <th width="3%">#</th>\n' +
			'        <th width="10%">'+$("#txt_tracking_keyword").val()+'</th>\n' +
			'        <th width="15%">'+$("#txt_tracking_exact_search").val()+'</th>\n' +
			'        <th width="15%">'+$("#txt_tracking_broad_search").val()+'</th>\n' +
			'        <th width="15%">'+$("#txt_tracking_competing_products").val()+'</th>\n' +
			'        <th width="20%">'+$("#txt_tracking_trend").val()+'</th>\n' +
			'        <th width="10%">'+$("#txt_tracking_organic_rank").val()+'</th>\n' +
			'        <th>'+$("#txt_tracking_actions").val()+'</th>\n' +
			'   </thead>\n' +
			'</table>');

		var div_element = $('<div class="col-md-12 col-sm-12 col-xs-12"></div>');
		div_element.append(sub_table);

		sub_table.DataTable({
			dom: 'Bfrtp',
			responsive: true,
			"ajax": {
				"url": base_url+"services/key_track_result_detail",
				"type": "POST",
				"data": {asin_id: d.id}
			},
			"columns": [
				{ "data": 'num' },
				{ "data": 'keyword' },
				{ "data": 'exact' },
				{ "data": 'broad' },
				{ "data": 'competing' },
				{
					"data": 'trend'
				},
				{ "data": 'rank' },
				{ "data": 'key_id' }
			],
			columnDefs: [
				{
					targets: -3,
					orderable: false,
					render: function(data) {
						return `
								<canvas height="50" class="chart-trend" chart-data='`+JSON.stringify(data)+`' width="283"></canvas>
                            `;
					},
				},
				{
					targets: -2,
					render: function(data) {

						if (data == '0')
						{
							data = '-';
						}

						return data;
					},
				},
				{
					targets: -1,
					orderable: false,
					render: function(data) {
						return `
								<a href="javascript:;"><i class="fa fa-line-chart view_rank_graph" id="`+data['id']+`" style="color: #1ABB9C" title="`+$('#txt_tracking_view_graph').val()+`"></i> </a>&nbsp;
								<a href="javascript:;"><i class="fa fa-trash delete_keyword" id="`+data['id']+`" style="color: #ff7474" title="`+$('#txt_tracking_delete_keyword').val()+`"></i> </a>&nbsp;
								<a href="http://www.`+d.product['market_url']+`/s?k=`+data['keyword']+`" target="_blank"><i class="fa fa-mail-forward" style="color: #252525" title="`+$('#txt_tracking_open_link').val()+`"></i> </a>
                            `;
					},
				},
			],
			"order": [[0, 'asc']],
			"fnInitComplete": function (oSettings, json) {

				$(".chart-trend").each( function () {
					var str_json = $(this).attr('chart-data');
					var response = JSON.parse(str_json);

					var data = [];
					var dataset = [];
					var labels = [];
					$.each(response.labels, function (i, val) {
						labels.push(val);
					});
					data['labels'] = labels;

					$.each(response.datasets, function (i, val) {

						var product = [];
						var datas = [];
						$.each(val.data, function (j, data) {
							datas.push(data);
						});
						product['data'] = datas;
						product['label'] = val.label;
						product['borderColor'] = val.borderColor;
						product['fill'] = val.fill;
						product['lineTension'] = 0;

						dataset.push(product) ;
					});
					data['datasets'] = dataset;

					var setting = {
						tooltips: {enabled: false},
						hover: {mode: null},
						legends: {
							display: false
						},
						scales: {
							xAxes: [{
								display: false,
								scaleLabel: {
									display: true,
									labelString: 'Month'
								}
							}],
							yAxes: [{
								display: false,
								scaleLabel: {
									display: true,
									labelString: 'Value'
								}
							}]
						},
						elements: {
							point:{
								hitRadius: 5,
								hoverRadius: 5,
							}
						}
					};

					var config = [];
					config['type'] = "line";
					config['data'] = data;
					config['options'] = setting;
					new Chart($(this), config);
				});
			}
		});

		return div_element;
	}

	var table_keyword_tracking = $('#table_keyword_tracking').DataTable( {
		responsive: true,
		processing: true,
		"ajax": {
			"url": base_url+"services/key_track_result",
			"type": "POST"
		},
		"columns": [
			{
				"className":      'details-control',
				"orderable":      false,
				"data":           null,
				"defaultContent": ''
			},
			{ "data": 'product' },
			{ "data": 'overview' },
			{ "data": 'product' }
		],
		columnDefs: [
			{
				targets: 1,
				render: function(data) {
					return `
                            <div style="text-align: left;">
                                <span class="flag-icon flag-icon-`+data['flag']+`"></span>
                                <a href="http://www.`+data['market_url']+`/dp/`+data['asin']+`" class="row_asin_number"  target="_blank" style="text-decoration: underline;">`+data['asin']+`</a>
                                <br/>
                                <p>`+$('#txt_tracking_tracked_keywords').val()+` : <span class="badge" style="background: #337ab7;">`+data['tracked_count']+`</span></p>
                            </div>
                            `;
				},
			},
			{
				targets: 2,
				orderable: false,
				render: function(data) {

					return `
                            <div style="padding: 0px;margin: 0px;">
                                <table width="100%">
                                    <tr>
                                        <td>`+$('#txt_tracking_keywords').val()+`</td>
                                        <td>`+$('#txt_tracking_exact_search').val()+`</td>
                                        <td>`+$('#txt_tracking_broad_search').val()+`</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            `+data['key_10']+`&nbsp;&nbsp;
                                            <span class="badge bg-`+data['key_10_sub_color']+`" style="font-size: 11px">`+data['key_10_sub']+`</span>
                                            <br/>
                                            <small>Top10</small>
                                        </td>
                                        <td>
                                            `+data['exact_10']+`
                                            <br/>
                                            <small>Top10</small>
                                        </td>
                                        <td>
                                            `+data['broad_10']+`
                                            <br/>
                                            <small>Top10</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            `+data['key_50']+`&nbsp;&nbsp;
                                            <span class="badge bg-`+data['key_50_sub_color']+`" style="font-size: 11px">`+data['key_50_sub']+`</span>
                                            <br/>
                                            <small>Top50</small>
                                        </td>
                                        <td>
                                            `+data['exact_50']+`
                                            <br/>
                                            <small>Top50</small>
                                        </td>
                                        <td>
                                            `+data['broad_50']+`
                                            <br/>
                                            <small>Top50</small>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            `;
				},
			},
			{
				targets: -1,
				orderable: false,
				render: function(data) {
					return `
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-round btn-default dropdown-toggle" type="button" ><strong>&#183;&#183;&#183;</strong>
                                </button>
                                <ul role="menu" class="dropdown-menu" style="right: 0px;left: auto; padding: 5px 0">
                                      <li class="add_keywords" a-id="`+data['id']+`"><a href="javascript:;"><i class="fa fa-plus " style="color: #26b85c"></i>&nbsp;&nbsp;`+$('#txt_tracking_add_keywords').val()+`</a></li>
                                      <li class="divider"></li>
                                      <li class="copy_keywords" a-id="`+data['id']+`"><a href="javascript:;"><i class="fa fa-copy " style="color: #2928ab"></i>&nbsp;&nbsp;`+$('#txt_tracking_copy_all').val()+`</a></li>
                                      <li><a href="http://www.`+data['market_url']+`/dp/`+data['asin']+`" target="_blank"><i class="fa fa-external-link" style="color: #0f0707"></i>&nbsp;&nbsp;`+$('#txt_tracking_go_to').val()+`</a></li>
                                      <li class="edit_keywords" a-id="`+data['id']+`"><a href="javascript:;"><i class="fa fa-edit " style="color: #2928ab"></i>&nbsp;&nbsp;`+$('#txt_tracking_edit_keywords').val()+`</a></li>
                                      <li class="delete_product" a-id="`+data['id']+`"><a href="javascript:;"><i class="fa fa-trash " style="color: #ff7474"></i>&nbsp;&nbsp;`+$('#txt_tracking_delete_history').val()+`</a></li>
                                      <li class="divider"></li>
                                      <li class="view_keyword_history" a-id="`+data['id']+`"><a href="javascript:;"><i class="fa fa-line-chart " style="color: #0f0707"></i>&nbsp;&nbsp;`+$('#txt_tracking_keyword_history').val()+`</a></li>
                                </ul>
                            </div>`;
				},
			},
		],
		"order": [[1, 'asc']]
	} );

	$(function () {
		time_delay();
	});

	time_delay = function()
	{
		setTimeout(function(){ load_event(); }, 1000);
	}

	load_event = function()
	{
		$('#table_keyword_tracking .add_keywords').on('click', function () {
			var asin_id = $(this).attr('a-id');

			var data = getAsinInfo(asin_id);
			$('#id_add_keywords').val(data['id']);
			$('#flag_add_keywords').removeClass();
			$('#flag_add_keywords').addClass('flag-icon flag-icon-'+data['flag']);
			$('#asin_num_add_keywords').text(data['asin_num']);
			$('#area_add_keywords').text('');
			$('#area_add_keywords').val('');
			$('#area_add_keywords').attr('style', 'height: 150px;');

			$('#modal_add_keywords').modal('show');
		});

		$('#table_keyword_tracking .edit_keywords').on('click', function () {
			var asin_id = $(this).attr('a-id');

			var data = getAsinInfo(asin_id);
			$('#id_edit_keywords').val(data['id']);
			$('#flag_edit_keywords').removeClass();
			$('#flag_edit_keywords').addClass('flag-icon flag-icon-'+data['flag']);
			$('#asin_num_edit_keywords').text(data['asin_num']);
			$('#tracked_count_edit_keywords').text(data['cnt']);

			$('#area_edit_keywords').text('');
			$('#area_edit_keywords').val('');
			var str_edit = '';
			$.each(data['keywords'], function (i, val) {
				$('#area_edit_keywords').append(val['keyword']+'\n');
				str_edit += val['keyword']+'\n';
			});
			$('#area_edit_keywords').val(str_edit);

			$('#area_edit_keywords').attr('style', 'height: 150px;');

			$('#modal_edit_keywords').modal('show');
		});

		$('#table_keyword_tracking .delete_product').on('click', function () {
			var asin_id = $(this).attr('a-id');

			if(confirm('Are you sure you want to delete?'))
			{
				$.ajax({
					url: base_url+'user/services/keywordRankTracking/deleteAsinInfo',
					type: 'post',
					data: {asin_id:asin_id},
					dataType: 'text',
					async: false,
					success:
						function (data) {
							table_keyword_tracking.ajax.reload( null, false );
							time_delay();
						}
				});
			}
		});

		$('#table_keyword_tracking .copy_keywords').on('click', function () {
			var asin_id = $(this).attr('a-id');

			var data = getAsinInfo(asin_id);
			$('#area_edit_keywords').text('');
			$.each(data['keywords'], function (i, val) {
				$('#area_edit_keywords').append(val['keyword']+'\n');
			});

			copyToClipboard($('#area_edit_keywords'));
		});

		$('#table_keyword_tracking .view_keyword_history').on('click', function () {
			asin_id = $(this).attr('a-id');

			var data = getAsinInfo(asin_id);
			$('#flag_view_graph').removeClass();
			$('#flag_view_graph').addClass('flag-icon flag-icon-'+data['flag']);
			$('#asin_num_view_graph').text(data['asin_num']);
			$('#tracked_count_view_graph').text(data['cnt']);

			var startDate = moment().subtract(6, 'days').format('YYYY-MM-DD');
			var endDate = moment().format('YYYY-MM-DD');

			drawHistoryChart(asin_id, startDate, endDate);
			$('#modal_view_rank').modal('show');
		});
	}

	// Add event listener for opening and closing details
	$('#table_keyword_tracking tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = table_keyword_tracking.row( tr );
		if ( row.child.isShown() ) {
			// This row is already open - close it
			row.child.hide();
			tr.removeClass('shown');
		}
		else {
			// Open this row
			if(row.child() && row.child().length)
			{
				row.child.show();
			}
			else {
				row.child( format(row.data()) ).show();

				$('.table_child_keyword').DataTable();

				$('.sub_table_keyword').off('click');

				$('.sub_table_keyword').on('click', '.view_rank_graph', function () {
					keyword_id = $(this).attr('id');

					var response = '';
					$.ajax({
						url: base_url+'user/services/keywordRankTracking/getKeywordInfo',
						type: 'post',
						data: {id:keyword_id},
						dataType: 'json',
						async: false,
						success:
							function (data) {
								response = data;
							}
					});

					key_asin_id = response['asin_id'];
					keyword = response['keyword'];
					$('#flag_keyword_graph').removeClass();
					$('#flag_keyword_graph').addClass('flag-icon flag-icon-'+response['flag']);
					$('#asin_num_keyword_graph').text(response['asin_num']);
					$('#keyword_name').text(keyword);

					var startDate = moment().subtract(6, 'days').format('YYYY-MM-DD');
					var endDate = moment().format('YYYY-MM-DD');

					drawKeyHistoryChart(keyword, key_asin_id, startDate, endDate);
					$('#modal_view_keyword').modal('show');
				});
				$('.sub_table_keyword').on('click', '.delete_keyword', function () {

					if (!confirm('Are you sure you want to delete?'))
						return;
					var keyword_id = $(this).attr('id');

					$.ajax({
						url:  base_url + 'user/services/keywordRankTracking/delete_keyword',
						method: 'POST',
						data: {id: keyword_id},
						dataType: 'text',
						async: false,
						success: function(data){
							if (data=='success')
							{
								table_keyword_tracking.ajax.reload( null, false );
								time_delay();
							}
						}
					});
				});
			}
			tr.addClass('shown');
		}
	} );

	$('#btn_add_product').on('click', function () {
		$('#modal_new_product').modal('show');
		$("#txt_keywords").attr('style', 'height: 150px;');
	});

	$('#form_new_product').on('submit', function () {

		var txt_asin = $("#txt_asin").val().replace(/\s/g, '');
		var txt_keywords = $("#txt_keywords").val();
		var market_place = $("#market_place").val();

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

		if (format.test(txt_keywords) || format.test(txt_asin))
		{
			popUpToast('warning', 'Don\'t input special characters.');
			return;
		}

		if (txt_asin=='' || txt_keywords=='' || market_place=='')
			return;

		if (txt_asin.length!=10)
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		var arr_keywords = txt_keywords.split('\n');

		var response;
		$.ajax({
			url: base_url + 'services/key_track_new',
			type: 'POST',
			data: {
				asin: txt_asin,
				keywords: arr_keywords,
				market_id: market_place
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {
					response = data;
					console.log(response);
				}
		});

		if (response == "success")
		{
			popUpToast("success", "Successfully created.");

			$("#txt_asin").val('');
			$("#txt_keywords").val('');
			$("#market_place").val('');

			$('#modal_new_product').modal('hide');

			window.location.reload();

			// table_keyword_tracking.ajax.reload( null, false );
			// time_delay();
		}
		else if(response == 'already')
		{
			popUpToast("warning", "This product is already existed.\nYou can add keywords to this product in below table.");
		}
		else
		{
			popUpToast("warning", "Failed. Try again.");
		}

		return false;
	});

	$('#form_add_keywords').on('submit', function () {

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

		var asin_id = $("#id_add_keywords").val();
		var txt_keywords = $("#area_add_keywords").val();

		if (format.test(txt_keywords))
		{
			popUpToast('warning', 'Don\'t input special characters.');
			return;
		}

		if (txt_keywords=='')
			return;

		var arr_keywords = txt_keywords.split('\n');

		var response;
		$.ajax({
			url: base_url + 'user/services/KeywordRankTracking/addKeywords',
			type: 'POST',
			data: {
				asin_id: asin_id,
				keywords: arr_keywords,
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {
					response = data;
					console.log(response);
				}
		});

		if (response == "success")
		{
			popUpToast("success", "Successfully added.");

			$("#txt_asin").val('');
			$("#txt_keywords").val('');
			$("#market_place").val('');

			$('#modal_add_keywords').modal('hide');

			table_keyword_tracking.ajax.reload( null, false );
			time_delay();
		}
		else if(response == 'already')
		{
			popUpToast("warning", "These keywords are already existed.\nYou should add other keywords.");
		}
		else
		{
			popUpToast("warning", "Failed. Try again.");
		}

		return false;
	});

	$('#form_edit_keywords').on('submit', function () {

		var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

		var asin_id = $("#id_edit_keywords").val();
		var txt_keywords = $("#area_edit_keywords").val();

		console.log(txt_keywords);
		if (format.test(txt_keywords))
		{
			popUpToast('warning', 'Don\'t input special characters.');
			return;
		}

		if (txt_keywords=='')
			return;

		var arr_keywords = txt_keywords.split('\n');

		var response;
		$.ajax({
			url: base_url + 'user/services/KeywordRankTracking/editKeywords',
			type: 'POST',
			data: {
				asin_id: asin_id,
				keywords: arr_keywords,
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {
					response = data;
					console.log(response);
				}
		});

		if (response == "success")
		{
			popUpToast("success", "Successfully changed.");

			$("#txt_asin").val('');
			$("#txt_keywords").val('');
			$("#market_place").val('');

			$('#modal_edit_keywords').modal('hide');

			table_keyword_tracking.ajax.reload( null, false );
			time_delay();
		}
		else
		{
			$('#modal_edit_keywords').modal('hide');
		}

		return false;
	});

	getAsinInfo = function (asin_id) {

		var response = '';
		$.ajax({
			url: base_url+'user/services/keywordRankTracking/getAsinInfo',
			type: 'post',
			data: {asin_id:asin_id},
			dataType: 'json',
			async: false,
			success:
				function (data) {
					response = data;
				}
		});

		return response;
	}

	copyToClipboard = function(element) {
		var $temp = $("<textarea>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		$temp.remove();
	}

	var daterange_view_graph = $('#daterange_view_graph');
	if (isRealValue(daterange_view_graph))
	{
		daterange_view_graph.val(moment(moment().subtract(6, 'days').toDate()).format('YYYY-MM-DD')+' ~ '+moment(moment().toDate()).format('YYYY-MM-DD'));

		daterange_view_graph.dateRangePicker({
				shortcuts : null,
				startOfWeek: 'sunday',
				language:'en',
				customArrowPrevSymbol: '<i class="fa fa-arrow-circle-left"></i>',
				customArrowNextSymbol: '<i class="fa fa-arrow-circle-right"></i>',
				separator : ' ~ ',
				autoClose: true,
				showShortcuts: true,
				customShortcuts:
					[
						{
							name: 'Week to date',
							dates : function()
							{
								var start = moment().subtract(6, 'days').toDate();
								var end = moment().toDate();
								return [start,end];
							}
						},
						{
							name: '30days',
							dates : function()
							{
								var start = moment().subtract(29, 'days').toDate();
								var end = moment().toDate();
								return [start,end];
							}
						},
						{
							name: '90days',
							dates : function()
							{
								var start = moment().subtract(89, 'days').toDate();
								var end = moment().toDate();
								return [start,end];
							}
						},
						{
							name: 'Year to date',
							dates : function()
							{
								var start = moment().subtract(364, 'days').toDate();
								var end = moment().toDate();
								return [start,end];
							}
						}
					]
			}
		);

		daterange_view_graph.on('datepicker-change',function(event,obj) {

			var startDate = moment(obj.date1).format('YYYY-MM-DD');
			var endDate = moment(obj.date2).format('YYYY-MM-DD');

			drawHistoryChart(asin_id, startDate, endDate);
		});

	}


	var daterange_view_keyword_graph = $('#daterange_view_keyword_graph');
	if (isRealValue(daterange_view_keyword_graph))
	{
		daterange_view_keyword_graph.val(moment(moment().subtract(6, 'days').toDate()).format('YYYY-MM-DD')+' ~ '+moment(moment().toDate()).format('YYYY-MM-DD'));

		daterange_view_keyword_graph.dateRangePicker({
				shortcuts : null,
				startOfWeek: 'sunday',
				language:'en',
				customArrowPrevSymbol: '<i class="fa fa-arrow-circle-left"></i>',
				customArrowNextSymbol: '<i class="fa fa-arrow-circle-right"></i>',
				separator : ' ~ ',
				autoClose: true,
				showShortcuts: true,
				customShortcuts:
					[
						{
							name: 'Week to date',
							dates : function()
							{
								var start = moment().subtract(6, 'days').toDate();
								var end = moment().toDate();
								return [start,end];
							}
						},
						{
							name: '30days',
							dates : function()
							{
								var start = moment().subtract(29, 'days').toDate();
								var end = moment().toDate();
								return [start,end];
							}
						},
						{
							name: '90days',
							dates : function()
							{
								var start = moment().subtract(89, 'days').toDate();
								var end = moment().toDate();
								return [start,end];
							}
						},
						{
							name: 'Year to date',
							dates : function()
							{
								var start = moment().subtract(364, 'days').toDate();
								var end = moment().toDate();
								return [start,end];
							}
						}
					]
			}
		);

		daterange_view_keyword_graph.on('datepicker-change',function(event,obj) {

			var startDate = moment(obj.date1).format('YYYY-MM-DD');
			var endDate = moment(obj.date2).format('YYYY-MM-DD');

			drawKeyHistoryChart(keyword, key_asin_id, startDate, endDate);
		});
	}
	drawKeyHistoryChart = function (keyword, asin_id, startDate, endDate) {

		if (keywordHistoryChart!=null)
			keywordHistoryChart.destroy();

		var response='';
		$.ajax({
			url: base_url+'user/services/keywordRankTracking/getKeyHistoryChartData',
			type: 'post',
			data: {key: keyword, asin_id: asin_id, start: startDate, end: endDate},
			dataType: 'json',
			async: false,
			success:
				function (data) {
					response = data;
				}
		});

		var data = [];
		var dataset = [];
		var labels = [];
		$.each(response.labels, function (i, val) {
			labels.push(val);
		});
		data['labels'] = labels;

		$.each(response.datasets, function (i, val) {

			var product = [];
			var datas = [];
			$.each(val.data, function (j, data) {
				datas.push(data);
			});
			product['data'] = datas;
			product['label'] = val.label;
			product['borderColor'] = val.borderColor;
			product['fill'] = val.fill;

			dataset.push(product) ;
		});
		data['datasets'] = dataset;

		var setting = {
			responsive: true,
			scales: {
				xAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Date'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Organic Rank'
					},
					ticks: {
						reverse: true,
					}
				}]
			}
		};

		config = [];
		config['type'] = "line";
		config['data'] = data;
		config['options'] = setting;

		keywordHistoryChart = new Chart($('#chart_view_keyword'), config);

	}

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

	function isRealValue(obj)
	{
		return obj && obj !== 'null' && obj !== 'undefined' && obj.length > 0;
	}

} );
