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
                <h3>&nbsp;&nbsp;&nbsp;Reverse ASIN Search (Result View)</h3>
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
                                                    <label class="control-label">Marketplace : </label>
                                                </div>
                                                <div class="col-md-9 col-sm-12 col-xs-12" style="padding: 0px;">
                                                    <?php if (!empty($result['market'])){ ?>
                                                        <p style="font-size: 16px; color: red;"><?= $result['market']; ?></p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="item form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                                <div class="col-md-3 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label">Product ASIN : </label>
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
                                <label class="control-label">Total Keywords : <small style="font-size: 18px; color: red;"><?= $keyword_count['cnt_phrase']; ?></small></label>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label">Organic Keywords : <small style="font-size: 18px; color: red;"><?= $keyword_count['sum_organic']; ?></small></label>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label">Sponsored Keywords : <small style="font-size: 18px; color: red;"><?= $keyword_count['sum_sponsored']; ?></small></label>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label">Amazon Recommended Keywords : <small style="font-size: 18px; color: red;"><?= $keyword_count['sum_amz_recommended']; ?></small></label>
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
						<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 40px;">
							<input type="hidden" id="view_task_id" value="<?= $view_keyword_id; ?>">
							<table id="table_reverse_asin" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
								<thead style="background-color: #000000; color: #dedee0">
									<th width="3%">#</th>
									<th>Keyword</th>
									<th>Rank<br/> Boost URL</th>
									<th>Opportunity<br/> Score </th>
									<th>Exact<br/> search Volume </th>
									<th>Sponsored<br/> Products </th>
									<th>Competing<br/> Products </th>
									<th>Min Units to Sell<br/> per Week To Rank<br/> on Page 1 Search </th>
									<th>Amazon<br/> Recommended<br/> Keyword</th>
									<th>Sponsored <br/> Keyword </th>
									<th>Organic<br/> Keyword </th>
                                    <th>Amazon<br/> Recommended<br/> Rank  </th>
                                    <th>Sponsored <br/> Rank </th>
                                    <th>Organic<br/> Rank </th>
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
