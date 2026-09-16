@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="mb-4">
        <div class="row">
            <div class="col-md-10 col-lg-10 col-sm-10"></div>
            <div class="col-md-2 col-lg-2 col-sm-2">
                <select class="form-control form-select select2" id="graph-data-updated">
                    <option value="all"> All </option>
                    <option value="daily"> Daily </option>
                    <option value="weekly"> Weekly </option>
                    <option value="monthly"> Monthly </option>
                </select>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
