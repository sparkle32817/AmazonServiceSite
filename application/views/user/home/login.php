<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <title>Log in</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <style type="text/css">
        .m_label_font{
            font-color:lightblue;
        }

        button.btn.dropdown-toggle.bs-placeholder.btn-light{
            border-radius: 40px !important;
            border: none;
            padding: 1.5rem 1.5rem;
            /*background: rgba(67,34,167,0.4);*/
            background: transparent;
            margin-top: -19px;
            margin-left: -15px;
            padding: 10px;
            padding-left: 15px;
            width: 111%;
            height: calc(2.95rem + 2px);
        }

        button.btn.dropdown-toggle.bs-placeholder.btn-light div.filter-option-inner{
            color: #ae92ec;
        }

        button.btn.dropdown-toggle.btn-light{
            border-radius: 40px !important;
            border: none;
            padding: 1.5rem 1.5rem;
            /*background: rgba(67,34,167,0.4);*/
            background: transparent;
            margin-top: -19px;
            margin-left: -15px;
            padding: 10px;
            padding-left: 15px;
            width: 111%;
            height: calc(2.95rem + 2px);
            color: white;
        }
        div.filter-option{
            color:white;
        }
    </style>
    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    <link href="<?= base_url() ?>assets/build/css/log_in/vendors.bundle.css" rel="stylesheet" type="text/css" />

    <link href="<?= base_url() ?>assets/build/css/log_in/style.bundle.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link href="<?= base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!--end::Global Theme Styles -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo1.png" />

    <!--previos-->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2
            m-login-2--skin-1" id="m_login" style="background-image: url(<?=base_url();?>assets/images/bg1.jpg);">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="form-group m-form__group">
                <div class="col-md-4" style="margin-left: 300px">
                    <select class="form-control m-input m-input--air m-input--pill" style=" background: #164bb4; border-color: #565858; color: #8393da;"
                            onchange="javascript:window.location.href='<?php echo base_url();  ?>LanguageSwitcher/switchLang/'+this.value;">
                        <option  value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
                        <option  value="chinese" <?php if($this->session->userdata('site_lang') == 'chinese') echo 'selected="selected"'; ?>>中文</option>
                    </select>
                </div>
            </div>
            <div class="m-login__container" style=" background: rgba(0,0,0,0.7); padding: 20px; border-radius: 10px; ">
                <div class="m-login__logo">
                    <a href="#">
                        <img src="<?= base_url() ?>assets/images/logo1.png">
                    </a>
                </div>
                <div class="m-login__signin">
                    <div class="m-login__head">
                        <h1 class="text-center" style="color: #e8eef5"><?= $this->lang->line('welcome'); ?> !</h1>
                    </div>
                    <form id="form_login_submit" class="m-login__form m-form" method="POST">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="<?= $this->lang->line('user_name'); ?>" name="lgin_username"
                                   id="lgin_username" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password"
                                   placeholder="<?= $this->lang->line('password'); ?>" id="lgin_password"
                                   name="lgin_password">
                        </div>
                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <label class="m-checkbox  m-checkbox--light">
                                    <input type="checkbox" name="remember"> <?= $this->lang->line('remember_me'); ?>
                                    <span></span>
                                </label>
                            </div>
                            <div class="col m--align-right m-login__form-right">
                                <a href="<?php echo base_url() ?>forgotPassword" id="m_login_forget_password"
                                   class="m-link"><?= $this->lang->line('forgot_pass'); ?></a>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill
                                m-btn--custom m-btn--air  m-login__btn m-login__btn--primary" type="submit"><?=
                                $this->lang->line('sign_in'); ?></button>
                        </div>
                    </form>
                </div>
                <div class="m-login__signup">
                    <div class="m-login__head">
                        <h3 class="m-login__title"><?= $this->lang->line('sign_up'); ?></h3>
                        <div class="m-login__desc"><?= $this->lang->line('create_account') ?>:</div>
                    </div>

                    <form class="m-login__form m-form" method="post" action="javascript:;" id="signupform">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="<?= $this->lang->line('user_name') ?>" id="username" name="username" autocomplete="off" >
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="email" placeholder="<?= $this->lang->line('email') ?>" id="email" name="email" autocomplete="off" >
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="<?= $this->lang->line('full_name') ?>" id="fullname" name="fullname" autocomplete="off" >
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="password" placeholder="<?=
                            $this->lang->line('password') ?>" id="password" name="password"
                            >
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="<?= $this->lang->line('confirm_pass') ?>" id="rpassword" name="rpassword" >
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="<?= $this->lang->line('phone_number') ?>" id="phone_number" name="phone_number" autocomplete="off" >
                            <span>
                                    <i class="fa fa-question-circle" style="float: right;
                                    margin-top: 5px;"data-container="body"
                                       data-toggle="m-tooltip" data-placement="right"
                                       title="Choose all apply, must choose one at least.">
                                    </i>
                                </span>
                        </div>
                        <div class="form-group m-form__group row">
                            <select class="form-control col-md-12 m-bootstrap-select m_selectpicker" id="market_place"
                                    name="market_place" style="" multiple data-actions-box="true">
                                <?php foreach ($markets as $market){ ?>
                                    <option value="<?= $market["id"]; ?>"><?= $market["name"]; ?></option>
                                <?php } ?>
                            </select>
                            <!--                                <div id="market_place-error" class="form-control-feedback">This field is required.</div>-->
                        </div>
                        <div class="form-group m-form__group" style="margin-top: 10px">
                                <span>
                                    <i class="fa fa-question-circle" style="float: right;"data-container="body" data-toggle="m-tooltip" data-placement="right"
                                       title="If you don't know Markeplace ID, you can put your seller name.">
                                    </i>
                                </span>
                            <input class="form-control m-input" type="text" placeholder="<?= $this->lang->line('amazon_id') ?>" autocomplete="off" name="amazon_id"
                                   id="amazon_id" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="<?= $this->lang->line('qq') ?>" autocomplete="off" name="qq" id="qq">
                        </div>
                        <div class="form-group m-form__group">
                                <textarea class="form-control m-input" type="text" placeholder="<?= "Which other services do you currently use to manage your day-to-day Amazon or eCommerce operations?\n If none,put down 'none'" ?>"
                                          autocomplete="off" name="other_service" id="other_service"
                                          style="height: 90px;"></textarea>
                        </div>
                        <div style="margin-left: 15px; margin-top: 10px;">
                            <p>Optional:</p>
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" style="margin-top: -10px" type="text"
                                   placeholder="<?= $this->lang->line('invitation') ?>" autocomplete="off" name="invitation_code"
                                   id="invitation_code">
                        </div>
                        <div class="row form-group m-form__group m-login__form-sub">
                            <div class="col m--align-left">
                                <label class="m-checkbox m-checkbox--light">
                                    <input type="checkbox" name="agree"><font color="white"><?= $this->lang->line('agree') ?><a href="#" class="m-link m-link--focus"><?= $this->lang->line('term_cond') ?></font></a>
                                    <span></span>
                                </label>
                                <span class="m-form__help"></span>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_signup_submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary" type="submit"><?= $this->lang->line('sign_up') ?></button>&nbsp;&nbsp;
                            <button id="m_login_signup_cancel" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary"><?= $this->lang->line('cancel') ?></button>
                        </div>
                    </form>
                </div>
                <div class="m-login__forget-password">
                    <div class="m-login__head">
                        <h3 class="m-login__title"><?= $this->lang->line('forgot_pass'); ?></h3>
                        <div class="m-login__desc"><?= $this->lang->line('pass_reset'); ?></div>
                    </div>
                    <form class="m-login__form m-form" method="post">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="<?= $this->lang->line('email'); ?>" name="email" id="m_email" autocomplete="off">
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_forget_password_submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary"><?= $this->lang->line('request'); ?></button>&nbsp;&nbsp;
                            <button id="m_login_forget_password_cancel" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn" style="color: red"><?= $this->lang->line('cancel'); ?></button>
                        </div>
                    </form>
                </div>
                <div class="m-login__account">
                      <span class="m-login__account-msg">
                        <?= $this->lang->line('account_yet'); ?>
                      </span>&nbsp;&nbsp;
                    <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link"><?= $this->lang->line('sign_up'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!---loginbox--->
<script src="<?= base_url() ?>assets/build/js/common/jQuery-2.1.4.min.js"></script>

<!--Metronic Themes initialize --->
<script src="<?= base_url() ?>assets/build/js/common/vendors.bundle.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/build/js/common/scripts.bundle.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/build/js/common/bootstrap-select.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<!--begin::Page Scripts -->
<script>
    var base_url = "<?= base_url(); ?>";
</script>
<script src="<?= base_url() ?>assets/build/js/user/login.js" type="text/javascript"></script>

</body>

</html>