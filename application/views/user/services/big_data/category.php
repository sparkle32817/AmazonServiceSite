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
        color: rgba(20, 20, 20, 0.9);
    }

    small.content
    {
        color: #9c9c9c;
        font-size: 16px;
        font-weight: 400;
    }

    #table_bigdata_category_history{
        z-index: 1100 !important;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;&nbsp;&nbsp;<th><?= $this->lang->line('big_data'); ?></th> – <?= $this->lang->line('category'); ?></h3>
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
                                        <label class="col-md-12 col-sm-12 col-xs-10 letter"> •  <?= $this->lang->line('magnet_text'); ?></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> •	<?= $this->lang->line('notice'); ?> </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-12 letter"> •	<?= $this->lang->line('max_200_products'); ?></label>
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
                                        <button type="submit" id="btn_category_history" data-toggle="modal" data-target="#modal_category_history" class="btn btn-primary"><?= $this->lang->line('history'); ?></button>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 20px; padding-bottom: 20px; border-top: 2px solid #46b8da;">
                            <form class="form-horizontal form-label-left" id="category_form" action="javascript:;" novalidate>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px; border-bottom: 2px solid #ccc;">
                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('marketplace'); ?></label>
                                                </div>
                                                <select name="category_market_place" class="form-control input-box" required="required" id="category_market_place">
                                                    <option value=""></option>
                                                    <option value="1">Amazon.com</option>
                                                    <option value="2">Amazon.co.uk</option>
                                                    <option value="3">Amazon.ca</option>
                                                    <option value="4">Amazon.de</option>
                                                    <option value="5">Amazon.es</option>
                                                    <option value="6">Amazon.fr</option>
                                                    <option value="7">Amazon.it</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('category'); ?></label>
                                                </div>
                                                <select name="category_market_category" class="form-control input-box" id="category_market_category">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('monthly_revenue'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_revenue_min" name="category_revenue_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_revenue_max" name="category_revenue_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('sales_year'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_sales_year_min" name="category_sales_year_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_sales_year_max" name="category_sales_year_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('monthly_sales'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_sales_month_min" name="category_sales_month_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_sales_month_max" name="category_sales_month_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('price'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_price_min" name="category_price_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_price_max" name="category_price_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('price_change'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_price_change_min" name="category_price_change_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_price_change_max" name="category_price_change_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('bsr'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_sales_rank_min" name="category_sales_rank_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_sales_rank_max" name="category_sales_rank_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('review_count'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_review_count_min" name="category_review_count_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_review_count_max" name="category_review_count_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('sales_change'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_sales_change_min" name="category_sales_change_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_sales_change_max" name="category_sales_change_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('num_sellers'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_seller_num_min" name="category_seller_num_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_seller_num_max" name="category_seller_num_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('review_rating'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_review_rating_min" name="category_review_rating_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_review_rating_max" name="category_review_rating_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('best_sales'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="text" id="daterange_category_best_period" class="input-category" value="" autocomplete="off" style="width: 100%; height: 34px; font-size: 20px;" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('weight'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_weight_min" name="category_weight_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_weight_max" name="category_weight_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('variation_count'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_variation_count_min" name="category_variation_count_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_variation_count_max" name="category_variation_count_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('sales_review'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_sales_review_min" name="category_sales_review_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_sales_review_max" name="category_sales_review_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('num_images'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_images_num_min" name="category_images_num_min" class="input-category" placeholder="<?= $this->lang->line('min'); ?>">
                                                    </div>
                                                    <div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
                                                        -
                                                    </div>
                                                    <div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_images_num_max" name="category_images_num_max" class="input-category" placeholder="<?= $this->lang->line('max'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('include_keywords'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_include_keyword" name="category_include_keyword" class="input-category">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('exclude_keywords'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
                                                        <input type="text" id="category_exclude_keyword" name="category_exclude_keyword" class="input-category">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label class="control-label"><?= $this->lang->line('fulfillment'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <select name="category_fulfillment" class="form-control input-box" id="category_fulfillment" multiple>
                                                        <option value="<?= $this->lang->line('select_all'); ?>"><?= $this->lang->line('select_all'); ?></option>
                                                        <option value="FBA">FBA</option>
                                                        <option value="FBM">FBM</option>
                                                        <option value="Amazon">Amazon</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                                    <label class="control-label"><?= $this->lang->line('size_tier'); ?></label>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <select name="category_shipping_tier" class="form-control input-box" id="category_shipping_tier" multiple>
                                                        <option value="<?= $this->lang->line('select_all'); ?>"><?= $this->lang->line('select_all'); ?></option>
                                                        <option value="<?= $this->lang->line('small_standard'); ?>"><?= $this->lang->line('small_standard'); ?></option>
                                                        <option value="<?= $this->lang->line('large_standard'); ?>"><?= $this->lang->line('large_standard'); ?></option>
                                                        <option value="<?= $this->lang->line('small_oversize'); ?>"><?= $this->lang->line('small_oversize'); ?></option>
                                                        <option value="<?= $this->lang->line('medium_oversize'); ?>"><?= $this->lang->line('medium_oversize'); ?></option>
                                                        <option value="<?= $this->lang->line('large_oversize'); ?>"><?= $this->lang->line('large_oversize'); ?></option>
                                                        <option value="<?= $this->lang->line('special_oversize'); ?>"><?= $this->lang->line('special_oversize'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin: 30px;">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <center>
                                            <button type="reset" class="btn btn-round btn-default"><?= $this->lang->line('clear'); ?></button>
                                        </center>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <center>
                                            <button type="submit" class="btn btn-round btn-primary"><?= $this->lang->line('search'); ?></button>
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
<div class="modal fade" id="modal_category_history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="width: 650px;">
            <div class="modal-header">
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel"><?= $this->lang->line('category'); ?> <?= $this->lang->line('history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid #e5e5e5; padding: 20px; margin-bottom: 20px;">
                    <table id="table_bigdata_category_history" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead style="background-color: #000000; color: #dedee0">
                        <th width="%5">#</th>
                        <th width="%35"><?= $this->lang->line('marketplace'); ?></th>
                        <th><?= $this->lang->line('category'); ?></th>
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
