<?php
if (!empty($_POST['Username'])) {

  include("db.php");
  $Username = $_POST['Username'];
  $Password = $_POST['Password'];
  $sql = "SELECT * FROM `user` Where `user`='" . $Username . "' and `password`='" . $Password . "' ";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $_SESSION["UserID"] = $row["user"];
    $_SESSION["type"] = $row["type"];

    header("Location: profile?Page=1");
  } else {
?>
    <script>
      alert(" user หรือ  password ไม่ถูกต้อง");
      window.history.back();
    </script>
  <?php
  }
} else {
  Header("Location: index.php");
}

if (isset($_POST['Logout'])) {
  session_destroy();
  header("Location: index.php ");
}
?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
</head>

</html>