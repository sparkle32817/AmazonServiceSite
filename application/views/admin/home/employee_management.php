<style>
    table.dataTable tbody tr.selected {
        color: white !important;
        background-color: #eeeeee !important;
    }

    table#table_employee_mng{
        cursor: pointer;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile" style="min-height: 320px;">
                <div class="x_title">
                    <h2 class="col-md-8">All Employees Information</h2>
                    <div class="col-md-2">
                        <input id="daterange_employee" value="" style="float: right; width: 175px; height: 30px; padding-left: 10px;">
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="employee_new" class="btn btn-round btn-default" style="float: left;margin-left: 20px">New Employee</button>
                        <a href="javascript:;" id="file_export_employee_info" class="btn btn-round btn-default" style="float: right;margin-top: -1px;margin-right: 24px;cursor: pointer;width: 50px;">
                            <i class="fa fa-download" style=" font-size: 20px;"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="table_employee_mng" class="table table-striped table-bordered dt-responsive"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <th>Average Time</th>
                            <th>Completed Tasks</th>
                            <th>Current Status</th>
                            <th>Permissions</th>
                            <th>Enable Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_employee">
                        <?php if ($employee_all_info){
                            $cnt=0;
                            foreach ($employee_all_info as $employee_info) {
                                $cnt++;

                                $str = '';
                                if (!empty($employee_all_info['completion_avg_time'])) {
                                    $arr = explode(":", $employee_info['completion_avg_time']);

                                    $day = intval($arr[0] / 24);
                                    $h = $arr[0] - $day * 24;
                                    $min = $arr[1];
                                    $sec = $arr[2];

                                    if ($day == 1)
                                        $str .= $day . 'day ';
                                    else if ($day > 1)
                                        $str .= $day . 'days ';

                                    if ($h != 0)
                                        $str .= $h . "h ";

                                    if ($min != 0)
                                        $str .= $min . "m ";

                                    if ($sec != 0)
                                        $str .= substr($sec, 0, 4) . "s";
                                }
                                else
                                    $str = '00:00:00';

                                $completion_count='0';

                                if (!empty($employee_info['completion_count']))
                                    $completion_count = $employee_info['completion_count'];

                                ?>
                                <tr>
                                    <td><?= $cnt; ?></td>
                                    <td><?= $employee_info['name']; ?></td>
                                    <td><?= $employee_info['password']; ?></td>
                                    <td><?= $str; ?></td>
                                    <td><?= $completion_count; ?></td>
                                    <td><?= $employee_info['current_working_status']=="0"?"Idle":"Working"; ?></td>
                                    <td><?= $employee_info['service_permission']; ?></td>
                                    <td>
                                        <label id="enable_checkbox">
                                            <input type="checkbox" class="js-switch disable_check_btn" id="<?= $employee_info["id"];?>" <?= $employee_info['enable_status']?"checked":""; ?> />
                                        </label>
                                    </td>
                                    <td>
                                        <a href="<?= base_url("admin/employee_edit") ?>?id=<?php echo $employee_info["id"];?>"><i class="fa fa-edit client_edit" style="color: #1ABB9C" title="Edit Employee"></i> </a> &nbsp;
                                        <a href="javascript:void(0)"><i class="fa fa-trash employee_delete" emp_id="<?= $employee_info["current_working_status"];?>"  id="<?= $employee_info["id"];?>" style="color: #ff7474" title="Delete Employee"></i> </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile" style="min-height: 500px;">
                <div class="x_title">
                    <label><h2><strong>Employee</strong> Sessions </h2></label>
                    <a href="javascript:;" id="file_export_employee_session" class="btn btn-round btn-default" style="float: right; margin-top: -2px; margin-right: 40px; cursor: pointer;">
                        <i class="fa fa-download" style=" font-size: 20px;"></i>
                    </a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="datatable_session" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Time</th>
                            <th>Employee Name</th>
                            <th>IP Address</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="session_table_body">
                        <?php if ($employee_all_action){
                            $cnt=0;
                            foreach ($employee_all_action as $employee_action) {
                                $cnt++;
                                ?>
                                <tr>
                                    <td><?= $cnt; ?></td>
                                    <td><?= $employee_action['time']; ?></td>
                                    <td><?= $employee_action['name']; ?></td>
                                    <td><?= $employee_action['ip_address']; ?></td>
                                    <td><?= $employee_action['country']; ?></td>
                                    <td><?= $employee_action['action']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="modal_employee_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="title_employee_dialog">Create New Employee</h4>
                    <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal form-label-left" id="create_emp_form" action="javascript:;" method="post" novalidate>
                    <input type="hidden" id="edit_id" value="">
                    <div class="modal-body">
                        <div class="item form-group">
                            <label style="font-size: 14px;">Employee Name</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="emp_name" type="text" name="name" placeholder=""
                                       class="form-control col-md-7 col-xs-12" required="required" autocomplete="off">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label style="font-size: 14px;">Password</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="emp_password" type="text" name="password" placeholder=""
                                       class="form-control col-md-7 col-xs-12" required="required" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="reset" data-dismiss="modal" class="btn btn-primary" style="margin-right: 15px" >Cancel</button>
                            </div>
                            <div class="col-md-6">
                                <button id="create_employee" type="submit" class="btn btn-success" style="margin-right:
                                15px" >Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--end::Modal-->
</div>
<!-- /page content -->

