<?php
    include '../php/mysql.php';
    session_start();
    $id = $_SESSION['id'];
    $query = "SELECT course, COUNT(stat) as 'passed' FROM (SELECT UPPER(section.course_id) as 'course', section.faculty_id as 'faculty',  plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE enrollment.student_id = $id GROUP BY section.course_id, enrollment.student_id, section.course_id, plo.plo_num) as sQuery WHERE stat = 1 GROUP BY course ORDER BY course";
    $pls = $conn->query($query);
	$query = "SELECT course, COUNT(stat) as 'failed' FROM (SELECT UPPER(section.course_id) as 'course', section.faculty_id as 'faculty',  plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE enrollment.student_id = $id GROUP BY section.course_id, enrollment.student_id, section.course_id, plo.plo_num) as sQuery WHERE stat = 0 GROUP BY course ORDER BY course";
    $mns = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Department List | Department</title>
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
				
				<a href="index.php" class="logo">
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
									Mr. Arter
									<span class="user-level">Instructor</span>
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item">
							<a href="index.php">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item active">
							<a href="report.php">
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
								<h2 class="text-white pb-2 fw-bold">Report</h2>
								<!-- <h5 class="text-white op-7 mb-2">An outcome based education system.</h5> -->
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
                    <div class='col-12'>
                        <div class="card full-height">
							<div class="card-body">
								<div class="card-title">Course Wise PLO Achievement</div>
								<div class="row py-3">
									<div class="col-md-12">
										<div id="chart-container">
											<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
											<canvas id="course-wise-plo" style="display: block; height: 80px;" class="chartjs-render-monitor"></canvas>
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

	<!-- Datatables -->
	<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Atlantis JS -->
	<script src="../assets/js/atlantis.min.js"></script>
	<script src="../assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="../assets/js/setting-demo.js"></script>

    <?php
        
    ?>

	<script>
		var barChart1 = document.getElementById('course-wise-plo').getContext('2d');
		var myBarChart1 = new Chart(barChart1, {
			type: 'bar',
			data: {
				labels: [
					<?php
						foreach($pls as $d){
							$crs = $d['course'];
							echo "'$crs', ";
						}
					?>
				],
				datasets : [{
					label: "Achieved",
					backgroundColor: 'rgba(23, 125, 255, 0.6)',
					borderColor: 'rgb(23, 125, 255)',
					data: [
						<?php
							foreach($pls as $d){
								echo $d['passed'].", ";
							}
						?>
					],
				},
				{
					label: "Failed",
					backgroundColor: 'rgba(242, 89, 87, 0.6)',
					borderColor: 'rgb(242, 89, 87)',
					data: [
						<?php
							foreach($mns as $d){
								echo $d['failed'].", ";
							}
						?>
					],
				}
				],
			},
			options: {
				
				maintainAspectRatio: true,
				scales: {
					yAxes: [{
						ticks: {
							min: 0,
						}
					}]
				},
			}
		});
	</script>
</body>
</html>