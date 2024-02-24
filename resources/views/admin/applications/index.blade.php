@extends('adminlte::page')

@section('title', 'Applications')

@section('content_header')
    <h1>Applications</h1>
@stop

@section('content')
    <div class="container-fluid">
        <!--Search Data-->
        <div class="row">
            <div class="col-md-12">
                <form action="{{ url('applications') }}" class="form-inline bg-white shadow border p-2" method="GET">
                    <div class="form-group">
                        <label for="id">ID:</label>
                        <input class="form-control mx-2" type="number" id="id" name="id" min="1"
                            placeholder="ID">
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input class="form-control mx-2" type="text" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input class="form-control mx-2" type="text" id="lname" name="lname"
                            placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success rounded-0">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <!--/Search Data-->

        <!--Application Data Table -->
        <div class=" table-responsive  bg-white shadow border mt-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">CV</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($applications->count() > 0)
                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $application->id }}</td>
                                <td>{{ $application->name }}</td>
                                <td>{{ $application->lname }}</td>
                                <td>
                                    <a href="{{ url(Storage::url("$application->cv")) }}" target="_blank">(Link)</a>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ url("applications/$application->id/edit") }}"
                                            class="btn btn-warning rounded-0 mr-1">Edit
                                        </a>
                                        <form action="{{ route('applications.destroy', $application->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger rounded-0">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="5" class="text-center">No Applications Found</td>
                    @endif

                </tbody>
            </table>
        </div>
        <!--/Application Data Table -->

    </div>

@stop

@section('js')

@stop

@section('css')

@stop
