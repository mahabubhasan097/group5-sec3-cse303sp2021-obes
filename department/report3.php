<?php 
    include '../php/mysql.php'; 
    if(isset($_GET['qs']) && isset($_GET['qt'])){
		if($_GET['qt']=='school'){
			$bas = 'school';
			$qs = $_GET['qs'];
			$query = "SELECT school.school_name AS 'school', department.department_id AS 'department', program.program_name AS 'program', plo.plo_num as 'plo', co.co_num as 'co', SUM(evaluation.obtained_marks) as 'mark',  SUM(assessment.marks) as 'total' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN faculty LEFT JOIN co ON assessment.co_number = co.co_num AND section.section_id = co.section_id LEFT JOIN plo on co.plo_id = plo.plo_id WHERE school.school_name LIKE '%$qs%' GROUP BY school.school_name, plo.plo_num, co.co_num";
			$res = $conn->query($query);
		}else if($_GET['qt']=='department'){
			$bas = 'department';
			$qs = $_GET['qs'];
			$query = "SELECT school.school_name AS 'school', department.department_id AS 'department', program.program_name AS 'program', plo.plo_num as 'plo', co.co_num as 'co', SUM(evaluation.obtained_marks) as 'mark',  SUM(assessment.marks) as 'total' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN faculty LEFT JOIN co ON assessment.co_number = co.co_num AND section.section_id = co.section_id LEFT JOIN plo on co.plo_id = plo.plo_id WHERE department.department_id LIKE '%$qs%' GROUP BY department.department_id, plo.plo_num, co.co_num";
			$res = $conn->query($query);
		}else if($_GET['qt']=='program'){
			$bas = 'program';
			$qs = $_GET['qs'];
			$qs = $_GET['qs'];
			$query = "SELECT school.school_name AS 'school', department.department_id AS 'department', program.program_name AS 'program', plo.plo_num as 'plo', co.co_num as 'co', SUM(evaluation.obtained_marks) as 'mark',  SUM(assessment.marks) as 'total' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN faculty LEFT JOIN co ON assessment.co_number = co.co_num AND section.section_id = co.section_id LEFT JOIN plo on co.plo_id = plo.plo_id WHERE program.program_name LIKE '%$qs%' GROUP BY program.program_id, plo.plo_num, co.co_num";
			$res = $conn->query($query);
		}	

		$data = array();

		foreach($res as $r){
			$base = $r[$bas];
			if(!array_key_exists($base, $data)){
				$data[$base] = array();
				$data[$base]['p'] = array();
				$data[$base]['c'] = array();
			}

			if(!array_key_exists($r['plo'], $data[$base]['p'])){
				$data[$base]['p'][$r['plo']] = array();
				$data[$base]['p'][$r['plo']]['m'] = 0;
				$data[$base]['p'][$r['plo']]['t'] = 0;
			}

			$data[$base]['p'][$r['plo']]['m'] += $r['mark'];
			$data[$base]['p'][$r['plo']]['t'] += $r['total'];

			if(!array_key_exists($r['co'], $data[$base]['c'])){
				$data[$base]['c'][$r['co']] = array();
			}

			if(!array_key_exists($r['plo'], $data[$base]['c'][$r['co']])){
				$data[$base]['c'][$r['co']][$r['plo']] = 0;
			}

			$data[$base]['c'][$r['co']][$r['plo']] += $r['mark'];

		}


	}

?>
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
						<li class="nav-item">
							<a href="index.html">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						
						<li class="nav-item active sub-menu">
							<a data-toggle="collapse" href="#base"  aria-expanded="false">
								<i class="fas fa-layer-group"></i>
								<p>Reports</p>
								<span class="caret"></span>
							</a>
							<div class="collapse show" id="base">
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
									<li class="active">
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
                        <div class="row">
                            <div class="col-8">
                                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                    <div>
                                        <h2 class="text-white pb-2 fw-bold">Report</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>

				</div>
				<div class="page-inner mt--4" >
					<div class="row mt--2">
						<div class="col-12">
							<div class="row d-flex justify-content-center">
								<div class="col-8">
									<div class="card">
                                        <div class="card-body">
                                            <form method="GET">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-5">
                                                        <div class="form-group form-floating-label">
                                                            <select class="form-control input-border-bottom" id="selectFloatingLabel" name="qt" required>
                                                                <option	option value='school' <?php if(isset($_GET['qt']) && $_GET['qt']=='school'){echo 'selected';} ?>>School</option>
                                                                <option	option value='department'<?php if(isset($_GET['qt']) && $_GET['qt']=='department'){echo 'selected';} ?>>Department</option>
                                                                <option	option value='program' <?php if(isset($_GET['qt']) && $_GET['qt']=='program'){echo 'selected';} ?>>Program</option>
                                                            </select>
                                                            <label for="selectFloatingLabel" class="placeholder">Type</label>
                                                        </div>
                                                    </div>
													<div class="col-5">
														<div class="form-group form-floating-label">
															<input id="qs" name="qs" type="text" class="form-control input-border-bottom" required <?php if(isset($_GET['qs'])){echo 'value="'.$_GET['qs'].'"';} ?>>
															<label for="qs" class="placeholder">Query</label>
														</div>
													</div>
                                                    <div class="col-2 mt-2">
                                                        <button type="submit" class="btn btn-icon btn-round btn-primary">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>

						<div class="col-md-6" <?php if(!(isset($_GET['qs']) && sizeof($data)>0)){echo 'hidden';} ?>>
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">PLO Percentage</div>
									<div class="row py-3">
										<div class="col-md-12">
											<div id="chart-container">
												<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
												<canvas id="plo-bar" style="display: block; height: 200px;" class="chartjs-render-monitor"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6" <?php if(!(isset($_GET['qs']) && sizeof($data)>0)){echo 'hidden';} ?>>
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">CO Wise PLO Score

									</div>
									<div class="row py-3">
										<div class="col-md-12">
											<div id="chart-container">
												<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
												<canvas id="plo-co-bar" style="display: block; height: 200px;" class="chartjs-render-monitor"></canvas>
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

	<script>
		var barChart1 = document.getElementById('plo-bar').getContext('2d');
		var myBarChart1  = new Chart(barChart1 , {
			type: 'bar',
			data: {
				labels: [
					<?php
						if(isset($_GET['qs']) && sizeof($data)>0){
							foreach($data as $d){
								foreach($d['p'] as $a => $b){
									echo "'PLO$a', ";
								}
								
							}
						}
					?>
				],
				datasets : [{
					label: <?php
						if(isset($_GET['qs']) && sizeof($data)>0){
							foreach($data as $a => $b){
								echo "'$a'";
								break;			
							}
						}
					?>,
					backgroundColor: 'rgba(23, 125, 255, 0.6)',
					borderColor: 'rgb(23, 125, 255)',
					data: [
						<?php
							if(isset($_GET['qs']) && sizeof($data)>0){
								foreach($data as $d){
									foreach($d['p'] as $a => $b){
										echo round($b['m'] / $b['t'] * 100, 2) .", ";
									}
									
								}
							}
						?>
					],
				},
				],
			},
			options: {
				
				maintainAspectRatio: true,
				scales: {
					
				},
			}
		});
	</script>

	
	<script>
		var barChart2 = document.getElementById('plo-co-bar').getContext('2d');
		var mySpiderChart2  = new Chart(barChart2 , {
			type: 'bar',
			data: {
				labels: [
					<?php
						if(isset($_GET['qs']) && sizeof($data)>0){
							foreach($data as $d){
								foreach($d['p'] as $a => $b){
									echo "'PLO$a', ";
								}
								
							}
						}
					?>
				],
				datasets : [
					<?php
						if(isset($_GET['qs']) && sizeof($data)>0){
							foreach($data as $d){
								foreach($d['c'] as $a => $b){
									echo "{
											label: 'CO$a',
											backgroundColor: getRandomColor(),
											data: [";
									foreach($data as $p){
										foreach($p['p'] as $c => $d){
											if(array_key_exists($c, $b)){
												echo $b[$c].", ";
											}else{
												echo "0, ";
											}		
										}
									}												
									echo "],
										},";
									
								}
								
							}
						}
					?>

				
			],
			},
			options: {
				
				maintainAspectRatio: true,
				scales: {
					yAxes: [{
						stacked : true,
						
					}],
					xAxes: [{
						stacked: true
					}]
				},
			}
		});


		function getRandomColor() {
			var letters = '0123456789ABCDEF';
			var color = '#';
			for (var i = 0; i < 6; i++) {
				color += letters[Math.floor(Math.random() * 16)];
			}
			return color;
		}

	</script>
</body>
</html>