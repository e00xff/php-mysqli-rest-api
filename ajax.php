<?php
ob_start();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
</head>
<body>

<?php include 'includes/header.php'; ?>

<main role="main" class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h4 class="mb-4">REST API CRUD</h4>

                <div class="card mb-3">
                    <div class="card-header">
                        Search
                    </div>
                    <div class="card-body">
                        <div id="search-bar" class="mb-3">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" class="form-control" id="search" name="search" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        Create New
                    </div>
                    <div class="card-body">
                        <form id="addForm">
                            <div class="mb-3">
                                <label for="insert-student-name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="insert-student-name" name="student_name">
                            </div>
                            <div class="mb-3">
                                <label for="insert-student-address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="insert-student-address" name="student_address">
                            </div>
                            <div class="mb-3">
                                <label for="insert-student-phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="insert-student-phone" name="student_phone">
                            </div>

                            <button type="button" id="save-button" class="btn btn-success btn-sm">Save</button>
                        </form>
                    </div>
                </div>

                <div id="error-message" class="mb-3"></div>
                <div id="success-message" class="mb-3"></div>

                <div id="result"></div>

                <div id="table-data">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="bg-light">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone</th>
                                <th scope="col" class="text-center">Active</th>
                            </tr>
                            </thead>
                            <tbody id="load-table">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div id="modal">
    <div id="modal-form">
        <form id="edit-form">
            <h3>Edit Record</h3>

            <div class="mb-3">
                <label for="edit-student-name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="edit-student-name" name="student_name">
            </div>
            <div class="mb-3">
                <label for="edit-student-address" class="form-label">Address</label>
                <input type="text" class="form-control" id="edit-student-address" name="student_address">
            </div>
            <div class="mb-3">
                <label for="edit-student-phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="edit-student-phone" name="student_phone">
            </div>
            <button id="edit-button" class="btn btn-success btn-sm">Update</button>
            <input type="hidden" name="student_id" id="edit-student-id">
        </form>
        <div id="close-btn">x</div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        // Fetch All
        function loadTable() {
            $('#load-table').html("");

            $.ajax({
                url: 'http://127.0.0.1:8000/api/v1/student/read.php',
                type: 'GET',
                success: function (data) {
                    if(data.status == false) {
                        $('#load-table').append(`<tr><td colspan="5">${data.message}</td></tr>`);
                    } else {
                        $.each(data, function (key, value) {
                            $('#load-table').append(`
                                <tr>
                                    <td>${value.student_id}</td>
                                    <td>${value.student_name}</td>
                                    <td>${value.student_address}</td>
                                    <td>${value.student_phone}</td>
                                    <td class="text-center">
                                        <button data-eid="${value.student_id}" class="edit-btn btn btn-primary btn-sm btn-xs-block">Edit</button>
                                        <button data-id="${value.student_id}" class="delete-btn btn btn-danger btn-sm btn-xs-block">Delete</button>
                                    </td>
                                </tr>`);
                        });
                    }
                }
            });
        }
        loadTable();

        // Show Success Or Error Message
        function message(message, status) {
            if (status == true) {
                $('#success-message').html(message).slideDown();
                $('#error-message').slideUp();
                setTimeout(function () {
                    $('#success-message').slideUp();
                }, 4000);
            } else if(status == false) {
                $('#error-message').html(message).slideDown();
                $('#success-message').slideUp();
                setTimeout(function () {
                    $('#error-message').slideUp();
                }, 4000);
            }
        }

        // Function for form Data to JSON Object
        function jsonData(targetForm) {
            var array = $(targetForm).serializeArray();
            // console.log(array);
            var obj = {};
            for(var a = 0; a < array.length; a++) {
                if(array[a].value == "") {
                    return false;
                }
                obj[array[a].name] = array[a].value;
            }
            // console.log(obj);
            var jsonString = JSON.stringify(obj);
            // console.log(jsonString);

            return jsonString;
        }

        // Insert new record
        $('#save-button').on('click', function (e) {
            e.preventDefault();

            var jsonObject = jsonData("#addForm");

            if (jsonObject == false) {
                message("All Fields Are Required.", false);
            } else {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/v1/student/create.php',
                    type: 'POST',
                    data: jsonObject,
                    success: function (data) {
                        message(data.message, data.status);

                        if(data.status == true) {
                            loadTable();
                            $('#addForm').trigger('reset');
                        }
                    }
                });
            }
        });

        // Delete record
        $(document).on('click', '.delete-btn', function (){
            if(confirm("Do you really want to delete this record?")) {
                var student_id = $(this).data("id");
                var obj = {student_id: student_id};
                var myJSON = JSON.stringify(obj);

                var row = this;

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/v1/student/delete.php',
                    type: 'POST',
                    data: myJSON,
                    success: function (data) {
                        message(data.message, data.status);

                        if(data.status == true) {
                            $(row).closest('tr').fadeOut();
                        }
                    }
                });
            }
        });

        // Fetch single record: show in modal box
        $(document).on('click', '.edit-btn', function (){
            $('#modal').show();

            var student_id = $(this).data("eid");
            var obj = {student_id: student_id};
            var myJSON = JSON.stringify(obj);

            console.log(myJSON);

            $.ajax({
                url: 'http://127.0.0.1:8000/api/v1/student/show.php',
                type: 'POST',
                data: myJSON,
                success: function (data) {
                    console.log(data[0]);

                    $('#edit-student-id').val(data[0].student_id);
                    $('#edit-student-name').val(data[0].student_name);
                    $('#edit-student-address').val(data[0].student_address);
                    $('#edit-student-phone').val(data[0].student_phone);
                }
            });

        });

        // Hide modal box
        $('#close-btn').on('click', function () {
            $('#modal').hide();
        });

        // Update record
        $('#edit-button').on('click', function (e) {
            e.preventDefault();

            var jsonObject = jsonData("#edit-form");

            if (jsonObject == false) {
                message("All Fields Are Required.", false);
            } else {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/v1/student/update.php',
                    type: 'PUT',
                    data: jsonObject,
                    success: function (data) {
                        message(data.message, data.status);

                        if(data.status == true) {
                            $('#modal').hide();
                            loadTable();
                        }
                    }
                });
            }
        });

        // Live search record
        $('#search').on('keyup', function () {
            var searchTerm = $(this).val();

            $('#load-table').html("");

            $.ajax({
                url: 'http://127.0.0.1:8000/api/v1/student/search.php?search=' + searchTerm,
                type: 'GET',
                success: function (data) {
                    if(data.status == false) {
                        $('#load-table').append(`<tr><td colspan="5">${data.message}</td></tr>`);
                    } else {
                        $.each(data, function (key, value) {
                            $('#load-table').append(`
                                <tr>
                                    <td>${value.student_id}</td>
                                    <td>${value.student_name}</td>
                                    <td>${value.student_address}</td>
                                    <td>${value.student_phone}</td>
                                    <td class="text-center">
                                        <button data-eid="${value.student_id}" class="edit-btn btn btn-primary btn-sm btn-xs-block">Edit</button>
                                        <button data-id="${value.student_id}" class="delete-btn btn btn-danger btn-sm btn-xs-block">Delete</button>
                                    </td>
                                </tr>`);
                        });
                    }
                }
            });
        });

    });
</script>

</body>
</html>