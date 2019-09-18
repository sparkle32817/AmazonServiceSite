
            <!-- footer content -->
            <footer style="background: #30465c">
                <div class="col-md-12 col-sm-12 col-xs-12 pull-right">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <p style="font-size: 16px">Most Recent Task Completion Time : <strong><?= !empty($most_recent_time)? $most_recent_time:"00:00:00"; ?></strong></p>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <p style="font-size: 16px">Average Time to Complete Task (This Month) : <strong><?= !empty($this_month['complete_time'])? $this_month['complete_time']:"00:00:00"; ?></strong></p>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <p style="font-size: 16px">Average Time to Complete Task (Previous Month) : <strong><?= !empty($previous_month['complete_time'])? $previous_month['complete_time']:"00:00:00"; ?></strong></p>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <p style="font-size: 16px"># of Tasks Completed This Month : <strong><?= $this_month['complete_count']; ?></strong></p>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <p style="font-size: 16px"># of Tasks Completed Previous Month : <strong><?= $previous_month['complete_count']; ?></strong></p>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                    </div>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->

        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <!-- validator -->
    <script src="<?= base_url('assets/vendors/validator/validator.js') ?>"></script>

    <!-- Toast Theme Scripts -->
    <script src="<?= base_url('assets/build/js/common/toastr/toastr.min.js') ?>"></script>

    <script src="<?= base_url('assets/build/js/common/custom.min.js') ?>"></script>

    <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<!--    <script src="--><?//= base_url('assets/vendors/datatables.net/js/jquery.dataTables.min.js') ?><!--"></script>-->
<!--    <script src="--><?//= base_url('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') ?><!--"></script>-->
<!--    <script src="--><?//= base_url('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') ?><!--"></script>-->

    <!-- User Defined. -->
    <script>
        var base_url = "<?= base_url(); ?>";
    </script>

    <script src="<?= base_url('assets/build/js/employee/big_data.js') ?>"></script>
	<script src="<?= base_url('assets/build/js/employee/tracking.js') ?>"></script>
	<script src="<?= base_url('assets/build/js/employee/key_index_checker.js') ?>"></script>
	<script src="<?= base_url('assets/build/js/employee/magnet_key_search.js') ?>"></script>
	<script src="<?= base_url('assets/build/js/employee/reverse_asin_search.js') ?>"></script>
	<script src="<?= base_url('assets/build/js/employee/keyword_optimization.js') ?>"></script>

    </body>
</html>
