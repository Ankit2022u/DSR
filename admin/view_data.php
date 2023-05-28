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

        <div class="side-bar col-md-3 col-sm-5">
            <?php //include('side-bar.php'); ?>
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light">
                <!-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Daily Station Report (Admin Panel)</span>
                </a>
                <hr> -->
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link link-dark" aria-current="page">
                            Dashboard / डैशबोर्ड
                        </a>
                    </li>
                    <li>
                        <a href="manage_user.php" class="nav-link link-dark">
                            Manage Users / उपयोगकर्ताओं का प्रबंधन
                        </a>
                    </li>
                    <li>
                        <a href="view_logs.php" class="nav-link link-dark">
                            View Logs / लॉग्स को देखें
                        </a>
                    </li>
                    <li>
                        <a href="view_data.php" class="nav-link active">
                            View Data / डेटा का हिसाब
                        </a>
                    </li>
                    <li>
                        <a href="change_password.php" class="nav-link link-dark">
                            Change Password / पासवर्ड को बदले
                        </a>
                    </li>
                    <li>
                        <a href="police_station.php" class="nav-link link-dark">
                            Police Stations / थाना
                        </a>
                    </li>
                    <li>
                        <a href="profile.php" class="nav-link link-dark">
                            View Profile / प्रोफाइल
                        </a>
                    </li>
                    <li>
                        <a href="dbf.php" class="nav-link link-dark">
                            Inquest / मर्ग
                        </a>
                    </li>
                    <li>
                        <a href="mcf.php" class="nav-link link-dark">
                            Major Crime / गंभीर अपराध
                        </a>
                    </li>
                    <li>
                        <a href="micf.php" class="nav-link link-dark">
                            Minor Crime / सामान्य अपराध
                        </a>
                    </li>
                    <li>
                        <a href="ocf.php" class="nav-link link-dark">
                            Ongoing Case / सक्रिय मामला
                        </a>
                    </li>

                    <li>
                        <a href="cjf.php" class="nav-link link-dark">
                            Court judgement / कोर्ट का निर्णय
                        </a>
                    </li>

                    <li>
                        <a href="iaf.php" class="nav-link link-dark">
                            Important Achievements / मुख्य उपलब्धियां
                        </a>
                    </li>
                    
                    <li>
                        <a href="disposal.php" class="nav-link link-dark">
                            Disposals / निकाल 
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

                        <label>Select Format / दस्तावेज़ का फॉर्मेट<span class="required-star">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="doc_format" id="excel" value="excel">
                            <label class="form-check-label" for="excel">Excel</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="doc_format" id="pdf" value="pdf">
                            <label class="form-check-label" for="pdf">PDF</label>
                        </div>

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