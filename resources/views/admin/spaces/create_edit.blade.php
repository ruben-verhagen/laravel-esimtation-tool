@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
<!-- Tabs -->
<!-- <ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab"> {{
			trans("admin/modal.general") }}</a></li>
</ul> -->
<!-- ./ tabs -->
@if (isset($space))
    {!! Form::model($space, array('url' => url('admin/space') . '/' . $space->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
    {!! Form::open(array('url' => url('admin/space'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
	<div class="tab-content">
		<div class="tab-pane active" id="tab-general">
			<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
				{!! Form::label('name', "Name", array('class' => 'control-label')) !!}
				<div class="controls">
					{!! Form::text('name', null, array('class' => 'form-control')) !!}
					<span class="help-block">{{ $errors->first('name', ':message') }}</span>
				</div>
			</div>
			<div class="form-group {{ $errors->has('size_x') ? 'has-error' : '' }}">
				{!! Form::label('size_x', "Size X (ft)", array('class' => 'control-label')) !!}
				<div class="controls">
					{!! Form::text('size_x', null, array('class' => 'form-control')) !!}
					<span class="help-block">{{ $errors->first('size_x', ':message') }}</span>
				</div>
			</div>
			<div class="form-group  {{ $errors->has('size_y') ? 'has-error' : '' }}">
				{!! Form::label('size_y', "Size Y (ft)", array('class' => 'control-label')) !!}
				<div class="controls">
					{!! Form::text('size_y', null, array('class' => 'form-control')) !!}
					<span class="help-block">{{ $errors->first('size_y', ':message') }}</span>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			<button type="reset" class="btn btn-sm btn-warning close_popup">
				<span class="glyphicon glyphicon-ban-circle"></span> {{
				trans("admin/modal.cancel") }}
			</button>
			<button type="reset" class="btn btn-sm btn-default">
				<span class="glyphicon glyphicon-remove-circle"></span> {{
				trans("admin/modal.reset") }}
			</button>
			<button type="submit" class="btn btn-sm btn-success">
				<span class="glyphicon glyphicon-ok-circle"></span>
				@if (isset($space))
				    {{ trans("admin/modal.edit") }}
				@else
				    {{trans("admin/modal.create") }}
			     @endif
			</button>
		</div>
	</div>
{!! Form::close() !!}
@endsection
