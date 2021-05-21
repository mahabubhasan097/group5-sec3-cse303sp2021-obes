<?php
    include '../php/mysql.php';
	if(!isset($_GET['section'])){
		header("Location: section-list.php");
	}
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
						<li class="nav-item">
							<a href="section-list.php">
								<i class="fas fa-user-friends"></i>
								<p>Section List</p>
							</a>
						</li>
						<li class="nav-item active">
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
						<li class="nav-item">
							<a href="add-assessment.php">
								<i class="fas fa-book-open"></i>
								<p>Add Assessment</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="report.php">
								<i class="fas fa-book"></i>
								<p>Report</p>
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
								<h2 class="text-white pb-2 fw-bold">Edit Section Mapping</h2>
								<h5 class="text-white op-7 mb-2">An outcome based education system.</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row d-flex justify-content-center">
						<div class="col-10">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Edit Mapping</h4>
								</div>
								<div class="card-body">
									<form method="POST" action="../php/edit-map.php">
										<div class="col-md-12">
										<div class="table-responsive">
										<table id="school-datatables" class="display table table-striped table-hover" >
											<?php
												$section = $_GET['section'];
												$query = "SELECT course_id FROM section WHERE section_id = $section";
												echo "<input type='hidden' name='section' value='$section'>";
												$course = $conn->query($query)->fetch_row()[0];
												$query = "SELECT program_id FROM course WHERE course_id = '$course'";
												$program = $conn->query($query)->fetch_row()[0];
												echo "<input type='hidden' name='program' value='$program'>";
												$query = "SELECT  COUNT(program_id) as plos FROM plo WHERE program_id = $program GROUP BY program_id";
												$plos = $conn->query($query)->fetch_row()[0];
												echo "<input type='hidden' name='plos' value='$plos'>";
												$query = "SELECT COUNT(DISTINCT(co.co_num)) as 'cos' FROM plo LEFT JOIN co ON plo.plo_id = co.plo_id WHERE plo.program_id = $program";
												$cos = $conn->query($query)->fetch_row()[0];
												echo "<thead>
														<tr>
															<th>PLO</th>";
												for($i=1; $i<=$cos; $i++){
													echo "<th>CO$i</th>";
												}
												echo "	</tr>
													</thead>
													<tfoot>
														<tr>
															<th>PLO</th>";
												for($i=1; $i<=$cos; $i++){
													echo "<th>CO$i</th>";
												}
												echo "</tr>
												</tfoot>";
												echo "<tbody>";
												for($plo=1; $plo<=$plos; $plo++){
													echo "<tr>
													<td>PLO$plo</td>";
													for($co=1; $co<=$cos; $co++){
														$query = "SELECT plo_id FROM plo WHERE program_id = $program AND plo_num=$plo";
														$plo_id = $conn->query($query)->fetch_row()[0];
														$query = "SELECT co_id FROM co WHERE co_num = $co AND plo_id = $plo_id";
														if($conn->query($query)->num_rows != 0){
															echo "<td><input type='checkbox' name='plo".$plo."[]' value='$co' checked></td>";
														}else{
															echo "<td><input type='checkbox' name='plo".$plo."[]' value='$co'></td>";
														}
													}
													echo "</tr>";
												}
												echo "</tbody>";
											?>
										</table>
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
		
	</script>
</body>
</html>