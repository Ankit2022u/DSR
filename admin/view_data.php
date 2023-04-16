<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";

$police_stations = police_stations();

if (!(isset($_SESSION['user-data']))) {
    header("Location: ../index.php");
}

?>
<?php include('admin_header.php'); ?>
<main>
    <div class="row">

        <div class="side-bar col-md-3 col-sm-5">
            <?php include('side-bar.php'); ?>
        </div>

        <div class="main-content container col-md-9 col-sm-7">
            <?php
            if (isset($_SESSION['message'])) {
                ?>
                <div class="alert alert-<?= $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                    <strong>Hye!</strong>
                    <?= $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                unset($_SESSION['message']);
            }
            ?>
            <form action="display_data.php" method="post">
                <div class="container px-5 my-5">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="district" aria-label="District" name="district">
                                    <option value="All">All</option>
                                    <option value="Surguja">Surguja</option>
                                    <option value="Balrampur">Balrampur</option>
                                    <option value="Surajpur">Surajpur</option>
                                    <option value="Manendragarh-Chirmiri-Bharatpur">Manendragarh-Chirmiri-Bharatpur
                                    </option>
                                    <option value="Jashpur">Jashpur</option>
                                    <option value="Korea">Korea</option>
                                </select>
                                <label for="district">District<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="policeStation" aria-label="Police Station"
                                    name="police_station">
                                    <option value="All">All</option>
                                    <?php foreach ($police_stations as $option) {
                                        ?>
                                        <option value="<?= $option['police_station']; ?>"><?= $option['police_station']; ?>
                                        </option>
                                        <?php
                                    } ?>
                                </select>
                                <label for="policeStation">Police Station<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="startDate" type="date" placeholder="Start Date"
                                    name="start_date" />
                                <label for="startDate">Starting Date<span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="endDate" type="date" placeholder="End Date"
                                    name="end_date" />
                                <label for="endDate">Ending Date<span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <fieldset class="border p-2">
                            <legend class="float-none w-auto p-2">Information You Want<span
                                    class="required-star">*</span></legend>
                            <div class="col-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="deadBodiesDetails" type="checkbox"
                                            name="dead_bodies" />
                                        <label class="form-check-label" for="deadBodiesDetails">Deadbody Details</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="ongoingCasesDetails" type="checkbox"
                                            name="ongoing_cases" />
                                        <label class="form-check-label" for="ongoingCasesDetails">Ongoing Cases
                                            Details</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="majorCrimesDetails" type="checkbox"
                                            name="major_crimes" />
                                        <label class="form-check-label" for="majorCrimesDetails">Major Crime
                                            Details</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" id="minorCrimesDetails" type="checkbox"
                                            name="minor_crimes" />
                                        <label class="form-check-label" for="minorCrimesDetails">Minor Crime
                                            Details</label>
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

            </form>

        </div>
    </div>

</main>


<?php include('../footer.php'); ?>

</body>

</html>