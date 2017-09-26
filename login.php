<?php 
session_start();
include 'header.php';
?>

<h2>Login</h2>
 
 <form method="post" action="form-login.php" enctype="multipart/form-data">

 <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?php 
                if (isset($_SESSION['placeholder_email'])) 
                    echo $_SESSION['placeholder_email']; 
                   /* unset($_SESSION['placeholder_email']);*/
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
                    echo $_SESSION['placeholder_password']; /*unset($_SESSION['placeholder_password']);*/
                ?>">
            <div class="error">
                <?php 
                if (isset($_SESSION['error_password'])) { 
                    echo $_SESSION['error_password']; 
                    unset($_SESSION['error_password']);
                }; 
            ?>
            </div>
            
            <input type="submit" value="Submit" name="submit">
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
             
             <div class="login-register">Don't have an account? <a href="register">Create one here</a></div>
       

<?php include 'footer.php'; ?>