
var config = {
	type: 'line',
	data: {
		labels: [],
		datasets: [
			{
				data: [],
				label: "",
				borderColor: "#3e95cd",
				fill: false
			}
		]
	},
	options: {
		responsive: true,
		legend: {
			display: false,
			position: "right",
			labels: {
				padding: 15,
				boxWidth: 20,
				boxHeight: 30
			}
		},
		title: {
			display: true,
			text: 'Chart'
		},
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
	}
};

var myChart = null;
var ctx = document.getElementById("myChart");
if (ctx!==null)
	myChart = new Chart(ctx, config);

var config2 = {
	type: 'line',
	data: {
		labels: [],
		datasets: [
			{
				data: [],
				label: "",
				borderColor: "#3e95cd",
				fill: false
			}
		]
	},
	options: {
		responsive: true,
		legend: {
			display: false,
			position: 'right',
		},
		title: {
			display: true,
			text: 'Chart'
		},
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
	}
};

var dashboardChart;
var ctx2 = document.getElementById("dashboardChart");
if (ctx2!==null)
	dashboardChart = new Chart(ctx2, config2);

$(function () {
	var startDate = moment().subtract(6, 'days').format('YYYY-MM-DD');
	var endDate = moment().format('YYYY-MM-DD');

	if (ctx!==null)
		drawChart(startDate, endDate);

	if (ctx2!==null)
		drawChart2(startDate, endDate);

});

function isRealValue(obj)
{
	return obj && obj !== 'null' && obj !== 'undefined' && obj.length > 0;
}

drawChart = function(startDate, endDate) {

	config.data.datasets.splice(0, config.data.datasets.length);
	config.data.labels.splice(0, config.data.labels.length);

	var response='';
	$.ajax({
		url: base_url+'user/services/keywordRankTracking/getChartData',
		type: 'post',
		data: {start: startDate, end: endDate},
		dataType: 'json',
		async: false,
		success:
			function (data) {
				response = data;
			}
	});

	$.each(response.labels, function (i, val) {
		config.data.labels.push(val);
	});

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

		config.data.datasets.push(product);
	});

	myChart.update();

	var text = '';
	text += ('<ul class="' + myChart.id + '-legend">');
	for (var i = 0; i < myChart.data.datasets.length; i++) {
		text +='<li>';
		text += '<span style="background-color:' + myChart.data.datasets[i].borderColor + '"></span>';
		text += myChart.data.datasets[i].label;
		text += '</li>';
	}
	text += ('</ul>');

	$('#key_track_legend').html(text);

	$("#key_track_legend > ul > li").on("click",function(e){

		var index = $(this).index();
		$(this).toggleClass("strike");
		console.log(myChart)
		var curr = myChart.data.datasets[index]._meta[0];

		curr.hidden = !curr.hidden
		myChart.update();
	});

};

var daterange_keyword_tracking = $('#daterange_keyword_tracking');
if (isRealValue(daterange_keyword_tracking))
{
	daterange_keyword_tracking.dateRangePicker({
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

	daterange_keyword_tracking.val(moment(moment().subtract(6, 'days').toDate()).format('YYYY-MM-DD')+' ~ '+moment(moment().toDate()).format('YYYY-MM-DD'));

	daterange_keyword_tracking.on('datepicker-change',function(event,obj) {

		var startDate = moment(obj.date1).format('YYYY-MM-DD');
		var endDate = moment(obj.date2).format('YYYY-MM-DD');

		// mainChart.destroy();

		drawChart(startDate, endDate);
	});

}
//--- Dashboard ---//
drawChart2 = function(startDate, endDate) {

	config2.data.datasets.splice(0, config2.data.datasets.length);
	config2.data.labels.splice(0, config2.data.labels.length);

	var response='';
	$.ajax({
		url: base_url+'user/services/keywordRankTracking/getChartData',
		type: 'post',
		data: {start: startDate, end: endDate},
		dataType: 'json',
		async: false,
		success:
			function (data) {
				response = data;
			}
	});

	$.each(response.labels, function (i, val) {
		config2.data.labels.push(val);
	});

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

		config2.data.datasets.push(product);
	});

	dashboardChart.update();

	var text = '';
	text += ('<ul class="' + dashboardChart.id + '-legend">');
	for (var i = 0; i < dashboardChart.data.datasets.length; i++) {
		text +='<li>';
		text += '<span style="background-color:' + dashboardChart.data.datasets[i].borderColor + '"></span>';
		text += dashboardChart.data.datasets[i].label;
		text += '</li>';
	}
	text += ('</ul>');

	$('#dashboard_legend').html(text);

	$("#dashboard_legend > ul > li").on("click",function(e){

		var index = $(this).index();
		$(this).toggleClass("strike");
		console.log(dashboardChart)
		var curr = dashboardChart.data.datasets[index]._meta[0];

		curr.hidden = !curr.hidden
		dashboardChart.update();
	});

};

var daterange_dashboard = $('#daterange_dashboard');
if (isRealValue(daterange_dashboard))
{
	daterange_dashboard.dateRangePicker({
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

	daterange_dashboard.val(moment(moment().subtract(6, 'days').toDate()).format('YYYY-MM-DD')+' ~ '+moment(moment().toDate()).format('YYYY-MM-DD'));


	daterange_dashboard.on('datepicker-change',function(event,obj) {

		var startDate = moment(obj.date1).format('YYYY-MM-DD');
		var endDate = moment(obj.date2).format('YYYY-MM-DD');

		drawChart2(startDate, endDate);
	});

}
