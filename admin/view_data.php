<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";

$police_stations = police_stations();

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
}

?>
<?php
include('admin_header.php'); ?>
<main>
    <div class="row">

        <?php
        // Define the active page variable based on the current page
        $active_page = basename($_SERVER['PHP_SELF'], ".php");
        // Include the side-bar.php file
        include 'side-bar.php';
        ?>
        <div class="main-content container col-md-9 col-sm-7">
            <?php
            if (isset($_SESSION['message'])) {
            ?>
            <div class="alert alert-<?= $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                <strong>Information: </strong>
                <?= $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset($_SESSION['message']);
            }
            ?>
            <!-- <form action="display_data.php" method="post">
                <div class="container px-5 my-5">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="district" id="district"
                                    onchange="update_police_stations()" required>
                                    <option value="All">समस्त</option>
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
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="police_station" id="police_station" required>

                                    <option value="">Select Option</option>
                                    <option value="All">समस्त</option>

                                </select>
                                <label for="policeStation">Police Station / पुलिस थाना<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="startDate" type="date" placeholder="Start Date"
                                    name="start_date" required />

                                <label for="startDate">Starting Date / शुरुवाती तिथि<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="endDate" type="date" placeholder="End Date"
                                    name="end_date" required />
                                <label for="endDate">Ending Date / अंतिम तिथि<span
                                        class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <fieldset class="border p-2">
                            <legend class="float-none w-auto p-2">Information You Want / किस तरह की जानकारी आपको चाहिए
                                ?<span class="required-star">*</span></legend>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="deadBodiesDetails" type="checkbox"
                                            name="dead_bodies" />
                                        <label class="form-check-label" for="deadBodiesDetails">Deadbody Details (मर्ग
                                            संबंधी जानकारी)</label>
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

                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="importantAchievement" type="checkbox"
                                            name="important_achievements" />
                                        <label class="form-check-label" for="importantAchievement">Important
                                            Achievements ( महत्वपूर्ण कार्यवाही )</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="courtJudgement" type="checkbox"
                                            name="court_judgements" />
                                        <label class="form-check-label" for="courtJudgement">Court Judgements ( कोर्ट का
                                            निर्णय )</label>
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
            </form> -->

            <form action="../api/download.php" method="post" id="downloadForm">
                <div class="row">

                    <!-- DSR Date-->
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="dsrDate" type="date" placeholder="DSR Date" name="dsr_date"
                                required />

                            <label for="dsrDate">Date / तिथि<span class="required-star">*</span></label>
                        </div>
                    </div>

                    <!-- District -->
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="district" id="district" required>
                                <option value="All">समस्त</option>
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

                    <!-- Document Type -->
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="document_type" id="documentType" required>
                                <option value="All">समस्त</option>
                                <option value="Summary">Summary()</option>
                                <option value="Application">Application()</option>
                                <option value="MinorCrime">Minor Crimes()</option>
                                <option value="MajorCrime">Major Crimes()</option>
                                <option value="Crime">Crimes()</option>
                                <option value="Deadbody">Deadbodies()</option>
                                <option value="Achievement">Achievements()</option>
                                <option value="Judgement">Court Judgements()</option>
                                <option value="Disposal">Disposals()</option>
                            </select>
                            <label for="documentType">Document Type / दस्तावेज़ का प्रकार<span
                                    class="required-star">*</span></label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12">

                        <label for="doc_format">Select Format / दस्तावेज़ का फॉर्मेट<span
                                class="required-star">*</span></label>
                        <select name="doc_format" id="doc_format" class="form-select">
                            <option value="excel">Excel</option>
                            <option value="pdf">PDF</option>
                        </select>


                    </div>

                    <div class="d-flex justify-content-end">
                        <div class="p-2">
                            <button type="submit" class="btn btn-primary" name="download">Download</button>
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