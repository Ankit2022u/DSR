<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";

$police_stations = police_stations();

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
}

?>
<?php include('admin_header.php'); ?>
<main>
    <div class="row">

        <div class="side-bar col-md-3 col-sm-5">
            <?php //include('side-bar.php'); 
            ?>
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                <!-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Daily Station Report (Admin Panel)</span>
                </a>
                <hr> -->
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link link-dark" aria-current="page">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="manage_user.php" class="nav-link link-dark">
                            Manage Users
                        </a>
                    </li>
                    <li>
                        <a href="view_logs.php" class="nav-link link-dark">
                            View Logs
                        </a>
                    </li>
                    <li>
                        <a href="view_data.php" class="nav-link active">
                            View Data
                        </a>
                    </li>
                    <li>
                        <a href="change_password.php" class="nav-link link-dark">
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="police_station.php" class="nav-link link-dark">
                            Police Stations
                        </a>
                    </li>
                    <li>
                        <a href="profile.php" class="nav-link link-dark">
                            View Profile
                        </a>
                    </li>
                    <li>
                        <a href="dbf.php" class="nav-link link-dark">
                            Dead Body Form
                        </a>
                    </li>
                    <li>
                        <a href="mcf.php" class="nav-link link-dark">
                            Major Crime Form
                        </a>
                    </li>
                    <li>
                        <a href="micf.php" class="nav-link link-dark">
                            Minor Crime Form
                        </a>
                    </li>
                    <li>
                        <a href="ocf.php" class="nav-link link-dark">
                            Ongoing Case Form
                        </a>
                    </li>

                </ul>
                <hr>
                <div class="profile">
                    <img src="../uploads/<?= $_SESSION['user-data']['user_type']; ?>/<?= $_SESSION['user-data']['profile_photo_path']; ?>"
                        alt="Profile Pic" width="32" height="32" class="rounded-circle me-2">
                    <strong>
                        <?= $_SESSION['user-data']['officer_name']; ?>
                    </strong>
                    <a href="../auth/logout.php" class="btn btn-outline-danger m-2" name="logout">Log Out</a>
                </div>
            </div>
        </div>

        <div class="main-content container col-md-9 col-sm-7">
            <?php
            if (isset($_SESSION['message'])) {
                ?>
                <div class="alert alert-<?= $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                    <strong>Hye!</strong>
                    <?= $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_SESSION['message']);
            }
            ?>
            <form action="display_data.php" method="post">
                <div class="container px-5 my-5">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="district" id="district"
                                    onchange="update_police_stations()" required>
                                    <option value="All">All</option>
                                    <option value="Surguja">Surguja</option>
                                    <option value="Balrampur">Balrampur</option>
                                    <option value="Surajpur">Surajpur</option>
                                    <option value="Manendragarh-Chirmiri-Bharatpur">Manendragarh-Chirmiri-Bharatpur
                                    </option>
                                    <option value="Jashpur">Jashpur</option>
                                    <option value="Korea">Korea</option>
                                </select>
                                <label for="district">District / ज़िला<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                            <select class="form-select" name="police_station" id="police_station"
                                    required>

                                    <option value="">Select Option</option>
                                    <option value="All">All</option>

                                </select>
                                <label for="policeStation">Police Station / पुलिस थाना<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="startDate" type="date" placeholder="Start Date"
                                    name="start_date" required />

                                <label for="startDate">Starting Date / शुरुवाती तिथि<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="endDate" type="date" placeholder="End Date"
                                    name="end_date" required />
                                <label for="endDate">Ending Date / अंतिम तिथि<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <fieldset class="border p-2">
                            <legend class="float-none w-auto p-2">Information You Want / किस तरह की जानकारी आपको चाहिए ?<span
                                    class="required-star">*</span></legend>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="deadBodiesDetails" type="checkbox"
                                            name="dead_bodies" />
                                        <label class="form-check-label" for="deadBodiesDetails">Deadbody Details (मर्ग संबंधी जानकारी)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="ongoingCasesDetails" type="checkbox"
                                            name="ongoing_cases" />
                                        <label class="form-check-label" for="ongoingCasesDetails">Ongoing Cases
                                            Details (चल रहे मुकदमे संबंधी जानकारी)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="majorCrimesDetails" type="checkbox"
                                            name="major_crimes" />
                                        <label class="form-check-label" for="majorCrimesDetails">Major Crime
                                            Details (गंभीर अपराध संबंधी जानकारी)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="minorCrimesDetails" type="checkbox"
                                            name="minor_crimes" />
                                        <label class="form-check-label" for="minorCrimesDetails">Minor Crime
                                            Details (सामान्य अपराध संबंधी जानकारी)</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="row mt-1">
                        <div class="d-flex justify-content-end">
                            <div class="p-2">
                                <button type="submit" class="btn btn-primary" name="view">View Data</button>
                            </div>
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>

</main>


<?php include('../footer.php'); ?>
<script src="../assets/js/police_station.js"></script>

</body>

</html>