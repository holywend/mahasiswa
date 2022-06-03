<!-- File mahasiswa/modal.php -->

<!-- modal_mahasiswa -->
<div class="modal fade" id="modal_mahasiswa" role="dialog" aria="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fas fa-user"></i><span class="modal-title" id="modal-mahasiswa-title"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><div aria-hidden="true">&times;</div></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_mahasiswa" class="form-horizontal" enctype="multipart/form-data" >
                    <div class="form-group col-12 row">
                        <label class="d-none d-lg-block col-lg-3" for="nim">NIM</label>
                        <input class="form-control col-md-12 col-lg-9" name="nim" id="nim" type="text" placeholder="NIM" onkeypress="return is_number(event)" maxlength="9" required />
                        <div class="help-block col-12 small text-danger"></div>
                    </div>
                    <div class="form-group col-12 row">
                        <label class="d-none d-lg-block col-lg-3" for="nama">Nama</label>
                        <input class="form-control col-md-12 col-lg-9" name="nama" type="text" placeholder="Nama" required />
                        <div class="help-block col-12 small text-danger"></div>
                    </div>
                    <div class="form-group col-12 row">
                        <label class="d-none d-lg-block col-lg-3" for="tempat">Tempat Lahir</label>
                        <input class="form-control col-md-12 col-lg-9" name="tempat" type="text" placeholder="Tempat Lahir" required />
                        <div class="help-block col-12 small text-danger"></div>
                    </div>
                    <div class="form-group col-12 row">
                        <label class="d-none d-lg-block col-lg-3" for="tanggal">Tanggal Lahir</label>
                        <input class="form-control col-md-12 col-lg-9" name="tanggal" type="date" placeholder="Tanggal Lahir" required />
                        <div class="help-block col-12 small text-danger"></div>
                    </div>
                    <div class="form-group col-12 row">
                        <label class="d-none d-lg-block col-lg-3" for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control col-md-12 col-lg-9" name="jenis_kelamin" required>
                            <option value="">--Pilih--</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="help-block col-12 small text-danger"></div>
                    </div>
                    <div class="form-group col-12 row">
                        <label class="d-none d-lg-block col-lg-3" for="id_program_studi">Program Studi</label>
                        <select class="form-control col-md-12 col-lg-9" name="id_program_studi" required>
                            <option value="">--Pilih--</option>
<?php foreach($program_studies as $row):?>
                            <option value="<?= $row['id']?>"><?= $row['nama']?></option>
<?php endforeach;?>
                        </select>
                        <div class="help-block col-12 small text-danger"></div>
                    </div>
                    <div class="form-group mt-0 mb-1 col-md-12 col-lg-12 row">
                        <label class="d-none d-lg-block col-lg-3" for="userfile">Foto</label>
                        <input class="form-control-file pl-0 col-md-12 col-lg-9" type="file" name="userfile" id="userfile"/>
                        <div class="help-block col-12 small text-danger"></div>
                        <div class="col-12" id="file_info"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w100px" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary w100px" id="btnSave" onclick="save()">Simpan</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal mahasiswa -->

<!-- Delete Confirmation-->
<div class="modal fade" id="modal_delete_mahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Anda yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Mahasiswa yang dihapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary w100px" type="button" data-dismiss="modal">Batal</button>
        <a id="btn-delete" class="btn btn-danger w100px" href="#">Delete</a>
      </div>
    </div>
  </div>
</div> <!-- /.Delete confirmation -->

<!-- / File mahasiswa/modal.php -->