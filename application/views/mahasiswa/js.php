<!-- mahasiswa/js.php -->
<script>
    id = '';
    $(document).ready(function() {

        // inisiasi dataTable document
        table = $('#datatable_mahasiswa').DataTable({
            // datatable dengan filter di sisi server
            "serverSide": true,
            "order": [],
            // memanggil ajax_list untuk menampilkan data mahasiswa
            "ajax": {
                "url": "<?php echo site_url('Mahasiswa/ajax_list/');?>",
                "data" : {},
                "type": "POST"
            },
            // kolom paling kanan tidak bisa di sortir (kolom aksi)
            "columnDefs": [{    
                "targets": [-1],
                "orderable": false,
            },{
                "targets": [6],
                "orderable": false,
            }],
            // mengubah bahasa datatable
            language: { 
                search: "", 
                searchPlaceholder: "Cari",
                lengthMenu: "Tampil _MENU_" 
            },
            // menggunakan plugin responsive pada datatables
            responsive: true,
            // menggunakan bootstrap untuk tampilan datatables
            dom:
                    "<'ui grid'"+
                        "<'row'"+
                            "<'d-none d-md-block col-md-3'"+
                                "<'float-left'l>"+
                            ">"+
                            "<'d-none d-md-block col-md-6'"+
                                "<'float-left'f>"+
                            ">"+
                            "<'col-xs-6 col-md-3'"+
                                "<'float-right'B>"+
                            ">"+
                        ">"+
                        "<'row dt-table'"+
                            "<'col-12'tr>"+
                        ">"+
                        "<'row'"+
                            "<'col-8'i>"+
                            "<'text-right col-4'p>"+
                        ">"+
                    ">",
            // menggunakan plugin buttons pada datatables 
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }
            ]
        });

        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

        $('#userfile').bind('change', function() 
        // menampilkan ukuran file ketika user input file
        {
            $('#file_info').html('<small class="text-muted">file size='+Math.ceil(this.files[0].size/1024)+' KB, tipe='+this.files[0].name.split('.').pop()+'</small>');
        });
    })

    function add_mahasiswa()
    {
        save_method = 'add';
        $('#form_mahasiswa')[0].reset(); // reset form
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty();// clear error string
        $('#btnSave').text('Simpan'); //change button text
        $('#modal-mahasiswa-title').text(' Tambah Mahasiswa');
        $('#nim').attr('readonly',false); // dapat mengubah nim
        $('#message').html('');
        $('#file_info').html('');
        $('#modal_mahasiswa').modal('show'); // show bootstrap modal when complete loaded
    }
    function edit_mahasiswa(nim)
    {
        save_method = 'update';
        $('#form_mahasiswa')[0].reset(); // reset form
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#btnSave').text('Update'); //change button text
        $('#modal-mahasiswa-title').text(' Update Mahasiswa');
        $('#nim').attr('readonly',true); // tidak dapat mengubah nim
        $('#message').html('');
        $('#file_info').html('');
    
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('Mahasiswa/ajax_edit/')?>/" + nim,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data.status)
                {
                    $('[name="nim"]').val(data.nim);
                    $('[name="nama"]').val(data.nama);
                    $('[name="tempat"]').val(data.tempat);
                    $('[name="tanggal"]').val(data.tanggal);
                    $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
                    $('[name="id_program_studi"]').val(data.id_program_studi);
                    $('#modal_mahasiswa').modal('show');
                }
                else
                {
                    $('#modal_mahasiswa').modal('hide');
                    $('#message').html('<div class="mb-0 alert alert-danger shadow border-left-danger mt-2" role="alert">'+data.message+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('#message').html('<div class="mb-0 alert alert-danger shadow border-left-danger mt-2" role="alert">Kesalahan sistem<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }
        });    
    }

    function save()
    {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url;
    
        if(save_method == 'add') {
            url = "<?php echo base_url('Mahasiswa/ajax_add')?>";
        } else {
            url = "<?php echo base_url('Mahasiswa/ajax_update')?>";
        }
    
        var form_data = new FormData($('#form_mahasiswa')[0]);
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: form_data,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)

            {
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_mahasiswa').modal('hide');
                    $('#message').html('<div class="mb-0 alert alert-success shadow border-left-success mt-2" role="alert">'+data.message+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    reload_table();
                }
                else
                {   
                    $('.form-group').removeClass('has-error'); // clear error class
                    $('.help-block').empty(); // clear error string
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().addClass(); //select span help-block class set text error string
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('#modal_mahasiswa').modal('hide');
                $('#message').html('<div class="mb-0 alert alert-danger shadow border-left-danger mt-2" role="alert">Kesalahan sistem<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                reload_table();
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            }
        });
    }
    function delete_mahasiswa(nim)
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo base_url('Mahasiswa/ajax_delete')?>/"+nim,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                if (data.status)
                {
                    //if success reload ajax table
                    $('#modal_delete_mahasiswa').modal('hide');
                    $('#message').html('<div class="mb-0 alert alert-success shadow border-left-success mt-2" role="alert">'+data.message+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    reload_table();
                }
                else
                {
                    $('#modal_delete_mahasiswa').modal('hide');
                    $('#message').html('<div class="mb-0 alert alert-danger" role="alert">'+data.message+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('#delete_document_modal').modal('hide');
                $('#message').html('<div class="mb-0 alert alert-danger shadow border-left-danger mt-2" role="alert">Kesalahan sistem<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                reload_table();
            }
        });
    }

    // menampilkan modal confirmation delete user
    function delete_confirm(nim){
        $('#message').html('');
        $('#btn-delete').attr('onclick',"delete_mahasiswa('"+nim+"')");
        $('#modal_delete_mahasiswa').modal();
    }

    function reload_table()
    {
        table.ajax.reload(null,false); // reload ajax datatable
    }

</script>
<!-- / mahasiswa/js.php -->