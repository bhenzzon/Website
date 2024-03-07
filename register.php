<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $address = $age = $salary = $user = $password = "";
$name_err = $address_err = $age_err = $salary_err = $user_err = $password_err = "";

$page_err = ""; 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    $input_age = trim($_POST["age"]);
    if(empty($input_age)){
        $age_err = "Please enter integer age.";     
    } else{
        $age = $input_age;
    }
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }

    // Validate address
    $input_user = trim($_POST["user"]);
    if(empty($input_user)){
        $user_err = "Please enter correct email.";     
    } else{
        $user = $input_user;
    }

    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter correct password.";     
    } else{
        $password = $input_password;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($age_err) && empty($salary_err) && empty($user_err) && empty($password_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, address, age, salary, username, password) VALUES (?, ?, ?, ?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $param_name, $param_address, $param_age, $param_salary, $param_user, $param_password);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_age = $age;
            $param_salary = $salary;
            $param_user = $user;
            $param_password = $password;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                $page_err = "<p style='color:green;'>Successfully Inserted data into the database!</p>";
            } else{
                $page_err = "<p style='color:red;'>Oops! Error Inserting data into the database!</p>";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<style> 
body{
    background-image:url('img/pexels-pavel-danilyuk-5807670.jpg');
    background-size:  100%;
}
.center{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}
</style>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <img  src="img/text-1679609813230.png" alt="Slide 1" class="center" >
                    <?php echo $page_err;?>
                   
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group">
                            <label style="font-family:monochrome;color:white">Name</label>
                            <input type="text" name="name" class="form-control form-control-sm <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label style="font-family:monochrome;color:white">Address</label>
                            <textarea name="address" class="form-control form-control-sm <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label style="font-family:monochrome;color:white">Age</label>
                            <input type="text" name="age" class="form-control form-control-sm <?php echo (!empty($age_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $age; ?>">
                            <span class="invalid-feedback"><?php echo $age_err;?></span>
                        </div>
                        <div class="form-group">
                            <label style="font-family:monochrome;color:white">Income</label>
                            <input type="text" name="salary" class="form-control form-control-sm <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <div class="form-group">
                            <label style="font-family:monochrome;color:white">Username</label>
                            <input type="email" name="user" class="form-control form-control-sm <?php echo (!empty($user_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user; ?>">
                            <span class="invalid-feedback"><?php echo $user_err;?></span>
                        </div>
                        <div class="form-group">
                            <label style="font-family:monochrome;color:white">Password</label>
                            <input type="password" name="password" class="form-control form-control-sm <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <div class="col">
                            <p class="d-flex justify-content-end">
                            <label for="emailAddress"><a href="login.php">Already have an Account?</a></label>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>