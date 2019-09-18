<style>

    label.letter
    {
        color: #000;
        font-size: 16px;
        font-weight: 500;
    }

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
                <h3>&nbsp;&nbsp;&nbsp;Amazon Account Management</h3>
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
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> o&nbsp;&nbsp;<?= $this->lang->line('account_main_txt1'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;◾&nbsp;&nbsp;<?= $this->lang->line('account_main_txt2'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;<?= $this->lang->line('account_main_txt3'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;<?= $this->lang->line('account_main_txt4'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;<?= $this->lang->line('account_main_txt5'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;<?= $this->lang->line('account_main_txt6'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;<?= $this->lang->line('account_main_txt7'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;<?= $this->lang->line('account_main_txt8'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;<?= $this->lang->line('account_main_txt9'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;<?= $this->lang->line('account_main_txt10'); ?></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> o&nbsp;&nbsp;<?= $this->lang->line('account_main_txt11'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;◾&nbsp;&nbsp;<?= $this->lang->line('account_main_txt12'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;◾&nbsp;&nbsp;<?= $this->lang->line('account_main_txt13'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $this->lang->line('account_main_txt14'); ?></label>
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $this->lang->line('account_main_txt15'); ?></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> o&nbsp;&nbsp;<?= $this->lang->line('account_main_txt16'); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 20px; padding-bottom: 20px; border-top: 2px solid #46b8da;">
                            <form class="form-horizontal form-label-left" id="account_form" action="javascript:;" novalidate>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select type="text" class="form-control col-md-7 col-xs-12" id="account_seller_type" required>
                                                <option value="0"><?= $this->lang->line('option1'); ?></option>
                                                <option value="1"><?= $this->lang->line('option2'); ?></option>
                                                <option value="2"><?= $this->lang->line('option3'); ?></option>
                                                <option value="3"><?= $this->lang->line('option4'); ?></option>
                                            </select>
                                        </div>
                                        <?php if ($exist){ ?>
                                            <a href="<?= base_url('services/account_management/view'); ?>" class="btn btn-round btn-default" style="float:right;"><?= $this->lang->line('view_application'); ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_name"><?= $this->lang->line('contact_name'); ?> :</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_person_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_phone"><?= $this->lang->line('contact_phone'); ?> :</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_person_phone" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_email"><?= $this->lang->line('contact_email'); ?> :</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" class="form-control col-md-7 col-xs-12" id="account_person_email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_contact"><?= $this->lang->line('contact_chat'); ?> :</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_person_contact" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_person_qq"><?= $this->lang->line('manufacture'); ?></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="account_manufacture" class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="account_manufacture" class="flat" value="1" checked> &nbsp; <?= $this->lang->line('yes'); ?> &nbsp;
                                                </label>
                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="account_manufacture" class="flat" value="0">  <?= $this->lang->line('no'); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_seller_name"><?= $this->lang->line('seller_name'); ?> :</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_seller_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_sales_year"><?= $this->lang->line('selling_year'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_sales_year" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_sales_revenue"><?= $this->lang->line('past_90'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_sales_revenue" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_sku"><?= $this->lang->line('num_sku'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select type="text" class="form-control col-md-7 col-xs-12" id="account_sku" required>
                                                <option value="0"><?= $this->lang->line('option5'); ?></option>
                                                <option value="1"><?= $this->lang->line('option6'); ?></option>
                                                <option value="2"><?= $this->lang->line('option7'); ?></option>
                                                <option value="3"><?= $this->lang->line('option8'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_third_party"><?= $this->lang->line('third_party'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="account_third_party" class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="account_third_party" class="flat" value="1" checked> &nbsp; <?= $this->lang->line('yes'); ?> &nbsp;
                                                </label>
                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="account_third_party" class="flat" value="0">  <?= $this->lang->line('no'); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_fba"><?= $this->lang->line('current_using_fba'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="account_fba" class="btn-group" data-toggle="buttons">
                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="account_fba" class="flat" value="1" checked> &nbsp; <?= $this->lang->line('yes'); ?> &nbsp;
                                                </label>
                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                    <input type="radio" name="account_fba" class="flat" value="0">  <?= $this->lang->line('no'); ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account_company"><?= $this->lang->line('which_company'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12" id="account_company" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin: 30px;">
                                    <div class="col-md-5 col-sm-4 col-xs-5">
                                        <center>
                                            <button type="reset" class="btn btn-round btn-default" style="float:right;"><?= $this->lang->line('clear'); ?></button>
                                        </center>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2"></div>
                                    <div class="col-md-5 col-sm-5 col-xs-5">
                                        <center>
                                            <button type="submit" class="btn btn-round btn-primary" style="float:left;"><?= $this->lang->line('search'); ?></button>
                                        </center>
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

<!--begin::Modal History-->
<div class="modal fade" id="modal_account_history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="width: 650px;">
            <div class="modal-header">
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel">Category <?= $this->lang->line('history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid #e5e5e5; padding: 20px; margin-bottom: 20px;">
                    <table id="table_key_checker_history" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead style="background-color: #000000; color: #dedee0">
                        <th width="%5">#</th>
                        <th width="%35">Marketplace</th>
                        <th>ASIN</th>
                        <th>Date Searched</th>
                        <th>Status</th>
                        <th width="%10">Action</th>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer" style="border-top: none;">
                <div class="form-group" style="margin-right: 40px;">
                    <div class="col-md-col-md-12 col-sm-12 col-xs-12">
                        <button type="reset"  class="btn btn-danger" data-dismiss="modal" style="float: right;">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
