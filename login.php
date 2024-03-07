<?php
require_once "config.php";
$incorrect="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = mysqli_real_escape_string($mysqli, $_REQUEST['username']);
    $password = mysqli_real_escape_string($mysqli, $_REQUEST['password']);

$sql = "SELECT * FROM employees WHERE username='$user' AND password='$password'";
    if($result = $mysqli->query($sql)){
        if($result->num_rows > 0){
            header("location: index4.html");
            exit();
        } else{
                $incorrect= '<div class="alert alert-danger"><em>Incorrect credentials!</em></div>';
            }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }

}
    $mysqli->close();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  </head>
  <style> 
body{
    background-image:url('img/pexels-pavel-danilyuk-5807670.jpg');
    background-size: 100%;

}
</style>
  <body>
  <div class="container-fluid d-flex justify-content-center p-5">
        <div class="col-sm-4 position-absolute top-50 start-50 translate-middle p-5 bg-light rounded">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <p>
                        <?php echo $incorrect; ?>
                    </p>
                    <p class="text-center">
                        <img src="lock.png" class="img-fluid rounded-circle" alt="" style="width:30%;">
                    </p>
                    <p>
                    <img src="img/text-1679609328543.png" class="d-block w-100 rounded" alt="Slide 1">

                    </p>
                    <p>
                    <label for="lastName">Username:</label>
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-text">
                            <span class="bi-person"></span>
                        </span>
                        <input type="email" class="form-control" name="username" placeholder="Username">
                        </div>
                    </div>
                    </p>
                    <p>
                    <label for="lastName">Password:</label>
                    <div class="row">
                        <div class="input-group">
                            <span class="input-group-text">
                            <span class="bi-lock"></span>
                        </span>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    </p>
                    
                    <div class="row">
                        <div class="col">
                            <p class="d-flex justify-content-start">
                            <input class="btn btn-success" type="submit" value="Login">
                            </p>
                        </div>    
                        <div class="col">
                            <p class="d-flex justify-content-end">
                            <label for="emailAddress"><a href="register.php">Create Account?</a></label>
                            </p>
                        </div>
                    </div>
                    </form>
        </div>
  </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>