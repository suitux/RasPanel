<!-- Includes -->
<?php
	include_once("resources/php/system/System.class.php");

	//Number of processes to be shown in the CPU box
	$numberOfProcesses = 8;
	
	//Creating new system
	$system = new System();

	//Getting Processor
	$processor = $system->getProcessor();

	//Getting RAM
	$ram = $system->getRam();

	//Getting HDD
	$hdd = $system->getHDD();
	
?>

<link rel="stylesheet" type="text/css" href="resources/css/webparts/status.css">
<link rel="stylesheet" type="text/css" href="resources/css/lib/graphicbar.lib.css">
<link rel="stylesheet" type="text/css" href="resources/css/lib/table.lib.css">
<link rel="stylesheet" type="text/css" href="resources/css/lib/box.lib.css">
<script type="text/javascript" src="resources/javascript/scripts/webparts/status.script.js"></script>
<script type="text/javascript" src="resources/javascript/lib/box.lib.js"></script>
<script type="text/javascript" src="resources/javascript/lib/jquery.easypiechart.min.js"></script>

<!-- Content -->

<!-- Processes, HDD -->
<div class="float-left">
	<!-- Processes -->
	<div class="box height-big width-big background-color-light">
		<header class="background-red-raspberry"><span><i class="fa fa-cogs"></i><label class="text-bold">Processes</label></span></header>
		<div class="content">
			<table class="table vertical width100">
				<thead>
					<tr>
						<th class="text-left">User</th>
						<th class="text-right">PID</th>
						<th class="text-right">CPU%</th>
						<th class="text-right">Memory%</th>
						<th class="text-left">Command</th>
					<tr>
				</thead>
				<?php 
					$display = $processor->getTableOfProcesses($numberOfProcesses);

					for($i = 1; $i != $numberOfProcesses; $i++) {
						echo "<tr>";
						echo '<td class="text-left">' 	. 	$display[$i][0] 	. '</td>';
						echo '<td class="text-right">' 	. 	$display[$i][1] 	. '</td>';
						echo '<td class="text-right">' 	. 	$display[$i][2] 	. '</td>';
						echo '<td class="text-right">' 	. 	$display[$i][3] 	. '</td>';
						echo '<td class="text-left">' 	. 	$display[$i][10] 	. '</td>';
						echo "</tr>";
					}
				?>
			</table>
		</div>
	</div>

	<!-- HDD -->
	<div class="box height-medium width-big background-color-light cleared">
		<header class="background-emerald"><span><i class="fa fa-hdd-o"></i><label>HDD</label></span></header>
		<div class="content table">
			<div class="chart_container">
				<div class="divider">
					<table class="table hdd_table horizontal">
						<tr>
							<td>Total</td>
							<td><?php echo round($hdd->humanSize($hdd->getTotal())/1024, 2) ?>GB</td>
						</tr>
						<tr>
							<td>Free</td>
							<td><?php echo round($hdd->humanSize($hdd->getFree())/1024, 2) ?>GB</td>							
						</tr>
						<tr>
							<td>Used</td>
							<td><?php echo round($hdd->humanSize($hdd->getUsed())/1024, 2) ?>GB</td>
						</tr>
					</table>
				</div>
				<div class="divider">
					<div class="graphicbar background-almost-white width100">
						<div class="used background-emerald"><span>25%</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- CPU, RAM, TEMP -->
<div class="float-left">
	<!-- CPU -->
	<div class="box height-medium width-medium background-color-light">
		<header class="background-red"><span><i class="fa fa-tachometer"></i><label>CPU</label></span></header>
		<div class="content table">
			<div class="chart_container">
				<div class="chart cpu" data-percent="<?php echo $processor->getUsage(); ?>">
					<span class="percent text-red"></span>
				</div>
			</div>
		</div>
	</div>

	<!-- RAM -->
	<div class="box height-medium width-medium background-color-light">
		<header class="background-blue"><span><i class="fa fa-tasks"></i><label>RAM</label></span></header>
		<div class="content table">
			<div class="chart_container">
				<div class="divider">
					<table class="table horizontal ram_table width75">
						<tr>
							<td>Total</td>
							<td><span id="ramTotal"><?php echo $ram->getTotal(); ?></span>MB</td>
						</tr>
						<tr>
							<td>Free</td>
							<td><span id="ramFree"><?php echo $ram->getFree(); ?></span>MB</td>					
						</tr>
						<tr>
							<td>Used</td>
							<td><span id="ramUsed"><?php echo ($ram->getTotal() - $ram->getFree()); ?></span>MB</td>
						</tr>
					</table>
				</div>
				<div class="divider">
					<div class="chart ram" data-percent="<?php echo round(100 - ($ram->getFree()*100)/$ram->getTotal(), 2); ?>">
						<span class="percent text-blue"></span>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Temperature -->
	<div class="box height-medium width-medium background-color-light cleared">
		<header class="background-yellow"><span><i class="fa fa-sun-o"></i><label>Temperature</label></span></header>
		<div class="content table">
			<p class="temperature_text"><span id="tempValue"><?php echo $system->getTemp() ?></span><span class="celsius"> ºC</span></p>
		</div>
	</div>
</div>