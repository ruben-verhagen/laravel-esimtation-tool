@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') Spaces ::
@parent @endsection

@section('styles')
    @parent
    <link href="{{ asset("css/flags.css") }}" rel="stylesheet">
@endsection

{{-- Content --}}
@section('main')
    <div class="page-header">
        <h3>
            Spaces

            <div class="pull-right">
                <a href="{!!  url('admin/space/create') !!}"
                   class="btn btn-sm  btn-primary iframe"><span
                            class="glyphicon glyphicon-plus-sign"></span> {!! trans("admin/modal.new") !!}</a>
            </div>
        </h3>
    </div>

    <table id="table" class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Size X</th>
            <th>Size Y</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

{{-- Scripts --}}
@section('scripts')
@endsection
