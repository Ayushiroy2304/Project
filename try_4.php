<?php
// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_password = '123456789';
$db_database = 'accesst';

// Establish a connection to the database
$connection = mysqli_connect($db_host, $db_user, $db_password, $db_database);

// Check the connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Query to count late entries
$late_entries_query = "SELECT COUNT(*) AS late_entries_count FROM entries WHERE entry_time >= '15:05:00'";
$late_entries_result = mysqli_query($connection, $late_entries_query);
$late_entries_row = mysqli_fetch_assoc($late_entries_result);
$late_entries_count = $late_entries_row['late_entries_count'];

// Query to count on-time entries
$on_time_entries_query = "SELECT COUNT(*) AS on_time_entries_count FROM entries WHERE entry_time < '15:05:00'";
$on_time_entries_result = mysqli_query($connection, $on_time_entries_query);
$on_time_entries_row = mysqli_fetch_assoc($on_time_entries_result);
$on_time_entries_count = $on_time_entries_row['on_time_entries_count'];

// Close the database connection
mysqli_close($connection);
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="pieChart" width="50" height="50"></canvas>

    <script>
        // Retrieve the PHP variables
        var lateEntries = <?php echo $late_entries_count; ?>;
        var onTimeEntries = <?php echo $on_time_entries_count; ?>;

        // Create the pie chart
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Late Entries', 'On-Time Entries'],
                datasets: [{
                    label: 'Entry Status',
                    data: [lateEntries, onTimeEntries],
                    backgroundColor: ['red', 'green']
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Late Entries vs On-Time Entries'
                }
            }
        });
    </script>
</body>
</html>
