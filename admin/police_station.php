<?php
session_start();
require "../api/dbcon.php";
?>

<header>
    <!-- place navbar here -->
    <?php include('admin_header.php'); ?>
</header>

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
                            Dashboard /डैशबोर्ड
                        </a>
                    </li>
                    <li>
                        <a href="manage_user.php" class="nav-link link-dark">
                            Manage Users / उपयोगकर्ताओं का प्रबंधन
                        </a>
                    </li>
                    <li>
                        <a href="view_logs.php" class="nav-link link-dark">
                            View Logs /लॉग्स को देखें
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
                        <a href="police_station.php" class="nav-link active">
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
            <div class="container d-flex flex-column">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <?php
                        if (isset($_SESSION['message']) && isset($_SESSION['type'])) {
                            $type = htmlspecialchars($_SESSION['type'], ENT_QUOTES, 'UTF-8'); // Sanitize the 'type' value
                            $message = htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8'); // Sanitize the 'message' value
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
                            <div class="mb-3 mt-5">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="district" id="district"
                                        onchange="update_police_stations()" required>
                                        <option value="सरगुजा">सरगुजा</option>
                                        <option value="बलरामपुर">बलरामपुर</option>
                                        <option value="सूरजपुर">सूरजपुर</option>
                                        <option value="मनेंद्रगढ़-चिरमीरी-भरतपुर">मनेंद्रगढ़-चिरमीरी-भरतपुर</option>
                                        <option value="जशपुर">जशपुर</option>
                                        <option value="कोरिया">कोरिया</option>
                                    </select>
                                    <label for="district">District / ज़िला<span class="required-star">*</span></label>
                                </div>
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
                                <div class="mb-3">

                                    <label for="police_station" class="form-label">Police Station</label>
                                    <span class="required-star">*</span>
                                    <input type="text" id="police_station" class="form-control" name="police_station"
                                        placeholder="Enter Police Station" required>
                                </div>

                                <div class="mb-3 d-grid">
                                    <button type="submit" class="btn btn-primary" name="add_police_station">
                                        Add Police Station
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>

<!-- place footer here -->
<?php include('../footer.php'); ?>

</body>

</html>