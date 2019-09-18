<style>
    .label {
        cursor: pointer;
    }

    .progress {
        display: none;
        margin-bottom: 1rem;
    }

    .alert {
        display: none;
    }

    .img-container img {
        max-width: 100%;
    }
</style>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;</h3>
            </div>

        </div>

        <div></div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <form class="form-horizontal form-label-left" action="javascript:;" novalidate>
                        <div class="x_title">
                            <ul class="nav navbar-left panel_toolbox">
                                <h3><?= $this->lang->line('user_profile'); ?></h3>
                            </ul>
                            <ul class="nav navbar-right panel_toolbox">
                                <button type="submit" class="btn btn-success" style="margin-right: 30px"
                                        id="edit_profile"
                                   name="edit_profile"><?= $this->lang->line('edit_profile'); ?> <i class="fa fa-edit
                                   m-right-xs"></i></button>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-12">
                                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                    <center>
                                        <div class="profile_img">
                                            <label class="label thumbnail" data-toggle="tooltip" style="width: 230px; height: 230px; padding: 5px;">
                                                <div class="view view-first" style="width: 220px;" id="div-avatar-change">
                                                    <img class="rounded img-responsive avatar-view" id="avatar-img"
                                                         src="<?php if(!empty($user_avatar['user_avatar'])) {echo $user_avatar['user_avatar'];} else {echo $default_avatar;}?>" alt="avatar">
                                                    <div class="mask">
                                                        <p></p>
                                                        <p></p>
                                                        <p></p>
                                                        <p></p>
                                                        <div class="tools tools-bottom" id="pen-avatar-change">
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="file" class="sr-only" id="input-avatar-change" name="image"
                                                       accept="image/*" style="width: 220px">
                                            </label>
                                            <div class="alert" role="alert"></div>
                                            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="width: 360px; height: 360px;">
                                                            <div class="img-container">
                                                                <img id="image" style="width: 400px; height: 360px"
                                                                     src="<?php if(file_exists('assets/images/'.$user_info["user_name"].'.jpg')){ echo base_url('assets/images/'.$user_info["user_name"].'.jpg');}else{ echo base_url('assets/images/picture.jpg');} ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-primary" id="crop">OK</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 style="margin-top: -10px">
                                            @ <?= $user_info["user_name"]; ?>
                                        </h3>
                                        <ul class="list-unstyled user_data" style="font-size: medium">
                                            <li>
                                                <center>
                                                    <i class="fa fa-user"></i>&nbsp; <?= $this->lang->line('member_since'); ?> <?= $user_info["reg_date"]; ?>
                                                </center>
                                            </li>

                                            <li>
                                                <center>
                                                    <i class="fa fa-briefcase user-profile-icon"></i>&nbsp; <?=
                                                    $this->lang->line('membership'); ?> <?= $user_info["membership"] ?>
                                                </center>
                                            </li>
                                        </ul>
                                    </center>
                                    <br/>
                                    <br/>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12" style="margin-top: 20px;">
                                    <input type="hidden" id="user_name" value="<?= $user_info["user_name"]; ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="name"><?= $this->lang->line('full_name'); ?>
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="full_name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="full_name" required="required"
                                                   type="text" value="<?= $user_info["full_name"] ?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="email"><?= $this->lang->line('email'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" id="email" name="email" required="required"
                                                   class="form-control col-md-7 col-xs-12"  value="<?= $user_info["email"] ?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="number"><?= $this->lang->line('phone_number'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="phone_number" name="phone_number" required="required"
                                                   data-validate-length-range="10,15" class="form-control col-md-7
                                                   col-xs-12"   value="<?= $user_info["phone_number"] ?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="number"> <?= $this->lang->line('address'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="address" name="address" required="required"
                                                   class="form-control col-md-7 col-xs-12"   value="<?= $user_info["address"] ?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="website"><?= $this->lang->line('market_place'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="market_place" class="form-control" required="required"
                                                    id="market_place"  disabled style="cursor: default">
                                                <option value=""></option>
                                                <?php foreach ($markets as $market){ ?>
                                                <option value="<?= $market["id"]; ?>"
                                                    <?php if ($market["id"]==$user_info["market_id"]){?> selected
                                                     <?php } ?>>
                                                    <?= $market["name"]; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12"
                                               for="telephone"><?= $this->lang->line('amazon_id'); ?> <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="amazon_id" name="amazon_id" class="form-control
                                            col-md-7 col-xs-12"   value="<?= $user_info["amazon_id"] ?>" required
                                                   readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="telephone">QQ <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="qq" name="qq" class="form-control col-md-7 col-xs-12"  required  value="<?= $user_info["qq"] ?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="telephone">Other Service <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea type="text" id="other_service" name="other_service" class="form-control col-md-7 col-xs-12"
                                                      value="<?= $user_info["other_service"] ?>" readonly="readonly" required><?= $user_info["other_service"] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="telephone"><?= $this->lang->line('invitation'); ?> </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="invitation_code" name="invitation_code"
                                                   class="form-control
                                            col-md-7 col-xs-12"   value="<?= $user_info["invitation_code"] ?>" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-left panel_toolbox">
                            <h3><?= $this->lang->line('visit_history') ?></h3>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content2"
                                     aria-labelledby="profile-tab">
                                    <!-- start user projects -->
                                    <table class="data table table-striped no-margin" id="table_client_session">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th><?= $this->lang->line('time'); ?></th>
                                            <th><?= $this->lang->line('user'); ?></th>
                                            <th>IP</th>
                                            <th><?= $this->lang->line('country'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($sessions)){ $cnt=1; foreach ($sessions as $session){ ?>
                                            <tr>
                                                <td><?= $cnt; ?></td>
                                                <td><?= $session['time'] ?></td>
                                                <td><?= $user_info['user_name'] ?></td>
                                                <td><?= $session['ip'] ?></td>
                                                <td><?= $session['country'] ?></td>
                                            </tr>
                                            <?php $cnt++; } } ?>
                                        </tbody>
                                    </table>
                                    <!-- end user projects -->
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

<script>var canvas_pic; var is_change=0;</script>
<script>
    window.addEventListener('DOMContentLoaded', function () {

        $('#input-avatar-change').prop("disabled", true);
        $('#div-avatar-change').removeAttr('class');
        $('#pen-avatar-change').attr('style', 'display: none;');

        var avatar = document.getElementById('avatar-img');
        var image = document.getElementById('image');
        var input = document.getElementById('input-avatar-change');
        var $alert = $('.alert');
        var $modal = $('#modal');
        var cropper;

        $('[data-toggle="tooltip"]').tooltip();

        input.addEventListener('change', function (e) {

            // if($("#edit_profile").text()!="Save "){
            //     return false;
            // }


            var files = e.target.files;
            var done = function (url) {
                // input.value = '';
                image.src = url;
                $alert.hide();
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        document.getElementById('crop').addEventListener('click', function () {
            var initialAvatarURL;

            $modal.modal('hide');

            if (cropper) {
                is_change = 1;
                canvas_pic = cropper.getCroppedCanvas({
                    width: 220,
                    height: 220,
                });
                avatar.src = canvas_pic.toDataURL();
                $alert.removeClass('alert-success alert-warning');
            }
        });
    });
</script>
