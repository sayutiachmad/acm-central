var grid;
var tbl = $('#tb_plant');
var page_form = $('#mp_form');
var validate_form;
var notif_msg;

jQuery(document).ready(function($) {

    grid = tbl.DataTable({
        responsive: false,
        scrollX: true,

        ajax:{
            url: base_url+"plant/get_plant",
        },
        columns:[
            {"data":null,"defaultContent":"","width":"1px", "class":"text-right","searchable":false,"orderable":false},
            {"data":null,"defaultContent":"", "class":"dt-nowrap"},
            {"data":"Perusahaan_Name", "class":"dt-nowrap"},
            {"data":"Plant_ID","class":"text-center"},
            {"data":"Plant_Name", "class":"dt-nowrap"},
            {"data":"Address1", "class":"dt-nowrap"},
            {"data":"Address2"},
            {"data":"Phone"},
            {"data":"Label", "class":"dt-nowrap"},
        ],
        columnDefs: [
            {
                "targets":1,
                "render":function(data,type,row,meta){
                    var opt = '';
                    opt += '<a href="javascript:void(0);" class="btn btn-xs btn-warning action_edit" style="margin-right:5px;"><i class="fa fa-edit fa-xs"></i></a>';
                    opt += '<a href="javascript:void(0);" class="btn btn-xs btn-danger action_remove"><i class="fa fa-trash fa-xs"></i></a>';

                    return "<center>"+ opt +"</center>";
                }
            }

        ],
    });

    grid.on( 'order.dt search.dt', function () {
        grid.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#tb_plant tbody').on('click','.action_edit',function(){
        open_modal("Ubah Data plant");
        $('[name="id_p"]').val(grid.row($(this).parents('tr')).data().PPerusahaan_ID).change();
        $('[name="plant_id"]').val(grid.row($(this).parents('tr')).data().Plant_ID).change();
        $('[name="plant_id"]').attr('readonly','');
        $('[name="plant_name"]').val(grid.row($(this).parents('tr')).data().Plant_Name).change();
        $('[name="alamat_1"]').val(grid.row($(this).parents('tr')).data().Address1).change();
        $('[name="alamat_2"]').val(grid.row($(this).parents('tr')).data().Address2).change();
        $('[name="plant_label"]').val(grid.row($(this).parents('tr')).data().Label).change();
        $('[name="phone"]').val(grid.row($(this).parents('tr')).data().Phone).change();

        $('[name="plant_hostname"]').val(grid.row($(this).parents('tr')).data().data_hostname).change();
        $('[name="plant_host_username"]').val(grid.row($(this).parents('tr')).data().data_username).change();
        $('[name="plant_datasource"]').val(grid.row($(this).parents('tr')).data().data_db).change();


        $('[name="kd_plant"]').val(grid.row($(this).parents('tr')).data().Plant_ID);
    });

    $('#tb_plant tbody').on('click','.action_remove',function(){
        remove_data(grid.row($(this).parents('tr')).data().Plant_ID);
    });

    validate_form = page_form.validate({
        rules:{
            plant_name:"required",

        },
        messages:{
            plant_name:"Field ini harus diisi",
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function(form) {
            save_data();
        }
    });

    reloadTable();
    addForm();
});

function reloadTable(){
    $('#reload_table').click(function(event) {
        grid.ajax.reload();
    });
}

function open_modal(title){
    $("#modal_label").html(title);
    $('#modal_form').modal({
        backdrop:'static',
        keyboard:false
    });
}

function addForm(){
    $('#action_add').click(function(event) {
        reset_form();
        $('[name="mc_nrp_"]').removeProp('disabled');
        open_modal("Data Plant Baru");
    });
}

function reset_form(){
    page_form[0].reset();
    $('[name="plant_id"]').removeAttr('readonly');
    page_form.find('select').val("").change();
}

function fail_alert(title,content){
    $.alert({
        type:'red',
        buttons:{
            close:{
                btnClass:'btn-primary'
            }
        },
        title:title,
        content:content
    });
}

function save_data(){
    var form_data = page_form.serialize();
    $('#btn_submit').html('Processing...').attr('disabled','true');
    $('#modal_preloader').show('fast');
    var alert_title = "Tambah data mekanik";
    var alert_content;
    $.ajax({
        url: base_url+'plant/save_plant',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result==true){
            notif_msg = "Berhasil menyimpan data!";
            showNotification("bg-green", notif_msg, "top", "right", null, null);
            reset_form()
            $('#modal_form').modal('toggle');
            grid.ajax.reload();

        }else{
            if(parsed.response == "lbl_exist"){
                notif_msg = "Label sudah digunakan sebelumnya!";
                showNotification("alert-danger", notif_msg, "top", "right", null, null);
            }else if(parse.response == "id_exist"){
                notif_msg = "Oops! ID PLant Telah Digunakan !";
                showNotification("alert-danger", notif_msg, "top", "right", null, null);
            }
        }
    })
    .fail(function() {
        notif_msg = "Oops! Terjadi kesalahan saat megirim data";
        showNotification("alert-danger", notif_msg, "top", "right", null, null);
    })
    .always(function() {
        $('#btn_submit').html('SIMPAN').removeAttr('disabled');
        $('#modal_preloader').hide('fast');
    });
}

function remove_data(code){
    $.confirm({
        title: 'Konfirmasi',
        content: 'Hapus Data Plant ?',
        type: 'red',
        buttons: {
            remove: {
                text:"HAPUS",
                btnClass:"btn-danger",
                action:function(){
                    $.alert({
                        type:'orange',
                        buttons: {
                            close: {
                                btnClass:"btn-primary"
                            }
                        },
                        content: function(){
                            var self = this;
                            return $.ajax({
                                url: base_url+'plant/remove_plant',
                                type: 'POST',
                                data: {kd_plant: code}
                            })
                            .done(function(data) {
                                var parsed = JSON.parse(data);
                                self.setContent(parsed.msg);
                                self.setTitle('Hapus Data');
                                grid.ajax.reload();

                            })
                            .fail(function() {
                                self.setContent('Oops, terjadi kesalahan!');
                            });
                        }
                    });
                }
            },
            cancel: function () {

            },
        }
    });
}
