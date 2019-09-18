<style>

    label.control-label
    {
        color: #000;
        font-size: 16px;
        font-weight: 500;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;&nbsp;&nbsp;Amazon Account</h3>
            </div>

        </div>

        <div></div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 1000px;">
                    <div class="x_title">
                        <h2></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 20px; padding-bottom: 20px;">
                            <form class="form-horizontal form-label-left" id="account_edit_form" action="javascript:;" novalidate>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" style="text-align: center;">Current Application</label>
                                        <?php if ($before_info) { ?>
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" style="text-align: center;">Before Application</label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select type="text" class="form-control col-md-10 col-xs-12" id="account_seller_type" required disabled>
                                                <option value="0" <?php if($cur_info['seller_type']=="0"){ ?>selected<?php } ?>>New Amazon Seller (Revenue below $100,000 USD per year)</option>
                                                <option value="1" <?php if($cur_info['seller_type']=="1"){ ?>selected<?php } ?>>Novice Amazon Seller (Revenue below $500,000 USD per year)</option>
                                                <option value="2" <?php if($cur_info['seller_type']=="2"){ ?>selected<?php } ?>>Proficient Amazon Seller (Revenue between $500,000 USD - $1.5M USD per  year)</option>
                                                <option value="3" <?php if($cur_info['seller_type']=="3"){ ?>selected<?php } ?>>Expert Amazon Seller (Revenue over $1.5 USD per  year)</option>
                                            </select>
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <select type="text" class="form-control col-md-10 col-xs-12" id="account_seller_type" required disabled>
                                                    <option value="0" <?php if($before_info['seller_type']=="0"){ ?>selected<?php } ?>>New Amazon Seller (Revenue below $100,000 USD per year)</option>
                                                    <option value="1" <?php if($before_info['seller_type']=="1"){ ?>selected<?php } ?>>Novice Amazon Seller (Revenue below $500,000 USD per year)</option>
                                                    <option value="2" <?php if($before_info['seller_type']=="2"){ ?>selected<?php } ?>>Proficient Amazon Seller (Revenue between $500,000 USD - $1.5M USD per  year)</option>
                                                    <option value="3" <?php if($before_info['seller_type']=="3"){ ?>selected<?php } ?>>Expert Amazon Seller (Revenue over $1.5 USD per  year)</option>
                                                </select>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_name">Contact person Name :</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" class="form-control col-md-10 col-xs-12" id="account_person_name" value="<?= $cur_info['person_name']; ?>" required readonly="readonly">
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-10 col-xs-12" id="account_person_name" value="<?= $before_info['person_name']; ?>" required readonly="readonly">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_phone">Contact person Phone :</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" class="form-control col-md-10 col-xs-12" id="account_person_phone" value="<?= $cur_info['person_phone']; ?>" required readonly="readonly">
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-10 col-xs-12" id="account_person_phone" value="<?= $before_info['person_phone']; ?>" required readonly="readonly">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_email">Contact person Email :</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" class="form-control col-md-10 col-xs-12" id="account_person_email" value="<?= $cur_info['person_email']; ?>" required readonly="readonly">
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-10 col-xs-12" id="account_person_email" value="<?= $before_info['person_email']; ?>" required readonly="readonly">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_contact">Contact person QQ or WeChat :</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" class="form-control col-md-10 col-xs-12" id="account_person_contact" value="<?= $cur_info['person_contact']; ?>" required readonly="readonly">
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-10 col-xs-12" id="account_person_contact" value="<?= $before_info['person_contact']; ?>" required readonly="readonly">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Are you a manufacturer?</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div id="account_manufacture" class="btn-group" data-toggle="buttons">
                                                <input type="radio" name="account_manufacture" class="flat" <?php if ($cur_info['manufacture'] == 1) { ?>checked<?php } ?> disabled> &nbsp;Yes&nbsp;
                                                <input type="radio" name="account_manufacture" class="flat" <?php if ($cur_info['manufacture'] == 0) { ?>checked<?php } ?> disabled> &nbsp;No&nbsp;
                                            </div>
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div id="account_manufacture" class="btn-group" data-toggle="buttons">
                                                    <input type="radio" name="account_manufacture" class="flat" <?php if ($before_info['manufacture'] == 1) { ?>checked<?php } ?> disabled> &nbsp;Yes&nbsp;
                                                    <input type="radio" name="account_manufacture" class="flat" <?php if ($before_info['manufacture'] == 0) { ?>checked<?php } ?> disabled> &nbsp;No&nbsp;
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_seller_name">Amazon Seller Name :</label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" class="form-control col-md-10 col-xs-12" id="account_seller_name" value="<?= $cur_info['seller_name']; ?>" required readonly="readonly">
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-10 col-xs-12" id="account_seller_name" value="<?= $before_info['seller_name']; ?>" required readonly="readonly">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_sales_year">How many years have you been selling on Amazon? </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" class="form-control col-md-10 col-xs-12" id="account_sales_year" value="<?= $cur_info['sales_year']; ?>" required readonly="readonly">
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-10 col-xs-12" id="account_sales_year" value="<?= $before_info['sales_year']; ?>" required readonly="readonly">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_sales_revenue">What is your past 90-days sales revenue? </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" class="form-control col-md-10 col-xs-12" id="account_sales_revenue" value="<?= $cur_info['sales_revenue']; ?>" required readonly="readonly">
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-10 col-xs-12" id="account_sales_revenue" value="<?= $before_info['sales_revenue']; ?>" required readonly="readonly">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_sku">How many SKUs do you have? </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select type="text" class="form-control col-md-10 col-xs-12" id="account_sku" required disabled>
                                                <option value="0" <?php if($cur_info['sku']=="0"){ ?>selected<?php } ?>>Less than 1,000</option>
                                                <option value="1" <?php if($cur_info['sku']=="1"){ ?>selected<?php } ?>>1,000 – 5,000</option>
                                                <option value="2" <?php if($cur_info['sku']=="2"){ ?>selected<?php } ?>>5,000 – 10,000</option>
                                                <option value="3" <?php if($cur_info['sku']=="3"){ ?>selected<?php } ?>>More than 10,000</option>
                                            </select>
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <select type="text" class="form-control col-md-10 col-xs-12" id="account_sku" required disabled>
                                                    <option value="0" <?php if($before_info['sku']=="0"){ ?>selected<?php } ?>>Less than 1,000</option>
                                                    <option value="1" <?php if($before_info['sku']=="1"){ ?>selected<?php } ?>>1,000 – 5,000</option>
                                                    <option value="2" <?php if($before_info['sku']=="2"){ ?>selected<?php } ?>>5,000 – 10,000</option>
                                                    <option value="3" <?php if($before_info['sku']=="3"){ ?>selected<?php } ?>>More than 10,000</option>
                                                </select>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_third_party">Do you use 3rd party oversea fulfillment centers? </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div id="account_third_party" class="btn-group" data-toggle="buttons">
                                                <input type="radio" name="account_third_party" class="flat" <?php if ($cur_info['third_party'] == 1) { ?>checked<?php } ?> disabled> &nbsp;Yes&nbsp;
                                                <input type="radio" name="account_third_party" class="flat" <?php if ($cur_info['third_party'] == 0) { ?>checked<?php } ?> disabled> &nbsp;No&nbsp;
                                            </div>
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div id="account_third_party" class="btn-group" data-toggle="buttons">
                                                    <input type="radio" name="account_third_party" class="flat" <?php if ($before_info['third_party'] == 1) { ?>checked<?php } ?> disabled> &nbsp;Yes&nbsp;
                                                    <input type="radio" name="account_third_party" class="flat" <?php if ($before_info['third_party'] == 0) { ?>checked<?php } ?> disabled> &nbsp;No&nbsp;
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_fba">Are you currently using FBA? </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div id="account_fba" class="btn-group" data-toggle="buttons">
                                                <input type="radio" name="account_fba" class="flat" <?php if ($cur_info['fba'] == 1) { ?>checked<?php } ?> disabled> &nbsp;Yes&nbsp;
                                                <input type="radio" name="account_fba" class="flat" <?php if ($cur_info['fba'] == 0) { ?>checked<?php } ?> disabled> &nbsp;No&nbsp;
                                            </div>
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div id="account_fba" class="btn-group" data-toggle="buttons">
                                                    <input type="radio" name="account_fba" class="flat" <?php if ($before_info['fba'] == 1) { ?>checked<?php } ?> disabled> &nbsp;Yes&nbsp;
                                                    <input type="radio" name="account_fba" class="flat" <?php if ($before_info['fba'] == 0) { ?>checked<?php } ?> disabled> &nbsp;No&nbsp;
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_company">Which shipping company do you use for your daily orders? </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" class="form-control col-md-10 col-xs-12" value="<?= $cur_info['company']; ?>" required readonly="readonly">
                                        </div>
                                        <?php if ($before_info) { ?>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <input type="text" class="form-control col-md-10 col-xs-12" value="<?= $before_info['company']; ?>" required readonly="readonly">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->