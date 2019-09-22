<style>

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

    small.content
    {
        color: #9c9c9c;
        font-size: 16px;
        font-weight: 400;
    }

    #table_bigdata_key_optimization_history{
        z-index: 1100 !important;
    }

    textarea{
        resize: vertical;
        width: 470px;
        min-height: 400px;
        max-height: 500px;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;&nbsp;&nbsp;<?= $this->lang->line('search_term_optimization'); ?></h3>
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
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-10 letter"> •	<?= $this->lang->line('magnet_text'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top: 110px;">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <center>
                                        <button type="reset" class="btn btn-info"><?= $this->lang->line('tutorial_learn'); ?></button>
                                    </center>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <center>
                                        <button type="button" id="btn_key_optimization_history" data-toggle="modal" data-target="#modal_key_optimization_history" class="btn btn-primary"><?= $this->lang->line('history'); ?></button>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 20px; padding-bottom: 20px; border-top: 2px solid #46b8da;">
                            <form class="form-horizontal form-label-left" id="key_optimization_form" action="javascript:;" novalidate>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px; border-bottom: 2px solid #ccc;">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('marketplace'); ?></label>
                                                </div>
                                                <select class="form-control input-box" required="required" id="key_optimization_market_place">
                                                    <option value=""></option>
                                                    <?php foreach ($markets as $market){ ?>
                                                        <option value="<?= $market["id"]; ?>"><?= $market["name"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('product_asin'); ?></label>
                                                </div>
                                                <input type="text" id="key_optimization_product_asin" class="input-category" required="required" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('keywords'); ?></label>
                                                </div>
                                                <textarea id="key_optimization_textarea" required="required" maxlength="5000" placeholder="<?= $this->lang->line('area_txt'); ?>"></textarea>
                                                <div>
                                                    <div style="float:right;color: #000; font-weight: 500;"><?= $this->lang->line('limit_20_lines'); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12"></div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin: 30px;">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <center>
                                            <button type="reset" class="btn btn-round btn-default"><?= $this->lang->line('clear'); ?></button>
                                        </center>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <center>
                                            <button type="submit" class="btn btn-round btn-primary" value="normal"><?= $this->lang->line('credit_50'); ?></button>
                                        </center>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <center>
                                            <button type="submit" class="btn btn-round btn-primary" value="special"><?= $this->lang->line('credit_250'); ?></button>
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
<div class="modal fade" id="modal_key_optimization_history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="width: 650px;">
            <div class="modal-header">
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel"><?= $this->lang->line('history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid #e5e5e5; padding: 20px; margin-bottom: 20px;">
                    <table id="table_key_optimization_history" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead style="background-color: #000000; color: #dedee0">
                        <th width="%5">#</th>
                        <th width="%35"><?= $this->lang->line('marketplace'); ?></th>
                        <th><?= $this->lang->line('asin'); ?></th>
                        <th><?= $this->lang->line('searched_date'); ?></th>
                        <th><?= $this->lang->line('status'); ?></th>
                        <th width="%10"><?= $this->lang->line('actions'); ?></th>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer" style="border-top: none;">
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
