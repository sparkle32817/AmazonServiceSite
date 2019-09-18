<style>

    th, td{
        text-align: center;
        padding: 10px;
    }

</style>
<!-- page content -->
<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-md-8">
                        <h2>Client Information</h2>
                    </div>
                    <div class="col-md-3">
                        <input id="daterange_client_info" value="" style="float: right; width: 175px; height: 30px; padding-left: 10px;">
                    </div>
                    <div class="col-md-1">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-round" type="button" aria-expanded="false" style="width: 70px">
                            <i class="fa fa-eye-slash" style=" font-size: 20px;"></i>
                            <span class="caret" style="margin-left: 7px; margin-right: -8px;"></span>
                        </button>
                        <ul role="menu" class="dropdown-menu">
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_email" checked >&nbsp;&nbsp;&nbsp;Email
                                    </label>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_phone" checked >&nbsp;&nbsp;&nbsp;Phone Number
                                    </label>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_market" checked >&nbsp;&nbsp;&nbsp;Market Place
                                    </label>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_amazon" checked >&nbsp;&nbsp;&nbsp;Amazon Seller ID
                                    </label>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_invitation" checked >&nbsp;&nbsp;&nbsp;Invitation Code
                                    </label>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_qq" checked >&nbsp;&nbsp;&nbsp;QQ
                                    </label>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_membership" checked >&nbsp;&nbsp;&nbsp;Membership
                                    </label>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_total" checked >&nbsp;&nbsp;&nbsp;Client Total Spend
                                    </label>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_part" checked >&nbsp;&nbsp;&nbsp;Client Part Spend
                                    </label>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_status" checked >&nbsp;&nbsp;&nbsp;Current Status
                                    </label>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_credits" checked >&nbsp;&nbsp;&nbsp;Current Credits
                                    </label>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <label>
                                        <input type="checkbox" class="js-switch show_hide_btn" id="btn_hide_actions" checked >&nbsp;&nbsp;&nbsp;Actions
                                    </label>
                                </a>
                            </li>
                        </ul>
                        <a href="javascript:;" id="file_export_client" class="btn btn-round btn-default" style="float: right; margin-right: -14px;">
                            <i class="fa fa-download" style=" font-size: 20px;"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="table_client_info" class="table table-striped table-bordered dt-responsive nowrap"
                           cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="td_name">User Name</th>
                                <th class="td_email">Email</th>
                                <th class="td_phone">Phone Number</th>
                                <th class="td_market">Market Place</th>
                                <th class="td_amazon">Amazon Seller ID</th>
                                <th class="td_invitation">Invitation Code</th>
                                <th class="td_qq">QQ</th>
                                <th class="td_membership">Membership</th>
                                <th class="td_total">Client<br/> Total Spend</th>
                                <th class="td_part">Client<br/> Part Spend</th>
                                <th class="td_status">Current Status</th>
                                <th class="td_credits">Current Credits</th>
                                <th class="td_credits">Application<br> Status</th>
                                <th class="td_action">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_client_info">
<!--                            --><?php //if ($client_all_info){
//                                $cnt=0;
//                                foreach ($client_all_info as $client_info) {
//                                    $cnt++;
//                                    ?>
<!--                                    <tr>-->
<!--                                        <td class="td_no">--><?//= $cnt; ?><!--</td>-->
<!--                                        <td class="td_name">--><?//= $client_info['user_name']; ?><!--</td>-->
<!--                                        <td class="td_email">--><?//= $client_info['email']; ?><!--</td>-->
<!--                                        <td class="td_phone">--><?//= $client_info['phone_number']; ?><!--</td>-->
<!--                                        <td class="td_market">--><?//= $client_info['market_place']; ?><!--</td>-->
<!--                                        <td class="td_amazon">--><?//= $client_info['amazon_id']; ?><!--</td>-->
<!--                                        <td class="td_invitation">--><?//= $client_info['invitation_code']; ?><!--</td>-->
<!--                                        <td class="td_qq">--><?//= $client_info['qq']; ?><!--</td>-->
<!--                                        <td class="td_membership">--><?//= $client_info['membership']; ?><!--</td>-->
<!--                                        <td class="td_total">--><?//= $client_info['total_spent_amount']; ?><!--</td>-->
<!--                                        <td class="td_part">--><?//= $client_info['part_amount']; ?><!--</td>-->
<!--                                        <td class="td_status">--><?php
//                                            $status = $client_info["allow_status"];
//                                            if ($status=="0") $status = "Pending";
//                                            else if ($status=="1") $status = "Approved";
//                                            else if ($status=="2") $status = "Cancelled";
//                                            else if ($status=="3") $status = "Balance Overdue";
//
//                                            echo $status;
//                                            ?><!--</td>-->
<!--                                        <td class="td_credits">--><?//= $client_info['current_credit']; ?><!--</td>-->
<!--                                        <td class="td_action"><a href="--><?//= base_url("admin/client_edit") ?><!--?id=--><?php //echo $client_info["id"];?><!--"><i class="fa fa-edit client_edit" style="color: #1ABB9C" title="View Information"></i> </a> &nbsp;-->
<!--                                            <a href="javascript:;"><i class="fa fa-trash client_delete" id="--><?//= $client_info["id"];?><!--" style="color: #ff7474" title="Delete Client"></i> </a>-->
<!--                                        </td>-->
<!--                                    </tr>-->
<!--                                    --><?php
//                                }
//                            }
//                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
