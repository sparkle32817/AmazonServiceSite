<style>

    label.letter
    {
        color: #000;
        font-size: 16px;
        font-weight: 500;
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

    .content{
        padding: 5px;
        margin: 0 auto;
    }
    .content span{
        width: 250px;
    }

    .dz-message{
        text-align: center;
        font-size: 28px;
    }

    .dropzone {
        background: white;
        border-radius: 5px;
        border: 2px dashed rgb(0, 135, 247);
        border-image: none;
        max-width: 660px;
        margin-left: auto;
        margin-right: auto;
    }

    #image_main .dz-image, #image_main .dz-image img{
        width: 200px;
        height: 200px;
    }

    #image_main .dz-error-message{
        top: 130px;
        left: 30px;
        padding: 0.5em 1em;
    }

    #image_swatch .dz-image, #image_swatch .dz-image img{
        width: 200px;
        height: 200px;
    }

    #image_swatch .dz-error-message{
        top: 130px;
        left: 30px;
        padding: 0.5em 1em;
    }

    #image_additional .dz-error-message{
        top: 50px;
        padding: 0.5em 1em;
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
                <h3>&nbsp;&nbsp;&nbsp;Image Hosting</h3>
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
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-10 letter"> •	<?= $this->lang->line('image_txt1'); ?></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-10 letter"> •	<?= $this->lang->line('image_txt2'); ?></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-10 letter"> •	<?= $this->lang->line('image_txt3'); ?></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-10 letter"> •	<?= $this->lang->line('image_txt4'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top: 180px;">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <center>
                                        <button type="reset" class="btn btn-info"><?= $this->lang->line('tutorial_learn'); ?></button>
                                    </center>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <center>
                                        <button type="button" data-toggle="modal" data-target="#modal_iamge_hosting_history" class="btn btn-primary"><?= $this->lang->line('history'); ?></button>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 40px; border-top: 2px solid #46b8da; padding-bottom: 20px;">
                            <div class="item form-group">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="col-md-4 col-sm-4 col-xs-12" style="margin-bottom: 5px;">
                                        <label class="control-label" style="float: right;"><?= $this->lang->line('marketplace'); ?></label>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control input-box" required="required" id="image_market_place">
                                            <option value=""></option>
                                            <option value="1">Amazon.com</option>
                                            <option value="2">Amazon.co.uk</option>
                                            <option value="3">Amazon.ca</option>
                                            <option value="10">Amazon.jp</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="col-md-4 col-sm-4 col-xs-12" style="margin-bottom: 5px;">
                                    <label class="control-label" style="float: right;">SKU</label>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" id="image_sku" class="input-category" required="required" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 20px; border-bottom: 2px solid #ccc; padding-bottom: 50px;">
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-md-12 col-sm-12 col-xs-10 letter">o	<?= $this->lang->line('main_image'); ?> ( <?= $this->lang->line('only_one'); ?> )
                                </div>
                                <DIV class="col-md-12 col-sm-12 col-xs-12">
                                    <FORM class="dropzone needsclick" id="image_main" action="<?= base_url('user/services/ImageHosting/uploadMainFile'); ?>">
                                        <DIV class="dz-message needsclick">
                                            <?= $this->lang->line('drag_drop'); ?>
                                        </DIV>
                                    </FORM>
                                </DIV>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-3"></div><label class="col-md-9 col-sm-9 col-xs-10 letter">o	<?= $this->lang->line('additional_images'); ?> ( <?= $this->lang->line('maximum_images'); ?> )
                                </div>
                                <DIV class="col-md-12 col-sm-12 col-xs-12">
                                    <FORM class="dropzone needsclick" id="image_additional" action="<?= base_url('user/services/ImageHosting/uploadAdditionalFile'); ?>">
                                        <DIV class="dz-message needsclick">
                                            <?= $this->lang->line('drag_drop'); ?>
                                        </DIV>
                                    </FORM>
                                </DIV>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-md-12 col-sm-12 col-xs-10 letter">o	<?= $this->lang->line('swatch_image'); ?> ( <?= $this->lang->line('only_one'); ?> )
                                </div>
                                <DIV class="col-md-12 col-sm-12 col-xs-12">
                                    <FORM class="dropzone needsclick" id="image_swatch" action="<?= base_url('user/services/ImageHosting/uploadSwatchFile'); ?>">
                                        <DIV class="dz-message needsclick">
                                            <?= $this->lang->line('drag_drop'); ?>
                                        </DIV>
                                    </FORM>
                                </DIV>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin: 30px;">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <center>
                                    <button type="button" class="btn btn-round btn-default" id="btn_image_clear"><?= $this->lang->line('clear'); ?></button>
                                </center>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <center>
                                    <button type="button" id="btn_image_upload" class="btn btn-round btn-primary"><?= $this->lang->line('save'); ?></button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content" id="view_images">
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- /page content -->

<!--begin::Modal History-->
<div class="modal fade" id="modal_iamge_hosting_history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="width: 650px;">
            <div class="modal-header">
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel"><?= $this->lang->line('image_hosting'); ?> <?= $this->lang->line('history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid #e5e5e5; padding: 20px; margin-bottom: 20px;">
                    <table id="table_image_hosting_history" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead style="background-color: #000000; color: #dedee0">
                        <th width="%5">#</th>
                        <th width="%35"><?= $this->lang->line('marketplace'); ?></th>
                        <th><?= $this->lang->line('sku'); ?></th>
                        <th><?= $this->lang->line('searched_date'); ?></th>
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
