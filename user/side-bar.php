<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">Daily Station Report (User Panel)</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
       
    <li class="nav-item">
            <a href="user.php" class="nav-link active" aria-current="page">
               User Dashboard
            </a>
        </li>
       
        <li>
            <a href="dead_body_form.php" class="nav-link link-dark">
                Dead Body
            </a>
        </li>
       
        <li>
            <a href="major_crime_form.php" class="nav-link link-dark">
                Major Crime
            </a>
        </li>
       
        <li>
            <a href="ongoing_case_form.php" class="nav-link link-dark">
                Ongoing Case
            </a>
        </li>

        <li>
            <a href="minor_crime_form.php" class="nav-link link-dark">
                Minor Crime
            </a>
        </li>

        <li>
            <a class="nav-link link-dark" href="feedback.php">
                Feedback
            </a>
        </li>   
       
        <li>
            <a href="profile.php" class="nav-link link-dark">
                Profile
            </a>
        </li>
       
        <li>
            <a href="change_password.php" class="nav-link link-dark">
                Change Password
            </a>
        </li>
       
        
    </ul>
    <hr>
    <div class="profile">
        <img src="<?= $_SESSION['user-data']['profile_photo_path']; ?>" alt="Profile Pic" width="32" height="32"
            class="rounded-circle me-2">
        <strong>
            <?= $_SESSION['user-data']['officer_name']; ?>
        </strong>
        <a href="../auth/logout.php" class="btn btn-outline-danger m-2" name="logout">Log Out</a>
    </div>
</div>