@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
<!-- Tabs -->
<!-- <ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab"> {{
			trans("admin/modal.general") }}</a></li>
</ul> -->
<!-- ./ tabs -->
@if (isset($item))
    {!! Form::model($item, array('url' => url('admin/item') . '/' . $item->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
    {!! Form::open(array('url' => url('admin/item'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
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
      <div class="form-group  {{ $errors->has('type') ? 'has-error' : '' }}">
          {!! Form::label('language_id', "Type", array('class' => 'control-label')) !!}
          <div class="controls">
              {!! Form::select('type', $item_types, @isset($item)? $item->type : 'Labor', array('class' => 'form-control')) !!}
              <span class="help-block">{{ $errors->first('type', ':message') }}</span>
          </div>
      </div>
      <div class="form-group {{ $errors->has('cost') ? 'has-error' : '' }}">
				{!! Form::label('cost', "Cost", array('class' => 'control-label')) !!}
				<div class="controls">
					{!! Form::text('cost', null, array('class' => 'form-control')) !!}
					<span class="help-block">{{ $errors->first('cost', ':message') }}</span>
				</div>
			</div>
      <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
				{!! Form::label('price', "Price", array('class' => 'control-label')) !!}
				<div class="controls">
					{!! Form::text('price', null, array('class' => 'form-control')) !!}
					<span class="help-block">{{ $errors->first('price', ':message') }}</span>
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
				@if (isset($item))
				    {{ trans("admin/modal.edit") }}
				@else
				    {{trans("admin/modal.create") }}
			     @endif
			</button>
		</div>
	</div>
{!! Form::close() !!}
@endsection
