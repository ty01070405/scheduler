@extends('common.app')

@section('content')
<link rel="stylesheet" href="css/schedule.css">
<script src="js/schedule.js"></script>
<div id="search_bar" style="width:100%;height:34px;" >
	<input type="text" class="form-control" placeholder="Filter..." />
</div>
<div id="main_div" style="width:100%; overflow-y: hidden; overflow-x: hidden;">
	<div id="left_top" class="frame_container frame_container_no_scroll" style="padding: 8px;">
			<i class="fa fa-reorder fa-lg" ></i>
			<i class="fa fa-download fa-lg" style="margin-left:15px;" ></i>
			<i class="fa fa-bell-o fa-lg" style="margin-left:15px;" ></i>
	</div>
	<div id="right_top" class="frame_container frame_container_no_scroll">
		<div id="right_top_inner_wrap" style="height:40px;"></div>
	</div>
	<div id="left_bottom" class="frame_container frame_container_no_scroll"></div>
	<div id="right_bottom" class="frame_container" style="overflow: auto;">
		<div id="right_bottom_inner_wrap"></div>
	</div>
</div>
<div class="modal" id="schedule_form" tabindex="-1" role="dialog">
	<div class="modal-dialog" style="width:96%;max-width: 800px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">{{ trans('menu.schedule') }}</h4>
			</div>
			<div class="modal-body">
				{{ csrf_field() }}
				<input type="hidden" id="schedule_id" />
				<input type="hidden" id="action" />
				<div class="row">
					<div class="col-sm-7">
						<table class='table table-borderless' width="100%">
							<tr>
								<td width="100px;">
									<label for="task_name">{{trans('menu.task')}}</label>
								</td>
								<td>
									<input type="text" class="form-control" id="task_name" />
									<input type="hidden" id="task_id" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="project_name">{{trans('menu.project')}}</label>
								</td>
								<td>
									<input type="text" class="form-control" id="project_name" />
									<input type="hidden" id="project_id" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="client_name">{{trans('menu.client')}}</label>
								</td>
								<td>
									<input type="text" class="form-control" id="client_name" />
									<input type="hidden" id="client_id" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="user_name">{{trans('menu.user')}}</label>
								</td>
								<td>
									<input type="text" class="form-control" id="user_name" />
									<input type="hidden" id="user_id" />
								</td>
							</tr>
						</table>
					</div>
					<div class="col-sm-5">
						<table class='table table-borderless' width="100%">
							<tr>
								<td width="100px;">
									<label for="start_date">{{trans('menu.start_date')}}</label>
								</td>
								<td>
									<input type="text" class="form-control" id="start_date" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="end_date">{{trans('menu.end_date')}}</label>
								</td>
								<td>
									<input type="text" class="form-control" id="end_date" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="daily_hours">{{trans('menu.daily_hours')}}</label>
								</td>
								<td>
									<input type="text" class="form-control" id="daily_hours" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="total_hours">{{trans('menu.total_hours')}}</label>
								</td>
								<td>
									<input type="text" class="form-control" id="total_hours" />
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick='sendScheduleForm();'>Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
