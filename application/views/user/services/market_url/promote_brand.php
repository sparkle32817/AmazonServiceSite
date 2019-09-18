<style>

    label.letter
    {
        color: #000;
        font-size: 16px;
        font-weight: 300;
    }

    .input-box{
        border-radius: 10px;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;&nbsp;&nbsp;<?= $this->lang->line('promote_brand'); ?></h3>
            </div>

        </div>

        <div></div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 1200px;">
                    <div class="x_title">
                        <h2></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 100px;">
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <label class="control-label letter" style="font-weight: 600; float:right;"><?= $this->lang->line('benefits'); ?> : </label>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <label class="col-md-12 col-sm-12 col-xs-10 letter"> <?= $this->lang->line('benefits_text11'); ?></label>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                            <div class="col-md-2 col-sm-2 col-xs-2">
                                <label class="control-label letter" style="font-weight: 600; float:right;"><?= $this->lang->line('best_uses'); ?> : </label>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <label class="col-md-12 col-sm-12 col-xs-12 letter"> <?= $this->lang->line('uses_text11'); ?></label>
                                <label class="col-md-12 col-sm-12 col-xs-12 letter"> <?= $this->lang->line('uses_text12'); ?></label>
                                <label class="col-md-12 col-sm-12 col-xs-12 letter"> <?= $this->lang->line('uses_text13'); ?></label>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2"></div>
                        <div class="col-md-8 col-sm-8 col-xs-12" style="margin-top: 30px;">
                            <form class="form-horizontal form-label-left" id="promote_form" action="javascript:;" novalidate>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="market_place" class="form-control input-box" required="required" id="promote_market_place">
                                                    <option value="">--<?= $this->lang->line('marketplace'); ?>--</option>
                                                    <option value="1">Amazon.com</option>
                                                    <option value="2">Amazon.co.uk</option>
                                                    <option value="3">Amazon.ca</option>
                                                    <option value="4">Amazon.de</option>
                                                    <option value="5">Amazon.es</option>
                                                    <option value="6">Amazon.fr</option>
                                                    <option value="7">Amazon.it</option>
                                                    <option value="8">Amazon.in</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="promote_brand" required="required" placeholder="<?= $this->lang->line('brand'); ?>(*)" class="form-control col-md-7 col-xs-12 input-box">
                                            </div>
                                            <!--										<label class="control-label"> ( mandatory )</label>-->
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="promote_keywords" required="required" placeholder="<?= $this->lang->line('keywords'); ?>(*)" class="form-control col-md-7 col-xs-12 input-box">
                                            </div>
                                            <!--										<label class="control-label"> ( mandatory )</label>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="promote_asin" placeholder="<?= $this->lang->line('asin'); ?>" class="form-control col-md-7 col-xs-12 input-box">
                                            </div>
                                            <label class="control-label"> ( <?= $this->lang->line('optional'); ?> )</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="promote_min_price" placeholder="<?= $this->lang->line('minimum_price'); ?>" class="form-control col-md-7 col-xs-12 input-box">
                                            </div>
                                            <label class="control-label"> ( <?= $this->lang->line('optional'); ?> )</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="promote_max_price" placeholder="<?= $this->lang->line('maximum_price'); ?>" class="form-control col-md-7 col-xs-12 input-box">
                                            </div>
                                            <label class="control-label"> ( <?= $this->lang->line('optional'); ?> )</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                    <div class="col-md-2 col-sm-3 col-xs-12">
                                        <div class="item form-group">
                                            <center>
                                                <button type="submit" class="btn btn-round btn-primary"><?= $this->lang->line('generate'); ?></button>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-7 col-xs-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="promote_url">
                                            <span class="input-group-btn">
											  <button type="button" class="btn btn-primary" id="promote_btn_copy" style="border-radius: 0px; margin-right: 0px;">
												  <i class="fa fa-copy" title="<?= $this->lang->line('copy_link'); ?>"></i>
											  </button>
											</span>
                                            <span class="input-group-btn">
											  <button type="button" class="btn btn-primary" id="promote_btn_go">
												  <i class="fa fa-mail-forward" title="<?= $this->lang->line('go_link'); ?>"></i>
											  </button>
											</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-2 col-sm-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
