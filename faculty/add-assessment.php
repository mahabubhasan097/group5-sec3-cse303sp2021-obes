<?php
	include '../php/mysql.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Add Department | Department</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!-- <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/> -->

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="index.html" class="logo">
					<h1 class="text-white mt-2 ml-3">OBES</h1>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" href="#">
								<i class="icon icon-logout"></i> Logout
							</a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									Mr. Arter
									<span class="user-level">Instructor</span>
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item">
							<a href="index.html">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="section-list.php">
								<i class="fas fa-user-friends"></i>
								<p>Section List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add-section.php">
								<i class="fas fa-user-plus"></i>
								<p>Add Section</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="assessment-list.php">
								<i class="fas fa-book"></i>
								<p>Assessment List</p>
							</a>
						</li>
						<li class="nav-item active">
							<a href="add-assessment.php">
								<i class="fas fa-book-open"></i>
								<p>Add Assessment</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="report.html">
								<i class="fas fa-book"></i>
								<p>Reports</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Create Department</h2>
								<h5 class="text-white op-7 mb-2">An outcome based education system.</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row d-flex justify-content-center">
						<div class="col-8">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Add New Department</h4>
								</div>
								<div class="card-body">
									<form method="POST" action="../php/add-assessment.php">
										<div class="col-md-12">
											<div class="form-group form-floating-label">
												<select class="form-control input-border-bottom" id="selectFloatingLabel" name="section" required>
													<?php
														$query = "SELECT * FROM section";
														$sctns = $conn->query($query);
														foreach($sctns as $sctn){
															$id = $sctn['section_id'];
															$section = ucfirst($sctn['semester']) . " - " . strtoupper($sctn['course_id']) . " - " . strtoupper($sctn['section_no']);
															echo "<option value='$id'>$section</option>";
														}
													?>
												</select>
												<label for="selectFloatingLabel" class="placeholder">Section</label>
											</div>
											<div class="form-group form-floating-label">
												<select class="form-control input-border-bottom" id="selectFloatingLabel" name="name" required>
													<option value="mid">Mid</option>
													<option value="mid">Final</option>
													<option value="mid">Project</option>
												</select>
												<label for="selectFloatingLabel" class="placeholder">Assessment Name</label>
											</div>
											<div class="form-group form-floating-label">
												<input id="ques" name="ques" type="text" class="form-control input-border-bottom" onchange="makeList();" required>
												<label for="ques" class="placeholder">Total Questions</label>
											</div>
											<div id="qs-here">
												<!-- <div class="form-row">
													<div class="form-group form-floating-label col-6">
														<input id="mark1" name="mark1" type="text" class="form-control input-border-bottom" required>
														<label for="mark1" class="placeholder">Question 1 Marks</label>
													</div>
													<div class="form-group form-floating-label col-6">
														<input id="co1" name="co1" type="text" class="form-control input-border-bottom" required>
														<label for="co1" class="placeholder">Question 1 CO</label>
													</div>
												</div> -->
											</div>
											<div class="form-group form-floating-label">
												<input type="submit" class="btn btn-primary" value="Submit"> 
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="https://www.themekita.com">
									ThemeKita
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
					</div>				
				</div>
			</footer>
		</div>
		
	</div>
	<!--   Core JS Files   -->
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>


	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo.js"></script>
	<script>
		function makeList(){
			$ques = $("#ques").val();
			$("#qs-here").empty();
			for($q=1; $q<=$ques; $q++){
				$("#qs-here").append(`<div class="form-row">
										<div class="form-group form-floating-label col-6">
											<input id="mark`+$q+`" name="mark`+$q+`" type="text" class="form-control input-border-bottom" required>
											<label for="mark`+$q+`" class="placeholder">Question `+$q+` Marks</label>
										</div>
										<div class="form-group form-floating-label col-6">
											<input id="co`+$q+`" name="co`+$q+`" type="text" class="form-control input-border-bottom" required>
											<label for="co`+$q+`" class="placeholder">Question `+$q+` CO</label>
										</div>
									</div>`);
			}
		}
	</script>
</body>
</html>