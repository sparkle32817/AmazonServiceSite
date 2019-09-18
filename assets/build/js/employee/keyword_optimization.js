$(document).ready(function () {

    var table_pending_optimization = $('#table_pending_optimization').DataTable({
		deferRender: true,
		ajax: {
			"url": base_url+"employee/SearchTermOptimization/getPendingTableInfo"
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

    var table_complete_optimization = $('#table_complete_optimization').DataTable({
		deferRender: true,
		ajax: {
			"url": base_url+"employee/SearchTermOptimization/getCompleteTableInfo"
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

	$('#table_pending_optimization tbody').on('click', 'tr', function () {

		var totalRecords =$("#table_pending_optimization").DataTable().page.info().recordsTotal;
		if (totalRecords!==0) {

			$('#task_status_optimization').removeAttr('style');

			var data = table_pending_optimization.row(this).data();

			var task_id = data['id'];
			$('#task_id_optimization').val(task_id);
			$('#task_id_optimization').text(task_id);

			$('#service_name_optimization').text(data['service']);
			$('#after_time_optimization').text('Time since submitted : ' + data[3]);
			$('#title_status_optimization').text('( ' + data['status'] + ' )');

			$('#file_export_optimization').attr('href', base_url + 'csv_export/service_keyword_index_checker_sample.csv');

			$('#table_pending_optimization tr.odd').css('background-color', '#f9f9f9');
			$('#table_pending_optimization tr.even').css('background-color', 'White');
			$(this).css('background-color', '#b0bed9');

			$('#table_complete_optimization tr.odd').css('background-color', '#f9f9f9');
			$('#table_complete_optimization tr.even').css('background-color', 'White');

			make_task_content(task_id, 'pending');
		}

	} );

	$('#table_complete_optimization tbody').on('click', 'tr', function () {

		var totalRecords =$("#table_complete_optimization").DataTable().page.info().recordsTotal;
		if (totalRecords!==0) {

			$('#task_status_optimization').removeAttr('style');

			var data = table_complete_optimization.row(this).data();
			var task_id = data['id'];

			$('#service_name').text(data['service']);
			$('#after_time').text('Completed during : ' + data[3]);
			$('#title_status').text('( ' + data['status'] + ' )');

			$('#table_complete_optimization tr.odd').css('background-color', '#f9f9f9');
			$('#table_complete_optimization tr.even').css('background-color', 'White');
			$(this).css('background-color', '#b0bed9');

			$('#table_pending_optimization tr.odd').css('background-color', '#f9f9f9');
			$('#table_pending_optimization tr.even').css('background-color', 'White');

			make_task_content(task_id, 'complete');
		}
	} );

    $(function () {
        $('#task_status_optimization').attr('style', 'display:none;');
    });

	function make_task_content(task_id, status) {

        $.ajax({
            url: base_url + 'employee/SearchTermOptimization/getTaskDetailInfo',
            type: 'POST',
            data: {
                id: task_id,
                status: status
            },
            dataType: 'json',
            async: false,
            success:
                function (data) {

                    var cur_status = data['status'];
                    if (cur_status=='pending')
                    {
                        $('#btn_start_working_optimization').attr('style', 'display: block');
                        $('#div_btn_complete_optimization').attr('style', 'display: none');
                        $('#task_status_body_completion').attr('style', 'display: none');
                    }
                    else if (cur_status=='working')
                    {
                        $('#btn_start_working_optimization').attr('style', 'display: none');
                        $('#div_btn_complete_optimization').attr('style', 'display: block; margin-top: 20px;');
                        $('#task_status_body_completion').attr('style', 'display: none');

                    }
                    else if (cur_status=='complete')
                    {
                        $('#btn_start_working_optimization').attr('style', 'display: none');
                        $('#div_btn_complete_optimization').attr('style', 'display: none');
                        $('#task_status_body_completion').attr('style', 'display: block');
                    }

                    if (data['own']=='other')
                    {
                        $('#btn_start_working_optimization').attr('style', 'display: none');
                        $('#div_btn_complete_optimization').attr('style', 'display: none');
                    }

                    $('#after_time_optimization').text(data['time']);

					$('#task_status_body_optimization').html(data['content']);
					$('#task_status_body_completion').html(data['content_completion']);
                }
        });

    }

    $('#btn_start_working_optimization').on('click', function () {

        var task_id = $('#task_id_optimization').val();
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
                        table_pending_optimization.ajax.reload(null, false);

                        $('#btn_start_working_optimization').attr('style', 'display: none');
                        $('#div_btn_complete_optimization').attr('style', 'display: block');

                        popUpToast(data, 'Working started!');
                    }
                    else if (data=='already')
                    {
                        // $('#btn_start_working_optimization').attr('style', 'display: none');

                        popUpToast('warning', 'You already started other task.\n First, please complete it.');
                    }
                    else {
                        popUpToast('warning', 'You can\'t start working now. Please try again.');
                    }
                }
        });
    });

    $('#form_task_completion_optimization').on('submit', function () {

		var task_id = $('#task_id_optimization').val().replace('Ticket', '');
		var txt_search_term = $('#key_optimization_search_term').val();
		var txt_subject1 = $('#key_optimization_subject1').val();
		var txt_subject2 = $('#key_optimization_subject2').val();
		var txt_subject3 = $('#key_optimization_subject3').val();
		var txt_subject4 = $('#key_optimization_subject4').val();
		var txt_subject5 = $('#key_optimization_subject5').val();
		var txt_keywords = $('#key_optimization_textarea').val();

		if (txt_search_term == ''
            || txt_subject1 == ''
            || txt_subject2 == ''
            || txt_subject3 == ''
            || txt_subject4 == ''
            || txt_subject5 == ''
            || txt_keywords == '')
        {
            return ;
        }

        var arr_keywords = txt_keywords.split('\n');

        $.ajax({
            type: 'POST',
            url: base_url + 'employee/SearchTermOptimization/completeTask',
            dataType: 'text',
            data: {
                task_id: task_id,
                search_term: txt_search_term,
                subject1: txt_subject1,
                subject2: txt_subject2,
                subject3: txt_subject3,
                subject4: txt_subject4,
                subject5: txt_subject5,
                keywords: arr_keywords,
            },
            success: function (response) {
                console.log(response);

                if (response == 'success') {
                    $('#div_btn_complete_optimization').attr('style', 'display: none');

                    table_pending_optimization.ajax.reload(null, false);
                    table_complete_optimization.ajax.reload(null, false);

                    make_task_content(task_id, 'complete');
                    popUpToast('success', 'Task completed!');
                } else {
                    popUpToast('warning', 'Failed, Try again!');
                }
            }
        });

		return false;
    });

	setInterval(function () {

		table_pending_optimization.ajax.reload( null, false );
		table_complete_optimization.ajax.reload( null, false );
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
