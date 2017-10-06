<?php
session_start();
$title = "Contact";
include 'header.php';
?>
   
    <div class="container">
        <h1 class="title">CONTACT US</h1>
        <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </div>
    </div>

    <div class="contact-form">
        <main>
            <form>
                <div class="form-group" id="name-group">
                    <label class="contact-label" for="full-name">Name:</label>
                    <input type="text" id="full-name" placeholder="Enter your full name">
                </div>
                <div class="form-group" id="email-group">
                    <label class="contact-label" for="email">Email Address:</label>
                    <input type="email" id="email" placeholder="Enter your email address">
                </div>
                <div id="message-label"><b>Your message:</b></div>
                <div id="messagebox"><textarea id="textarea" rows="8" cols="30" maxlength="150" placeholder="Type message here..."></textarea>
                </div>
                <div id="textarea_feedback"></div>
                <br>

                <input type="button" value="Submit" onclick="validateForm()">
            </form>
        </main>
    </div>
    </div>


     <?php include 'footer.php'; ?>

</body>

<script type="text/javascript">
    function characterCount() {
        var text_max = 150;
        document.getElementById('textarea_feedback').innerHTML = text_max + ' characters remaining';

        document.getElementById('textarea')
        var text_length = document.getElementById('textarea').value.length;
        var text_remaining = text_max - text_length;

        document.getElementById('textarea_feedback').innerHTML = text_remaining + ' characters remaining';
    };

    document.getElementById("textarea").addEventListener("keydown", characterCount);
    window.onload = characterCount();

    // validate a form
    // create an error list ul for each field
    var errorListEmail = document.createElement("ul");
    var errorListName = document.createElement("ul");

    // create an empty string for error list
    var errorListContentEmail = "";
    var errorListContentName = "";

    // grab the form groups to append error lists to
    var emailGroup = document.getElementById("email-group");
    var nameGroup = document.getElementById("name-group");


    function validateForm() {

        // get the form field values on button click
        var strEmailAddress = document.getElementById("email").value;
        var strFullName = document.getElementById("full-name").value;

        // validate email
        if (strEmailAddress == "") {
            errorListContentEmail = "<li>Please enter an email address</li>";
            // add invalid class
            errorListEmail.className = "invalid";
        }
        if (!/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/.test(strEmailAddress)) {
            errorListContentEmail = "<li>" + strEmailAddress + " is NOT a valid email address</li>";
            // add invalid class
            errorListEmail.className = "invalid";
        }

        if (strEmailAddress != "" && /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/.test(strEmailAddress)) {
            errorListContentEmail = "<li>" + strEmailAddress + " is a valid email address</li>";
            // add valid class
            errorListEmail.className = "valid";
        }

        // validate full name
        if (strFullName == "") {
            errorListContentName += "<li>Please enter a name</li>";

            // add valid class
            errorListName.className = "invalid";
        } else if (!/^[a-zA-Z]+\s[a-zA-Z]+$/.test(strFullName)) {
            errorListContentName += "<li>" + strFullName + " is NOT a valid first and last name</li>";

            // add valid class
            errorListName.className = "invalid";
        }

        if (strFullName != "" && strFullName.match(/^[a-zA-Z]+\s[a-zA-Z]+$/)) {
            errorListContentName = "<li>" + strFullName + " is a valid name</li>";
            // add valid class
            errorListName.className = "valid";
        };

        // set innerHTML of the error list ul to content (string)  
        errorListEmail.innerHTML = errorListContentEmail;
        errorListName.innerHTML = errorListContentName;

        // append error list ul to form group
        emailGroup.appendChild(errorListEmail);
        nameGroup.appendChild(errorListName);


        // set error lists to empty, to be rebuilt when validateForm runs
        errorListContentEmail = "";
        errorListContentName = "";

    }

</script>

</html>
