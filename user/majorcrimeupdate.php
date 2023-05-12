<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";
$police_stations = police_stations();

$cid = mysqli_real_escape_string($con, $_GET['cid']);
$stmt = mysqli_prepare($con, "SELECT * FROM major_crimes WHERE cid=?");
mysqli_stmt_bind_param($stmt, "i", $cid);
mysqli_stmt_execute($stmt);
$query_run = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_array($query_run);



?>

<header>
    <!-- place navbar here -->
    <?php include('user_header.php'); ?>
</header>

<main>
    <div class="row">
        <div class="side-bar col-md-3 col-sm-5">
            <?php //include('side-bar.php'); 
            ?>
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                <!-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Daily Station Report (User Panel)</span>
                </a>
                <hr> -->
                <ul class="nav nav-pills flex-column mb-auto">

                    <li class="nav-item">
                        <a href="user.php" class="nav-link link-dark" aria-current="page">
                            User Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="dead_body_form.php" class="nav-link link-dark">
                            Dead Body
                        </a>
                    </li>

                    <li>
                        <a href="major_crime_form.php" class="nav-link link-dark">
                            Major Crime
                        </a>
                    </li>

                    <li>
                        <a href="ongoing_case_form.php" class="nav-link link-dark">
                            Ongoing Case
                        </a>
                    </li>

                    <li>
                        <a href="minor_crime_form.php" class="nav-link link-dark">
                            Minor Crime
                        </a>
                    </li>

                    <li>
                        <a class="nav-link active" href="edit.php">
                            Edit
                        </a>
                    </li>


                    <li>
                        <a class="nav-link link-dark" href="feedback.php">
                            Feedback
                        </a>
                    </li>

                    <li>
                        <a href="profile.php" class="nav-link link-dark">
                            Profile
                        </a>
                    </li>

                    <li>
                        <a href="change_password.php" class="nav-link link-dark">
                            Change Password
                        </a>
                    </li>


                </ul>
                <hr>
                <div class="profile">

                    <img src="../uploads/<?= $_SESSION['user-data']['user_type']; ?>/<?= $_SESSION['user-data']['profile_photo_path']; ?>" alt="Profile Pic" width="32" height="32" class="rounded-circle me-2">
                    <strong>
                        <?= $_SESSION['user-data']['officer_name']; ?>
                    </strong>
                    <a href="../auth/logout.php" class="btn btn-outline-danger m-2" name="logout">Log Out</a>
                </div>
            </div>
        </div>

        <div class="main-content col-md-9 col-sm-7">
            <?php
            if (isset($_SESSION['message'])) {
                $type = htmlspecialchars($_SESSION['type']);
                $message = htmlspecialchars($_SESSION['message']);
            ?>
                <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                    <strong>Hye!</strong>
                    <?= $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['message']);
            }
            ?>
            <form action="../api/form_submissions.php" method="post">
                <div class="container px-5 my-5">

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="crimeNumber" type="text" placeholder="Crime Number" name="crime_number" value="<?= $data['crime_number'] ?>" required />

                                <label for="crimeNumber">Crime Number<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="section" type="text" placeholder="Section" name="penal_code" value="<?= $data['penal_code'] ?>" required />

                                <label for="section">Section<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="applicantName" type="text" placeholder="Applicant Name" name="applicant_name" value="<?= $data['applicant_name'] ?>" required />

                                <label for="applicantName">Applicant Name<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="applicantAddress" type="text" placeholder="Applicant Address" name="applicant_address" value="<?= $data['applicant_address'] ?>" required />
                                <label for="applicantAddress">Applicant Address<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="incidentDate" type="date" placeholder="Incident Date" name="incident_date" value="<?= $data['incident_date'] ?>" required />

                                <label for="incidentDate">Incident Date<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="incidentTime" type="time" placeholder="Incident Time" name="incident_time" value="<?= $data['incident_time'] ?>" />
                                <label for="incidentTime">Incident Time</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="incidentPlace" type="text" placeholder="Incident Place" name="incident_place" value="<?= $data['incident_place'] ?>" required />
                                <label for="incidentPlace">Incident Place<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="reportTime" type="time" placeholder="Report Time" name="reporting_time" value="<?= $data['reporting_time'] ?>" />
                                <label for="reportTime">Report Time</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="reportDate" type="date" placeholder="Report Date" name="reporting_date" value="<?= $data['reporting_date'] ?>" required />
                                <label for="reportDate">Report Date<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="firWriter" type="text" placeholder="FIR Writer" name="fir_writer" value="<?= $data['fir_writer'] ?>" required />
                                <label for="firWriter">FIR Writer<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="culpritName" type="text" placeholder="Culprit Name" name="culprit_name" value="<?= $data['culprit_name'] ?>" required />
                                <label for="culpritName">Culprit Name<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="culpritAddress" type="text" placeholder="Culprit Address" name="culprit_address" value="<?= $data['culprit_address'] ?>" required />
                                <label for="culpritAddress">Culprit Address<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="arrestDate" type="date" placeholder="Arrest Date" name="arrest_date" value="<?= $data['arrest_date'] ?>" required />
                                <label for="arrestDate">Arrest Date<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="arrestTime" type="time" placeholder="Arrest Time" name="arrest_time" value="<?= $data['arrest_time'] ?>" />
                                <label for="arrestTime">Arrest Time</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="victimName" type="text" placeholder="Victim Name" name="victim_name" value="<?= $data['victim_name'] ?>" />
                                <label for="victimName">Victim Name</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" id="isItAMajorCrime" type="checkbox" name="is_major_crime" />
                                    <label class="form-check-label" for="isItAMajorCrime">Is it a major crime ?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="descriptionOfCrime" type="text" placeholder="Description of Crime" style="height: 10rem;" name="description_of_crime" required><?= $data['description_of_crime']; ?></textarea>
                                <label for="descriptionOfCrime">Description of Crime<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <button class="btn btn-primary" type="submit" name="update_majorcrimes">Update Major
                                Crime</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</main>


<!-- place footer here -->
<?php include('../footer.php'); ?>
<script src="../assets/js/police_station.js"></script>

</body>

</html>