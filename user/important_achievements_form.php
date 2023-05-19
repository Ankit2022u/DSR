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
                        <a href="ongoing_case_form.php" class="nav-link link-dark">
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
                        <a href="court_judgement_form.php" class="nav-link link-dark">
                            Court Judgement / कोर्ट का निर्णय
                        </a>
                    </li>

                    <li>
                        <a href="important_achievements_form.php" class="nav-link active">
                            Important Achievements / महत्वपूर्ण कार्यवाह
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
                                <select class="form-select" name="district" id="district" onchange="update_police_stations()" required>
                                    <option value="">Select option </option>
                                    <option value="सरगुजा">सरगुजा</option>
                                    <option value="बलरामपुर">बलरामपुर</option>
                                    <option value="सूरजपुर">सूरजपुर</option>
                                    <option value="मनेंद्रगढ़-चिरमीरी-भरतपुर">मनेंद्रगढ़-चिरमीरी-भरतपुर</option>
                                    <option value="जशपुर">जशपुर</option>
                                    <option value="कोरिया">कोरिया</option>
                                </select>
                                <label for="district">District / जिला<span class="required-star">*</span></label>
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
                                <label for="policeStation">Police Station / थाना<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <!-- <textarea class="form-control" id="causeOfDeath" type="text" placeholder="Cause Of Death" style="height: 10rem;" name="cause_of_death"></textarea> -->

                                <textarea class="form-control" id="arrest_in_major_crime" type="text" placeholder="गंभीर अपराधों में गिरफ्तारि / महत्वपूर्ण गिरफ्तारि" name="arrest_in_major_crime" style="height: 5rem;"></textarea>
                                <label for="policeStation">गंभीर अपराधों में गिरफ्तारि / महत्वपूर्ण गिरफ्तारि</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">

                                <select class="form-select" id="decision_given_by_the_court" aria-label="decision_given_by_the_court" name="decision_given_by_the_court" required>
                                    <option value="">Select Option</option>
                                    <option value="जमानत">जमानत</option>
                                    <option value="जमानत रद्द">जमानत रद्द</option>
                                    <option value="सजा">सजा</option>
                                    <option value="दोष">दोष</option>
                                    <option value="दोष मुक्त">दोष मुक्त</option>
                                </select>
                                <label for="decision_given_by_the_court">कोर्ट द्वारा दिए गये निर्णय</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="missingManDocument" type="text" placeholder="आपरेशन मुस्कान / गुम इंसान दस्तायी" name="missing_man_document" style="height: 5rem;"></textarea>
                                <label for="missing_man_document">आपरेशन मुस्कान / गुम इंसान दस्तायी</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="miscellaneous" type="text" placeholder="विविध जैसे जन जागरुकता अभियान मे विशेष सफलता या प्राण रक्षा, गिरफ्तारी वारंटो की तमिलि आदि" style="height: 5rem;" name="miscellaneous"></textarea>

                                <label for="miscellaneous">विविध जैसे जन जागरुकता अभियान मे विशेष सफलता या प्राण
                                    रक्षा,गिरफ्तारी वारंटो की तमिलि आदि</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="robbery" type="text" placeholder="डकैती / लुट / चोरी का खुलासा" name="robbery" style="height: 5rem;"></textarea>

                                <label for="robbery">डकैती / लुट / चोरी का खुलासा</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="actionTakenUnder" type="text" placeholder="धारा 102 के तहत कि गई कार्यवाही" style="height: 5rem;" name="action_taken_under"></textarea>

                                <label for="action_taken_under">धारा 102 के तहत कि गई कार्यवाही</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-12 float-end">
                                <button type="submit" name="save_important_achievement" class="btn btn-primary">Save
                                    Important
                                    Achievement</button>
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