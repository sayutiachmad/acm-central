const sellUnitEl = document.getElementById('sell-unit-chart');
var sellUnitChart;
var sellUnitChartData = {}

$(document).ready(function(){
	initDateMonth();
	initButton();
	initSellUnitChart();
	// retrieveSellUnitData();

});

function initDateMonth(){
	$('.date-month').datepicker('destroy').datepicker({
        format: "M yyyy",
        clearBtn: true,
        autoclose: true,
        disableTouchKeyboard: true,
        startView: "months", 
    	minViewMode: "months"
    });
}

function initButton(){
	$('#btn-filter').on('click',function(){
		retrieveSellUnitData();
	});
}

function initSellUnitChart(){

	sellUnitChart = new Chart(sellUnitEl, {
	    type: 'bar',
	    data: {},
	    options: {
	        scales: {
                yAxes: [{
                	display: true,
                	type: 'logarithmic',
                    ticks: {
                    	beginAtZero:true,
                    	min:0,
                        userCallback: (value, index) => {
                            const remain = value / (Math.pow(10, Math.floor(Chart.helpers.log10(value))));
                            if (remain == 1 || remain == 2 || remain == 5 || index == 0) {
                            	return value.toLocaleString();
                            }
                            return '';
                        }
                    },
                    gridLines: {
                    	display: true
                    }
                }]
            },
	        tooltips: {
              	callbacks: {
                  	label: function(tooltipItem, data) {
                    	return numeral(tooltipItem.value).format('0,0');
                  	}
              	}
          	}
	    }
	});

}

function retrieveSellUnitData(){

	$.ajax({
		url: base_url+'dashboard/get_sell_unit_chart_data',
		type: 'post',
		data: $('#sell-unit-form').serializeArray(),
		dataType:'JSON',
		success: function (data) {

			sellUnitChart.data = data;
			sellUnitChart.update();

		}
	});

}