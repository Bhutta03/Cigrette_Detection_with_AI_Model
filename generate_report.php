    <html>
	<head>
		<title>Generate Report</title>
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
	<!-- <link rel="webion" href="1.jpg"> -->
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
					<li style="font-size:35px;" class="w-50 text-center" >Welcome to Smart Campus</li>
                    <li class="generate_report w-25">
					<button class="btn btn-primary border-0"><a href="index.php" style="text-decoration: none; color: white;">Home</a></button>
                    <button class="btn btn-primary border-0"><a href="logout.php" style="text-decoration: none; color: white;">Log Out</a></button>
               
                       
                    </li>
                </ul>

            </nav>
	</header>

	<div style="flex: 1; display: flex;align-items: center;flex-direction: column;justify-content: center;gap: 20px;">
	
		
		<input id="imageUpload" type="file" />
		<div>Check Smoker</div>
		<div id="label-container"></div>
		<img id="imagePreview" style="height: 300px;" />
		<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.3.1/dist/tf.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>
		<script type="text/javascript">
			// More API functions here:
			// https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

			// the link to my model provided by Teachable Machine export panel
			const URL = 'model/';

			let model, labelContainer, maxPredictions;

			// Load the image model 
			async function init() {
				const modelURL = URL + 'model.json';
				const metadataURL = URL + 'metadata.json';

				// load the model and metadata
				model = await tmImage.load(modelURL, metadataURL);
				maxPredictions = model.getTotalClasses();

				labelContainer = document.getElementById('label-container');
				for (let i = 0; i < maxPredictions; i++) {
					// and class labels
					labelContainer.appendChild(document.createElement('div'));
				}
			}

			async function predict() {
				// predict can take in an image, video or canvas html element
				var image = document.getElementById('imagePreview');
				const prediction = await model.predict(image, false);
				for (let i = 0; i < maxPredictions; i++) {
					const classPrediction =
						prediction[i].className + ': ' + prediction[i].probability.toFixed(2);
					labelContainer.childNodes[i].innerHTML = classPrediction;
				}
			}
		</script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript">
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						$('#imagePreview').attr('src', e.target.result);
						// $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
						$('#imagePreview').hide();
						$('#imagePreview').fadeIn(650);
					};
					reader.readAsDataURL(input.files[0]);
					init().then(() => {
						predict();
					});
				}
			}
			$('#imageUpload').change(function () {
				readURL(this);
			});
		</script>

		</div>

<footer>
		<div class="container">
			<p> &copy Cigarette detection</p>
		</div>
	</footer>
   
		
	</body>
    <!-- Bootstrap JS and jQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    
	
</html>