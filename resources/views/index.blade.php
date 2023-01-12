<!DOCTYPE html>
<html>

<head>
    <title>How to add Custom filter in DataTable AJAX pagination in Laravel 9</title>

    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <!-- Datatable CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />

    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

</head>

<body>

    <!-- Search filter -->
    <div>
        <!-- City -->
        <select id='sel_city'>
            <option value=''>-- Select city --</option>

            @foreach($cities as $city){
            <option value='{{ $city->city }}'>{{ $city->city }}</option>
            @endforeach
        </select>

        <!-- Gender -->
        <select id='sel_gender'>
            <option value=''>-- Select Gender --</option>
            <option value='male'>Male</option>
            <option value='female'>Female</option>
        </select>

        <!-- Name -->
        <input type="text" id="searchName" placeholder="Search Name">
    </div>

    <table id='emp-table' width='100%' border="1" style='border-collapse: collapse;'>
        <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>City</th>
            </tr>
        </thead>
    </table>

    <!-- Script -->
    <script type="text/javascript">
        $(document).ready(function() {

            // DataTable
            var empTable = $('#emp-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('getEmployees')}}",
                    data: function(data) {
                        data.searchCity = $('#sel_city').val();
                        data.searchGender = $('#sel_gender').val();
                        data.searchName = $('#searchName').val();
                    },
                },
                columns: [{
                        data: 'username'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'gender'
                    },
                    {
                        data: 'city'
                    },
                ]
            });

            $('#sel_city,#sel_gender').change(function() {
                empTable.draw();
            });

            $('#searchName').keyup(function() {
                empTable.draw();
            });

        });
    </script>
</body>

</html>