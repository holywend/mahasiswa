<!-- modal.php signout modal-->
<div class="modal fade" id="signout_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Klik "Sign Out" jika ingin mengakhiri sesi ini.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary w100px" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-primary w100px" href="<?php echo base_url('Auth/signout')?>">Sign Out</a>
      </div>
    </div>
  </div>
</div>
<!-- / modal.php -->
