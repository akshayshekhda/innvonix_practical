<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/project.css')}}">
    <title>Edit Task</title>
</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Edit Form Task -->
                    <form action="{{route('tasklist.update',$data->id)}}" class="needs-validation edugladeform formhide"
                        enctype="multipart/form-data" novalidate method="post" id="country-store">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Task Title</label>
                                    <input type="text" class="form-control" id="task_name" name="task_name"
                                        value="{{$data->task_name}}" aria-describedby="emailHelp"
                                        placeholder="Enter Youe Title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Task Description</label>
                                    <textarea type="email" class="form-control" id="description" name="task_description"
                                        aria-describedby="emailHelp" placeholder="Enter Your Project Description"
                                        required>{{$data->task_description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Planned Start Date </label>
                                    <input type="text" class="start-date form-control" name="planned_start_date"
                                        value="{{$data->planned_start_date}}" value="" readonly
                                        placeholder="Enter Your Planned Start Date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Planned End Date </label>
                                    <input type="text" class="end-date form-control" name="planned_end_date"
                                        value="{{$data->planned_end_date}}" readonly
                                        placeholder="Enter Your Planned End Date " required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Actual Start Date </label>
                                    <input type="text" class="start-date form-control" name="actual_start_date"
                                        value="{{$data->actual_start_date}}" readonly
                                        placeholder="Enter Your Actual Start Date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Actual End Date </label>
                                    <input type="text" class="end-date form-control" name="actual_end_date"
                                        value="{{$data->actual_end_date}}" readonly
                                        placeholder="Enter Your Actual End Date " required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- USER DROP DOWN -->
                                    <label for="exampleInputEmail1">Assign to </label>
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="">----------Select User----------</option>
                                        @if(isset($UserData) && !empty($UserData))
                                        @foreach($UserData as $Ueser)
                                        <option value="{{$Ueser['id']}}"
                                            {{$Ueser['id'] === $data->user_id ? 'selected' : ''}}>{{$Ueser['name']}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Remarks</label>
                                    <textarea type="email" class="form-control" id="remarks" name="remarks"
                                        aria-describedby="emailHelp" placeholder="Enter Your Project Remarks"
                                        required>{{$data->remarks}}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!-- Jequry EDN -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
<!-- END -->
<script>
// Datepecker Jequry
$('.start-date').datepicker({
    templates: {
        leftArrow: '<i class="fa fa-chevron-left"></i>',
        rightArrow: '<i class="fa fa-chevron-right"></i>'
    },
    format: "dd/mm/yyyy",
    startDate: new Date(),
    keyboardNavigation: false,
    autoclose: true,
    todayHighlight: true,
    disableTouchKeyboard: true,
    orientation: "bottom auto"
});

$('.end-date').datepicker({
    templates: {
        leftArrow: '<i class="fa fa-chevron-left"></i>',
        rightArrow: '<i class="fa fa-chevron-right"></i>'
    },
    format: "dd/mm/yyyy",
    startDate: moment().add(1, 'days').toDate(),
    keyboardNavigation: false,
    autoclose: true,
    todayHighlight: true,
    disableTouchKeyboard: true,
    orientation: "bottom auto"

});
$('.start-date').datepicker().on("changeDate", function() {
    var startDate = $('.start-date').datepicker('getDate');
    var oneDayFromStartDate = moment(startDate).add(1, 'days').toDate();
    $('.end-date').datepicker('setStartDate', oneDayFromStartDate);
    $('.end-date').datepicker('setDate', oneDayFromStartDate);
});

$('.end-date').datepicker().on("show", function() {
    var startDate = $('.start-date').datepicker('getDate');
    $('.day.disabled').filter(function(index) {
        return $(this).text() === moment(startDate).format('D');
    }).addClass('active');
});
</script>