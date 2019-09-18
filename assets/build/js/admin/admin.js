$(document).ready(function () {

    var arr_service_permission = [];

    $(function () {

        var arr;
        if (isRealValue($("#service_permission_text")))
        {
            var str_service_permission = $("#service_permission_text").val();
            if (str_service_permission!='')
            {
                arr = str_service_permission.split(",");
            }

            jQuery.each(arr, function (i, val) {
                $(".lbl_service_permission").each(function (j, element) {

                    var str = $(this).text().trim();
                    if (val == str)
                    {
                        $(this).find("input.service_permission_btn").trigger('click');
                    }
                });
            });
        }
    });

    var table_employee = $('#table_employee_mng').DataTable();
    $('#table_employee_history').DataTable();
    $('#datatable_session').DataTable();

    $(function () {


        // var d = new Date();
        // var month = d.getMonth()+1;
        // var day = d.getDate();
        // var today = d.getFullYear() + '-' + (month<10 ? '0' : '') + month + '-' + (day<10 ? '0' : '') + day;

        // var day_before_month = getBeforeMonth();

        // export_client_info(day_before_month+' 00:00:00', today+' 23:59:59');
        // export_employee_info(day_before_month+' 00:00:00', today+' 23:59:59');
        // export_task_overview(today+' 00:00:00', today+' 23:59:59');
        // export_employee_session();

        // {
            var response="";
            $.ajax({
                url: base_url+"admin/getServiceName" ,
                type: "POST",
                data: {},
                success:
                    function(data){
                        console.log(data);
                        response = data;
                    }
            });

            //Load Service
            $('input[name="planets"]').amsifySuggestags({
                type : 'amsify',
                suggestions : ['Marketing URL Generator', 'Reserve Search', 'Related Keywords', 'Keyword Rank Tracking', 'Listing Opimization', 'Big Data', 'Image Hosting', 'FBA Replenishment Tool'],
                whiteList: true
            });
        // }
    });

    make_date_range_picker = function(obj){

        obj.dateRangePicker({
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
                        name: 'Today',
                        dates : function()
                        {
                            var start = moment().toDate();
                            var end = moment().toDate();
                            // start.setDate(1);
                            // end.setDate(30);
                            return [start,end];
                        }
                    },
                    {
                        name: 'Yesterday',
                        dates : function()
                        {
                            var start = moment().subtract(1, 'days').toDate();
                            var end = moment().subtract(1, 'days').toDate();
                            // start.setDate(1);
                            // end.setDate(30);
                            return [start,end];
                        }
                    },
                    {
                        name: 'Week to date',
                        dates : function()
                        {
                            var start = moment().subtract(6, 'days').toDate();
                            var end = moment().toDate();
                            // start.setDate(1);
                            // end.setDate(30);
                            return [start,end];
                        }
                    },
                    {
                        name: 'Month to date',
                        dates : function()
                        {
                            var start = moment().subtract(29, 'days').toDate();
                            var end = moment().toDate();
                            // start.setDate(1);
                            // end.setDate(30);
                            return [start,end];
                        }
                    },
                    {
                        name: 'Previous month',
                        dates : function()
                        {
                            var start = moment().subtract(1, "month").startOf("month").toDate();
                            var end = moment().subtract(1, "month").endOf("month").toDate();
                            // start.setDate(1);
                            // end.setDate(30);
                            return [start,end];
                        }
                    },
                    {
                        name: 'Year to date',
                        dates : function()
                        {
                            var start = moment().subtract(1, 'year').toDate();
                            var end = moment().toDate();
                            // start.setDate(1);
                            // end.setDate(30);
                            return [start,end];
                        }
                    }
                ]
            }
        );

    }

    function isRealValue(obj)
    {
        return obj && obj !== 'null' && obj !== 'undefined' && obj.length > 0;
    }

    // $(function() {

        //DateRange-Client
        var daterange_client_info = $('#daterange_client_info');
        if (isRealValue(daterange_client_info))
        {
            make_date_range_picker(daterange_client_info);
            daterange_client_info.val(moment(moment().subtract(29, 'days').toDate()).format('YYYY-MM-DD')+' ~ '+moment(moment().toDate()).format('YYYY-MM-DD'));

        }

        var daterange_client_function = $('#daterange_client_function');
        if (isRealValue(daterange_client_function))
        {
            make_date_range_picker(daterange_client_function);
            daterange_client_function.val(moment(moment().subtract(29, 'days').toDate()).format('YYYY-MM-DD')+' ~ '+moment(moment().toDate()).format('YYYY-MM-DD'));

        }

        //DateRange-Employee
        var daterange_employee = $('#daterange_employee');
        if (isRealValue(daterange_employee))
        {
            make_date_range_picker(daterange_employee);
            daterange_employee.val(moment(moment().subtract(29, 'days').toDate()).format('YYYY-MM-DD')+' ~ '+moment(moment().toDate()).format('YYYY-MM-DD'));

        }

        //DateRange-Task_Overview
        var daterange_task_overview = $('#daterange_task_overview');
        if (isRealValue(daterange_task_overview)) {
            make_date_range_picker(daterange_task_overview);
            daterange_task_overview.val(moment(moment().toDate()).format('YYYY-MM-DD') + ' ~ ' + moment(moment().toDate()).format('YYYY-MM-DD'));
        }

        //DateRange-Task_Pending
        var daterange_task_pending = $('#daterange_task_pending');
        if (isRealValue(daterange_task_pending)) {
            make_date_range_picker(daterange_task_pending);
            daterange_task_pending.val(moment(moment().toDate()).format('YYYY-MM-DD') + ' ~ ' + moment(moment().toDate()).format('YYYY-MM-DD'));
        }

        //DateRange-Task_Completion
        var daterange_task_completion = $('#daterange_task_completion');
        if (isRealValue(daterange_task_completion)) {
            make_date_range_picker(daterange_task_completion);
            daterange_task_completion.val(moment(moment().toDate()).format('YYYY-MM-DD') + ' ~ ' + moment(moment().toDate()).format('YYYY-MM-DD'));
        }
    // });

    //----- Table-Client-Management ----//
    $('#table_client_info').on('click', '.client_delete', function () {

        var del_id = $(this).attr("id");

        if (confirm("Are you sure you want to delete this client?")) {

            $.ajax({
                url: base_url+'admin/client_delete' ,
                type: 'POST',
                data: {id: del_id},
                success:
                    function(data){

                        if (data == "success")
                            location.reload();
                    }
            });
        } else {
            // Do nothing!
        }
    });

    //Edit Client
    $('#form_client_info_update').on('submit', function () {
        var client_id = $('#user_id').val();
        var membership = $('#membership_status').val();
        var cur_status = $('#current_status').val();
        var cur_credit = $('#current_credit').val();

        if (current_credit=='')
            return false;

        $.ajax({
            url: base_url+'admin/client_update' ,
            type: 'POST',
            data: {
                id: client_id,
                membership_id: membership,
                allow_status: cur_status,
                current_credit: cur_credit
            },
            success:
                function(data){

                    if (data == "success")
                        popUpToast('success', 'Successfully updated.');
                    else if (data == "fail")
                        popUpToast('warning', 'Failed. Try again.');
                }
        });
    });

    var table_client_info = false;
    var startDateClientInfo = moment(moment().subtract(29, 'days').toDate()).format('YYYY-MM-DD 00:00:00');
    var endDateClientInfo = moment().format('YYYY-MM-DD 23:59:59');
    initializeClientTable(startDateClientInfo, endDateClientInfo);

    function initializeClientTable(start, end)
    {

        if (table_client_info)
        {
            table_client_info.clear().draw();
            table_client_info.destroy();
        }

        table_client_info = $('#table_client_info').DataTable({
            responsive: true,
            "ajax": {
                "url": base_url+"admin/client_info_period",
                "type": "POST",
                "data": {
                    start_time: start,
                    end_time: end
                }
            },
            "columns": [
                { "data": 'user_name' },
                { "data": 'email' },
                { "data": 'phone_number' },
                { "data": 'market_place' },
                { "data": 'amazon_id' },
                { "data": 'invitation_code' },
                { "data": 'qq' },
                { "data": 'membership' },
                { "data": 'total_spent_amount' },
                { "data": 'part_amount' },
                { "data": 'allow_status' },
                { "data": 'current_credit' },
                { "data": 'app_status' },
                { "data": 'id' },
            ],
            columnDefs: [
                {
                    targets: 1,
                    className: 'td_email'
                },
                {
                    targets: 2,
                    className: 'td_phone'
                },
                {
                    targets: 3,
                    className: 'td_market'
                },
                {
                    targets: 4,
                    className: 'td_amazon'
                },
                {
                    targets: 5,
                    className: 'td_invitation'
                },
                {
                    targets: 6,
                    className: 'td_qq'
                },
                {
                    targets: 7,
                    className: 'td_membership'
                },
                {
                    targets: 8,
                    className: 'td_total'
                },
                {
                    targets: 9,
                    className: 'td_part'
                },
                {
                    targets: 10,
                    className: 'td_status'
                },
                {
                    targets: 11,
                    className: 'td_credits'
                },
                {
                    targets: 11,
                    className: 'td_app_status'
                },
                {
                    targets: 11,
                    className: 'td_action'
                },
                {
                    targets: -2,
                    orderable: false,
                    render: function (data) {

                        var str = "<a href=\"javascript:;\"><i class=\"fa fa-times-circle\" style=\"color: red\" title=\"No Application\"></i></a>";
                        if (data['status'] == "1")
                        {
                            str = "<a href=\""+base_url+"admin/client_view?id="+data['id']+"\"><i class=\"fa fa-eye\" style=\"color: green\" title=\"View Application\"></i></a>";
                        }

                        return `<div>`+str+`</div>`;
                    }
                },
                {
                    targets: -1,
                    orderable: false,
                    render: function (data) {

                        return `
                            <div>
                                <a href="`+base_url+`admin/client_edit?id=`+data+`"><i class="fa fa-edit client_edit" style="color: #1ABB9C" title="View Information"></i></a> &nbsp;
                                <a href="javascript:void(0)"><i class="fa fa-trash client_delete" id="`+data+`" style="color: #ff7474" title="Delete Client"></i> </a>
                            </div>
                            `;
                    }
                },
            ],
            initComplete: function() {
                check_table_hide_status();
            }
        });

    }

    $('#daterange_client_info').on('datepicker-change',function(event,obj){

        startDateClientInfo = moment(obj.date1).format('YYYY-MM-DD 00:00:00');
        endDateClientInfo = moment(obj.date2).format('YYYY-MM-DD 23:59:59');

        initializeClientTable(startDateClientInfo, endDateClientInfo);

    });

    //Export Client Info.
    $('#file_export_client').on('click', function () {
        window.location.replace(base_url+"admin/export_client_info?start="+startDateClientInfo+"&end="+endDateClientInfo);
    });

    check_table_hide_status = function(){

        $('input:checkbox').map(function () {

            if (!$(this).is(':checked')) {
                $('.td_' + $(this).attr('id').replace('btn_hide_', '')).addClass('hidden');
            }
        });
    }

    //Client Info Field Show/Hide
    $('.show_hide_btn').click(function () {

        //Do stuff
        var id = $(this).attr('id');

        if(this.checked) {
            $('.td_'+id.replace('btn_hide_', '')).removeClass('hidden');
        }
        else if (!this.checked)
        {
            $('.td_'+id.replace('btn_hide_', '')).addClass('hidden');
        }
    });

    $('#daterange_client_function').on('datepicker-change',function(event,obj){

        var client_id = $('#user_id').val();
        var startDate = moment(obj.date1).format('YYYY-MM-DD 00:00:00');
        var endDate = moment(obj.date2).format('YYYY-MM-DD 23:59:59');

        $.ajax({
            url: base_url + 'admin/client_function_period',
            type: 'POST',
            data: {
                id: client_id,
                start_time: startDate,
                end_time: endDate
            },
            dataType: 'json',
            async: false,
            success:
                function (data) {

                console.log("DATA:"+data);
                    var table_overview = $('#table_client_function').DataTable();
                    table_overview.clear().draw();
                    $.each(data, function (index, value) {
                        var table_row = table_overview.row.add(
                            [
                                index+1,
                                value['name'],
                                value['times']!=null?value['times']:"0"
                            ]
                        ).draw(false);
                    });

                    table_overview.destroy();
                }
        });

    });

    //------ Table-employee-Management ------//
    $('.disable_check_btn').click(function(e) {

        var emp_id = $(this).attr("id");

        switch_click(e, this.checked, emp_id);
    });

    switch_click = function(e, status, emp_id){

        if(status) {
            //Do stuff

            var returnVal = confirm("Are you sure(enable)?");
            // $(this).attr("checked", returnVal);

            if (returnVal)
            {
                change_enable_status(emp_id, 1);
            }
            else
            {
                e.preventDefault();
            }
        }
        else if (!status)
        {
            var returnVal = confirm("Are you sure(disable)?");

            if (returnVal)
            {
                change_enable_status(emp_id, 0);
            }
            else
            {
                e.preventDefault();
            }
        }
    };

    change_enable_status = function(id, status){

        // alert('id:'+id+', status:'+status);

        $.ajax({
            url: base_url+'admin/employee_enable_status' ,
            type: 'POST',
            data: {id: id, status: status},
            success:
                function(data){
                    // alert(data);
                    console.log('employee_enable:'+data);
                }
        });
    }


    //Edit Employee
    $('#form_employee_info_update').on('submit', function () {

        var emp_id = $('#emp_id').val();
        var emp_name = $('#emp_name').val();
        var emp_password = $('#emp_password').val();
        var emp_service_permission = arr_service_permission.toString();
        // var emp_enable = $('#emp_enable_check').val();

        if (emp_name=='' || emp_password=='' || emp_service_permission=='')
            return false;

        $.ajax({
            url: base_url+'admin/employee_update' ,
            type: 'POST',
            data: {
                id: emp_id,
                name: emp_name,
                password: emp_password,
                service_permission: emp_service_permission
            },
            success:
                function(data){

                    if (data == "success")
                        popUpToast('success', 'Successfully updated.');
                    else if (data == "fail")
                        popUpToast('warning', 'Failed. Try again.');
                }
        });
    });

    $('.service_permission_btn').click(function () {

        var txtPermission = $(this).parent().text().trim();

        if(this.checked) {
            //Do stuff
            arr_service_permission.push(txtPermission);
        }
        else if (!this.checked)
        {
            arr_service_permission.splice($.inArray(txtPermission, arr_service_permission),1);
        }
        console.log("array:"+arr_service_permission);
    });

    $('#table_employee_mng').on('click', '.employee_delete', function () {

        var del_id = $(this).attr("id");
        var emp_id = $(this).attr("emp_id");

        var query_str="Are you sure you want to delete this employee?";
        if (emp_id=="1")
            query_str="This employee is working the task now.\n So are you sure you want to delete this employee?";


        if (confirm(query_str)) {

            $.ajax({
                url: base_url+'admin/employee_delete' ,
                type: 'POST',
                data: {id: del_id},
                success:
                    function(data){

                        if (data == "success")
                            location.reload();
                    }
            });
        } else {
            // Do nothing!
        }
    });

    $('#employee_new').on('click', function () {

        $('#edit_id').val('0');
        $('#emp_name').val('');
        $('#emp_password').val('');
        $('#title_employee_dialog').text('Create New Employee');

        $('#modal_employee_add').modal('show');
    });

    $('#create_emp_form').on('submit', function () {

        var id = $("#edit_id").val();
        var name = $("#emp_name").val();
        var password = $("#emp_password").val();

        if ( name=='' || password=='' ) return false;

        var response='';

        $.ajax({
            url: base_url + 'admin/employee_create',
            type: 'POST',
            data: {
                id: id,
                name: name,
                password: password
            },
            dataType: 'text',
            async: false,
            success:
                function (data) {
                    response = data;
                }
        });

        console.log(response);

        if (response == "ok_create")
        {
            popUpToast("success", "Successfully created.");

            $('#edit_id').val('0');
            $('#emp_name').val('');
            $('#emp_password').val('');

            $('#modal_employee_add').modal('hide');

            window.location.reload();
        }
        else if (response == "ok_update")
        {
            popUpToast("success", "Successfully updated.");
            //
            // $('#edit_id').val('0');
            // $('#emp_name').val('');
            // $('#emp_password').val('');
            //
            // $('#modal_employee_add').modal('hide');

            window.location.reload();
        }
        else if (response=="already")
        {
            popUpToast("warning", "Already existed. Try again.");
        }
        else {
            popUpToast("warning", "Fail. Try again.");
        }

        return false;
    });

    var startDateEmployeeInfo = moment(moment().subtract(29, 'days').toDate()).format('YYYY-MM-DD 00:00:00');
    var endDateEmployeeInfo = moment().format('YYYY-MM-DD 23:59:59');
    $('#daterange_employee').on('datepicker-change',function(event,obj){

        startDateEmployeeInfo = moment(obj.date1).format('YYYY-MM-DD 00:00:00');
        endDateEmployeeInfo = moment(obj.date2).format('YYYY-MM-DD 23:59:59');

        make_employee_main_table(startDateEmployeeInfo, endDateEmployeeInfo);
    });

    make_employee_main_table = function(startDate, endDate)
    {

        $.ajax({
            url: base_url + 'admin/employee_period',
            type: 'POST',
            data: {
                start_time: startDate,
                end_time: endDate
            },
            dataType: 'json',
            async: false,
            success:
                function (data) {

                    var cnt=0, str_table_body='';
                    var table_employee = $('#table_employee_mng').DataTable();
                    table_employee.destroy();
                    $.each(data, function (index, value) {

                        cnt++;

                        var enable_status = '';
                        if (value['enable_status']=='1')
                            enable_status = 'checked';

                        var cur_status = 'Idle';
                        if (value['current_working_status']!="0")
                            cur_status = 'Working';

                        var service_permission = '';
                        if (value['service_permission'])
                            service_permission = value['service_permission'];

                        var completion_task = '0';
                        if (value['completion_count'])
                            completion_task = value['completion_count'];

                        str_table_body += '<tr>\n';
                        str_table_body += ' <td>'+cnt+'</td>';
                        str_table_body += ' <td>'+value['name']+'</td>';
                        str_table_body += ' <td>'+value['password']+'</td>';
                        str_table_body += ' <td>'+correct_time(value['completion_avg_time'])+'</td>';
                        str_table_body += ' <td>'+completion_task+'</td>';
                        str_table_body += ' <td>'+cur_status+'</td>';
                        str_table_body += ' <td>'+service_permission+'</td>';
                        str_table_body += ' <td>';
                        str_table_body += '    <label id="enable_checkbox">';
                        str_table_body += '        <input type="checkbox" class="js-switch disable_check_btn" id="'+value['id']+'" '+enable_status+' />';
                        str_table_body += '    </label>';
                        str_table_body += ' </td>';
                        str_table_body += ' <td>';
                        str_table_body += '    <a href="'+base_url+'admin/employee_edit?id='+value['id']+'"><i class="fa fa-edit" style="color: #1ABB9C" title="Edit Employee"></i> </a> &nbsp;';
                        str_table_body += '    <a href="javascript:void(0)"><i class="fa fa-trash employee_delete" emp_id="'+value['current_working_status']+'"  id="'+value['id']+'" style="color: #ff7474" title="Delete Employee"></i> </a>';
                        str_table_body += ' </td>';
                        str_table_body += '</tr>';
                    });

                    $('#tbody_employee').html(str_table_body);

                    if ($(".js-switch")[0]) {
                        var a = Array.prototype.slice.call(document.querySelectorAll(".js-switch"));
                        a.forEach(function (a) {
                            new Switchery(a, {color: "#26B99A"})
                        })
                    }

                    $(".disable_check_btn").off('click');
                    $(".disable_check_btn").on('click', function (e) {
                        switch_click(e);
                    });

                    $('#table_employee_mng').DataTable();
                }
        });
    }

    //Export Employee Info.
    $('#file_export_employee_info').on('click', function () {
        window.location.replace(base_url+"admin/export_employee_info?start="+startDateEmployeeInfo+"&end="+endDateEmployeeInfo);
    });

    //Export Employee Session.
    $('#file_export_employee_session').on('click', function () {

        window.location.replace(base_url+"admin/export_employee_session");
    });

    //--- Task Management ---//
    var table_pending = $('#table_pending_task_mng').DataTable();

    var table_complete = $('#table_complete_task_mng').DataTable({
        "order": [[4, 'desc']]
    });

    $('#daterange_task_pending').on('datepicker-change',function(event,obj){

        var start_time = moment(obj.date1).format('YYYY-MM-DD 00:00:00');
        var end_time = moment(obj.date2).format('YYYY-MM-DD 23:59:59');

        $.ajax({
            url: base_url + 'admin/task_pending',
            type: 'POST',
            data: {
                start_time: start_time,
                end_time: end_time
            },
            dataType: 'json',
            async: false,
            success:
                function (data) {

                    var cnt=0, str_table_body='';
                    $('#table_pending_task_mng').DataTable().destroy();
                    $.each(data, function (index, value) {
                        cnt++;

                        str_table_body += '<tr>\n';
                        str_table_body += ' <td>'+value['id']+'</td>';
                        str_table_body += ' <td>'+value['client_name']+'</td>';
                        str_table_body += ' <td>'+value['service']+'</td>';
                        str_table_body += ' <td>'+value['after_time']+'</td>';
                        str_table_body += ' <td>'+value['status']+'</td>';
                        str_table_body += ' <td>'+value['employee_name']+'</td>';
                        str_table_body += ' <td>';
                        str_table_body += '     <a href="'+value['view_url']+'"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';
                        str_table_body += '     <a href="javascript:;" e-id="'+value['id']+'" e-service="'+value['service']+'" e-status="'+value['status']+'" e-employee="'+value['employee_id']+'" class="edit_pending_info"><i class="fa fa-edit" style="color: blue;"></i></a>&nbsp;&nbsp;';
                        str_table_body += '     <a href="javascript:;" d-id="'+value['id']+'" d-service="'+value['service']+'" d-status="'+value['status']+'" class="del_pending_info"><i class="fa fa-trash" style="color: red"></i></a>';
                        str_table_body += ' </td>';
                        str_table_body += '</tr>';
                    });

                    $('#badge_pending').text(cnt);

                    $('#tbody_task_pending').html(str_table_body);
                    $('#table_pending_task_mng').DataTable();
                }

        });

    });

    $('#daterange_task_completion').on('datepicker-change',function(event,obj){

        var startDate = moment(obj.date1).format('YYYY-MM-DD 00:00:00');
        var endDate = moment(obj.date2).format('YYYY-MM-DD 23:59:59');

        $.ajax({
            url: base_url + 'admin/task_complete',
            type: 'POST',
            data: {
                start_time: startDate,
                end_time: endDate
            },
            dataType: 'json',
            async: false,
            success:
                function (data) {

                    var cnt=0, str_table_body='';
                    $('#table_complete_task_mng').DataTable().destroy();
                    $.each(data, function (index, value) {
                        cnt++;

                        str_table_body += '<tr>\n';
                        str_table_body += ' <td>'+value['id']+'</td>';
                        str_table_body += ' <td>'+value['client_name']+'</td>';
                        str_table_body += ' <td>'+value['service']+'</td>';
                        str_table_body += ' <td>'+value['start_time']+'</td>';
                        str_table_body += ' <td>'+value['end_time']+'</td>';
                        str_table_body += ' <td>'+value['completion_time']+'</td>';
                        str_table_body += ' <td>'+value['employee_name']+'</td>';
                        str_table_body += ' <td>'+value['status']+'</td>';
                        str_table_body += ' <td>'+value['approved']+'</td>';
                        str_table_body += ' <td>';
                        str_table_body += '     <a href="'+value['view_url']+'"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;';
                        str_table_body += '     <a href="javascript:;" d-id="'+value['id']+'" d-service="'+value['service']+'" class="del_complete_info"><i class="fa fa-trash" style="color: red"></i></a>';
                        str_table_body += ' </td>';
                        str_table_body += '</tr>';
                    });

                    $('#badge_complete').text(cnt);

                    $('#tbody_task_complete').html(str_table_body);
                    $('#table_complete_task_mng').DataTable({
                        "order": [[4, 'desc']]
                    });
                }
        });

    });

    $('#table_pending_task_mng').on('click', '.del_pending_info', function () {

        var task_id = $(this).attr('d-id');
        var service = $(this).attr('d-service');
        var status = $(this).attr('d-status');

        var str_msg = 'Are you sure you want to delete this task?';
        if (status == 'working')
        {
            str_msg = 'This task is in working.\n Are you sure you want to delete this?';
        }
        if (!confirm(str_msg))
            return;

        $.ajax({
            url: base_url + 'admin/TaskMng/pending_task_delete',
            type: 'POST',
            data: {
                id: task_id,
                service: service
            },
            dataType: 'text',
            async: false,
            success:
                function (data) {

                    if (data == 'success')
                    {
                        window.setTimeout(reloadPage, 100);
                    }
                }
        });

    });

    $('#table_pending_task_mng').on('click', '.edit_pending_info', function () {

        var task_id = $(this).attr('e-id');
        var status = $(this).attr('e-status');
        var employee = $(this).attr('e-employee');
        var service = $(this).attr('e-service');

        $('#edit_task_id').val(task_id);
        $("#edit_task_service_name").text(service);
        $("#edit_task_status").val(status);
        $('#edit_task_employee').val(employee);

        if (status == 'pending')
        {
            $('#edit_task_employee').prop('disabled', true);
        }
        else
        {
            $('#edit_task_employee').prop('disabled', false);
        }

        $('#modal_edit_task').modal('show');
    });

    $('#table_complete_task_mng').on('click', '.del_complete_info', function () {

        if (!confirm('Are you sure you want to delete this task?'))
            return;

        var task_id = $(this).attr('d-id');
        var service = $(this).attr('d-service');

        $.ajax({
            url: base_url + 'admin/TaskMng/complete_task_delete',
            type: 'POST',
            data: {
                id: task_id,
                service: service
            },
            dataType: 'text',
            async: false,
            success:
                function (data) {

                    if (data == 'success')
                    {
                        // $('#table_complete_task_mng').DataTable().ajax.reload(null, false);

                        window.setTimeout(reloadPage, 100);
                    }
                }
        });

    });

    $('#table_complete_task_mng').on('click', '.approve_task', function () {

        if (!confirm('Are you sure you want to approve this task?'))
            return;

        var task_id = $(this).attr('a-id');

        $.ajax({
            url: base_url + 'admin/TaskMng/approveCompletedTask',
            type: 'POST',
            data: {
                task_id: task_id
            },
            dataType: 'text',
            async: false,
            success:
                function (data) {

                    if (data == 'success')
                    {
                        window.setTimeout(reloadPage, 100);
                    }
                }
        });

    });

    $('#table_complete_task_mng').on('click', '.reject_task', function () {

        if (!confirm('Are you sure you want to reject this task?'))
            return;

        var task_id = $(this).attr('a-id');

        $.ajax({
            url: base_url + 'admin/TaskMng/rejectCompletedTask',
            type: 'POST',
            data: {
                task_id: task_id
            },
            dataType: 'text',
            async: false,
            success:
                function (data) {

                    if (data=='success')
                    {
                        popUpToast('success', 'Successfully rejected!');

                        window.setTimeout(reloadPage, 500);
                    }
                    else if (data=='reserved')
                    {
                        popUpToast('success', 'Successfully reserved!');
                        window.setTimeout(reloadPage, 500);
                    }
                    else if (data=='already_reserved')
                    {
                        // table_pending.ajax.reload();
                        popUpToast('warning', 'Already reserved!');
                    }
                    else if (data=='fail')
                    {
                        popUpToast('warning', 'Failed');
                    }
                }
        });

    });

    var startDateTaskOverview = moment().format('YYYY-MM-DD 00:00:00');
    var endDateTaskOverview = moment().format('YYYY-MM-DD 23:59:59');
    $('#daterange_task_overview').on('datepicker-change',function(event,obj){

        startDateTaskOverview = moment(obj.date1).format('YYYY-MM-DD 00:00:00');
        endDateTaskOverview = moment(obj.date2).format('YYYY-MM-DD 23:59:59');

        $.ajax({
            url: base_url + 'admin/task_over_period',
            type: 'POST',
            data: {
                start_time: startDateTaskOverview,
                end_time: endDateTaskOverview
            },
            dataType: 'json',
            async: false,
            success:
                function (data) {
                    console.log(data);
                    var table_overview = $('#table_task_overview').DataTable();
                    table_overview.clear().draw();
                    $.each(data, function (index, value) {
                        var table_row = table_overview.row.add(
                            [
                                index+1,
                                value['name'],
                                value['times']!=null?value['times']:"0"
                            ]
                        ).draw(false);
                    });

                    table_overview.destroy();
                }
        });
    });

    //Export Task Overview.
    $('#file_export_task_overview').on('click', function () {

        window.location.replace(base_url+"admin/export_task_overview?start="+startDateTaskOverview+"&end="+endDateTaskOverview);
    });

    $('#edit_task_status').on('change', function () {

        if ($(this).val()=='pending')
        {
            $('#edit_task_employee').prop('disabled', true);
            $('#edit_task_employee').val('');
        }
        else
        {
            $('#edit_task_employee').prop('disabled', false);
        }

    }).change();

    $('#btn_save_edit_task').on('click', function () {

        var task_id = $('#edit_task_id').val();
        var status = $('#edit_task_status').val();
        var employee = $('#edit_task_employee').val();

        if (status == 'working')
        {
            if (employee=='' || employee==null)
            {
                popUpToast('warning', 'Please select employee!');
                return;
            }

            var working_status = $('#edit_task_employee').find(":selected").attr('cur-status');

            if (working_status == 1)
            {
                if(!confirm('This employee is perfoming the task.\n Are you sure you want to continue?'))
                    return;
            }
        }

        $.ajax({
            url: base_url + 'admin/task_edit',
            type: 'POST',
            data: {
                task_id: task_id,
                status: status,
                employee_id: employee
            },
            dataType: 'text',
            async: false,
            success:
                function (data) {
                    if (data=='success')
                    {
                        // table_pending.ajax.reload();
                        popUpToast('success', 'Successfully saved!');
                        $('#modal_edit_task').modal('hide');
                    }
                    else if (data=='reserved')
                    {
                        // table_pending.ajax.reload();
                        popUpToast('success', 'Successfully reserved!');
                        $('#modal_edit_task').modal('hide');
                    }
                    else if (data=='already_reserved')
                    {
                        // table_pending.ajax.reload();
                        popUpToast('warning', 'Already reserved!');
                        $('#modal_edit_task').modal('hide');
                    }
                    else if (data=='fail')
                    {
                        popUpToast('warning', 'Failed');
                    }
                }
        });
    });

    var view_task_id = $('#view_task_id').val();		//For Service View
    var view_asin_id = $('#view_asin_id').val();

    function format ( d ) {

        var str_style_sales_year = '', str_sales_year='';
        if (d.others.sales_year!='0' || d.others.sales_year!='-')
        {
            str_sales_year = d.others.sales_year;
        }
        else if (d.others.sales_year!='')
        {
            if (Number(d.others.sales_year)<0)
            {
                str_style_sales_year = 'style="color: red;"';
                str_sales_year = '-' + makeComma(Number(d.others.sales_year)*(-1).toString()) + '%';
            }
            else
            {
                str_style_sales_year = 'style="color: green;"';
                str_sales_year = '+' + makeComma(d.others.sales_year) + '%';
            }
        }

        var str_style_sales_trend = '', str_sales_trend='';
        if (d.others.sales_trend!='0' || d.others.sales_trend!='-')
        {
            str_sales_trend = d.others.sales_trend;
        }
        else if (d.others.sales_trend!='')
        {
            if (Number(d.others.sales_trend)<0)
            {
                str_style_sales_trend = 'style="color: red;"';
                str_sales_trend = '-' + makeComma(Number(d.others.sales_trend)*(-1).toString()) + '%';
            }
            else
            {
                str_style_sales_trend = 'style="color: green;"';
                str_sales_trend = '+' + makeComma(d.others.sales_trend) + '%';
            }
        }

        var str_style_price_trend = '', str_price_trend='';
        if (d.others.price_trend!='0' || d.others.price_trend!='-')
        {
            str_price_trend = d.others.price_trend;
        }
        else if (d.others.price_trend!='')
        {
            if (Number(d.others.price_trend)<0)
            {
                str_style_price_trend = 'style="color: red;"';
                str_price_trend = '-' + makeComma(Number(d.others.price_trend)*(-1).toString()) + '%';
            }
            else
            {
                str_style_price_trend = 'style="color: green;"';
                str_price_trend = '+' + makeComma(d.others.price_trend) + '%';
            }
        }

        var div_element = $('<div class="col-md-12 col-sm-12 col-xs-12">' +
            '<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">Last Year Sales: <small class="content" >'+d.others.last_year_sales+'</small></label></div>'+
            '<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">Sales Year Over Year: <small class="content" '+str_style_sales_year+'>'+str_sales_year+'</small></label></div>'+
            '<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">Sales Trend(90 days): <small class="content" '+str_style_sales_trend+'>'+str_sales_trend+'</small></label></div>'+
            '<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">Price Trend(90 days): <small class="content" '+str_style_price_trend+'>'+str_price_trend+'</small></label></div>'+
            '<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">Best Sales Period: <small class="content" style="white-space: normal;">'+d.others.best_sales_period+'</small></label></div>'+
            '<div class="col-md-2 col-sm-2 col-xs-12"><label class="control-label">Sales To Reviews: <small class="content" style="white-space: normal;">'+d.others.sales_to_reviews+'</small></label></div>'+
            '</div>'
        );
        return div_element;
    }

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
                title: "ASIN",
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
                title: "PRODUCT",
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
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Title: <small class="content" style="white-space: normal;">`+title+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px; margin-top: 10px;"><label class="control-label">Category: <small class="content" style="white-space: normal;">`+category+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Brand: <small class="content" style="white-space: normal;">`+brand+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Fulfillment: <small class="content" style="white-space: normal;">`+fulfillment+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Size Tier: <small class="content" style="white-space: normal;">`+data['size_tier']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Number of Images: <small class="content" style="white-space: normal;">`+data['num_image']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Variation Count: <small class="content" style="white-space: normal;">`+data['variation_cnt']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Weight: <small class="content" style="white-space: normal;">`+str_weight+`</small></label></div>
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
                title: 'REVIEWS',
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
                title: "ASIN",
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
                title: 'PRODUCT',
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
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Title: <small class="content" style="white-space: normal;">`+title+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px; margin-top: 10px;"><label class="control-label">Category: <small class="content" style="white-space: normal;">`+category+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Brand: <small class="content" style="white-space: normal;">`+brand+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Fulfillment: <small class="content" style="white-space: normal;">`+fulfillment+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Size Tier: <small class="content" style="white-space: normal;">`+data['size_tier']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Number of Images: <small class="content" style="white-space: normal;">`+data['num_image']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Variation Count: <small class="content" style="white-space: normal;">`+data['variation_cnt']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Weight: <small class="content" style="white-space: normal;">`+str_weight+`</small></label></div>
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
                title: 'REVIEWS',
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
                title: "ASIN",
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
                title: 'PRODUCT',
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
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Title: <small class="content" style="white-space: normal;">`+title+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px; margin-top: 10px;"><label class="control-label">Category: <small class="content" style="white-space: normal;">`+category+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Brand: <small class="content" style="white-space: normal;">`+brand+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Fulfillment: <small class="content" style="white-space: normal;">`+fulfillment+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Size Tier: <small class="content" style="white-space: normal;">`+data['size_tier']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Number of Images: <small class="content" style="white-space: normal;">`+data['num_image']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Variation Count: <small class="content" style="white-space: normal;">`+data['variation_cnt']+`</small></label></div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Weight: <small class="content" style="white-space: normal;">`+str_weight+`</small></label></div>
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
                title: 'REVIEWS',
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

    var cur_status = $('#cur_status').val();
    $('#table_key_checker').DataTable( {
        responsive: true,
        processing: true,
        "ajax": {
            "url": base_url+"user/services/ProductKeywordIndexChecker/getKeywordDetailInfo",
            "type": "POST",
            "data": {
                asin_id: view_asin_id,
                status: cur_status
            }
        },
        "columns": [
            { "data": 'num' },
            { "data": 'keyword' },
            { "data": 'index1' },
            { "data": 'index2' },
            { "data": 'index3' },
            { "data": 'cumulative' },
        ],
        columnDefs: [
            {
                targets: 2,
                orderable: false,
                render: function (data, type, full, meta) {

                    var str = '<i class="fa fa-times-circle" style="font-size: 20px; color: red"></i>';
                    if (data == 'indexed')
                    {
                        str = '<i class="fa fa-check-circle" style="font-size: 20px; color: #65a035"></i>';
                    }

                    return `<div>`+str+`</div>`;
                }
            },
            {
                targets: 3,
                orderable: false,
                render: function (data, type, full, meta) {

                    var str = '<i class="fa fa-times-circle" style="font-size: 20px; color: red"></i>';
                    if (data == 'indexed')
                    {
                        str = '<i class="fa fa-check-circle" style="font-size: 20px; color: #65a035"></i>';
                    }

                    return `<div>`+str+`</div>`;
                }
            },
            {
                targets: 4,
                orderable: false,
                render: function (data, type, full, meta) {

                    var str = '<i class="fa fa-times-circle" style="font-size: 20px; color: red"></i>';
                    if (data == 'indexed')
                    {
                        str = '<i class="fa fa-check-circle" style="font-size: 20px; color: green"></i>';
                    }
                    else if (data == 'not checked')
                    {
                        str = '<i class="fa fa-minus-circle" style="font-size: 20px; color: blue"></i>';
                    }

                    return `<div>`+str+`</div>`;
                }
            },
            {
                targets: 5,
                orderable: false,
                render: function (data, type, full, meta) {

                    var str = '<i class="fa fa-times-circle" style="font-size: 20px; color: red"></i>';
                    if (data == 'indexed')
                    {
                        str = '<i class="fa fa-check-circle" style="font-size: 20px; color: #65a035"></i>';
                    }

                    return `<div>`+str+`</div>`;
                }
            }
        ],
        "order": [[0, 'asc']],
        "initComplete": function( settings, json ) {
            if ($('#cur_status').val() == "complete")
                $('#table_key_checker .dataTables_empty').html('<p style="color:red;">There are no results for the criteria you have entered. Try removing some criteria to get better search results.<br/>PS: Your Credits for this search has been refunded</p>');
        }
    } );

    function sub_table_keyword ( d ) {

        var str_style_sales_year = '', str_sales_year='';
        if (d.others.sales_year!='')
        {
            if (Number(d.others.sales_year)<0)
            {
                str_style_sales_year = 'style="color: red;"';
                str_sales_year = '-' + makeComma(Number(d.others.sales_year)*(-1).toString()) + '%';
            }
            else if (Number(d.others.sales_year)>0)
            {
                str_style_sales_year = 'style="color: green;"';
                str_sales_year = '+' + makeComma(d.others.sales_year) + '%';
            }
        }

        var str_style_sales_trend = '', str_sales_trend='';
        if (d.others.sales_trend!='')
        {
            if (Number(d.others.sales_trend)<0)
            {
                str_style_sales_trend = 'style="color: red;"';
                str_sales_trend = '-' + makeComma(Number(d.others.sales_trend)*(-1).toString()) + '%';
            }
            else if (Number(d.others.sales_trend)>0)
            {
                str_style_sales_trend = 'style="color: green;"';
                str_sales_trend = '+' + makeComma(d.others.sales_trend) + '%';
            }
        }

        var str_style_price_trend = '', str_price_trend='';
        if (d.others.price_trend!='')
        {
            if (Number(d.others.price_trend)<0)
            {
                str_style_price_trend = 'style="color: red;"';
                str_price_trend = '-' + makeComma(Number(d.others.price_trend)*(-1).toString()) + '%';
            }
            else if (Number(d.others.price_trend)>0)
            {
                str_style_price_trend = 'style="color: green;"';
                str_price_trend = '+' + makeComma(d.others.price_trend) + '%';
            }
        }

        var div_element = $('<div class="col-md-12 col-sm-12 col-xs-12">' +
            '<div class="col-md-12 col-sm-12 col-xs-12">' +
            '<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">Last Year Sales: <small class="content" >'+d.others.last_year_sales+'</small></label></div>' +
            '<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">Sales Year Over Year: <small class="content" '+str_style_sales_year+'>'+str_sales_year+'</small></label></div>' +
            '<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">Sales Trend(90 days): <small class="content" '+str_style_sales_trend+'>'+str_sales_trend+'</small></label></div>' +
            '<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">Price Trend(90 days): <small class="content" '+str_style_price_trend+'>'+str_price_trend+'</small></label></div>' +
            '</div>' +
            '<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">' +
            '<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">Best Sales Period: <small class="content" style="white-space: normal;">'+d.others.best_sales_period+'</small></label></div>' +
            '<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">Sales To Reviews: <small class="content" style="white-space: normal;">'+makeComma(d.others.sales_to_reviews)+'</small></label></div>' +
            '<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">Broad Search Score: <small class="content" style="white-space: normal;">'+d.others.broad_reach_potential+'</small></label></div>' +
            '<div class="col-md-3 col-sm-3 col-xs-12"><label class="control-label">Competing Product: <small class="content" style="white-space: normal;">'+makeComma(d.others.competing_num)+'</small></label></div>' +
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
                title: 'KEYWORD / PHRASE',
                render: function(data) {

                    console.log(data);
                    var category = data['category']!=null?data['category']:'';
                    var fulfillment = data['fulfillment']!=null?data['fulfillment']:'';

                    return `
                            <div style="text-align: left; margin-left: 20px; padding: 0px;">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
									<label class="control-label">KEYWORD / PHRASE:  
										<small class="content" style="white-space: normal;">
											<a href="http://www.`+data['market_url']+`/s?k=`+data['keyword']+`" class="row_asin_number"  target="_blank" style="text-decoration: underline;">`+data['keyword']+`</a>
										</small>
									</label>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px; margin-top: 10px;"><label class="control-label">Size Tier: <small class="content" style="white-space: normal;">`+data['size_tier']+`</small></label></div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Category: <small class="content" style="white-space: normal;">`+category+`</small></label></div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Variation Count: <small class="content" style="white-space: normal;">`+data['variation_cnt']+`</small></label></div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Fulfillment: <small class="content" style="white-space: normal;">`+fulfillment+`</small></label></div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;"><label class="control-label">Avg Sellers Count: <small class="content" style="white-space: normal;">`+(data['sellers'])+`</small></label></div>
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
                title: 'REVIEWS',
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

    //Magnet Keyword Search View
    var search_min='', search_max='', pro_min='', pro_max='', score_min='', score_max='', ex_keys='', in_keys='', match_type='';
    $('#table_magnet').DataTable( {
        responsive: true,
        processing: true,
        "ajax": {
            "url": base_url+"user/services/MagnetRelatedKeywordSearch/getDetailInfo",
            "type": "POST",
            "data": {
                keyword_id: view_task_id,
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
            if ($('#cur_status').val() == "complete")
                $('#table_magnet .dataTables_empty').html('<p style="color:red;">There are no results for the criteria you have entered. Try removing some criteria to get better search results.<br/>PS: Your Credits for this search has been refunded</p>');
        }
    } );

    //Reverse ASIN Search
    var organic_min='', organic_max='', amz_min='', amz_max='', sponsored_min='', sponsored_max='';
    $('#table_reverse_asin').DataTable( {
        responsive: true,
        processing: true,
        "ajax": {
            "url": base_url+"user/services/ReverseAsinSearch/getDetailInfo",
            "type": "POST",
            "data": {
                keyword_id: view_task_id,
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
            }
        ],
        "order": [[0, 'asc']],
        "initComplete": function( settings, json ) {
            console.log('Status::'+$('#cur_status').val());
            if ($('#cur_status').val() == "complete")
                $('#table_reverse_asin .dataTables_empty').html('<p style="color:red;">There are no results for the criteria you have entered. Try removing some criteria to get better search results.<br/>PS: Your Credits for this search has been refunded</p>');
        }
    } );

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
            url: base_url + 'admin/change_password',
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

            console.log('ok');
            $("#old_password").val('');
            $("#password").val('');
            $("#password2").val('');

            $('#m_modal_5').modal('hide');

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

    correct_time = function (time) {

        var str='';

        if (time!=null){
            var arr = time.split(":");

            var day = Math.floor(arr[0]/24);
            var h = arr[0]-day*24;
            var min = arr[1];
            var sec = arr[2];

            if (day==1)
                str += day+'day ';
            else if (day>1)
                str += day+'days ';

            if (h!=0)
                str += h+"h ";

            if (min!=0)
                str += min+"m ";

            if (sec!=0)
                str += sec+"s";

        }
        else
            str = '00:00:00';

        return str;
    }

    getBeforeMonth = function () {

        var d = new Date();
        var year = d.getFullYear();
        var month = d.getMonth();
        var day = d.getDate();

        if (day==31)
        {
            if (month==1)
            {
                year -= 1;
                month = 12;
            }
            day = 1;
        }
        else
        {
            day++;
        }

        var date = year + '-' + month + '-' + day;

        return date;
    }

    function reloadPage() {
        location.reload();
    }

});
