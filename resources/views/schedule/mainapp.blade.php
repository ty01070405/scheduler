@extends('common.app')

@section('content')
<link rel="stylesheet" href="css/schedule.css">
<script src="js/schedule.js"></script>
<div id="search_bar" style="width:100%;height:34px;" >
	<input type="text" class="form-control" placeholder="Filter..." />
</div>
<div id="main_div" style="width:100%; overflow-y: hidden; overflow-x: hidden;">
	<div id="left_top" class="frame_container frame_container_no_scroll"></div>
	<div id="right_top" class="frame_container frame_container_no_scroll">
		<div id="right_top_inner_wrap" style="height:40px;"></div>
	</div>
	<div id="left_bottom" class="frame_container frame_container_no_scroll"></div>
	<div id="right_bottom" class="frame_container" style="overflow: auto;">
		<div id="right_bottom_inner_wrap"></div>
	</div>
</div>
<div class="modal" id="schedule_form" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">{{ trans('menu.schedule') }}</h4>
			</div>
			<div class="modal-body">
				{{ csrf_field() }}
				<input type="hidden" id="schedule_id" />
				<input type="hidden" id="action" />
				<div class="form-group">
					<label for="department_name">{{trans('menu.name')}}</label>
					<input type="text" class="form-control" id="department_name" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick='sendForm();'>Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
