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

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-left panel_toolbox">
                            <h3><?= $this->lang->line('history'); ?></h3>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content2"
                                     aria-labelledby="profile-tab">
                                    <!-- start user projects -->
                                    <table class="data table table-striped no-margin" id="table_history">
                                        <thead style="background-color: #000000; color: #dedee0">
                                        <tr>
                                            <th><?= $this->lang->line('no'); ?></th>
                                            <th><?= $this->lang->line('service_type'); ?></th>
                                            <th><?= $this->lang->line('searched_input'); ?></th>
                                            <th><?= $this->lang->line('searched_date'); ?></th>
                                            <th><?= $this->lang->line('status'); ?></th>
                                            <th><?= $this->lang->line('actions'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($history_info)){
                                            $cnt=1;
                                            foreach ($history_info as $history){

                                                $view_url = 'javascript:;';
                                                if ($history['service'] == 'Big Data-Category')
                                                    $view_url = base_url().'services/big_data/categoryResultView/'.$history['id'];
                                                else if ($history['service'] == 'Big Data-Advertising')
                                                    $view_url = base_url().'services/big_data/advertisingResultView/'.$history['id'];
                                                else if ($history['service'] == 'Big Data-Product')
                                                    $view_url = base_url().'services/big_data/productResultView/'.$history['id'];
                                                else if ($history['service'] == 'Big Data-Keyword')
                                                    $view_url = base_url().'services/big_data/keywordResultView/'.$history['id'];
                                                else if ($history['service'] == 'AMZ Product Keyword Index Checker')
                                                    $view_url = base_url().'services/keyword_index_checker/resultView/'.$history['id'];
                                                ?>
                                                <tr>
                                                    <td><?= $cnt; ?></td>
                                                    <td><?= $history['service']; ?></td>
                                                    <td><?= $history['asin']; ?></td>
                                                    <td><?= $history['request_time']; ?></td>
                                                    <td><?= $history['status']; ?></td>
                                                    <td>
                                                        <a href="<?= $view_url; ?>"><i class="fa fa-eye" style="color: #1ABB9C" title="View History"></i> </a> &nbsp;
                                                        <?php if ($history['status'] == 'complete'){ ?>
                                                            <a href="javascript:void(0)"><i class="fa fa-trash history-delete" style="color:#ff7474" d-id="<?php echo $history["id"];?>" d-service="<?php echo $history["service"];?>" title="Delete History"></i> </a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php $cnt++;
                                            }
                                        } ?>
                                        </tbody>
                                    </table>
                                    <!-- end user projects -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /page content -->
