var grid;
var grid_sub;
var tbl = $('#table_for_data');
var tbl_sub = $('#table_for_data_sub');
var page_form = $('#mp_form');
var page_form_sub = $('#mp_form_sub');
var validate_form;
var validate_form_sub;
var validate_form_edit;
var notif_msg;
var select_parent = $('[name="cc_parent_"]');

$(document).ready(function() {
    addForm();
    addFormSub();
    reloadTable();
    reloadTableSub();
    prepare_select_parent();

    grid = tbl.DataTable({
        // responsive: true,
        // "scrollX":true,
        initComplete:function(setting, json){
            $('.dropdown-toggle').dropdown();

            if(tbl.data('parent')!='0'){
                $('#parent-ref').html(" - ["+tbl.data('parent')+"]");
            }

        },
        ajax:{
            url: base_url+"common_code/get_detail",
            method:'post',
            data:function(d){
                d.cc_parent_ = tbl.data('parent');
            }
        },
        columns:[
            {"data":null,"defaultContent":"","width":"5%","searchable":false,"orderable":false},
            {"data":"code","width":"10%"},
            {"data":"code_name","width":"auto"},
            {"data":"description1","width":"auto"},
            {"data":"description2","width":"auto"},
            {"data":"description3","width":"auto"},
            {"data":"amt1","width":"auto"},
            {"data":"amt2","width":"auto"},
            {"data":"amt3","width":"auto"},
            {"data":"status","width":"3%"},
            {
                "data":"sort",
                "defaultContent":"",
                "render":function(data,type,row,meta){

                    var btn = '<center>';

                    var total_row = row.max_sort;

                    if(data==1){
                        btn += '<button type="button" class="btn btn-success btn-xs move-down"><i class="fas fa-arrow-down"></i></button>';
                    }else if(data==total_row){
                        btn += '<button type="button" class="btn btn-success btn-xs move-up"><i class="fas fa-arrow-up"></i></button>';
                    }else if(data > 1){
                        btn += '<button type="button" class="btn btn-success btn-xs move-up"><i class="fas fa-arrow-up"></i></button>';
                        btn += '<button type="button" class="btn btn-success btn-xs move-down"><i class="fas fa-arrow-down"></i></button>';
                    }

                    btn += '</center>';

                    return btn;

                }
            },
            {"data":null,"defaultContent":'',"width":"5%"},
        ],
        columnDefs: [
            {
                "targets":9,
                "searchable":false,
                "orderable":false,
                "render":function(data,type,row,meta){

                    var cb_checked = (data==1 ? 'checked' : '');

                    var cb = '<div class="checkbox checkbox-custom checkbox-inline">';
                    cb += '<input id="'+row.code+'" type="checkbox" class="filled-in chk-col-blue status-common" data-head="'+row.code+'" data-parent="'+row.parent_code+'" '+cb_checked+'/>';
                    cb += '<label for="'+row.code+'"></label>';
                    cb += '</div>';

                    return "<center>"+cb+"</center>";
                }
            },
            {
                "targets":11,
                "searchable":false,
                "sortable":false,
                "render":function(data,type,row,meta){
                    var opt = '';

                    opt += '<div class="btn-group">';
                    opt += '<button type="button" class="btn btn-block btn-xs bg-blue dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    opt += 'Options';
                    opt += '</button>';
                    opt += '<div class="dropdown-menu" role="menu">';
                    opt += '<a href="javascript:void(0);" class="dropdown-item action_edit"><i class="fa fa-edit"></i> Edit</a>';
                    opt += '<a href="javascript:void(0);" class="dropdown-item action_remove"><i class="fa fa-trash"></i> Delete</a>';
                    opt += '</div>';
                    opt += '</div>';

                    return opt;
                }
            }
        ],
        "order": [],
    });

    grid.on( 'order.dt search.dt', function () {
        grid.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#table_for_data tbody').on('click','.status-common',function(){
        save_status_detail(this);
    }).on('click','.action_edit',function(){
        $('[name="cc_parent_"]').val(grid.row($(this).parents('tr')).data().code_parent).change();
        $('[name="cc_det_code_"]').val(grid.row($(this).parents('tr')).data().code).attr('readonly', 'true');
        $('[name="cc_code_"]').val(grid.row($(this).parents('tr')).data().code);
        $('[name="cc_code_name_"]').val(grid.row($(this).parents('tr')).data().code_name);
        $('[name="cc_desc_1_"]').val(grid.row($(this).parents('tr')).data().description1);
        $('[name="cc_desc_2_"]').val(grid.row($(this).parents('tr')).data().description2);
        $('[name="cc_desc_3_"]').val(grid.row($(this).parents('tr')).data().description3);
        $('[name="cc_amt_1_"]').val(grid.row($(this).parents('tr')).data().amt1);
        $('[name="cc_amt_2_"]').val(grid.row($(this).parents('tr')).data().amt2);
        $('[name="cc_amt_3_"]').val(grid.row($(this).parents('tr')).data().amt3);

        open_modal("Ubah Code Detail");
    }).on('click','.action_remove',function(){
        var code = grid.row($(this).parents('tr')).data().code;
        var parent = grid.row($(this).parents('tr')).data().parent_code;
        remove_data(code,parent,2);
    }).on('click','.move-up',function(){

        var code = grid.row($(this).parents('tr')).data().code;
        var parent = grid.row($(this).parents('tr')).data().parent_code;
        var pos = grid.row($(this).parents('tr')).data().sort;
        var direction = "up";

        save_sort(code, parent, direction, pos);

    }).on('click','.move-down',function(){

        var code = grid.row($(this).parents('tr')).data().code;
        var parent = grid.row($(this).parents('tr')).data().parent_code;
        var pos = grid.row($(this).parents('tr')).data().sort;
        var direction = "down";

        save_sort(code, parent, direction, pos);

    });

    grid_sub = tbl_sub.DataTable({
        // responsive: true,
        "bLengthChange": false,
        "pagingType":"simple_numbers",
        initComplete:function(setting, json){

        },
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"], .dropdown-toggle').tooltip({
                container: 'body'
            });
            $('.dropdown-toggle').dropdown()
        },
        ajax:{
            url: base_url+"common_code/get_head",
        },
        columns:[
            {"data":null,"defaultContent":"","width":"10%","searchable":false,"orderable":false},
            {"data":"code","width":"30%"},
            {"data":"code_name","width":"auto"},
        ],
        columnDefs: [
            {
                "targets":2,
                "class":"align-middle",
                "render":function(data,type,row,meta){

                    var cb_checked = (row.status==1 ? 'checked' : '');

                    var cb = '<div class="checkbox checkbox-custom checkbox-inline float-right mt-1 mr-1" data-toggle="tooltip"  data-original-title="Use" data-placement="top" >';
                    cb += '<input id="'+row.code+'" type="checkbox" class="filled-in chk-col-blue status-head" data-head="'+row.code+'" data-parent="'+row.parent_code+'" '+cb_checked+'/>';
                    cb += '<label for="'+row.code+'" class="label-status-head"></label>';
                    cb += '</div>';

                    var opt = '';

                    opt += '<div class="btn-group float-right">';
                    opt += '<button type="button" class="btn btn-info btn-xs font-small dropdown-toggle dropdown-opt-sub" data-original-title="Option" data-placement="top" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    opt += '';
                    opt += '</button>';
                    opt += '<div class="dropdown-menu float-right">';
                    opt += '<a href="javascript:void(0);" class="dropdown-item action_edit_sub no-select"><i class="fa fa-edit"></i> Edit</a>';
                    opt += '<a href="javascript:void(0);" class="dropdown-item action_remove_sub no-select"><i class="fa fa-trash"></i> Delete</a>';
                    opt += '</div>';
                    opt += '</div>';

                    return data+opt+cb;
                }
            }
        ],
        "order": [[ 1, 'asc' ]]
    });

    grid_sub.on( 'order.dt search.dt', function () {
        grid_sub.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#table_for_data_sub tbody').on('click','.action_edit_sub',function(){
        open_modal_sub("Ubah Head Code");
        $('[name="cc_head_code_"]').val(grid_sub.row($(this).parents('tr')).data().code).attr('readonly', 'true');
        $('[name="cc_head_code_name_"]').val(grid_sub.row($(this).parents('tr')).data().code_name);
        $('[name="cc_head_desc_"]').val(grid_sub.row($(this).parents('tr')).data().code_name);
        $('[name="cc_code_sub_"]').val(grid_sub.row($(this).parents('tr')).data().code);
        $('[data-toggle="dropdown"]').parent().removeClass('open');
        return false;
    }).on('click','.action_remove_sub',function(){
        var code = grid_sub.row($(this).parents('tr')).data().code;
        var parent = grid_sub.row($(this).parents('tr')).data().parent_code;
        remove_data(code, parent, 1);
        $('[data-toggle="dropdown"]').parent().removeClass('open');
        return false
    }).on('click','tr',function(){
        var code = grid_sub.row($(this)).data().code;
        var code_name = grid_sub.row($(this)).data().code_name;

        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            tbl.data('parent', 0);
            $('#parent-ref').html('');
        }else {
            grid_sub.$('tr.selected').removeClass('selected');
            tbl.data('parent', code);
            $('#parent-ref').html(' - [ '+code+' ] '+code_name);
            $(this).addClass('selected');
        }
        grid.ajax.reload();

    }).on('click','.dropdown-opt-sub',function(e){
        $('.dropdown-opt-sub').dropdown('toggle');
        return false;
    }).on('click','.status-head',function(e){
        save_status_detail(this);
        // return false;
    });

    validate_form = page_form.validate({
        rules:{
            cc_code_:"required",
            cc_code_name_:"required",
            cc_parent_:"required",
        },
        messages:{
            cc_code_:"Field ini harus diisi",
            cc_code_name_:"Field ini harus diisi",
            cc_parent_:"Field ini harus diisi",
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

    validate_form_sub = page_form_sub.validate({
        rules:{
            cc_head_code_:"required",
            cc_head_code_name_:"required",
        },
        messages:{
            cc_head_code_:"Field ini harus diisi",
            cc_head_code_name_:"Field ini harus diisi",
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
            save_data_sub();
        }
    });
});

function reloadTable(){
    $('#reload_table').click(function(event) {
        grid.ajax.reload();
    });
}

function open_modal(title){
    $("#modal_label").html(title);
    $('#alert_modal_sub').hide();
    var tbl_head = $('#table_for_data').data('parent');

    if(tbl_head!='0'){
        select_parent.val(tbl_head).change();
    }else{
        select_parent.val(" ").change();
    }

    $('#modal_form').modal({
        backdrop:'static',
        keyboard:false
    });
}


function addForm(){
    $('#action_add').click(function(event) {
        $('[name="cc_det_code_"]').removeAttr('readonly');
        $('[name="cc_code_"]').val('');
        page_form.get(0).reset();
        open_modal("Common Code Baru");
    });
}

function reloadTableSub(){
    $('#reload_table_sub').click(function(event) {
        reload_sub();
    });
}

function reload_sub(){
    $('#table_for_data').data('parent',0);
    $('#parent-ref').html('');
    grid_sub.ajax.reload();
    grid.ajax.reload();
}

function open_modal_sub(title){
    $("#modal_label_sub").html(title);
    $('#alert_modal_sub').hide();
    page_form_sub.get(0).reset();
    $('[name="cc_head_code_"]').val("").removeAttr('readonly');
    $('[name="cc_code_sub_"]').val("");
    $('#modal_form_sub').modal({
        backdrop:'static',
        keyboard:false
    });
}


function addFormSub(){
    $('#action_add_sub').click(function(event) {
        open_modal_sub("Head Code Baru");
    });
}

function save_data(){
    var form_data = page_form.serialize();
    $('#btn_submit').html('Processing...').attr('disabled','true');
    $('#modal_preloader').show('fast');
    $('#alert-modal').hide();
    $.ajax({
        url: base_url+'common_code/save_data',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result==true){
            notif_msg = "Berhasil menyimpan data!";
            showNotification("bg-green", notif_msg, "top", "right", null, null);
            page_form.get(0).reset();
            $('[name="cc_parent_"]').val(" ").change();
            $('#modal_form').modal('toggle');
            grid.ajax.reload();
        }else{
            if(parsed.result=='exist'){
                notif_msg = "Gagal menyimpan data, <b>Code sudah terpakai!</b>";
                $('#alert_msg').html(notif_msg);
                $('#alert_modal').fadeIn('fast');
            }else{
                notif_msg = "Oops! Gagal menyimpan data!";
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

function save_data_sub(){
    var form_data = page_form_sub.serialize();
    $('#btn_submit_sub').html('Processing...').attr('disabled','true');
    $('#modal_preloader_sub').show('fast');
    $.ajax({
        url: base_url+'common_code/save_head',
        type: 'POST',
        data: form_data
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result==true){
            notif_msg = "Berhasil menyimpan data!";
            showNotification("bg-green", notif_msg, "top", "right", null, null);
            page_form_sub.get(0).reset();
            $('#modal_form_sub').modal('toggle');
            reload_sub();
            prepare_select_parent();
        }else{
            if(parsed.result=='exist'){
                notif_msg = "Gagal menyimpan data, <b>Head code sudah terpakai!</b>";
                $('#alert_msg_sub').html(notif_msg);
                $('#alert_modal_sub').fadeIn('fast');
            }else{
                notif_msg = "Oops! Gagal menyimpan data!";
                showNotification("alert-danger", notif_msg, "top", "right", null, null);
            }
        }
    })
    .fail(function() {
        notif_msg = "Oops! Terjadi kesalahan saat megirim data";
        showNotification("alert-danger", notif_msg, "top", "right", null, null);
    })
    .always(function() {
        $('#btn_submit_sub').html('SIMPAN').removeAttr('disabled');
        $('#modal_preloader_sub').hide('fast');
    });
}

function remove_data(code, parent, type){
    var type_val = 'Detail Code';
    if(type==1){
        type_val = 'Head Code';
    }
    $.confirm({
        title: 'Konfirmasi',
        content: 'Hapus '+type_val+' '+code+'?',
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
                                url: base_url+'common_code/remove_common',
                                type: 'POST',
                                data: {
                                    cc_code_: code,
                                    cc_parent_:parent
                                }
                            })
                            .done(function(data) {
                                var parsed = JSON.parse(data);
                                self.setContent(parsed.msg);
                                self.setTitle('Hapus User Account');
                                if(type==1){
                                    grid_sub.ajax.reload();
                                    $("#parent-ref").html('');
                                    tbl.data('parent',0);
                                    grid.ajax.reload();
                                }else{
                                    grid.ajax.reload();
                                }
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

    var default_option = "";
    default_option += '<option value=" " selected disabled>- Pilih Head Code -</option>';

    var added_option;

    $.ajax({
        url: base_url+'common_code/get_head',
        type: 'POST',
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        added_option = "";
        for (var i = 0; i < parsed.data.length; i++) {
            var level_one = parsed.data[i].id_navigation;
            added_option += '<option value="'+parsed.data[i].code+'"> [ '+parsed.data[i].code+' ] '+parsed.data[i].code_name+'</option>';
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

function save_status_detail(element){
    disable_checkbox(element);
    var d_head = $(element).data('head');
    var d_parent = $(element).data('parent');
    var d_checked = element.checked;

    $.ajax({
        url: base_url+'common_code/save_status_code',
        type: 'POST',
        data: {
            cc_head_: d_head,
            cc_parent_: d_parent,
            cc_checked_: d_checked
        }
    })
    .done(function(data) {
        var parsed = JSON.parse(data)

        if(parsed.result){
            notif_msg = "Berhasil menyimpan status code detail!";
            showNotification("bg-green", notif_msg, "top", "right", null, null);
        }else{
            notif_msg = "Oops! terjadi kesalahan saat menyimpan data";
            showNotification("alert-danger", notif_msg, "top", "right", null, null);
            $(element).attr('checked', !checked);
        }
    })
    .fail(function() {
        notif_msg = "Oops! terjadi kesalahan saat mengirim data";
        showNotification("alert-danger", notif_msg, "top", "right", null, null);
        $(element).attr('checked', !checked);
    })
    .always(function() {
        enable_checkbox(element);
    });

}

function disable_checkbox(element){
    $(element).attr('disabled', 'true').removeClass('chk-col-blue').addClass('chk-col-grey');
}

function enable_checkbox(element){
    $(element).removeAttr('disabled').removeClass('chk-col-grey').addClass('chk-col-blue');
}

function save_sort(head, parent, direction, last_pos){
    $.ajax({
        url: base_url+'common_code/move_sort',
        type: 'POST',
        data:{
            cc_head_ : head,
            cc_parent_ : parent,
            cc_direction_ : direction,
            cc_last_position_ : last_pos
        }
    })
    .done(function(data) {
        var parsed = JSON.parse(data);
        if(parsed.result){
            grid.ajax.reload();
        }
    })
    .fail(function() {

    })
    .always(function() {

    });
}
