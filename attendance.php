<?php
    session_start();
    
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

    require 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style/index.css">
    <title>Attendance System</title>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">STUDENT LIST</a></li>
            <li><a href="attendance.php">ATTENDANCE</a></li>
            <li><a href="">LOG OUT</a></li>
        </ul>
        <nav class="navbar1">
            <div class="container-fluid">
            </div>
        </nav>
    </nav>

    <div class="container mt-5">
        <?php include('alert.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student details</h4>
                    </div>

                    <h4><div class="well tex-center"> Date: <?php echo date ("Y-m-d")?></div></h4>
                    <div class="card-body">
                        <form action="dib.php" method="POST">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Year level</th>
                                        <th>Attendance status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM members";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $members) {
                                    ?>
                                            <tr>
                                                <td><?= $members['id']; ?></td>
                                                <td><?= $members['name']; ?></td>
                                                <td><?= $members['surname']; ?></td>
                                                <td><?= $members['year']; ?></td>
                                                <td>
                                                    <input type="hidden" name="student_id[]" value="<?= $members['id']; ?>">
                                                    <select name="status[]" required>
                                                        <option value="present">Present</option>
                                                        <option value="absent">Absent</option>
                                                    </select>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No records found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <button type="submit" name="submit_status" class="btn btn-success float-end">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
