<?php require 'functions.php';
$file_access = 1;
?>
<?php include('session.php');

$student = $_SESSION['id'];
echo printClearance($student);
?>
