<br />
<h2 class="text-danger text-center mb-4">Delete account?</h2>
<p class="text-center">Are you sure you want to delete your account? This action can't be undo.</p>
<form action="" method="POST" class="mt-5">
  <div class="form-outline mb-4">
    <input type="submit" class="form-control w-50 m-auto text-center btn-danger" name="delete" value="Delete account">
  </div>
  <div class="form-outline mb-4">
    <input type="submit" class="form-control w-50 m-auto text-center btn-primary" name="no_delete" value="No. Don't delete my account">
  </div>
</form>

<?php
$username_session = $_SESSION['username'];
if (isset($_POST['delete'])) {
  $delete_query = "DELETE FROM `user_table` WHERE username='$username_session'";
  $result = mysqli_query($con, $delete_query);
  if ($result) {
    session_destroy();
    echo "<script>alert('Your account has been deleted.')</script>";
    echo "<script>window.open('../index.php','_self')</script>";
  }
}

if (isset($_POST['no_delete'])) {
  echo "<script>window.open('profile.php','_self')</script>";
}
?>