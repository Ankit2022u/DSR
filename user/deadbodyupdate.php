<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";
$police_stations = police_stations();

$dbid = mysqli_real_escape_string($con, $_GET['dbid']);
$stmt = mysqli_prepare($con, "SELECT * FROM dead_bodies WHERE dbid=?");
mysqli_stmt_bind_param($stmt, "i", $dbid);
mysqli_stmt_execute($stmt);
$query_run = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_array($query_run);

// // Form Data Submitted
// if (isset($_POST["update_deadbody"])) {

//     $dead_body_number = mysqli_real_escape_string($con, $_POST['dead_body_number']);
//     $penal_code = mysqli_real_escape_string($con, $_POST['penal_code']);
//     $accident_date = mysqli_real_escape_string($con, $_POST['accident_date']);
//     $accident_place = mysqli_real_escape_string($con, $_POST['accident_place']);
//     $information_date = mysqli_real_escape_string($con, $_POST['information_date']);
//     $information_time = mysqli_real_escape_string($con, $_POST['information_time']);
//     $applicant_name = mysqli_real_escape_string($con, $_POST['applicant_name']);
//     $deceased_name = mysqli_real_escape_string($con, $_POST['deceased_name']);
//     $fir_writer = mysqli_real_escape_string($con, $_POST['fir_writer']);
//     $cause_of_death = mysqli_real_escape_string($con, $_POST['cause_of_death']);
//     $updated_by = $_SESSION['user-data']['user_id'];

//     // Validate input fields
//     $errors = array();
//     if (empty($dead_body_number)) {
//         $errors[] = "Dead Body Number is required.";
//     }
//     if (empty($penal_code)) {
//         $errors[] = "Section Number is required.";
//     }
//     if (empty($accident_date)) {
//         $errors[] = "Accident Date is required.";
//     }
//     if (empty($accident_place)) {
//         $errors[] = "Accident Place is required.";
//     }
//     if (empty($information_date)) {
//         $errors[] = "Information Date is required.";
//     }
//     if (empty($applicant_name)) {
//         $errors[] = "Applicant Name is required.";
//     }
//     if (empty($deceased_name)) {
//         $errors[] = "Deceased Name is required.";
//     }
//     if (empty($fir_writer)) {
//         $errors[] = "Fir Writer Name is required.";
//     }

//     // Incorrect | Not working
//     if (empty($errors)) {
//         // Prepare and bind parameters to prevent SQL injection
//         if (empty($errors)) {
//             // Prepare and bind parameters to prevent SQL injection
//             $stmt = $con->prepare("UPDATE dead_bodies SET  dead_body_number = ?, penal_code = ?, accident_date = ?, accident_place = ?, information_date = ?, information_time = ?, applicant_name = ?, deceased_name = ?, fir_writer = ?, cause_of_death = ?, updated_by = ? WHERE dbid = ?");
//             $stmt->bind_param("sssssssssssi", $dead_body_number, $penal_code, $accident_date, $accident_place, $information_date, $information_time, $applicant_name, $deceased_name, $fir_writer, $cause_of_death, $updated_by, $dbid);
//             $query_run = $stmt->execute();

//             if ($query_run) {
//                 $user = $_SESSION['user-data']['user_id'];
//                 // Prepare and bind parameters for log query
//                 $log_query = $con->prepare("INSERT INTO logs (status, created_by, table_name, table_id, operation, log_desc) VALUES (?, ?, ?, ?, ?, ?)");
//                 $status = 1;
//                 $operation = 'update';
//                 $log_desc = 'Dead Body Number ' . $data['dead_body_number'] . ' is Updated';
//                 $table_name = 'dead_bodies';
//                 $log_query->bind_param("ssssss", $status, $user, $table_name, $dbid, $operation, $log_desc);
//                 $log_query->execute();

//                 $_SESSION['message'] = "Deadbody data submitted successfully";
//                 $_SESSION['type'] = "success";
//                 header("Location: ../user/edit.php");
//                 exit(0);
//             } else {
//                 $_SESSION['message'] = "Deadbody data submission failed";
//                 $_SESSION['type'] = "danger";
//                 header("Location: ../user/edit.php");
//                 exit(0);
//             }
//         } else {
//             $_SESSION['message'] = $errors[0];
//             $_SESSION['type'] = "warning";
//             header("Location: ../user/edit.php");
//         }
//     } else {
//         $_SESSION['message'] = $errors[0];
//         $_SESSION['type'] = "warning";
//         header("Location: ../user/edit.php");
//         exit(0);
//     }
// }

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
                        <a href="ongoing_case_form.php" class="nav-link link-dark">
                            Ongoing Case / सक्रिय मामला
                        </a>
                    </li>

                    <li>
                        <a href="minor_crime_form.php" class="nav-link link-dark">
                            Minor Crime / सामान्य अपराध
                        </a>
                    </li>
                    <li>
                        <a class="nav-link active" href="edit.php">
                            Edit / एडिट
                        </a>
                    </li>


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
            <form action="deadbodyupdate.php" method="post">
                <div class="container px-5 my-5">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="diedBodyNumber" type="text" placeholder="Died Body Number" name="dead_body_number" required value="<?= $data['dead_body_number']; ?>" />

                                <label for="diedBodyNumber">Dead Body Number<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="section" type="text" placeholder="Section" name="penal_code" required value="<?= $data['penal_code']; ?>" />
                                <label for="section">Section<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="accidentDate" type="date" placeholder="Accident Date" name="accident_date" required value="<?= $data['accident_date']; ?>" />

                                <label for="accidentDate">Accident Date<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="accidentPlace" type="text" placeholder="Accident Place" name="accident_place" required value="<?= $data['accident_place']; ?>" />

                                <label for="accidentPlace">Accident Place<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="informationDate" type="date" placeholder="Information Date" name="information_date" required value="<?= $data['information_date']; ?>" />
                                <label for="informationDate">Information Date<span class="required-star">*</span></label>

                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="informationTime" type="time" placeholder="Information Time" name="information_time" value="<?= $data['information_time']; ?>" />
                                <label for="informationTime">Information Time</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-floating mb-3">

                                <input class="form-control" id="applicant" type="text" placeholder="Applicant Name" name="applicant_name" required value="<?= $data['applicant_name']; ?>" />
                                <label for="applicantName">Applicant Name<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="deceased" type="text" placeholder="Deceased" name="deceased_name" required value="<?= $data['deceased_name']; ?>" />

                                <label for="deceasedName">Deceased Name<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="firWriter" type="text" placeholder="FIR Writter" name="fir_writer" required value="<?= $data['fir_writer']; ?>" />

                                <label for="firWriter">FIR Writer<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="causeOfDeath" type="text" placeholder="Cause Of Death" style="height: 10rem;" name="cause_of_death"><?= $data['cause_of_death']; ?></textarea>
                                <label for="causeOfDeath">Cause Of Death</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 float-end">
                            <button type="submit" name="update_deadbody" class="btn btn-primary">Update
                                Deadbody</button>
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