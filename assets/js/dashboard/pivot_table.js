var pivot_female_pop;
var pivot_male_pop;
jQuery(document).ready(function($) {

	$.ajax({
		url: base_url+'dashboard/get_female_population',
		type: 'get',
		dataType: 'json',
	})
	.done(function(response) {

		var fml_pivotData = [
			{
				
				"Kandang":{"type":"string"},
				// "Depletion_Date":{"type":"date"},
				"Date":{"type":"string"},
				"Population":{"type":"number"}
			},
			...response
		]

		//console.log(pivotData);

		pivot_female_pop = new WebDataRocks({
			container: "#female_pop",
			// toolbar: true,
			height: 320,
			customizeCell: customizeCellFunction,
			report: {
				dataSource: {
					data: fml_pivotData
				},
				"slice": {
			        "rows": [
			            // {
			            //     "uniqueName": "Depletion_Date"
			            // },
			            {
			                "uniqueName": "Date"
			            }
			        ],
			        "columns": [
			            {
			                "uniqueName": "Kandang"
			            },
			        ],
			        "measures": [
			            {
			                "uniqueName": "Population",
			                "aggregation": "sum",
			                "format": "number"
			            },
			        ],
			        // "sorting": {
			        //     "row": {
			        //         "type": "asc",
			        //         "tuple": [],
			        //         "measure": "Depletion_Date"
			        //     }
			        // }
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
			        	  "showGrandTotals": "rows",
        				  "showHeaders": false,

     
			        }
			    }

			}
		});

	})
	.fail(function() {
		//console.log("error");
	})
	.always(function() {
		//console.log("complete");
	});

	function customizeCellFunction(cellBuilder, cellData) {
	  if (cellData.type == "value") {
	    if (cellData.rowIndex == 2 || cellData.rowIndex == 9) {
	      cellBuilder.addClass("alter1");
	    } else {
	      cellBuilder.addClass("alter2");
	    }
	  }
	}

	//male ======================

	$.ajax({
		url: base_url+'dashboard/get_male_population',
		type: 'get',
		dataType: 'json',
	})
	.done(function(response) {
		
		var male_pivotData = [
			{
				
				"Kandang":{"type":"string"},
				"Date":{"type":"string"},
				"Population":{"type":"number"}
			},
			...response
		]

		//console.log(pivotData);

		pivot_male_pop = new WebDataRocks({
			container: "#male_pop",
			//toolbar: false,
			height: 320,
			customizeCell: customizeCellFunction,
			report: {
				dataSource: {
					data: male_pivotData
				},
				"slice": {
			        "rows": [
			            {
			                "uniqueName": "Date"
			            }
			        ],
			        "columns": [
			            {
			                "uniqueName": "Kandang"
			            },
			        ],
			        "measures": [
			            {
			                "uniqueName": "Population",
			                "aggregation": "sum",
			                "format": "number"
			            },
			        ]
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
			        	  "showGrandTotals": "rows",
			        	  "showHeaders": false,
			        }
			    }
			    
			}
		});

	})
	.fail(function() {
		//console.log("error");
	})
	.always(function() {
		//console.log("complete");
	});
	

	
});