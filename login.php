<?php 

$title = "Login";

// if user is logged in and their role is agent, show them the dashboard nav, otherwise show the normal header
(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && ($_SESSION['role'] == "Agent" || $_SESSION['role'] == "Admin")) ? include_once 'inc/dashboard-header.php' : include_once 'inc/header.php';

// unset these placeholders so they don't show on if user goes back to register page
unset($_SESSION['placeholder_password_confirm']);
unset($_SESSION['placeholder_first_name']);

?>

<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xs-12 col-lg-7">

                <h1 class="title">Login</h1>
                <p>
                    <?php 
                    if (isset($_SESSION['alertMessage'])) { 
                        echo $_SESSION['alertMessage']; 
                        unset($_SESSION['alertMessage']);
                    }; 
                ?>
                </p>

                <form method="post" action="process/login-processing.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?php 
                if (isset($_SESSION['placeholder_email'])) 
                    echo $_SESSION['placeholder_email']; 
                    unset($_SESSION['placeholder_email']);
                ?>">
                        <div class="error">
                            <?php 
                if (isset($_SESSION['error_email'])) { 
                    echo $_SESSION['error_email']; 
                    unset($_SESSION['error_email']);
                }; 
            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="<?php 
                if (isset($_SESSION['placeholder_password'])) 
                    echo $_SESSION['placeholder_password']; unset($_SESSION['placeholder_password']);
                ?>">
                        <div class="error">
                            <?php 
                if (isset($_SESSION['error_password'])) { 
                    echo $_SESSION['error_password']; 
                    unset($_SESSION['error_password']);
                }; 
            ?>
                        </div>
                    </div>

                    <input type="submit" class="button" value="LOG IN" name="submit">
                </form>

                <div id="validation-message-container">
                    <span class="error">
            <?php       

            //if an error message is set, show it
            if (isset($_SESSION['alertMessage'])) { 
                // Show the alert message 
                echo $_SESSION['alertMessage']; 
                // Remove the message so its not there after a refresh
                unset($_SESSION['alertMessage']); 
            }
            ?>    
            </span>
                </div>

                <div class="login-register">Don't have an account? <a href="register.php">Create one here</a></div>
            </div>
        </div>
    </div>
</section>


<?php include_once 'inc/footer.php'; ?>
