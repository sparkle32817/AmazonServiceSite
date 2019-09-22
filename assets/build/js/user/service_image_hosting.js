$(document).ready(function () {

	var key_id = $('#view_keyword_id').val();		//For client view

	var table_history = $('#table_image_hosting_history').DataTable( {
		responsive: true,
		stateSave: true,
		"ajax": {
			"url": base_url+"user/services/ImageHosting/getHistory",
			"type": "POST"
		},
		"columns": [
			{ "data": 'no' },
			{ "data": 'market_place' },
			{ "data": 'sku' },
			{ "data": 'date_searched' },
			{ "data": 'action' }
		],
		columnDefs: [
			{
				targets: -1,
				orderable: false,
				render: function (data) {

					var view_url = base_url + 'services/image_hosting/resultView/'+data;

					var str_div = '<div>';
					str_div += '<a href="'+view_url+'" class="image_hosting_view"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';
					str_div += '</div>';

					return str_div;
				}
			}
		],
		"order": [[0, 'asc']],
		dom: 'Brtip'
	} );

	var minImage = 1000, maxImage = 10000;
	Dropzone.autoDiscover = false;
	if (isRealValue($('form#image_main')))
	{
		var image_main = new Dropzone('form#image_main',{
			maxFiles: 1,
			addRemoveLinks: true,
			acceptedFiles: 'image/jpeg',
			removedfile: function(file) {

				fileDelete('00-'+file.name);

				var _ref;
				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			},
			init: function() {
				this.on('resetFiles', function() {
					this.removeAllFiles();
				});
				this.on("thumbnail", function(file) {
					if (file.width < minImage || file.height < minImage) {
						file.rejectMinDimensions()
					}
					else if (file.width > maxImage || file.height > maxImage) {
						file.rejectMaxDimensions()
					}
					else {
						file.acceptDimensions();
					}
				});
			},
			accept: function(file, done) {
				file.acceptDimensions = done;
				file.rejectMinDimensions = function() { done("Images must be at least 1000 pixels on its shortest side."); };
				file.rejectMaxDimensions = function() { done("Images can’t exceed 10,000 pixels on its longest side."); };
			}
		});
	}

	if (isRealValue($('form#image_additional'))) {

		// $("#image_additional").sortable({
		// 	items: '.dz-preview',
		// 	cursor: 'move',
		// 	opacity: 0.5,
		// 	containment: '#image_additional',
		// 	distance: 20,
		// 	tolerance: 'pointer',
		// });

		// $("#image_additional").disableSelection();

		var image_additional = new Dropzone('form#image_additional', {
			maxFiles: 8,
			addRemoveLinks: true,
			acceptedFiles: 'image/jpeg',
			removedfile: function (file) {

				var _ref = file.previewElement;
				if (_ref != null)
				{
					_ref.parentNode.removeChild(file.previewElement);

					fileDelete('10-' + file.previewElement.children[0].innerText+'.jpg');

					$('#image_additional .dz-preview').each(function (index) {
						var old_name = $(this).children().first().text();
						var new_name = 'Additional Image#'+(index+1);
						if (old_name != new_name)
						{
							fileRename('10-' + old_name +'.jpg', '10-' + new_name +'.jpg');
							$(this).children().first().text('Additional Image#'+(index+1));
						}

					});
				}
			},
			renameFile: function (file) {
				var preview = document.getElementsByClassName('dz-preview');
				var this_num = preview.length;

				return 'Additional Image#'+(this_num+1)+'.jpg';
			},
			init: function () {
				this.on('addedfile', function(file){

					var preview = document.getElementsByClassName('dz-preview');
					var this_num = preview.length;
					preview = preview[this_num - 1];

					var imageName = document.createElement('span');
					imageName.innerHTML = 'Additional Image#'+this_num;

					preview.insertBefore(imageName, preview.firstChild);

				});
				this.on('resetFiles', function () {
					this.removeAllFiles();
				});
				this.on("thumbnail", function (file) {
					if (file.rejectMaxDimensions !== undefined || file.rejectMinDimensions !== undefined || file.acceptDimensions !== undefined) {
						if (file.width < minImage || file.height < minImage) {
							file.rejectMinDimensions()
						} else if (file.width > maxImage || file.height > maxImage) {
							file.rejectMaxDimensions()
						} else {
							file.acceptDimensions();
						}
					}
				});
				this.on("maxfilesexceeded", function(file) {
					this.removeFile(file);
				});
			},
			accept: function (file, done) {
				file.acceptDimensions = function(){done();}
				file.rejectMinDimensions = function () {
					done("Images must be at least 1000 pixels on its shortest side.");
				};
				file.rejectMaxDimensions = function () {
					done("Images can’t exceed 10,000 pixels on its longest side.");
				};
			}
		});
	}

	if (isRealValue($('form#image_swatch'))) {
		var image_swatch = new Dropzone('form#image_swatch', {
			maxFiles: 1,
			addRemoveLinks: true,
			acceptedFiles: 'image/jpeg',
			removedfile: function (file) {

				fileDelete('20-' + file.name);

				var _ref;
				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
			},
			init: function () {
				this.on('resetFiles', function () {
					this.removeAllFiles();
				});
				this.on("thumbnail", function (file) {
					if (file.width < minImage || file.height < minImage) {
						file.rejectMinDimensions()
					} else if (file.width > maxImage || file.height > maxImage) {
						file.rejectMaxDimensions()
					} else {
						file.acceptDimensions();
					}
				});
			},
			accept: function (file, done) {
				file.acceptDimensions = done;
				file.rejectMinDimensions = function () {
					done("Images must be at least 1000 pixels on its shortest side.");
				};
				file.rejectMaxDimensions = function () {
					done("Images can’t exceed 10,000 pixels on its longest side.");
				};
			}
		});
	}

	function fileDelete(filename) {

		$.ajax({
			type: 'POST',
			url: base_url + 'user/services/ImageHosting/deleteUploadedFile',
			data: {name: filename},
			async: false,
			success: function(data){
				console.log('success: ' + data);
			}
		});

	}

	function fileRename(old_name, new_name) {

		$.ajax({
			type: 'POST',
			url: base_url + 'user/services/ImageHosting/renameUploadedFile',
			data: {old_name: old_name, new_name: new_name},
			async: false,
			success: function(data){
				console.log('success: ' + data);
			}
		});

	}

	$('#btn_image_clear').on('click', function () {
		image_main.emit("resetFiles");
		image_additional.emit("resetFiles");
		image_swatch.emit("resetFiles");
	});

	$('#btn_image_upload').on('click', function () {

		var market_place = $('#image_market_place').val();
		var sku = $('#image_sku').val();

		if (market_place == '')
		{
			popUpToast('warning', 'Please specify marketplace.');

			return;
		}

		if (sku == '')
		{
			popUpToast('warning', 'Please specify SKU.');

			return;
		}

		var response1 = '';
		$.ajax({
			type: 'POST',
			url: base_url + 'user/services/ImageHosting/isExistUploadedFiles',
			dataType: 'text',
			async: false,
			success: function(data){
				response1 = data;
			}
		});

		if (response1 == 'main')
		{
			popUpToast('warning', 'Please upload main image.');

			return;
		}

		if (response1 == 'additional')
		{
			popUpToast('warning', 'Please upload additional images.');

			return;
		}

		if (response1 == 'swatch')
		{
			popUpToast('warning', 'Please upload swatch image.');

			return;
		}

		var response2 = '';
		$.ajax({
			type: 'POST',
			url: base_url + 'user/services/ImageHosting/isExistSkuDirectory',
			data: {sku: sku},
			async: false,
			success: function(data){
				response2 = data;
			}
		});

		if (response2 == 'true')
		{
			if (!confirm('This sku exists already.\n Are you sure you want to replace?'))
				return;
		}

		$.ajax({
			type: 'POST',
			url: base_url + 'user/services/ImageHosting/saveFiles',
			data: {market_id: market_place, sku: sku},
			dataType: 'json',
			async: false,
			success: function(data){

				if (data['status'] = 'success')
				{
					popUpToast('success', 'Successfully uploaded.');

					$('#view_images').html(data['images']);

					table_history.ajax.reload();

					image_main.emit("resetFiles");
					image_additional.emit("resetFiles");
					image_swatch.emit("resetFiles");
				}
				else
				{
					popUpToast('warning', 'Upload failed.');
				}
			}
		});
	});

// 	$('.image_btn_go').on('click', function () {
//
// 		var str_url = $(this).attr('g-id');
// 		if (str_url == '')
// 			return;
//
// 		window.open(str_url, '_blank');
// 	});
//
// 	$('.image_btn_copy').on('click', function () {
// alert(123);
// 		var str_url = $(this).attr('c-id');
//
// 		var input = $("<input>");
// 		input.val(str_url);
// 		input.select();
// 		document.execCommand("copy");
//
// 		alert('Successfully copied.');
// 	});

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
		toastr[status]( message );

		// alert(status+":"+message);
	}

	function isRealValue(obj)
	{
		return obj && obj !== 'null' && obj !== 'undefined' && obj.length > 0;
	}

});
