<?php
require_once '../constants.php';
if (!isset($file_access)) die("Direct File Access Denied");
?>

<div class="content">
    <div class="container-fluid">
        <?php
        echo "Megi";
        if (isset($_POST['submit'])) {
       
            unfollow($_POST['id']);
           

                        
        }
     ?>
               

    </div>
</div>

