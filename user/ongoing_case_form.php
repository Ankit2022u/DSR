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
                                <label for="district">District / ज़िला<span class="required-star">*</span></label>
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
                                <label for="policeStation">Police Station / पुलिस थाना<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="crimeNumber" type="text" placeholder="Crime Number"
                                    name="crime_number" required />
                                <label for="crimeNumber">Crime Number / अपराध क्रमांक<span
                                        class="required-star">*</span></label>
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
                                <label for="firDate">FIR Date / एफ.आई.आर. का दिनाक<span
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
                                <input class="form-control" id="culpritName" type="text" placeholder="Culprit Name"
                                    name="culprit_name" required />
                                <label for="culpritName">Culprit Name / आरोपी/संदिग्ध का नाम<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="culpritAddress" type="text"
                                    placeholder="Culprit Address" name="culprit_address" required />
                                <label for="culpritAddress">Culprit Address / आरोपी/संदिग्ध का पता<span
                                        class="required-star">*</span></label>
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
                                <label for="judgementOfCourt">Judgement Of Court / न्यायालय के फैसले का संक्षिप्त
                                    विवरण</label>
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