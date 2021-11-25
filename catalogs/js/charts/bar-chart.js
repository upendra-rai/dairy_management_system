function bar(){
 "use strict";
	 /*----------------------------------------*/
	/*  1.  Bar Chart
	/*----------------------------------------*/

	
	
	/*----------------------------------------*/
	/*  4.  Bar Chart Multi axis
	/*----------------------------------------*/
	var ctx = document.getElementById("barchart4");
    
    var tr_jan = $('input[id=transaction_input01]').val();
    if(tr_jan === undefined){
        tr_jan = 0;
    }
    var tr_feb = $('input[id=transaction_input02]').val();
    if(tr_feb === undefined){
        tr_feb = 0;
    }
    var tr_mar = $('input[id=transaction_input03]').val();
    if(tr_mar === undefined){
        tr_mar = 0;
    }
    var tr_apr = $('input[id=transaction_input04]').val();
    if(tr_apr === undefined){
        tr_apr = 0;
    }
    var tr_may = $('input[id=transaction_input05]').val();
    if(tr_may === undefined){
        tr_may = 0;
    }
    var tr_jun = $('input[id=transaction_input06]').val();
    if(tr_jun === undefined){
        tr_jun = 0;
    }
    var tr_jul = $('input[id=transaction_input07]').val();
    if(tr_jul === undefined){
        tr_jul = 0;
    }
    var tr_aug = $('input[id=transaction_input08]').val();
    if(tr_aug === undefined){
        tr_aug = 0;
    }
    var tr_sep = $('input[id=transaction_input09]').val();
    if(tr_sep === undefined){
        tr_sep = 0;
    }
    var tr_oct = $('input[id=transaction_input10]').val();
    if(tr_oct === undefined){
        tr_oct = 0;
    }
    var tr_nov = $('input[id=transaction_input11]').val();
    if(tr_nov === undefined){
        tr_nov = 0;
    }
    var tr_dec = $('input[id=transaction_input12]').val();
    if(tr_dec === undefined){
        tr_dec = 0;
    }
	var barchart4 = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug","Sep","Oct","Nov","Dec"],
			datasets: [{
                label: 'Sales',
				data: [tr_jan, tr_feb, tr_mar, tr_apr, tr_may, tr_jun, tr_jul,tr_aug,tr_sep,tr_oct,tr_nov,tr_dec],
				borderWidth: 1,
				yAxisID: "y-axis-1",
                backgroundColor: [
                    
					'#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                   
                    
				],
				borderColor: [
					'#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
                    '#9c27b0',
				],
            }]
		},
		options: {
            
			responsive: true,
            
			title:{
				display:false,
				text:"Bar Chart Multi Axis"
			},
			tooltips: {
				mode: 'index',
				intersect: true
			},
			scales: {
				yAxes: [{
					type: "linear",
					display: true,
					position: "left",
					id: "y-axis-1",
				}, {
					type: "linear",
					display: false,
					position: "right",
					id: "y-axis-2",
					gridLines: {
						drawOnChartArea: false
					}
				}],
			}
		}
	});
	
	
	var ctx = document.getElementById("barchart44");
    
    var re_jan = $('input[id=recharge_input01]').val();
    if(re_jan === undefined){
        re_jan = 0;
    }
    var re_feb = $('input[id=recharge_input02]').val();
    if(re_feb === undefined){
        re_feb = 0;
    }
    var re_mar = $('input[id=recharge_input03]').val();
    if(re_mar === undefined){
        re_mar = 0;
    }
    var re_apr = $('input[id=recharge_input04]').val();
    if(re_apr === undefined){
        re_apr = 0;
    }
    var re_may = $('input[id=recharge_input05]').val();
    if(re_may === undefined){
        re_may = 0;
    }
    var re_jun = $('input[id=recharge_input06]').val();
    if(re_jun === undefined){
        re_jun = 0;
    }
    var re_jul = $('input[id=recharge_input07]').val();
    if(re_jul === undefined){
        re_jul = 0;
    }
    var re_aug = $('input[id=recharge_input08]').val();
    if(re_aug === undefined){
        re_aug = 0;
    }
    var re_sep = $('input[id=recharge_input09]').val();
    if(re_sep === undefined){
        re_sep = 0;
    }
    var re_oct = $('input[id=recharge_input10]').val();
    if(re_oct === undefined){
        re_oct = 0;
    }
    var re_nov = $('input[id=recharge_input11]').val();
    if(re_nov === undefined){
        re_nov = 0;
    }
    var re_dec = $('input[id=recharge_input12]').val();
    if(re_dec === undefined){
        re_dec = 0;
    }
	var barchart44 = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug","Sep","Oct","Nov","Dec"],
			datasets: [{
                label: 'Recharges',
				data: [re_jan, re_feb, re_mar, re_apr, re_may, re_jun, re_jul,re_aug,re_sep,re_oct,re_nov,re_dec],
				borderWidth: 1,
				yAxisID: "y-axis-1",
                backgroundColor: [
					'#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    
                    
				],
				borderColor: [
					'#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
                    '#03a9f4',
				],
            }]
		},
		options: {
            
			responsive: true,
			title:{
				display:false,
				text:"Bar Chart Multi Axis"
			},
			tooltips: {
				mode: 'index',
				intersect: true
			},
			scales: {
				yAxes: [{
					type: "linear",
					display: true,
					position: "left",
					id: "y-axis-1",
				}, {
					type: "linear",
					display: false,
					position: "right",
					id: "y-axis-2",
					gridLines: {
						drawOnChartArea: false
					}
				}],
			}
		}
	});
	
		
		
};
bar();