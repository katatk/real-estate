<?php 
session_start();
include 'header.php';
?>

       <h2>Register</h2>
        <form method="post" action="form-register.php" enctype="multipart/form-data">
      
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" value="<?php 
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
            
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" value="<?php 
                if (isset($_SESSION['placeholder_last_name'])) 
                    echo $_SESSION['placeholder_last_name']; unset($_SESSION['placeholder_last_name']);
                ?>">
            <div class="error">
                <?php 
                if (isset($_SESSION['error_last_name'])) { 
                    echo $_SESSION['error_last_name']; 
                    unset($_SESSION['error_last_name']);
                }; 
                ?>
            </div>
            
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?php 
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
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="<?php 
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
            
             <label for="password-confirm">Confirm Password</label>
            <input type="password" name="password-confirm" id="password-confirm" value="<?php 
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
            
            <input type="submit" value="Submit" name="submit">
            <a href='register.php' class='reset'>Reset</a>
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

            /*if (isset($_SESSION['postData'])) {
                $postData = $_SESSION['postData'];
            } else {
                $postData = [];
            }*/
        ?>
            </span>
        </div>
        <div class="login-register">Already have an account? <a href="login">Login here</a></div>

<?php include 'footer.php'; ?>