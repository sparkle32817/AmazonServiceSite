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
        max-width: 500px;
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
                                        <label class="col-md-12 col-sm-12 col-xs-10 letter"> •	Images must be at least 1000 pixels on its shortest side.</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-10 letter"> •	Images can’t exceed 10,000 pixels on its longest side.</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-10 letter"> •	Only JPEG files are acceptable.</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10">
                                        <label class="col-md-12 col-sm-12 col-xs-10 letter"> •	Allow 15-30 mins for the URL to be accessible.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top: 180px;">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <center>
                                        <button type="reset" class="btn btn-info">Tutorial & Learn</button>
                                    </center>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <center>
                                        <button type="button" data-toggle="modal" data-target="#modal_iamge_hosting_history" class="btn btn-primary">History</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 40px; border-top: 2px solid #46b8da; padding-bottom: 20px;">
                            <div class="item form-group">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="col-md-4 col-sm-4 col-xs-12" style="margin-bottom: 5px;">
                                        <label class="control-label" style="float: right;">Market Place</label>
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
                                    <label class="col-md-12 col-sm-12 col-xs-10 letter">o	Main Image ( Only one image )
                                </div>
                                <DIV class="col-md-12 col-sm-12 col-xs-12">
                                    <FORM class="dropzone needsclick" id="image_main" action="<?= base_url('user/services/ImageHosting/uploadMainFile'); ?>">
                                        <DIV class="dz-message needsclick">
                                            Drop files here or click to upload.
                                        </DIV>
                                    </FORM>
                                </DIV>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-2 col-sm-3"></div><label class="col-md-9 col-sm-9 col-xs-10 letter">o	Additional Images ( Maximum 6 images )
                                </div>
                                <DIV class="col-md-12 col-sm-12 col-xs-12">
                                    <FORM class="dropzone needsclick" id="image_additional" action="<?= base_url('user/services/ImageHosting/uploadAdditionalFile'); ?>">
                                        <DIV class="dz-message needsclick">
                                            Drop files here or click to upload.
                                        </DIV>
                                    </FORM>
                                </DIV>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-md-12 col-sm-12 col-xs-10 letter">o	Swatch Image ( Only one image )
                                </div>
                                <DIV class="col-md-12 col-sm-12 col-xs-12">
                                    <FORM class="dropzone needsclick" id="image_swatch" action="<?= base_url('user/services/ImageHosting/uploadSwatchFile'); ?>">
                                        <DIV class="dz-message needsclick">
                                            Drop files here or click to upload.
                                        </DIV>
                                    </FORM>
                                </DIV>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin: 30px;">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <center>
                                    <button type="button" class="btn btn-round btn-default" id="btn_image_clear">Clear</button>
                                </center>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <center>
                                    <button type="button" id="btn_image_upload" class="btn btn-round btn-primary">Save</button>
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
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel">Image Hosting History</h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid #e5e5e5; padding: 20px; margin-bottom: 20px;">
                    <table id="table_image_hosting_history" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead style="background-color: #000000; color: #dedee0">
                        <th width="%5">#</th>
                        <th width="%35">Market Place</th>
                        <th>SKU</th>
                        <th>Date Searched</th>
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
