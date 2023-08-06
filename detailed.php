<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <title>Data Analysis of Database</title>
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="header">
                        <h2 class="display-6">Detailed review of login</h2>
                        <div>
                            <div class="card-body">
                                <table class="table table-bordered text-center">
                                    <tr class="bg-dark text-white">
                                        <td>id</td>
                                        <td>tag_id</td>
                                        <td>entry_time</td>
                                        <td>exit_time</td>
                                    </tr>
                                    <?php
                                    // Database configuration
                                    $host = 'localhost';
                                    $user = 'root';
                                    $password = '123456789';
                                    $database = 'accesst';

                                    // Create a database connection
                                    $mysqli = new mysqli($host, $user, $password, $database);
                                    if ($mysqli->connect_errno) {
                                        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                                        exit();
                                    }

                                    // Query the database
                                    $query = "SELECT * FROM entries";
                                    $result = $mysqli->query($query);

                                    while ($row = $result->fetch_assoc()) {
                                        $entryTime = $row['entry_time'];
                                        $exitTime = $row['exit_time'];

                                        $entryColor = '';
                                        $exitColor = '';

                                        // Check if entry time exists and is greater than 1:30 AM
                                        if ($entryTime && date('H:i', strtotime($entryTime)) >= '23:48') {
                                            $entryColor = 'red';
                                        } else {
                                            $entryColor = 'green'; // Set the color to green if the condition is not met
                                        }

                                        // Check if exit time exists and is less than 1:32 AM
                                        if ($exitTime && date('H:i', strtotime($exitTime)) < '23:45') {
                                            $exitColor = 'red';
                                        } else {
                                            $exitColor = 'green'; // Set the color to green if the condition is not met
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['tag_id'] ?></td>
                                        <td><span style="color: <?php echo $entryColor ?>"><?php echo $entryTime ?></span></td>
                                        <td><span style="color: <?php echo $exitColor ?>"><?php echo $exitTime ?></span></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
