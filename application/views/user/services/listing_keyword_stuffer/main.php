<style>

    .div-area{
        height: 300px;
    }

    label.control-label
    {
        color: #000;
        font-size: 16px;
        padding: 0px;
    }

    .textarea-listing-stuffer {
        width: 100%;
        height: 90px;
        border: none;
        background-color: #f2f2f2;
        resize: none;
        color: black;
    }

    textarea:hover,
    textarea:active,
    textarea:focus {
        outline:0px !important;
        -webkit-appearance:none;
        box-shadow: none !important;
    }
    .not-selectable {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .ps--active-y > .ps__rail-y {
        top: 0px !important;
    }

    .ps--active-x > .ps__rail-x {
        left: 0px !important;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?= $this->lang->line('listing_stuffer'); ?></h3>
            </div>

        </div>

        <div></div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-4 col-md-offset-8 col-sm-4 col-xs-12">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <center>
                                    <button type="reset" class="btn btn-info"><?= $this->lang->line('tutorial_learn'); ?></button>
                                </center>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <center>
                                    <button type="button" data-toggle="modal" data-target="#modal_listing_stuffer_history" class="btn btn-primary"><?= $this->lang->line('history'); ?></button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="x_panel" style="padding: 0; height: 1320px;">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-4" id="div_input_keywords" style="display: <?= $result['searched_text']==''?'block':'none'; ?>;">
                            <form id="form_stuffer" action="javascript:;" novalidate>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                    <div class="item form-group">
                                        <select class="form-control" required="required" id="stuffer_market_place" style=" border-radius: 5px;">
                                            <option value="">--<?= $this->lang->line('market_place'); ?>--</option>
                                            <option value="1" <?= $result['market_id']==1?'selected':''; ?>>Amazon.com</option>
                                            <option value="3" <?= $result['market_id']==3?'selected':''; ?>>Amazon.ca</option>
                                            <option value="9" <?= $result['market_id']==9?'selected':''; ?>>Amazon.com.mx</option>
                                            <option value="4" <?= $result['market_id']==4?'selected':''; ?>>Amazon.de</option>
                                            <option value="5" <?= $result['market_id']==5?'selected':''; ?>>Amazon.es</option>
                                            <option value="6" <?= $result['market_id']==6?'selected':''; ?>>Amazon.fr</option>
                                            <option value="7" <?= $result['market_id']==7?'selected':''; ?>>Amazon.it</option>
                                            <option value="2" <?= $result['market_id']==2?'selected':''; ?>>Amazon.co.uk</option>
                                            <option value="8" <?= $result['market_id']==8?'selected':''; ?>>Amazon.in</option>
                                            <option value="10" <?= $result['market_id']==10?'selected':''; ?>>Amazon.co.jp</option>
                                            <option value="11" <?= $result['market_id']==11?'selected':''; ?>>Amazon.tr</option>
                                            <option value="12" <?= $result['market_id']==12?'selected':''; ?>>Amazon.au</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <textarea id="stuffer_textarea" required="required" style="width: 100%; height: 800px; resize: none; border-radius: 5px;" placeholder="<?= $this->lang->line('area_txt'); ?>"><?php echo str_replace(',', '&#13;&#10;', $result['searched_text']); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin: 10px;">
                                    <div class="item form-group">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <center>
                                                <button type="reset" class="btn btn-round btn-default"><?= $this->lang->line('clear'); ?></button>
                                            </center>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <center>
                                                <button type="button" id="btn_stuffer_cancel" class="btn btn-round btn-danger" style="display: <?= $result['searched_text']!=''?'block':'none'; ?>;"><?= $this->lang->line('cancel'); ?></button>
                                            </center>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <center>
                                                <button type="submit" id="btn_stuffer_apply" class="btn btn-round btn-primary"><?= $this->lang->line('apply'); ?></button>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" id="div_display_keywords" style="display: <?= $result['searched_text']!=''?'block':'none'; ?>;">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="height: 500px; border-bottom: solid 1px #c4c4c4;">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;margin-bottom: 10px;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label class="control-label"><?= $this->lang->line('upper_words'); ?> ( <span id="word_cross_cnt">0</span> / <span id="word_total_cnt">0</span> )</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="scroller-div-area-word"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="height: 800px;">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;margin-bottom: 10px;">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label class="control-label"><?= $this->lang->line('upper_phrases'); ?> ( <span id="phrase_cross_cnt">0</span> / <span id="phrase_total_cnt">0</span> )</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                    <span id="words_list_edit" style="font-size: 14px; float:right; color: #615dff; cursor:pointer;">
                                        <i class="glyphicon glyphicon-pencil"></i>&nbsp; <?= $this->lang->line('edit_list'); ?>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="scroller-div-area-phrase"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding: 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('title'); ?></label></div>
                                <div class="col-md-6 col-sm-6 col-sx-6">
                                    <span style="font-size: 13px; float:right;">
                                        <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="0">0</span>/200 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="0">0</span><?= $this->lang->line('words'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                    &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                    &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                    &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                    &nbsp;<span>&#8624;</span>&nbsp;
                                    &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                </div>
                                <textarea class="textarea-listing-stuffer" e-id="0" maxlength="200"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                            <div class="col-md-6 col-sm-12 col-xs-12" style="padding: 0px 10px 0px 0px;">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding: 0;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('bullet_point'); ?> #1</label></div>
                                        <div class="col-md-6 col-sm-6 col-sx-6">
                                            <span style="font-size: 13px; float:right;">
                                                <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="1">0</span>/100 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="1">0</span><?= $this->lang->line('words'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                            &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                            &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                            &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                            &nbsp;<span>&#8624;</span>&nbsp;
                                            &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                        </div>
                                        <textarea class="textarea-listing-stuffer" e-id="1" maxlength="100"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding: 0;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('bullet_point'); ?> #2</label></div>
                                        <div class="col-md-6 col-sm-6 col-sx-6">
                                            <span style="font-size: 13px; float:right;">
                                                <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="2">0</span>/100 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="2">0</span> <?= $this->lang->line('words'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                            &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                            &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                            &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                            &nbsp;<span>&#8624;</span>&nbsp;
                                            &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                        </div>
                                        <textarea class="textarea-listing-stuffer" e-id="2" maxlength="100"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding: 0;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('bullet_point'); ?> #3</label></div>
                                        <div class="col-md-6 col-sm-6 col-sx-6">
                                            <span style="font-size: 13px; float:right;">
                                                <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="3">0</span>/100 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="3">0</span><?= $this->lang->line('words'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                            &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                            &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                            &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                            &nbsp;<span>&#8624;</span>&nbsp;
                                            &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                        </div>
                                        <textarea class="textarea-listing-stuffer" e-id="3" maxlength="100"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding: 0;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('bullet_point'); ?> #4</label></div>
                                        <div class="col-md-6 col-sm-6 col-sx-6">
                                            <span style="font-size: 13px; float:right;">
                                                <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="4">0</span>/100 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="4">0</span><?= $this->lang->line('words'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                            &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                            &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                            &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                            &nbsp;<span>&#8624;</span>&nbsp;
                                            &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                        </div>
                                        <textarea class="textarea-listing-stuffer" e-id="4" maxlength="100"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding: 0;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('bullet_point'); ?> #5</label></div>
                                        <div class="col-md-6 col-sm-6 col-sx-6">
                                            <span style="font-size: 13px; float:right;">
                                                <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="5">0</span>/100 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="5">0</span><?= $this->lang->line('words'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                            &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                            &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                            &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                            &nbsp;<span>&#8624;</span>&nbsp;
                                            &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                        </div>
                                        <textarea class="textarea-listing-stuffer" e-id="5" maxlength="100"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12" style="padding: 0px 0px 0px                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     10px;">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding: 0;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('subject_matter'); ?> #1</label></div>
                                        <div class="col-md-6 col-sm-6 col-sx-6">
                                            <span style="font-size: 13px; float:right;">
                                                <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="6">0</span>/50 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="6">0</span><?= $this->lang->line('words'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                            &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                            &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                            &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                            &nbsp;<span>&#8624;</span>&nbsp;
                                            &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                        </div>
                                        <textarea class="textarea-listing-stuffer" e-id="6" maxlength="50"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding: 0;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('subject_matter'); ?> #2</label></div>
                                        <div class="col-md-6 col-sm-6 col-sx-6">
                                            <span style="font-size: 13px; float:right;">
                                                <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="7">0</span>/50 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="7">0</span><?= $this->lang->line('words'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                            &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                            &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                            &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                            &nbsp;<span>&#8624;</span>&nbsp;
                                            &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                        </div>
                                        <textarea class="textarea-listing-stuffer" e-id="7" maxlength="50"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding: 0;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('subject_matter'); ?> #3</label></div>
                                        <div class="col-md-6 col-sm-6 col-sx-6">
                                            <span style="font-size: 13px; float:right;">
                                                <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="8">0</span>/50 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="8">0</span><?= $this->lang->line('words'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                            &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                            &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                            &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                            &nbsp;<span>&#8624;</span>&nbsp;
                                            &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                        </div>
                                        <textarea class="textarea-listing-stuffer" e-id="8" maxlength="50"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding: 0;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('subject_matter'); ?> #4</label></div>
                                        <div class="col-md-6 col-sm-6 col-sx-6">
                                            <span style="font-size: 13px; float:right;">
                                                <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="9">0</span>/50 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="9">0</span><?= $this->lang->line('words'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                            &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                            &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                            &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                            &nbsp;<span>&#8624;</span>&nbsp;
                                            &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                        </div>
                                        <textarea class="textarea-listing-stuffer" e-id="9" maxlength="50"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px; padding: 0;">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('subject_matter'); ?> #5</label></div>
                                        <div class="col-md-6 col-sm-6 col-sx-6">
                                            <span style="font-size: 13px; float:right;">
                                                <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="10">0</span>/50 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="10">0</span><?= $this->lang->line('words'); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                            &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                            &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                            &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                            &nbsp;<span>&#8624;</span>&nbsp;
                                            &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                        </div>
                                        <textarea class="textarea-listing-stuffer" e-id="10" maxlength="50"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; padding: 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('description'); ?></label></div>
                                <div class="col-md-6 col-sm-6 col-sx-6">
                                    <span style="font-size: 13px; float:right;">
                                        <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="11">0</span>/2000 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="11">0</span><?= $this->lang->line('words'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                    &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                    &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                    &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                    &nbsp;<span>&#8624;</span>&nbsp;
                                    &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                </div>
                                <textarea class="textarea-listing-stuffer" e-id="11" maxlength="2000"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; padding: 0;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-6 col-sm-6 col-xs-6"><label class="control-label"><?= $this->lang->line('search_terms'); ?></label></div>
                                <div class="col-md-6 col-sm-6 col-sx-6">
                                    <span style="font-size: 13px; float:right;">
                                        <i class="glyphicon glyphicon-pencil" style="color: #615dff;"></i>&nbsp;<span class="textarea-letter-count" l-id="12">0</span>/250 <?= $this->lang->line('characters'); ?>, <span class="textarea-word-count" w-id="12">0</span><?= $this->lang->line('words'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" style="height: 120px; background-color: #f2f2f2; padding: 0;">
                                <div class="col-md-12 col-sm-12 col-xs-12 not-selectable" style="height: 20px; margin-left: 10px; padding: 5px;">
                                    &nbsp;<span class="all_upper" style="cursor: pointer;">&#65;&#66;</span>&nbsp;
                                    &nbsp;<span class="all_lower" style="cursor: pointer;">ab</span>&nbsp;
                                    &nbsp;<span class="first_upper" style="cursor: pointer;">Ab</span>&nbsp;
                                    &nbsp;<span>&#8624;</span>&nbsp;
                                    &nbsp;<span>&#8625;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;<span class="copy_textarea" style="cursor: pointer;"><i class="fa fa-copy"></i>&nbsp;<?= $this->lang->line('copy'); ?></span>&nbsp;
                                </div>
                                <textarea class="textarea-listing-stuffer" e-id="12" maxlength="250"></textarea>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!--begin::Modal History-->
<div class="modal fade" id="modal_listing_stuffer_history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="width: 650px;">
            <div class="modal-header">
                <h4 class="modal-title col-md-10 col-sm-10 col-xs-10" id="exampleModalLabel">Category <?= $this->lang->line('history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close" style="float:right;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 1px solid #e5e5e5; padding: 20px; margin-bottom: 20px;">
                    <table id="table_listing_stuffer_history" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                        <thead style="background-color: #000000; color: #dedee0">
                        <th width="%5">#</th>
                        <th>Marketplace</th>
                        <th width="%40">Keyword</th>
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

