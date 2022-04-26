var grid;
var tbl = $('#table_for_data');
var page_form = $('#mp_form');
var validate_form;
var notif_msg;

var last_parent = 0;
var last_nav = 0;

jQuery(document).ready(function($) {

    prepare_select_parent();

    grid = tbl.DataTable({
        responsive: true,
        "sScrollX":false,
        "paging":false,
        ajax:{
            url: base_url+"navigation/get_navigation",
        },
        columns:[
            {"data":null,"defaultContent":"","width":"5%","searchable":false,"orderable":false},
            {"data":"navigation_name","width":"35%"},
            {"data":"link"},
            {"data":"icon"},
            {"data":"parent"},
            {"data":null,"defaultContent":"","width":"12%","class":'text-center'}
        ],
        columnDefs: [
            {
                "targets":1,
                "render": function(data,type,row,meta){
                    var ret = data;

                    if(row.parent>0){
                        if (last_parent>0 && last_nav==row.parent) {
                            ret = '&#x257C;&#x257C;  '+data;
                        }else{
                            ret = '&#x257C;  '+data;
                        }
                    }

                    last_parent = row.parent;
                    last_nav = row.id_navigation;
                    return ret;
                }
            },
            {
                "targets":3,
                "width":"5%",
                "render":function(data,type,row,meta){
                    return "<center><i class='"+data+"'></i></center>";
                }
            },
            {
                "targets":4,
                "render":function(data,type,row,meta){
                    if(data>0){
                        return row.parent_name;
                    }

                    return "";
                }
            },
            {
                "targets":5,
                "searchable":false,
                "orderable":false,
                "render":function(data,type,row,meta){
                    var opt = '';

                    opt += '<div class="btn-group">';
                    opt += '<button type="button" class="btn btn-block btn-xs bg-blue dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    opt += 'Options <span class="caret"></span>';
                    opt += '</button>';
                    opt += '<div class="dropdown-menu pull-right" role="menu">';
                    opt += '<a href="javascript:void(0);" class=" dropdown-item action_edit"><i class="fa fa-edit"></i> Edit</a>';
                    opt += '<a href="javascript:void(0);" class=" dropdown-item action_remove"><i class="fa fa-trash"></i> Delete</a>';
                    opt += '</div>';
                    opt += '</div>';

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
        open_modal("Ubah Navigasi");
        $('[name="nv_nama_navigasi_"]').val(grid.row($(this).parents('tr')).data().navigation_name);
        $('[name="nv_link_"]').val(grid.row($(this).parents('tr')).data().link);
        $('[name="nv_icon_"]').val(grid.row($(this).parents('tr')).data().icon);
        $('[name="nv_parent_"]').val(grid.row($(this).parents('tr')).data().parent).change();

        $('[name="nv_code_"]').val(grid.row($(this).parents('tr')).data().id_navigation);
    });

    $('#table_for_data tbody').on('click','.action_remove',function(){
        remove_data(grid.row($(this).parents('tr')).data().id_navigation);
    });

    validate_form = page_form.validate({
        rules:{
            nv_nama_navigasi_:"required"
        },
        messages:{
            nv_nama_navigasi_:"Field ini harus diisi"
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
        $('[name="nv_code_"]').val("");
        page_form[0].reset();
        $('[name="nv_parent_"]').val(" ").change();
        open_modal("Navigasi Baru");
    });
}

function save_data(){
    var form_data = page_form.serialize();
    $('#btn_submit').html('Processing...').attr('disabled','true');
    $('#modal_preloader').show('fast');
    $.ajax({
        url: base_url+'navigation/save_navigation',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result){
            notif_msg = "Berhasil menyimpan data!";
            showNotification("bg-green", notif_msg, "top", "right", null, null);
            page_form.get(0).reset();
            $('[name="nv_parent_"]').val(" ").change();
            $('#modal_form').modal('toggle');
            grid.ajax.reload();
            prepare_select_parent();
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
        content: 'Hapus Menu Navigasi?',
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
                                url: base_url+'navigation/remove_navigation',
                                type: 'POST',
                                data: {nv_code_: code}
                            })
                            .done(function(data) {
                                var parsed = JSON.parse(data);
                                self.setContent(parsed.msg);
                                self.setTitle('Hapus Menu Navigasi');
                                grid.ajax.reload();
                                prepare_select_parent();
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

function prepare_select_parent(){
    var select_parent = $('[name="nv_parent_"]');

    var default_option = "";
    default_option += '<option value=" " selected disabled>- Pilih Parent -</option>';
    default_option += '<option value="0">Menu Utama</option>';
    default_option += '<option data-divider="true"></option>'

    var added_option;

    $.ajax({
        url: base_url+'navigation/get_navigation_parent',
        type: 'POST',
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        added_option = "";
        for (var i = 0; i < parsed.data.length; i++) {
            if(parsed.data[i].parent==0){
                var level_one = parsed.data[i].id_navigation;
                added_option += '<option value="'+parsed.data[i].id_navigation+'">'+parsed.data[i].navigation_name+'</option>';
                for(var x = 0; x < parsed.data.length; x++){
                    if(parsed.data[x].parent==level_one){
                        var level_two = parsed.data[x].id_navigation;
                        added_option += '<option value="'+parsed.data[x].id_navigation+'">&nbsp; - '+parsed.data[x].navigation_name+'</option>';
                        for(var y = 0; y < parsed.data.length; y++){
                            if(parsed.data[y].parent==level_two){
                                added_option += '<option value="'+parsed.data[x].id_navigation+'">&nbsp;&nbsp; -- '+parsed.data[x].navigation_name+'</option>';
                            }
                        }
                    }

                }
            }
        }
        select_parent.empty().append(default_option).append(added_option).selectpicker('refresh');
    })
    .fail(function() {
        select_parent.empty().append(default_option);
        select_parent.selectpicker('refresh');
    })
    .always(function() {

    });

}
