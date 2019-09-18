<style>
    div.item.form-group
    {
        margin-top: 20px;
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
                <div class="x_panel" style="min-height: 780px;">
                    <form class="form-horizontal form-label-left" action="javascript:;" id="form_client_info_update" novalidate>
                        <div class="x_title">
                            <h2>Client Information</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom: 2px solid #E6E9ED; padding: 10px; margin-bottom: 20px">
                                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 20px; margin-left: -50px;">
                                    <input type="hidden" id="user_id" value="<?= $client_info["id"]; ?>">
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name"><?= $this->lang->line('user_name'); ?>
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input id="user_name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="user_name"
                                                   type="text" value="<?= $client_info["user_name"] ?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="email"><?= $this->lang->line('email'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="email" id="email" name="email" readonly="readonly"
                                                   class="form-control col-md-7 col-xs-12"  value="<?= $client_info["email"] ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name"><?= $this->lang->line('full_name'); ?>
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input id="full_name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="full_name"
                                                   type="text" value="<?= $client_info["full_name"] ?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="number"><?= $this->lang->line('phone_number'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="phone_number" name="phone_number" readonly="readonly"
                                                   data-validate-length-range="10,15" class="form-control col-md-7 col-xs-12"   value="<?= $client_info["phone_number"] ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="number"> <?= $this->lang->line('address'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="address" name="address"
                                                   class="form-control col-md-7 col-xs-12"   value="<?= $client_info["address"] ?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="website"><?= $this->lang->line('market_place'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <select name="market_place" class="form-control"
                                                    id="market_place"  disabled style="cursor: default">
                                                <option value=""></option>
                                                <?php foreach ($markets as $market){ ?>
                                                <option value="<?= $market["id"]; ?>"
                                                    <?php if ($market["id"]==$client_info["market_id"]){?> selected
                                                     <?php } ?>>
                                                    <?= $market["name"]; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"
                                               for="telephone"><?= $this->lang->line('amazon_id'); ?> <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="amazon_id" name="amazon_id" class="form-control col-md-7 col-xs-12"  readonly="readonly" value="<?= $client_info["amazon_id"] ?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="telephone">QQ <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="qq" name="qq" class="form-control col-md-7 col-xs-12"   value="<?= $client_info["qq"] ?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="telephone">Other Service <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <textarea type="text" id="other_service" name="other_service" class="form-control col-md-7 col-xs-12" readonly="readonly"
                                                      value="<?= $client_info["other_service"] ?>"><?= $client_info["other_service"] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="telephone"><?= $this->lang->line('invitation'); ?> </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="invitation_code" name="invitation_code" readonly="readonly"
                                                   class="form-control col-md-7 col-xs-12"   value="<?= $client_info["invitation_code"] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 100px; margin-left: -50px;">
                                    <div class="item form-group" style="margin-top: 50px;">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="website"><?= "Membership"; ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <select name="membership_status" class="form-control" required="required" id="membership_status" style="cursor: default">
                                                <option value="1" <?php if ($client_info["membership_id"]==1){?> selected <?php } ?>> Tier0 </option>
                                                <option value="2" <?php if ($client_info["membership_id"]==2){?>
                                                    selected <?php } ?>> Tier1 </option>
                                                <option value="3" <?php if ($client_info["membership_id"]==3){?>
                                                    selected <?php } ?>> Tier2 </option>
                                                <option value="4" <?php if ($client_info["membership_id"]==4){?>
                                                    selected <?php } ?>> Tier3 </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group" style="margin-top: 30px;">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="website"><?= "Current Status"; ?> <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <select name="current_status" class="form-control" required="required" id="current_status" style="cursor: default">
                                                <option value="0" <?php if ($client_info["allow_status"]==0){?>
                                                    selected <?php } ?>> Pending </option>
                                                <option value="1" <?php if ($client_info["allow_status"]==1){?>
                                                    selected <?php } ?>> Approved </option>
                                                <option value="2" <?php if ($client_info["allow_status"]==2){?>
                                                    selected <?php } ?>> Cancelled </option>
                                                <option value="3" <?php if ($client_info["allow_status"]==3){?>
                                                    selected <?php } ?>> Balance Overdue </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item form-group" style="margin-top: 30px;">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"
                                               for="telephone"><?= "Current Available Credits"; ?> <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" id="current_credit" name="current_credit" class="form-control col-md-7 col-xs-12" value="<?= $client_info["current_credit"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="item form-group" style="margin-top: 50px;">
                                        <div class="col-md-5 col-sm-5 col-xs-12"></div>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <button class="btn btn-primary" id="client_info_update">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
                                    <div class="col-md-8">
                                        <h2></h2>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="daterange_client_function" value="" style="float: right; width: 175px; height: 30px; padding-left: 10px;">
                                    </div>
<!--                                    <a href="" id="file_export_task_overview" class="btn btn-round btn-default" style="float: right; margin-top: -2px; margin-right: 40px; cursor: pointer;">-->
<!--                                        <i class="fa fa-download" style=" font-size: 20px;"></i>-->
<!--                                    </a>-->
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="table_client_function" class="table table-striped table-bordered dt-responsive nowrap"
                                           cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Service ID</th>
                                            <th>Service Name</th>
                                            <th>Used Times</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($service_times_info){
                                            $cnt=0;
                                            foreach ($service_times_info as $service_info) {
                                                $cnt++;
                                                ?>
                                                <tr>
                                                    <td><?= $cnt; ?></td>
                                                    <td><?= $service_info['name']; ?></td>
                                                    <td><?= !empty($service_info['times'])?$service_info['times']:"0"; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
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
