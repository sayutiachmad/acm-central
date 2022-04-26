// var pivot_female_pop;
// var pivot_male_pop;
var ctx, myChart;
var startDate = "";
var endDate = "";
var chartData = {};
var hendayStartDate = "";
var hendayEndData = "";
var hendayChartData = {};
var steps = 31;
var datePeriod = 'week';
var hendayPeriod = 'week';



$(document).ready(function() {



	// $.ajax({
	// 	url: base_url+'dashboard/get_sum_ps_population',
	// 	type: 'get',
	// 	dataType: 'json',
	// })
	// .done(function(response) {

	// 	var fml_pivotData = [
	// 		{
				
	// 			"Kandang":{"type":"string"},
	// 			// "Depletion_Date":{"type":"date"},
	// 			"Date":{"type":"string"},
	// 			"Population":{"type":"number"}
	// 		},
	// 		...response
	// 	]

	// 	//console.log(pivotData);

	// 	pivot_female_pop = new WebDataRocks({
	// 		container: "#female_pop",
	// 		// toolbar: true,
	// 		height: 320,
	// 		customizeCell: customizeCellFunction,
	// 		report: {
	// 			dataSource: {
	// 				data: fml_pivotData
	// 			},
	// 			"slice": {
	// 		        "rows": [
	// 		            // {
	// 		            //     "uniqueName": "Depletion_Date"
	// 		            // },
	// 		            {
	// 		                "uniqueName": "Date"
	// 		            }
	// 		        ],
	// 		        "columns": [
	// 		            {
	// 		                "uniqueName": "Kandang"
	// 		            },
	// 		        ],
	// 		        "measures": [
	// 		            {
	// 		                "uniqueName": "Population",
	// 		                "aggregation": "sum",
	// 		                "format": "number"
	// 		            },
	// 		        ],
	// 		        // "sorting": {
	// 		        //     "row": {
	// 		        //         "type": "asc",
	// 		        //         "tuple": [],
	// 		        //         "measure": "Depletion_Date"
	// 		        //     }
	// 		        // }
	// 		    },
	// 		    "formats": [
	// 		        {
	// 		            "name": "number",
	// 		            "thousandsSeparator": ",",
	// 		            "decimalPlaces": 0
	// 		        }
	// 		    ],
	// 		    "options": {
	// 		        "grid": {
	// 		        	  "showGrandTotals": "off",
    //     				  "showHeaders": false,

     
	// 		        }
	// 		    }

	// 		}
	// 	});

	// })
	// .fail(function() {
	// 	//console.log("error");
	// })
	// .always(function() {
	// 	//console.log("complete");
	// });

	// function customizeCellFunction(cellBuilder, cellData) {
	//   if (cellData.type == "value") {
	//     if (cellData.rowIndex == 2 || cellData.rowIndex == 9) {
	//       cellBuilder.addClass("alter1");
	//     } else {
	//       cellBuilder.addClass("alter2");
	//     }
	//   }
	// }

	// //male ======================

	// $.ajax({
	// 	url: base_url+'report_production/get_male_population',
	// 	type: 'get',
	// 	dataType: 'json',
	// })
	// .done(function(response) {
		
	// 	var male_pivotData = [
	// 		{
				
	// 			"Kandang":{"type":"string"},
	// 			"Date":{"type":"string"},
	// 			"Population":{"type":"number"}
	// 		},
	// 		...response
	// 	]

	// 	//console.log(pivotData);

	// 	pivot_male_pop = new WebDataRocks({
	// 		container: "#male_pop",
	// 		//toolbar: false,
	// 		height: 320,
	// 		customizeCell: customizeCellFunction,
	// 		report: {
	// 			dataSource: {
	// 				data: male_pivotData
	// 			},
	// 			"slice": {
	// 		        "rows": [
	// 		            {
	// 		                "uniqueName": "Date"
	// 		            }
	// 		        ],
	// 		        "columns": [
	// 		            {
	// 		                "uniqueName": "Kandang"
	// 		            },
	// 		        ],
	// 		        "measures": [
	// 		            {
	// 		                "uniqueName": "Population",
	// 		                "aggregation": "sum",
	// 		                "format": "number"
	// 		            },
	// 		        ]
	// 		    },
	// 		    "formats": [
	// 		        {
	// 		            "name": "number",
	// 		            "thousandsSeparator": ",",
	// 		            "decimalPlaces": 0
	// 		        }
	// 		    ],
	// 		    "options": {
	// 		        "grid": {
	// 		        	  "showGrandTotals": "off",
	// 		        	  "showHeaders": false,
	// 		        }
	// 		    }
			    
	// 		}
	// 	});

	// })
	// .fail(function() {
	// 	//console.log("error");
	// })
	// .always(function() {
	// 	//console.log("complete");
	// });
	
	// =================== start date range picker ===================
	// var start = moment().subtract(29, 'days');
	
	// alert(end);

	// cb(start,end, datePeriod);
	// cb_henday(start, end, hendayPeriod);

	

	// $('#report_range').daterangepicker({
	//     showDropdowns : true,
	//     minYear: 2017,
	//     maxYear: 2020,
	//     startDate: start,
	//     endDate: end,
	//     ranges: {
	//        // 'Today': [moment(), moment()],
	//        // 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	//        // 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	//        // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	//        'This Week': [moment().startOf('week'), moment()],
	//        'This Month': [moment().startOf('month'), moment()],
	//        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
	//        'Last 3 Month': [moment().subtract(3, 'month').startOf('month'), moment()],
	//        'This Year': [moment().startOf('year'), moment()]
	//     }
	// }, cb);

    
	

	
	

	// =================== end date range picker ===================
	
});

// ===== Start Chart Egg Production ==========================

var year = moment().format('YYYY');
var start = moment(year+'-01-01').subtract(0, 'week').startOf('week');
var end = moment();

$("input.datepick").daterangepicker({
	startDate: moment(start).format('YYYY-MM-DD'),
	endDate: moment(end).format('YYYY-MM-DD'),
	orientation: 'left',
  	minDate: '2017-01-01',
  	maxDate: moment().add(2, 'years'),
  	callback: function (startDate, endDate, period) {
    	$(this).val(startDate.format('DD MMM YYYY') + ' – ' + endDate.format('DD MMM YYYY'));
    	cb(startDate, endDate, period);

  	}
});

$("input.datepickHenDay").daterangepicker({
	startDate: moment(start).format('YYYY-MM-DD'),
	endDate: moment(end).format('YYYY-MM-DD'),
	orientation: 'left',
  	minDate: '2017-01-01',
  	maxDate: moment().add(2, 'years'),
  	callback: function (startDate, endDate, period) {
    	$(this).val(startDate.format('DD MMM YYYY') + ' – ' + endDate.format('DD MMM YYYY'));
    	cb_henday(startDate, endDate, period);

  	}
});



generateChart();
// loadEggChart(startDate, endDate, datePeriod);
cb(start,end, datePeriod);

	

function loadEggChart(start, end, datePeriod){

	$.ajax({
        url: base_url+"/dashboard/get_egg",
        method: 'POST',
        data:{
        	period : datePeriod || 'week',
        	startDate : start,
        	endDate : end
        },
        dataType: 'json',
        success: function (data) {

        	for(var i = 0; i < data.label.length; i++){

	        	myChart.data.labels.push(data.label[i]);
	        	myChart.data.datasets[0].data.push(data.data[i]);
        	}
        	
        	// re-render the chart
        	myChart.update();
        }
    });
}

function generateChart(){

	ctx = document.getElementById('myChart').getContext('2d');
	myChart = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels: [],
	        datasets: [{
	            label: 'Egg Production',
	            data: [],
	            borderColor: 'rgb(255, 99, 132)',
	            backgroundColor: 'rgba(153, 102, 255, 0.05)',
	            borderWidth: 3
	        }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                }
	            }]
	        }
	    }
	});
}

function clearChart(){
	var len = myChart.data.labels.length;

	for(var i = 0; i < len; i++){
		myChart.data.labels.pop();
	    myChart.data.datasets.forEach((dataset) => {
	        dataset.data.pop();
	    });
	    myChart.update();
	}
	
}

// ===== End Chart Egg Production ==========================

// ===== Start Chart HD Butir ==========================

generateChart_HD_Butir();
// loadChart_HD_Butir(startDate, endDate, datePeriod);
cb_henday(start, end, hendayPeriod);


function loadChart_HD_Butir(start, end, datePeriod) {

	$.ajax({
		url: base_url + "/dashboard/get_HD_Butir",
		method: 'POST',
		data: {
			period: datePeriod,
			startDate: start,
			endDate: end
		},
		dataType: 'json',
		success: function (data) {

			for (var i = 0; i < data.label.length; i++) {

				Chart_HD_Butir.data.labels.push(data.label[i]);
				Chart_HD_Butir.data.datasets[0].data.push(data.data[i]);
			}

			// re-render the chart
			Chart_HD_Butir.update();
		}
	});
}

function generateChart_HD_Butir() {

	ctx = document.getElementById('Chart_HD_Butir').getContext('2d');
	Chart_HD_Butir = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [],
			datasets: [{
				label: 'Hen Day Production',
				data: [],
				borderColor: 'rgb(241, 129, 33)',
				backgroundColor: 'rgba(255, 180, 115, 0.05)',
				borderWidth: 3
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
}

function clearChart_HD_Butir() {
	var len = Chart_HD_Butir.data.labels.length;

	for (var i = 0; i < len; i++) {
		Chart_HD_Butir.data.labels.pop();
		Chart_HD_Butir.data.datasets.forEach((dataset) => {
			dataset.data.pop();
		});
		Chart_HD_Butir.update();
	}

}

// ===== End Chart Egg Production ==========================

function cb(start, end, period) {
    // $('#report_range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    startDate = moment(start).format('YYYY-MM-DD');
    endDate = moment(end).format('YYYY-MM-DD');
    datePeriod = period;
    if(typeof myChart !== "undefined"){
    	clearChart();
		loadEggChart(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), period);
		$('.datepick').val(moment(start).format('DD MMM YYYY')+" - "+moment(end).format('DD MMM YYYY'));
    }

}

function cb_henday(start, end, period) {
    // $('#report_range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    hendayStartDate = moment(start).format('YYYY-MM-DD');
    hendayStartDate = moment(end).format('YYYY-MM-DD');
    hendayPeriod = period;
    if(typeof myChart !== "undefined"){
    	clearChart_HD_Butir();
		loadChart_HD_Butir(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), period);
		$('.datepickHenDay').val(moment(start).format('DD MMM YYYY')+" - "+moment(end).format('DD MMM YYYY'));
    }

}