$(document).ready(function () {

    var table_key_track_pending = $('#table_key_track_pending').DataTable({
		deferRender: true,
		ajax: {
			"url": base_url+"employee/KeywordTracking/getPendingTableInfo"
		},
		columns: [
			{ data: 'id' },
			{ data: 'client_name' },
			{ data: 'service' },
			{ data: 'after_time' },
			{ data: 'status' },
		],
		rowId: 'id',
		stateSave: true,
		select: {style: 'single'},
		dom: 'Bfrtip'
    });

    var table_key_track_complete = $('#table_key_track_complete').DataTable({
		deferRender: true,
		ajax: {
			"url": base_url+"employee/KeywordTracking/getCompleteTableInfo"
		},
		columns: [
			{ data: 'id' },
			{ data: 'client_name' },
			{ data: 'service' },
			{ data: 'request_time' },
			{ data: 'start_time' },
			{ data: 'end_time' },
			{ data: 'status' },
		],
		rowId: 'id',
		stateSave: true,
		select: {style: 'single'},
		dom: 'Bfrtip'
	});

	$('#table_key_track_pending tbody').on('click', 'tr', function () {

		var totalRecords =$("#table_key_track_pending").DataTable().page.info().recordsTotal;
		if (totalRecords!==0) {

			table_key_track_complete.rows('.selected').deselect();

			$('#task_stauts').removeAttr('style');

			var data = table_key_track_pending.row(this).data();

			var task_id = data['id'];
			$('#task_id').val(task_id);

			$('#task_id').text(task_id);
			$('#service_name').text(data['service']);
			$('#after_time').text('Time since submitted : ' + data['after_time']);
			$('#title_status').text('( ' + data['status'] + ' )');

			$('#table_key_track_pending tr.odd').css('background-color', '#f9f9f9');
			$('#table_key_track_pending tr.even').css('background-color', 'White');
			$(this).css('background-color', '#b0bed9');

			$('#table_key_track_complete tr.odd').css('background-color', '#f9f9f9');
			$('#table_key_track_complete tr.even').css('background-color', 'White');

			make_task_content(task_id, 'pending');
		}

	} );

	$('#table_key_track_complete tbody').on('click', 'tr', function () {

		table_key_track_pending.rows('.selected').deselect();

		var totalRecords =$("#table_key_track_complete").DataTable().page.info().recordsTotal;
		if (totalRecords!==0) {

			$('#task_stauts').removeAttr('style');

			var data = table_key_track_complete.row(this).data();
			var task_id = data['id'];

			$('#task_id').text(task_id);
			$('#service_name').text(data['service']);
			$('#after_time').text('Completed during : ' + data['request_time']);
			$('#title_status').text('( ' + data['status'] + ' )');

			$('#table_key_track_complete tr.odd').css('background-color', '#f9f9f9');
			$('#table_key_track_complete tr.even').css('background-color', 'White');
			$(this).css('background-color', '#b0bed9');

			$('#table_key_track_pending tr.odd').css('background-color', '#f9f9f9');
			$('#table_key_track_pending tr.even').css('background-color', 'White');

			make_task_content(task_id, 'complete');
		}
	} );

    $(function () {
        $('#task_stauts').attr('style', 'display:none;');
    });

	function make_task_content(task_id, status) {

        var response='';
        $.ajax({
            url: base_url + 'employee/KeywordTracking/getTaskDetailInfo',
            type: 'POST',
            data: {
                id: task_id,
                status: status
            },
            dataType: 'json',
            async: false,
            success:
                function (data) {

                	console.log(data);

                    var cur_status = data['status'];
                    if (cur_status=='pending')
                    {
                        $('#btn_start_key_track').attr('style', 'display: block');
                        $('#div_btn_complete').attr('style', 'display: none');
                    }
                    else if (cur_status=='working')
                    {
                        $('#btn_start_key_track').attr('style', 'display: none');
                        $('#div_btn_complete').attr('style', 'display: block; margin-top: 20px;');

                    }
                    else if (cur_status=='complete')
                    {
                        $('#btn_start_key_track').attr('style', 'display: none');
                        $('#div_btn_complete').attr('style', 'display: none');
                    }

                    if (data['own']=='other')
                    {
                        $('#btn_start_key_track').attr('style', 'display: none');
                        $('#div_btn_complete').attr('style', 'display: none');
                    }

                    $('#after_time').text(data['time']);
                    
                    if (data['completable'])
					{
						$('#task_completable').val('completable');
						$('#file_export_task_data').attr('style', 'display: none');
						$('#file_load').attr('style', 'display: none');
						$('#div_check_no_data').attr('style', 'display: none');
					}
                    else
					{
						$('#file_export_task_data').attr('style', 'float:right; width: 70px; margin-right: 50px; cursor: pointer; display: block;');
						$('#file_load').attr('style', 'display: block');
						$('#div_check_no_data').attr('style', 'display: block');
					}


					$('#task_stauts_body').html(data['content']);
                }
        });

        // $('#task_stauts_body').html(response);

    }

    $('#btn_start_key_track').on('click', function () {

        var task_id = $('#task_id').val();
        $.ajax({
            url: base_url + 'employee/BigData/startTask',
            type: 'POST',
            data: {id: task_id},
            dataType: 'text',
            async: false,
            success:
                function (data) {

                    if (data=='success')
                    {
                        $('#btn_start_key_track').attr('style', 'display: none');
                        $('#div_btn_complete').attr('style', 'display: block; margin-top: 20px;');

                        popUpToast(data, 'Working started!');
                    }
                    else if (data=='already')
                    {
                        // $('#btn_start_working').attr('style', 'display: none');

                        popUpToast('warning', 'You already started other task.\n First, please complete it.');
                    }
                    else {
                        popUpToast('warning', 'You can\'t start working now. Please try again.');
                    }
                }
        });
    });

    $('#btn_finish_key_track').on('click', function () {

		var task_id = $('#task_id').val().replace('Ticket', '');
		var service_name = $('#service_name').text();
        var file_data = $('#file_load').prop('files')[0];
        var task_completable = $('#task_completable').val();

        if (task_completable=='completable')
		{

			$.ajax({
				type: 'POST',
				url: base_url + 'employee/KeywordTracking/completeDeletedTask',
				async: false,
				dataType: 'text',
				data: {task_id: task_id},
				success:function(response) {
					console.log(response);

					if (response=='success')
					{
						$('#div_btn_complete_key_checker').attr('style', 'display: none');

						$('#file_load_key_checker').val('');

						table_key_track_pending.ajax.reload( null, false );
						table_key_track_complete.ajax.reload( null, false );

						make_task_content(task_id, 'complete');
						popUpToast('success', 'Task completed!\n But this task will be completed when admin approved.');
					}
					else
					{
						popUpToast('warning', 'You can\'t complete task now. Please try again.');
					}
				}
			});

			return  false;
		}

		if ($('#check_no_data').is(':checked'))
		{
			if (!confirm('There is no searched data.'))
				return false;
			$.ajax({
				type: 'POST',
				url: base_url + 'employee/BigData/completeTaskWithoutData',
				async: false,
				dataType: 'text',
				data: {task_id: task_id},
				success:function(response) {
					console.log(response);

					if (response=='success')
					{
						$('#div_btn_complete').attr('style', 'display: none');

						$('#file_load').val('');

						table_key_track_pending.ajax.reload( null, false );
						table_key_track_complete.ajax.reload( null, false );

						make_task_content(task_id, 'complete');
						popUpToast('success', 'Task completed!\n But this task will be completed when admin approved.');
					}
					else
					{
						popUpToast('warning', 'You can\'t complete task now. Please try again.');
					}
				}
			});
		}
		else
		{
			if(file_data != undefined) {
				var form_data = new FormData();
				form_data.append('file', file_data);
				form_data.append('id', task_id);
				form_data.append('service', service_name);

				$.ajax({
					type: 'POST',
					url: base_url + 'employee/KeywordTracking/completeTask',
					contentType: false,
					processData: false,
					dataType: 'text',
					data: form_data,
					success:function(response) {
						console.log(response);

						if (response=='success')
						{
							$('#div_btn_complete').attr('style', 'display: none');

							$('#file_load').val('');

							table_key_track_pending.ajax.reload( null, false );
							table_key_track_complete.ajax.reload( null, false );

							make_task_content(task_id, 'complete');
							popUpToast('success', 'Task completed!');
						}
						else if (response=='incorrect_file')
						{
							popUpToast('warning', 'Please check file content.')
						}
						else if (response=='no_file')
						{
							popUpToast('warning', 'Please upload result csv file, to complete this task.');
						}
						else
						{
							popUpToast('warning', response);
						}
					}
				});
			}
		}

		return false;

    });
    
    $('#file_export_task_data').on('click', function () {
    	var asin_id = $('#task_id').text();
		window.location.replace(base_url+"employee/KeywordTracking/exportKeywordTrackingTaskCSVFile?asin_id="+asin_id);
	});

    setInterval(function () {

		table_key_track_pending.ajax.reload( null, false );
		table_key_track_complete.ajax.reload( null, false );
    }, 10000);

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
