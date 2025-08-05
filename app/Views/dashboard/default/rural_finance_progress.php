<?php 
$loan_data = get_query_template_array(68);
$grant_data = get_query_template_array(109); 

// reverse the array
// if(isset($loan_data) && is_array($loan_data)){
//     $loan_data = array_reverse($loan_data);
// }

// if(isset($grant_data) && is_array($grant_data)){
//     $grant_data = array_reverse($grant_data);
// }

?>
var data_rural_finance_progress = {
    chart: {
        height: 300,
        type: 'bar',
        toolbar: {
            show: true,
            export: {
        	    csv: {
        	      	filename: "Loan vs Grant Disbursement (Last 12 Months)",
        	    },
        	    svg: {
        	      	filename: "Loan vs Grant Disbursement (Last 12 Months)",
        	    },
        	    png: {
        	      	filename: "Loan vs Grant Disbursement (Last 12 Months)",
        	    }
        	},
        }
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '70%',
            borderRadius: 6
        },
    },
    colors: ["#A44A3F", "#FFB703", "#023047", "#09814A"],
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    series: [{
        name: 'Loan amount',
        data: [<?php
		if(isset($loan_data) && is_array($loan_data)){
			foreach($loan_data as $key=>$val){
				echo $val['y1'];
				if(($key+1) < count($loan_data))
				{
					echo ", ";
				}
			}
		}
		?>]
    },
    {
        name: 'Grant amount',
        data: [<?php
		if(isset($grant_data) && is_array($grant_data)){
			foreach($grant_data as $key=>$val){
				echo $val['y1'];
				if(($key+1) < count($grant_data))
				{
					echo ", ";
				}
			}
		}
		?>]
    }],
    xaxis: {
        categories: [<?php
		if(isset($loan_data) && is_array($loan_data)){
			foreach($loan_data as $key=>$val){
				echo "'" . $val['x'] . "'";
				if(($key+1) < count($loan_data))
				{
					echo ", ";
				}
			}
		} elseif (isset($grant_data) && is_array($grant_data)){
            foreach($grant_data as $key=>$val){
				echo "'" . $val['x'] . "'";
				if(($key+1) < count($grant_data))
				{
					echo ", ";
				}
			}
        }
		?>],
    },
    yaxis: {
        title: {
            text: 'Rs. (millions)'
        }
    },
    fill: {
        opacity: 1

    },
    tooltip: {
        y: {
            formatter: function (val) {
                return "Rs. " + val + " millions"
            }
        }
    }
}

var bar_rural_finance_progress = new ApexCharts(
    document.querySelector("#rural_finance_progress"),
    data_rural_finance_progress
);

bar_rural_finance_progress.render();