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

    label.info-text{
        border: 1px solid #ccc;
    }

    label.letter
    {
        color: #000;
        font-size: 16px;
        font-weight: 300;
    }

    label.control-label
    {
        color: #000;
        font-size: 16px;
        font-weight: 500;
    }

    .input-box{
        border-radius: 10px;
    }

    input.input-category
    {
        width: 100%;
        height: 34px;
        font-size: 14px;
        padding-left: 3px;
        border: none;
        border-bottom: 1px solid #CCC;
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
                    <table id="table_pending_reverse_search" class="table table-striped table-bordered dt-responsive"
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
                    <table id="table_complete_reverse_search" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
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
                    <h2>Task Status<small style="font-size: 16px" id="title_status_reverse_search"></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="task_status_reverse_search" style="display: none;">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2"><h3 id="task_id_reverse_search" style="float: right;"></h3></div>
                        <div class="col-md-4"><center><h3 id="service_name_reverse_search"></h3></center></div>
                        <div class="col-md-6"><h3 id="after_time_reverse_search" style="float: left;"></h3></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" id="task_status_body_reverse_search" style="margin-top: 20px; margin-bottom: 20px ">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" id="div_btn_complete_reverse_search" style="margin-top: 20px;">
                        <form id="form_task_completion_reverse_search" action="javascript:;">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <a href="javascript:;" id="file_export_reverse_search" class="btn btn-round btn-default" style="float:right; width: 70px; margin-right: 50px; cursor: pointer;" title="Download Task Data">
                                        <i class="fa fa-download" style=" font-size: 20px;"></i>
                                    </a>
                                </div>
                                <input class="col-md-6 col-sm-6 col-xs-12" type="file" id="file_load_reverse_search" name="file_load" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="float: right;">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="col-md-2 col-sm-3">
                                    <button id="btn_finish_reverse_search" type="submit" class="btn btn-round btn-primary">Completion</button>
                                </div>
                                <div class="col-md-10 col-sm-9" style="margin-top: 5px;">
                                    <input type="checkbox" id="check_no_data" style="" value="no_data">
                                    <label class="control-label" for="check_no_data">&nbsp;&nbsp;No data</label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                        <center><button id="btn_start_working_reverse_search" type="button" class="btn btn-round btn-primary">Start Working</button></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
