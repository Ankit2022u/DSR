<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";
$police_stations = police_stations();
?>

<!-- place navbar here -->
<?php include('user_header.php'); ?>

<main>
    <div class="row">
        <?php
        // Define the active page variable based on the current page
        $active_page = basename($_SERVER['PHP_SELF'], ".php");
        // Include the side-bar.php file
        include 'side-bar.php';
        ?>

        <div class="main-content container col-md-9 col-sm-7">

            <!-- Crimes -->
            <div class="card" id="crime_card" style="display: none;">
                <div class="card-header">
                    <div class="card-title">Crime Files
                        <button id="deadbodyButton" class="btn btn-primary float-end">Dead Bodies</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-container" style="width:auto; height:70vh; overflow: scroll;">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th style="text-align:center" class='col-3'>Name</th>
                                    <th style="text-align:center" class='col-6'>Data</th>
                                    <th style="text-align:center" class='col-3'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM major_crimes ORDER BY created_at DESC";

                                $stmt = mysqli_prepare($con, $query);
                                mysqli_stmt_execute($stmt);
                                $query_run = mysqli_stmt_get_result($stmt);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <ul type='None'>
                                                    <li>
                                                        <strong>District: </strong>
                                                    </li>
                                                    <li>
                                                        <strong>Crime Number: </strong>
                                                    </li>
                                                    <li>
                                                        <strong>Penal Code: </strong>
                                                    </li>
                                                    <li>
                                                        <strong>Applicant Name: </strong>
                                                    </li>
                                                    <li>
                                                        <strong>Culprit Name: </strong>
                                                    </li>
                                                    <li>
                                                        <strong>Status: </strong>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul type='None'>
                                                    <li>
                                                        <?= htmlspecialchars($row['district']); ?>
                                                    </li>
                                                    <li>
                                                        <?= htmlspecialchars($row['crime_number']); ?>
                                                    </li>
                                                    <li>
                                                        <?= htmlspecialchars($row['penal_code']); ?>
                                                    </li>
                                                    <li>
                                                        <?= htmlspecialchars($row['applicant_name']); ?>
                                                    </li>
                                                    <li>
                                                        <?= htmlspecialchars($row['culprit_name']); ?>
                                                    </li>
                                                    <li>
                                                        <?php if ($row['status'] === 1) {
                                                            echo '<span class="badge text-bg-success">Disposed</span>';
                                                            $color = "danger";
                                                        } elseif ($row['status'] === 2) {
                                                            echo '<span class="badge text-bg-primary">Re-opened</span>';
                                                            $color = "success";
                                                        } else {
                                                            echo '<span class="badge text-bg-warning">Pending</span>';
                                                            $color = "success";
                                                        } ?>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td style="text-align: center; vertical-align:middle;">
                                                <form action="disposal_status.php" method="post" class="d-inline">
                                                    <button type="submit" name="change_status_crime"
                                                        value="<?= htmlspecialchars($row['cid']); ?>"
                                                        class="btn btn-<?= $color; ?>">
                                                        <?php if ($row['status'] === 1) {
                                                            echo 'Re-open';
                                                        } else {
                                                            echo 'Dispose';
                                                        } ?>
                                                    </button>
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

            <!-- Deadbodies -->
            <div class="card" id="deadbody_card">
                <div class="card-header">
                    <div class="card-title">Deadbody Files
                        <button id="crimeButton" class="btn btn-primary float-end">Crimes</button>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-container" style="width:auto; height:70vh; overflow: scroll;">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th style="text-align:center" class='col-3'>Name</th>
                                    <th style="text-align:center" class='col-6'>Data</th>
                                    <th style="text-align:center" class='col-3'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM dead_bodies ORDER BY created_at DESC";

                                $stmt = mysqli_prepare($con, $query);
                                mysqli_stmt_execute($stmt);
                                $query_run = mysqli_stmt_get_result($stmt);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <ul type='None'>
                                                    <li>
                                                        <strong>District: </strong>
                                                    </li>
                                                    <li>
                                                        <strong>Deadbody Number: </strong>
                                                    </li>
                                                    <li>
                                                        <strong>Penal Code: </strong>
                                                    </li>
                                                    <li>
                                                        <strong>Applicant Name: </strong>
                                                    </li>
                                                    <li>
                                                        <strong>Deceased Name: </strong>
                                                    </li>
                                                    <li>
                                                        <strong>Status: </strong>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul type='None'>
                                                    <li>
                                                        <?= htmlspecialchars($row['district']); ?>
                                                    </li>
                                                    <li>
                                                        <?= htmlspecialchars($row['dead_body_number']); ?>
                                                    </li>
                                                    <li>
                                                        <?= htmlspecialchars($row['penal_code']); ?>
                                                    </li>
                                                    <li>
                                                        <?= htmlspecialchars($row['applicant_name']); ?>
                                                    </li>
                                                    <li>
                                                        <?= htmlspecialchars($row['deceased_name']); ?>
                                                    </li>
                                                    <li>
                                                        <?php if ($row['status'] === 1) {
                                                            echo '<span class="badge text-bg-success">Disposed</span>';
                                                            $color = "danger";
                                                        } elseif ($row['status'] === 2) {
                                                            echo '<span class="badge text-bg-primary">Re-opened</span>';
                                                            $color = "success";
                                                        } else {
                                                            echo '<span class="badge text-bg-warning">Pending</span>';
                                                            $color = "success";
                                                        } ?>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td style="text-align: center; vertical-align:middle;">
                                                <form action="disposal_status.php" method="post" class="d-inline">
                                                    <button type="submit" name="change_status_deadbody"
                                                        value="<?= htmlspecialchars($row['dbid']); ?>"
                                                        class="btn btn-<?= $color; ?>">
                                                        <?php if ($row['status'] === 1) {
                                                            echo 'Re-open';
                                                        } else {
                                                            echo 'Dispose';
                                                        } ?>
                                                    </button>
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
</main>


<!-- place footer here -->
<?php include('../footer.php'); ?>
<script src="../assets/js/police_station.js"></script>
<script src="../assets/js/disposal.js"></script>

</body>

</html>