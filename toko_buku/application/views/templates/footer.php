  <footer class="footer text-center">
                All Rights Reserved Flizoneye app. Designed and Developed by <a href="#">Fadli Aziz</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url() ?>dist/js/waves.js"></script>
    <!-- accounting -->
    <script type="text/javascript" src="<?php echo base_url('assets/libs/acounting/acounting.js') ?>"></script>
    <!-- notify -->
    <script type="text/javascript" src="<?php echo base_url('assets/libs/notify/notify.min.js') ?>"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url() ?>dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>dist/js/custom.js"></script>
    <!-- datatable -->
    <script type="text/javascript" src="<?php echo base_url('assets/libs/jquery-datatable/jquery.dataTables.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/libs/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap4.min.js') ?>"></script>
    <!-- select2 -->
    <script type="text/javascript" src="<?php echo base_url('assets/libs/select2/select2.min.js') ?>"></script>
    <!-- chart js -->
    <script type="text/javascript" src="<?php echo base_url('assets/libs/chartjs/Chart.bundle.min.js') ?>"></script>
    
    <?php $this->load->view("admin/js/init_js") ?>
    <?php  

    if($this->uri->segment(3) == "home") $this->load->view("admin/js/home_js");
    if($this->uri->segment(3) == "distributor") $this->load->view("admin/js/distributor_js");
    if($this->uri->segment(3) == "buku") $this->load->view("admin/js/buku_js");
    if($this->uri->segment(3) == "pasok") $this->load->view("admin/js/pasok_js");
    if($this->uri->segment(3) == "penjualan") $this->load->view("admin/js/penjualan_js");

    ?>
</body>

</html>