var spinner = '';

function getStandardFormatDate(date) {
	return date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
}

function getReadableFormatDate(date) {
	return date.getDate() + ' / ' + months[date.getMonth()];
}

function showSpinner(target_id) {
	if (typeof target_id === 'undefined') {
		target_id = 'container';
	}
	if (spinner === '') {
		var spinner_opts = {
			lines: 13 // The number of lines to draw
			, length: 0 // The length of each line
			, width: 13 // The line thickness
			, radius: 30 // The radius of the inner circle
			, scale: 1 // Scales overall size of the spinner
			, corners: 1 // Corner roundness (0..1)
			, color: '#000' // #rgb or #rrggbb or array of colors
			, opacity: 0.1 // Opacity of the lines
			, rotate: 0 // The rotation offset
			, direction: 1 // 1: clockwise, -1: counterclockwise
			, speed: 1 // Rounds per second
			, trail: 32 // Afterglow percentage
			, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
			, zIndex: 2e9 // The z-index (defaults to 2000000000)
			, className: 'spinner' // The CSS class to assign to the spinner
			, top: '50%' // Top position relative to parent
			, left: '50%' // Left position relative to parent
			, shadow: false // Whether to render a shadow
			, hwaccel: false // Whether to use hardware acceleration
			, position: 'absolute' // Element positioning
		}
		spinner = new Spinner(spinner_opts);
	}
	spinner.spin(document.getElementById(target_id));
}

function hideSpinner() {
	if (spinner !== '') {
		spinner.stop();
	}
}