<?php 
session_start();
$title = "Register";
include 'header.php';
?>

<section>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">

                <h2>Register an Account</h2>
                <p>As a buyer, an account allows you to add properties to your wishlist. If you are an agent, you can manage and add new properties and update exsiting listings.</p>
                <form method="post" action="form-register.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="<?php 
                if (isset($_SESSION['placeholder_first_name'])) 
                    echo $_SESSION['placeholder_first_name']; unset($_SESSION['placeholder_first_name']);
                ?>">
                        <div class="error">
                            <?php 
                if (isset($_SESSION['error_first_name'])) { 
                    echo $_SESSION['error_first_name']; 
                    unset($_SESSION['error_first_name']);
                }; 
                ?>
                        </div>
                    </div>
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
                        <label for="account-type">Account Type</label>
                        <select class="form-control" id="city" name="city">
                          <option>Auckland</option>
                          <option>Hamilton</option>
                          <option>Tauranga</option>
                    </select>
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

                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input type="password" class="form-control" name="password-confirm" id="password-confirm" value="<?php 
                if (isset($_SESSION['placeholder_password_confirm'])) 
                    echo $_SESSION['placeholder_password_confirm']; unset($_SESSION['placeholder_password_confirm']);
                ?>">
                        <div class="error">
                            <?php 
                if (isset($_SESSION['error_password_confirm'])) { 
                    echo $_SESSION['error_password_confirm']; 
                    unset($_SESSION['error_password_confirm']);
                }; 
            ?>
                        </div>
                    </div>

                    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                    <a href='register.php' class='btn btn-default reset'>Reset</a>
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
                <div class="login-register">Already have an account? <a href="login">Login here</a></div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
