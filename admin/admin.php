<?php
session_start();
require '../api/functions.php';

if (!(isset($_SESSION['user-data']))) {
  header("Location: ../index.php");
}

$total_major_crimes = count_major_crimes();
$total_dead_bodies = count_dead_bodies();
$total_minor_crimes = count_minor_crimes();
$total_ongoing_cases = count_ongoing_cases();
$total_police_stations = count_police_stations();
$total_users = count_users();

?>
<?php include('admin_header.php'); ?>
<main>
  <div class="row">

    <div class="side-bar col-md-3 col-sm-5">
      <?php include('side-bar.php'); ?>
    </div>

    <div class="main-content container col-md-9 col-sm-7">
      <div class="row">
        <div class="card text-white mb-3 col-md-4 col-sm-6" style="max-width: 18rem;">
          <div class="card-header">
            <a href="" class="btn btn-outline-danger add-icon"><i class="fas fa-plus-square"></i></i>
              <span>Add major crime</span></a>
          </div>
          <div class="card-body bg-danger">
            <h5 class="card-title">Total Crimes: </h5>
            <p class="card-text">
              <?= $total_major_crimes; ?>
            </p>
          </div>
        </div>

        <div class="card text-white mb-3 col-md-4 col-sm-6" style="max-width: 18rem;">
          <div class="card-header">
            <a href="" class="btn btn-outline-success add-icon"><i class="fas fa-plus-square"></i></i>
              <span>Add minor crime</span></a>
          </div>
          <div class="card-body bg-success">
            <h5 class="card-title">Total Minor Crimes: </h5>
            <p class="card-text">
              <?= $total_minor_crimes; ?>
            </p>
          </div>
        </div>

        <div class="card text-white mb-3 col-md-4 col-sm-6" style="max-width: 18rem;">
          <div class="card-header">
            <a href="" class="btn btn-outline-primary add-icon"><i class="fas fa-plus-square"></i></i>
              <span>Add ongoing case</span></a>
          </div>
          <div class="card-body bg-primary">
            <h5 class="card-title">Total Ongoing Cases: </h5>
            <p class="card-text">
              <?= $total_ongoing_cases; ?>
            </p>
          </div>
        </div>

        <div class="card text-white mb-3 col-md-4 col-sm-6" style="max-width: 18rem;">
          <div class="card-header">
            <a href="" class="btn btn-outline-dark add-icon"><i class="fas fa-plus-square"></i></i>
              <span>Add deadbody details</span></a>
          </div>
          <div class="card-body bg-dark">
            <h5 class="card-title">Total Dead Bodies: </h5>
            <p class="card-text">
              <?= $total_dead_bodies; ?>
            </p>
          </div>
        </div>

        <div class="card text-white mb-3 col-md-4 col-sm-6" style="max-width: 18rem;">
          <div class="card-header">
            <a href="" class="btn btn-outline-warning add-icon"><i class="fas fa-plus-square"></i></i>
              <span>Add police station</span></a>
          </div>
          <div class="card-body bg-warning">
            <h5 class="card-title">Total Police Stations: </h5>
            <p class="card-text">
              <?= $total_police_stations; ?>
            </p>
          </div>
        </div>

        <div class="card text-white mb-3 col-md-4 col-sm-6" style="max-width: 18rem;">
          <div class="card-header">
            <a href="create_user.php" class="btn btn-outline-info add-icon"><i class="fas fa-plus-square"></i></i>
              <span>Add user</span></a>
          </div>
          <div class="card-body bg-info">
            <h5 class="card-title">Total Users: </h5>
            <p class="card-text">
              <?= $total_users; ?>
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>

</main>


<?php include('../footer.php'); ?>

</body>

</html>