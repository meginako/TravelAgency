<?php
session_start();
require_once '../conn.php';
require_once '../constants.php';
$class = "reg";
?>
<?php
$cur_page = 'signup';
include 'includes/inc-header.php';
include 'includes/inc-nav.php';

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $file = 'file';
    $nipt=$_POST['nipt'];
    $description=$_POST['description'];
    $cpassword = $_POST['cpassword'];
    $password = $_POST['password'];
    if (!isset($name,$phone, $email, $password, $cpassword,$nipt,$description) || ($password != $cpassword)) { ?>
<script>
alert("Ensure you fill the form properly.");
</script>
<?php
    } else {
        //Check if email exists
        $check_email = $conn->prepare("SELECT * FROM users WHERE email = ? OR phone = ?");
        $check_email->bind_param("ss", $email, $phone);
        $check_email->execute();
        $res = $check_email->store_result();
        $res = $check_email->num_rows();
        if ($res) {
        ?>
<script>
alert("Email already exists!");
</script>
<?php

        } elseif ($cpassword != $password) { ?>
<script>
alert("Password does not match.");
</script>
<?php
        } else {
            //Insert
            $password = md5($password);
            $can = 1;
            $loc = uploadFile('file');
            if ($loc == -1) {
                echo "<script>alert('The file could not be uploaded!')</script>";
                exit;
            }
            $stmt = $conn->prepare("INSERT INTO users (agency_name, email, password, phone, nipt, description, type, status) VALUES (?,?,?,?,?,?,1,1)");
            $stmt->bind_param("ssssss", $name, $email, $password, $phone, $nipt, $description);
            if ($stmt->execute()) {
            ?>
<script>
alert("Congratulations.\nYou are now registered.");
window.location = 'agencysignin.php';
</script>
<?php
            } else {
            ?>
<script>
alert("We could not register you!");
</script>
<?php
            }
        }
    }
}
?>
<div class="signup-page">
    <div class="form">
        <h2>Create Agency Account </h2>
        <br>
        <p class="alert alert-info">
            <marquee behavior="" scrollamount="2" direction="">You need to create an account in order to access the platform!
            </marquee>
        </p>
        <form class="login-form" method="post" role="form" enctype="multipart/form-data" id="signup-form"
            autocomplete="off">
          
            <div id="errorDiv"></div>
           
            <div class="col-md-12">
                <div class="form-group">
                    <label>Agency Name</label>
                    <input type="text"  name="name">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>NIPT</label>
                    <input type="text"  name="nipt">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>   
                        <textarea name="description" required minlength="10" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </div>
            
            
            <div class="col-md-6">
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" minlength="10" pattern="[0-9]{10}" required name="phone">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" required name="email">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Select Picture</label>
                    <input type="file" name='file' required>
                </div>
            </div>
          <!--  <div class="col-md-6">
                <div class="form-group">
                    <label>Address</label>
                    <input type='text' name="address" class="form-group" required>
                    </select>
                    <span class="help-block" id="error"></span>
                </div>
            </div> -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password">
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="cpassword" id="cpassword">
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" id="btn-signup">
                        CREATE AGENCY ACCOUNT
                    </button>
                </div>
            </div>
            <p class="message">
                <a href="#">.</a><br>
            </p>
        </form>
    </div>
</div>
</div>
<script src="assets/js/jquery-1.12.4-jquery.min.js"></script>

</body>

</html>