<!-- page content -->
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel tile" style="min-height: 420px">
                <div class="x_title">
                    <div class="col-md-8">
                        <h2>Tasks Overview</h2>
                    </div>
                    <div class="col-md-3">
                        <input id="daterange_task_overview" value="" style="float: right; width: 175px; height: 30px; padding-left: 10px;">
                    </div>
                    <a href="javascript:;" id="file_export_task_overview" class="btn btn-round btn-default" style="float: right; margin-top: -2px; margin-right: 40px; cursor: pointer;">
                        <i class="fa fa-download" style=" font-size: 20px;"></i>
                    </a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table id="table_task_overview" class="table table-striped table-bordered dt-responsive nowrap"
                           cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Service ID</th>
                                <th>Service Name</th>
                                <th>Used Times</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if ($service_times_info){
                            $cnt=0;
                            foreach ($service_times_info as $service_info) {
                                $cnt++;
                                ?>
                                <tr>
                                    <td><?= $cnt; ?></td>
                                    <td><?= $service_info['name']; ?></td>
                                    <td><?= !empty($service_info['times'])?$service_info['times']:"0"; ?></td>
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
