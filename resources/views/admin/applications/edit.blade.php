@extends('adminlte::page')

@section('title', 'Edit Applications')

@section('content_header')
    @include('inc.messages')
    <h1>Edit Application</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 card rouned-0">
                <div class="card-header">
                    {{ $application->name }} Application
                </div>
                <div class="card-body">
                    <form action="{{ url("applications/$application->id") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="required">Name</label>
                            <input type="text" name="name" id="name" value="{{ $application->name }}"
                                class="form-control rounded-0" required>
                        </div>
                        <div class="form-group">
                            <label for="lname" class="required">Last Name</label>
                            <input type="text" name="lname" id="lname" value="{{ $application->lname }}"
                                class="form-control rounded-0" required>
                        </div>
                        <div class="form-group">
                            <label for="cv" class="required">
                                CV 
                                @if ($application->cv != null)
                                    <a href="{{ url(Storage::url("$application->cv")) }}" target="_blank">(link)</a>
                                @endif 
                            </label>
                            <input type="file" name="cv" id="cv" accept=".pdf"
                                class="form-control rounded-0">
                        </div>
                        <div class="d-flex justify-content-end pt-2 pb-2">
                            <button class="btn btn-warning rounded-0" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop

@section('js')

@stop

@section('css')

@stop
