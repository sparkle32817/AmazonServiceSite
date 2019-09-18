<style>

    .image-container {
        width: 408px;
        height: auto;
        display: flex;
        align-items: center;
        horiz-align: center;
        padding: 4px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;&nbsp;&nbsp;<?= $this->lang->line('account_management'); ?></h3>
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
                    <div class="x_content" style="padding-top: 30px;">
                        <div class="col-md-2 col-sm-3 col-xs-12"></div>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <center>
                                <div class="image-container">
                                    <img src="<?=base_url();?>assets/images/bg1.jpg" style="max-width: 400px;max-height: 400px;">
                                </div>
                                <div style="margin-top: 10px;">
                                    <a href="<?= base_url('services/account_management/main'); ?>" style="font-size: 16px;">
                                        <?= $this->lang->line('account_front_txt'); ?>
                                    </a>
                                </div>
                            </center>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-12"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->