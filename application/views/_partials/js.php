<!-- Buka file js.php -->

    <!-- Bootstrap core javascript -->
    <script src="<?php echo base_url('assets/sb-admin-2/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?php echo base_url('assets/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js');?>"></script>
    <!-- sb admin 2 -->
    <script src="<?php echo base_url('assets/sb-admin-2/js/sb-admin-2.js') ?>"></script>
    <script src="<?php echo base_url('assets/sb-admin-2/vendor/datatables/jquery.dataTables.js') ?>"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url('assets/sb-admin-2/vendor/datatables/dataTables.bootstrap4.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/dataTables.responsive.min.js') ?>"></script>
    <!-- Datatables button -->
    <script src="<?php echo base_url('assets/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/buttons.flash.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/buttons.html5.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/buttons.print.min.js') ?>"></script>
    <!-- jszip untuk export datatables ke excel-->
    <script src="<?php echo base_url('assets/js/jszip.min.js') ?>"></script>
    <!-- pdfmake untuk export datatables ke pdf-->
    <script src="<?php echo base_url('assets/js/pdfmake.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/vfs_fonts.js') ?>"></script>
    <!-- menampilkan animasi gif saat ajax loading -->
    <script>
        $(document).ajaxStart(function(){
            $("#loader").css("display", "block");
            });
        $(document).ajaxComplete(function(){
            $("#loader").css("display", "none");
        });
        $(document).ajaxError(function(){
            $("#loader").css("display", "none");
            $('#message').html('<div class="alert alert-danger" role="alert">Kesalahan sistem<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');       
        });
        function is_number(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) 
            {
                return false;
            }
            return true;
        }
    </script>

<!-- Tutup file js.php -->