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

                                <input class="form-control" id="diedBodyNumber" type="text"
                                    placeholder="Died Body Number" name="dead_body_number" required />

                                <label for="diedBodyNumber">Dead Body Number / मर्ग क्रमांक<span
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
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="accidentDate" type="date" placeholder="Accident Date"
                                    name="accident_date" required />

                                <label for="accidentDate">Accident Date / घटना दिनांक<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="accidentTime" type="time" placeholder="Accident Time"
                                    name="accident_time" />

                                <label for="accidentDate">Accident Time / घटना का समय</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="accidentPlace" type="text" placeholder="Accident Place"
                                    name="accident_place" required />

                                <label for="accidentPlace">Accident Place / घटना स्थल<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="informationDate" type="date"
                                    placeholder="Information Date" name="information_date" required />
                                <label for="informationDate">Information Date / सूचना दिनांक<span
                                        class="required-star">*</span></label>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="informationTime" type="time"
                                    placeholder="Information Time" name="information_time" />
                                <label for="informationTime">Information Time / सूचना का समय</label>s
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">


                                <input class="form-control" id="applicant" type="text" placeholder="Applicant Name"
                                    name="applicant_name" required />
                                <label for="applicantName">Applicant Name / सूचक का नाम<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="deceased" type="text" placeholder="Deceased"
                                    name="deceased_name" required />

                                <label for="deceasedName">Deceased Name / मृतक का नाम<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="firWriter" type="text" placeholder="FIR Writer"
                                    name="fir_writer" required lang="hi" dir="auto" />

                                <label for="firWriter">FIR Writer / कायमीकर्ता<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="causeOfDeath" type="text"
                                    placeholder="Cause Of Death" style="height: 10rem;"
                                    name="cause_of_death"></textarea>
                                <label for="causeOfDeath">Cause Of Death / मृत्यु का कारण</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 float-end">
                            <button type="submit" name="save_deadbody" class="btn btn-primary">Save Deadbody</button>
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