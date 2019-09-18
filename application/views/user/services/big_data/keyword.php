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

	input.input-keyword
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

	#table_bigdata_keyword_history{
		z-index: 1100 !important;
	}

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;&nbsp;&nbsp;Big Data – Keyword</h3>
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
										<label class="col-md-12 col-sm-12 col-xs-10 letter"> •  Search research generally will be available within 12 hours. (Fastest: 15 minutes).</label>
									</div>
								</div>
								<div class="form-group col-md-12 col-sm-12 col-xs-12">
									<div class="col-md-2 col-sm-2 col-xs-2">
									</div>
									<div class="col-md-10 col-sm-10 col-xs-10">
										<label class="col-md-12 col-sm-12 col-xs-12 letter"> •	Notice: Entering Too many criteria may return 0 or very few results. </label>
									</div>
								</div>
								<div class="form-group col-md-12 col-sm-12 col-xs-12">
									<div class="col-md-2 col-sm-2 col-xs-2">
									</div>
									<div class="col-md-10 col-sm-10 col-xs-10">
										<label class="col-md-12 col-sm-12 col-xs-12 letter"> •	Maximum of 200 Products will be shown. </label>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12" style="margin-top: 110px;">
								<div class="col-md-4 col-sm-4 col-xs-12">
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<center>
										<button type="reset" class="btn btn-info">Tutorial & Learn</button>
									</center>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<center>
										<button type="submit" id="btn_keyword_history" data-toggle="modal" data-target="#modal_keyword_history" class="btn btn-primary">History</button>
									</center>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 20px; padding-bottom: 20px; border-top: 2px solid #46b8da;">
							<form class="form-horizontal form-label-left" id="keyword_form" action="javascript:;" novalidate>
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px; border-bottom: 2px solid #ccc;">
									<div class="col-md-2 col-sm-4 col-xs-12">
										<div class="item form-group">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
													<label class="control-label">Market Place</label>
												</div>
												<select name="keyword_market_place" class="form-control input-box" required="required" id="keyword_market_place">
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
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px;">
												<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
													<label class="control-label">Category</label>
												</div>
												<select name="keyword_market_category" class="form-control input-box" id="keyword_market_category" multiple>
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-2 col-sm-4 col-xs-12">
										<div class="item form-group">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
													<label class="control-label">Monthly Revenue</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_revenue_min" name="keyword_revenue_min" class="input-keyword" placeholder="Min">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
														-
													</div>
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_revenue_max" name="keyword_revenue_max" class="input-keyword" placeholder="Max">
													</div>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<label class="control-label">Monthly Sales(Units)</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_sales_month_min" name="keyword_sales_month_min" class="input-keyword" placeholder="Min">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
														-
													</div>
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_sales_month_max" name="keyword_sales_month_max" class="input-keyword" placeholder="Max">
													</div>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<label class="control-label">Competing Product</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_competing_product_min" class="input-keyword" placeholder="Min">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
														-
													</div>
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_competing_product_max" class="input-keyword" placeholder="Max">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-2 col-sm-4 col-xs-12">
										<div class="item form-group">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
													<label class="control-label">Price</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_price_min" name="keyword_price_min" class="input-keyword" placeholder="Min">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
														-
													</div>
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_price_max" name="keyword_price_max" class="input-keyword" placeholder="Max">
													</div>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<label class="control-label">Best Sales Rank(BSR)</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_sales_rank_min" name="keyword_sales_rank_min" class="input-keyword" placeholder="Min">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
														-
													</div>
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_sales_rank_max" name="keyword_sales_rank_max" class="input-keyword" placeholder="Max">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-2 col-sm-4 col-xs-12">
										<div class="item form-group">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
													<label class="control-label">Review Count</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_review_count_min" name="keyword_review_count_min" class="input-keyword" placeholder="Min">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
														-
													</div>
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_review_count_max" name="keyword_review_count_max" class="input-keyword" placeholder="Max">
													</div>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<label class="control-label">Number of Sellers</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_seller_num_min" name="keyword_seller_num_min" class="input-keyword" placeholder="Min">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
														-
													</div>
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_seller_num_max" name="keyword_seller_num_max" class="input-keyword" placeholder="Max">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-2 col-sm-4 col-xs-12">
										<div class="item form-group">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
													<label class="control-label">Review Rating</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_review_rating_min" name="keyword_review_rating_min" class="input-keyword" placeholder="Min">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
														-
													</div>
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_review_rating_max" name="keyword_review_rating_max" class="input-keyword" placeholder="Max">
													</div>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<label class="control-label">Best Sales Period</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<input id="daterange_keyword_best_period" class="input-keyword" value="" autocomplete="off" style="width: 100%; height: 34px; font-size: 20px;" readonly>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-2 col-sm-4 col-xs-12">
										<div class="item form-group">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
													<label class="control-label">Variation Count</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_variation_count_min" name="keyword_variation_count_min" class="input-keyword" placeholder="Min">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
														-
													</div>
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_variation_count_max" name="keyword_variation_count_max" class="input-keyword" placeholder="Max">
													</div>
												</div>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<label class="control-label">Search Volume</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_search_volume_min" class="input-keyword" placeholder="Min">
													</div>
													<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
														-
													</div>
													<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_search_volume_max" class="input-keyword" placeholder="Max">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<label class="control-label">Include Keyword:</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_include_keyword" name="keyword_include_keyword" class="input-keyword">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<label class="control-label">Exclude Keyword:</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
														<input type="text" id="keyword_exclude_keyword" name="keyword_exclude_keyword" class="input-keyword">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<label class="control-label">Fulfillment</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<select name="keyword_fulfillment" class="form-control input-box" id="keyword_fulfillment" multiple>
														<option value="Select All">Select All</option>
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
													<label class="control-label">Shipping Size Tier</label>
												</div>
												<div class="col-md-12 col-sm-12 col-xs-12">
													<select name="keyword_shipping_tier" class="form-control input-box" id="keyword_shipping_tier" multiple>
														<option value="Select All">Select All</option>
														<option value="Small Standard-Size">Small Standard-Size</option>
														<option value="Large Standard-Size">Large Standard-Size</option>
														<option value="Small Oversize">Small Oversize</option>
														<option value="Medium Oversize">Medium Oversize</option>
														<option value="Large Oversize">Large Oversize</option>
														<option value="Special Oversize">Special Oversize</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12" style="margin: 30px;">
									<div class="col-md-6 col-sm-6 col-xs-6">
										<center>
											<button type="reset" class="btn btn-round btn-default">Clear</button>
										</center>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-6">
										<center>
											<button type="submit" class="btn btn-round btn-primary">Search</button>
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
<div class="modal fade" id="modal_keyword_history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content" style="width: 650px;">
			<div class="modal-header">
				<h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel">Keyword History</h4>
				<button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid #e5e5e5; padding: 20px; margin-bottom: 20px;">
					<table id="table_bigdata_keyword_history" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
						<thead style="background-color: #000000; color: #dedee0">
							<th width="%5">#</th>
							<th width="%35">Marketplace</th>
							<th>Category</th>
							<th>Date<br/> Searched</th>
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
