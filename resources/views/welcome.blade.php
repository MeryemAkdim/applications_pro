<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                @include('inc.messages')
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-md-8 card">
                <div class="card-header">
                    Submit Application
                </div>
                <form action="{{url("applications")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input type="text" name="name" id="name" value="{{old("name")}}" class="form-control rounded-0" required>
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name*</label>
                            <input type="text" name="lname" id="lname" value="{{old("lname")}}" class="form-control rounded-0" required>
                        </div>
                        <div class="form-group">
                            <label for="name">CV*</label>
                            <input type="file" name="cv" id="cv" accept=".pdf" class="form-control rounded-0" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end pt-2 pb-2">
                        <button class="btn btn-success rounded-0" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
