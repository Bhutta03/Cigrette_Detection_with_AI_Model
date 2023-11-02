<?php
include 'config.php';

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
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="{custom.css}">
    
	<title>Smart Campus</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="min-height: 100vh; display: flex; flex-direction: column;">
	<header>
    <nav>
    <ul class="w-100 d-flex align-center py-2" style="background: #343a40">
        <li class="w-25 m-0 d-flex align-center">
            <img src="Images/logocampus.png" alt="Smart Campus Logo" style="height: 50px; width: 20%; vertical-align: middle;" class="m-0">
        </li>
        <li style="font-size: 35px;" class="w-50 text-center">Welcome to Smart Campus</li>
        <li class="logout w-25">
            <button class="btn btn-primary border-0"><a href="generate_report.php" style="text-decoration: none; color: white;">Generate Report</a></button>
            <!-- <button class="btn btn-primary border-0"><a href="signup.php" style="text-decoration: none; color: white;">Add User</a></button> -->
            <button class="btn btn-primary border-0"><a href="logout.php" style="text-decoration: none; color: white;">Log Out</a></button>
        </li>
    </ul>
</nav>

	</header>
    	<!-- <form action="" method="POST" enctype="multipart/form-data" class="d-flex mx-2 ">

            
            <button type="submit" class="btn btn-primary border-0" style="padding: 10px 20px;" >Cigrette Detection</button>

            </form> -->




    

	<!-- Bootstrap JS and jQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    
    <div class="align-items-center d-flex flex-column justify-content-center text-center flex-grow-1">
    <div>Cigrette Detection</div>
        <button type="button" class="btn btn-dark m-2" style="max-width: 100px;" onclick="init()">Start</button>
        <button type="button" class="btn btn-warning m-2" style="max-width: 100px;" onclick="stop()">Stop</button>
        <div id="webcam-container"></div>
        <div id="label-container"></div>
    </div>

    <footer>
		<div class="container">
			<p> &copy Cigarette detection</p>
		</div>
	</footer>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
<script type="text/javascript">
    // More API functions here:
    // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

    // the link to your model provided by Teachable Machine export panel
    const URL = "https://teachablemachine.withgoogle.com/models/SejrF8L4o/";

    let model, webcam, labelContainer, maxPredictions;

    // Load the image model and setup the webcam
    async function init() {
        document.getElementById("label-container").style.display = "block"
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";

        // load the model and metadata
        // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
        // or files from your local hard drive
        // Note: the pose library adds "tmImage" object to your window (window.tmImage)
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();

        // Convenience function to setup a webcam
        const flip = true; // whether to flip the webcam
        webcam = new tmImage.Webcam(300, 300, flip); // width, height, flip
        await webcam.setup(); // request access to the webcam
        await webcam.play();
        window.requestAnimationFrame(loop);

        // append elements to the DOM
        document.getElementById("webcam-container").appendChild(webcam.canvas);
        labelContainer = document.getElementById("label-container");
        for (let i = 0; i < maxPredictions; i++) { // and class labels
            labelContainer.appendChild(document.createElement("div"));
        }
    }

    async function loop() {
        webcam.update(); // update the webcam frame
        await predict();
        window.requestAnimationFrame(loop);
    }

    // run the webcam image through the image model
    async function predict() {
        // predict can take in an image, video or canvas html element
        const prediction = await model.predict(webcam.canvas);
        for (let i = 0; i < maxPredictions; i++) {
            const classPrediction =
                prediction[i].className + ": " + prediction[i].probability.toFixed(2);
            labelContainer.childNodes[i].innerHTML = classPrediction;
        }
    }

    async function stop() {
        await webcam.stop()
        document.getElementById("webcam-container").innerHTML = ""
        document.getElementById("label-container").style.display = "none"
    }
</script>
