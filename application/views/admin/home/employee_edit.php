<style>
    div.item.form-group
    {
        margin-top: 50px;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;</h3>
            </div>

        </div>

        <div></div>

        <div class="clearfix"></div>

        <?php

        $str='';

        if (!empty($employee_info['complete_time'])) {
            $arr = explode(":", $employee_info['complete_time']);
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


        $str_avg_time = $str;

        ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 780px;">
                    <form class="form-horizontal form-label-left" action="javascript:;" id="form_employee_info_update" onkeydown="return event.key != 'Enter';" novalidate>
                        <div class="x_title">
                            <h2>Employee Information</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-left: -50px;">
                                    <input type="hidden" id="emp_id" value="<?= $employee_info["id"]; ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name"><?= "Name"; ?>
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input id="emp_name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="emp_name"
                                                   type="text" value="<?= $employee_info["name"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email"><?= "Password"; ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="emp_password" name="emp_password" class="form-control
                                            col-md-7
                                            col-xs-12"
                                                   value="<?= $employee_info["password"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="item form-group control-group">
                                        <div class="col-md-4"></div>
<!--                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email">--><?//= "Service Permissions"; ?><!-- <span class="required">*</span>-->
<!--                                        </label>-->
                                        <div class="col-md-8 col-sm-8 col-xs-12 form-group">
                                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-round" type="button" aria-expanded="false" style="width: 200px">
                                                Service Permission
                                                <span class="caret" style="margin-left: 20px; margin-right: -10px;"></span>
                                            </button>
                                            <ul role="menu" class="dropdown-menu">
												<?php foreach ($services as $service){?>
													<li>
														<a href="javascript:;">
															<label class ="lbl_service_permission">
																<input type="checkbox" class="js-switch service_permission_btn">&nbsp;&nbsp;&nbsp;<?= $service; ?>
															</label>
														</a>
													</li>
												<?php } ?>
                                            </ul>
                                        </div>
                                        <input type="hidden" id="service_permission_text" value="<?= $employee_info['service_permission']; ?>"/>
                                    </div>
                                    <div class="item form-group" style="margin-top: 50px;">
                                        <div class="col-md-6 col-sm-6 col-xs-12"></div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <button type="submit" class="btn btn-primary" id="employee_info_update">Update</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-left: -50px;">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email"><?= "Current Status"; ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="emp_service_permission" name="emp_service_permission"
                                                   class="form-control col-md-7 col-xs-12" value="<?= $employee_info['current_working_status']=="0"?"Idle":"Working"; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email"><?= "Complete Count"; ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" value="<?= $employee_info['complete_count']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email"><?= "Average Time";?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" value="<?= $str_avg_time; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                <table id="table_employee_history" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Ticket ID</th>
                                        <th>Client Name</th>
                                        <th>Service Name</th>
                                        <th>Request Time</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Completion Time</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($complete_all_info){
                                        $cnt=0;
                                        foreach ($complete_all_info as $complete_info) {
                                            $cnt++;
                                            ?>
                                            <tr>
                                                <td><?= 'Ticket'.$complete_info['id']; ?></td>
                                                <td><?= $complete_info['client_name']; ?></td>
                                                <td><?= $complete_info['service']; ?></td>
                                                <td><?= $complete_info['request_time']; ?></td>
                                                <td><?= $complete_info['start_time']; ?></td>
                                                <td><?= $complete_info['end_time']!=''?$complete_info['end_time']:'&nbsp;&nbsp;&nbsp;- - -'; ?></td>
                                                <td><?= $complete_info['completion_time']!=''?$complete_info['completion_time']:'&nbsp;&nbsp;&nbsp;- - -'; ?></td>
                                                <td><?= $complete_info['status']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->
