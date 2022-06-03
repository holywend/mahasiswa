<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('_partials/head'); ?>
</head>
<body>

<div class="row">
    <div class="container card col-xs-10 col-sm-8 col-md-6 mx-auto mr-auto ml-auto mt-5" id="container">
        <div id="banner"><img class="img-fluid" src="<?php echo base_url('assets/images/CodeIgniter_banner.png');?>"></div>
        <div class="h4 text-center">Aplikasi Data Mahasiswa</div>
        <div class="card-body">
            <form class="row" action="<?php echo base_url('Auth/signin');?>" method="post">
<?php // jika terdapat pesan kesalahan
if ($this->session->flashdata('fail')): ?>
                <div class="alert alert-danger col-lg-12" role="alert">
                    <?php echo $this->session->flashdata('fail'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
<?php endif; ?>
                <div class="form-group col-lg-12">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group col-lg-12">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group col-lg-12">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view("_partials/js.php") ?>
</body>
</html>