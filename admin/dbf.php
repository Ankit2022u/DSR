<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";
$police_stations = police_stations();
?>

<header>
    <!-- place navbar here -->
    <?php include('admin_header.php'); ?>
</header>

<main>
    <div class="row">
        <div class="side-bar col-md-3 col-sm-5">
            <?php include('side-bar.php'); ?>
        </div>

        <div class="main-content col-md-9 col-sm-7">
            <?php
            if (isset($_SESSION['message'])):
                ?>
                <div class="alert alert-<?= $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                    <strong>Hye!</strong>
                    <?= $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_SESSION['message']);
            endif;
            ?>
            <form action="../api/form_submissions.php" method="post">
                <div class="container px-5 my-5">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="district" aria-label="District" name="district">
                                    <option value="Surguja">Surguja</option>
                                    <option value="Balrampur">Balrampur</option>
                                    <option value="Surajpur">Surajpur</option>
                                    <option value="Manendragarh-Chirmiri-Bharatpur">Manendragarh-Chirmiri-Bharatpur
                                    </option>
                                    <option value="Jashpur">Jashpur</option>
                                    <option value="Korea">Korea</option>
                                </select>
                                <label for="district">District</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="subDivision" aria-label="Sub Division"
                                    name="sub_division">
                                    <option value="Option1">Option1</option>
                                    <option value="Option2">Option2</option>
                                    <option value="Option3">Option3</option>
                                </select>
                                <label for="subDivision">Sub Division</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="policeStation" aria-label="Police Station"
                                    name="police_station">
                                    <?php foreach ($police_stations as $option) {
                                        ?><option value="<?= $option['police_station']; ?>"><?= $option['police_station']; ?></option>
                                        <?php
                                    } ?>
                                </select>
                                <label for="policeStation">Police Station</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="diedBodyNumber" type="text"
                                    placeholder="Died Body Number" name="dead_body_number" />
                                <label for="diedBodyNumber">Dead Body Number</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="section" type="text" placeholder="Section"
                                    name="penal_code" />
                                <label for="section">Section</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="accidentDate" type="date" placeholder="Accident Date"
                                    name="accident_date" />
                                <label for="accidentDate">Accident Date</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="accidentPlace" type="text" placeholder="Accident Place"
                                    name="accident_place" />
                                <label for="accidentPlace">Accident Place</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="informationDate" type="date"
                                    placeholder="Information Date" name="information_date" />
                                <label for="informationDate">Information Date</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="informationTime" type="time"
                                    placeholder="Information Time" name="information_time" />
                                <label for="informationTime">Information Time</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="applicant" type="text" placeholder="Applicant Name"
                                    name="applicant_name" />
                                <label for="applicantName">Applicant Name</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="deceased" type="text" placeholder="Deceased"
                                    name="deceased_name" />
                                <label for="deceasedName">Deceased Name</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="firWritter" type="text" placeholder="FIR Writter"
                                    name="fir_writer"/>
                                <label for="firWriter">FIR Writer</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="causeOfDeath" type="text"
                                    placeholder="Cause Of Death" style="height: 10rem;"
                                    name="cause_of_death"></textarea>
                                <label for="causeOfDeath">Cause Of Death</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 float-end">
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

</body>

</html>