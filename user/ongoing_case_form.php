<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";
$police_stations = police_stations();

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
                            User Dashboard / डैशबोर्ड
                        </a>
                    </li>

                    <li>
                        <a href="dead_body_form.php" class="nav-link link-dark">
                             Inquest / मर्ग
                        </a>
                    </li>

                    <li>
                        <a href="major_crime_form.php" class="nav-link link-dark">
                            Major Crime / गंभीर अपराध
                        </a>
                    </li>

                    <li>
                        <a href="ongoing_case_form.php" class="nav-link active">
                            Ongoing Case / सक्रिय मामला
                        </a>
                    </li>

                    <li>
                        <a href="minor_crime_form.php" class="nav-link link-dark">
                            Minor Crime / सामान्य अपराध
                        </a>
                    </li>

                    <!-- <li>
                        <a class="nav-link link-dark" href="edit.php">
                            Edit
                        </a>
                    </li> -->

                    <li>
                        <a class="nav-link link-dark" href="feedback.php">
                            Feedback / फीडबैक
                        </a>
                    </li>

                    <li>
                        <a href="profile.php" class="nav-link link-dark">
                            Profile / प्रोफाइल
                        </a>
                    </li>

                    <li>
                        <a href="change_password.php" class="nav-link link-dark">
                            Change Password / पासवर्ड को बदले
                        </a>
                    </li>

                    <li>
                        <a href="imp_action.php" class="nav-link link-dark">
                            Important Actions / महत्वपूर्ण कार्यवाही
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
                $type = $_SESSION['type'];
                $message = $_SESSION['message'];
                unset($_SESSION['message']); // Remove session data after use to prevent data leaks
            ?>
                <div class="alert alert-<?php echo htmlspecialchars($type); ?> alert-dismissible fade show" role="alert">
                    <strong>Hye!</strong>
                    <?php echo htmlspecialchars($message); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }
            ?>
            <form action="../api/form_submissions.php" method="post">
                <div class="container px-5 my-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="district" id="district" onchange="update_police_stations()" required>
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
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="subDivision" aria-label="Sub Division" name="sub_division" required>
                                    <option value="Option1">Option1</option>
                                    <option value="Option2">Option2</option>
                                    <option value="Option3">Option3</option>
                                </select>
                                <label for="subDivision">Sub Division / अनुभाग<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="police_station" id="police_station" required>

                                    <option value="">Select Option</option>

                                </select>
                                <label for="policeStation">Police Station / पुलिस थाना<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="crimeNumber" type="text" placeholder="Crime Number"
                                    name="crime_number" required />
                                <label for="crimeNumber">Crime Number / अपराध क्रमांक<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="section" type="text" placeholder="Section"
                                    name="penal_code" required />
                                <label for="section">Section / धारा<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="firDate" type="date" placeholder="FIR Date"
                                    name="fir_date" required />
                                <label for="firDate">FIR Date / एफ.आई.आर. का दिनाक<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="nameOfCourt" type="text" placeholder="Name Of Court"
                                    name="name_of_court" required />
                                <label for="nameOfCourt">Name Of Court / न्यायालय का नाम<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="culpritName" type="text" placeholder="Culprit Name"
                                    name="culprit_name" required />
                                <label for="culpritName">Culprit Name / आरोपी/संदिग्ध का नाम<span class="required-star">*</span></label>              </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="culpritAddress" type="text"
                                    placeholder="Culprit Address" name="culprit_address" required />
                                <label for="culpritAddress">Culprit Address / आरोपी/संदिग्ध का पता<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="caseStatus" aria-label="Case Status" name="case_status">
                                    <option value="Option1">Option1</option>
                                    <option value="Option2">Option2</option>
                                    <option value="Option3">Option3</option>
                                </select>
                                <label for="caseStatus">Case status / प्ररण की अद्यतन स्थिति</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="judgementOfCourt" type="text"
                                    placeholder="Judgement Of Court" style="height: 10rem;"
                                    name="judgement_of_court"></textarea>
                                <label for="judgementOfCourt">Judgement Of Court / न्यायालय के फैसले का संक्षिप्त विवरण</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <button class="btn btn-primary" type="submit" name="save_ongoing_case">Save Ongoing
                                Case</button>
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