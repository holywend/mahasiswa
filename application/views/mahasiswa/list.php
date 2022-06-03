<!-- mahasiswa/list.php -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-2 mt-2">
            <div class="card border-left-primary h-100 shadow py-2">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-8 text-lg font-weight-bold text-primary"><i class="fas fa-users"></i> <span>Data Mahasiswa</span></div>
                        <div class="col-4 ml-auto">
                            <button class="float-right btn btn-primary w100px" onclick="add_mahasiswa()"><i class="fas fa-plus"></i> Add</button> 
                        </div>
                    </div>
                    <table class="w-100 table table-hover" id="datatable_mahasiswa">
                        <thead>
                            <tr>
                                <th class="align-middle" data-priority="1">NIM</th>
                                <th class="align-middle" data-priority="1">Nama</th>
                                <th class="align-middle" data-priority="2">Jenis Kelamin</th>
                                <th class="align-middle" data-priority="2">Tempat</th>
                                <th class="align-middle" data-priority="2">Tanggal Lahir</th>
                                <th class="align-middle" data-priority="1">Program Studi</th>
                                <th class="align-middle" data-priority="1">Foto</th>
                                <th class="align-middle" data-priority="1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody> 
                        <tfoot>
                            <tr>
                                <th class="align-middle">NIM</th>
                                <th class="align-middle">Nama</th>
                                <th class="align-middle">Jenis Kelamin</th>
                                <th class="align-middle">Tempat</th>
                                <th class="align-middle">Tanggal Lahir</th>
                                <th class="align-middle">Program Studi</th>
                                <th class="align-middle">Foto</th>
                                <th class="align-middle">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / mahasiswa/list.php -->