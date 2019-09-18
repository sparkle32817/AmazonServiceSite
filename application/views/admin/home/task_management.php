<!-- page content -->
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile" style="min-height: 420px">
                <div class="x_title">
                    <div class="col-md-8">
                        <h2>Pending Tasks&nbsp;&nbsp;<span class="badge bg-blue" id="badge_pending" style="color: white"><?= $pending_all_info?sizeof($pending_all_info):'0'; ?></span></h2>
                    </div>
                    <div class="col-md-4">
                        <input id="daterange_task_pending" value="" style="float: right; width: 175px; height: 30px; padding-left: 10px;">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="table_pending_task_mng" class="table table-striped table-bordered dt-responsive nowrap"
                           cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Ticket ID</th>
                                <th>Client Name</th>
                                <th>Service</th>
                                <th>Submit Time</th>
                                <th>Status</th>
                                <th>Employee Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_task_pending">
                        <?php if ($pending_all_info){
                            foreach ($pending_all_info as $pending_info) {
                                ?>
                                <tr>
                                    <td><?= $pending_info['id']; ?></td>
                                    <td><?= $pending_info['client_name']; ?></td>
                                    <td><?= $pending_info['service']; ?></td>
                                    <td><?= $pending_info['after_time']; ?></td>
                                    <td><?= $pending_info['status']; ?></td>
                                    <td><?= $pending_info['employee_name']; ?></td>
                                    <td>
                                        <a href="<?= $pending_info['view_url']; ?>"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;
                                        <a href="javascript:;" e-id="<?= $pending_info['id']; ?>"  e-service="<?= $pending_info['service']; ?>"  e-status="<?= $pending_info['status']; ?>" e-employee="<?= $pending_info['employee_id']; ?>" class="edit_pending_info"><i class="fa fa-edit" style="color: blue;"></i></a>&nbsp;&nbsp;
                                        <a href="javascript:;" d-id="<?= $pending_info['id']; ?>"  d-service="<?= $pending_info['service']; ?>" d-status="<?= $pending_info['status']; ?>" class="del_pending_info"><i class="fa fa-trash" style="color: red"></i></a>
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
    </div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile" style="min-height: 420px">
                <div class="x_title">
                    <div class="col-md-8">
                        <h2>Completed Tasks&nbsp;&nbsp;<span class="badge bg-green" id="badge_complete" style="color: white"><?= $complete_all_info?sizeof($complete_all_info):'0'; ?></span></h2>
                    </div>
                    <div class="col-md-4">
                        <input id="daterange_task_completion" value="" style="float: right; width: 175px; height: 30px; padding-left: 10px;">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="table_complete_task_mng" class="table table-striped table-bordered dt-responsive nowrap"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Client Name</th>
                            <th>Service</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Completion Time</th>
                            <th>Employee Name</th>
                            <th>Status</th>
                            <th>Approved</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_task_complete">
                        <?php if ($complete_all_info){
                            foreach ($complete_all_info as $complete_info) {
                                ?>
                                <tr>
                                    <td><?= $complete_info['id']; ?></td>
                                    <td><?= $complete_info['client_name']; ?></td>
                                    <td><?= $complete_info['service']; ?></td>
                                    <td><?= $complete_info['start_time']; ?></td>
                                    <td><?= $complete_info['end_time']; ?></td>
                                    <td><?= $complete_info['completion_time']; ?></td>
                                    <td><?= $complete_info['employee_name']; ?></td>
                                    <td><?= $complete_info['status']; ?></td>
                                    <td><?= $complete_info['approved']; ?></td>
                                    <td>
                                        <a href="<?= $complete_info['view_url']; ?>"><i class="fa fa-eye" style="color: green;"></i></a>&nbsp;&nbsp;
                                        <a href="javascript:;" d-id="<?= $complete_info['id']; ?>" d-service="<?= $complete_info['service']; ?>" class="del_complete_info"><i class="fa fa-trash" style="color: red"></i></a>
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

    </div>

</div>
<!-- /page content -->

<style>

    .eidt-task-element
    {
        font-size: 16px;
    }

</style>

<!--begin::Modal Edit Task-->
<div class="modal fade" id="modal_edit_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel">Edit Keywords</h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-label-left" id="form_edit_keywords" action="javascript:;" novalidate>
                <div class="modal-body">
                    <input type="hidden" id="edit_task_id" value="">
                    <div class="item form-group">
                        <label class="control-label eidt-task-element col-md-4 col-sm-4 col-xs-12">Service Name : </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <p class="form-control eidt-task-element col-md-12 col-sm-12" id="edit_task_service_name"></p>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label eidt-task-element col-md-4 col-sm-4 col-xs-12">Status : </label>
                        <div class="eidt-task-element col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control eidt-task-element" id="edit_task_status">
                                <option value="pending">Pending</option>
                                <option value="working">Working</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label eidt-task-element col-md-4 col-sm-4 col-xs-12">Employee Name : </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control eidt-task-element" id="edit_task_employee" disabled="disabled">
                                <option value=""></option>
                                <?php foreach ($employee_infos as $employee_info){ ?>
                                <option value="<?= $employee_info['id']; ?>" cur-status="<?= $employee_info['current_working_status']; ?>"><?= $employee_info['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" style="margin-right: 40px;">
                        <div class="col-md-4">
                            <button type="reset" class="btn btn-primary" data-dismiss="modal" style="float:right;">Close</button>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button id="btn_save_edit_task" type="submit" class="btn btn-success" style="float:left;">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->
