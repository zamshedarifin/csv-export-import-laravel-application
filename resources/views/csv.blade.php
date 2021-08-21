<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>CSV Export Import</h2>

    @if($message = Session::get('error'))
       <strong>Error!</strong> {{$message}}

    @endif

    <table class="table">
        <thead>
        <tr>
            <th><input type="checkbox" id="select_all"></th>
            <th>Roll</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
        </tr>
        </thead>
        <tbody>

        <button type="button" class="btn btn-success btn-sm" style="margin-bottom: 10px" data-toggle="modal" data-target="#exampleModal">import</button>
        <form action="{{route('export')}}" method="get">
            @csrf
            <button type="submit" class="btn btn-primary mb-2 btn-sm" style="margin-bottom: 10px; margin-left: 10px;">Export User Data</button>
                @foreach($students as $student)
                <tr>
                    <td><input type="checkbox" name="studentId[]" class="checkbox" value="{{$student->id}}"> </td>
                    <td> {{$student->roll}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->mobile}}</td>
                </tr>
                @endforeach
        </form>

        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!--for custom field-->

                        <!-- <input type="text" name="name" class="form-control">
                        <input type="text" name="class" class="form-control"> -->

                        <input type="file" name="file" class="form-control">

                        <br>
                        <button class="btn btn-success">Import User Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // select multiple
        $(document).on('change', '#select_all', function () {
            if (this.checked) {
                $('input:checkbox').prop('checked', true);
            } else {
                $('input:checkbox').prop('checked', false);
            }
        });
        $( function() {
            $('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
        });
    })
</script>

</body>
</html>
