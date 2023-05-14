<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">Daily Station Report (User Panel)</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
<<<<<<< HEAD
       
    <li class="nav-item">
            <a href="user.php" class="nav-link active" aria-current="page">
               User Dashboard / डैशबोर्ड
=======

        <li class="nav-item">
            <a href="user.php" class="nav-link link-dark" aria-current="page">
                User Dashboard
>>>>>>> 42d7c262d56c128f63d0f1236219623eaa3dc39a
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
<<<<<<< HEAD
            <a href="minor_crime_form.php" class="nav-link link-dark">
                Minor Crime / सामान्य अपराध
=======
            <a href="minor_crime_form.php" class="nav-link active">
                Minor Crime
>>>>>>> 42d7c262d56c128f63d0f1236219623eaa3dc39a
            </a>
        </li>
        <!-- <li>
                        <a class="nav-link link-dark" href="edit.php">
                            Edit
                        </a>
                    </li> -->


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

        <li>
            <a href="court_judgement_form.php" class="nav-link link-dark">
                Court Judgement
            </a>
        </li>

        <li>
            <a href="impotant_achievements_form.php" class="nav-link link-dark">
                Important Achievements
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