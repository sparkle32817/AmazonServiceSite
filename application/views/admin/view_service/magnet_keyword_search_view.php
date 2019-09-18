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
                <h3>&nbsp;&nbsp;&nbsp;Magnet Related Keyword Search (Result View)</h3>
            </div>

        </div>

        <div></div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 500px;">
					<div class="x_content">
						<div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 20px; padding-bottom: 20px; border-bottom: 2px solid #46b8da;">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 10px; border-bottom: 2px solid #101010;">
									<?php if (!empty($keyword)){ ?>
										<p style="margin-left: 40px; font-size: 24px; font-weight: 700; color: #000;"><?= $keyword; ?></p>
									<?php } ?>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px;">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
											<div class="col-md-3 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
												<label class="control-label">Search Volume : </label>
											</div>
											<div class="col-md-9 col-sm-12 col-xs-12" style="padding: 0px;">
												<?php if ($result['search_volume']!=0){ ?>
													<p style="font-size: 16px; color: red;"><?= $result['search_volume']; ?></p>
												<?php } ?>
											</div>
										</div>
									</div>
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
											<div class="col-md-3 col-sm-12 col-xs-12">
												<label class="control-label">Keyword Score : </label>
											</div>
											<div class="col-md-9 col-sm-12 col-xs-12" style="padding: 0px;">
												<?php if ($result['iq_score']!=0){ ?>
													<p style="font-size: 16px; color: red;"><?= $result['iq_score']; ?></p>
												<?php } ?>
											</div>
										</div>
									</div>
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px; margin-bottom: 30px;">
											<div class="col-md-4 col-sm-12 col-xs-12">
												<label class="control-label">Rank on Page 1 Search : </label>
											</div>
											<div class="col-md-8 col-sm-12 col-xs-12" style="padding: 0px;">
												<?php if ($result['give_aways']!=0){ ?>
													<p style="font-size: 16px; color: red;">Sell minimum <small style="font-size: 16px; color: blue;"><?= $result['give_aways']; ?></small> per week</p>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-7 col-sm-7 col-xs-12">
									<div class="item form-group">
										<div class="col-md-11 col-sm-11 col-xs-11" style="margin-top: 50px;">
											<div class="col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 5px;">
												<label class="control-label">Match Type :</label>
											</div>
											<div class="col-md-9 col-sm-9 col-xs-12" style="padding: 0px;">
												<label class="control-label">Organic Keyword</label>&nbsp;&nbsp;&nbsp;
												<?php if ($result['organic']==1){ ?>
													<i class="fa fa-check-circle-o" style="font-size: 20px; color: #65a035;"></i>
												<?php } ?>
											</div>
										</div>
									</div>
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
											<div class="col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 5px;">
												<label class="control-label"></label>
											</div>
											<div class="col-md-9 col-sm-9 col-xs-12" style="padding: 0px;">
												<label class="control-label">Smart Complete Keyword</label>&nbsp;&nbsp;&nbsp;
												<?php if ($result['smart_complete']==1){ ?>
													<i class="fa fa-check-circle-o" style="font-size: 20px; color: #65a035;"></i>
												<?php } ?>
											</div>
										</div>
									</div>
									<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px; margin-bottom: 30px;">
											<div class="col-md-3 col-sm-3 col-xs-12" style="margin-bottom: 5px;">
												<label class="control-label"></label>
											</div>
											<div class="col-md-9 col-sm-9 col-xs-12" style="padding: 0px;">
												<label class="control-label">Amazon Recommended Keyword</label>&nbsp;&nbsp;&nbsp;
												<?php if ($result['amz_recommended']==1){ ?>
													<i class="fa fa-check-circle-o" style="font-size: 20px; color: #65a035;"></i>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12"></div>
							</div>
						</div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label">Total Keywords : <small style="font-size: 18px; color: red;"><?= $keyword_count['cnt_phrase']; ?></small></label>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label">Organic Keywords : <small style="font-size: 18px; color: red;"><?= $keyword_count['cnt_organic']; ?></small></label>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label">Smart Complete Keywords : <small style="font-size: 18px; color: red;"><?= $keyword_count['cnt_smart']; ?></small></label>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <label class="control-label">Amazon Recommended Keywords : <small style="font-size: 18px; color: red;"><?= $keyword_count['cnt_amz']; ?></small></label>
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
							<table id="table_magnet" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
								<thead style="background-color: #000000; color: #dedee0">
									<th width="3%">#</th>
									<th>Keyword</th>
									<th>Keyword<br/> Score </th>
									<th>Exact<br/> search Volume </th>
									<th>Sponsored<br/> Products </th>
									<th>Headline<br/> Products </th>
									<th>Competing<br/> Products </th>
									<th>Min Units to Sell<br/> per Week To Rank<br/> on Page 1 Search </th>
									<th>Amazon<br/> Recommended<br/> Keyword</th>
									<th>Smart<br/> Complete<br/> Keyword </th>
									<th>Organic<br/> Keyword </th>
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
