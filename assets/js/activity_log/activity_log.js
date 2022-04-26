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
            url: base_url+"activity_log/get_activity_log",
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
                            '<td colspan="17"><strong>Log Activity : '+moment(group).format('DD MMM YYYY')+'</strong></td>'
                        )
            }
        },
        columns:[
            {"data":null,"defaultContent":"","width":"25px","searchable":false,"orderable":false},
            {
                "data":'create_at',
                "class":"text-center",
                "visible":false,
                "render":function(data){
                    return moment(data).format('DD MMM YYYY');
                }
            },
            {
                "data":'create_at',
                "class":"text-center",
                "render":function(data){
                    return moment(data).format('HH:mm');
                }
            },
            {
                "data":'activity_category',
                "render":function(data){

                    if(data == "NEW"){
                        return '<center><span class="badge badge-success">ADD NEW</span></center>';
                    }

                    if(data == "MOD"){
                        return '<center><span class="badge badge-warning">EDIT</span></center>';
                    }

                    if(data == "DEL"){
                        return '<center><span class="badge badge-danger disabled">DELETE</span></center>';
                    }

                    if(data == "APV"){
                        return '<center><span class="badge badge-primary disabled">APPROVAL</span></center>';
                    }

                    if(data == "RES"){
                        return '<center><span class="badge bg-light disabled">RESTORE</span></center>';
                    }

                    if(data == "GEN"){
                        return '<center><span class="badge badge-info disabled">GENERATE</span></center>';
                    }

                    if(data == "PRE"){
                        return '<center><span class="badge badge-secondary disabled">PREVIEW</span></center>';
                    }

                    return '';

                }
            },
            {
                "data":"activity_type",
                "render":function(data){

                    let lbl = '<center>';

                    switch (data) {
                        case 'PO':
                            lbl += '<span class="badge bg-indigo">SO</span>';
                            break;

                        case 'DO':
                            lbl += '<span class="badge bg-orange">DO</span>';
                            break;

                        case 'SJ':
                            lbl += '<span class="badge bg-teal">SJ</span>';
                            break;

                        case 'SC':
                            lbl += '<span class="badge bg-lightblue">SC</span>';
                            break;

                        case 'INV':
                            lbl += '<span class="badge bg-maroon">INVOICE</span>';
                            break;

                        case 'MTR':
                            lbl += '<span class="badge bg-lime">MASTER</span>';
                            break;

                        case 'MTS':
                            lbl += '<span class="badge bg-navy">MUTASI</span>';
                            break;

                        case 'OPN':
                            lbl += '<span class="badge bg-olive">OPNAME</span>';
                            break

                        case 'BEG':
                            lbl += '<span class="badge bg-pink">BEGINNING</span>';
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

                    if(row.activity_type == 'MTR'){
                        return '<strong>'+data+'</strong>';
                    }

                    return '<a href="javascript:;" class="btn-link redirect-detail" data-number="'+data+'" data-type="'+row.activity_type+'"> <strong>'+data+'</strong></a>';

                }
            },
            {
                "data":"description"
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

    $('#table-data tbody').on('click','.redirect-detail',function(){

        var re_no = $(this).data('number');
        var re_type = $(this).data('type');

        var redirect = $.alert({
            content: function () {
                var self = this;
                return $.ajax({
                    url: base_url+'activity_log/redirect_detail/',
                    dataType: 'json',
                    method: 'post',
                    data:{
                        re_no,
                        re_type
                    }
                }).done(function (response) {

                    if(response.result){

                        window.open(base_url+response.response.link, '_blank');
                        self.close(true);
                    }


                    self.setContent('Terjadi kesalahan saat meminta data');
                    self.setTitle("Redirect");

                }).fail(function(){
                    self.setTitle("Redirect");
                    self.setContent('Terjadi kesalahan saat meminta data');
                });
            }
        });

    });


    $("#btn-filter").on('click',function(){
        grid.ajax.reload();
    });


});
