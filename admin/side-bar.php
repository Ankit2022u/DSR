<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">Daily Station Report (Admin Panel)</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="admin.php" class="nav-link active" aria-current="page">
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