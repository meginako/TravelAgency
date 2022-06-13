 <?php
  @session_start();
  if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }

  $user_id = $_SESSION['user_id'];
  $email = $_SESSION['email'];
  if (!isset($conn)) require '../conn.php';
  $exist = $conn->query("SELECT * FROM passenger WHERE id = '$user_id'")->num_rows;
  if ($exist != 1) {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }
  ?>