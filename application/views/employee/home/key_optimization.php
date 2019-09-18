<style>

    table{
        cursor: pointer;
    }

    label{
        font-size: 18px;
        font-weight: 400;
        height: 35px;
        /*vertical-align: baseline;*/
    }

    label.control-label
    {
        color: #000;
        font-size: 16px;
        font-weight: 500;
    }

    input.input-optimization
    {
        width: 100%;
        height: 34px;
        font-size: 16px;
        padding-left: 3px;
        border: none;
        border-bottom: 1px solid #CCC;
    }

    textarea{
        resize: none;
        width: 400px;
        height: 350px;
    }

</style>

<!-- page content -->
<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-5 col-sm-5 col-xs-12">
            <div class="x_panel" style="min-height: 320px;">
                <div class="x_title">
                    <h2>Pending Tasks</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="table_pending_optimization" class="table table-striped table-bordered"
                           cellspacing="0" width="100%">
                        <thead style="background-color: #000000; color: #dedee0">
                        <th>Ticket ID</th>
                        <th>Client Name</th>
                        <th>Service Name</th>
                        <th>Time</th>
                        <th>Status</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="x_panel" style="min-height: 340px;">
                <div class="x_title">
                    <h2>My History</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="table_complete_optimization" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead  style="background-color: #000000; color: #dedee0">
                        <th>Ticket ID</th>
                        <th>Client Name</th>
                        <th>Service Name</th>
                        <th>Request Time</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" style="min-height: 500px;">
                <div class="x_title">
                    <h2>Task Status<small style="font-size: 16px" id="title_status_optimization"></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="task_status_optimization" style="display: none;">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2"><h3 id="task_id_optimization" style="float: right;"></h3></div>
                        <div class="col-md-4"><center><h3 id="service_name_optimization"></h3></center></div>
                        <div class="col-md-6"><h3 id="after_time_optimization" style="float: left;"></h3></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" id="task_status_body_optimization" style="margin-top: 20px; padding-bottom: 20px; border-bottom: 2px solid #46b8da;">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" id="div_btn_complete_optimization" style="margin-top: 20px;">
                        <form class="form-horizontal form-label-left" id="form_task_completion_optimization" action="javascript:;" novalidate>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Search Term : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" id="key_optimization_search_term" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Subject Matter #1 : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" id="key_optimization_subject1" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 5px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Subject Matter #2 : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" id="key_optimization_subject2" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 5px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Subject Matter #3 : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" id="key_optimization_subject3" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 5px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Subject Matter #4 : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" id="key_optimization_subject4" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 5px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Subject Matter #5 : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" id="key_optimization_subject5" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12 col-xs-12" style="padding-left: 50px;">
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                            <label class="control-label">Our Suggested Targeted Keywords</label>
                                        </div>
                                        <textarea id="key_optimization_textarea" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                                <center><button id="btn_finish_optimization" type="submit" class="btn btn-round btn-primary">Completion</button></center>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                        <center><button id="btn_start_working_optimization" type="button" class="btn btn-round btn-primary">Start Working</button></center>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" id="task_status_body_completion" style="margin-top: 20px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
