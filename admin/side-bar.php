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
                <a href="admin.php" <?php if ($active_page === 'admin') {
                                        echo
                                        'class="nav-link active"';
                                    } else {
                                        echo 'class="nav-link link-dark"';
                                    }  ?>>
                    Dashboard / डैशबोर्ड
                </a>
            </li>
            <li>
                <a href="manage_user.php" <?php if ($active_page === 'manage_user') {
                                                echo
                                                'class="nav-link active"';
                                            } else {
                                                echo 'class="nav-link link-dark"';
                                            }  ?>>
                    Manage Users / उपयोगकर्ताओं का प्रबंधन
                </a>
            </li>
            <li>
                <a href="view_logs.php" <?php if ($active_page === 'view_logs') {
                                            echo
                                            'class="nav-link active"';
                                        } else {
                                            echo 'class="nav-link link-dark"';
                                        }  ?>>
                    View Logs / लॉग्स को देखें
                </a>
            </li>
            <li>
                <a href="view_data.php" <?php if ($active_page === 'view_data') {
                                            echo
                                            'class="nav-link active"';
                                        } else {
                                            echo 'class="nav-link link-dark"';
                                        }  ?>>
                    View Data / डेटा का हिसाब
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
                <a href="police_station.php" <?php if ($active_page === 'police_station') {
                                                    echo
                                                    'class="nav-link active"';
                                                } else {
                                                    echo 'class="nav-link link-dark"';
                                                }  ?>>
                    Police Station / थाना
                </a>
            </li>
            <li>
                <a href="profile.php" <?php if ($active_page === 'profile') {
                                            echo
                                            'class="nav-link active"';
                                        } else {
                                            echo 'class="nav-link link-dark"';
                                        }  ?>>
                    View Profile / प्रोफाइल
                </a>
            </li>
            <li>
                <a href="dbf.php" <?php if ($active_page === 'dbf') {
                                        echo
                                        'class="nav-link active"';
                                    } else {
                                        echo 'class="nav-link link-dark"';
                                    }  ?>>

                    Inquest / मर्ग
                </a>
            </li>
            <li>
                <a href="mcf.php" <?php if ($active_page === 'mcf') {
                                        echo
                                        'class="nav-link active"';
                                    } else {
                                        echo 'class="nav-link link-dark"';
                                    }  ?>>
                    Major Crime / गंभीर अपराध
                </a>
            </li>
            <li>
                <a href="micf.php" <?php if ($active_page === 'micf') {
                                        echo
                                        'class="nav-link active"';
                                    } else {
                                        echo 'class="nav-link link-dark"';
                                    }  ?>>

                    Minor Crime / सामान्य अपराध
                </a>
            </li>
            <li>
                <a href="ocf.php" <?php if ($active_page === 'ocf') {
                                        echo
                                        'class="nav-link active"';
                                    } else {
                                        echo 'class="nav-link link-dark"';
                                    }  ?>>
                    Active Case / सक्रिय मामला
                </a>
            </li>
            <li>
                <a href="cjf.php" <?php if ($active_page === 'cjf') {
                                        echo
                                        'class="nav-link active"';
                                    } else {
                                        echo 'class="nav-link link-dark"';
                                    }  ?>>
                    Court judgement / कोर्ट का निर्णय
                </a>
            </li>

            <li>
                <a href="iaf.php" <?php if ($active_page === 'iaf') {
                                        echo
                                        'class="nav-link active"';
                                    } else {
                                        echo 'class="nav-link link-dark"';
                                    }  ?>>
                    Important Achievements / मुख्य उपलब्धियां
                </a>
            </li>

            <li>
                <a href="disposal.php" <?php if ($active_page === 'disposal') {
                                            echo
                                            'class="nav-link active"';
                                        } else {
                                            echo 'class="nav-link link-dark"';
                                        }  ?>>
                    Disposals / निकाल
                </a>
            </li>

        </ul>
    </div>
    <hr>
    <div class="profile">
        <img src="../uploads/<?= $_SESSION['user-data']['user_type']; ?>/<?= $_SESSION['user-data']['profile_photo_path']; ?>" alt="Profile Pic" width="32" height="32" class="rounded-circle me-2">
        <strong>
            <?= $_SESSION['user-data']['officer_name']; ?>
        </strong>
        <a href="../auth/logout.php" class="btn btn-outline-danger m-2" name="logout">Log Out</a>
    </div>
</div>