<?php
session_start();
require 'conn.php';

if(isset($_POST['update_info']))
{
    $members_id = mysqli_real_escape_string($con, $_POST['members_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $year = mysqli_real_escape_string($con, $_POST['year']);

    $query = "UPDATE members  SET name='$name', surname='$surname', year='$year' WHERE id='$members_id' ";
    
    $query_run = mysqli_query($con,$query);
    if($query_run)
    {
        
        $_SESSION['alert'] = "updated successfully!!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        
        $_SESSION['alert'] = "Error";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['save_info']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $year = mysqli_real_escape_string($con, $_POST['year']);

    $query = "INSERT INTO members (name,surname,year) VALUES ('$name','$surname','$year')";

    $query_run = mysqli_query($con,$query);
    if($query_run)
    {
        $_SESSION['alert'] = " added successfully!!";
        header("Location: member.php");
        exit(0);
    }
    else    
    {
        $_SESSION['alert'] = "Error";
        header("Location: member.php");
        exit(0);
    }
}

if (isset($_POST['submit_status'])) {
    // Ensure that the 'student_id' and 'status' are set in the POST data
    if (isset($_POST['student_id']) && isset($_POST['status'])) {
        // Escape each element of the arrays
        $student_ids = array_map(function($id) use ($con) {
            return mysqli_real_escape_string($con, $id);
        }, $_POST['student_id']);

        $statuses = array_map(function($status) use ($con) {
            return mysqli_real_escape_string($con, $status);
        }, $_POST['status']);

        // Now you can use $student_ids and $statuses in your queries
        for ($i = 0; $i < count($student_ids); $i++) {
            $query = "UPDATE members SET status = '{$statuses[$i]}' WHERE id = '{$student_ids[$i]}'";
            $query_run = mysqli_query($con, $query);
        }

        if ($query_run) {
            $_SESSION['alert'] = "Checked successfully!!";
        } else {
            $_SESSION['alert'] = "Error: " . mysqli_error($con);
        }

        header("Location: attendance.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Error: Student ID or Status not provided.";
        header("Location: attendance.php");
        exit(0);
    }
}
?>

if(isset($_POST['delete_student'])){

    $members_id=mysqli_real_escape_string($con,$_POST['delete_student']);

    $query = "DELETE FROM members WHERE id='$members_id'";
    $query_run = mysqli_query($con,$query);
    
    if($query_run)
    {
        $_SESSION['alert'] = " deleted successfully!!";
        header("Location: index.php");
        exit(0);
    }
    else    
    {
        $_SESSION['alert'] = "Error";
        header("Location: index.php");
        exit(0);
    }
}
?>