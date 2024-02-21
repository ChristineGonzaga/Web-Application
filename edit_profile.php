<?php
session_start();

if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

include("conn.php");

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM users WHERE id = $user_id";

    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error($con));
    }

    $user = mysqli_fetch_assoc($result);
} else {
    die("User ID is not set in session.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = mysqli_real_escape_string($con, $_POST['username']);
    $new_email = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['password']);

    $update_query = "UPDATE users SET email = '$new_email', password = '$new_password' WHERE id = $user_id";

    if (mysqli_query($con, $update_query)) {

        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Profile</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <div class="content">
                <h1>Edit Profile</h1>
            </div>
            <hr>
            <br> 
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $user['email']; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php echo $user['password']; ?>" autocomplete="off" required>
                </div>

                <div class="field">
            <input type="submit" class="btn" name="submit" value="Update">
            </div>
            <div class="field">
                <input type="button" class="btn" onclick="window.location.href='index.php';" value="Go back">
            </div>

            </form>
        </div>
    </div>
</body>
</html>
