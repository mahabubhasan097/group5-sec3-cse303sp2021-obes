<?php include '../php/mysql.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Dashboard | Department</title>
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
							<a class="nav-link" href="../php/login.php?logout=1">
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
									Mr. Carter
									<span class="user-level">Dean | Department</span>
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a href="index.html">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						
						<li class="nav-item">
							<a data-toggle="collapse" href="#base" class="collapsed" aria-expanded="false">
								<i class="fas fa-layer-group"></i>
								<p>Reports</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="report1.php">
											<span class="sub-item">Report1</span>
										</a>
									</li>
									<li>
										<a href="report2.php">
											<span class="sub-item">Report2</span>
										</a>
									</li>
									<li>
										<a href="report3.php">
											<span class="sub-item">Report3</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a href="user-list.php">
								<i class="fas fa-user-friends"></i>
								<p>User List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add-user.php">
								<i class="fas fa-user-plus"></i>
								<p>Add User</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="university-list.php">
								<i class="fas fa-user-friends"></i>
								<p>University List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add-university.php">
								<i class="fas fa-user-friends"></i>
								<p>Add University</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="school-list.php">
								<i class="fas fa-school"></i>
								<p>School List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add-school.php">
								<i class="far fa-plus-square"></i>
								<p>Add School</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="department-list.php">
								<i class="fas fa-book"></i>
								<p>Department List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add-department.php">
								<i class="fas fa-book-open"></i>
								<p>Add Department</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="program-list.php">
								<i class="fas fa-book"></i>
								<p>Program List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add-program.php">
								<i class="fas fa-book-open"></i>
								<p>Add Program</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="course-list.php">
								<i class="fas fa-clipboard"></i>
								<p>Course List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add-course.php">
								<i class="fas fa-clipboard-list"></i>
								<p>Add Course</p>
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
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
								<!-- <h5 class="text-white op-7 mb-2">Free Bootstrap 4 Admin Dashboard</h5> -->
							</div>
						</div>
					</div>

				</div>
				<div class="page-inner mt--4">
					<div class="row mt--2">
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">School Wise Enrollment</div>
									<div class="row py-3">
										<div class="col-md-12">
											<div id="chart-container">
												<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
												<canvas id="school-wise-enrollment" style="display: block; height: 200px;" class="chartjs-render-monitor"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Department Wise Enrollment</div>
									<div class="row py-3">
										<div class="col-md-12">
											<div id="chart-container">
												<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
												<canvas id="department-wise-enrollment" style="display: block; height: 200px;" class="chartjs-render-monitor"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Program Wise Enrollment</div>
									<div class="row py-3">
										<div class="col-md-12">
											<div id="chart-container">
												<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
												<canvas id="program-wise-enrollment" style="display: block; height: 200px;" class="chartjs-render-monitor"></canvas>
											</div>
										</div>
									</div>
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

	<script src="../assets/js/plugin/chart.js/chart.min.js"></script>


	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo.js"></script>
	<?php
		$query = "SELECT school.school_name as 'name', COUNT(DISTINCT(enrollment.student_id)) as 'total' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN enrollment GROUP BY school.school_id";
		$scls = $conn->query($query);
		
		$query = "SELECT UPPER(department.department_id) as 'name', COUNT(DISTINCT(enrollment.student_id)) as 'total' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN enrollment GROUP BY department.department_id";
		$deps = $conn->query($query);

		$query = "SELECT UPPER(department.department_id) as 'dep', program.program_name as 'name', COUNT(DISTINCT(enrollment.student_id)) as 'total' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN enrollment GROUP BY program.program_id";
		$progs = $conn->query($query);
	?>
	<script>
		var barChart1 = document.getElementById('school-wise-enrollment').getContext('2d');
		var myBarChart1 = new Chart(barChart1, {
			type: 'bar',
			data: {
				labels: [
					<?php
						foreach($scls as $scl){
							$name = $scl['name'];
							echo "'$name',";
						}
					?>
				],
				datasets : [{
					label: "Enrolled Student",
					backgroundColor: 'rgba(23, 125, 255, 0.6)',
					borderColor: 'rgb(23, 125, 255)',
					data: [
						<?php
						foreach($scls as $scl){
							$total = $scl['total'];
							echo "$total,";
						}
					?>
					],
				}],
			},
			options: {
				
				maintainAspectRatio: true,
				scales: {
					yAxes: [{
						ticks: {
							
						}
					}]
				},
			}
		});

		var barChart2 = document.getElementById('department-wise-enrollment').getContext('2d');
		var myBarChart2 = new Chart(barChart2, {
			type: 'bar',
			data: {
				labels: [
					<?php
						foreach($deps as $dep){
							$name = $dep['name'];
							echo "'$name',";
						}
					?>
				],
				datasets : [{
					label: "Enrolled Student",
					backgroundColor: 'rgba(23, 125, 255, 0.6)',
					borderColor: 'rgb(23, 125, 255)',
					data: [
						<?php
						foreach($deps as $dep){
							$total = $dep['total'];
							echo "$total,";
						}
					?>
					],
				}],
			},
			options: {
				
				maintainAspectRatio: true,
				scales: {
					yAxes: [{
						ticks: {
							
						}
					}]
				},
			}
		});

		var barChart3 = document.getElementById('program-wise-enrollment').getContext('2d');
		var myBarChart3 = new Chart(barChart3, {
			type: 'bar',
			data: {
				labels: [
					<?php
						foreach($progs as $prog){
							$name = $prog['name']."(".$prog['dep'].")";
							echo "'$name',";
						}
					?>
				],
				datasets : [{
					label: "Enrolled Student",
					backgroundColor: 'rgba(23, 125, 255, 0.6)',
					borderColor: 'rgb(23, 125, 255)',
					data: [
						<?php
						foreach($progs as $prog){
							$total = $prog['total'];
							echo "$total,";
						}
					?>
					],
				}],
			},
			options: {
				
				maintainAspectRatio: true,
				scales: {
					yAxes: [{
						ticks: {
							
						}
					}]
				},
			}
		});

	</script>
</body>
</html>