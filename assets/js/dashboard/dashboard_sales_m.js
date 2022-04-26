var grid;
var tbl = $('#table-data');

$(document).ready(function() {
    

    grid = tbl.DataTable({
        "scrollX":true,
        "lengthChange": false,
        "pagingType":"simple",
        "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        },
        ajax:{
            url: base_url+"purchase_order/get_po",
            method:'post',
        },
        columns:[

            {
                "data":null,
                "defaultContent":"",
                "render":function(data,type,row){

                	var code = row.fiscal_year+"-"+row.po_id;
                	var content = '';

                	content += '<table class="table table-sm no-border" style="width:100%;">';

                	content += '<tr>';
                	content += '<td colspan="2">'+ prepareStatusLabel(row.checker_approval, row.po_approval_status, row.po_send_status) +'</td>'; 
                	content += '</tr>';

                	content += '<tr>';

                	content += '<td>';
                	content += 'No. PO Customer';
                	content += '<p class="text-bold my-0">';
                	content += row.po_customer_po_no || "-";
                	content += '</p>';
                	content += '</td>';

                	content += '<td>';
                	content += '<p class="mb-0">No. SO</p>';
                	content += '<a href="'+base_url+"purchase_order/view/"+code+'" class="btn btn-link text-bold pl-0 pt-0" >'+ row.po_no +'</a></li>';
                	content += '</td>';

                	content += '</tr>';

                	content += '<tr>';
                	
                	content += '<td>';
                	content += 'Customer';
                	content += '<p class="text-bold my-0">';
                	content += row.Name || "-";
                	content += '</p>';
                	content += '</td>';
                	
                	content += '<td>';
                	content += 'Tanggal SO';
                	content += '<p class="text-bold my-0">';
                	content += moment(row.po_date).format("DD-MM-YYYY") || "-";
                	content += '</p>';
                	content += '</td>';

                	content += '</tr>';

                	content += '<tr>';

                	content += '<td>';
                	content += 'Sales';
                	content += '<p class="text-bold my-0">';
                	content += row.sales_name || "-";
                	content += '</p>';
                	content += '</td>';

                	content += '<td>';
                	content += 'Total Harga';
                	content += '<p class="text-bold my-0"> Rp. ';
                	content += numeral(row.grand_total).format('0,0') || "-";
                	content += '</p>';
                	content += '</td>';

                	content += '</tr>';

                	content += '</table>';

                	return content;

                }
            },

        ],
        columnDefs: [
        ],
        "order": []
    });

});

function prepareStatusLabel(checker_approval, approval_status, send_status){

	var master_content = ""

	var content = '<label class="mr-1 badge badge-warning">Belum Dikonfirmasi</label>';

    if(checker_approval == 1){
        content = '<label class="mr-1 badge badge-success">Disetujui</label>';
    }else if(checker_approval == 0){
        content = '<label class="mr-1 badge badge-danger">Ditolak</label>';
    }

    master_content += content;

    var data = parseInt(approval_status);
    var ret = '';

    switch (data) {
        case 0:
            ret += '<span class="mr-1 badge badge-warning">Draft</span>';
            break;

        case 1:
            ret += '<span class="mr-1 badge badge-success">Diterima</span>';
            break;


        default:
            ret += '<span class="mr-1 badge badge-danger">Dibatalkan</span>';
    }

    master_content += ret;

    var data = parseInt(send_status);
    var ret = '';

    switch (data) {
        case 0:
            ret += '<span class="mr-1 badge bg-orange">Belum Dikirim</span>';
            break;

        case 1:
            ret += '<span class="mr-1 badge bg-olive">Sudah Dikirim</span>';
            break;
    }

    master_content += ret;

    return master_content;

}