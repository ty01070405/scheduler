$(document).ready(function () {
	resizeWindow();
	$('#right_bottom').scroll(function () {
		$('#right_top').scrollLeft($('#right_bottom').scrollLeft());
		$('#left_bottom').scrollTop($('#right_bottom').scrollTop());
	});
	$(window).resize(function () {
		resizeWindow();
	})
	initialSchedule();
	
});

var default_schedule_width = 100;
var default_schedule_height = 100;
var grid_height = 10;
var schedules = {};
var row_num_grid = {};
var grid_taken = {};
var schedule_from_date = null;

function registerScheduleDragAndDrop() {
	$(".schedule").draggable({
		containment: '#right_bottom_inner_wrap',
		scroll: true,
		stack: ".schedule",
		zIndex: 100,
		cursorAt: {left: 10}
	});
	$(".schedule").resizable({
		handles: 'w, e',
		containment: '#right_bottom_inner_wrap',
		scroll: true,
		grid: [100, 0],
		distance: 5,
		stop: function (event, ui) {
			//alert($(ui.element).data("ui-resizable").axis);
			this_num_days = Math.ceil($(ui.element).width() / default_schedule_width);
			$(ui.element).attr('data-sch-num-days', this_num_days);
			drawSchedule();
		}
	});
	$('.schedule_box').droppable({
		accept: ".schedule",
		tolerance: "pointer",
		hoverClass: "schedule_box_over",
		drop: function (event, ui) {
			new_date_string = getStandardFormatDate(new Date($(this).attr('data-sch-date')));
			new_user_id = $(this).attr('data-sch-user-id');
			old_date_string = $(ui.draggable).attr('data-sch-date-from');
			old_user_id = $(ui.draggable).attr('data-sch-user-id');
			if (new_date_string != old_date_string || new_user_id != old_user_id) {
				schedule_id = $(ui.draggable).attr('data-sch-schedule-id');
				if (!(new_date_string in schedules[new_user_id])) {
					schedules[new_user_id][new_date_string] = {};
				}
				$(ui.draggable).attr('data-sch-date-from', new_date_string);
				$(ui.draggable).attr('data-sch-user-id', new_user_id);
				schedules[new_user_id][new_date_string][schedule_id] = schedules[old_user_id][old_date_string][schedule_id];
				delete schedules[old_user_id][old_date_string][schedule_id];
			}
			drawSchedule();
		}
	});
	$('.schedule_box').click(function(){
		openScheduleForm();
	});
	$('.schedule').click(function(){
		openScheduleForm();
	});
}

function resizeWindow() {
	//Set height first so the width will not include scrollbar
	var window_height = $(window).height();
	$('#main_div').height(window_height - 89);
	var main_div_height = $('#main_div').height();
	$('#left_top').css('height', 40);
	$('#right_top').css('height', 40);
	$('#left_bottom').css('height', main_div_height - 40);
	$('#right_bottom').css('height', main_div_height - 40);

	var window_width = $(window).width();
	$('#left_top').css('width', 200);
	$('#right_top').css('width', window_width - 200);
	$('#left_bottom').css('width', 200);
	$('#right_bottom').css('width', window_width - 200);
}

function initialSchedule() {
	var from_date = new Date('2016-04-01');
	var date_list = [from_date];
	for (i = 1; i < 30; i++) {
		from_date = new Date(from_date.getTime() + 86400000);
		date_list.push(from_date);
	}
	$.ajax({
		url: 'api/scheduleList',
		type: "get",
		data: {},
		success: function (data) {
			loadSchedule(date_list, data);
		}
	})
}

function loadSchedule(date_list, schedule_data) {
	//Calculate width of right boxes
	$('#right_top_inner_wrap').css('width', date_list.length * default_schedule_width + 100);
	$('#right_bottom_inner_wrap').css('width', date_list.length * default_schedule_width);
	schedules = {};
	date_list.forEach(function (item, index) {
		if (!schedule_from_date) {
			schedule_from_date = item;
		}
		$('#right_top_inner_wrap').append("<div class='date_header'>" + getStandardFormatDate(item) + "</div>");
	});
	$.each(schedule_data, function (index, item) {
		schedules[index] = {};
		date_list.forEach(function (date, date_index) {
			schedules[index][getStandardFormatDate(date)] = {};
		});
	});
	$.each(schedule_data, function (index, item) {
		$('#left_bottom').append("<div id='user_list_" + item.user.id + "' class='user_list'>" + item.user.name + "</div>");
		$('#right_bottom_inner_wrap').append("<div id='user_schedule_row_" + item.user.id + "' style='width:" + (date_list.length * default_schedule_width) + "px;height:" + default_schedule_height + "px' class='schedule_row'></div>");
		date_list.forEach(function (date_item, date_index) {
			standard_date_format = getStandardFormatDate(date_item);
			$('#user_schedule_row_' + item.user.id).append("<div data-sch-user-id='" + item.user.id + "' data-sch-date='" + standard_date_format + "' class='schedule_box schedule_row_" + item.user.id + "'></div>");
		});
		if (item.schedule.constructor.name === 'Object') {
			$.each(item.schedule, function (date, value) {
				schedules[index][date] = value;
			});
		}
	});
	$('#left_bottom').append("<div class='user_list_bottom'></div>");
	$.each(schedules, function (user_id, schedule_data) {
		if (schedule_data) {
			$.each(schedule_data, function (schedule_date, schedule_day_items) {
				if (schedule_day_items) {
					$.each(schedule_day_items, function (schedule_id, schedule_item) {
						temp_num_grid = Math.ceil(schedule_item.daily_hours);
						temp_num_days = schedule_item.num_working_days + schedule_item.num_non_working_days;
						temp_height = temp_num_grid * grid_height - 2;
						temp_width = temp_num_days * default_schedule_width - 6;
						$temp_schedule_div = $("<div class='schedule' style='width:" + temp_width + "px;height:" + temp_height + "px;background-color: " + '#' + ("000000" + Math.random().toString(16).slice(2, 8).toUpperCase()).slice(-6) + ";'></div>");
						$temp_schedule_div.attr('data-sch-num-grids', temp_num_grid);
						$temp_schedule_div.attr('data-sch-num-days', temp_num_days);
						$temp_schedule_div.attr('data-sch-date-from', schedule_date);
						$temp_schedule_div.attr('data-sch-user-id', user_id);
						$temp_schedule_div.attr('data-sch-schedule-id', schedule_item.id);
						schedules[user_id][schedule_date][schedule_id]['div'] = $temp_schedule_div;
					});
				}
			});
		}
	});
	drawSchedule();
	registerScheduleDragAndDrop();
}

function drawSchedule() {
	grid_taken = {};
	row_num_grid = {};
	$.each(schedules, function (user_id, schedule_data) {
		if (schedule_data) {
			$.each(schedule_data, function (schedule_date, schedule_day_items) {
				if (schedule_day_items) {
					$.each(schedule_day_items, function (schedule_id, schedule_item) {
						addScheduleToBox(schedule_item['div']);
					});
				}
			});
		}
	});
	$.each(row_num_grid, function (user_id, num_grid) {
		this_height = (num_grid + 2) * grid_height;
		if (this_height > default_schedule_height) {
			changeRowHeight(user_id, this_height);
		}
	});
}

function changeRowHeight(user_id, height) {
	$("#user_schedule_row_" + user_id).css('height', height);
	$(".schedule_row_" + user_id).css('height', height);
	$("#user_list_" + user_id).css('height', height);
}

function addScheduleToBox($schedule) {
	user_id = $schedule.attr('data-sch-user-id');
	date = $schedule.attr('data-sch-date-from');
	start_grid = getStartGrid($schedule.attr('data-sch-num-grids'), user_id, date);
	setGridTaken(start_grid, $schedule.attr('data-sch-num-grids'), $schedule.attr('data-sch-num-days'), user_id, date);
	this_top = (start_grid - 1) * grid_height + 1;
	$schedule.css('top', this_top);
	this_date = new Date(date);
	this_left = Math.round(Math.abs((this_date.getTime() - schedule_from_date.getTime()) / 86400000)) * default_schedule_width + 1;
	$schedule.css('left', this_left);
	$schedule.appendTo($("#user_schedule_row_" + user_id));
}

function getStartGrid(num_of_grids, user_id, date) {
	start_grid = 1;
	if (user_id in grid_taken) {
		if (date in grid_taken[user_id]) {
			var prev_item = 0;
			grid_taken[user_id][date].forEach(function (item, index) {
				if ((item - prev_item) > num_of_grids) {
					start_grid = prev_item + 1;
					return start_grid;
				} else {
					prev_item = item;
				}
			});
			start_grid = prev_item + 1;
		}
	}
	return start_grid;
}

function setGridTaken(start_grid, num_of_grids, num_of_days, user_id, date) {
	temp_date = new Date(date);
	for (i = 1; i <= num_of_days; i++) {
		date_string = getStandardFormatDate(temp_date);
		if (user_id in grid_taken) {
			if (date_string in grid_taken[user_id]) {

			} else {
				grid_taken[user_id][date_string] = [];
			}
		} else {
			grid_taken[user_id] = [];
			grid_taken[user_id][date_string] = [];
		}
		temp_date = new Date(temp_date.getTime() + 86400000);
	}
	temp_date = new Date(date);
	for (i = 1; i <= num_of_days; i++) {
		date_string = getStandardFormatDate(temp_date);
		temp_start_grid = start_grid;
		for (j = 1; j <= num_of_grids; j++) {
			grid_taken[user_id][date_string].push(temp_start_grid);
			temp_start_grid += 1;
		}
		if (!(user_id in row_num_grid)) {
			row_num_grid[user_id] = 0;
		}
		if (row_num_grid[user_id] < (temp_start_grid - 1)) {
			row_num_grid[user_id] = temp_start_grid - 1;
		}
		grid_taken[user_id][date_string].sort(function (a, b) {
			return a - b
		});
		temp_date = new Date(temp_date.getTime() + 86400000);
	}
}

function openScheduleForm(){
	$("#schedule_form").modal("show");
}