<style>
    .wrapper {
        max-width: 800px;
        margin: 50px auto;
    }

    th, td{
        text-align: center;
        padding: 10px;
        font-size: 15px;
    }

    .table > tbody > tr > td{
        vertical-align: middle;
    }

    small{
        font-size: 10px;
        color: #3498DB;
    }

    td.details-control {
        background: url('../assets/images/details_open.png') no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('../assets/images/details_close.png') no-repeat center center;
    }

    .dropdown-menu > li > a {
        /*color: #000000;*/
    }

    .date-picker-wrapper{
        z-index: 1100 !important;
    }

    textarea{
        resize: vertical;
        max-height: 400px;
        min-height: 150px;
    }

    .chart-legend li span{
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 5px;
    }

    .chart-legend{
        height:250px;
        overflow:auto;
    }

    .chart-legend ul{
        list-style-type: none;
        padding-inline-start: 0px;
    }

    .chart-legend li{
        cursor:pointer;
        margin-top: 10px;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .strike{
        text-decoration: line-through !important;
    }

    .float-left{
        float:left;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= $this->lang->line('keyword_rank_tracking'); ?></h3>
            </div>

        </div>

        <div></div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <form class="form-horizontal form-label-left" novalidate>
                        <div class="x_title">
                            <h2><?= $this->lang->line('key_tracking_text'); ?></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 2px solid #46b8da; padding: 10px; margin-bottom: 20px">
                                <div class="col-md-4 col-sm-4 col-sx-12"><button type="button" class="btn btn-success" id="btn_add_product"><?= $this->lang->line('add_new_product'); ?></button></div>
                                <div class="col-md-4 col-sm-4 col-sx-12"><h4><?= $this->lang->line('currently_tracking_keywords'); ?>:&nbsp;&nbsp;<small id="tracked_keywords_num" style="font-size: medium"><?= !empty($tracking_num['count'])?$tracking_num['count']:'0'; ?>/<?= !empty($signed_up_num['count'])?$signed_up_num['count']:'0'; ?> <?= $this->lang->line('keywords'); ?></small></h4></div>
                                <div class="col-md-4 col-sm-4 col-sx-12"><button type="button" class="btn btn-info" style="float: right;" id="btn_tutorial"><?= $this->lang->line('tutorial_learn'); ?></button></div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input id="daterange_keyword_tracking" value="" style="float: right; width: 175px; height: 30px; padding-left: 10px;">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 2px solid #46b8da; padding: 0px; margin-bottom: 50px">
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <canvas id="myChart" height="120px"></canvas>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12 bg-white" style="margin-top: 20px; padding: 0px;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h4 style="float:right; border-bottom: 2px solid #E6E9ED;">
                                            <?= $this->lang->line('top_rank_keywords'); ?>/<?= $this->lang->line('total_tracking_keyword'); ?>
                                        </h4>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-5" style="padding: 0px;">
                                        <div id="key_track_legend" class="col-md-12 col-sm-12 col-xs-12 chart-legend"></div>
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-7" style="margin-top: 13px;">
                                        <div class="col-md-12 col-sm-12 col-xs-12" id="product_progressbar">
                                            <?php if ($nums){
                                                foreach ($nums as $num)
                                                {
                                                    ?>
                                                    <div>
                                                        <div class="col-md-9 col-sm-9 col-xs-9" style="padding: 0px;">
                                                            <div class="progress progress_sm" style="width: 100%; height: 20px !important;">
                                                                <div class="progress-bar bg-green" role="progressbar" style="height: 20px !important;" data-transitiongoal="<?= round($num[0]['cnt']*100/$num[0]['total_cnt'], 2); ?>"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-sm-3 col-xs-3"><?= $num[0]['cnt'] ?>/<?= $num[0]['total_cnt'] ?></div>
                                                    </div>
                                                    <?php
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="width:200px;height: 200px"><canvas id="test_test" style="width: 100%; height: 95%; margin-bottom: 10px;"></canvas></div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="table_keyword_tracking" class="table table-striped table-bordered dt-responsive nowrap table_keyword_tracking" cellspacing="0" width="100%">
                                    <thead style="background-color: #000000; color: #dedee0">
                                    <th width="3%"></th>
                                    <th width="50%"><?= $this->lang->line('product'); ?></th>
                                    <th><?= $this->lang->line('overview'); ?></th>
                                    <th><?= $this->lang->line('actions'); ?></th>
                                    </thead>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!--begin::Modal Create Product-->
<div class="modal fade" id="modal_new_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel"><?= $this->lang->line('add_new_product'); ?></h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-label-left" id="form_new_product" action="javascript:;" novalidate>
                <div class="modal-body">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"><?= $this->lang->line('asin'); ?></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input id="txt_asin" type="text" name="asin_number"
                                   class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"><?= $this->lang->line('keyword'); ?></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea id="txt_keywords" type="textarea" name="keywords" style="height: 150px;"
                                      class="form-control col-md-7 col-xs-12" required="required"></textarea>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"><?= $this->lang->line('marketplace'); ?></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select name="market_place" class="form-control" id="market_place" required="required">
                                <option value=""></option>
                                <option value="1">Amazon.com</option>
                                <option value="2">Amazon.co.uk</option>
                                <option value="3">Amazon.ca</option>
                                <option value="4">Amazon.de</option>
                                <option value="5">Amazon.es</option>
                                <option value="6">Amazon.fr</option>
                                <option value="7">Amazon.it</option>
                                <option value="8">Amazon.com.mx</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" style="margin-right: 40px;">
                        <div class="col-md-4">
                            <button type="reset" class="btn btn-primary" ><?= $this->lang->line('clear'); ?></button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-danger" data-dismiss="modal" ><?= $this->lang->line('close'); ?></button>
                        </div>
                        <div class="col-md-4">
                            <button id="btn_start_tracking" type="submit" class="btn btn-success"><?= $this->lang->line('start'); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Modal Add Keywords-->
<div class="modal fade" id="modal_add_keywords" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel"><?= $this->lang->line('add_keywords'); ?></h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-label-left" id="form_add_keywords" action="javascript:;" novalidate>
                <div class="modal-body">
                    <input type="hidden" id="id_add_keywords" value="">
                    <div class="item form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12"></div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <span class="flag-icon flag-icon-us" id="flag_add_keywords"></span>
                            <a href="javascript:;" id="asin_num_add_keywords" style="text-decoration: underline; color: #000;"></a>
                            <br/>
                        </div>
                    </div>
                    <div>
                        <div class="col-md-2 col-sm-2 col-xs-12"></div>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <p><?= $this->lang->line('add_keywords_text'); ?>:</p>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12"><?= $this->lang->line('keywords'); ?></label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea id="area_add_keywords" type="textarea" name="keywords" style="height: 150px;"
                                      class="form-control col-md-7 col-xs-12" required="required"></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="txt_add_keyword_asin_id" value="">
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-md-4">
                            <button type="reset" class="btn btn-primary" data-dismiss="modal" style="float:right;"><?= $this->lang->line('close'); ?></button>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button id="btn_add_keyword" type="submit" class="btn btn-success" style="float:left;"><?= $this->lang->line('add'); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Modal Edit Product-->
<div class="modal fade" id="modal_edit_keywords" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel"><?= $this->lang->line('edit_keywords'); ?></h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal form-label-left" id="form_edit_keywords" action="javascript:;" novalidate>
                <div class="modal-body">
                    <input type="hidden" id="id_edit_keywords" value="">
                    <div class="item form-group">
                        <div class="col-md-2 col-sm-2 col-xs-12"></div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <span class="flag-icon flag-icon-us" id="flag_edit_keywords"></span>
                            <a href="javascript:;" id="asin_num_edit_keywords" style="text-decoration: underline;"></a>
                            <br/>
                            <p><?= $this->lang->line('tracked_keywords'); ?> : <span class="badge" id="tracked_count_edit_keywords" style="background: #337ab7;"></span></p>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12"><?= $this->lang->line('keywords'); ?></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea id="area_edit_keywords" type="textarea" name="keywords" style="height: 200px;"
                                      class="form-control col-md-7 col-xs-12" required="required"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group" style="margin-right: 40px;">
                        <div class="col-md-4">
                            <button type="reset" class="btn btn-primary" data-dismiss="modal" style="float:right;"><?= $this->lang->line('close'); ?></button>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button id="btn_save_keywords" type="submit" class="btn btn-success" style="float:left;"><?= $this->lang->line('save'); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Modal View ASIN Rank Graph-->
<div class="modal fade" id="modal_view_rank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel"><?= $this->lang->line('organic_rank_graph'); ?></h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--            <div class="modal-body">-->
            <div class="col-md-12 col-sm-12 col-xs-12" style="height: 350px; border-bottom: 1px solid #e5e5e5; padding: 10px; margin-bottom: 20px;">
                <div style="margin: 10px;">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <span class="flag-icon flag-icon-us" id="flag_view_graph"></span>
                        <a href="javascript:;" id="asin_num_view_graph" style="text-decoration: underline;"></a>
                        <br/>
                        <p><?= $this->lang->line('t_keyword'); ?> : <span id="tracked_count_view_graph" style="color: #ff1700;"></span></p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="daterange_view_graph" value="" style="float: right; width: 175px; height: 30px; padding-left: 10px;">
                    </div>
                </div>
                <div>
                    <canvas id="chart_view_rank" style="width: 100%; height: 95%; margin-bottom: 10px;"></canvas>
                </div>
            </div>
            <!--            </div>-->
            <div class="modal-footer">
                <div class="form-group" style="margin-right: 40px;">
                    <div class="col-md-col-md-12 col-sm-12 col-xs-12">
                        <button type="reset"  class="btn btn-danger" data-dismiss="modal" style="float: right;"><?= $this->lang->line('close'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Modal View Keyword # Graph-->
<div class="modal fade" id="modal_view_keyword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel"><?= $this->lang->line('organic_rank_graph'); ?></h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--            <div class="modal-body">-->
            <div class="col-md-12 col-sm-12 col-xs-12" style="height: 350px; border-bottom: 1px solid #e5e5e5; padding: 10px; margin-bottom: 20px;">
                <div style="margin: 10px;">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <span class="flag-icon flag-icon-us" id="flag_keyword_graph"></span>
                        <a href="javascript:;" id="asin_num_keyword_graph" style="text-decoration: underline;"></a>
                        <br/>
                        <p><?= $this->lang->line('t_keyword'); ?> : <span id="keyword_name" style="color: #ff1700;"></span></p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="daterange_view_keyword_graph" value="" style="float: right; width: 175px; height: 30px; padding-left: 10px;">
                    </div>
                </div>
                <div>
                    <canvas id="chart_view_keyword" style="width: 100%; height: 95%; margin-bottom: 10px;"></canvas>
                </div>
            </div>
            <!--            </div>-->
            <div class="modal-footer">
                <div class="form-group" style="margin-right: 40px;">
                    <div class="col-md-col-md-12 col-sm-12 col-xs-12">
                        <button type="reset"  class="btn btn-danger" data-dismiss="modal" style="float: right;"><?= $this->lang->line('close'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
