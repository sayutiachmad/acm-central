var grid;
var tbl = $('#table_for_data');
var page_form = $('#mp_form');
var validate_form;
var notif_msg;

$(document).ready(function() {

    grid = tbl.DataTable({
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        },
        ajax:{
            url: base_url+"supplier/get_supplier",
        },

        columns:[
            {"data":null,"defaultContent":"","width":"25px","searchable":false,"orderable":false},
            {"data":null,"defaultContent":"","width":"100px","class":'text-center'},
            {"data":"vendor_id","width":"25px"},
            {"data":"short_name","width":"200px"},
            {"data":"full_name","width":"200px"},
            {"data":"address_1","width":"200px"},
            {"data":"address_2","width":"200px"},
            {"data":"phone"},
            {"data":"bank_id"},
            {"data":"bank_branch"},
            {"data":"bank_account"},
            {"data":"account_name"},
            {"data":"npwp"},
            {"data":"siup"},
            {"data":"account_code"},
            {"data":"contact_person"},
        ],
        columnDefs: [
            {
                "targets":1,
                "searchable":false,
                "orderable":false,
                "render":function(data,type,row,meta){
                    var opt = '';
                    opt += '<a href="javascript:void(0);" class="btn btn-xs btn-success action_edit" data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil-alt"></i> </a>';
                    opt += '<a href="javascript:void(0);" class="btn btn-xs btn-danger action_remove" data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-trash"></i> </a>';
                    return opt;
                }
            }
        ],
        "order": []
    });

    grid.on( 'order.dt search.dt', function () {
        grid.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#table_for_data tbody').on('click','.action_edit',function(){
        $('[name="sp_code_"]').val(grid.row($(this).parents('tr')).data().vendor_id);
        $('[name="sp_supplier_code_"]').val(grid.row($(this).parents('tr')).data().vendor_id).attr('readonly', 'true');
        $('[name="sp_s_name_"]').val(grid.row($(this).parents('tr')).data().short_name);
        $('[name="sp_f_name_"]').val(grid.row($(this).parents('tr')).data().full_name);
        $('[name="sp_addr_1_"]').val(grid.row($(this).parents('tr')).data().address_1);
        $('[name="sp_addr_2_"]').val(grid.row($(this).parents('tr')).data().address_2);
        $('[name="sp_phone_"]').val(grid.row($(this).parents('tr')).data().phone);
        $('[name="sp_bank_"]').val(grid.row($(this).parents('tr')).data().bank_id);
        $('[name="sp_branch_"]').val(grid.row($(this).parents('tr')).data().bank_branch);
        $('[name="sp_acc_"]').val(grid.row($(this).parents('tr')).data().bank_account);
        $('[name="sp_acc_name_"]').val(grid.row($(this).parents('tr')).data().account_name);
        $('[name="sp_npwp_"]').val(grid.row($(this).parents('tr')).data().npwp);
        $('[name="sp_siup_"]').val(grid.row($(this).parents('tr')).data().siup);
        $('[name="sp_acc_code_"]').val(grid.row($(this).parents('tr')).data().account_code);
        $('[name="sp_cp_"]').val(grid.row($(this).parents('tr')).data().contact_person);


        open_modal("Ubah Supplier");
    }).on('click','.action_remove',function(){
        var code = grid.row($(this).parents('tr')).data().vendor_id;
        remove_data(code);
    });

    validate_form = page_form.validate({
        rules:{
            sp_supplier_code_:{
                required:true,
                maxlength:6,
            },
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
    $('.form-line').removeClass('error');
    $('#alert_modal').hide();
    validate_form.resetForm();
    $('#modal_form').modal({
        backdrop:'static',
        keyboard:false
    });
}

function addForm(){
    $('#action_add').click(function(event) {
        $('[name="sp_code_"]').val("");
        $('[name="sp_supplier_code_"]').removeAttr('readonly');
        page_form[0].reset();
        open_modal("Supplier Baru");
    });
}

function save_data(){
    var form_data = page_form.serialize();
    $('#btn_submit').html('Processing...').attr('disabled','true');
    $('#modal_preloader').show('fast');
    $.ajax({
        url: base_url+'supplier/save_supplier',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result){
            if(parsed.result==true){
                notif_msg = "Berhasil menyimpan data!";
                showNotification("bg-green", notif_msg, "top", "right", null, null);
                page_form.get(0).reset();
                $('#modal_form').modal('toggle');
                grid.ajax.reload();
            }else{
                if(parsed.result=='exist'){
                    notif_msg = "Gagal menyimpan data, <b>ID Supplier sudah terpakai!</b>";
                    $('#alert_msg').html(notif_msg);
                    $('#alert_modal').fadeIn('fast');
                    showNotification("alert-danger", notif_msg, "top", "right", null, null);
                }else{
                    notif_msg = "Oops! Gagal menyimpan data!";
                    showNotification("alert-danger", notif_msg, "top", "right", null, null);
                }
            }
        }else{
            notif_msg = "Oops! Gagal menyimpan data!";
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
        content: 'Delete Supplier?',
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
                                url: base_url+'supplier/remove_supplier',
                                type: 'POST',
                                data: {sp_code_: code}
                            })
                            .done(function(data) {
                                var parsed = JSON.parse(data);
                                self.setContent(parsed.msg);
                                self.setTitle('Delete Supplier');
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
