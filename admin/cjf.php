<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";
$police_stations = police_stations();
?>

<!-- place navbar here -->
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
                        <a href="view_data.php" class="nav-link link-dark">
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
                    <li>
                        <a href="cjf.php" class="nav-link active">
                            Court judgement
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

        <div class="main-content col-md-9 col-sm-7">
            <?php
            if (isset($_SESSION['message']) && isset($_SESSION['type'])) {
                $message = $_SESSION['message'];
                $type = $_SESSION['type'];

                // Sanitize message and type to prevent XSS attacks
                $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
                $type = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');

                ?>
                <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                    <strong>Hey!</strong>
                    <?= $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            }
            ?>
            <form action="../api/form_submissions.php" method="post">
                <div class="container px-5 my-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="district" id="district"
                                    onchange="update_police_stations()" required>
                                    <option value="Surguja">सरगुजा</option>
                                    <option value="Balrampur">Balrampur</option>
                                    <option value="Surajpur">Surajpur</option>
                                    <option value="Manendragarh-Chirmiri-Bharatpur">Manendragarh-Chirmiri-Bharatpur
                                    </option>
                                    <option value="Jashpur">Jashpur</option>
                                    <option value="Korea">Korea</option>
                                </select>
                                <label for="district">District / जिला<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="subDivision" aria-label="Sub Division"
                                    name="sub_division" required>

                                    <option value="Option1">Option1</option>
                                    <option value="Option2">Option2</option>
                                    <option value="Option3">Option3</option>
                                </select>
                                <label for="subDivision">अनुभाग<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="police_station" id="police_station" required>

                                    <option value="">Select Option</option>

                                </select>
                                <label for="policeStation">Police Station / पुलिस थाना<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nameOfCourt" type="text" placeholder="Name Of Court"
                                    name="name_of_court" required />
                                <label for="nameOfCourt">Name Of Court / न्यायालय का नाम<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="section" type="text" placeholder="Section"
                                    name="penal_code" required />
                                <label for="section">Section / धारा<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="resultDate" type="date" placeholder="Result Date"
                                    name="result_date" required />

                                <label for="resultDate">Result Date / कयमी दिनांक<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="crimeNumber" type="text" placeholder="Crime Number"
                                    name="crime_number" required />

                                <label for="crimeNumber">Crime Number / अपराध क्रमांक<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="applicantName" type="text" placeholder="Applicant Name"
                                    name="applicant_name" required />

                                <label for="applicantName">Applicant Name / प्रार्थी का नाम<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="applicantAddress" type="text"
                                    placeholder="Applicant Address" name="applicant_address" required />
                                <label for="applicantAddress">Applicant Address / प्रार्थी का पता<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="judgementOfCourt" type="text"
                                    placeholder="Judgement of Court" name="judgement_of_court" required />
                                <label for="judgementOfCourt">Judgement Of Court / न्यायालय का फैसला<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 float-end">
                            <button type="submit" name="save_court_judgement" class="btn btn-primary">Save Court
                                Judgement</button>
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
<!-- <script type="text/javascript">
onLoad();
</script> -->

</body>

</html>