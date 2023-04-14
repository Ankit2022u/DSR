<!DOCTYPE html>
<html>

<head>
	<title>Homepage | DSR</title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<style>
		.container {
			display: flex;
			justify-content: center;
		}

		.card {
			width: 70%;
			padding: 20px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		}

		.button-container {
			display: flex;
			justify-content: center;
		}

		.card-outer {
			width: 70%;
			padding: 20px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		}

		.logo-image {
			width: 100%;
		}

		footer{
			background-color: rgba(0,0,0,0.05);
			padding: 20px;
		}
	</style>
</head>

<body>
	<!-- Header included -->
	<?php include('header.php'); ?>

	<!-- Main Body -->
	<main class="mb-4">
		<div class="container">
			<div class="button-container">
				<div class="container mt-2">
					<div class="card card-outer">
						<div class="card-header">
							<img src="assets/img/login-image.jpg" alt="Logo" class="logo-image card-img-top">
						</div>
						<div class="card-body text-center">
							<form method="post" action="login.php">
								<button name="login" value="admin" class="btn btn-primary mb-2"
									type="submit">Download Data</button>
								<button name="login" value="user" class="btn btn-primary mb-2"
									type="submit">Upload Data</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- Footer Included  -->
	<?php include('footer.php'); ?>

</body>

</html>
