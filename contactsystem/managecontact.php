<?php

require_once 'config.php';

// Define variables and initialize with empty values


$name = $company = $phone =  $email = $user_id = "";
$name_err = $company_err = $phone_err = $email_err = $user_id_err = "";





// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

     // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT contact_id FROM contact WHERE name = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_name);

            // Set parameters
            $param_name = trim($_POST["name"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();

                // if($stmt->num_rows == 1){
                //     $name_err = "This name is already taken.";
                // } else{
                    $name = trim($_POST["name"]);
                // }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

   

     // Validate company
    if(empty(trim($_POST["company"]))){
        $company_err = "Please enter a company.";
    } else{
        // Prepare a select statement
        $sql = "SELECT contact_id FROM contact WHERE company = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_company);

            // Set parameters
            $param_company = trim($_POST["company"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();

                // if($stmt->num_rows == 1){
                //     $company_err = "This company is already taken.";
                // } else{
                    $company = trim($_POST["company"]);
                // }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }



     // Validate phone
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter a phone.";
    } else{
        // Prepare a select statement
        $sql = "SELECT contact_id FROM contact WHERE phone = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_phone);

            // Set parameters
            $param_phone = trim($_POST["phone"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $phone_err = "This phone is already taken.";
                } else{
                    $phone = trim($_POST["phone"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

     // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT contact_id FROM contact WHERE email = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Validate user_id
   if(empty(trim($_POST["user_id"]))){
        $user_id_err = "Please enter a user_id.";
    } else{
        // Prepare a select statement
        $sql = "SELECT contact_id FROM contact WHERE user_id = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_user_id);

            // Set parameters
            $param_user_id = trim($_POST["user_id"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();

                // if($stmt->num_rows == 1){
                //     $user_id_err = "This user_id is already taken.";
                // } else{
                    $user_id = trim($_POST["user_id"]);
                // }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        $stmt->close();
    }



    // Check input errors before inserting in database
    if(empty($name_err) &&  empty($company_err) && empty($phone_err) && empty($email_err) && empty($user_id_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO contact (name, company, phone, email, user_id) VALUES (?, ?, ?, ?,?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss",$param_name,  $param_company, $param_phone, $param_email, $param_user_id );

            // Set parameters
            $param_name = $name;
            
            $param_company = $company;
            $param_phone = $phone;
            $param_email = $email;
            $param_user_id = $user_id;
            // $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                
                // Redirect to login page
                // header("location: thankyou.php");
                echo "<script>alert('Contact added successfully!');</script>";
                header("location: contact.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>


<ul class="nav nav-pills">
  <li role="presentation" class=""><a href="contact.php">Contact</a></li>
  <li role="presentation"><a href="managecontact.php">Manage Contact</a></li>
  <li role="presentation" style="float:right;"><a href="logout.php">Logout</a></li>
</ul>
<div class="wrapper">
    <h2>Add Contact</h2>
    <p>Please fill this form to add contact.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <label>Name::<sup>*</sup></label>
            <input type="text" name="name"class="form-control" value="<?php echo $name; ?>">
            <span class="help-block"><?php echo $name_err; ?></span>
        </div>

        
         <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
            <label>Phone:<sup>*</sup></label>
            <input type="number"  name="phone"class="form-control"  value="<?php echo $phone; ?>">
            <span class="help-block"><?php echo $phone_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($company_err)) ? 'has-error' : ''; ?>">
            <label>Company:<sup>*</sup></label>
            <input type="text" name="company"class="form-control" value="<?php echo $company; ?>">
            <span class="help-block"><?php echo $company_err; ?></span>
        </div>
       

       <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Email:<sup>*</sup></label>
            <input type="email" name="email"class="form-control" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($user_id_err)) ? 'has-error' : ''; ?>">
            <label>User_id:<sup>*</sup></label>
            <input type="number" name="user_id"class="form-control" value="<?php echo $user_id; ?>">
            <span class="help-block"><?php echo $user_id_err; ?></span>
        </div>
        
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <!-- <input type="reset" class="btn btn-default" value="Reset"> -->
        </div>
        <!-- <p>Already have an account? <a href="login.php">Login here</a>.</p> -->
    </form>
</div>
</body>
</html>