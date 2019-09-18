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
            m-login-2--skin-1" id="m_login" style="background-image: url(<?=base_url();?>assets/images/bg.jpg);">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                <div class="form-group m-form__group">
                    <div class="col-md-4" style="margin-left: 300px">
                        <select class="form-control m-input m-input--air m-input--pill" style=" background: #164bb4; border-color: #565858; color: #8393da;" onchange="">
                            <option  value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
                            <option  value="chinese" <?php if($this->session->userdata('site_lang') == 'chinese') echo 'selected="selected"'; ?>>中文</option>
                        </select>
                    </div>
                </div>
                <div class="m-login__container" style=" background: #140e14ed; padding: 20px; border-radius: 10px; ">
                    <div class="m-login__logo">
                        <a href="#">
                            <img src="<?= base_url() ?>assets/images/logo2.png">
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
                            <div class="m-login__form-action">
                                <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill
                                m-btn--custom m-btn--air  m-login__btn m-login__btn--primary" type="submit"><?=
                                    $this->lang->line('sign_in'); ?></button>
                            </div>
                        </form>
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
    <script src="<?= base_url() ?>assets/build/js/admin/login.js" type="text/javascript"></script>

    </body>

</html>