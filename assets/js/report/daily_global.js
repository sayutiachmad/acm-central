var grid;

$(document).ready(function(){
	init_select2();
	init_daterange();
	initReportGrid();
	initButton();
});

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
                extend: 'excel', text: '<i class="fas fa-file-excel"> Excel</i> ',
                exportOptions: {
                    columns: [0,1,':visible']
                }
            }, 
            {
                extend:'pdfHtml5',
                text:'<i class="fas fa-file-pdf"> PDF</i>',
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
        "drawCallback": function( settings ) {
            $('[data-toggle="popover"]').popover();
        },
        ajax:{
            url: base_url+"report/get_daily_global",
            method:'post',
            data:function(d){
                return $('#form-filter').serializeArray();
            }
        },
        rowGroup:{
            dataSrc:"tanggal_transaksi",
            startRender: function(rows, group){

                var index = 6;

                var gtHarpok = rows
                    .cells(rows.indexes(), index++)
                    .render('display')
                    .sum();

                var gtHarjul = rows
                    .cells(rows.indexes(), index++)
                    .render('display')
                    .sum();

                var gtDisc = rows
                    .cells(rows.indexes(), index++)
                    .render('display')
                    .sum();

                var gtNet = rows
                    .cells(rows.indexes(), index++)
                    .render('display')
                    .sum();


                var gtMargin = rows
                    .cells(rows.indexes(), index)
                    .render('display')
                    .sum();

                
                    

                return $('<tr/>')
                        .append( 
                            '<td colspan="5"><strong>Penjualan Tanggal '+moment(group).format('DD-MMM-YYYY')+'</strong></td>'+
                            '<td class="text-right"><strong>'+ numeral(gtHarpok).format('0,0') +'</strong></td>'+
                            '<td class="text-right"><strong>'+ numeral(gtHarjul).format('0,0') +'</strong></td>'+
                            '<td class="text-right"><strong>'+ numeral(gtDisc).format('0,0') +'</strong></td>'+
                            '<td class="text-right"><strong>'+ numeral(gtNet).format('0,0') +'</strong></td>'+
                            '<td class="text-right"><strong>'+ numeral(gtMargin).format('0,0') +'</strong></td>'+
                            '<td colspan="5"></td>'
                        )
            }
        },
        initComplete:function(settings,json){
            $('#tbl-penjualan tbody').on( 'click', 'tr.dtrg-group.dtrg-start.dtrg-level-0', function (e) {
                    e.preventDefault();
                    var rowsCollapse = $(this).nextUntil('.dtrg-group');
                    $(rowsCollapse).toggleClass('hidden');
            });
            $($.fn.dataTable.tables(true)).DataTable()
                  .columns.adjust();
        },
        columns:[
            {
                "data":null,"defaultContent":"",
                "orderable":false,
                "searchable":false,
                "class":'dt-nowrap',
            },
            {
                "data":"tp_tanggal_jual",
                "class":"dt-nowrap",
                "visible":false,
                "render":function(data,type,row,meta){
                    return moment(data).format('YYYY-MM-DD');
                }
            },
            {
            	"data":"unit_name",
            	"class":"dt-nowrap",
            	"defaultContent":"",
            	"render":function(data){
            		if(data == ""){
            			return "";
            		}

            		return data;
            	}
            },
            {
                "data":"tp_mitra_name",
                "class":"dt-nowrap",
                "defaultContent":"",
                "render":function(data){

                    if(data == ""){
                        return "";
                    }

                    return data;
                }
            },
            {
                "data":"tp_customer_name",
                "class":"dt-nowrap",
                "render":function(data,type,row,meta){
                    if(row.tp_customer > 0){
                        return data;
                    }

                    if(row.tp_keterangan == 'PMU'){
                        return row.tp_mitra_name;
                    }

                    return "<center> - </center>";
                }
            },
            {
                "data":"tp_nofak",
                "class":"dt-nowrap",
                "render":function(data,type,row,meta){
                    var nf = '<strong>'+data+'</strong>';
                    if(row.tp_status == 0){
                        return nf
                    }

                    return nf + ' <span class="badge badge-danger">BATAL</span>';

                } 
            },
            {
                "data":"total_harpok",
                "class":"text-right dt-nowrap",
                "render":function(data,type,row,meta){
                    

                    return numeral(data).format('0,0');
                }
            },
            {
                "data":"total_harjul",
                "class":"text-right dt-nowrap",
                "render":function(data,type,row,meta){
                    
                    return numeral(data).format('0,0');
                }
            },
            {
                "data":"total_diskon",
                "class":"text-right",
                "render":function(data,type,row,meta){
                    if(row.jual_status == 1){
                        return 0
                    }
                    return numeral(data).format('0,0');
                }
            },
            {
                "data":"total_jual",
                "class":"text-right",
                "render":function(data,type,row){

                    

                    return numeral(data).format('0,0');

                }
            },
            {
                "data":null,
                "defaultContent":"",
                "class":"text-right",
                "render":function(data,type,row,meta){
                    let ppu = parseFloat(row.total_harjul)-parseFloat(row.total_harpok);
                    let disc = row.total_diskon;

                    let profit = parseFloat(ppu)- parseFloat(disc);

                    if(row.jual_status == 1){
                        return 0
                    }

                    return numeral(profit).format('0,0');

                }
            },
            {
                "data":"tp_status_pembayaran",
                "render":function(data,type,row,meta){

                    if(data == "0"){
                        var ret = '<center>';
                        ret += '<span class="badge badge-danger">Belum Lunas</span>';
                        ret += '</center>';

                        return ret;
                    }

                    return '<center><span class="badge badge-success">Lunas</span></center>';
                }
            },
            {
                "data":"tp_metode_pembayaran",
                "render":function(data,type,row){

                    if(data == "TRF"){
                        var ret = '<div>';
                        ret += '<span class="badge badge-primary">Transfer</span>';

                        if(row.bank_name != null){
                            ret += '&nbsp;';
                            ret += '<span class="badge badge-warning">'+row.bank_name+'</span>';
                        }
                        ret += '</div>';

                        return '<center>'+ret+'</center>';
                    }

                    if(data == 'CSH'){
                        return '<center><span class="badge badge-warning">Cash</span></center>';
                    }

                    if(data == 'PGJ'){
                        return '<center><span class="badge badge-info">Potong Gaji</span></center>';
                    }

                    return '-';


                }
            },
            {
                "data":"tp_tanggal_pembayaran",
                "defaultContent":"",
                "render":function(data){

                    var dt = moment(data,"YYYY-MM-DD HH:mm:ss",true)

                    if(!dt.isValid()){
                        return "-"; 
                    }
                    

                    return '<strong><a href="javascript:;" class="view-img">'+moment(data).format('DD-MMM-YYYY')+'</a></strong>';
                }
            },
            {
                "data":"tp_tanggal_pembayaran",
                "defaultContent":"",
                "render":function(data,type,row){

                    var dt = moment(data,"YYYY-MM-DD HH:mm:ss",true);
                    var dt_buy = moment(row.tp_tanggal, "YYYY-MM-DD HH:mm:ss",true);

                    if(!dt.isValid()){
                        return "-"; 
                    }

                    return dt.diff(dt_buy, 'days')+" Hari";
                }
            },
            {
                "data":"tp_keterangan",
                "render":function(data,type,row,meta){

                    if(data == "RUM"){
                        return '<center><span class="badge bg-orange">Retail Umum</span></center>';
                    }else if(data == "RHO"){
                        return '<center><span class="badge bg-olive">Retail Karyawan</span></center>';
                    }else if(data == "AGN"){
                        return '<center><span class="badge bg-purple">Agen</span></center>';
                    }else if(data == "PMU"){
                        return '<center><span class="badge badge-warning">Mitra Umum</span></center>';
                    }else{
                        return "<center> - </center>";
                    }

                }
            },
        ],
        order:[[1, 'desc'],[3,'asc']]
    });

    
    grid.on( 'order.dt search.dt', function () {
       grid.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
           cell.innerHTML = i+1;
           grid.cell(cell).invalidate('dom');
        });
    }).draw();

    grid.on( 'column-visibility.dt', function ( e, settings, column, state ) {
        const groupRows = $(this).find('tr.group');
          $(groupRows).each((index) => {
            const groupRow = groupRows[index];
            if (state) {
              $(groupRow).find('td:eq(' + column + ')').show();
            } else {
              $(groupRow).find('td:eq(' + column + ')').hide();
            }
          })
    } );

    $('#tbl-data tbody').on('click','.view-img',function(){
                
        var img  = grid.row($(this).parents('tr')).data().tp_bukti_pembayaran_full_path.split("/");
        var pay_date = grid.row($(this).parents('tr')).data().tp_tanggal_pembayaran;
        var pay_method = grid.row($(this).parents('tr')).data().tp_metode_pembayaran;

        var basic_url = base_url.split("/");
        
        $.confirm({
            title: 'Bukti Pembayaran',
            content: '' +
                '<div class="bukti-image"><img style="    border: solid 1px #ddd;\n' +
                '    margin-bottom: 10px;\n' +
                '    border-radius: 4px;" src="" alt=""></div>' +
                '',
            animation: 'scale',
            animationClose: 'top',
            buttons: {
                
                close: function(){
                    // lets the user close the modal.
                }
            },
            onContentReady: function(){
                $('.bukti-image img').attr('src', basic_url[0]+"//"+basic_url[2]+"/"+img[4]+"/"+img[5]+"/"+img[6]+"/"+img[7]+"/"+img[8]);
            }
        });
    });

}

function initButton(){

	$('#btn-filter').on('click', function(){
		grid.ajax.reload();
	});

}
