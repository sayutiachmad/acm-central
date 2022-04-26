var grid;
var tbl = $('#table_for_data');
var notif_msg;

var last_parent = 0;
var last_nav = 0;

jQuery(document).ready(function($) {

    grid = tbl.DataTable({
        responsive:true,
        paging:false,
        searching:false,
        ajax:{
            url: base_url+"navigation/get_navigation_permission",
        },
        columnDefs:[
            {
                "targets":0,
                "defaultContent":"",
                "data":null,
                "width":"2%",
                "sortable":false,
                "searchable":false,
            },
            {
                "targets":1,
                "data":"navigation_name",
                "defaultContent":"",
                "width":"30%",
                "className":"text-left",
                "render":function(data,type,row,meta){
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
                "targets":"_all",
                "defaultContent":"",
                "data":null,
                "sortable":false,
                "orderable":false,
                "className":"text-center",
                "width":"8%",
                "render":function(data,type,row,meta){
                    if(meta.col>0){
                        var tbl_obj = tbl[0].rows[0].cells[meta.col];
                        var identifier = $(tbl_obj).data('identifier');
                        var code = row.id_navigation+"-"+identifier;
                        var cb_checked = '';
                        if(row.pcode!=null){
                            var status_list = row.pcode.split(",");
                            cb_checked = (status_list.indexOf(code) > -1 ? 'checked' : '');
                        }
                        var cb = '<div class="checkbox checkbox-custom checkbox-inline">';
                        cb += '<input id="'+code+'" type="checkbox" class="filled-in chk-col-blue nav-permission" data-pcode="'+code+'" '+cb_checked+'/>';
                        cb += '<label for="'+row.id_navigation+"-"+identifier+'"></label>';
                        cb += '</div>';

                        // var cb = '<div class="checkbox"><label for="'+row.id_navigation+'-'+identifier+'"><input type="checkbox" class="flat nav-permission" id="'+code+'" data-pcode="'+code+'" '+cb_checked+'></label></div>';

                        return cb;
                    }
                }
            }
        ],
        order : [],
    });

    grid.on( 'order.dt search.dt', function () {
        grid.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $('#table_for_data tbody').on('change','.nav-permission', function(){
        // console.log('change');
        save_data(this);
    });

    reloadTable();

});

function reloadTable(){
    $('#reload_table').click(function(event) {
        grid.ajax.reload();
    });
}

function save_data(element){
    disable_checkbox(element);
    var pcode = $(element).data('pcode');
    var checked = element.checked;
    $.ajax({
        url: base_url+'navigation/save_permission',
        type: 'POST',
        data: {
            pcode: pcode,
            checked: checked
        }
    })
    .done(function(data) {
        var parsed = JSON.parse(data)

        if(parsed.result){
            notif_msg = "Berhasil menyimpan hak akses pengguna!";
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
