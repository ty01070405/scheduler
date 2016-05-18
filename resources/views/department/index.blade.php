@extends('common.app')

@section('content')
<script src="js/department.js"></script>
<div id="container" class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
					{{ trans('menu.department') }}
					<div class="btn-group pull-right">
						<button id="department_add_button" class="btn btn-sm btn-primary" >{{ trans('menu.add') }}</button>
					</div>
				</div>
				@if(count($departments)>0)
				<table class="table table-striped">
					<thead>
						<tr>
							<th>{{trans('menu.name')}}</th>
							<th>{{trans('menu.num_of_staff')}}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($departments as $department)
						<tr>
							<td>{{ $department->name }}</td>
							<td><a>{{ $headcounts[$department->id] }}</a></td>
							<td align="right"><a id="{{$department->id}}" class="departmetn_edit_button">{{trans('menu.edit')}}</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@else
				<em>No department</em>
				@endif
            </div>
        </div>
    </div>
</div>
<div class="modal" id="department_form" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">{{ trans('menu.department') }}</h4>
			</div>
			<div class="modal-body">
				{{ csrf_field() }}
				<input type="hidden" id="department_id" />
				<input type="hidden" id="action" />
				<div class="form-group">
					<label for="department_name">{{trans('menu.name')}}</label>
					<input type="text" class="form-control" id="department_name" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick='sendDepartmentForm();'>Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id='error_div'></div>
@endsection
