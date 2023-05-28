<?php
session_start();
require "../api/dbcon.php";
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