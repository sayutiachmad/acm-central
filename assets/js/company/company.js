var grid;
var tbl = $('#tb_company');
var page_form = $('#mp_form');
var validate_form;
var notif_msg;

jQuery(document).ready(function($) {

    grid = tbl.DataTable({
        responsive: false,
        scrollX: true,
        ajax:{
            url: base_url+"company/get_company",
        },
        columns:[
            {"data":null,"defaultContent":"","width":"5%","searchable":false,"orderable":false},
            {"data":null,"defaultContent":"","width":"12%"},
            {"data":"Perusahaan_ID"},
            {"data":"Perusahaan_Name"},
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

    $('#tb_company tbody').on('click','.action_edit',function(){
        open_modal("Ubah Data Company");
        $('[name="per_id"]').val(grid.row($(this).parents('tr')).data().Perusahaan_ID).change();
        $('[name="per_id"]').attr('readonly','');
        $('[name="per_name"]').val(grid.row($(this).parents('tr')).data().Perusahaan_Name).change();

        $('[name="kd_company"]').val(grid.row($(this).parents('tr')).data().Perusahaan_ID);
    });

    $('#tb_company tbody').on('click','.action_remove',function(){
        remove_data(grid.row($(this).parents('tr')).data().Perusahaan_ID);
    });

    validate_form = page_form.validate({
        rules:{
            per_id:"required",
            per_name:"required",

        },
        messages:{
            per_id:"Field ini harus diisi",
            per_name:"Field ini harus diisi",
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
        open_modal("Data Company Baru");
    });
}

function reset_form(){
    page_form[0].reset();
    $('[name="per_id"]').removeAttr('readonly');
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
    var alert_title = "Tambah data Company";
    var alert_content;
    $.ajax({
        url: base_url+'company/save_company',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result==true){
            notif_msg = "Berhasil menyimpan data!";
            showNotification("bg-green", notif_msg, "top", "right", null, null);
            reset_form();
            $('#modal_form').modal('toggle');
            grid.ajax.reload();

        }else{
            notif_msg = "Oops! ID Perusahaan Telah Digunakan !";
            $('#modal_form').modal('toggle');
            showNotification("alert-danger", notif_msg, "top", "right", null, null);
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
        content: 'Hapus Data perusahaan ?',
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
                                url: base_url+'company/remove_company',
                                type: 'POST',
                                data: {kd_company: code}
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
