<?php
session_start();
require "../api/dbcon.php";
require "../api/functions.php";
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
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Log Files</div>
                </div>
                <div class="card-body">
                    <div class="table-container" style="width:auto; height:70vh; overflow: scroll;">
                        <table class="table table-bordered table-stripped">
                            <thead>
                                <tr>
                                    <th>Serial Number</th>
                                    <th>Table Name</th>
                                    <th>Table ID</th>
                                    <th>Operation</th>
                                    <th>Description</th>
                                    <th>Log By</th>
                                    <th>Log Date</th>
                                    <th>Log Time</th>
                                    <th>When?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query1 = "SELECT * FROM logs ORDER BY created_at";
                                $stmt1 = mysqli_prepare($con, $query1);
                                mysqli_stmt_execute($stmt1);
                                $query_run1 = mysqli_stmt_get_result($stmt1);

                                if (mysqli_num_rows($query_run1) > 0) {
                                    while ($log = mysqli_fetch_assoc($query_run1)) {
                                ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($log['lid']); ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars(ucfirst($log['table_name'])); ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($log['table_id']); ?>
                                    </td>
                                    <td class="text-<?php
                                                            if ($log['operation'] == "insert") {
                                                                echo "success";
                                                            } else if ($log['operation'] == "update") {
                                                                echo "primary";
                                                            } else if ($log['operation'] == "delete") {
                                                                echo "danger";
                                                            } else if ($log['operation'] == "login") {
                                                                echo "warning";
                                                            } else {
                                                                echo "dark";
                                                            }
                                                            ?>">
                                        <?= htmlspecialchars(ucfirst($log['operation'])); ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($log['log_desc']); ?>
                                    </td>
                                    <td>
                                        <?php
                                                $user = $log['created_by'];
                                                $query2 = "SELECT * FROM users WHERE user_id = ?";
                                                $stmt2 = mysqli_prepare($con, $query2);
                                                mysqli_stmt_bind_param($stmt2, "s", $user);
                                                mysqli_stmt_execute($stmt2);
                                                $query_run2 = mysqli_stmt_get_result($stmt2);
                                                $officer = mysqli_fetch_array($query_run2)['officer_name']; ?>
                                        <?= htmlspecialchars($officer); ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars((new DateTime($log['created_at']))->format('Y-m-d')); ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars((new DateTime($log['created_at']))->format('H:i:s')); ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars(getTimeAgo($log['created_at'])); ?>
                                    </td>

                                </tr>
                                <?php
                                    }
                                } else {
                                    echo "No Records Found";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
</main>

<!-- place footer here -->
<?php include('../footer.php'); ?>

</body>

</html>