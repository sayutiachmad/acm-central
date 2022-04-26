
var pivot_ps_grower;

jQuery(document).ready(function($) {
	
	// load_ps_grower();
	
	$('#btn-filter').on('click', function () {
        // alert();
        load_ps_grower();
			
	});
	
});

function load_ps_grower(){
	// ps grower ======================================
	$.ajax({
		url: base_url + 'dashboard/get_stock_ps_grower',
		dataType: 'json',
		data: {
			company_ : $('[name="fl_company_"]').val(),
			plant_ : $('[name="fl_plant_"]').val(),
            fiscal_year_ : $('[name="fl_fiscal_year_"]').val(),
            period_: $('[name="fl_period_"]').val(),
		},
		method: 'post',

	})
	.done(function (response) {

		var ps_grower_pivotData = [
			{
                "Item_Name": { "type": "string" },
                "SLoc_Name": { "type": "string" },
                "Trans_Name": { "type": "string" },
                "Qty": { "type": "number" },
                "Amt": { "type": "number" },
                "Item_ID": { "type": "number" },
			},
			...response
		]

		// console.log(pivotData);

		pivot_ps_grower = new WebDataRocks({
			container: "#ps_grower",
            toolbar: true,
             height: 800,
			// customizeCell: customizeCellFunction,
			report: {
				dataSource: {
                    data: ps_grower_pivotData
				},
				"slice": {
					"rows": [
                        {
                            "uniqueName": "SLoc_Name",
                            "caption":"SLoc"
                        },
						{
                            "uniqueName": "Item_Name",
                            "caption": "Item"
						}
					],
					"columns": [
						{
                            "uniqueName": "Trans_Name",
                            "caption": "Transaction"
						},
					],
					"measures": [
						{
							"uniqueName": "Qty",
							"aggregation": "sum",
							"format": "number",
                            "grandTotalCaption": "Total"
                            
                        },
                        {
                            "uniqueName": "Up",
                            "formula": "if( sum('Qty') =0,0, sum('Amt') / sum('Qty')) ",
                            "caption": "Uprice",
                            "active": true,
                            "format": "number",
                        },
                        {
                            "uniqueName": "Amt",
                            "aggregation": "sum",
                            "format": "number",
                            "grandTotalCaption": "Total"
                        },
                        
					],
					// "sorting": {
					//     "row": {
					//         "type": "asc",
					//         "tuple": [],
					//         "measure": "Depletion_Date"
					//     }
                    // }
                    "expands":{
                        "expandAll": true
                    }
				},
				"formats": [
					{
						"name": "number",
						"thousandsSeparator": ",",
						"decimalPlaces": 0
					}
				],
				"options": {
					"grid": {
                        
						"showGrandTotals": "columns",
						"showHeaders": false,

                    },
                     "showAggregationLabels": false,
				}

			}
		});
        // webdatarocks.expandAllData();
	})
	.fail(function () {
		//console.log("error");
	})
	.always(function () {
		//console.log("complete");
    });

    function setWidth() {
        webdatarocks.off("reportcomplete");
        var report = pivot.getReport();
        report["tableSizes"] = { "columns": [{ "idx": 0, "width": 100 }] };
        pivot.setReport(report);
    }
    
}
// ================



