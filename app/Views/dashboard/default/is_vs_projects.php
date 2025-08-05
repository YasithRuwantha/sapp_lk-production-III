<?php 
$chart_data = get_query_template_array(46); 
?>
var data_is_vs_projects = {
    chart: {
        height: 310,
        type: 'bar',
        toolbar: {
          show: false,
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
        name: 'IS Programs',
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
            text: 'Number of beneficiary'
        }
    },
    fill: {
        opacity: 1

    },
    tooltip: {
        y: {
            formatter: function (val) {
                return val
            }
        }
    }
}

var bar_is_vs_projects = new ApexCharts(
    document.querySelector("#is_vs_projects"),
    data_is_vs_projects
);

bar_is_vs_projects.render();