<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('_partials/head'); ?>
</head>

<body id="page_top">
    <!-- Ajax Image loader -->
    <div id='loader' style="display:none;top:50%;left:50%;margin-left:-213px;margin-top:-120px;position:fixed;padding:2px;z-index:1060;">
	    <img src='<?php echo site_url('assets/images/loading_cat_girl.gif');?>'>
    </div>

<?php $this->load->view('_partials/navbar');?>

    <div id="wrapper">
        <?php $this->load->view('_partials/sidebar');?>
        <div id="content-wrapper">
            <div id="content">
                <div class="container-fluid" id="message">
                </div>
                <?php (!empty($content)) ? $this->load->view($content) : '';?>
            </div>
            <!-- tutup content -->
            <?php $this->load->view('_partials/footer');?>
        </div>
        <!-- tutup content-wrapper -->
    </div>
    <!-- tutup wrapper -->

<?php $this->load->view("_partials/scrolltop"); ?>
<?php $this->load->view("_partials/modal"); ?>
<?php $this->load->view("_partials/js"); ?>
<?php if(isset($partials))
    {
        foreach($partials as $partial)
        {
            $this->load->view($partial);
        }
    }
?>
</body>
</html>