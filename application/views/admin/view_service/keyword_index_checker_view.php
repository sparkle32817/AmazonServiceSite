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

	.table > tbody > tr > td{
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
                <h3>&nbsp;&nbsp;&nbsp;AMZ Product Keyword Index Checker(Result View)</h3>
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
						<div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 20px; padding-bottom: 20px; border-bottom: 2px solid #46b8da;">
							<div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px;">
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
												<label class="control-label"><?= $this->lang->line('marketplace'); ?></label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="<?= $result['market_place']; ?>" readonly>
											</div>
										</div>
									</div>
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label">Product Asin</label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="<?= $result['asin']; ?>" readonly>
											</div>
										</div>
									</div>
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px; margin-bottom: 30px;">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label class="control-label">Seller ID</label>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="<?= $result['seller_id']; ?>" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
												<label class="control-label">Keywords</label>
											</div>
                                            <textarea id="key_checker_textarea" readonly><?php echo str_replace(',', '&#13;&#10;', $result['keywords']); ?></textarea>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12"></div>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 40px;">
                            <input type="hidden" id="cur_status" value="<?= $status; ?>">
							<input type="hidden" id="view_asin_id" value="<?= $view_asin_id; ?>">
							<table id="table_key_checker" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
								<thead style="background-color: #000000; color: #dedee0">
									<th width="3%"></th>
									<th>Keyword</th>
									<th>Traditional Index</th>
									<th>Field-ASIN Index</th>
									<th>Storefront Index</th>
									<th>Cumulative</th>
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
