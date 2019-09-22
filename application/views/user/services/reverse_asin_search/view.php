<style>

    label.control-label
    {
        color: #000;
        font-size: 16px;
        font-weight: 500;
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

    th, td{
        text-align: center;
        padding: 10px;
        font-size: 15px;
    }

    .table > tbody > tr > td, .table > thead > tr > th{
        vertical-align: middle;
    }

    textarea{
        resize: vertical;
        width: 400px;
        min-height: 350px;
        max-height: 400px;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;&nbsp;&nbsp;<?= $this->lang->line('reverse_asin_search'); ?> (<?= $this->lang->line('result_view'); ?>)</h3>
            </div>

        </div>

        <div></div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 200px;">
                    <div class="x_content">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 20px; padding-bottom: 20px; border-bottom: 2px solid #46b8da;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 10px;">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                                <div class="col-md-3 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('marketplace'); ?> : </label>
                                                </div>
                                                <div class="col-md-9 col-sm-12 col-xs-12" style="padding: 0px;">
                                                    <?php if (!empty($result['market'])){ ?>
                                                        <span class="flag-icon flag-icon-<?= $result['flag']; ?>" style="font-size: 18px;"></span>&nbsp;&nbsp;<small style="font-size: 16px; color: red;"><?= $result['market']; ?></small>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                                <div class="col-md-3 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('product_asin'); ?> : </label>
                                                </div>
                                                <div class="col-md-9 col-sm-12 col-xs-12" style="padding: 0px;">
                                                    <?php if (!empty($result['asin'])){ ?>
                                                        <p style="font-size: 16px; color: red;"><?= $result['asin']; ?></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label"><?= $this->lang->line('total_keywords'); ?> : <small style="font-size: 18px; color: red;"><?= $keyword_count['cnt_phrase']; ?></small></label>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label"><?= $this->lang->line('organic_keywords'); ?> : <small style="font-size: 18px; color: red;"><?= $keyword_count['sum_organic']; ?></small></label>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label"><?= $this->lang->line('sponsored_keywords'); ?> : <small style="font-size: 18px; color: red;"><?= $keyword_count['sum_sponsored']; ?></small></label>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label"><?= $this->lang->line('recommended_keywords'); ?> : <small style="font-size: 18px; color: red;"><?= $keyword_count['sum_amz_recommended']; ?></small></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 1000px;">
                    <div class="x_content">
                        <input type="hidden" id="cur_status" value="<?= $status; ?>">
                        <div>
                            <form action="javascript:;">
                                <div class="item form-group">
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                            <label class="control-label"><?= $this->lang->line('search_volume'); ?></label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="search_volume_min" name="search_volume_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                -
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="search_volume_max" name="search_volume_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                            <label class="control-label"><?= $this->lang->line('competing_products'); ?></label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="competing_product_min" name="competing_product_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                -
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="competing_product_max" name="competing_product_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                            <label class="control-label"><?= $this->lang->line('keyword_score'); ?></label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="key_score_min" name="key_score_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                -
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="key_score_max" name="key_score_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                            <label class="control-label"><?= $this->lang->line('organic_rank'); ?></label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="organic_min" name="organic_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                -
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="organic_max" name="organic_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px; margin-top: 30px;">
                                            <label class="control-label"><?= $this->lang->line('recommended_rank'); ?></label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="amz_min" name="amz_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                -
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="amz_max" name="amz_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px; margin-top: 30px;">
                                            <label class="control-label"><?= $this->lang->line('sponsored_rank'); ?></label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="sponsored_min" name="sponsored_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                -
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                <input type="text" id="sponsored_max" name="sponsored_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px; margin-top: 30px;">
                                            <label class="control-label"><?= $this->lang->line('include_keywords'); ?></label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" id="reverse_in_keywords" name="reserve_in_keywords" class="input-category">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 30px;">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                            <label class="control-label"><?= $this->lang->line('exclude_keywords'); ?></label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" id="reverse_ex_keywords" name="reserve_ex_keywords" class="input-category">
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-xs-12" style="margin-top: 30px;">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="control-label"><?= $this->lang->line('match_type'); ?></label>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <select class="form-control input-box" id="reserve_match_type" multiple>
                                                <option value="<?= $this->lang->line('organic_keyword'); ?>"><?= $this->lang->line('organic_keyword'); ?></option>
                                                <option value="<?= $this->lang->line('sponsored_keyword'); ?>"><?= $this->lang->line('sponsored_keyword'); ?></option>
                                                <option value="<?= $this->lang->line('recommended_keywords'); ?>"><?= $this->lang->line('recommended_keywords'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12" style="margin-top: 50px;">
                                        <button type="reset" id="reverse_reset_btn" class="btn btn-danger" style="margin-top: 10px;margin-left: 30px;"><?= $this->lang->line('reset'); ?>
                                            <button type="button" id="reverse_filter_btn" class="btn btn-primary" style="margin-top: 10px;margin-left: 30px;"><?= $this->lang->line('search'); ?>
                                                <button type="button" id="reverse_file_export" class="btn btn-round btn-default" style="width: 60px; margin-top: 10px; margin-left: 20px;" title="<?= $this->lang->line('download_result'); ?>">
                                                    <i class="fa fa-download" style=" font-size: 20px;"></i>
                                                </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 40px;">
                            <input type="hidden" id="view_keyword_id" value="<?= $view_keyword_id; ?>">
                            <table id="table_reverse_asin" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                <thead style="background-color: #000000; color: #dedee0">
                                <th width="3%">#</th>
                                <th width="10%"><?= $this->lang->line('t_keyword'); ?></th>
                                <th><?= $this->lang->line('t_rank_boost_url'); ?></th>
                                <th><?= $this->lang->line('t_opportunity_score'); ?></th>
                                <th><?= $this->lang->line('t_exact_search_volume'); ?></th>
                                <th><?= $this->lang->line('t_sponsored_products'); ?></th>
                                <th><?= $this->lang->line('t_competing_products'); ?></th>
                                <th><?= $this->lang->line('t_sell_per_week'); ?></th>
                                <th><?= $this->lang->line('t_recommended_keyword'); ?></th>
                                <th><?= $this->lang->line('t_sponsored_keyword'); ?></th>
                                <th><?= $this->lang->line('t_organic_keyword'); ?></th>
                                <th><?= $this->lang->line('t_recommended_rank'); ?></th>
                                <th><?= $this->lang->line('t_sponsored_rank'); ?></th>
                                <th><?= $this->lang->line('t_organic_rank'); ?></th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
