$(document).ready(function () {
	$("#department_add_button").click(function () {
		openDepartmentForm('', '');
	});

	$(".departmetn_edit_button").click(function () {
		getDepartment($(this).attr('id'));
	});
});

function getDepartment(department_id) {
	$.ajax({
		url: 'api/department',
		type: "get",
		data: {'id': department_id, '_token': $('input[name=_token]').val()},
		success: function (data) {
			openDepartmentForm(data.id, data.name);
		}
	})
}

function openDepartmentForm(id, name) {
	if (id == '') {
		$('#department_id').val('');
		$('#department_name').val('');
		$('#action').val('create');
	} else {
		$('#department_id').val(id);
		$('#department_name').val(name);
		$('#action').val('update');
	}
	$("#department_form").modal("show");
}

function sendDepartmentForm() {
	$.ajax({
		url: 'api/department',
		type: "post",
		data: {'id': $('#department_id').val(), 'name': $('#department_name').val(), 'action': $('#action').val(), '_token': $('input[name=_token]').val()},
		success: function (data) {
			location.reload();
		}
	})
}