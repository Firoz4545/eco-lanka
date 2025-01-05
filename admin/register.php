<?php require "includes/conn.php"; // Ensure this file connects to the admin database correctly ?>
<?php require "includes/header.php";

session_start();

if(isset($_SESSION['admin_email'])){
    echo "<script> location.href='/ecommerce/admin'; </script>";
    exit();
}

$error = '';
if(isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register - E-Eco Lanka</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url("../images/background.jpg") no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }
      
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="allContainer">
    <div class="container jumbotron jumbotron-fluid col-md-6 bg-light my-4 p-4 text-center">
        <div class="container">
            <h1 class="display-4">Admin Register</h1>
        </div>
    </div>

    <?php if($error): ?>
    <div class="container col-md-3 alert alert-danger">
        <?php echo $error; ?>
    </div>
    <?php endif; ?>

    <div class="container col-md-3 my-4 form-container">
        <form class="row g-3" action="scripts/signup_script.php" method="POST">
            <div class="col-md-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="col-md-12">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="number" name="mobile" class="form-control" id="mobile" required>
            </div>
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>