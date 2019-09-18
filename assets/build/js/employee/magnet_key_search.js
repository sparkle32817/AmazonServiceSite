$(document).ready(function () {

    var table_pending_magnet_search = $('#table_pending_magnet_search').DataTable({
		deferRender: true,
		ajax: {
			"url": base_url+"employee/MagnetKeySearch/getPendingTableInfo"
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

    var table_complete_magnet_search = $('#table_complete_magnet_search').DataTable({
		deferRender: true,
		ajax: {
			"url": base_url+"employee/MagnetKeySearch/getCompleteTableInfo"
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

	$('#table_pending_magnet_search tbody').on('click', 'tr', function () {

		var totalRecords =$("#table_pending_magnet_search").DataTable().page.info().recordsTotal;
		if (totalRecords!==0) {

			$('#task_status_magnet_search').removeAttr('style');

			var data = table_pending_magnet_search.row(this).data();

			var task_id = data['id'];
			$('#task_id_magnet_search').val(task_id);
			$('#task_id_magnet_search').text(task_id);

			$('#service_name_magnet_search').text(data['service']);
			$('#after_time_magnet_search').text('Time since submitted : ' + data[3]);
			$('#title_status_magnet_search').text('( ' + data['status'] + ' )');

			$('#table_pending_magnet_search tr.odd').css('background-color', '#f9f9f9');
			$('#table_pending_magnet_search tr.even').css('background-color', 'White');
			$(this).css('background-color', '#b0bed9');

			$('#table_complete_magnet_search tr.odd').css('background-color', '#f9f9f9');
			$('#table_complete_magnet_search tr.even').css('background-color', 'White');

			make_task_content(task_id, 'pending');
		}

	} );

	$('#table_complete_magnet_search tbody').on('click', 'tr', function () {

		var totalRecords =$("#table_complete_magnet_search").DataTable().page.info().recordsTotal;
		if (totalRecords!==0) {

			$('#task_status_magnet_search').removeAttr('style');

			var data = table_complete_magnet_search.row(this).data();
			var task_id = data['id'];

			$('#task_id').text(task_id);
			$('#service_name').text(data['service']);
			$('#after_time').text('Completed during : ' + data[3]);
			$('#title_status').text('( ' + data['status'] + ' )');

			$('#table_complete_magnet_search tr.odd').css('background-color', '#f9f9f9');
			$('#table_complete_magnet_search tr.even').css('background-color', 'White');
			$(this).css('background-color', '#b0bed9');

			$('#table_pending_magnet_search tr.odd').css('background-color', '#f9f9f9');
			$('#table_pending_magnet_search tr.even').css('background-color', 'White');

			make_task_content(task_id, 'complete');
		}
	} );

    $(function () {
        $('#task_status_magnet_search').attr('style', 'display:none;');
    });

	function make_task_content(task_id, status) {

        $.ajax({
            url: base_url + 'employee/MagnetKeySearch/getTaskDetailInfo',
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
                        $('#btn_start_working_magnet_search').attr('style', 'display: block');
                        $('#div_btn_complete_magnet_search').attr('style', 'display: none');
                    }
                    else if (cur_status=='working')
                    {
                        $('#btn_start_working_magnet_search').attr('style', 'display: none');
                        $('#div_btn_complete_magnet_search').attr('style', 'display: block; margin-top: 20px;');

                    }
                    else if (cur_status=='complete')
                    {
                        $('#btn_start_working_magnet_search').attr('style', 'display: none');
                        $('#div_btn_complete_magnet_search').attr('style', 'display: none');
                    }

                    if (data['own']=='other')
                    {
                        $('#btn_start_working_magnet_search').attr('style', 'display: none');
                        $('#div_btn_complete_magnet_search').attr('style', 'display: none');
                    }

                    $('#after_time_magnet_search').text(data['time']);

					$('#task_status_body_magnet_search').html(data['content']);
                }
        });

    }

    $('#btn_start_working_magnet_search').on('click', function () {

        var task_id = $('#task_id_magnet_search').val();
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
                        $('#btn_start_working_magnet_search').attr('style', 'display: none');
                        $('#div_btn_complete_magnet_search').attr('style', 'display: block');

                        popUpToast(data, 'Working started!');
                    }
                    else if (data=='already')
                    {
                        // $('#btn_start_working_magnet_search').attr('style', 'display: none');

                        popUpToast('warning', 'You already started other task.\n First, please complete it.');
                    }
                    else {
                        popUpToast('warning', 'You can\'t start working now. Please try again.');
                    }
                }
        });
    });

    $('#btn_finish_magnet_search').on('click', function () {

		var task_id = $('#task_id_magnet_search').val().replace('Ticket', '');
		var service_name = $('#service_name_magnet_search').text();
        var file_data = $('#file_load_magnet_search').prop('files')[0];

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
                        $('#div_btn_complete_magnet_search').attr('style', 'display: none');

                        $('#file_load_magnet_search').val('');

                        table_pending_magnet_search.ajax.reload( null, false );
                        table_complete_magnet_search.ajax.reload( null, false );

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
            if (file_data != undefined) {
                var form_data = new FormData();
                form_data.append('file', file_data);
                form_data.append('id', task_id);
                form_data.append('service', service_name);

                $.ajax({
                    type: 'POST',
                    url: base_url + 'employee/MagnetKeySearch/completeTask',
                    contentType: false,
                    processData: false,
                    dataType: 'text',
                    data: form_data,
                    success: function (response) {
                        console.log(response);

                        if (response == 'success') {
                            $('#div_btn_complete_magnet_search').attr('style', 'display: none');

                            $('#file_load_magnet_search').val('');

                            table_pending_magnet_search.ajax.reload(null, false);
                            table_complete_magnet_search.ajax.reload(null, false);

                            make_task_content(task_id, 'complete');
                            popUpToast('success', 'Task completed!');
                        }  else if (response == 'no_file') {
                            popUpToast('warning', 'Please upload result csv file, to complete this task.');
                        } else {
                            popUpToast('warning', response);
                            // popUpToast('warning', 'You can\'t complete task now. Please try again.');
                        }
                    }
                });
            }
        }
		return false;

    });

    $('#file_export_magnet_search').on('click', function () {
        var task_id = $('#task_id_magnet_search').val();
        window.location.replace(base_url+"employee/MagnetKeySearch/exportMagnetSearchTaskCSVFile?task_id="+task_id);
    });

	setInterval(function () {

		table_pending_magnet_search.ajax.reload( null, false );
		table_complete_magnet_search.ajax.reload( null, false );
	}, 10000);

    //--- Change Password---//
    $('#pass_change_form').on('submit', function () {

        var username = $("#user_name").val();
        var old = $("#old_password").val();
        var new_pass = $("#password").val();
        var confirm_pass = $("#password2").val();

        if (old==new_pass)
        {
            return false;
        }
        if (new_pass!=confirm_pass)
            return false;

        var response='';
        $.ajax({
            url: base_url + 'employee/password_update',
            type: 'POST',
            data: {
                user_name: username,
                old_password: old,
                password: new_pass
            },
            dataType: 'text',
            async: false,
            success:
                function (data) {
                    response = data;
                }
        });

        if (response == "ok")
        {
            popUpToast("success", "Successfully updated.");

            $("#old_password").val('');
            $("#password").val('');
            $("#password2").val('');

            $('#change_pass_employee').modal('hide');

        }
        else {
            popUpToast("warning", "Current password is wrong. Try again.");
        }

        return false;
    });

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
