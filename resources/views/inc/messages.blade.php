@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div style="text-align: center" class='alert alert-danger'>
            {{ $error }}
        </div>
    @endforeach
@endif

@if (session('success'))
    <div style="text-align: center" class='alert alert-success'>
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div style="text-align: center" class='alert alert-danger'>
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div class='alert alert-warning'>
        {{ session('warning') }}
    </div>
@endif

@if (session('sad'))
    <div class='alert alert-warning'>
        <span style=" font-size: 35px; display: flex; justify-content: center;">
            {{ session('sad') }}
            &#128546;
        </span>
    </div>
@endif


@section('css')
    <style>
        .required label::after{
            content: '*';
            color: red
        }
        .modal-body .required::after{
            content: '*';
            color: red
        }
        .dark-green{
            color: green
        }
        .dark-warning{
            color: rgb(219, 155, 18);
        }
        .required::after{
            content: '*';
            color: red
        }
    </style>
@stop

<!--ion icon-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

