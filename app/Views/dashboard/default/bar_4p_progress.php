<?php 
$chart_data = get_query_template_array(67); 
?>
var data_bar_4p_progress = {
    chart: {
        height: 300,
        type: 'bar',
        toolbar: {
            show: true,
            export: {
        	    csv: {
        	      	filename: "Benificiary Engagement",
        	    },
        	    svg: {
        	      	filename: "Benificiary Engagement",
        	    },
        	    png: {
        	      	filename: "Benificiary Engagement",
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
        name: 'Number of farmers',
        data: [<?php
		if(isset($chart_data) && is_array($chart_data)){
			foreach($chart_data as $key=>$val){
				echo $val['y1'];
				if(($key+1) < count($chart_data))
				{
					echo ", ";
				}
			}
		}
		?>]
    }],
    xaxis: {
        categories: [<?php
		if(isset($chart_data) && is_array($chart_data)){
			foreach($chart_data as $key=>$val){
				echo "'" . $val['x'] . "'";
				if(($key+1) < count($chart_data))
				{
					echo ", ";
				}
			}
		}
		?>],
    },
    yaxis: {
        title: {
            <!-- text: 'Number of farmers (thousands)' -->
            text: 'Number of farmers'
        }
    },
    fill: {
        opacity: 1

    },
    tooltip: {
        y: {
            formatter: function (val) {
                <!-- return val + " thousands" -->
                return val
            }
        }
    }
}

var bar_4p_progress = new ApexCharts(
    document.querySelector("#bar_4p_progress"),
    data_bar_4p_progress
);

bar_4p_progress.render();