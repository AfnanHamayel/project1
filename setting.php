<?php
include('includes/header.php');
include('includes/navbar.php');
include __DIR__ . '/includes/db.php';

?>



<div class="card-body">

<div class="table-responsive">
  <?php
  $query = "SELECT * FROM main_admin";
  $query_run = mysqli_query($mysqli, $query);
  ?>

  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>Email </th>
        <th>Password</th>
        <th>EDIT </th>    
    
      </tr>
    </thead>
    <tbody>
      <?php
      if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_assoc($query_run)) {
      ?>
          <tr>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td>
              <form action="setting_edit.php" method="post">
                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="edit_btn" class="btn btn-success">EDIT your information </button>
              </form>
            </td>
            
          </tr>
      <?php
        }
      } else {
        echo "No Record Found";
      }
      ?>
    </tbody>
  </table>

</div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
