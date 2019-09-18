<style>

    label.control-label
    {
        color: #000;
        font-size: 16px;
        font-weight: 500;
    }

    input.input-optimization
    {
        width: 100%;
        height: 34px;
        font-size: 16px;
        padding-left: 10px;
        border: none;
        border-bottom: 1px solid #CCC;
    }

    textarea{
        resize: none;
        width: 400px;
        height: 350px;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;&nbsp;&nbsp;Search Term Optimization(Result View)</h3>
            </div>

        </div>

        <div></div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="min-height: 1050px;">
                    <div class="x_title">
                        <h2></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding-top: 20px; padding-bottom: 20px; border-bottom: 2px solid #46b8da;">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 10px;">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <div class="item form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                <label class="control-label">Market Place</label>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
                                                <input type="text" class="input-optimization" value="<?= $input_result['market']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label class="control-label">Product Asin</label>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
                                                <input type="text" class="input-optimization" value="<?= $input_result['asin']; ?>" readonly>
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
                                            <textarea id="key_checker_textarea" readonly><?php
                                                $keywords = explode(",", $input_result['keywords']);

                                                foreach ($keywords as  $keyword)
                                                {
                                                    echo $keyword.'&#13;&#10;';
                                                }
                                                ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12"></div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                            <div style="margin-left: 30px; border-bottom: 2px solid #d2d8e0;">
                                <p style="font-size: 24px; color: #000;">Our Suggestion:</p>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 40px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Search Term : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['search_term']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Subject Matter #1 : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['subject1']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Subject Matter #2 : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['subject2']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Subject Matter #3 : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['subject3']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Subject Matter #4 : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['subject4']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                        <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                            <label class="control-label" for="name" style="float:right;">Subject Matter #5 : </label>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['subject5']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12 col-xs-12" style="padding-left: 50px;">
                                    <?php if ($searched_result['search_type'] == 2){ ?>
                                    <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                            <label class="control-label">Our Suggested Targeted Keywords</label>
                                        </div>
                                        <textarea id="key_checker_textarea" readonly><?php
                                            $keywords = explode(",", $searched_result['keywords']);

                                            foreach ($keywords as  $keyword)
                                            {
                                                echo $keyword.'&#13;&#10;';
                                            }
                                            ?>
                                        </textarea>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
