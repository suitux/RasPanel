$(document).ready(function(){
	$('.cpu').easyPieChart({
		barColor:		'#E77755', 
		trackColor: 	'#F0F0F0',
		scaleColor: 	'#E77755',
		scaleLength: 	0,
		lineCap: 		'square', 
		lineWidth: 		4, 
		size: 			150,
		animate: ({
			duration: 1000, 
			enabled: true
		}), 
		onStep: function(from, to, percent) {
			if($(this.el).find('.percent').text(Math.round(percent)) >= 100)
				$(this.el).find('.percent').text(100 + "%");
			else
				$(this.el).find('.percent').text(Math.round(percent) + '%');
		} 
	});

	$('.ram').easyPieChart({
		barColor:		'#60AAE9',
		trackColor: 	'#F0F0F0',
		scaleColor: 	'#60AAE9',
		scaleLength: 	0,
		lineCap: 		'square', 
		lineWidth: 		4, 
		size: 			150,
		animate: ({
			duration: 1000, 
			enabled: true
		}), 
		onStep: function(from, to, percent) {
			$(this.el).find('.percent').text(Math.round(percent) + '%');
		}
	});


	//The interval defined to get all the information of the RPi and fill the status panel
	setInterval(function() {
		getSysInfo();
	}, 2000);

});


/**
* Gets the System information
* @return Returns the Json with the system information
*/
function getSysInfo() {
	return $.getJSON("/resources/php/system/System.class.php?info=system", function(data) {
				updateGraphics(data);
			})
			.fail(function() {
				console.error("Error retrieving system info")
			});
}

/**
 * Updates the graphics using easyPieChart API
 * @param  {Json String} json Contains the System info
 */
function updateGraphics(json) {
	//Update CPU information
	$('.cpu').data('easyPieChart').update(json.processor.usage);

	//Update RAM information
		//Free RAM
	$('#ramFree').text(json.ram.free)
		//Used RAM
	$('#ramUsed').text(parseInt(json.ram.total) - parseInt(json.ram.free))
		//Update RAM graphic
	$('.ram').data('easyPieChart').update(100 - (parseInt(json.ram.free)*100)/parseInt(json.ram.total))

	//round(($ram->getFree()*100)/$ram->getTotal(), 2)

	//Update Temperature information
	$('#tempValue').text(json.temp)
}