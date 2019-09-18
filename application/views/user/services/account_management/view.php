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
                <h3>&nbsp;&nbsp;&nbsp;Amazon Account Management (View)</h3>
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
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select type="text" class="form-control col-md-7 col-xs-12" id="account_seller_type" required disabled>
                                                <option value="0" <?php if($info['seller_type']=="0"){ ?>selected<?php } ?>><?= $this->lang->line('option1'); ?></option>
                                                <option value="1" <?php if($info['seller_type']=="1"){ ?>selected<?php } ?>><?= $this->lang->line('option2'); ?></option>
                                                <option value="2" <?php if($info['seller_type']=="2"){ ?>selected<?php } ?>><?= $this->lang->line('option3'); ?></option>
                                                <option value="3" <?php if($info['seller_type']=="3"){ ?>selected<?php } ?>><?= $this->lang->line('option4'); ?></option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-round btn-default" id="account_edit_btn" style="width: 80px;float:right;"><?= $this->lang->line('edit'); ?></button>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_name"><?= $this->lang->line('contact_name'); ?> :</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_person_name" value="<?= $info['person_name']; ?>" required readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_phone"><?= $this->lang->line('contact_phone'); ?> :</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_person_phone" value="<?= $info['person_phone']; ?>" required readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_email"><?= $this->lang->line('contact_email'); ?> :</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_person_email" value="<?= $info['person_email']; ?>" required readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_contact"><?= $this->lang->line('contact_chat'); ?> :</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_person_contact" value="<?= $info['person_contact']; ?>" required readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_qq"><?= $this->lang->line('manufacture'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="account_manufacture" class="btn-group" data-toggle="buttons">
                                                <input type="radio" name="account_manufacture" class="flat" <?php if ($info['manufacture'] == 1) { ?>checked<?php } ?> disabled> &nbsp;Yes&nbsp;
                                                <input type="radio" name="account_manufacture" class="flat" <?php if ($info['manufacture'] == 0) { ?>checked<?php } ?> disabled> &nbsp;No&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_seller_name"><?= $this->lang->line('seller_name'); ?> :</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_seller_name" value="<?= $info['seller_name']; ?>" required readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_sales_year"><?= $this->lang->line('selling_year'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_sales_year" value="<?= $info['sales_year']; ?>" required readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_sales_revenue"><?= $this->lang->line('past_90'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_sales_revenue" value="<?= $info['sales_revenue']; ?>" required readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_sku"><?= $this->lang->line('num_sku'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select type="text" class="form-control col-md-7 col-xs-12" id="account_sku" required disabled>
                                                <option value="0" <?php if($info['sku']=="0"){ ?>selected<?php } ?>>Less than 1,000</option>
                                                <option value="1" <?php if($info['sku']=="1"){ ?>selected<?php } ?>>1,000 – 5,000</option>
                                                <option value="2" <?php if($info['sku']=="2"){ ?>selected<?php } ?>>5,000 – 10,000</option>
                                                <option value="3" <?php if($info['sku']=="3"){ ?>selected<?php } ?>>More than 10,000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_third_party"><?= $this->lang->line('third_party'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="account_third_party" class="btn-group" data-toggle="buttons">
                                                <input type="radio" name="account_third_party" class="flat" <?php if ($info['third_party'] == 1) { ?>checked<?php } ?> disabled> &nbsp;Yes&nbsp;
                                                <input type="radio" name="account_third_party" class="flat" <?php if ($info['third_party'] == 0) { ?>checked<?php } ?> disabled> &nbsp;No&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_fba"><?= $this->lang->line('current_using_fba'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="account_fba" class="btn-group" data-toggle="buttons">
                                                <input type="radio" name="account_fba" class="flat" <?php if ($info['fba'] == 1) { ?>checked<?php } ?> disabled> &nbsp;Yes&nbsp;
                                                <input type="radio" name="account_fba" class="flat" <?php if ($info['fba'] == 0) { ?>checked<?php } ?> disabled> &nbsp;No&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_company"><?= $this->lang->line('which_company'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" value="<?= $info['company']; ?>" required readonly="readonly">
                                        </div>
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