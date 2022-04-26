var table_user = $("#table_user_list");
var grid_user;

var user_code = '';
var navtree;


$(document).ready(function() {

    $('.select').selectpicker();
    initJsTree();
    $('#reload_user').on('click',function(){
        grid_user.ajax.reload();
    });

    $('.reload-nav').on('click',function(){
        if(user_code > 0){
            callNavList();
        }
    });

    $('#copy-nav').on('click',function(){
        $('#modal-copy-from').modal('show');
        if(user_code > 0){
            $('#user_to').val(user_code).change();

            // $("#user_from").val('default');
            // $('#user_from').find('option').prop('disabled',false);
            // $('#user_from').find('[value="'+user_code+'"]').prop('disabled',true);
            // $('#user_from').selectpicker('refresh');
        }else{
            $("#user_to").val('default').selectpicker('refresh');
        }

        $("#user_from").val('default').selectpicker('refresh');
        $('#btn-confirm').addClass('disabled');
    });

    $('#user_from, #user_to').on('change',function(){
        var from = $("#user_from").find(':selected').val();
        var to = $("#user_to").find(':selected').val();

        if(from > 0 && to > 0){
            $('#btn-confirm').removeClass('disabled');
        }else{
            $('#btn-confirm').addClass('disabled');
        }

    });

    $('#btn-confirm').on('click', function(){

        var from = $("#user_from").find(':selected').val();
        var to = $("#user_to").find(':selected').val();

        copyUserNav(from, to);

    });

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
            {"data":"user_fullname"},
            {"data":"type"}
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
            $('#tree-content').hide();
            $('#info-bar').show();
        }else {
            grid_user.$('tr.selected').removeClass('selected');
            $('#selected_user').html(" - [ "+name+" ]");
            $('[name="up_user_"]').val(user);
            user_code = user;
            $(this).addClass('selected');
            callNavList();
        }
    });

});

function callNavList(){
    $('#loading-bar').show();
    $('#info-bar').hide();
    $('#tree-content').hide();
    $('#alert-nav').hide();
    $.ajax({
        url: base_url+'navigation/get_nav_tree',
        type: 'POST',
        dataType: 'JSON',
        data:{
            "user_code":user_code
        }
    })
    .done(function(response) {
        // $("#tree-content").empty().html(response.response);
        $("#tree-content").jstree().settings.core.data = response.response;
        $('#tree-content').jstree().refresh(true);

        $('#tree-content').jstree(true).open_all();
        $('li[data-nav-permission="checked"]').each(function() {
            $('#tree-content').jstree('check_node', $(this));
        });

        $('li[data-nav-permission="unchecked"]').each(function() {
            $('#tree-content').jstree('uncheck_node', $(this));
        });

        initNavAnchor();
    })
    .fail(function() {
        $('#loading-bar').hide();
        $('#alert-nav').show();
        $('#tree-content').hide();
    })
    .always(function() {
        $('#loading-bar').hide();
        $('#tree-content').show();
    });

}

function initJsTree(){
    navtree = $('#tree-content').jstree({
        "plugins": ["checkbox"],
        "checkbox" : {
            "three_state" : false
        },
        'core': {
            'themes': {
                'name': 'proton',
                'responsive': true,
                'icons':false
            }
        }
    });
}

function initNavAnchor(){
    $('.jstree-anchor').on('click',function(){

        var save_result = saveUserNav($(this).parents('li').data('nav-id'), $(this).hasClass('jstree-clicked'));

        if(!save_result){
            $(this).removeClass('jstree-clicked');
        }
    })
}

function saveUserNav(nav_code, state){
    var result = true;
    $.ajax({
        url: base_url+'navigation/save_user_navigation',
        type: 'post',
        dataType: 'json',
        data: {
            nav_code: nav_code,
            user_code:user_code,
            chk_state:state
        }
    })
    .done(function(response) {
        var notif_msg;
        if(response.result){
            notif_msg = "Success "+response.response+" user navigation";
            showNotification("alert-success", notif_msg, "top", "right", null, null);
        }else{
            notif_msg = "Failed "+response.response+" user navigation";
            showNotification("alert-danger", notif_msg, "top", "right", null, null);
        }
        result = response.result;
    })
    .fail(function() {

    })
    .always(function() {

    });

    return result
}

function copyUserNav(from, to){
    var notif_msg = '';
    $("#btn-confirm").html('<i class="fas fa-sync fa-spin"></i> Loading . . .').attr('disabled', 'true');
    $.ajax({
        url: base_url+'navigation/copy_user_navigation',
        type: 'post',
        dataType: 'json',
        data: {
            user_from: from,
            user_to: to
        }
    })
    .done(function(response) {
        if(response.result){
            notif_msg = "Success Copying User Navigation";
            simple_alert("Copy User Navigation",notif_msg, 'green');

            $('#modal-copy-from').modal('hide');

            if(user_code > 0){
                callNavList();
            }

        }else{
            notif_msg = "Failed Copying User Navigation";
            simple_alert("Copy User Navigation",notif_msg, 'red');
        }
    })
    .fail(function() {
        notif_msg = "Oops! Something wrong while sending request to server";
        simple_alert("Something Wrong",notif_msg, 'red');
    })
    .always(function() {
        $("#btn-confirm").html('<i class="fas fa-check"></i> CONFIRM').removeAttr('disabled')
    });

}
