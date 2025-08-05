<?php 
$config1 = json_decode(get_config(23),TRUE);
$chart_data = get_query_template_array(63); 
?>
var pieCtx = document.getElementById("project_status"),
pieConfig = {
	colors: [
		"#A44A3F",
		"#FFB703",
		"#023047",
		"#09814A",
		"#20A39E",
		"#885A89",
		"#667761",
	],
	series: [<?php
		if(isset($chart_data) && is_array($chart_data)){
			foreach($chart_data as $key=>$val){
				echo $val['value'];
				if(($key+1) < count($chart_data))
				{
					echo ", ";
				}
			}
		}
		?>],
	chart: {
		fontFamily: "Poppins, sans-serif",
		height: 600,
		type: "donut",
	},
	labels: [<?php
		if(isset($chart_data) && is_array($chart_data)){
			foreach($chart_data as $key=>$val){
				if(isset($config1[$val['label']]))
				{
					echo '"' . $config1[$val['label']] . '"';
				}
				if(($key+1) < count($chart_data))
				{
					echo ", ";
				}
			}
		}
		?>],
	legend: { show: false },
	responsive: [
		{
			breakpoint: 1600,
			options: {
				chart: {
					height: "auto",
				},
			},
		},
		{
			breakpoint: 400,
			options: {
				chart: {
					height: 290,
				},
			},
		},
		{
			breakpoint: 330,
			options: {
				chart: {
					height: "auto",
				},
			},
		},
	],
};
var pieChart = new ApexCharts(pieCtx, pieConfig);
pieChart.render();