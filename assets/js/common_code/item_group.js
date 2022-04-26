var child_level = "";
var data_parent = "";
var data_head = "";
var node_text = "";

var ig_form = $("#mp_form");
var validate_form;

$(document).ready(function() {
    $('#tree').jstree({
        'core': {
            'themes': {
                'name': 'proton',
                'responsive': true,
                'icons':false
            }
        }
    });

    $('#tree').on('ready.jstree', function() {
        $("#tree").jstree("open_all");
    }).on("select_node.jstree", function (e, data) {

        child_level = data.node.li_attr.child_level;
        data_parent = data.node.li_attr.data_parent;
        data_head = data.node.li_attr.data_head;
        data_name = data.node.li_attr.data_name;
        node_text = $.trim(data.node.text);
        console.log(child_level);

        if(child_level<3){
            $("#add_child").removeAttr('disabled').removeClass('disabled');
        }
        $('#edit_data').removeAttr('disabled').removeClass('disabled');
    });

    $("#add_child").on('click',function(){
        $("#sub_title").html(" - Tambah Child");
        $('[name="cc_parent_"]').val(data_head);
        $('[name="edit"]').val("0");
        $('[name="cc_code_"]').val("");
    });

    $("#edit_data").on('click',function(){
        $("#sub_title").html(" - Ubah Data");
        $('[name="cc_parent_"]').val(data_parent);
        $('[name="cc_det_code_"]').val(data_head);
        $('[name="edit"]').val("1");
        $('[name="cc_code_"]').val(data_head);
        $('[name="cc_code_name_"]').val(data_name);
    });

    $("#btn_cancel").on('click',function(){
        ig_form.trigger('reset');
    });

    validate_form = ig_form.validate({
        ignoreTitle:true,
        rules:{
            cc_parent_:{
                required:true,
            },
            cc_det_code_:{
                required:true,
            },
            cc_code_name_:{
                required:true,
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

});

function save_data(){
    var form_data = ig_form.serialize();
    $('#btn_submit').html('<i class="fas fa-sync fa-spin"></i> Processing...').attr('disabled','true');
    $('#modal_preloader').show('fast');
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

            if($('[name="cc_desc_3_"]').val() == "ITG"){
                setTimeout(window.location.replace(base_url+"common_code/item_group"), 2500);
            }else if($('[name="cc_desc_3_"]').val() == "PSG"){
                setTimeout(window.location.replace(base_url+"common_code/partner_group"), 2500);
            }

        }else{
            if(parsed.result=='exist'){
                notif_msg = "Gagal menyimpan data, <b>ID ITEM sudah terpakai!</b>";
                $('#alert_msg').html(notif_msg);
                $('#alert_modal').fadeIn('fast');
                showNotification("alert-danger", notif_msg, "top", "right", null, null);
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
        $('#btn_submit').html('<i class="fa fa-save"></i> Simpan').removeAttr('disabled');
        $('#modal_preloader').hide('fast');
    });
}
