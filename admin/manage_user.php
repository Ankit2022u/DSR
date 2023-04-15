<?php
session_start();
require "../api/dbcon.php";
?>

<header>
  <!-- place navbar here -->
  <?php include('admin_header.php'); ?>
</header>

<main>
  <div class="row">
    <div class="side-bar col-md-3 col-sm-5">
      <?php include('side-bar.php'); ?>
    </div>

    <div class="main-content col-md-9 col-sm-7">
      <div class="container mt-4">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <?php
                if (isset($_SESSION['message'])):
                  ?>
                  <div class="alert alert-<?= $_SESSION['type'];?> alert-dismissible fade show" role="alert">
                    <strong>Hye!</strong>
                    <?= $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php
                  unset($_SESSION['message']);
                endif;
                ?>
                <h4>User details
                  <a href="create_user.php" class="btn btn-primary float-end">Add User</a>
                </h4>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-stripped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User ID</th>
                      <th>Officer Name</th>
                      <th>Officer Rank</th>
                      <th>Police Station</th>
                      <th>Password</th>
                      <th>User Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM users";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      foreach ($query_run as $user) {
                        ?>
                        <tr>
                          <td>
                            <?= $user['uid']; ?>
                          </td>
                          <td>
                            <?= $user['user_id']; ?>
                          </td>
                          <td>
                            <?= $user['officer_name']; ?>
                          </td>
                          <td>
                            <?= $user['officer_rank']; ?>
                          </td>
                          <td>
                            <?= $user['police_station']; ?>
                          </td>
                          <td>
                            <?= $user['password']; ?>
                          </td>
                          <td>
                            <?php if ($user['user_type'] == "admin") {
                              echo "Administration";
                            } else {
                              echo "User";
                            } ?>
                          </td>
                          <td>
                            <a href="update_user.php?uid=<?= $user['uid']; ?>" class="btn btn-primary">Edit</a>
                            <form action="delete_user.php" method="post" class="d-inline">
                              <button type="submit" name="delete_user" value=<?= $user['uid']; ?>
                                class="btn btn-danger">Delete</a>
                            </form>
                          </td>
                        </tr>
                        <?php
                      }
                    } else {
                      echo "No Records Found";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>


<!-- place footer here -->
<?php include('../footer.php'); ?>

</body>

</html>