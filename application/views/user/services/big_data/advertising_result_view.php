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

	th, td{
		text-align: center;
		padding: 10px;
		font-size: 15px;
	}

	.table > tbody > tr > td, .table > thead > tr > th{
		vertical-align: middle;
	}

	td.details-control {
		background: url('../../../assets/images/details_open.png') no-repeat center center;
		cursor: pointer;
	}

	tr.shown td.details-control {
		background: url('../../../assets/images/details_close.png') no-repeat center center;
	}

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;&nbsp;&nbsp;<?= $this->lang->line('big_data'); ?> – <?= $this->lang->line('advertising'); ?>(<?= $this->lang->line('result_view'); ?>)</h3>
            </div>

        </div>

        <div></div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 500px;">
					<div class="x_title">
						<h2></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 20px; padding-bottom: 20px; border-bottom: 2px solid #e6e9ed;">
							<div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px;">
								<div class="col-md-2 col-sm-4 col-xs-12">
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('product_asin'); ?></label>
											</div>
											<input type="text" class="input-category" value="<?= $result['asin']; ?>" readonly >
										</div>
									</div>
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
												<label class="control-label"><?= $this->lang->line('marketplace'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="<?= $result['market_place']; ?>" readonly>
											</div>
										</div>
									</div>
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
												<label class="control-label"><?= $this->lang->line('category'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="<?= $result['category']; ?>" readonly>
											</div>
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
													<input type="text" class="input-category" value="<?= $result['revenue_min']!=0?$result['revenue_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['revenue_max']!=0?$result['revenue_max']:''; ?>" readonly>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('sales_year'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['sales_year_min']!=0?$result['sales_year_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['sales_year_max']!=0?$result['sales_year_max']:''; ?>" readonly>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('monthly_sales'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['monthly_sales_min']!=0?$result['monthly_sales_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['monthly_sales_max']!=0?$result['monthly_sales_max']:''; ?>" readonly>
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
													<input type="text" class="input-category" value="<?= $result['price_min']!=0?$result['price_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['price_max']!=0?$result['price_max']:''; ?>" readonly>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('price_change'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['price_change_min']!=0?$result['price_change_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['price_change_max']!=0?$result['price_change_max']:''; ?>" readonly>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('bsr'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['sales_rank_min']!=0?$result['sales_rank_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['sales_rank_max']!=0?$result['sales_rank_max']:''; ?>" readonly>
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
													<input type="text" class="input-category" value="<?= $result['review_cnt_min']!=0?$result['review_cnt_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['review_cnt_max']!=0?$result['review_cnt_max']:''; ?>" readonly>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('sales_change'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['sales_change_min']!=0?$result['sales_change_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['sales_change_max']!=0?$result['sales_change_max']:''; ?>" readonly>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('num_sellers'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['seller_num_min']!=0?$result['seller_num_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['seller_num_max']!=0?$result['seller_num_max']:''; ?>" readonly>
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
													<input type="text" class="input-category" value="<?= $result['review_rating_min']!=0?$result['review_rating_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['review_rating_max']!=0?$result['review_rating_max']:''; ?>" readonly>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('best_sales'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<input type="text" class="input-category" value="<?= $result['best_sales_period']; ?>" readonly>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('weight'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['weight_min']!=0?$result['weight_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['weight_max']!=0?$result['weight_max']:''; ?>" readonly>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-12">
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
												<label class="control-label"><?= $this->lang->line('variation_count'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['variation_cnt_min']!=0?$result['variation_cnt_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['variation_cnt_max']!=0?$result['variation_cnt_max']:''; ?>" readonly>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('sales_review'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['sales_review_min']!=0?$result['sales_review_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['sales_review_max']!=0?$result['sales_review_max']:''; ?>" readonly>
												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('num_images'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['image_num_min']!=0?$result['image_num_min']:''; ?>" readonly>
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
													-
												</div>
												<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['image_num_max']!=0?$result['image_num_max']:''; ?>" readonly>
												</div>
											</div>
										</div>
									</div>
								</div><div class="col-md-12 col-sm-12 col-xs-12">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('exclude_keywords'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['ex_keywords'];?>" readonly>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('include_keywords'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
													<input type="text" class="input-category" value="<?= $result['in_keywords']; ?>" readonly>
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
												<input type="text" class="input-category" value="<?= $result['fulfillment'];?>" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label"><?= $this->lang->line('relevance_type'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<input type="text" class="input-category" value="<?= $result['shipping_tier']; ?>" readonly>
											</div>
										</div>
									</div>
								</div>
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
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; padding-bottom: 10px;border-bottom: #46b8da solid 2px;">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<label style="font-size: 22px; color: red;"><?= $total_cnt; ?>&nbsp;<small style="font-size: 20px; color: #000;"><?= $this->lang->line('product_found'); ?></small></label>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
                                <p style="color: #000; float: right;"><?= $this->lang->line('download_result'); ?>
                                    <a href="<?= ($export_file_name); ?>" class="btn btn-round btn-default" style="width: 60px; margin-top: -2px; margin-right: 40px; cursor: pointer;" title="<?= $this->lang->line('download_result'); ?>">
                                        <i class="fa fa-download" style=" font-size: 20px;"></i>
                                    </a>
                                </p>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 40px;">
							<input type="hidden" id="view_task_id" value="<?= $view_task_id; ?>">
							<table id="table_bigdata_advertising" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
								<thead style="background-color: #000; /*font-size: 10px;*/ color: #dedee0">
								<th width="3%"></th>
								<th width="10%"><?= $this->lang->line('asin'); ?></th>
								<th width="40%"><?= $this->lang->line('t_product'); ?></th>
								<th><?= $this->lang->line('t_bought_together'); ?></th>
								<th><?= $this->lang->line('t_customer_bought'); ?></th>
								<th><?= $this->lang->line('t_amazon_suggested'); ?></th>
								<th><?= $this->lang->line('t_sellers'); ?></th>
								<th><?= $this->lang->line('t_price'); ?></th>
								<th><?= $this->lang->line('t_monthly_sales'); ?></th>
								<th><?= $this->lang->line('t_monthly_revenue'); ?></th>
								<th><?= $this->lang->line('t_bsr'); ?></th>
								<th><?= $this->lang->line('t_reviews'); ?></th>
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

<input type="hidden" id="txt_advertising_title" value="<?= $this->lang->line('title'); ?>">
<input type="hidden" id="txt_advertising_category" value="<?= $this->lang->line('category'); ?>">
<input type="hidden" id="txt_advertising_brand" value="<?= $this->lang->line('brand'); ?>">
<input type="hidden" id="txt_advertising_fulfillment" value="<?= $this->lang->line('fulfillment'); ?>">
<input type="hidden" id="txt_advertising_size_tier" value="<?= $this->lang->line('size_tier'); ?>">
<input type="hidden" id="txt_advertising_num_images" value="<?= $this->lang->line('num_images'); ?>">
<input type="hidden" id="txt_advertising_variation_count" value="<?= $this->lang->line('variation_count'); ?>">
<input type="hidden" id="txt_advertising_weight" value="<?= $this->lang->line('weight'); ?>">

<input type="hidden" id="txt_last_year_sales" value="<?= $this->lang->line('last_year_sales'); ?>">
<input type="hidden" id="txt_sales_year" value="<?= $this->lang->line('sales_year'); ?>">
<input type="hidden" id="txt_best_sales" value="<?= $this->lang->line('best_sales'); ?>">
<input type="hidden" id="txt_sales_review" value="<?= $this->lang->line('sales_review'); ?>">
<input type="hidden" id="txt_sales_trend" value="<?= $this->lang->line('sales_trend'); ?>">
<input type="hidden" id="txt_price_trend" value="<?= $this->lang->line('price_trend'); ?>">