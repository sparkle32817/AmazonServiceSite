$(document).ready(function () {

	/*
	* Category***
	* */
	var view_task_id = $("#view_task_id").val();		//For client view

	function format ( d ) {

		var str_style_sales_year = "", str_sales_year="";
		if (d.others.sales_year=="0" || d.others.sales_year=="-")
		{
			str_sales_year = d.others.sales_year;
		}
		else if (d.others.sales_year!="")
		{
			if (Number(d.others.sales_year)<0)
			{
				str_style_sales_year = "style=\"color: red;\"";
				str_sales_year = "-" + (Number(d.others.sales_year)*(-1).toString()) + "%";
			}
			else
			{
				str_style_sales_year = "style=\"color: green;\"";
				str_sales_year = "+" + (d.others.sales_year) + "%";
			}
		}

		var str_style_sales_trend = "", str_sales_trend="";
		if (d.others.sales_trend=="0" || d.others.sales_trend=="-")
		{
			str_sales_trend = d.others.sales_trend;
		}
		else if (d.others.sales_trend!="")
		{
			if (Number(d.others.sales_trend)<0)
			{
				str_style_sales_trend = "style=\"color: red;\"";
				str_sales_trend = "-" + (Number(d.others.sales_trend)*(-1).toString()) + "%";
			}
			else
			{
				str_style_sales_trend = "style=\"color: green;\"";
				str_sales_trend = "+" + (d.others.sales_trend) + "%";
			}
		}

		var str_style_price_trend = "", str_price_trend="";
		if (d.others.price_trend=="0" || d.others.price_trend=="-")
		{
			str_price_trend = d.others.price_trend;
		}
		else if (d.others.price_trend!="")
		{
			if (Number(d.others.price_trend)<0)
			{
				str_style_price_trend = "style=\"color: red;\"";
				str_price_trend = "-" + (Number(d.others.price_trend)*(-1).toString()) + "%";
			}
			else
			{
				str_style_price_trend = "style=\"color: green;\"";
				str_price_trend = "+" + (d.others.price_trend) + "%";
			}
		}

		var div_element = $("<div class=\"col-md-12 col-sm-12 col-xs-12\">" +
			'<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">'+$("#txt_last_year_sales").val()+': <small class="content" >'+d.others.last_year_sales+'</small></label></div>'+
			'<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">'+$("#txt_sales_year").val()+': <small class="content" '+str_style_sales_year+'>'+str_sales_year+'</small></label></div>'+
			'<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">'+$("#txt_sales_trend").val()+': <small class="content" '+str_style_sales_trend+'>'+str_sales_trend+'</small></label></div>'+
			'<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">'+$("#txt_price_trend").val()+': <small class="content" '+str_style_price_trend+'>'+str_price_trend+'</small></label></div>'+
			'<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">'+$("#txt_best_sales").val()+': <small class="content" style="white-space: normal;">'+d.others.best_sales_period+'</small></label></div>'+
			'<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">'+$("#txt_sales_review").val()+': <small class="content" style="white-space: normal;">'+d.others.sales_to_reviews+'</small></label></div>'+
			'</div>'
		);

		return div_element;
	}

	$(function () {
	// 	var multi_category_category = new Choices("#category_market_category", {removeItemButton: true});
	if (isRealValue($("#category_shipping_tier")))
		new Choices("#category_shipping_tier", {removeItemButton: true});
	if (isRealValue($("#category_fulfillment")))
		new Choices("#category_fulfillment", {removeItemButton: true});
	});

	var table_bigdata_category = $("#table_bigdata_category").DataTable( {
		responsive: true,
		processing: true,
		"ajax": {
			"url": base_url+"user/services/BigData/getCategoryCompletionData",
			"type": "POST",
			"data": {
				task_id: view_task_id
			}
		},
        "language": {
            "decimal": ",",
            "thousands": "."
        },
		"columns": [
			{
				"className": "details-control",
				"orderable": false,
				"data": null,
				"defaultContent": ""
			},
			{ "data": "asin_info" },
			{ "data": "product" },
			{ "data": "sellers" },
			{ "data": "price" },
			{ "data": "monthly_sales" },
			{ "data": "monthly_revenue" },
			{ "data": "sales_rank" },
			{ "data": "reviews" }
		],
		columnDefs: [
			{
				targets: 1,
				render: function (data) {
					return `
                            <div>
                                <a href="http://www.`+data["market_url"]+`/dp/`+data["asin"]+`" class="row_asin_number"  target="_blank" style="text-decoration: underline;">`+data["asin"]+`</a>
                            </div>
                            `;
				}
			},
			{
				targets: 2,
				render: function(data) {

					console.log(data);
					var title = data["title"]!=null?data["title"]:"";
					var category = data["category"]!=null?data["category"]:"";
					var brand = data["brand"]!=null?data["brand"]:"";
					var fulfillment = data["fulfillment"]!=null?data["fulfillment"]:"";

					var str_weight = "";
					if (data["weight"] != "")
					{
						str_weight = data["weight"] + " lbs";
					}

					return `
                            <div style="text-align: left; margin-left: 20px; padding: 0px;">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_category_title").val()+`: <small class="content" style="white-space: normal;">`+title+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px; margin-top: 10px;"><label class="control-label">`+$("#txt_category_category").val()+`: <small class="content" style="white-space: normal;">`+category+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_category_brand").val()+`: <small class="content" style="white-space: normal;">`+brand+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_category_fulfillment").val()+`: <small class="content" style="white-space: normal;">`+fulfillment+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_category_size_tier").val()+`: <small class="content" style="white-space: normal;">`+data['size_tier']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_category_num_images").val()+`: <small class="content" style="white-space: normal;">`+data['num_image']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_category_variation_count").val()+`: <small class="content" style="white-space: normal;">`+data['variation_cnt']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_category_weight").val()+`: <small class="content" style="white-space: normal;">`+str_weight+`</small></label></div>
                            </div>
                            `;
				}
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
				targets: -1,
				orderable: false,
				render: function(data) {

					var str_rating = '';
					if (data['rating']==-1)
					{
						data['rating'] = 0;
						for (var i=0; i<5; i++)
							str_rating += '<i class="fa fa-star-o" style="color: #fc8c14;"></i>';

					}
					else
					{
						var cnt = Math.round(data['rating']);

						for (var i=0; i<cnt; i++)
							str_rating += '<i class="fa fa-star" style="color: #fc8c14;"></i>';

						if (data['rating']>cnt)
						{
							cnt ++;
							str_rating += '<i class="fa fa-star-half-o" style="color: #fc8c14;"></i>';
						}

						for (var i=0; i<(5-cnt); i++)
							str_rating += '<i class="fa fa-star-o" style="color: #fc8c14;"></i>';
					}

					if (data['count']=='-1')
						data['count'] = 0;

					return `
						<div>
							<div><label>`+(data['count'])+`</label></div>
							<div>`+str_rating+`</div>
							<div><label>`+data['rating']+`</label></div>
						</div>
						`;
				}
			}
		],
		"order": [[1, 'asc']],
		"initComplete": function( settings, json ) {
			if ($('#cur_status').val() == "complete")
				$('#table_bigdata_category .dataTables_empty').html('<p style="color:red;">There are no results for the criteria you have entered. Try removing some criteria to get better search results.<br/>PS: Your Credits for this search has been refunded</p>');
		}
	} );

	$('#table_bigdata_category tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = table_bigdata_category.row( tr );
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
			}
			tr.addClass('shown');
		}
	} );


	var table_bigdata_category_history = $('#table_bigdata_category_history').DataTable( {
		responsive: true,
		stateSave: true,
		"ajax": {
			"url": base_url+"user/services/BigData/getCategoryHistory",
			"type": "POST"
		},
		"columns": [
			{ "data": 'no' },
			{ "data": 'market_place' },
			{ "data": 'category' },
			{ "data": 'date_searched' },
			{ "data": 'status' },
			{ "data": 'action' }
		],
		columnDefs: [
			{
				targets: 2,
				render: function (data) {
					return '<div style="white-space: normal;">'+data+'</div>';
				}
			},
			{
				targets: -1,
				orderable: false,
				render: function (data) {

					var view_url = base_url + 'services/big_data/categoryResultView/'+data['id'];

					var str_div = '<div>';
					str_div += '<a href="'+view_url+'" class="bigdata_category_view"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';

					if (data['status'] == 'complete')
						str_div += '<a href="javascript:;" d-id="'+data['id']+'" class="bigdata_category_delete"><i class="fa fa-trash" style="color: red"></i></a>';

					str_div += '</div>';

					return str_div;
				}
			}
		],
		"order": [[0, 'asc']],
		dom: 'Brtip'
	} );

	$("#table_bigdata_category_history tbody").on("click", ".bigdata_category_delete", function () {

		table_bigdata_category_history.ajax.reload();

		var task_id = $(this).attr('d-id');

		var tr = $(this).closest('tr');
		var data = table_bigdata_category_history.row( tr ).data();
		var status = data['status'];
		if (status=='working')
		{
			popUpToast('warning', 'You can\'t delete this current working task.');

			return;
		}

		if (!confirm('Are you sure you want to delete this?'))
			return;

		$.ajax({
			url: base_url + 'user/services/BigData/deleteCategoryHistory',
			type: 'POST',
			data: {
				id: task_id
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {

					if (data == 'success')
						table_bigdata_category_history.ajax.reload(null, false);
				}
		});
	});

	var daterange_category_best_period = $('#daterange_category_best_period');
	if (isRealValue(daterange_category_best_period))
	{
		make_date_range_picker_bigdata(daterange_category_best_period);
	}

	//--- Change Market Place ---//
	$('#category_market_place').change(function () {
		var market_id = $(this).val();
		// alert(market_id);

		$.ajax({
			url: base_url + 'user/services/BigData/getMarketCategory',
			method: 'POST',
			data: {market_id: market_id},
			dataType: 'json',
			async: false,
			success: function(datas){

				$('#category_market_category').empty();

				$('#category_market_category').append($('<option>', {
					value: '',
					text : ''
				}));

				$.each(datas, function (i, data) {
					$('#category_market_category').append($('<option>', {
						value: data.value,
						text : data.label
					}));
				});

				// multi_category_category.clearChoices();
				// multi_category_category.setValue(datas);
				// new Choices('#category_market_category', {removeItemButton: true});
			}
		});
	});

	$('#category_form').on('submit', function () {

		var market_id = $('#category_market_place').val();
		var market_category = $('#category_market_category').val();

		if (market_id==='' || market_id==null)
			return false;


		var format = /[1-9.]/;

		var category_revenue_min = $('#category_revenue_min').val();
		var category_revenue_max = $('#category_revenue_max').val();
		if ( (category_revenue_min!='' && !format.test(category_revenue_min)) || (category_revenue_max!='' && !format.test(category_revenue_max)) )
		{
			popUpToast('warning', 'Monthly Revenue must only contain numbers.');
			return;
		}

		if (category_revenue_min!='' && category_revenue_max!='' && Number(category_revenue_min)>Number(category_revenue_max))
		{
			popUpToast('warning', 'Monthly Revenue Min must be smaller than Monthly Revenue Max.');
			return;
		}

		var category_price_min = $('#category_price_min').val();
		var category_price_max = $('#category_price_max').val();
		if ( (category_price_min!='' && !format.test(category_price_min)) || (category_price_max!='' && !format.test(category_price_max)) )
		{
			popUpToast('warning', 'Price must only contain numbers.');
			return;
		}

		if (category_price_min!='' && category_price_max!='' && Number(category_price_min)>Number(category_price_max))
		{
			popUpToast('warning', 'Price Min must be smaller than Price Max.');
			return;
		}

		var category_review_count_min = $('#category_review_count_min').val();
		var category_review_count_max = $('#category_review_count_max').val();
		if ( (category_review_count_min!='' && !format.test(category_review_count_min)) || (category_review_count_max!='' && !format.test(category_review_count_max)) )
		{
			popUpToast('warning', 'Review Count must only contain numbers.');
			return;
		}

		if (category_review_count_min!='' && Number(category_review_count_min)<0)
		{
			popUpToast('warning', 'Review Count Min can\'t be smaller than 0.');
			return;
		}

		if (category_review_count_min!='' && category_review_count_max!='' && Number(category_review_count_min)>Number(category_review_count_max))
		{
			popUpToast('warning', 'Review Count Min must be smaller than Review Count Max.');
			return;
		}

		var category_review_rating_min = $('#category_review_rating_min').val();
		var category_review_rating_max = $('#category_review_rating_max').val();
		if ( (category_review_rating_min!='' && !format.test(category_review_rating_min)) || (category_review_rating_max!='' && !format.test(category_review_rating_max)) )
		{
			popUpToast('warning', 'Review Rating must only contain numbers.');
			return;
		}

		if (category_review_rating_min != '' && Number(category_review_rating_min)<0)
		{
			popUpToast('warning', 'Review Rating Min can\'t be smaller than 0.');
			return;
		}

		if (category_price_min!='' && category_review_rating_max!='' && Number(category_review_rating_min)>Number(category_review_rating_max))
		{
			popUpToast('warning', 'Review Rating Min must be smaller than Review Rating Max.');
			return;
		}

		var category_sales_year_min = $('#category_sales_year_min').val();
		var category_sales_year_max = $('#category_sales_year_max').val();
		if ( (category_sales_year_min!='' && !format.test(category_sales_year_min)) || (category_sales_year_max!='' && !format.test(category_sales_year_max)) )
		{
			popUpToast('warning', 'Sales Year Over Year(%) must only contain numbers.');
			return;
		}

		if (category_sales_year_min!='' && category_sales_year_max!='' && Number(category_sales_year_min)>Number(category_sales_year_max))
		{
			popUpToast('warning', 'Sales Year Over Year(%) Min must be smaller than Sales Year Over Year(%) Max.');
			return;
		}

		var category_price_change_min = $('#category_price_change_min').val();
		var category_price_change_max = $('#category_price_change_max').val();
		if ( (category_price_change_min!='' && !format.test(category_price_change_min)) || (category_price_change_max!='' && !format.test(category_price_change_max)) )
		{
			popUpToast('warning', 'Price Change(%) must only contain numbers.');
			return;
		}

		if (category_price_change_min!='' && category_price_change_max!='' && Number(category_price_change_min)>Number(category_price_change_max))
		{
			popUpToast('warning', 'Price Change(%) Min must be smaller than Price Change(%) Max.');
			return;
		}

		var category_sales_change_min = $('#category_sales_change_min').val();
		var category_sales_change_max = $('#category_sales_change_max').val();
		if ( (category_sales_change_min!='' && !format.test(category_sales_change_min)) || (category_sales_change_max!='' && !format.test(category_sales_change_max)) )
		{
			popUpToast('warning', 'Sales Change(%) must only contain numbers.');
			return;
		}

		if (category_sales_change_min!='' && category_sales_change_max!='' && Number(category_sales_change_min)>Number(category_sales_change_max))
		{
			popUpToast('warning', 'Sales Change(%) Min must be smaller than Sales Change(%) Max.');
			return;
		}

		var category_sales_review_min = $('#category_sales_review_min').val();
		var category_sales_review_max = $('#category_sales_review_max').val();
		if ( (category_sales_review_min!='' && !format.test(category_sales_review_min)) || (category_sales_review_max!='' && !format.test(category_sales_review_max)) )
		{
			popUpToast('warning', 'Sales to Reviews must only contain numbers.');
			return;
		}

		if (category_sales_review_min!='' && Number(category_sales_review_min)<0)
		{
			popUpToast('warning', 'Sales to Reviews Min can\'t be smaller than 0.');
			return;
		}

		if (category_sales_review_min!='' && category_sales_review_max!='' && Number(category_sales_review_min)>Number(category_sales_review_max))
		{
			popUpToast('warning', 'Sales to Reviews Min must be smaller than Sales to Reviews Max.');
			return;
		}

		var category_sales_month_min = $('#category_sales_month_min').val();
		var category_sales_month_max = $('#category_sales_month_max').val();
		if ( (category_sales_month_min!='' && !format.test(category_sales_month_min)) || (category_sales_month_max!='' && !format.test(category_sales_month_max)) )
		{
			popUpToast('warning', 'Monthly Sales(Units) must only contain numbers.');
			return;
		}

		if (category_sales_month_min!='' && Number(category_sales_month_min)<0)
		{
			popUpToast('warning', 'Monthly Sales(Units) Min can\'t be smaller than 0.');
			return;
		}

		if (category_sales_month_min!='' && category_sales_month_max!='' && Number(category_sales_month_min)>Number(category_sales_month_max))
		{
			popUpToast('warning', 'RMonthly Sales(Units) Min must be smaller than Monthly Sales(Units) Max.');
			return;
		}

		var category_sales_rank_min = $('#category_sales_rank_min').val();
		var category_sales_rank_max = $('#category_sales_rank_max').val();
		if ( (category_sales_rank_min!='' && !format.test(category_sales_rank_min)) || (category_sales_rank_max!='' && !format.test(category_sales_rank_max)) )
		{
			popUpToast('warning', 'Best Sales Rank(BSR) must only contain numbers.');
			return;
		}

		if (category_sales_rank_min!='' && category_sales_rank_max!='' && Number(category_sales_rank_min)>Number(category_sales_rank_max))
		{
			popUpToast('warning', 'Best Sales Rank(BSR) Min must be smaller than Best Sales Rank(BSR) Max.');
			return;
		}

		var category_seller_num_min = $('#category_seller_num_min').val();
		var category_seller_num_max = $('#category_seller_num_max').val();
		if ( (category_seller_num_min!='' && !format.test(category_seller_num_min)) || (category_seller_num_max!='' && !format.test(category_seller_num_max)) )
		{
			popUpToast('warning', 'Number of Sellers must only contain numbers.');
			return;
		}

		if (category_seller_num_min!='' && Number(category_seller_num_min)<0)
		{
			popUpToast('warning', 'Number of Sellers Min can\'t be smaller than 0.');
			return;
		}

		if (category_seller_num_min!='' && category_seller_num_max!='' && Number(category_seller_num_min)>Number(category_seller_num_max))
		{
			popUpToast('warning', 'Number of Sellers Min must be smaller than Number of Sellers Max.');
			return;
		}

		var category_images_num_min = $('#category_images_num_min').val();
		var category_images_num_max = $('#category_images_num_max').val();
		if ( (category_images_num_min!='' && !format.test(category_images_num_min)) || (category_images_num_max!='' && !format.test(category_images_num_max)) )
		{
			popUpToast('warning', 'Number of Images must only contain numbers.');
			return;
		}

		if (category_images_num_min!='' && Number(category_images_num_min)<0)
		{
			popUpToast('warning', 'Number of Images Min can\'t be smaller than 0.');
			return;
		}

		if (category_images_num_min!='' && category_images_num_max!='' && Number(category_images_num_min)>Number(category_images_num_max))
		{
			popUpToast('warning', 'Number of Images Min must be smaller than Number of Images Max.');
			return;
		}

		var category_variation_count_min = $('#category_variation_count_min').val();
		var category_variation_count_max = $('#category_variation_count_max').val();
		if ( (category_variation_count_min!='' && !format.test(category_variation_count_min)) || (category_variation_count_max!='' && !format.test(category_variation_count_max)) )
		{
			popUpToast('warning', 'Variation Count must only contain numbers.');
			return;
		}

		if (category_variation_count_min!='' && Number(category_variation_count_min)<0)
		{
			popUpToast('warning', 'Variation Count Min can\'t be smaller than 0.');
			return;
		}

		if (category_variation_count_min!='' && category_variation_count_max!='' && Number(category_variation_count_min)>Number(category_variation_count_max))
		{
			popUpToast('warning', 'Variation Count Min must be smaller than Variation Count Max.');
			return;
		}

		var category_weight_min = $('#category_weight_min').val();
		var category_weight_max = $('#category_weight_max').val();
		if ( (category_weight_min!='' && !format.test(category_weight_min)) || (category_weight_max!='' && !format.test(category_weight_max)) )
		{
			popUpToast('warning', 'Weight(lb) must only contain numbers.');
			return;
		}

		if (category_weight_min!='' && Number(category_weight_min)<0)
		{
			popUpToast('warning', 'Weight(lb) Min can\'t be smaller than 0.');
			return;
		}

		if (category_weight_min!='' && category_weight_max!='' && Number(category_weight_min)>Number(category_weight_max))
		{
			popUpToast('warning', 'Weight(lb) Min must be smaller than Weight(lb) Max.');
			return;
		}

		var category_shipping_tier = '';
		if ($('#category_shipping_tier').val()!=null)
			category_shipping_tier = $('#category_shipping_tier').val().toString();

		var category_fulfillment = '';
		if ($('#category_fulfillment').val()!=null)
			category_fulfillment = $('#category_fulfillment').val().toString();

		var daterange_category_best_period = $('#daterange_category_best_period').val();
		var category_include_keyword = $('#category_include_keyword').val();
		var category_exclude_keyword = $('#category_exclude_keyword').val();

		var dataArr = {
			service: 'Big Data-Category',
			market_id: market_id,
			category_id: market_category,
			revenue_min: category_revenue_min,
			revenue_max: category_revenue_max,
			price_min: category_price_min,
			price_max: category_price_max,
			review_cnt_min: category_review_count_min,
			review_cnt_max: category_review_count_max,
			review_rating_min: category_review_rating_min,
			review_rating_max: category_review_rating_max,
			shipping_tier: category_shipping_tier,
			sales_year_min: category_sales_year_min,
			sales_year_max: category_sales_year_max,
			price_change_min: category_price_change_min,
			price_change_max: category_price_change_max,
			sales_change_min: category_sales_change_min,
			sales_change_max: category_sales_change_max,
			best_sales_period: daterange_category_best_period,
			sales_review_min: category_sales_review_min,
			sales_review_max: category_sales_review_max,
			monthly_sales_min: category_sales_month_min,
			monthly_sales_max: category_sales_month_max,
			sales_rank_min: category_sales_rank_min,
			sales_rank_max: category_sales_rank_max,
			seller_num_min: category_seller_num_min,
			seller_num_max: category_seller_num_max,
			fulfillment: category_fulfillment,
			image_num_min: category_images_num_min,
			image_num_max: category_images_num_max,
			variation_cnt_min: category_variation_count_min,
			variation_cnt_max: category_variation_count_max,
			weight_min: category_weight_min,
			weight_max: category_weight_max,
			in_keywords: category_include_keyword,
			ex_keywords: category_exclude_keyword
		};

		isStartSearch(dataArr, 'categoryResultView', table_bigdata_category_history);

		return false;
	});

	/*
	* Advertising***
	* */
	$(function () {
		if (isRealValue($('#advertising_shipping_tier')))
			new Choices('#advertising_shipping_tier', {removeItemButton: true});
		if (isRealValue($('#advertising_fulfillment')))
			new Choices('#advertising_fulfillment', {removeItemButton: true});
	});

	var table_bigdata_advertising = $('#table_bigdata_advertising').DataTable( {
		responsive: true,
		processing: true,
		"ajax": {
			"url": base_url+"user/services/BigData/getAdvertisingCompletionData",
			"type": "POST",
			"data": {
				task_id: view_task_id
			}
		},
		"columns": [
			{
				"className": 'details-control',
				"orderable": false,
				"data": null,
				"defaultContent": ''
			},
			{ "data": 'asin_info' },
			{ "data": 'product' },
			{ "orderable": false, "data": 'together' },
			{ "orderable": false, "data": 'custom' },
			{ "orderable": false, "data": 'amazon' },
			{ "data": 'sellers' },
			{ "data": 'price' },
			{ "data": 'monthly_sales' },
			{ "data": 'monthly_revenue' },
			{ "data": 'sales_rank' },
			{ "data": 'reviews' }
		],
		columnDefs: [
			{
				targets: 1,
				render: function (data) {
					return `
                            <div>
                                <a href="http://www.`+data['market_url']+`/dp/`+data['asin']+`" class="row_asin_number"  target="_blank" style="text-decoration: underline;">`+data['asin']+`</a>
                            </div>
                            `;
				}
			},
			{
				targets: 2,
				render: function(data) {

					var title = data['title']!=null?data['title']:'';
					var category = data['category']!=null?data['category']:'';
					var brand = data['brand']!=null?data['brand']:'';
					var fulfillment = data['fulfillment']!=null?data['fulfillment']:'';

					var str_weight = '';
					if (data['weight'] != '')
						str_weight = (data['weight']) + ' lbs';

					return `
                            <div style="text-align: left; margin-left: 20px; padding: 0px;">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_advertising_title").val()+`: <small class="content" style="white-space: normal;">`+title+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px; margin-top: 10px;"><label class="control-label">`+$("#txt_advertising_category").val()+`: <small class="content" style="white-space: normal;">`+category+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_advertising_brand").val()+`: <small class="content" style="white-space: normal;">`+brand+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_advertising_fulfillment").val()+`: <small class="content" style="white-space: normal;">`+fulfillment+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_advertising_size_tier").val()+`: <small class="content" style="white-space: normal;">`+data['size_tier']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_advertising_num_images").val()+`: <small class="content" style="white-space: normal;">`+data['num_image']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_advertising_variation_count").val()+`: <small class="content" style="white-space: normal;">`+data['variation_cnt']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_advertising_weight").val()+`: <small class="content" style="white-space: normal;">`+str_weight+`</small></label></div>
                            </div>
                            `;
				}
			},
			{
				targets: 3,
				render: function (data) {
					var str = '';
					if (data)
						str = '<i class="fa fa-check-circle-o" style="font-size: 20px; color: #65a035"></i>';

					return `
                            <div>`+str+`</div>
                            `;
				}
			},
			{
				targets: 4,
				render: function (data) {
					var str = '';
					if (data)
						str = '<i class="fa fa-check-circle-o" style="font-size: 20px; color: #65a035"></i>';

					return `
                            <div>`+str+`</div>
                            `;
				}
			},
			{
				targets: 5,
				render: function (data) {
					var str = '';
					if (data)
						str = '<i class="fa fa-check-circle-o" style="font-size: 20px; color: #65a035"></i>';

					return `
                            <div>`+str+`</div>
                            `;
				}
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
				targets: 8,
				type: "num-fmt"
			},
			{
				targets: 9,
				type: "num-fmt"
			},
			{
				targets: 10,
				type: "num-fmt"
			},
			{
				targets: -1,
				type: "num-fmt",
				orderable: false,
				render: function(data) {

					var str_rating = '';
					if (data['rating']==-1)
					{
						data['rating'] = 0;
						for (var i=0; i<5; i++)
							str_rating += '<i class="fa fa-star-o" style="color: #fc8c14;"></i>';

					}
					else
					{
						var cnt = Math.round(data['rating']);

						for (var i=0; i<cnt; i++)
							str_rating += '<i class="fa fa-star" style="color: #fc8c14;"></i>';

						if (data['rating']>cnt)
						{
							cnt ++;
							str_rating += '<i class="fa fa-star-half-o" style="color: #fc8c14;"></i>';
						}

						for (var i=0; i<(5-cnt); i++)
							str_rating += '<i class="fa fa-star-o" style="color: #fc8c14;"></i>';
					}

					if (data['count']=='-1')
						data['count'] = 0;

					return `
						<div>
							<div><label>`+(data['count'])+`</label></div>
							<div>`+str_rating+`</div>
							<div><label>`+data['rating']+`</label></div>
						</div>
						`;
				}
			}
		],
		"order": [[1, 'asc']],
		"initComplete": function( settings, json ) {
			console.log('Status::'+$('#cur_status').val());
			if ($('#cur_status').val() == "complete")
				$('#table_bigdata_advertising .dataTables_empty').html('<p style="color:red;">There are no results for the criteria you have entered. Try removing some criteria to get better search results.<br/>PS: Your Credits for this search has been refunded</p>');
		}
	} );

	$('#table_bigdata_advertising tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = table_bigdata_advertising.row( tr );
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
			}
			tr.addClass('shown');
		}
	} );

	var table_bigdata_advertising_history = $('#table_bigdata_advertising_history').DataTable( {
		responsive: true,
		stateSave: true,
		"ajax": {
			"url": base_url+"user/services/BigData/getAdvertisingHistory",
			"type": "POST"
		},
		"columns": [
			{ "data": 'no' },
			{ "data": 'market_place' },
			{ "data": 'asin' },
			{ "data": 'category' },
			{ "data": 'date_searched' },
			{ "data": 'status' },
			{ "data": 'action' }
		],
		columnDefs: [
			{
				targets: 3,
				render: function (data) {
					return '<div style="white-space: normal;">'+data+'</div>';
				}
			},
			{
				targets: -1,
				orderable: false,
				render: function (data) {

					var view_url = base_url + 'services/big_data/advertisingResultView/'+data['id'];

					var str_div = '<div>';
					str_div += '<a href="'+view_url+'" class="bigdata_category_view"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';

					if (data['status'] == 'complete')
						str_div += '<a href="javascript:;" d-id="'+data['id']+'" class="bigdata_category_delete"><i class="fa fa-trash" style="color: red"></i></a>';

					str_div += '</div>';

					return str_div;
				}
			}
		],
		"order": [[0, 'asc']],
		dom: 'Brtip'
	} );

	$("#table_bigdata_advertising_history tbody").on("click", ".bigdata_category_delete", function () {

		table_bigdata_advertising_history.ajax.reload();

		var task_id = $(this).attr('d-id');

		var tr = $(this).closest('tr');
		var data = table_bigdata_advertising_history.row( tr ).data();
		var status = data['status'];
		if (status=='working')
		{
			popUpToast('warning', 'You can\'t delete this current working task.');

			return;
		}

		if (!confirm('Are you sure you want to delete this?'))
			return;

		$.ajax({
			url: base_url + 'user/services/BigData/deleteCategoryHistory',
			type: 'POST',
			data: {
				id: task_id
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {

					if (data == 'success')
						table_bigdata_advertising_history.ajax.reload(null, false);
				}
		});
	});

	var daterange_advertising_best_period = $('#daterange_advertising_best_period');
	if (isRealValue(daterange_advertising_best_period))
	{
		make_date_range_picker_bigdata(daterange_advertising_best_period);
	}

	//--- Change Market Place ---//
	$('#advertising_market_place').change(function () {
		var market_id = $(this).val();
		// alert(market_id);

		$.ajax({
			url: base_url + 'user/services/BigData/getMarketCategory',
			method: 'POST',
			data: {market_id: market_id},
			dataType: 'json',
			async: false,
			success: function(datas){

				$('#advertising_market_category').empty();

				$('#advertising_market_category').append($('<option>', {
					value: '',
					text : ''
				}));

				$.each(datas, function (i, data) {
					$('#advertising_market_category').append($('<option>', {
						value: data.value,
						text : data.label
					}));
				});
			}
		});
	});

	$('#advertising_form').on('submit', function () {

		var market_id = $('#advertising_market_place').val();
		var product_asin = $('#advertising_product_asin').val();
		var market_category = $('#advertising_market_category').val();
		if (product_asin=='' || market_id=='')
		{
			return;
		}

		var format1 = /[!@#$%^&*()_+\-=\[\]{};':"\\|,`.<>\/?]/;
		if (format1.test(product_asin))
		{
			popUpToast('warning', 'Don\'t input special characters in ASIN.');
			return;
		}

		if (product_asin.length!=10)
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		var format = /[1-9.]/;

		var advertising_revenue_min = $('#advertising_revenue_min').val();
		var advertising_revenue_max = $('#advertising_revenue_max').val();
		if ( (advertising_revenue_min!='' && !format.test(advertising_revenue_min)) || (advertising_revenue_max!='' && !format.test(advertising_revenue_max)) )
		{
			popUpToast('warning', 'Monthly Revenue must only contain numbers.');
			return;
		}

		if (advertising_revenue_min!='' && advertising_revenue_max!='' && Number(advertising_revenue_min)>Number(advertising_revenue_max))
		{
			popUpToast('warning', 'Monthly Revenue Min must be smaller than Monthly Revenue Max.');
			return;
		}

		var advertising_price_min = $('#advertising_price_min').val();
		var advertising_price_max = $('#advertising_price_max').val();
		if ( (advertising_price_min!='' && !format.test(advertising_price_min)) || (advertising_price_max!='' && !format.test(advertising_price_max)) )
		{
			popUpToast('warning', 'Price must only contain numbers.');
			return;
		}

		if (advertising_price_min!='' && advertising_price_max!='' && Number(advertising_price_min)>Number(advertising_price_max))
		{
			popUpToast('warning', 'Price Min must be smaller than Price Max.');
			return;
		}

		var advertising_review_count_min = $('#advertising_review_count_min').val();
		var advertising_review_count_max = $('#advertising_review_count_max').val();
		if ( (advertising_review_count_min!='' && !format.test(advertising_review_count_min)) || (advertising_review_count_max!='' && !format.test(advertising_review_count_max)) )
		{
			popUpToast('warning', 'Review Count must only contain numbers.');
			return;
		}

		if (advertising_review_count_min!='' && Number(advertising_review_count_min)<0)
		{
			popUpToast('warning', 'Review Count Min can\'t be smaller than 0.');
			return;
		}

		if (advertising_review_count_min!='' && advertising_review_count_max!='' && Number(advertising_review_count_min)>Number(advertising_review_count_max))
		{
			popUpToast('warning', 'Review Count Min must be smaller than Review Count Max.');
			return;
		}

		var advertising_review_rating_min = $('#advertising_review_rating_min').val();
		var advertising_review_rating_max = $('#advertising_review_rating_max').val();
		if ( (advertising_review_rating_min!='' && !format.test(advertising_review_rating_min)) || (advertising_review_rating_max!='' && !format.test(advertising_review_rating_max)) )
		{
			popUpToast('warning', 'Review Rating must only contain numbers.');
			return;
		}

		if (advertising_review_rating_min != '' && Number(advertising_review_rating_min)<0)
		{
			popUpToast('warning', 'Review Rating Min can\'t be smaller than 0.');
			return;
		}

		var advertising_sales_year_min = $('#advertising_sales_year_min').val();
		var advertising_sales_year_max = $('#advertising_sales_year_max').val();
		if ( (advertising_sales_year_min!='' && !format.test(advertising_sales_year_min)) || (advertising_sales_year_max!='' && !format.test(advertising_sales_year_max)) )
		{
			popUpToast('warning', 'Sales Year Over Year(%) must only contain numbers.');
			return;
		}

		if (advertising_sales_year_min!='' && advertising_sales_year_max!='' && Number(advertising_sales_year_min)>Number(advertising_sales_year_max))
		{
			popUpToast('warning', 'Sales Year Over Year(%) Min must be smaller than Sales Year Over Year(%) Max.');
			return;
		}

		var advertising_price_change_min = $('#advertising_price_change_min').val();
		var advertising_price_change_max = $('#advertising_price_change_max').val();
		if ( (advertising_price_change_min!='' && !format.test(advertising_price_change_min)) || (advertising_price_change_max!='' && !format.test(advertising_price_change_max)) )
		{
			popUpToast('warning', 'Price Change(%) must only contain numbers.');
			return;
		}

		if (advertising_price_change_min!='' && advertising_price_change_max!='' && Number(advertising_price_change_min)>Number(advertising_price_change_max))
		{
			popUpToast('warning', 'Price Change(%) Min must be smaller than Price Change(%) Max.');
			return;
		}

		var advertising_sales_change_min = $('#advertising_sales_change_min').val();
		var advertising_sales_change_max = $('#advertising_sales_change_max').val();
		if ( (advertising_sales_change_min!='' && !format.test(advertising_sales_change_min)) || (advertising_sales_change_max!='' && !format.test(advertising_sales_change_max)) )
		{
			popUpToast('warning', 'Sales Change(%) must only contain numbers.');
			return;
		}

		if (advertising_sales_change_min!='' && advertising_sales_change_max!='' && Number(advertising_sales_change_min)>Number(advertising_sales_change_max))
		{
			popUpToast('warning', 'Sales Change(%) Min must be smaller than Sales Change(%) Max.');
			return;
		}

		var advertising_sales_review_min = $('#advertising_sales_review_min').val();
		var advertising_sales_review_max = $('#advertising_sales_review_max').val();
		if ( (advertising_sales_review_min!='' && !format.test(advertising_sales_review_min)) || (advertising_sales_review_max!='' && !format.test(advertising_sales_review_max)) )
		{
			popUpToast('warning', 'Sales to Reviews must only contain numbers.');
			return;
		}

		if (advertising_sales_review_min!='' && Number(advertising_sales_review_min)<0)
		{
			popUpToast('warning', 'Sales to Reviews Min can\'t be smaller than 0.');
			return;
		}

		if (advertising_sales_review_min!='' && advertising_sales_review_max!='' && Number(advertising_sales_review_min)>Number(advertising_sales_review_max))
		{
			popUpToast('warning', 'Sales to Reviews Min must be smaller than Sales to Reviews Max.');
			return;
		}

		var advertising_sales_month_min = $('#advertising_sales_month_min').val();
		var advertising_sales_month_max = $('#advertising_sales_month_max').val();
		if ( (advertising_sales_month_min!='' && !format.test(advertising_sales_month_min)) || (advertising_sales_month_max!='' && !format.test(advertising_sales_month_max)) )
		{
			popUpToast('warning', 'Monthly Sales(Units) must only contain numbers.');
			return;
		}

		if (advertising_sales_month_min!='' && Number(advertising_sales_month_min)<0)
		{
			popUpToast('warning', 'Monthly Sales(Units) Min can\'t be smaller than 0.');
			return;
		}

		if (advertising_sales_month_min!='' && advertising_sales_month_max!='' && Number(advertising_sales_month_min)>Number(advertising_sales_month_max))
		{
			popUpToast('warning', 'RMonthly Sales(Units) Min must be smaller than Monthly Sales(Units) Max.');
			return;
		}

		var advertising_sales_rank_min = $('#advertising_sales_rank_min').val();
		var advertising_sales_rank_max = $('#advertising_sales_rank_max').val();
		if ( (advertising_sales_rank_min!='' && !format.test(advertising_sales_rank_min)) || (advertising_sales_rank_max!='' && !format.test(advertising_sales_rank_max)) )
		{
			popUpToast('warning', 'Best Sales Rank(BSR) must only contain numbers.');
			return;
		}

		if (advertising_sales_rank_min!='' && advertising_sales_rank_max!='' && Number(advertising_sales_rank_min)>Number(advertising_sales_rank_max))
		{
			popUpToast('warning', 'Best Sales Rank(BSR) Min must be smaller than Best Sales Rank(BSR) Max.');
			return;
		}

		var advertising_seller_num_min = $('#advertising_seller_num_min').val();
		var advertising_seller_num_max = $('#advertising_seller_num_max').val();
		if ( (advertising_seller_num_min!='' && !format.test(advertising_seller_num_min)) || (advertising_seller_num_max!='' && !format.test(advertising_seller_num_max)) )
		{
			popUpToast('warning', 'Number of Sellers must only contain numbers.');
			return;
		}

		if (advertising_seller_num_min!='' && Number(advertising_seller_num_min)<0)
		{
			popUpToast('warning', 'Number of Sellers Min can\'t be smaller than 0.');
			return;
		}

		if (advertising_seller_num_min!='' && advertising_seller_num_max!='' && Number(advertising_seller_num_min)>Number(advertising_seller_num_max))
		{
			popUpToast('warning', 'Number of Sellers Min must be smaller than Number of Sellers Max.');
			return;
		}

		var advertising_images_num_min = $('#advertising_images_num_min').val();
		var advertising_images_num_max = $('#advertising_images_num_max').val();
		if ( (advertising_images_num_min!='' && !format.test(advertising_images_num_min)) || (advertising_images_num_max!='' && !format.test(advertising_images_num_max)) )
		{
			popUpToast('warning', 'Number of Images must only contain numbers.');
			return;
		}

		if (advertising_images_num_min!='' && Number(advertising_images_num_min)<0)
		{
			popUpToast('warning', 'Number of Images Min can\'t be smaller than 0.');
			return;
		}

		if (advertising_images_num_min!='' && advertising_images_num_max!='' && Number(advertising_images_num_min)>Number(advertising_images_num_max))
		{
			popUpToast('warning', 'Number of Images Min must be smaller than Number of Images Max.');
			return;
		}

		var advertising_variation_count_min = $('#advertising_variation_count_min').val();
		var advertising_variation_count_max = $('#advertising_variation_count_max').val();
		if ( (advertising_variation_count_min!='' && !format.test(advertising_variation_count_min)) || (advertising_variation_count_max!='' && !format.test(advertising_variation_count_max)) )
		{
			popUpToast('warning', 'Variation Count must only contain numbers.');
			return;
		}

		if (advertising_variation_count_min!='' && Number(advertising_variation_count_min)<0)
		{
			popUpToast('warning', 'Variation Count Min can\'t be smaller than 0.');
			return;
		}

		if (advertising_variation_count_min!='' && advertising_variation_count_max!='' && Number(advertising_variation_count_min)>Number(advertising_variation_count_max))
		{
			popUpToast('warning', 'Variation Count Min must be smaller than Variation Count Max.');
			return;
		}

		var advertising_weight_min = $('#advertising_weight_min').val();
		var advertising_weight_max = $('#advertising_weight_max').val();
		if ( (advertising_weight_min!='' && !format.test(advertising_weight_min)) || (advertising_weight_max!='' && !format.test(advertising_weight_max)) )
		{
			popUpToast('warning', 'Weight(lb) must only contain numbers.');
			return;
		}

		if (advertising_weight_min!='' && Number(advertising_weight_min)<0)
		{
			popUpToast('warning', 'Weight(lb) Min can\'t be smaller than 0.');
			return;
		}

		if (advertising_weight_min!='' && advertising_weight_max!='' && Number(advertising_weight_min)>Number(advertising_weight_max))
		{
			popUpToast('warning', 'Weight(lb) Min must be smaller than Weight(lb) Max.');
			return;
		}

		var advertising_shipping_tier = '';
		if ($('#advertising_shipping_tier').val()!=null)
			advertising_shipping_tier = $('#advertising_shipping_tier').val().toString();

		var advertising_fulfillment = '';
		if ($('#advertising_fulfillment').val()!=null)
			advertising_fulfillment = $('#advertising_fulfillment').val().toString();

		var daterange_advertising_best_period = $('#daterange_advertising_best_period').val();
		var advertising_include_keyword = $('#advertising_include_keyword').val();
		var advertising_exclude_keyword = $('#advertising_exclude_keyword').val();

		var dataArr = {
				service: 'Big Data-Advertising',
				asin: product_asin,
				market_id: market_id,
				category_id: market_category,
				revenue_min: advertising_revenue_min,
				revenue_max: advertising_revenue_max,
				price_min: advertising_price_min,
				price_max: advertising_price_max,
				review_cnt_min: advertising_review_count_min,
				review_cnt_max: advertising_review_count_max,
				review_rating_min: advertising_review_rating_min,
				review_rating_max: advertising_review_rating_max,
				shipping_tier: advertising_shipping_tier,
				sales_year_min: advertising_sales_year_min,
				sales_year_max: advertising_sales_year_max,
				price_change_min: advertising_price_change_min,
				price_change_max: advertising_price_change_max,
				sales_change_min: advertising_sales_change_min,
				sales_change_max: advertising_sales_change_max,
				best_sales_period: daterange_advertising_best_period,
				sales_review_min: advertising_sales_review_min,
				sales_review_max: advertising_sales_review_max,
				monthly_sales_min: advertising_sales_month_min,
				monthly_sales_max: advertising_sales_month_max,
				sales_rank_min: advertising_sales_rank_min,
				sales_rank_max: advertising_sales_rank_max,
				seller_num_min: advertising_seller_num_min,
				seller_num_max: advertising_seller_num_max,
				fulfillment: advertising_fulfillment,
				image_num_min: advertising_images_num_min,
				image_num_max: advertising_images_num_max,
				variation_cnt_min: advertising_variation_count_min,
				variation_cnt_max: advertising_variation_count_max,
				weight_min: advertising_weight_min,
				weight_max: advertising_weight_max,
				in_keywords: advertising_include_keyword,
				ex_keywords: advertising_exclude_keyword
		};

		isStartSearch(dataArr, 'advertisingResultView', table_bigdata_advertising_history);

		return false;
	});

	/*
	* Product***
	* */
	$(function () {
		// 	var multi_category_category = new Choices('#category_market_category', {removeItemButton: true});
		if (isRealValue($('#product_shipping_tier')))
			new Choices('#product_shipping_tier', {removeItemButton: true});
		if (isRealValue($('#product_fulfillment')))
			new Choices('#product_fulfillment', {removeItemButton: true});
	});

	var table_bigdata_product = $('#table_bigdata_product').DataTable( {
		responsive: true,
		processing: true,
		"ajax": {
			"url": base_url+"user/services/BigData/getProductCompletionData",
			"type": "POST",
			"data": {
				task_id: view_task_id
			}
		},
		"columns": [
			{
				"className": 'details-control',
				"orderable": false,
				"data": null,
				"defaultContent": ''
			},
			{ "data": 'asin_info' },
			{ "data": 'product' },
			{ "data": 'p_index' },
			{ "data": 'sellers' },
			{ "data": 'price' },
			{ "data": 'monthly_sales' },
			{ "data": 'monthly_revenue' },
			{ "data": 'sales_rank' },
			{ "data": 'reviews' }
		],
		columnDefs: [
			{
				targets: 1,
				render: function (data) {
					return `
                            <div>
                                <a href="http://www.`+data['market_url']+`/dp/`+data['asin']+`" class="row_asin_number"  target="_blank" style="text-decoration: underline;">`+data['asin']+`</a>
                            </div>
                            `;
				}
			},
			{
				targets: 2,
				render: function(data) {

					var title = data['title']!=null?data['title']:'';
					var category = data['category']!=null?data['category']:'';
					var brand = data['brand']!=null?data['brand']:'';
					var fulfillment = data['fulfillment']!=null?data['fulfillment']:'';

					var str_weight = '';
					if (data['weight'] != '')
						str_weight = (data['weight']) + ' lbs';

					return `
                            <div style="text-align: left; margin-left: 20px; padding: 0px;">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_product_title").val()+`: <small class="content" style="white-space: normal;">`+title+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px; margin-top: 10px;"><label class="control-label">`+$("#txt_product_category").val()+`: <small class="content" style="white-space: normal;">`+category+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_product_brand").val()+`: <small class="content" style="white-space: normal;">`+brand+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_product_fulfillment").val()+`: <small class="content" style="white-space: normal;">`+fulfillment+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_product_size_tier").val()+`: <small class="content" style="white-space: normal;">`+data['size_tier']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_product_num_images").val()+`: <small class="content" style="white-space: normal;">`+data['num_image']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_product_variation_count").val()+`: <small class="content" style="white-space: normal;">`+data['variation_cnt']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_product_weight").val()+`: <small class="content" style="white-space: normal;">`+str_weight+`</small></label></div>
                            </div>
                            `;
				}
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
				targets: 8,
				type: "num-fmt"
			},
			{
				targets: -1,
				type: "num-fmt",
				orderable: false,
				render: function(data) {

					var str_rating = '';
					if (data['rating']==-1)
					{
						data['rating'] = 0;
						for (var i=0; i<5; i++)
							str_rating += '<i class="fa fa-star-o" style="color: #fc8c14;"></i>';

					}
					else
					{
						var cnt = Math.round(data['rating']);

						for (var i=0; i<cnt; i++)
							str_rating += '<i class="fa fa-star" style="color: #fc8c14;"></i>';

						if (data['rating']>cnt)
						{
							cnt ++;
							str_rating += '<i class="fa fa-star-half-o" style="color: #fc8c14;"></i>';
						}

						for (var i=0; i<(5-cnt); i++)
							str_rating += '<i class="fa fa-star-o" style="color: #fc8c14;"></i>';
					}

					if (data['count']=='-1')
						data['count'] = 0;

					return `
						<div>
							<div><label>`+(data['count'])+`</label></div>
							<div>`+str_rating+`</div>
							<div><label>`+data['rating']+`</label></div>
						</div>
						`;
				}
			}
		],
		"order": [[1, 'asc']],
		"initComplete": function( settings, json ) {
			if ($('#cur_status').val() == "complete")
				$('#table_bigdata_product .dataTables_empty').html('<p style="color:red;">There are no results for the criteria you have entered. Try removing some criteria to get better search results.<br/>PS: Your Credits for this search has been refunded</p>');
		}
	} );

	$('#table_bigdata_product tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = table_bigdata_product.row( tr );
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
			}
			tr.addClass('shown');
		}
	} );

	var table_bigdata_product_history = $('#table_bigdata_product_history').DataTable( {
		responsive: true,
		stateSave: true,
		"ajax": {
			"url": base_url+"user/services/BigData/getProductHistory",
			"type": "POST"
		},
		"columns": [
			{ "data": 'no' },
			{ "data": 'market_place' },
			{ "data": 'category' },
			{ "data": 'asin' },
			{ "data": 'date_searched' },
			{ "data": 'status' },
			{ "data": 'action' }
		],
		columnDefs: [
			{
				targets: 2,
				render: function (data) {
					return '<div style="white-space: normal;">'+data+'</div>';
				}
			},
			{
				targets: -1,
				orderable: false,
				render: function (data) {

					var view_url = base_url + 'services/big_data/productResultView/'+data['id'];

					var str_div = '<div>';
					str_div += '<a href="'+view_url+'" class="bigdata_category_view"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';

					if (data['status'] == 'complete')
						str_div += '<a href="javascript:;" d-id="'+data['id']+'" class="bigdata_category_delete"><i class="fa fa-trash" style="color: red"></i></a>';

					str_div += '</div>';

					return str_div;
				}
			}
		],
		"order": [[0, 'asc']],
		dom: 'Brtip'
	} );

	$("#table_bigdata_product_history tbody").on("click", ".bigdata_category_delete", function () {

		table_bigdata_product_history.ajax.reload();

		var task_id = $(this).attr('d-id');

		var tr = $(this).closest('tr');
		var data = table_bigdata_product_history.row( tr ).data();
		var status = data['status'];
		if (status=='working')
		{
			popUpToast('warning', 'You can\'t delete this current working task.');

			return;
		}

		if (!confirm('Are you sure you want to delete this?'))
			return;

		$.ajax({
			url: base_url + 'user/services/BigData/deleteProductHistory',
			type: 'POST',
			data: {
				id: task_id
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {

					if (data == 'success')
						table_bigdata_product_history.ajax.reload(null, false);
				}
		});
	});

	var daterange_product_best_period = $('#daterange_product_best_period');
	if (isRealValue(daterange_product_best_period))
	{
		make_date_range_picker_bigdata(daterange_product_best_period);
	}

	//--- Change Market Place ---//
	$('#product_market_place').change(function () {
		var market_id = $(this).val();
		// alert(market_id);

		$.ajax({
			url: base_url + 'user/services/BigData/getMarketCategory',
			method: 'POST',
			data: {market_id: market_id},
			dataType: 'json',
			async: false,
			success: function(datas){

				$('#product_market_category').empty();

				$('#product_market_category').append($('<option>', {
					value: '',
					text : ''
				}));

				$.each(datas, function (i, data) {
					$('#product_market_category').append($('<option>', {
						value: data.value,
						text : data.label
					}));
				});
			}
		});
	});

	$('#product_form').on('submit', function () {

		var market_id = $('#product_market_place').val();
		var product_asin = $('#product_asin').val();
		var market_category = $('#product_market_category').val();
		if (product_asin=='' || market_id=='')
		{
			return;
		}

		var format1 = /[!@#$%^&*()_+\-=\[\]{};':"\\|,`.<>\/?]/;
		if (format1.test(product_asin))
		{
			popUpToast('warning', 'Don\'t input special characters in ASIN.');
			return;
		}

		if (product_asin.length!=10)
		{
			popUpToast('warning', 'You must only input 10 characters in ASIN.');
			return;
		}

		var format = /[1-9.]/;

		var product_revenue_min = $('#product_revenue_min').val();
		var product_revenue_max = $('#product_revenue_max').val();
		if ( (product_revenue_min!='' && !format.test(product_revenue_min)) || (product_revenue_max!='' && !format.test(product_revenue_max)) )
		{
			popUpToast('warning', 'Monthly Revenue must only contain numbers.');
			return;
		}

		if (product_revenue_min!='' && product_revenue_max!='' && Number(product_revenue_min)>Number(product_revenue_max))
		{
			popUpToast('warning', 'Monthly Revenue Min must be smaller than Monthly Revenue Max.');
			return;
		}

		var product_price_min = $('#product_price_min').val();
		var product_price_max = $('#product_price_max').val();
		if ( (product_price_min!='' && !format.test(product_price_min)) || (product_price_max!='' && !format.test(product_price_max)) )
		{
			popUpToast('warning', 'Price must only contain numbers.');
			return;
		}

		if (product_price_min!='' && product_price_max!='' && Number(product_price_min)>Number(product_price_max))
		{
			popUpToast('warning', 'Price Min must be smaller than Price Max.');
			return;
		}

		var product_review_count_min = $('#product_review_count_min').val();
		var product_review_count_max = $('#product_review_count_max').val();
		if ( (product_review_count_min!='' && !format.test(product_review_count_min)) || (product_review_count_max!='' && !format.test(product_review_count_max)) )
		{
			popUpToast('warning', 'Review Count must only contain numbers.');
			return;
		}

		if (product_review_count_min!='' && Number(product_review_count_min)<0)
		{
			popUpToast('warning', 'Review Count Min can\'t be smaller than 0.');
			return;
		}

		if (product_review_count_min!='' && product_review_count_max!='' && Number(product_review_count_min)>Number(product_review_count_max))
		{
			popUpToast('warning', 'Review Count Min must be smaller than Review Count Max.');
			return;
		}

		var product_review_rating_min = $('#product_review_rating_min').val();
		var product_review_rating_max = $('#product_review_rating_max').val();
		if ( (product_review_rating_min!='' && !format.test(product_review_rating_min)) || (product_review_rating_max!='' && !format.test(product_review_rating_max)) )
		{
			popUpToast('warning', 'Review Rating must only contain numbers.');
			return;
		}

		if (product_review_rating_min != '' && Number(product_review_rating_min)<0)
		{
			popUpToast('warning', 'Review Rating Min can\'t be smaller than 0.');
			return;
		}

		if (product_price_min!='' && product_review_rating_max!='' && Number(product_review_rating_min)>Number(product_review_rating_max))
		{
			popUpToast('warning', 'Review Rating Min must be smaller than Review Rating Max.');
			return;
		}

		var product_sales_year_min = $('#product_sales_year_min').val();
		var product_sales_year_max = $('#product_sales_year_max').val();
		if ( (product_sales_year_min!='' && !format.test(product_sales_year_min)) || (product_sales_year_max!='' && !format.test(product_sales_year_max)) )
		{
			popUpToast('warning', 'Sales Year Over Year(%) must only contain numbers.');
			return;
		}

		if (product_sales_year_min!='' && product_sales_year_max!='' && Number(product_sales_year_min)>Number(product_sales_year_max))
		{
			popUpToast('warning', 'Sales Year Over Year(%) Min must be smaller than Sales Year Over Year(%) Max.');
			return;
		}

		var product_price_change_min = $('#product_price_change_min').val();
		var product_price_change_max = $('#product_price_change_max').val();
		if ( (product_price_change_min!='' && !format.test(product_price_change_min)) || (product_price_change_max!='' && !format.test(product_price_change_max)) )
		{
			popUpToast('warning', 'Price Change(%) must only contain numbers.');
			return;
		}

		if (product_price_change_min!='' && product_price_change_max!='' && Number(product_price_change_min)>Number(product_price_change_max))
		{
			popUpToast('warning', 'Price Change(%) Min must be smaller than Price Change(%) Max.');
			return;
		}

		var product_sales_change_min = $('#product_sales_change_min').val();
		var product_sales_change_max = $('#product_sales_change_max').val();
		if ( (product_sales_change_min!='' && !format.test(product_sales_change_min)) || (product_sales_change_max!='' && !format.test(product_sales_change_max)) )
		{
			popUpToast('warning', 'Sales Change(%) must only contain numbers.');
			return;
		}

		if (product_sales_change_min!='' && product_sales_change_max!='' && Number(product_sales_change_min)>Number(product_sales_change_max))
		{
			popUpToast('warning', 'Sales Change(%) Min must be smaller than Sales Change(%) Max.');
			return;
		}

		var product_sales_review_min = $('#product_sales_review_min').val();
		var product_sales_review_max = $('#product_sales_review_max').val();
		if ( (product_sales_review_min!='' && !format.test(product_sales_review_min)) || (product_sales_review_max!='' && !format.test(product_sales_review_max)) )
		{
			popUpToast('warning', 'Sales to Review must only contain numbers.');
			return;
		}

		if (product_sales_review_min!='' && Number(product_sales_review_min)<0)
		{
			popUpToast('warning', 'Sales to Reviews Min can\'t be smaller than 0.');
			return;
		}

		if (product_sales_review_min!='' && product_sales_review_max!='' && Number(product_sales_review_min)>Number(product_sales_review_max))
		{
			popUpToast('warning', 'Sales to Reviews Min must be smaller than Sales to Reviews Max.');
			return;
		}

		var product_sales_month_min = $('#product_sales_month_min').val();
		var product_sales_month_max = $('#product_sales_month_max').val();
		if ( (product_sales_month_min!='' && !format.test(product_sales_month_min)) || (product_sales_month_max!='' && !format.test(product_sales_month_max)) )
		{
			popUpToast('warning', 'Monthly Sales(Units) must only contain numbers.');
			return;
		}

		if (product_sales_month_min!='' && Number(product_sales_month_min)<0)
		{
			popUpToast('warning', 'Monthly Sales(Units) Min can\'t be smaller than 0.');
			return;
		}

		if (product_sales_month_min!='' && product_sales_month_max!='' && Number(product_sales_month_min)>Number(product_sales_month_max))
		{
			popUpToast('warning', 'RMonthly Sales(Units) Min must be smaller than Monthly Sales(Units) Max.');
			return;
		}

		var product_sales_rank_min = $('#product_sales_rank_min').val();
		var product_sales_rank_max = $('#product_sales_rank_max').val();
		if ( (product_sales_rank_min!='' && !format.test(product_sales_rank_min)) || (product_sales_rank_max!='' && !format.test(product_sales_rank_max)) )
		{
			popUpToast('warning', 'Best Sales Rank(BSR) must only contain numbers.');
			return;
		}

		if (product_sales_rank_min!='' && product_sales_rank_max!='' && Number(product_sales_rank_min)>Number(product_sales_rank_max))
		{
			popUpToast('warning', 'Best Sales Rank(BSR) Min must be smaller than Best Sales Rank(BSR) Max.');
			return;
		}

		var product_seller_num_min = $('#product_seller_num_min').val();
		var product_seller_num_max = $('#product_seller_num_max').val();
		if ( (product_seller_num_min!='' && !format.test(product_seller_num_min)) || (product_seller_num_max!='' && !format.test(product_seller_num_max)) )
		{
			popUpToast('warning', 'Number of Sellers must only contain numbers.');
			return;
		}

		if (product_seller_num_min!='' && Number(product_seller_num_min)<0)
		{
			popUpToast('warning', 'Number of Sellers Min can\'t be smaller than 0.');
			return;
		}

		if (product_seller_num_min!='' && product_seller_num_max!='' && Number(product_seller_num_min)>Number(product_seller_num_max))
		{
			popUpToast('warning', 'Number of Sellers Min must be smaller than Number of Sellers Max.');
			return;
		}

		var product_images_num_min = $('#product_images_num_min').val();
		var product_images_num_max = $('#product_images_num_max').val();
		if ( (product_images_num_min!='' && !format.test(product_images_num_min)) || (product_images_num_max!='' && !format.test(product_images_num_max)) )
		{
			popUpToast('warning', 'Number of Images must only contain numbers.');
			return;
		}

		if (product_images_num_min!='' && Number(product_images_num_min)<0)
		{
			popUpToast('warning', 'Number of Images Min can\'t be smaller than 0.');
			return;
		}

		if (product_images_num_min!='' && product_images_num_max!='' && Number(product_images_num_min)>Number(product_images_num_max))
		{
			popUpToast('warning', 'Number of Images Min must be smaller than Number of Images Max.');
			return;
		}

		var product_variation_count_min = $('#product_variation_count_min').val();
		var product_variation_count_max = $('#product_variation_count_max').val();
		if ( (product_variation_count_min!='' && !format.test(product_variation_count_min)) || (product_variation_count_max!='' && !format.test(product_variation_count_max)) )
		{
			popUpToast('warning', 'Variation Count must only contain numbers.');
			return;
		}

		if (product_variation_count_min!='' && Number(product_variation_count_min)<0)
		{
			popUpToast('warning', 'Variation Count Min can\'t be smaller than 0.');
			return;
		}

		if (product_variation_count_min!='' && product_variation_count_max!='' && Number(product_variation_count_min)>Number(product_variation_count_max))
		{
			popUpToast('warning', 'Variation Count Min must be smaller than Variation Count Max.');
			return;
		}

		var product_weight_min = $('#product_weight_min').val();
		var product_weight_max = $('#product_weight_max').val();
		if ( (product_weight_min!='' && !format.test(product_weight_min)) || (product_weight_max!='' && !format.test(product_weight_max)) )
		{
			popUpToast('warning', 'Weight(lb) must only contain numbers.');
			return;
		}

		if (product_weight_min!='' && Number(product_weight_min)<0)
		{
			popUpToast('warning', 'Weight(lb) Min can\'t be smaller than 0.');
			return;
		}

		if (product_weight_min!='' && product_weight_max!='' && Number(product_weight_min)>Number(product_weight_max))
		{
			popUpToast('warning', 'Weight(lb) Min must be smaller than Weight(lb) Max.');
			return;
		}

		var product_shipping_tier = '';
		if ($('#product_shipping_tier').val()!=null)
			product_shipping_tier = $('#product_shipping_tier').val().toString();

		var product_fulfillment = '';
		if ($('#product_fulfillment').val()!=null)
			product_fulfillment = $('#product_fulfillment').val().toString();

		var daterange_product_best_period = $('#daterange_product_best_period').val();
		var product_include_keyword = $('#product_include_keyword').val();
		var product_exclude_keyword = $('#product_exclude_keyword').val();

		var dataArr = {
				service: 'Big Data-Product',
				asin: product_asin,
				market_id: market_id,
				category_id: market_category,
				revenue_min: product_revenue_min,
				revenue_max: product_revenue_max,
				price_min: product_price_min,
				price_max: product_price_max,
				review_cnt_min: product_review_count_min,
				review_cnt_max: product_review_count_max,
				review_rating_min: product_review_rating_min,
				review_rating_max: product_review_rating_max,
				shipping_tier: product_shipping_tier,
				sales_year_min: product_sales_year_min,
				sales_year_max: product_sales_year_max,
				price_change_min: product_price_change_min,
				price_change_max: product_price_change_max,
				sales_change_min: product_sales_change_min,
				sales_change_max: product_sales_change_max,
				best_sales_period: daterange_product_best_period,
				sales_review_min: product_sales_review_min,
				sales_review_max: product_sales_review_max,
				monthly_sales_min: product_sales_month_min,
				monthly_sales_max: product_sales_month_max,
				sales_rank_min: product_sales_rank_min,
				sales_rank_max: product_sales_rank_max,
				seller_num_min: product_seller_num_min,
				seller_num_max: product_seller_num_max,
				fulfillment: product_fulfillment,
				image_num_min: product_images_num_min,
				image_num_max: product_images_num_max,
				variation_cnt_min: product_variation_count_min,
				variation_cnt_max: product_variation_count_max,
				weight_min: product_weight_min,
				weight_max: product_weight_max,
				in_keywords: product_include_keyword,
				ex_keywords: product_exclude_keyword
			};

		isStartSearch(dataArr, 'productResultView', table_bigdata_product_history);

		return false;
	});

	/*
	* Keyword***
	* */
	var multi_keyword_category;
	$(function () {

		if (isRealValue($('#keyword_shipping_tier')))
			new Choices('#keyword_shipping_tier', {removeItemButton: true});
		if (isRealValue($('#keyword_fulfillment')))
			new Choices('#keyword_fulfillment', {removeItemButton: true});
		if (isRealValue($("#keyword_market_category")))
			multi_keyword_category = new Choices("#keyword_market_category", {removeItemButton: true});
	});

	function sub_table_keyword ( d ) {

		var str_style_sales_year = '', str_sales_year='';
		if (d.others.sales_year!='')
		{
			if (Number(d.others.sales_year)<0)
			{
				str_style_sales_year = 'style="color: red;"';
				str_sales_year = '-' + (Number(d.others.sales_year)*(-1).toString()) + '%';
			}
			else if (Number(d.others.sales_year)>0)
			{
				str_style_sales_year = 'style="color: green;"';
				str_sales_year = '+' + (d.others.sales_year) + '%';
			}
		}

		var str_style_sales_trend = '', str_sales_trend='';
		if (d.others.sales_trend!='')
		{
			if (Number(d.others.sales_trend)<0)
			{
				str_style_sales_trend = 'style="color: red;"';
				str_sales_trend = '-' + (Number(d.others.sales_trend)*(-1).toString()) + '%';
			}
			else if (Number(d.others.sales_trend)>0)
			{
				str_style_sales_trend = 'style="color: green;"';
				str_sales_trend = '+' + (d.others.sales_trend) + '%';
			}
		}

		var str_style_price_trend = '', str_price_trend='';
		if (d.others.price_trend!='')
		{
			if (Number(d.others.price_trend)<0)
			{
				str_style_price_trend = 'style="color: red;"';
				str_price_trend = '-' + (Number(d.others.price_trend)*(-1).toString()) + '%';
			}
			else if (Number(d.others.price_trend)>0)
			{
				str_style_price_trend = 'style="color: green;"';
				str_price_trend = '+' + (d.others.price_trend) + '%';
			}
		}

		var div_element = $('<div class="col-md-12 col-sm-12 col-xs-12">' +
			'<div class="col-md-12 col-sm-12 col-xs-12">' +
			'<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">'+$("#txt_last_year_sales").val()+': <small class="content" >'+d.others.last_year_sales+'</small></label></div>' +
			'<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">'+$("#txt_sales_year").val()+': <small class="content" '+str_style_sales_year+'>'+str_sales_year+'</small></label></div>' +
			'<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">'+$("#txt_sales_trend").val()+': <small class="content" '+str_style_sales_trend+'>'+str_sales_trend+'</small></label></div>' +
			'<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">'+$("#txt_price_trend").val()+': <small class="content" '+str_style_price_trend+'>'+str_price_trend+'</small></label></div>' +
			'</div>' +
			'<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">' +
			'<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">'+$("#txt_best_sales").val()+': <small class="content" style="white-space: normal;">'+d.others.best_sales_period+'</small></label></div>' +
			'<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">'+$("#txt_sales_review").val()+': <small class="content" style="white-space: normal;">'+(d.others.sales_to_reviews)+'</small></label></div>' +
			'<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">'+$("#txt_broad_search_score").val()+': <small class="content" style="white-space: normal;">'+d.others.broad_reach_potential+'</small></label></div>' +
			'<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">'+$("#txt_competing_product").val()+': <small class="content" style="white-space: normal;">'+(d.others.competing_num)+'</small></label></div>' +
			'</div>' +
			'</div>'
		);
		return div_element;
	}

	var table_bigdata_keyword = $('#table_bigdata_keyword').DataTable( {
		responsive: true,
		processing: true,
		"ajax": {
			"url": base_url+"user/services/BigData/getKeywordCompletionData",
			"type": "POST",
			"data": {
				task_id: view_task_id
			}
		},
		"columns": [
			{
				"className": 'details-control',
				"orderable": false,
				"data": null,
				"defaultContent": ''
			},
			{ "data": 'product' },
			{ "data": 'search_volume' },
			{ "data": 'price' },
			{ "data": 'monthly_sales' },
			{ "data": 'monthly_revenue' },
			{ "data": 'sales_rank' },
			{ "data": 'reviews' }
		],
		columnDefs: [
			{
				targets: 1,
				render: function(data) {

					console.log(data);
					var category = data['category']!=null?data['category']:'';
					var fulfillment = data['fulfillment']!=null?data['fulfillment']:'';

					return `
                            <div style="text-align: left; margin-left: 20px; padding: 0px;">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
									<label class="control-label">`+$("#txt_keyword_phrase").val()+`:  
										<small class="content" style="white-space: normal;">
											<a href="http://www.`+data['market_url']+`/s?k=`+data['keyword']+`" class="row_asin_number"  target="_blank" style="text-decoration: underline;">`+data['keyword']+`</a>
										</small>
									</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px; margin-top: 10px;"><label class="control-label">`+$("#txt_keyword_size_tier").val()+`: <small class="content" style="white-space: normal;">`+data['size_tier']+`</small></label></div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_keyword_category").val()+`: <small class="content" style="white-space: normal;">`+category+`</small></label></div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_keyword_variation_count").val()+`: <small class="content" style="white-space: normal;">`+data['variation_cnt']+`</small></label></div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_keyword_fulfillment").val()+`: <small class="content" style="white-space: normal;">`+fulfillment+`</small></label></div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">`+$("#txt_keyword_avg_seller_cnt").val()+`: <small class="content" style="white-space: normal;">`+(data['sellers'])+`</small></label></div>
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
				targets: -1,
				type: "num-fmt",
				orderable: false,
				render: function(data) {

					var str_rating = '';
					if (data['rating']==-1)
					{
						data['rating'] = 0;
						for (var i=0; i<5; i++)
							str_rating += '<i class="fa fa-star-o" style="color: #fc8c14;"></i>';

					}
					else
					{
						var cnt = Math.round(data['rating']);

						for (var i=0; i<cnt; i++)
							str_rating += '<i class="fa fa-star" style="color: #fc8c14;"></i>';

						if (data['rating']>cnt)
						{
							cnt ++;
							str_rating += '<i class="fa fa-star-half-o" style="color: #fc8c14;"></i>';
						}

						for (var i=0; i<(5-cnt); i++)
							str_rating += '<i class="fa fa-star-o" style="color: #fc8c14;"></i>';
					}

					if (data['count']=='-1')
						data['count'] = 0;

					return `
						<div>
							<div><label>`+(data['count'])+`</label></div>
							<div>`+str_rating+`</div>
							<div><label>`+data['rating']+`</label></div>
						</div>
						`;
				}
			}
		],
		"order": [[1, 'asc']],
		"initComplete": function( settings, json ) {
			if ($('#cur_status').val() == "complete")
				$('#table_bigdata_keyword .dataTables_empty').html('<p style="color:red;">There are no results for the criteria you have entered. Try removing some criteria to get better search results.<br/>PS: Your Credits for this search has been refunded</p>');
		}
	} );

	$('#table_bigdata_keyword tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = table_bigdata_keyword.row( tr );
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
				row.child( sub_table_keyword(row.data()) ).show();
			}
			tr.addClass('shown');
		}
	} );

	var table_bigdata_keyword_history = $('#table_bigdata_keyword_history').DataTable( {
		responsive: true,
		stateSave: true,
		"ajax": {
			"url": base_url+"user/services/BigData/getKeywordHistory",
			"type": "POST"
		},
		"columns": [
			{ "data": 'no' },
			{ "data": 'market_place' },
			{ "data": 'category' },
			{ "data": 'date_searched' },
			{ "data": 'status' },
			{ "data": 'action' }
		],
		columnDefs: [
			{
				targets: 2,
				render: function (data) {
					return '<div style="white-space: normal;">'+data+'</div>';
				}
			},
			{
				targets: -1,
				orderable: false,
				render: function (data) {

					var view_url = base_url + 'services/big_data/keywordResultView/'+data['id'];

					var str_div = '<div>';
					str_div += '<a href="'+view_url+'" class="bigdata_category_view"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';

					if (data['status'] == 'complete')
						str_div += '<a href="javascript:;" d-id="'+data['id']+'" class="bigdata_category_delete"><i class="fa fa-trash" style="color: red"></i></a>';

					str_div += '</div>';

					return str_div;
				}
			}
		],
		"order": [[0, 'asc']],
		dom: 'Brtip'
	} );

	$("#table_bigdata_keyword_history tbody").on("click", ".bigdata_category_delete", function () {

		table_bigdata_keyword_history.ajax.reload();

		var task_id = $(this).attr('d-id');

		var tr = $(this).closest('tr');
		var data = table_bigdata_keyword_history.row( tr ).data();
		var status = data['status'];
		if (status=='working')
		{
			popUpToast('warning', 'You can\'t delete this current working task.');

			return;
		}

		if (!confirm('Are you sure you want to delete this?'))
			return;

		$.ajax({
			url: base_url + 'user/services/BigData/deleteKeywordHistory',
			type: 'POST',
			data: {
				id: task_id
			},
			dataType: 'text',
			async: false,
			success:
				function (data) {

					if (data == 'success')
						table_bigdata_keyword_history.ajax.reload(null, false);
				}
		});
	});

	var daterange_keyword_best_period = $('#daterange_keyword_best_period');
	if (isRealValue(daterange_keyword_best_period))
	{
		make_date_range_picker_bigdata(daterange_keyword_best_period);
	}

	//--- Change Market Place ---//
	$('#keyword_market_place').change(function () {
		var market_id = $(this).val();
		// alert(market_id);

		$.ajax({
			url: base_url + 'user/services/BigData/getMarketCategory',
			method: 'POST',
			data: {market_id: market_id},
			dataType: 'json',
			async: false,
			success: function(datas){

				multi_keyword_category.destroy();

				$.each(datas, function (i, data) {
					$('#keyword_market_category').append($('<option>', {
						value: data.value,
						text : data.label
					}));
				});

				multi_keyword_category = new Choices('#keyword_market_category', {removeItemButton: true});
			}
		});
	});

	$('#keyword_form').on('submit', function () {

		var market_id = $('#keyword_market_place').val();
		if (market_id=='')
		{
			return;
		}

		var market_category = '';
		if ($('#keyword_market_category').val()!=null)
			market_category = $('#keyword_market_category').val().toString();

		var format = /[1-9.]/;

		var keyword_revenue_min = $('#keyword_revenue_min').val();
		var keyword_revenue_max = $('#keyword_revenue_max').val();
		if ( (keyword_revenue_min!='' && !format.test(keyword_revenue_min)) || (keyword_revenue_max!='' && !format.test(keyword_revenue_max)) )
		{
			popUpToast('warning', 'Monthly Revenue must only contain numbers.');
			return;
		}

		if (keyword_revenue_min!='' && keyword_revenue_max!='' && Number(keyword_revenue_min)>Number(keyword_revenue_max))
		{
			popUpToast('warning', 'Monthly Revenue Min must be smaller than Monthly Revenue Max.');
			return;
		}

		var keyword_price_min = $('#keyword_price_min').val();
		var keyword_price_max = $('#keyword_price_max').val();
		if ( (keyword_price_min!='' && !format.test(keyword_price_min)) || (keyword_price_max!='' && !format.test(keyword_price_max)) )
		{
			popUpToast('warning', 'Price must only contain numbers.');
			return;
		}

		if (keyword_price_min!='' && keyword_price_max!='' && Number(keyword_price_min)>Number(keyword_price_max))
		{
			popUpToast('warning', 'Price Min must be smaller than Price Max.');
			return;
		}

		var keyword_review_count_min = $('#keyword_review_count_min').val();
		var keyword_review_count_max = $('#keyword_review_count_max').val();
		if ( (keyword_review_count_min!='' && !format.test(keyword_review_count_min)) || (keyword_review_count_max!='' && !format.test(keyword_review_count_max)) )
		{
			popUpToast('warning', 'Review Count must only contain numbers.');
			return;
		}

		if (keyword_review_count_min!='' && Number(keyword_review_count_min)<0)
		{
			popUpToast('warning', 'Review Count Min can\'t be smaller than 0.');
			return;
		}

		if (keyword_review_count_min!='' && keyword_review_count_max!='' && Number(keyword_review_count_min)>Number(keyword_review_count_max))
		{
			popUpToast('warning', 'Review Count Min must be smaller than Review Count Max.');
			return;
		}

		var keyword_review_rating_min = $('#keyword_review_rating_min').val();
		var keyword_review_rating_max = $('#keyword_review_rating_max').val();
		if ( (keyword_review_rating_min!='' && !format.test(keyword_review_rating_min)) || (keyword_review_rating_max!='' && !format.test(keyword_review_rating_max)) )
		{
			popUpToast('warning', 'Review Rating must only contain numbers.');
			return;
		}

		if (keyword_review_rating_min != '' && Number(keyword_review_rating_min)<0)
		{
			popUpToast('warning', 'Review Rating Min can\'t be smaller than 0.');
			return;
		}

		if (keyword_price_min!='' && keyword_review_rating_max!='' && Number(keyword_review_rating_min)>Number(keyword_review_rating_max))
		{
			popUpToast('warning', 'Review Rating Min must be smaller than Review Rating Max.');
			return;
		}

		var keyword_sales_month_min = $('#keyword_sales_month_min').val();
		var keyword_sales_month_max = $('#keyword_sales_month_max').val();
		if ( (keyword_sales_month_min!='' && !format.test(keyword_sales_month_min)) || (keyword_sales_month_max!='' && !format.test(keyword_sales_month_max)) )
		{
			popUpToast('warning', 'Monthly Sales(Units) must only contain numbers.');
			return;
		}

		if (keyword_sales_month_min!='' && Number(keyword_sales_month_min)<0)
		{
			popUpToast('warning', 'Monthly Sales(Units) Min can\'t be smaller than 0.');
			return;
		}

		if (keyword_sales_month_min!='' && keyword_sales_month_max!='' && Number(keyword_sales_month_min)>Number(keyword_sales_month_max))
		{
			popUpToast('warning', 'RMonthly Sales(Units) Min must be smaller than Monthly Sales(Units) Max.');
			return;
		}

		var keyword_sales_rank_min = $('#keyword_sales_rank_min').val();
		var keyword_sales_rank_max = $('#keyword_sales_rank_max').val();
		if ( (keyword_sales_rank_min!='' && !format.test(keyword_sales_rank_min)) || (keyword_sales_rank_max!='' && !format.test(keyword_sales_rank_max)) )
		{
			popUpToast('warning', 'Best Sales Rank(BSR) must only contain numbers.');
			return;
		}

		if (keyword_sales_rank_min!='' && keyword_sales_rank_max!='' && Number(keyword_sales_rank_min)>Number(keyword_sales_rank_max))
		{
			popUpToast('warning', 'Best Sales Rank(BSR) Min must be smaller than Best Sales Rank(BSR) Max.');
			return;
		}

		var keyword_seller_num_min = $('#keyword_seller_num_min').val();
		var keyword_seller_num_max = $('#keyword_seller_num_max').val();
		if ( (keyword_seller_num_min!='' && !format.test(keyword_seller_num_min)) || (keyword_seller_num_max!='' && !format.test(keyword_seller_num_max)) )
		{
			popUpToast('warning', 'Number of Sellers must only contain numbers.');
			return;
		}

		if (keyword_seller_num_min!='' && Number(keyword_seller_num_min)<0)
		{
			popUpToast('warning', 'Number of Sellers Min can\'t be smaller than 0.');
			return;
		}

		if (keyword_seller_num_min!='' && keyword_seller_num_max!='' && Number(keyword_seller_num_min)>Number(keyword_seller_num_max))
		{
			popUpToast('warning', 'Number of Sellers Min must be smaller than Number of Sellers Max.');
			return;
		}

		var keyword_variation_count_min = $('#keyword_variation_count_min').val();
		var keyword_variation_count_max = $('#keyword_variation_count_max').val();
		if ( (keyword_variation_count_min!='' && !format.test(keyword_variation_count_min)) || (keyword_variation_count_max!='' && !format.test(keyword_variation_count_max)) )
		{
			popUpToast('warning', 'Variation Count must only contain numbers.');
			return;
		}

		if (keyword_variation_count_min!='' && Number(keyword_variation_count_min)<0)
		{
			popUpToast('warning', 'Variation Count Min can\'t be smaller than 0.');
			return;
		}

		if (keyword_variation_count_min!='' && keyword_variation_count_max!='' && Number(keyword_variation_count_min)>Number(keyword_variation_count_max))
		{
			popUpToast('warning', 'Variation Count Min must be smaller than Variation Count Max.');
			return;
		}

		var keyword_search_volume_min = $('#keyword_search_volume_min').val();
		var keyword_search_volume_max = $('#keyword_search_volume_max').val();
		if ( (keyword_search_volume_min!='' && !format.test(keyword_search_volume_min)) || (keyword_search_volume_max!='' && !format.test(keyword_search_volume_max)) )
		{
			popUpToast('warning', 'Search Volume must only contain numbers.');
			return;
		}

		if (keyword_search_volume_min!='' && keyword_search_volume_max!='' && Number(keyword_search_volume_min)>Number(keyword_search_volume_max))
		{
			popUpToast('warning', 'Search Volume Min must be smaller than Search Volume Max.');
			return;
		}

		var keyword_competing_product_min = $('#keyword_competing_product_min').val();
		var keyword_competing_product_max = $('#keyword_competing_product_max').val();
		if ( (keyword_competing_product_min!='' && !format.test(keyword_competing_product_min)) || (keyword_competing_product_max!='' && !format.test(keyword_competing_product_max)) )
		{
			popUpToast('warning', 'Keyword Competing Product must only contain numbers.');
			return;
		}

		if (keyword_competing_product_min!='' && keyword_competing_product_max!='' && Number(keyword_competing_product_min)>Number(keyword_competing_product_max))
		{
			popUpToast('warning', 'Keyword Competing Product Min must be smaller than Keyword Competing Product Max.');
			return;
		}

		var keyword_shipping_tier = '';
		if ($('#keyword_shipping_tier').val()!=null)
			keyword_shipping_tier = $('#keyword_shipping_tier').val().toString();

		var keyword_fulfillment = '';
		if ($('#keyword_fulfillment').val()!=null)
			keyword_fulfillment = $('#keyword_fulfillment').val().toString();

		var daterange_keyword_best_period = $('#daterange_keyword_best_period').val();
		var keyword_include_keyword = $('#keyword_include_keyword').val();
		var keyword_exclude_keyword = $('#keyword_exclude_keyword').val();

		var dataArr = {
				service: 'Big Data-Keyword',
				market_id: market_id,
				category_id: market_category,
				revenue_min: keyword_revenue_min,
				revenue_max: keyword_revenue_max,
				price_min: keyword_price_min,
				price_max: keyword_price_max,
				review_cnt_min: keyword_review_count_min,
				review_cnt_max: keyword_review_count_max,
				review_rating_min: keyword_review_rating_min,
				review_rating_max: keyword_review_rating_max,
				shipping_tier: keyword_shipping_tier,
				best_sales_period: daterange_keyword_best_period,
				monthly_sales_min: keyword_sales_month_min,
				monthly_sales_max: keyword_sales_month_max,
				sales_rank_min: keyword_sales_rank_min,
				sales_rank_max: keyword_sales_rank_max,
				seller_num_min: keyword_seller_num_min,
				seller_num_max: keyword_seller_num_max,
				fulfillment: keyword_fulfillment,
				variation_cnt_min: keyword_variation_count_min,
				variation_cnt_max: keyword_variation_count_max,
				search_volume_min: keyword_search_volume_min,
				search_volume_max: keyword_search_volume_max,
				competing_product_min: keyword_competing_product_min,
				competing_product_max: keyword_competing_product_max,
				in_keywords: keyword_include_keyword,
				ex_keywords: keyword_exclude_keyword
			};

		isStartSearch(dataArr, 'keywordResultView', table_bigdata_keyword_history);

		return false;
	});

	//--- Common ---//
	setInterval(function () {

		if (table_bigdata_category_history !== 'null'){
			console.log('table_bigdata_keyword_history');

			table_bigdata_category_history.ajax.reload( null, false );
		}

		if (table_bigdata_advertising_history !== 'null'){
			console.log('table_bigdata_advertising_history');

			table_bigdata_advertising_history.ajax.reload( null, false );
		}

		if (table_bigdata_product_history !== 'null'){
			console.log('table_bigdata_product_history');

			table_bigdata_product_history.ajax.reload( null, false );
		}

		if (table_bigdata_keyword_history !== 'null'){
			console.log('table_bigdata_keyword_history');

			table_bigdata_keyword_history.ajax.reload( null, false );
		}
	}, 60000);

	function isStartSearch(dataArr, view_func, table_history) {

		$.ajax({
			url: base_url + 'user/services/bigData/isExistAlready',
			method: 'POST',
			data:{dataArr},
			dataType: 'json',
			async: false,
			success: function (data) {

				if (data['status'] == 'NO')
				{
					startSearch(dataArr, table_history);
				}
				else {
					if (data['status'] == 'complete')
					{
						var view_url = base_url+'services/big_data/'+view_func+'/'+data['task_id'];

						var $toast = popUpToast('warning', '<div>You have searched before;<br/> would you like to perform a new search or view the results of your previous search?<br/>' +
							'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id="continue_search" style="color: blue; font-weight: bold">New Search</a>' +
							'&nbsp;&nbsp;&nbsp;&nbsp;<a href="'+view_url+'" style="color: blueviolet; font-weight: bold">View Previous Result</a></div>');

						if ($toast.find('#continue_search').length) {
							$toast.delegate('#continue_search', 'click', function () {
								startSearch(dataArr, table_history);
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

	}

	function startSearch(dataArr, table_history)
	{
		$.ajax({
			url: base_url + 'user/services/bigData/startSearch',
			method: 'POST',
			data:{dataArr},
			type: 'text',
			async: false,
			success: function (data) {

				if (data == 'success')
				{
					table_history.ajax.reload();

					popUpToast('success', 'Start Searching!');

					window.setTimeout(redirectToHistory, 500);

				}
			}
		});
	}

	function  redirectToHistory()
	{
		window.location.href=base_url+'home/history';
	}

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

	function isRealValue(obj)
	{
		return obj && obj !== 'null' && obj !== 'undefined' && obj.length > 0;
	}

	function make_date_range_picker_bigdata(obj){
		obj.datepicker({
			autoclose: true,
			minViewMode: 1,
			format: 'M, yyyy'
		});
	}

});
