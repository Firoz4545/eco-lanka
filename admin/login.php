<?php require "includes/conn.php" ?>
<?php require "includes/header.php";

require 'includes/conn.php';

session_start();

if(isset($_SESSION['admin_email'])){
    echo "<script> location.href='/ecommerce/admin'; </script>";
    exit();
}

// Display error message if any
$error = '';
if(isset($_GET['errorl'])) {
    $error = htmlspecialchars($_GET['errorl']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - E-Eco Lanka</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/admin-login.css">
    <style>
        body {
            background: url("../images/background.jpg") no-repeat center center fixed;
            background-size: cover;
        }
        
    </style>
</head>
<body>
<div class="allContainer">
    <div class="container jumbotron jumbotron-fluid col-md-6 bg-light my-4 p-4 text-center">
        <div class="container">
            <h1 class="display-4">Admin Login</h1>
        </div>
    </div>

    <?php if($error): ?>
    <div class="container col-md-3 alert alert-danger">
        <?php echo $error; ?>
    </div>
    <?php endif; ?>

    <div class="container col-md-3 my-4">
        <form class="row g-3" action="scripts/login_script.php" method="POST">
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>