<?php
include 'config.php';

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "INSERT INTO user (email,password) VALUES ('$email', '$password')";

	if (mysqli_query($conn, $sql)) {
		header('Location: ./index.php');
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

// code to if user is logged in or not
if (!isset($_SESSION['logged_in']) && !$_SESSION['logged_in'] == true) {
  header('Location: ./login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="custom.css">



	<title>Sign up Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body class="loginstyle">
	<div stle="max-width: 400px;width: 100%;padding: 20px;">
        <h1 style="padding-bottom: 20px;">Add User</h1>
		<form action="" method="POST">


			<div class="form-group">
				<label for="email">Email address</label>
				<input name="email" type="email" class="form-control" id="email" placeholder="Enter your email" required>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input name="password" type="password" class="form-control" id="password" placeholder="Enter your password" required>
			</div>

			<button type="submit" class="btn btn-primary border-0" name="submit">Add User</button>
		</form>

	</div>
	</div>
	<div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
</body>
</html>
