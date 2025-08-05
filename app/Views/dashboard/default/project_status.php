<?php 
$config1 = json_decode(get_config(19),TRUE);
$chart_data = get_query_template_array(30); 
?>
var pieCtx = document.getElementById("project_status"),
pieConfig = {
	/* colors: [
		"#A44A3F",
		"#FFB703",
		"#023047",
		"#667761",
		"#09814A",
		"#20A39E",
		"#885A89",
	], */
	colors: [
		<?php
		if(isset($chart_data) && is_array($chart_data)){
			foreach($chart_data as $key=>$val){
				if($config1[$val['label']] == "Completed"){
					echo '"#FFB703",';
				} elseif ($config1[$val['label']] == "Suspended"){
					echo '"#A44A3F",';
				} elseif ($config1[$val['label']] == "Ongoing"){
					echo '"#023047",';
				} else {
					echo '"#667761",';
				}
			}
		}
		?>
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
		height: 400,
		type: "donut",
		toolbar: {
        					show: true,
        					offsetX: 0,
        					offsetY: 0,
        					tools: {
        					  	download: true,
        					},
        					export: {
        					  	csv: {
        					  	  	filename: "4P Project Status",
        					  	  	columnDelimiter: ',',
        					  	  	headerCategory: 'category',
        					  	  	headerValue: 'value',
        					  	  	dateFormatter(timestamp) {
        					  	  	  return new Date(timestamp).toDateString()
        					  	  	}
        					  	},
        					  	svg: {
        					  	  	filename: "4P Project Status",
        					  	},
        					  	png: {
        					  	  	filename: "4P Project Status",
										
        					  	}
        					},
        					autoSelected: 'zoom' 
      					},
						
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
	legend: { 
						show: true ,
						position: 'bottom',
						fontSize:  '10px'
					},
					title: {
      					text: "Total : <?php 
							if(isset($chart_data) && is_array($chart_data)){
								$total = 0;
								foreach($chart_data as $key=>$val){
									$total += $val['value'];
								}
								echo $total;
							} ?>",
      					align: 'center',
      					offsetX: 0,
      					offsetY: 0,
      					floating: false,
      					style: {
      					  	fontSize:  '14px',
      					  	fontWeight:  'bold',
      					  	color:  '#9699a2'
      					},
  					},
	responsive: [
		{
			breakpoint: 1600,
			options: {
				chart: {
					height: 300,
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