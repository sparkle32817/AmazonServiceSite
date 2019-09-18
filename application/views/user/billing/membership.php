<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp; </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="">
                    <div class="x_title">
                        <h2><?= $this->lang->line('membership'); ?></h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="row membership_row">

                            <div class="col-md-12">

                                <!-- price element -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <?php if ($member_status['membership_id']==1){ ?>
                                    <div class="pricing ui-ribbon-container">
                                        <div class="ui-ribbon-wrapper">
                                            <div class="ui-ribbon">
                                                <?= $this->lang->line('selected'); ?>
                                            </div>
                                        </div>
                                        <?php } else { ?>
                                        <div class="pricing">
                                            <?php } ?>
                                        <div class="title" <?php if ($member_status['membership_id']==1){ ?> style="background: #ad4c4c" <?php } ?>>
                                            <h2>Tier 0</h2>
                                            <h1><?= $this->lang->line('free'); ?></h1>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_features">
                                                    <ul class="list-unstyled text-left">
                                                        <li><i class="fa fa-times text-danger"></i> 2 years access <strong> to all storage locations</strong></li>
                                                        <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> storage</li>
                                                        <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                                        <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> access to all files</li>
                                                        <li><i class="fa fa-times text-danger"></i> <strong>Allowed</strong> to be exclusing per sale</li>
                                                        <li><i class="fa fa-times text-danger"></i> <strong>Service</strong> x</li>
                                                        <li><i class="fa fa-times text-danger"></i> <strong>Service</strong> y</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <button  href="javascript:void(0);" class="btn btn-round <?php if ($member_status['membership_id']>1){ ?> btn-info <?php }else{ ?> btn-danger <?php } ?> membership_upgrade"
                                                    <?php if ($member_status['membership_id']==1){ ?> disabled style="cursor: default;" <?php } ?>
                                                     id="1" amount="0" role="button" ><?php if ($member_status['membership_id']>1){ ?> <?= $this->lang->line('downgrade'); ?> <?php }else{ ?> <?= $this->lang->line('selected'); ?> <?php } ?></button>
                                                <p>
                                                    <?php if ($member_status['membership_id']==1){
                                                        $now = time();
                                                        $your_date = strtotime($member_status['reg_date']);
                                                        $datediff = $now - $your_date;
                                                        echo "Time left ".(30-round($datediff / (60 * 60 * 24)))." days<br/>";
                                                        echo "Billing date: ".$member_status['reg_date'];
                                                    } else{
                                                        echo "&nbsp;<br/>";
                                                        echo "&nbsp;";
                                                    }?>
                                                    <a href="javascript:void(0);"></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->

                                <!-- price element -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <?php if ($member_status['membership_id']==2){ ?>
                                    <div class="pricing ui-ribbon-container">
                                        <div class="ui-ribbon-wrapper">
                                            <div class="ui-ribbon">
                                                <?= $this->lang->line('selected'); ?>
                                            </div>
                                        </div>
                                        <?php } else { ?>
                                        <div class="pricing">
                                            <?php } ?>
                                        <div class="title" <?php if ($member_status['membership_id']==2){ ?>  style="background: #ad4c4c" <?php } ?>>
                                            <h2>Tier 1</h2>
                                            <h1>$4.95</h1>
                                            <span><?= $this->lang->line('monthly'); ?></span>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_features">
                                                    <ul class="list-unstyled text-left">
                                                        <li><i class="fa fa-check text-success"></i> 2 years access <strong> to all storage locations</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> storage</li>
                                                        <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                                        <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> access to all files</li>
                                                        <li><i class="fa fa-times text-danger"></i> <strong>Allowed</strong> to be exclusing per sale</li>
                                                        <li><i class="fa fa-times text-danger"></i> <strong>Service</strong> x</li>
                                                        <li><i class="fa fa-times text-danger"></i> <strong>Service</strong> y</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <button  href="javascript:void(0);" class="btn btn-round <?php if ($member_status['membership_id']!=2){ ?> btn-info <?php }else{ ?> btn-danger <?php } ?> membership_upgrade"
                                                    <?php if ($member_status['membership_id']==2){ ?> disabled style="cursor: default;" <?php } ?>
                                                         id="2" amount="4.95" role="button" ><?php if ($member_status['membership_id']>2){ ?> <?= $this->lang->line('downgrade'); ?> <?php }else if($member_status['membership_id']==2){ ?> <?= $this->lang->line('selected'); ?> <?php }else{ ?> <?= $this->lang->line('upgrade'); ?> <?php } ?></button>
                                                <p>
                                                    <?php if ($member_status['membership_id']==2){
                                                        $now = time();
                                                        $your_date = strtotime($member_status['reg_date']);
                                                        $datediff = $now - $your_date;
                                                        echo "Time left ".(30-round($datediff / (60 * 60 * 24)))." days<br/>";
                                                        echo "Billing date: ".$member_status['reg_date'];
                                                    } else{
                                                        echo "&nbsp;<br/>";
                                                        echo "&nbsp;";
                                                    }?>
                                                    <a href="javascript:void(0);"></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->

                                <!-- price element -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <?php if ($member_status['membership_id']==3){ ?>
                                    <div class="pricing ui-ribbon-container">
                                        <div class="ui-ribbon-wrapper">
                                            <div class="ui-ribbon">
                                                <?= $this->lang->line('selected'); ?>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                    <div class="pricing">
                                    <?php } ?>
                                        <div class="title" <?php if ($member_status['membership_id']==3){ ?>  style="background: #ad4c4c" <?php } ?>>
                                            <h2>Tier 2</h2>
                                            <h1>$9.95</h1>
                                            <span><?= $this->lang->line('monthly'); ?></span>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_features">
                                                    <ul class="list-unstyled text-left">
                                                        <li><i class="fa fa-check text-success"></i> 2 years access <strong> to all storage locations</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> storage</li>
                                                        <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> access to all files</li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Allowed</strong> to be exclusing per sale</li>
                                                        <li><i class="fa fa-times text-danger"></i> <strong>Service</strong> x</li>
                                                        <li><i class="fa fa-times text-danger"></i><strong>Service</strong> y</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <button  href="javascript:void(0);" class="btn btn-round <?php if ($member_status['membership_id']!=3){ ?> btn-info <?php }else{ ?> btn-danger <?php } ?> membership_upgrade"
                                                    <?php if ($member_status['membership_id']==3){ ?> disabled style="cursor: default;" <?php } ?>
                                                         id="3" amount="9.95" role="button" ><?php if ($member_status['membership_id']>3){ ?> <?= $this->lang->line('downgrade'); ?> <?php }else if($member_status['membership_id']==3){ ?> <?= $this->lang->line('selected'); ?> <?php }else{ ?> <?= $this->lang->line('upgrade'); ?> <?php } ?></button>
                                                <p>
                                                    <?php if ($member_status['membership_id']==3){
                                                        $now = time();
                                                        $your_date = strtotime($member_status['reg_date']);
                                                        $datediff = $now - $your_date;
                                                        echo "Time left ".(30-round($datediff / (60 * 60 * 24)))." days<br/>";
                                                        echo "Billing date: ".$member_status['reg_date'];
                                                    } else{
                                                        echo "&nbsp;<br/>";
                                                        echo "&nbsp;";
                                                    }?>
                                                    <a href="javascript:void(0);"></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->

                                <!-- price element -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <?php if ($member_status['membership_id']==4){ ?>
                                    <div class="pricing ui-ribbon-container">
                                        <div class="ui-ribbon-wrapper">
                                            <div class="ui-ribbon">
                                                <?= $this->lang->line('selected'); ?>
                                            </div>
                                        </div>
                                        <?php } else { ?>
                                        <div class="pricing">
                                            <?php } ?>
                                        <div class="title" <?php if ($member_status['membership_id']==4){ ?>  style="background: #ad4c4c" <?php } ?>>
                                            <h2>Tier 3</h2>
                                            <h1>$15.95</h1>
                                            <span><?= $this->lang->line('monthly'); ?></span>
                                        </div>
                                        <div class="x_content">
                                            <div class="">
                                                <div class="pricing_features">
                                                    <ul class="list-unstyled text-left">
                                                        <li><i class="fa fa-check text-success"></i> 2 years access <strong> to all storage locations</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> storage</li>
                                                        <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> access to all files</li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Allowed</strong> to be exclusing per sale</li>
                                                        <li><i class="fa fa-check text-success"></i> <strong>Service</strong> x</li>
                                                        <li><i class="fa fa-check text-success"></i><strong>Service</strong> y</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="pricing_footer">
                                                <button  href="javascript:void(0);" class="btn btn-round <?php if ($member_status['membership_id']==4){ ?> btn-danger <?php }else{ ?> btn-info <?php } ?> membership_upgrade"
                                                    <?php if ($member_status['membership_id']==4){ ?> disabled style="cursor: default;" <?php } ?> id="4" amount="15.95" role="button" ><?php if ($member_status['membership_id']==4){ ?> <?= $this->lang->line('selected'); ?> <?php }else{ ?> <?= $this->lang->line('upgrade'); ?> <?php } ?></button>
                                                <p>
                                                    <?php if ($member_status['membership_id']==4){
                                                        $now = time();
                                                        $your_date = strtotime($member_status['reg_date']);
                                                        $datediff = $now - $your_date;
                                                        echo "Time left ".(30-round($datediff / (60 * 60 * 24)))." days<br/>";
                                                        echo "Billing date: ".$member_status['reg_date'];
                                                    } else{
                                                        echo "&nbsp;<br/>";
                                                        echo "&nbsp;";
                                                    }?>
                                                    <a href="javascript:void(0);"></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- price element -->
                            </div>

                            <div id="payment_modal" class="modal fade" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalPopoversLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="javascript:;" id="pay_modal_form">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="exampleModalPopoversLabel">Select Payment</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" class="flat" checked name="payment" value="WeChat Pay">
                                                        <img src="<?= base_url(); ?>assets/images/pay_wechat.png">
                                                    </label>
                                                </div>
                                                <hr>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" class="flat" name="payment" value="Alipay">
                                                        <img src="<?= base_url(); ?>assets/images/pay_ali.png">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-primary" id="go_pay"> OK </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $this->lang->line('billing_history'); ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30">
                        </p>

                        <table id="table_membership_history" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th><?= $this->lang->line('date'); ?></th>
                                <th><?= $this->lang->line('service'); ?></th>
                                <th><?= $this->lang->line('currency'); ?></th>
                                <th><?= $this->lang->line('amount'); ?></th>
                                <th><?= $this->lang->line('payment'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($histories)){ foreach ($histories as $history){  ?>
                                <tr>
                                    <td><?= $history['date_time'] ?></td>
                                    <td><?= $history['content'] ?></td>
                                    <td><?= $history['currency'] ?></td>
                                    <td><?= $history['amount'] ?></td>
                                    <td><?= $history['payment_name'] ?></td>
                                </tr>
                            <?php } } ?>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->