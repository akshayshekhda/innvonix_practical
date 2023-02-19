</html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/project.css')}}">
</head>
<input type="hidden" name="hdnProjectId" id="hdnProjectId" value="{{isset($id) ? $id :''}}">
@php
$image = isset(Auth::user()->user_profile) ? Auth::user()->user_profile :'';
$url = asset('images/user_profile/'.$image.'');
@endphp
<header class="text-center">
    <div class="row bg-light">
        <div class="p-3 de-flex justify-content-between">
            <h2 class="ms-5"> Project Managment System</h2>
            <img class="me-5 mt-2 profile" height="50px" width="50px" src="{{$url}}">
            <div class="mt-2 me-4 logout">
                <a class="btn btn-primary" href="{{route('logout')}}" class="logout">Log out</a>
            </div>
        </div>
    </div>
</header>

<body>
    <div class="row">
        <div class="card">
            <div class="text-center text-bg-light">
                <h1 class="mt-2"> Task List </h1>
            </div>
            <div class="card-body">
                <!-- ONLY ADMIN and PROJECT MANAGER can see add new project button -->
                @if(Auth::user()->role_id != 3)
                <div class="addbtn">
                    <a href="{{route('tasklist.create')}}" id="addnewsFeedBtn"
                        class="btn btn-primary waves-effect btn-label waves-light mr-1 bt-sm-newedit2"><i
                            class="bx bx-plus label-icon"></i>ADD NEW</a>
                </div>
                @endif
                <div class="">
                    <div class="mt-4">
                        <div class="col-md-12">
                            <!-- Project List Table -->
                            <table id="TaskList" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>#</th>
                                        <th>Task Title</th>
                                        <th>User Name</th>
                                        <th>User Role</th>
                                        <th>Planned Start Date</th>
                                        <th>Planned End Date</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>
<!-- ALL BOOTSTRAP, DATATABLE CDN -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<!-- END -->

<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
    dataTableAjaxCall(); //call datatable function
});
var ProjectId = '';
//Load Project Using datatable
function dataTableAjaxCall() {

    var ProjectId = $("#hdnProjectId").val();


    var dt = $('#TaskList').DataTable({
        destroy: true,
        processing: true,
        responsive: true,
        autoWidth: false,
        ajax: {
            url: "/tasklist/" + ProjectId,
        },
        columns: [{
                data: 'id',
                name: 'sequence',
                orderable: false,
                searchable: false,
                targets: 0,
                visible: false
            },
            {
                data: 'id',
                name: 'id',
                orderable: false,
                searchable: false,
                targets: 1
            },

            {
                data: 'task_name',
                name: 'task_name',
                searchable: true,
            },
            {
                data: 'user_id',
                name: 'user_id',
                searchable: true,
            },
            {
                data: 'user_role',
                name: 'user_role',
                searchable: true,
            },

            {
                data: 'planned_start_date',
                name: 'planned_start_date',
                orderable: false,
                "type": "dom-date"
            },
            {
                data: 'planned_end_date',
                name: 'planned_end_date',
                orderable: false,
                "type": "dom-date"
            },
            {
                data: 'status',
                name: 'status',
                orderable: true,

            },
            {
                data: 'command',
                name: 'command',
                orderable: true,

            },

        ],
        rowReorder: {
            dataSrc: 'sequence',
        },
        columnDefs: [{
            type: 'dateNonStandard',
            targets: -1
        }]

    });
    $('.dataTables_filter input[type="search"]').css({
        'width': '350px',
        'display': 'inline-block'
    });
    $('.dataTables_filter input').attr('type', 'text');
    dt.on('row-reordered', function(e, diff, edit) {
        dt.order([0, 'asc']);
    });
    dt.on('order.dt search.dt', function() {
        dt.column(1, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    });

    dt.on('row-reorder', function(e, details, edit) {
        dt.column(1).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    });
}

function deleteProject() {
    const url = $('#delete-button').attr('data-value');

    $.ajax({
        url: url,
        type: "DELETE",
        success: function() {
            location.reload();
        }
    });

}
</script>