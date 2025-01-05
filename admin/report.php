<?php
require 'includes/conn.php';
session_start();

// Regenerate session ID to prevent session fixation
session_regenerate_id(true);

if (!isset($_SESSION['admin_email'])) {
    echo "<script> location.href='/ecommerce/admin/login.php'; </script>";
    exit();
}

require "includes/header.php";

// Function to execute query and fetch count
function fetchCount($conn, $query) {
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }
    return mysqli_fetch_assoc($result)['total'] ?? 0;
}

// Fetch data for the report
$total_users = fetchCount($conn, "SELECT COUNT(*) as total FROM register");
$total_orders = fetchCount($conn, "SELECT COUNT(*) as total FROM orders");
$total_products = fetchCount($conn, "SELECT COUNT(*) as total FROM products");
$total_pickups = fetchCount($conn, "SELECT COUNT(*) as total FROM pickups");
$total_drivers = fetchCount($conn, "SELECT COUNT(*) as total FROM drivers");
?>

<div class="mainContainer">
    <?php require "includes/sidebar.php"; ?>

    <div class="allContainer">
        <div class="container jumbotron jumbotron-fluid col-md-8 bg-light my-4 p-4 text-center">
            <div class="container">
                <h1 class="display-4">Admin Report Panel</h1>
            </div>
        </div>

        <div class="container">
            <canvas id="reportChart" class="chart" width="300" height="200"></canvas>
        </div>
        
        <div class="container">
            <canvas id="additionalChart" class="chart" width="300" height="200"></canvas>
        </div>
    </div>
</div>

<style>
.chart {
    width: 1200px !important; /* Set a specific width */
    height: 200px !important; /* Set a specific height */
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('reportChart').getContext('2d');
    const reportChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Total Users', 'Total Orders', 'Total Products', 'Total Pickups'],
            datasets: [{
                label: 'Count',
                data: [<?php echo $total_users; ?>, <?php echo $total_orders; ?>, <?php echo $total_products; ?>, <?php echo $total_pickups; ?>],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(54, 162, 235, 0.5)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // Additional chart for drivers, pickups, and products
    const additionalCtx = document.getElementById('additionalChart').getContext('2d');
    const additionalChart = new Chart(additionalCtx, {
        type: 'bar',
        data: {
            labels: ['Total Drivers', 'Total Pickups', 'Total Products'],
            datasets: [{
                label: 'Count',
                data: [<?php echo $total_drivers; ?>, <?php echo $total_pickups; ?>, <?php echo $total_products; ?>],
                backgroundColor: [
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 206, 86, 0.5)'
                ],
                borderColor: [
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 14
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html> 