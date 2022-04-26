var grid;
var tbl = $('#table_for_data');
var page_form = $('#mp_form');
var validate_form;
var notif_msg;

jQuery(document).ready(function($) {

    prepare_select_parent();

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

    // bound_nestable();
    load_navigation();
    addForm();
});

$('#reload_list').on('click', function(){
    load_navigation();
});

$('#action_save').on('click', function(){
    var data_nest = $('.dd').nestable('serialize');
    // console.log(data_nest);
    $.ajax({
        url: base_url+'navigation/change_menu_order',
        type: 'post',
        dataType: 'json',
        data: {nav_nest: data_nest}
    })
    .done(function(response) {
        if(response.result >= 0){
            showNotification("bg-green", "Berhasil menyimpan navigasi", "top", "right", null, null);
        }else{
            showNotification("alert-danger", "Terjadi kesalaan saat menyimpan navigasi", "top", "right", null, null);
        }

    })
    .fail(function() {
        showNotification("alert-danger", "Terjadi kesalahan saat menyimpan navigais", "top", "right", null, null);
    })
    .always(function() {

    });

});

function bound_nestable(){
    $('#navigation-list').nestable({
        maxDepth : 3,
        group : 1,
        // rootClass : 'dd',
    });
}

function bound_list(){

    $('.dd-item').on('mouseenter', '.dd3-content',function(event){
        event.stopPropagation();
        $('.btn-peep').hide();
        $(this).find('.btn-peep').show();
    }).on('mouseleave','.dd3-content', function(event){
        event.stopPropagation();
        $(this).find('.btn-peep').hide();
    }).on('click', '.dd3-content .action-edit', function(event){
        event.stopPropagation();
        var code = $(this).parent().data('nav-code');
        $(this).parent().find('.loader-nestable').show();
        get_navigation_detail(code);
    }).on('click', '.dd3-content .action-remove', function(event){
        event.stopPropagation();
        var code = $(this).parent().data('nav-code');
        remove_data(code);
    });

    $(".dd-handle, .dd3-handle").empty();
}

function unbound_list(){
    $('.action-remove').unbind('click').unbind('mouseenter').unbind('mouseleave');
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
        dataType: 'json',
        data: form_data
    })
    .done(function(data) {
        if(data.result==true){
            notif_msg = "Berhasil menyimpan data!";
            showNotification("bg-green", notif_msg, "top", "right", null, null);
            page_form.get(0).reset();
            $('[name="nv_parent_"]').val(" ").change();
            $('#modal_form').modal('toggle');
            load_navigation();
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

function get_navigation_detail(code){
    $.ajax({
        url: base_url+'navigation/get_navigation_detail',
        type: 'post',
        dataType: 'json',
        data: {nav_code_: code}
    })
    .done(function(response) {
        if(response){
            open_modal("Ubah Navigasi");
            $('[name="nv_nama_navigasi_"]').val(response.result.navigation_name);
            $('[name="nv_link_"]').val(response.result.link);
            $('[name="nv_icon_"]').val(response.result.icon);
            $('[name="nv_parent_"]').val(response.result.parent).change();

            $('[name="nv_code_"]').val(response.result.id_navigation);
        }else{
            showNotification("alert-danger", "Terjadi kesalahan saat meminta data", "top", "right", null, null);
        }
    })
    .fail(function() {
        showNotification("alert-danger", "Terjadi kesalahan saat meminta data", "top", "right", null, null);
    })
    .always(function() {
        $('.loader-nestable').hide();
    });

}

function load_navigation(){
    $('#navigation-list').fadeOut('fast', function() {
        $('#list-preloader').fadeIn('fast');
        $('#alert-fail').fadeOut('fast');
    });

    // $('#navigation-list').nestable('destroy');

    $.ajax({
        url: base_url+'navigation/get_nestable_navigation',
        type: 'post',
        dataType: 'json',
    })
    .done(function(response) {
        $(".dd").html('').html(response.result);
        // $('#navigation-list').nestable('init');
        bound_nestable();
        bound_list();
        $(".btn-peep").hide();
        $('[data-toggle="tooltip"]').tooltip();
        setTimeout(
          function()
          {
            $('#navigation-list').fadeIn('fast',function(){
                $('#list-preloader').fadeOut('fast');
            });
        }, 500);
    })
    .fail(function() {
        setTimeout(
            function(){
                $('#alert-fail').fadeIn('fast');
            }, 500
        );
    })
    .always(function() {
        setTimeout(
            function(){
                $('#list-preloader').fadeOut('fast');
            }, 500
        );

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
                                dataType:'json',
                                data: {nv_code_: code}
                            })
                            .done(function(data) {
                                var parsed = data;
                                self.setContent(parsed.msg);
                                self.setTitle('Hapus Menu Navigasi');
                                load_navigation();
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
            added_option += '<option value="'+parsed.data[i].id_navigation+'">'+parsed.data[i].navigation_name+'</option>';
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
