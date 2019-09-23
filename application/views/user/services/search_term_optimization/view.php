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
                <h3>&nbsp;&nbsp;&nbsp;<?= $this->lang->line('search_term_optimization'); ?>(<?= $this->lang->line('result_view'); ?>)</h3>
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
                                                <label class="control-label"><?= $this->lang->line('marketplace'); ?></label>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
                                                <input type="text" class="input-optimization" value="<?= $input_result['market']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label class="control-label"><?= $this->lang->line('product_asin'); ?></label>
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
                                                <label class="control-label"><?= $this->lang->line('keywords'); ?></label>
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
                                <p style="font-size: 24px; color: #000;"><?= $this->lang->line('our_suggestion'); ?>:</p>
                            </div>
                            <?php if (empty($searched_result))
                            {
                            ?>
                                <center>
                                    <p style="margin-top: 20px; color:red; font-size: 18px;">There are no results for the criteria you have entered. Try removing some criteria to get better search results.<br>PS: Your Credits for this search has been refunded</p>
                                </center>
                            <?php
                            }
                            else
                            {
                                ?>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 40px;">
                                            <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                                <label class="control-label" for="name" style="float:right;"><?= $this->lang->line('search_term'); ?> : </label>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['search_term']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
                                            <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                                <label class="control-label" for="name" style="float:right;"><?= $this->lang->line('subject_matter'); ?> #1 : </label>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['subject1']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                            <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                                <label class="control-label" for="name" style="float:right;"><?= $this->lang->line('subject_matter'); ?> #2 : </label>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['subject2']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                            <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                                <label class="control-label" for="name" style="float:right;"><?= $this->lang->line('subject_matter'); ?> #3 : </label>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['subject3']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                            <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                                <label class="control-label" for="name" style="float:right;"><?= $this->lang->line('subject_matter'); ?> #4 : </label>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['subject4']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="item form-group col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                                            <div class="col-md-4 col-sm-4 col-xs-12" style="margin-top: 5px;">
                                                <label class="control-label" for="name" style="float:right;"><?= $this->lang->line('subject_matter'); ?> #5 : </label>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <input type="text" class="input-optimization col-md-7 col-xs-12" value="<?= $searched_result['subject5']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-12 col-xs-12" style="padding-left: 50px;">
                                        <?php if ($searched_result['search_type'] == 1 && !empty($searched_result['keywords'])){ ?>
                                            <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('not_used_keywords') ?></label>
                                                </div>
                                                <textarea readonly><?php $keywords = explode(",", $searched_result['keywords']); foreach ($keywords as  $keyword){ echo $keyword.'&#13;&#10;'; } ?></textarea>
                                            </div>
                                        <?php } ?>
                                        <?php if ($searched_result['search_type'] == 2){ ?>
                                            <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
                                                    <label class="control-label"><?= $this->lang->line('targeted_keywords') ?></label>
                                                </div>
                                                <textarea readonly><?php $keywords = explode(",", $searched_result['keywords']); foreach ($keywords as  $keyword){ echo $keyword.'&#13;&#10;'; } ?></textarea>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
