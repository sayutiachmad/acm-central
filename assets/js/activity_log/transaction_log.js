var tbl = $('#table-data');

$(document).ready(function() {
    init_daterange();
    init_select2();

    grid = tbl.DataTable({
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        },
        ajax:{
            url: base_url+"activity_log/get_transaction_log",
            method:'post',
            data:function(d){
                return $('#filter-form').serialize();
            }
        },
        rowGroup:{
            dataSrc:"day_group",
            startRender: function(rows, group){



                return $('<tr/>')
                        .append(
                            '<td colspan="15"><strong>Log Transaksi : '+moment(group).format('DD MMM YYYY')+'</strong></td>'
                        )
            }
        },
        columns:[
            {"data":null,"defaultContent":"","width":"25px","searchable":false,"orderable":false},
            {
                "data":'create_datetime',
                "class":"text-center",
                "visible":false,
                "render":function(data){
                    return moment(data).format('DD MMM YYYY');
                }
            },
            {
                "data":'create_datetime',
                "class":"text-center",
                "render":function(data){
                    return moment(data).format('HH:mm');
                }
            },
            {
                "data":'transaction_category',
                "render":function(data){

                    if(data == "IN"){
                        return '<center><span class="badge badge-success">IN</span></center>';
                    }

                    if(data == "OUT"){
                        return '<center><span class="badge badge-danger">OUT</span></center>';
                    }

                    if(data == "INS"){
                        return '<center><span class="badge badge-success disabled">SYS ADJ / IN</span></center>';
                    }

                    if(data == "OUTS"){
                        return '<center><span class="badge badge-danger disabled">SYS ADJ / OUT</span></center>';
                    }

                    return '<center><span class="badge badge-warning">ADJUST</span></center>';

                }
            },
            {
                "data":"transaction_type",
                "render":function(data){

                    let lbl = '<center>';

                    switch (data) {
                        case 'RN':
                            lbl += '<span class="badge bg-indigo">Penerimaan</span>';
                            break;

                        case 'SA':
                            lbl += '<span class="badge bg-orange">Edit Stock</span>';
                            break;

                        case 'RT':
                            lbl += '<span class="badge bg-teal">Retur</span>';
                            break;

                        case 'DN':
                            lbl += '<span class="badge bg-lightblue">DO Baru</span>';
                            break;

                        case 'DU':
                            lbl += '<span class="badge bg-lightblue disabled">Edit DO</span>';
                            break;

                        case 'DD':
                            lbl += '<span class="badge bg-maroon">Hapus Item DO</span>';
                            break;

                        case 'MO':
                            lbl += '<span class="badge bg-navy disabled">Mutasi Outbound</span>';
                            break;

                        case 'MI':
                            lbl += '<span class="badge bg-olive disabled">Mutasi Inbound</span>';
                            break

                        default:
                            break;

                    }

                    lbl += '</center>';

                    return lbl;
                }
            },
            {
                "data":"ref_no",
                "render":function(data, type, row){

                    var chr = row.transaction_type.charAt(0);
                    var sub_chr = row.transaction_type.charAt(1);
                    var ret = "";

                    switch (chr) {
                        case 'R':
                            ret = '<a href="'+base_url+'receive/view/'+data+'"><strong>'+data+'</strong></a>';
                            break;

                        case 'S':
                            ret = '<a href="'+base_url+'item/stock_batch"><strong>'+data+'</strong></a>';
                            break;

                        default:
                            ret = data;
                    }

                    return ret;

                }
            },
            {
                "data":"batch_ref",
                "render":function(data){
                    return '<a href="'+base_url+'item/stock_batch/"><strong>'+data+'</strong></a>';
                }
            },
            {
                "data":"Name"
            },
            {
                "data":"qty_pcs"
            },
            {
                "data":"qty_kg"
            },
            {
                "data":"old_qty_pcs"
            },
            {
                "data":"old_qty_kg"
            },
            {
                "data":"new_qty_pcs"
            },
            {
                "data":"new_qty_kg"
            },
            {
                "data":"username"
            }
        ],
        columnDefs: [
        ],
        "order": []
    });

    grid.on( 'order.dt search.dt', function () {
        grid.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    $("#btn-filter").on('click',function(){
        grid.ajax.reload();
    });
});
