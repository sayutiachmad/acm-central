var grid;

$(document).ready(function(){
	init_select2();
	init_daterange();
	initReportGrid();
	initButton();
});

function initButton(){

	$('#btn-filter').on('click', function(){
		grid.ajax.reload();
	});

}

function initReportGrid(){
	grid = $('#tbl-data').DataTable({
        responsive: true,
        scrollCollapse: true,
        scrollX:true,
        paging: false,
        ordering:true,
        dom: 'Brtip',
        processing: true,
        language: {
            processing: '<i class="fas fa-sync fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
        },
        buttons: [
            { 
                extend: 'excel', text: '<i class="fa fa-file-excel-o"> Excel</i> ',
                exportOptions: {
                    columns: [0,1,':visible']
                }
            }, 
            {
                extend:'pdfHtml5',
                text:'<i class="fa fa-file-pdf-o"> PDF</i>',
                orientation:'landscape',
                pageSize : 'A3',
                exportOptions: {
                    columns: [0,1,':visible']
                }
                
            },
            { 
                extend: 'print', text: '<i class="fa fa-print"> Print</i> ',
                exportOptions: {
                    columns: [0,1,':visible']
                }
                
            },  
            { extend: 'colvis', text: '<i class="fa fa-star-half"> Filter Kolom</i>' }
        ],

        ajax:{
            url: base_url+"report/get_monthly_unit",
           method:'post',
           data:function(d){
               return $('#form-filter').serializeArray();
           }
        },
        rowGroup:{
            dataSrc:["bulan_penjualan"],
            startRender: function(rows, group){

                var index = 4;

                var gtHarpok = rows
                    .cells(rows.indexes(), index++)
                    .render()
                    .sum();

                var gtHarjul = rows
                    .cells(rows.indexes(), index++)
                    .render()
                    .sum();

                var gtDisc = rows
                    .cells(rows.indexes(), index++)
                    .render()
                    .sum();

                var gtNet = rows
                    .cells(rows.indexes(), index++)
                    .render('display')
                    .sum();

                var gtMargin = rows
                    .cells(rows.indexes(), index)
                    .render()
                    .sum();

                
                    

                return $('<tr/>')
                        .append( 
                            '<td colspan="4"><strong>Penjualan '+group+'</strong></td>'+
                            '<td class="text-right"><strong>'+ numeral(gtHarpok).format('0,0') +'</strong></td>'+
                            '<td class="text-right"><strong>'+ numeral(gtHarjul).format('0,0') +'</strong></td>'+
                            '<td class="text-right"><strong>'+ numeral(gtDisc).format('0,0') +'</strong></td>'+
                            '<td class="text-right"><strong>'+ numeral(gtNet).format('0,0') +'</strong></td>'+
                            '<td class="text-right"><strong>'+ numeral(gtMargin).format('0,0') +'</strong></td>'
                        )
            }
        },
        initComplete:function(settings,json){
            $('#tbl-data tbody').on( 'click', 'tr.dtrg-group.dtrg-start.dtrg-level-0', function (e) {
                    e.preventDefault();
                    var rowsCollapse = $(this).nextUntil('.dtrg-group');
                    $(rowsCollapse).toggleClass('hidden');
            });
        },
        columns:[
            {
                "data":null,"defaultContent":"",
                "orderable":false,
                "searchable":false,
                "class":'dt-nowrap',
            },
            {
                "data":"unit_name",
                "visible":true
            },
            {
                "data":"tp_mitra_name",
                "visible":true
            },
            {
                "data":"tp_tanggal",
                "class":"dt-nowrap",
                "render":function(data,type,row,meta){
                    return moment(data).format('DD-MMM-YYYY');
                }
            },
            {
                "data":"total_jual_harpok",
                "class":"text-right",
                "render":function(data){
                    return numeral(data).format('0,0');
                }
            },
            {
                "data":"total_jual_harjul",
                "class":"text-right",
                "render":function(data){
                    return numeral(data).format('0,0');
                }
            },
            {
                "data":"total_jual_diskon",
                "class":"text-right",
                "render":function(data){
                    return numeral(data).format('0,0');
                }
            },
            {
                "data":null,
                "class":"text-right",
                "render":function(data,type,row){

                    var harjul = row.total_jual_harjul;
                    var diskon = row.total_jual_diskon;

                    var net = parseFloat(harjul)-parseFloat(diskon);

                    return numeral(net).format('0,0');

                }
            },
            {
                "data":"total_jual_margin",
                "class":"text-right",
                "render":function(data){
                    return numeral(data).format('0,0');
                }
            }
            
        ],
        order:[[2, 'desc']]
    });

    
    grid.on( 'order.dt search.dt', function () {
       grid.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
           cell.innerHTML = i+1;
           grid.cell(cell).invalidate('dom');
        });
    }).draw();
}