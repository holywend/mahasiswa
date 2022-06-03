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
                <div class="form-group col-12 row">
                    <label class="d-none d-md-block col-md-4" for="username">Nama User</label>
                    <input class="form-control col-sm-12 col-md-8" required
                        type="text" name="username" id="username" placeholder="Username" maxlength="50"/>
                </div>
                <div class="form-group col-12 row">
                    <label class="d-none d-md-block col-md-4" for="password">Kata Sandi</label>
                    <input class="form-control col-sm-12 col-md-8" required
                        type="password" name="password" id="password" placeholder="Password" minlength="8"/>
                </div>
                <div class="form-group col-12 row">
                    <div class="col-4"></div>
                    <div class="col-8 pl-0">
                        <input class="btn btn-primary w100px" type="submit" value="Sign In" />	
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view("_partials/js.php") ?>
</body>
</html>