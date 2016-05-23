<!-- Includes -->
<link rel="stylesheet" type="text/css" href="resources/css/webparts/home.css">
<link rel="stylesheet" type="text/css" href="resources/css/lib/table.lib.css">
<link rel="stylesheet" type="text/css" href="resources/css/lib/box.lib.css">
<script type="text/javascript" src="resources/javascript/scripts/webparts/home.script.js"></script>
<script type="text/javascript" src="resources/javascript/lib/box.lib.js"></script>

<!-- Content -->
<div id="info" class="box height-big width-big background-color-light">
	<header class="background-green"><span><i class="fa fa-info-circle"></i><label>Information</label></span></header>
	<div class="content">
		<table class="table horizontal width100 ">
			<tr>
				<td>System Name</td>
				<td><?php echo posix_uname()['sysname']; ?></td> 
			</tr>
			<tr>
				<td>Raspberry Name</td>
				<td><?php echo posix_uname()['nodename']; ?></td>
			</tr>
			<tr>
				<td>Release</td>
				<td><?php echo posix_uname()['release']; ?></td> 
			</tr>
			<tr>
				<td>Version</td>
				<td><?php echo posix_uname()['version']; ?></td> 
			</tr>
			<tr>
				<td>Processor type</td>
				<td><?php echo posix_uname()['machine']; ?></td> 
			</tr>
		</table>
	</div>
</div>