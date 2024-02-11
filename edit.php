<?php
session_start();
require 'conn.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Information edit</title>
  </head>
  <body>


        <div class="container mt-5">
            <?php include('alert.php'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Edit member
                                <a href="index.php" class="btn btn-danger float-end">BACK</a>
                            </h2>
                        </div>
                        <div class="card-body">
                            <?php
                            if(isset($_GET['id']))
                            {
                                $members_id = mysqli_real_escape_string($con,$_GET['id']);
                                $query = "SELECT * FROM members WHERE id='$members_id'";
                                $query_run = mysqli_query($con, $query);
                                
                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    $members = mysqli_fetch_array($query_run);
                                    ?>
                                    
                                 
                            <form action="dib.php" method="POST">
                            <input type="hidden" name="members_id" value="<?=$members['id']?>">
                            <div class="mb-3">
                                <label>Name</label>
                               <input type="text" name="name" value="<?= $members['name']?>" class="form-control">
                            </div>
                             <div class="mb-3">
                                <label>Surname</label>
                               <input type="text" name="surname" value="<?= $members['surname']?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Year Level</label>
                               <input type="year" name="year" value="<?= $members['year']?>" class="form-control">
                            </div>
                        
                            <div class="div mb-3">
                                <button type="submit" name="update_info" class="btn btn-primary">Update Information</button>
                            </div>

                            </form>
                                
                                <?php
                                 }
                                else
                                {
                                    echo "<h4> No Such Id found </h4>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>