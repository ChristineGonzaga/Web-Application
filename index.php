<?php
    session_start();
    require 'conn.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style/index.css">
    <title>Document</title>
  </head>
  <body>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">STUDENT LIST</a></li>
            <li><a href="attendance.php">ATTENDANCE</a></li>
            <li><a href="logout.php">LOG OUT</a></li>
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
                    <h4>Student details
                        <a href="member.php" class="btn btn-primary float-end">Add Student</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>name</th>
                                <th>surname</th>
                                <th>Year level</th>
                                <th>status</th>
                                <th>date</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $query = "SELECT * FROM members";
                             $query_run = mysqli_query($con, $query);
                             if(mysqli_num_rows($query_run) >0)
                             {
                                foreach($query_run as $members)
                                {
                                    ?>
                                                
                                      <tr>
                                          <td><?= $members['id'];?></td>
                                          <td><?= $members['name'];?></td>
                                          <td><?= $members['surname'];?></td>
                                          <td><?= $members['year'];?></td> 
                                          <td><?= $members['status'];?></td> 
                                          <td><?= $members['date'];?></td>
                                          <td>
                                            <a href="edit.php?id=<?= $members['id'];?>" class ="btn btn-success btn-sm">Edit</a>
                                            <form action="dib.php" method="POST" class="d-inline">
                                            <button type="submit" name="delete_student"value="<?= $members['id'];?>"class ="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                          </td>
                                      </tr>
                                    <?php
                                }
                             }
                             else
                             {
                                echo" <h5> No record found <?h5>";
                             }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>