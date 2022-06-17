<?php
  @session_start();
  if (!isset($_SESSION['marketer'])) {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }

  if (($_SESSION['category']) != 'marketer' && $_SESSION['category'] != 'super') {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }
  $marketer_id = $_SESSION['marketer'];
  $agency_id = $_SESSION['agency_id'];
  if (!isset($conn)) require '../conn.php';

  ?>

