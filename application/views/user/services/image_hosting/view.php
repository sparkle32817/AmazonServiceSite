<style>

    label.control-label
    {
        color: #000;
        font-size: 16px;
        font-weight: 500;
    }

    .image-container {
        width: 208px;
        height: 208px;
        display: flex;
        align-items: center;
        margin-left: auto;
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
                <h3>&nbsp;&nbsp;&nbsp;<?= $this->lang->line('image_hosting'); ?>(<?= $this->lang->line('result_view'); ?>)</h3>
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
                        <?php foreach ( $images as $image ){ ?>
                            <div class="col-md-12 col-sm-12 dz-image">
                                <div class="col-md-4 col-sm-6">
                                    <div class="image-container">
                                        <img src="<?= $image; ?>" style="max-width:200px; max-height:200px; ">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 input-group">
                                    <label class="control-label" style="margin-top: 80px; border-bottom: 1px solid #000;"><?= $image; ?></label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

</div>
<!-- /page content -->
