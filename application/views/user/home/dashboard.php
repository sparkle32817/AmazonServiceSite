<style>

    .chart-legend li span{
        display: inline-block;
        width: 12px;
        height: 12px;
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
        margin-bottom: 14px;
        font-size: 12px;
    }

    .strike{
        text-decoration: line-through !important;
    }

    #scroller_history_pending, #scroller_history_complete, #scroller_history_info {
        position: relative;
        margin: 0px auto;
        padding: 0px;
        width: 100%;
        height: 220px;
        overflow: hidden;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">

    <div class="row">

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2><?= $this->lang->line('request_pending'); ?>&nbsp;&nbsp;<span class="badge bg-orange" style="color: white"><?= sizeof($pending_info); ?></span></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li style="float: right;"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="scroller_history_pending">
                        <?php if (!empty($pending_info)){

                            foreach ($pending_info as $info){

                                $month = date("M", strtotime($info['request_time']));
                                $day = date("d", strtotime($info['request_time']));
                                $time = date("H:i:s", strtotime($info['request_time']));
                                ?>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month"><?= $month; ?></p>
                                        <p class="day"><?= $day; ?></p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="<?= $info['url']; ?>" style="font-size: 16px;"><?= 'Service : '.$info['service']; ?></a>
                                        <p style="font-size: 16px;"><?= $time; ?></p>
                                    </div>
                                </article>
                                <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2><?= $this->lang->line('request_complete'); ?> (<?= $this->lang->line('pending_view'); ?>) &nbsp;&nbsp;<span class="badge bg-green" style="color: white"><?= sizeof($complete_info); ?></span></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li style="float: right;"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="scroller_history_complete">
                        <?php if (!empty($complete_info)){

                            foreach ($complete_info as $info){

                                $month = date("M", strtotime($info['request_time']));
                                $day = date("d", strtotime($info['request_time']));
                                ?>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month"><?= $month; ?></p>
                                        <p class="day"><?= $day; ?></p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="<?= $info['url']; ?>" style="font-size: 16px;"><?= 'Service : '.$info['service']; ?></a>
                                        <p style="font-size: 16px;"><?= 'Status : '.$info['status']; ?></p>
                                    </div>
                                </article>
                                <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2><?= $this->lang->line('request_history'); ?>&nbsp;&nbsp;<span class="badge bg-blue" style="color: white"><?= sizeof
                            ($history_info);
                            ?></span></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li style="float: right;"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="scroller_history_info">
                        <?php if (!empty($history_info)){
                            foreach ($history_info as $info){

                                $month = date("M", strtotime($info['request_time']));
                                $day = date("d", strtotime($info['request_time']));
                                ?>
                                <article class="media event">
                                    <a class="pull-left date">
                                        <p class="month"><?= $month; ?></p>
                                        <p class="day"><?= $day; ?></p>
                                    </a>
                                    <div class="media-body">
                                        <a class="title" href="<?= $info['url']; ?>" style="font-size: 16px;"><?= 'Service : '.$info['service']; ?></a>
                                        <p style="font-size: 16px;"><?= 'Status : '.$info['status']; ?></p>
                                    </div>
                                </article>
                                <?php
                            }
                        } ?>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-8 col-sm-8 col-xs-12">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="dashboard_graph" style="height: 410px">

                    <div class="row x_title">
                        <div class="col-md-10">
                            <h3><?= $this->lang->line('keyword_rank_tracking'); ?></h3>
                        </div>
                        <div class="col-md-2">
                            <input id="daterange_dashboard" value="" style="float: right; width: 175px; height: 30px; padding-left: 10px;">
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <canvas id="dashboardChart" height="120px"></canvas>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 bg-white" style="margin-top: 20px; padding: 0px;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h5 style="float:right; border-bottom: 2px solid #E6E9ED;">
                                <?= $this->lang->line('top_rank_keywords'); ?>/<?= $this->lang->line('total_tracking_keyword'); ?>
                            </h5>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-5" style="padding: 0px;">
                            <div id="dashboard_legend" class="col-md-12 col-sm-12 col-xs-12 chart-legend" style="padding: 0px;"></div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-7" style="margin-top: 13px;padding: 0px;">
                            <!--							<div class="col-md-12 col-sm-12 col-xs-12" id="product_progressbar" style="padding: 0px;">-->
                            <!--								--><?php //if ($nums){
                            //									foreach ($nums as $num)
                            //									{
                            //										?>
                            <!--										<div>-->
                            <!--											<div class="col-md-9 col-sm-9 col-xs-9" style="padding: 0px;">-->
                            <!--												<div class="progress progress_sm" style="width: 100%; height: 12px !important;">-->
                            <!--													<div class="progress-bar bg-green" role="progressbar" style="height: 12px !important;" data-transitiongoal="--><?//= round($num['cnt']*100/$num['total_cnt'], 2); ?><!--"></div>-->
                            <!--												</div>-->
                            <!--											</div>-->
                            <!--											<div class="col-md-3 col-sm-3 col-xs-3" style="margin-top: -3px;">--><?//= $num['cnt'] ?><!--/--><?//= $num['total_cnt'] ?><!--</div>-->
                            <!--										</div>-->
                            <!--										--><?php
                            //									}
                            //								} ?>
                            <!--							</div>-->
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="col-md-12">
                <div class="x_panel tile">
                    <div class="x_title">
                        <h2><?= $this->lang->line('my_account'); ?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <!--                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>-->
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div style="padding: 5px"><i class="fa fa-bars"></i>&nbsp;&nbsp;<a href="javascript:;"><strong><?= $this->lang->line('membership_level'); ?>:&nbsp;&nbsp;&nbsp;</strong><?= $user_info['membership']; ?></a></div>

                                <div style="padding: 5px"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<a href="javascript:;"><strong><?= $this->lang->line('next_billing_date'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?= date('Y-m-d', strtotime($user_info['member_update_date']. ' + 30days')); ?></a></div>

                                <div style="padding: 5px"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;<a href="javascript:;"><strong><?= $this->lang->line('available_credit'); ?>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?= "XXX" ?></a> </li></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="x_panel tile">
                    <div class="x_title">
                        <h2><?= $this->lang->line('image_hosting'); ?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <!--                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>-->
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="dashboard-widget-content">
                            <ul class="quick-list">
                                <br/>
                                <li><strong style="font-size: 18px;"><?= $this->lang->line('using'); ?> :</strong><small style="font-size: 20px;"> 50 / &#8734;</small>
                                </li>
                                <li>
                            </ul>

                            <div class="sidebar-widget">
                                <h4><?= $this->lang->line('available_space'); ?></h4>
                                <canvas width="150" height="80" id="chart_gauge_01" class="" style="width: 160px;
                                height: 50px;"></canvas>
                                <div class="goal-wrapper">
                                    <span id="gauge-text" class="gauge-value pull-left">0</span>
                                    <span class="gauge-value pull-left">%</span>
                                    <span id="goal-text" class="goal-value pull-right">100%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row top_tiles">
        <a href="<?= base_url('services/marketurl'); ?>">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats" style="height: 80px;">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                    <br/>
                    <div class="count" style="font-size: 18px; margin-left=20px;"><?= $this->lang->line('url_generator'); ?></div>
                    <h3>&nbsp;</h3>
                    <p></p>
                </div>
            </div>
        </a>
        <a href="<?= base_url('services/reverse_search'); ?>">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats" style="height: 80px;">
                    <div class="icon"><i class="fa fa-search"></i></div>
                    <br/>
                    <div class="count" style="font-size: 18px; margin-left=20px;"><?= $this->lang->line('reverse_asin_search'); ?></div>
                    <h3>&nbsp;</h3>
                    <p></p>
                </div>
            </div>
        </a>
        <a href="<?= base_url('services/find_related_keywords'); ?>">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats" style="height: 80px;">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                    <br/>
                    <div class="count" style="font-size: 18px; margin-left=20px;"><?= $this->lang->line('magnet_related_search'); ?></div>
                    <h3>&nbsp;</h3>
                    <p></p>
                </div>
            </div>
        </a>
        <a href="<?= base_url('services/keyword_rank_tracking'); ?>">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats" style="height: 80px;">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                    <br/>
                    <div class="count" style="font-size: 18px; margin-left=20px;"><?= $this->lang->line('keyword_rank_tracking'); ?></div>
                    <h3>&nbsp;</h3>
                    <p></p>
                </div>
            </div>
        </a>
    </div>

    <div class="row top_tiles">
        <a href="<?= base_url('services/listing_stuffer'); ?>">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats" style="height: 80px;">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                    <br/>
                    <div class="count" style="font-size: 18px; margin-left=20px;"><?= $this->lang->line('listing_stuffer'); ?></div>
                    <h3>&nbsp;</h3>
                    <p></p>
                </div>
            </div>
        </a>
        <a href="<?= base_url('services/big_data/category'); ?>">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats" style="height: 80px;">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                    <br/>
                    <div class="count" style="font-size: 18px; margin-left=20px;"><?= $this->lang->line('big_data'); ?></div>
                    <h3>&nbsp;</h3>
                    <p></p>
                </div>
            </div>
        </a>
        <a href="<?= base_url('services/image_hosting'); ?>">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats" style="height: 80px;">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                    <br/>
                    <div class="count" style="font-size: 18px; margin-left=20px;"><?= $this->lang->line('image_hosting'); ?></div>
                    <h3>&nbsp;</h3>
                    <p></p>
                </div>
            </div>
        </a>
        <a href="<?= base_url('services/image_hosting'); ?>">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats" style="height: 80px;">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                    <br/>
                    <div class="count" style="font-size: 18px; margin-left=20px;"><?= $this->lang->line('account_management'); ?></div>
                    <h3>&nbsp;</h3>
                    <p></p>
                </div>
            </div>
        </a>
    </div>

</div>
<!-- /page content -->
