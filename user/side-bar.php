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
                <a href="user.php" <?php if ($active_page === 'user') {
                                        echo
                                        'class="nav-link active"';
                                    } else {
                                        echo 'class="nav-link link-dark"';
                                    }  ?>>
                    User Dashboard / डैशबोर्ड
                </a>
            </li>

            <li>
                <a href="dead_body_form.php" <?php if ($active_page === 'dead_body_form') {
                                                    echo
                                                    'class="nav-link active"';
                                                } else {
                                                    echo 'class="nav-link link-dark"';
                                                }  ?>>
                    Inquest / मर्ग
                </a>
            </li>

            <li>
                <a href="major_crime_form.php" <?php if ($active_page === 'major_crime_form') {
                                                    echo
                                                    'class="nav-link active"';
                                                } else {
                                                    echo 'class="nav-link link-dark"';
                                                }  ?>>
                    Major Crime / गंभीर अपराध
                </a>
            </li>

            <li>
                <a href="ongoing_case_form.php" <?php if ($active_page === 'ongoing_case_form') {
                                                    echo
                                                    'class="nav-link active"';
                                                } else {
                                                    echo 'class="nav-link link-dark"';
                                                }  ?>>
                    Ongoing Case / सक्रिय मामला
                </a>
            </li>

            <li>
                <a href="minor_crime_form.php" <?php if ($active_page === 'minor_crime_form') {
                                                    echo
                                                    'class="nav-link active"';
                                                } else {
                                                    echo 'class="nav-link link-dark"';
                                                }  ?>>
                    Minor Crime / सामान्य अपराध
                </a>
            </li>
            <!-- <li>
                        <a class="nav-link link-dark" href="edit.php">
                            Edit
                        </a>
                    </li> -->


            <li>
                <a href="feedback.php" <?php if ($active_page === 'feedback') {
                                            echo
                                            'class="nav-link active"';
                                        } else {
                                            echo 'class="nav-link link-dark"';
                                        }  ?>>
                    Feedback / फीडबैक
                </a>
            </li>

            <li>
                <a href="profile.php" <?php if ($active_page === 'profile') {
                                            echo
                                            'class="nav-link active"';
                                        } else {
                                            echo 'class="nav-link link-dark"';
                                        }  ?>>
                    Profile / प्रोफाइल
                </a>
            </li>

            <li>
                <a href="change_password.php" <?php if ($active_page === 'change_password') {
                                                    echo
                                                    'class="nav-link active"';
                                                } else {
                                                    echo 'class="nav-link link-dark"';
                                                }  ?>>
                    Change Password / पासवर्ड को बदले
                </a>
            </li>

            <li>
                <a href="court_judgement_form.php" <?php if ($active_page === 'court_judgement_form') {
                                                        echo
                                                        'class="nav-link active"';
                                                    } else {
                                                        echo 'class="nav-link link-dark"';
                                                    }  ?>>
                    Court Judgement / कोर्ट का निर्णय
                </a>
            </li>

            <li>
                <a href="important_achievements_form.php" <?php if ($active_page === 'important_achievements_form') {
                                                                echo
                                                                'class="nav-link active"';
                                                            } else {
                                                                echo 'class="nav-link link-dark"';
                                                            }  ?>>
                    Important Achievements / महत्वपूर्ण कार्यवाही
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