<?php 
$chart_data = get_query_template_array(61); 
?>
var data_benifited_through = {
    chart: {
        height: 200,
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
        name: 'Male',
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
    }, {
        name: 'Female',
        data: [<?php
		if(isset($chart_data) && is_array($chart_data)){
			foreach($chart_data as $key=>$val){
				echo $val['y2'];
				if(($key+1) < count($chart_data))
				{
					echo ", ";
				}
			}
		}
		?>]
    }, {
        name: 'Gender Not Specified',
        data: [<?php
		if(isset($chart_data) && is_array($chart_data)){
			foreach($chart_data as $key=>$val){
				echo $val['y3'];
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

var bar_benifited_through = new ApexCharts(
    document.querySelector("#benifited_through"),
    data_benifited_through
);

bar_benifited_through.render();