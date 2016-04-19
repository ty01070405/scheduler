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
var row_num_grid = [];
var grid_taken = [];

function registerScheduleDragAndDrop() {
	$(".schedule").draggable({
		scroll: true,
		//snap: ".schedule_box",
		//snapMode: "inner",
		//grid: [ 100, 1 ],
		cursorAt: {left: 10}
	});
	$(".schedule").resizable({
		handles: 'e',
		grid: [100, 0],
	});
	$('.schedule_box').droppable({
		accept: ".schedule",
		tolerance: "pointer",
		hoverClass: "schedule_box_over",
		drop: function (event, ui) {
			//$(this).css('background-color','yellow');
			$(this).append(ui.draggable);
			$(ui.draggable).css('left', '1px');
			$(ui.draggable).css('top', '0px');
		}
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
		from_date = new Date(from_date.getTime() + (24 * 60 * 60 * 1000));
		date_list.push(from_date);
	}
	$.ajax({
		url: 'api/schedule',
		type: "get",
		data: {},
		success: function (data) {
			//console.log(data);
			loadSchedule(date_list, data);
		}
	})
}

function loadSchedule(date_list, schedule_data) {

	//Calculate width of right boxes
	$('#right_top_inner_wrap').css('width', date_list.length * default_schedule_width + 100);
	date_list.forEach(function (item, index) {
		$('#right_top_inner_wrap').append("<div class='date_header'>" + item.toDateString() + "</div>");
	});

	schedule_data.forEach(function (item, index) {
		$('#left_bottom').append("<div id='user_list_" + item.user.id + "' class='user_list'>" + item.user.name + "</div>");
		$('#right_bottom').append("<div id='user_schedule_row_" + item.user.id + "' style='width:" + (date_list.length * default_schedule_width) + "px;height:" + default_schedule_height + "px'></div>");
		date_list.forEach(function (date_item, date_index) {
			$('#user_schedule_row_' + item.user.id).append("<div id='user_schedule_" + item.user.id + "_" + date_item.getFullYear() + "_" + (date_item.getMonth() + 1) + "_" + date_item.getDate() + "' class='schedule_box schedule_row_" + item.user.id + "'></div>");
		});
		item.schedule.forEach(function (schedule_item, schedule_index) {
			var temp_date = new Date(schedule_item.start_date);
			var temp_height = schedule_item.daily_hours * 10;
			var temp_width = (schedule_item.num_working_days + schedule_item.num_non_working_days) * default_schedule_width - 6;
			$temp_schedule_div = $("<div class='schedule' style='width:" + temp_width + "px;height:" + temp_height + "px;background-color: lightgrey;'></div>");
			addScheduleToBox(item.user.id, temp_date, $temp_schedule_div);
		});
	});

	registerScheduleDragAndDrop();

	//changeRowHeight(1, 150);
}

function changeRowHeight(user_id, height) {
	$("#user_schedule_row_" + user_id).css('height', height);
	$(".schedule_row_" + user_id).css('height', height);
	$("#user_list_" + user_id).css('height', height);
}

function addScheduleToBox(user_id, date, $schedule){
	$("#user_schedule_" + user_id + "_" + date.getFullYear() + "_" + (date.getMonth() + 1) + "_" + date.getDate()).append($schedule);
	$schedule.css('left', '1px');
	this_height = $schedule.css('height');
	
	start_top = 0;
	if(user_id in grid_taken){
		grid_taken.forEach(function (item, index){
			
		});
	}else{
		this_top = 1;
	}
	$schedule.css('top', this_top+'px');
}