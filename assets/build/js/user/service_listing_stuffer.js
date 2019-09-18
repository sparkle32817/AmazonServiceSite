$(document).ready(function () {

	var wordArr, phraseArr, txt_list, market_id;
	var table_listing_stuffer_history = $('#table_listing_stuffer_history').DataTable( {
		responsive: true,
		stateSave: true,
		"ajax": {
			"url": base_url+"user/services/ListingKeywordStuffer/getHistory",
			"type": "POST"
		},
		"columns": [
			{ "data": 'no' },
			{ "data": 'market_place' },
			{ "data": 'keywords' },
			{ "data": 'date_searched' },
			{ "data": 'action' }
		],
		columnDefs: [
			{
				targets: -1,
				orderable: false,
				render: function (data, type, full, meta) {

					var view_url = base_url + 'services/listing_stuffer/resultView/'+data;

					var str_div = '<div>';
					str_div += '<a href="'+view_url+'"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';
					str_div += '<a href="javascript:;" d-id="'+data+'" class="listing_stuffer_delete"><i class="fa fa-trash" style="color: red"></i></a>';
					str_div += '</div>';

					return str_div;
				}
			}
		],
		"order": [[0, 'asc']],
		dom: 'Brtip'
	} );

	$("#table_listing_stuffer_history tbody").on("click", ".listing_stuffer_delete", function () {

		var id = $(this).attr('d-id');

		var tr = $(this).closest('tr');
		var data = table_listing_stuffer_history.row( tr ).data();

		if (!confirm('Are you sure you want to delete this?'))
			return;

		$.ajax({
			url: base_url + 'user/services/ListingKeywordStuffer/deleteHistory',
			type: 'POST',
			data: {
				id: id
			},
			dataType: 'json',
			async: false,
			success:
				function (data) {

					if (data['status'] == 'success')
					{
						getWords();

						var cur_keywords = '';
						if (data['cur_keywords'] != null)
							cur_keywords = data['cur_keywords'];
						$('#stuffer_textarea').val(cur_keywords.split(',').join('\n'));
						txt_list = $('#stuffer_textarea').val();

						table_listing_stuffer_history.ajax.reload(null, false);
					}
				}
		});
	});

	var area_word = $('#scroller-div-area-word');
	var area_phrase = $('#scroller-div-area-phrase');
	if (isRealValue(area_word))
		getWords();

	var scroller1 = document.querySelector('#scroller-div-area-word');
	if (scroller1 != null)
		new PerfectScrollbar(scroller1);

	var scroller2 = document.querySelector('#scroller-div-area-phrase');
	if (scroller2 != null)
		new PerfectScrollbar(scroller2);

	$('#form_stuffer').on('submit', function () {

		var market_id = $('#stuffer_market_place').val();
		var txt_keywords = $('#stuffer_textarea').val();

		if (market_id == '' || txt_keywords == '')
			return;

		var format = /[!@#$%^&*()_+\=\[\]{};':"\\|,.<>\/?]/;

		if (format.test(txt_keywords))
		{
			popUpToast('warning', 'Don\'t input special characters.');
			return;
		}

		var arr_keywords = txt_keywords.split('\n');

		$.ajax({
			url: base_url + 'user/services/ListingKeywordStuffer/saveKeywords',
			method: 'POST',
			data:{
				market_id: market_id,
				keywords: arr_keywords
			},
			dataType: 'text',
			async: false,
			success: function (data) {

				if (data == 'success')
				{
					popUpToast('success', 'Successfully saved!');

					$('#div_input_keywords').css('display', 'none');
					$('#div_display_keywords').css('display', 'block');
					$('#btn_stuffer_cancel').css('display', 'block');

					getWords();

					table_listing_stuffer_history.ajax.reload(null, false);
				}
			}
		});

		return false;
	});

	function getWords() {

		$.ajax({
			url: base_url + 'user/services/ListingKeywordStuffer/getWords',
			dataType: 'json',
			async: false,
			success: function (datas) {

				var arr1 = [], arr2 = [];
				var str_content1 = "", str_content2="";
				$.each(datas, function (i, data) {

					var sup_id = "word_"+data.word.split(' ').join('_');
					var style_id = "style_"+data.word.split(' ').join('_');
					var color_id = "color_"+data.word.split(' ').join('_');
					if (data.word.includes(' '))
					{
						arr2.push(data.word);
						str_content2 += '<span id="'+color_id+'" style="color: #0b48ff;"><bold id="'+style_id+'" style="font-size: 14px;">'+data.word+'</bold><sup id="'+sup_id+'"></sup></span><span style="color: rgba(0,0,0,0.8);">&nbsp;&#9679;&nbsp;</span>';
					}
					else
					{
						arr1.push(data.word);
						str_content1 += '<span id="'+color_id+'" style="color: #0b48ff;"><bold id="'+style_id+'" style="font-size: 14px;">'+data.word+'</bold><sup id="'+sup_id+'"></sup></span><span style="color: rgba(0,0,0,0.8);">&nbsp;&#9679;&nbsp;</span>';
					}
				});

				area_word.html(str_content1);
				$('#area_edit_word').html(arr1.join('&#13;&#10;'));

				area_phrase.html(str_content2);
				$('#area_edit_phrase').html(arr2.join('&#13;&#10;'));

				wordArr = arr1;
				phraseArr = arr2;

				$('#word_total_cnt').text(arr1.length);
				$('#phrase_total_cnt').text(arr2.length);
			}
		});

	}

	$('#btn_stuffer_cancel').on('click', function () {
		$('#div_input_keywords').css('display', 'none');
		$('#div_display_keywords').css('display', 'block');

		$('#stuffer_market_place').val(market_id);
		$('#stuffer_textarea').val(txt_list);
	});

	$('#words_list_edit').on('click', function () {
		$('#div_input_keywords').css('display', 'block');
		$('#div_display_keywords').css('display', 'none');

		market_id = $('#stuffer_market_place').val();
		txt_list = $('#stuffer_textarea').val();
	});

	var areaArr = new Array(13).fill('');
	$("textarea.textarea-listing-stuffer").keyup(function (event) {

		areaArr[$(this).attr('e-id')] = $(this).val();

		$('#word_cross_cnt').text(processWord(wordArr));
		$('#phrase_cross_cnt').text(processWord(phraseArr));

		$(this).parent().parent().find('.textarea-letter-count').text($(this).val().length);

		var word_num=0;
		if ($(this).val()!='')
			word_num = $(this).val().trim().split(/[\s\.,;]+/).length;
		$(this).parent().parent().find('.textarea-word-count').text(word_num);

	});

	function processWord(arr) {

		var used_cnt=0;
		for (var i=0; i<arr.length; i++)
		{
			var cnt=0
			for (var j=0; j<areaArr.length; j++)
			{
				cnt += areaArr[j].split(arr[i]).length - 1;
			}

			if (cnt>0)
			{
				$('#color_'+arr[i].split(' ').join('_')).attr('style', 'color: #b4abff');
				$('#style_'+arr[i].split(' ').join('_')).attr('style', 'font-size: 14px; text-decoration: line-through;');
				$('#word_'+arr[i].split(' ').join('_')).text(cnt);

				used_cnt++;
			}
			else
			{
				$('#color_'+arr[i].split(' ').join('_')).attr('style', 'color: #0b48ff');
				$('#style_'+arr[i].split(' ').join('_')).attr('style', 'font-size: 14px;');
				$('#word_'+arr[i].split(' ').join('_')).text('');

			}
		}

		return used_cnt;
	}

	$('.copy_textarea').on('click', function () {
		$(this).parent().parent().find('.textarea-listing-stuffer').select();
		document.execCommand('copy');
	});

	$('.all_upper').on('click', function () {
		var textarea = $(this).parent().parent().find('.textarea-listing-stuffer');
		textarea.val(textarea.val().toUpperCase());
	});

	$('.all_lower').on('click', function () {
		var textarea = $(this).parent().parent().find('.textarea-listing-stuffer');
		textarea.val(textarea.val().toLowerCase());
	});

	$('.first_upper').on('click', function () {
		var textarea = $(this).parent().parent().find('.textarea-listing-stuffer');
		var str = textarea.val();
		// textarea.val(str.charAt(0).toUpperCase() + str.substring(1));
		textarea.val(str.replace(/^\w/, c => c.toUpperCase()));
	});

	function isRealValue(obj)
	{
		return obj && obj !== 'null' && obj !== 'undefined' && obj.length > 0;
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
		toastr[status]( message );
	}

});