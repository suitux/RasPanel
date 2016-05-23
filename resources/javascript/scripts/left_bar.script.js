$(document).ready(function() {

	$('#left_bar ul li').click(function() {
		
		switch($(this).attr('id')) {
			case 'home':
			break;
			case 'status': 
			break;
			case 'files': 
				alert("files");
			break;
			case 'shell': 
				alert("shell");
			break;
			case 'configuration': 
				alert("configuration");
			break;
			case 'signout':
				if(confirm("Do you really wanna sign out?"))
					window.location.href="resources/php/scripts/logout.script.php";
			break;
			case 'restart': 
				confirm("Do you really want to restart?");
			break;
			case 'shutdown': 
				confirm("Do you really want to shutdown?");
			break;

			default: 
				alert("Unknown button. Please, contact to the administrator.");
			break;
		}
	});

});