var table_user = $("#table_user_list");
var table_nav = $("#table_permission");
var grid_user, grid_nav;

var page_form = $("#mp_form");
var validate_form;

var user_code = '';


$(document).ready(function() {

    $('.select').selectpicker();
    addForm();
    reloadTable();

    grid_user = table_user.DataTable({
        "sScrollX":false,
        "dom": 'ftipr',
        ajax:{
            url: base_url+"user/get_user",
        },
        order:[],
        columns:[
            {"data":null,"defaultContent":'',"orderable":false,"searchable":false},
            {"data":"user"},
            {"data":"user_fullname"}
        ]

    });

    grid_user.on( 'order.dt search.dt', function () {
        grid_user.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $("#table_user_list tbody").on('click','tr',function(){
        var user = grid_user.row($(this)).data().id_user;
        var name = grid_user.row($(this)).data().user;

        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            $('#selected_user').html('');
            $('[name="up_user_"]').val("");
            user_code = '';
            $('#parent-ref').html('');
        }else {
            grid_user.$('tr.selected').removeClass('selected');
            $('#selected_user').html(" - [ "+name+" ]");
            $('[name="up_user_"]').val(user);
            user_code = user;
            $(this).addClass('selected');
        }
        grid_nav.ajax.reload();
    });

    grid_nav = table_nav.DataTable({
        ajax:{
            url:base_url+"/navigation/get_user_permission",
            method:'post',
            data:function(f){
                f.user_code_ = user_code
            }
        },
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"], .dropdown-toggle').tooltip({
                container: 'body'
            });
        },
        order:[],
        columns:[
            {"data":null,"defaultContent":'','orderable':false,"searchable":false},
            {"data":"navigation_name"},
            {"data":"navigation_link"},
            {
                "data":"permission",
                "defaultContent":'',
                "class":"text-center",
                'orderable':false,
                "searchable":false,
                "render":function(data,type,row,meta){
                    if(data==0){
                        return '<span class="label label-danger"><i class="fas fa-times-circle"></i> Denied</span>';
                    }else{
                        return '<span class="label label-success"><i class="fas fa-check-circle"></i> Allowed</span>';
                    }
                }
            },
            {
                "data":null,
                "defaultContent":'',
                "class":"text-center",
                "searchable":false,
                "orderable":false,
                "render":function(data,type,row,meta){
                    var content = '';

                    content += '<a href="javascript:;" class="btn btn-xs btn-info action-edit" data-toggle="tooltip" data-placement="top" data-original-title="Ubah Data" title=""><i class="fas fa-pencil-alt"></i></a>';
                    content += '<a href="javascript:;" class="btn btn-xs btn-danger action-remove" data-toggle="tooltip" data-placement="top" data-original-title="Hapus Data" title=""><i class="fas fa-trash"></i></a>';

                    return content;
                }
            }

        ]
    });

    grid_nav.on( 'order.dt search.dt', function () {
        grid_nav.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $("#table_permission tbody").on('click','.action-edit',function(){
        open_modal("Ubah User Permission");
        $('[name="up_navigation_name_"]').val(grid_nav.row($(this).parents('tr')).data().navigation_name);
        $('[name="up_link_"]').val(grid_nav.row($(this).parents('tr')).data().navigation_link);
        $('[name="up_permission_"]').val(grid_nav.row($(this).parents('tr')).data().permission).change();
        $('[name="up_code_"]').val(grid_nav.row($(this).parents('tr')).data().up_id);
    }).on('click','.action-remove',function(){
        var code = grid_nav.row($(this).parents('tr')).data().up_id;
        remove_data(code);
    });

    validate_form = page_form.validate({
        rules:{
            up_navigation_name_:{
                required:true
            },
            up_link_:{
                required:true
            }
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


});

function reloadTable(){
    $('#reload_table').click(function(event) {
        grid_nav.ajax.reload();
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
        $('[name="up_code_"]').val("");
        page_form[0].reset();
        $('[name="up_permission_"]').val("").change();
        open_modal("User Permission Baru");
    });
}

function save_data(){
    var form_data = page_form.serialize();
    $('#btn_submit').html('<i class="fas fa-sync fa-spin"></i> Processing...').attr('disabled','true');
    $.ajax({
        url: base_url+'navigation/save_user_permission',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result){
            notif_msg = "Berhasil menyimpan data!";
            showNotification("bg-green", notif_msg, "top", "right", null, null);
            page_form.get(0).reset();
            $('[name="up_permission_"]').val("").change();
            $('#modal_form').modal('toggle');
            grid_nav.ajax.reload();
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
        $('#btn_submit').html('<i class="fas fa-save"></i> SIMPAN').removeAttr('disabled');
        $('#modal_preloader').hide('fast');
    });
}

function remove_data(code){
    $.confirm({
        title: 'Konfirmasi',
        content: 'Hapus User Permission?',
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
                                url: base_url+'navigation/remove_user_permission',
                                type: 'POST',
                                data: {up_code_: code}
                            })
                            .done(function(data) {
                                var parsed = JSON.parse(data);
                                self.setContent(parsed.msg);
                                self.setTitle('Hapus User Permission');
                                grid_nav.ajax.reload();
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
