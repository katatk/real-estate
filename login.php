<?php 
session_start();
$title = "Login";
include 'dashboard-header.php';
?>

<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xs-12 col-lg-7">

                <h2>Login</h2>
                <p>
                    <?php 
                if (isset($_SESSION['account_successful'])) { 
                    echo $_SESSION['account_successful']; 
                    unset($_SESSION['account_successful']);
                }; 
                ?>
                </p>
    
                <form method="post" action="form-login.php" enctype="multipart/form-data">
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


<?php include 'dashboard-footer.php'; ?>
