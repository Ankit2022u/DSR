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
                        <a href="view_data.php" class="nav-link link-dark">
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
                        <a href="micf.php" class="nav-link active">
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
                $type = htmlspecialchars($_SESSION['type'], ENT_QUOTES, 'UTF-8'); // Sanitize the 'type' value
                $message = htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8'); // Sanitize the 'message' value
            ?>
                <div class="alert alert-<?= $type; ?> alert-dismissible fade show" role="alert">
                    <strong>Important: </strong>
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
                                    <option value="">Select Option</option>
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
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="crimeNumber" type="text" placeholder="Crime Number" name="crime_number" />

                                <label for="crimeNumber">Crime Number / अपराध क्रमांक</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="penal_code" id="section" required>

                                    <option value="41(1) जा. फौ">41(1) जा. फौ</option>
                                    <option value="102 जा. फौ">102 जा. फौ</option>
                                    <option value="109 जा. फौ">109 जा. फौ</option>
                                    <option value="110 जा. फौ">110 जा. फौ</option>
                                    <option value="145 जा. फौ">145 जा. फौ</option>
                                    <option value="151 जा. फौ">151 जा. फौ</option>
                                    <option value="107,116 जा. फौ">107,116 जा. फौ</option>
                                    <option value="जुआ एक्ट">जुआ एक्ट</option>
                                    <option value="सट्टा">सट्टा</option>
                                    <option value="आब. एक्ट">आब. एक्ट</option>
                                    <option value="नारको">नारको</option>
                                    <option value="आर्म्स. एक्ट">आर्म्स. एक्ट</option>
                                    <option value="एम. वी. एक्ट">एम. वी. एक्ट</option>

                                </select>
                                <label for="section">Section / धारा<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <span><strong>In MV Act enter amount instead of no of peoples | एम. वी. एक्ट में व्यक्तियों की
                                संख्या के जगह राशि अंकित करे</strong></span>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="culpritNumber" type="number" placeholder="Culprit Name" name="culprit_number" required />
                                <label for="culpritNumber">No of Peoples | Amount / व्यक्तियों की संख्या | राशि<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="firWriter" type="text" placeholder="FIR Writer" name="fir_writer" />
                                <label for="firWriter">FIR Writer / कायमीकर्ता</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="incidentDate" type="date" placeholder="Incident Date" name="incident_date" required />
                                <label for="incidentDate">Incident Date / घटना दिनांक<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="incidentTime" type="time" placeholder="Incident Time" name="incident_time" />
                                <label for="incidentTime">Incident Time / घटना समय</label>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <button class="btn btn-primary" type="submit" name="save_minor_crime">Save Crime</button>
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