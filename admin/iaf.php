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
        <?php
        // Define the active page variable based on the current page
        $active_page = basename($_SERVER['PHP_SELF'], ".php");
        // Include the side-bar.php file
        include 'side-bar.php';
        ?>

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
                                    <option value="">Select Option</option>
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
                                <select class="form-select" id="subDivision" aria-label="Sub Division"
                                    name="sub_division" required>

                                    <option value="Option1">Option1</option>
                                    <option value="Option2">Option2</option>
                                    <option value="Option3">Option3</option>
                                </select>
                                <label for="subDivision">Sub Division / अनुभाग<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="police_station" id="police_station" required>

                                    <option value="">Select Option</option>

                                </select>
                                <label for="policeStation">Police Station / थाना<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <!-- <textarea class="form-control" id="causeOfDeath" type="text" placeholder="Cause Of Death" style="height: 10rem;" name="cause_of_death"></textarea> -->

                                <textarea class="form-control" id="arrest_in_major_crime" type="text"
                                    placeholder="गंभीर अपराधों में गिरफ्तारि / महत्वपूर्ण गिरफ्तारि"
                                    name="arrest_in_major_crime" style="height: 5rem;"></textarea>
                                <label for="policeStation">गंभीर अपराधों में गिरफ्तारि / महत्वपूर्ण गिरफ्तारि</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">

                                <select class="form-select" id="decision_given_by_the_court"
                                    aria-label="decision_given_by_the_court" name="decision_given_by_the_court"
                                    required>
                                    <option value="">Select Option</option>
                                    <option value="जमानत">जमानत</option>
                                    <option value="जमानत रद्द">जमानत रद्द</option>
                                    <option value="सजा">सजा</option>
                                    <option value="दोष">दोष</option>
                                    <option value="दोष मुक्त">दोष मुक्त</option>
                                </select>

                                <label for="decision_given_by_the_court">कोर्ट द्वारा दिए गये निर्णय<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="missingManDocument" type="text"
                                    placeholder="आपरेशन मुस्कान / गुम इंसान दस्तायी" name="missing_man_document"
                                    style="height: 5rem;"></textarea>
                                <label for="missing_man_document">आपरेशन मुस्कान / गुम इंसान दस्तायी</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="miscellaneous" type="text"
                                    placeholder="विविध जैसे जन जागरुकता अभियान मे विशेष सफलता या प्राण रक्षा, गिरफ्तारी वारंटो की तमिलि आदि"
                                    style="height: 5rem;" name="miscellaneous"></textarea>

                                <label for="miscellaneous">विविध जैसे जन जागरुकता अभियान मे विशेष सफलता या प्राण रक्षा,
                                    गिरफ्तारी वारंटो की तमिलि आदि</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="robbery" type="text"
                                    placeholder="डकैती / लुट / चोरी का खुलासा" name="robbery"
                                    style="height: 5rem;"></textarea>

                                <label for="robbery">डकैती / लुट / चोरी का खुलासा</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="actionTakenUnder" type="text"
                                    placeholder="धारा 102 के तहत कि गई कार्यवाही" style="height: 5rem;"
                                    name="action_taken_under"></textarea>

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
<!-- <script type="text/javascript">
onLoad();
</script> -->

</body>

</html>