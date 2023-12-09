<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo isset($_SESSION['id_Role']['Role']) ? $_SESSION['id_Role']['Role'] : ''; ?> | TKS SPORTDATA
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>

    <section class="container-fluid">
        <div class="score text-center" style="font-size: 5rem;">
            <table id="employeeTable" class="table table table-striped table-hover">
                <tbody>
                    <!-- Table rows will be dynamically added here -->
                </tbody>
            </table>
        </div>
    </section>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function () {
            // Function to update table data
            function updateTable(data) {
                $('#employeeTable tbody').empty(); // Clear existing rows

                $.each(data, function (index, score) {
                    var row = '<tr id="' + score.id + '">' +
                        '<td class="align-middle">' + (index + 1) + '</td>' +
                        '<td class="align-middle">' + score.firstname + '</td>' +
                        '<td class="align-middle">' + score.lastname + '</td>' +
                        '<td class="align-middle">' + score.finalsum + '</td>' +
                        '</tr>';

                    $('#employeeTable tbody').append(row);
                });
            }

            // EventSource to listen for server-sent events
            var eventSource = new EventSource('../../service/score/index.php');

            // Handle events received from the server
            eventSource.onmessage = function (event) {
                var data = JSON.parse(event.data);
                updateTable(data);
            };

            // Close the event source when the page is unloaded
            $(window).on('beforeunload', function () {
                eventSource.close();
            });
        });
    </script>

</body>

</html>
