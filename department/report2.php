<?php 
    include '../php/mysql.php'; 
    $query = "SELECT plo, COUNT(stat) as 'stat' FROM (SELECT plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id GROUP BY enrollment.student_id, section.course_id, plo.plo_num ORDER BY stat DESC, plo ASC) as testQ WHERE stat=1 GROUP BY plo";
	$achieved = $conn->query($query);
	$query = "SELECT plo, COUNT(plo) as 'stat' FROM (SELECT plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id GROUP BY enrollment.student_id, section.course_id, plo.plo_num ORDER BY stat DESC, plo ASC) as testQ GROUP BY plo";
	$attempted = $conn->query($query);

	$p_perc = array();
	foreach($attempted as $a){
		$p_perc[$a['plo']]=array();
		$p_perc[$a['plo']]['achieved'] = 0;
		$p_perc[$a['plo']]['attempted'] = $a['stat'];
	} 
	foreach($achieved as $a){
		$p_perc[$a['plo']]['achieved'] = $a['stat'];
	} 

	if(isset($_GET['qs']) && isset($_GET['qt'])){
		$base = '';
		if($_GET['qt']=='school'){
			$base = 'school';
			$school = $_GET['qs'];
			$query = "SELECT school, department, program, plo, COUNT(stat) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE school.school_name LIKE '%$school%' GROUP BY enrollment.student_id, section.course_id, plo.plo_num ORDER BY stat DESC, plo ASC) as testQ WHERE stat=1 GROUP BY plo";
			$achieved = $conn->query($query);
			$query = "SELECT school, department, program, plo, COUNT(plo) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE school.school_name LIKE '%$school%' GROUP BY enrollment.student_id, section.course_id, plo.plo_num ORDER BY stat DESC, plo ASC) as testQ GROUP BY plo";
			$attempted = $conn->query($query);
		}else if($_GET['qt']=='department'){
			$base = 'department';
			$department = $_GET['qs'];
			$query = "SELECT school, department, program, plo, COUNT(stat) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE department.department_id LIKE '%$department%' GROUP BY enrollment.student_id, section.course_id, plo.plo_num ORDER BY stat DESC, plo ASC) as testQ WHERE stat=1 GROUP BY plo";
			$achieved = $conn->query($query);
			$query = "SELECT school, department, program, plo, COUNT(plo) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE department.department_id LIKE '%$department%' GROUP BY enrollment.student_id, section.course_id, plo.plo_num ORDER BY stat DESC, plo ASC) as testQ GROUP BY plo";
			$attempted = $conn->query($query);
		}else if($_GET['qt']=='program'){
			$base = 'program';
			$program = $_GET['qs'];
			$query = "SELECT school, department, program, plo, COUNT(stat) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE program.program_name LIKE '%$program%' GROUP BY enrollment.student_id, section.course_id, plo.plo_num ORDER BY stat DESC, plo ASC) as testQ WHERE stat=1 GROUP BY plo";
			$achieved = $conn->query($query);
			$query = "SELECT school, department, program, plo, COUNT(plo) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE program.program_name LIKE '%$program%' GROUP BY enrollment.student_id, section.course_id, plo.plo_num ORDER BY stat DESC, plo ASC) as testQ GROUP BY plo";
			$attempted = $conn->query($query);
		}else if($_GET['qt']=='course'){
			$base = 'course';
			$course = $_GET['qs'];
			$query = "SELECT school, department, program, plo, COUNT(stat) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE course.course_id LIKE '%$course%' GROUP BY enrollment.student_id, section.course_id, plo.plo_num ORDER BY stat DESC, plo ASC) as testQ WHERE stat=1 GROUP BY plo";
			$achieved = $conn->query($query);
			$query = "SELECT school, department, program, plo, COUNT(plo) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', plo.plo_num as 'plo', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE course.course_id LIKE '%$course%' GROUP BY enrollment.student_id, section.course_id, plo.plo_num ORDER BY stat DESC, plo ASC) as testQ GROUP BY plo";
			$attempted = $conn->query($query);
		}
		

		$p_stat = array();
		foreach($attempted as $a){
			$p_stat[$a['plo']]=array();
			$p_stat[$a['plo']]['achieved'] = 0;
			$p_stat[$a['plo']]['attempted'] = $a['stat'];
		} 
		foreach($achieved as $a){
			$p_stat[$a['plo']]['achieved'] = $a['stat'];
		} 
		
	}

	if(isset($_GET['qs']) && isset($_GET['qt'])){
		$base = '';
		if($_GET['qt']=='school'){
			$base = 'school';
			$school = $_GET['qs'];
			$query = "SELECT  school, department, program, co, COUNT(stat) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', co.co_num as 'co', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE school.school_name LIKE '%$school%' GROUP BY enrollment.student_id, section.course_id, co.co_num ORDER BY stat DESC, co ASC) as testQ WHERE stat = 1 GROUP BY co";
			$achieved = $conn->query($query);
			$query = "SELECT school, department, program, co, COUNT(co) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', co.co_num as 'co', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE school.school_name LIKE '%$school%' GROUP BY enrollment.student_id, section.course_id, co.co_num ORDER BY stat DESC, co ASC) as testQ GROUP BY co";
			$attempted = $conn->query($query);
		}else if($_GET['qt']=='department'){
			$base = 'department';
			$department = $_GET['qs'];
			$query = "SELECT  school, department, program, co, COUNT(stat) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', co.co_num as 'co', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE department.department_id LIKE '%$department%' GROUP BY enrollment.student_id, section.course_id, co.co_num ORDER BY stat DESC, co ASC) as testQ WHERE stat = 1 GROUP BY co";
			$achieved = $conn->query($query);
			$query = "SELECT school, department, program, co, COUNT(co) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', co.co_num as 'co', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE department.department_id LIKE '%$department%' GROUP BY enrollment.student_id, section.course_id, co.co_num ORDER BY stat DESC, co ASC) as testQ GROUP BY co";
			$attempted = $conn->query($query);
		}else if($_GET['qt']=='program'){
			$base = 'program';
			$program = $_GET['qs'];
			$query = "SELECT  school, department, program, co, COUNT(stat) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', co.co_num as 'co', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE program.program_name LIKE '%$program%' GROUP BY enrollment.student_id, section.course_id, co.co_num ORDER BY stat DESC, co ASC) as testQ WHERE stat = 1 GROUP BY co";
			$achieved = $conn->query($query);
			$query = "SELECT school, department, program, co, COUNT(co) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', co.co_num as 'co', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE program.program_name LIKE '%$program%' GROUP BY enrollment.student_id, section.course_id, co.co_num ORDER BY stat DESC, co ASC) as testQ GROUP BY co";
			$attempted = $conn->query($query);
		}else if($_GET['qt']=='course'){
			$base = 'course';
			$course = $_GET['qs'];
			$query = "SELECT  school, department, program, co, COUNT(stat) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', co.co_num as 'co', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE course.course_id LIKE '%$course%' GROUP BY enrollment.student_id, section.course_id, co.co_num ORDER BY stat DESC, co ASC) as testQ WHERE stat = 1 GROUP BY co";
			$achieved = $conn->query($query);
			$query = "SELECT school, department, program, co, COUNT(co) as 'stat' FROM (SELECT school.school_name as 'school', program.department_id as 'department', program.program_name as 'program', co.co_num as 'co', IF(SUM(evaluation.obtained_marks)/SUM(assessment.marks)>=0.40, 1, 0) AS 'stat' FROM school NATURAL LEFT JOIN department NATURAL LEFT JOIN program NATURAL LEFT JOIN course NATURAL LEFT JOIN section NATURAL LEFT JOIN assessment NATURAL LEFT JOIN evaluation NATURAL LEFT JOIN enrollment LEFT JOIN co ON assessment.co_number = co.co_num AND assessment.section_id = co.section_id LEFT JOIN PLO ON co.plo_id = plo.plo_id WHERE course.course_id LIKE '%$course%' GROUP BY enrollment.student_id, section.course_id, co.co_num ORDER BY stat DESC, co ASC) as testQ GROUP BY co";
			$attempted = $conn->query($query);
		}
		

		$c_stat = array();
		foreach($attempted as $a){
			$c_stat[$a['co']]=array();
			$c_stat[$a['co']]['achieved'] = 0;
			$c_stat[$a['co']]['attempted'] = $a['stat'];
		} 
		foreach($achieved as $a){
			$c_stat[$a['co']]['achieved'] = $a['stat'];
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
									<li class="active">
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
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">PLO Achieved/Attempted Comparison</div>
									<div class="row py-3">
										<div class="col-md-12">
											<div id="chart-container">
												<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
												<canvas id="plo-ac-at" style="display: block; height: 200px;" class="chartjs-render-monitor"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">PLO Attemption Comparison</div>
									<div class="row py-3">
										<div class="col-md-12">
											<div id="chart-container">
												<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
												<canvas id="plo-atmtn" style="display: block; height: 200px;" class="chartjs-render-monitor"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="row d-flex justify-content-center">
								<div class="col-8">
									<form method="GET">
										<div class="row">
											<div class="col-5">
												<div class="form-group form-floating-label">
													<select class="form-control input-border-bottom" id="selectFloatingLabel" name="qt" required>
														<option	option value='school' <?php if(isset($_GET['qt']) && $_GET['qt']=='school'){echo 'selected';} ?>>School</option>
														<option	option value='department'<?php if(isset($_GET['qt']) && $_GET['qt']=='department'){echo 'selected';} ?>>Department</option>
														<option	option value='program' <?php if(isset($_GET['qt']) && $_GET['qt']=='program'){echo 'selected';} ?>>Program</option>
														<option	option value='course' <?php if(isset($_GET['qt']) && $_GET['qt']=='course'){echo 'selected';} ?>>Course</option>
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
											<div class="col-2 mt-3">
												<button type="submit" class="btn btn-icon btn-round btn-primary">
													<i class="fa fa-search"></i>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-md-12" <?php if(!(isset($_GET['qs']) && sizeof($p_stat)>0)){echo 'hidden';} ?>>
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">PLO CO Stats</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
											<div class="row">
												<div class="col-sm-12">
												<table class="table table-striped mt-3">
													<thead>
														<tr>
															<th scope="col">CO / PLO</th>
															<th scope="col">Successfully Achieved</th>
															<th scope="col">Successfully Achieved (%)</th>
															<th scope="col">Failed to Achieve</th>
															<th scope="col">Failed to Achieve (%)</th>
														</tr>
													</thead>
													<tbody>
														<?php
															if(isset($_GET['qs']) && sizeof($c_stat)>0){
																foreach($c_stat as $c =>$v){
																	echo "<tr>
																			<td>CO".$c."</td>
																			<td>".$v['achieved']."</td>
																			<td>".round(($v['achieved']/$v['attempted']*100), 2)."%</td>
																			<td>".$v['attempted'] - $v['achieved']."</td>
																			<td>".round((($v['attempted'] - $v['achieved'])/$v['attempted']*100), 2)."%</td>
																		</tr>";
																}
																foreach($p_stat as $c =>$v){
																	echo "<tr>
																			<td>PLO".$c."</td>
																			<td>".$v['achieved']."</td>
																			<td>".round(($v['achieved']/$v['attempted']*100), 2)."%</td>
																			<td>".$v['attempted'] - $v['achieved']."</td>
																			<td>".round((($v['attempted'] - $v['achieved'])/$v['attempted']*100), 2)."%</td>
																		</tr>";
																}
															}
														?>
													</tbody>
												</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6" <?php if(!(isset($_GET['qs']) && sizeof($p_stat)>0)){echo 'hidden';} ?>>
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">PLO Comparison</div>
									<div class="row py-3">
										<div class="col-md-12">
											<div id="chart-container">
												<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
												<canvas id="plo-comp" style="display: block; height: 200px;" class="chartjs-render-monitor"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6" <?php if(!(isset($_GET['qs']) && sizeof($p_stat)>0)){echo 'hidden';} ?>>
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">CO Comparison</div>
									<div class="row py-3">
										<div class="col-md-12">
											<div id="chart-container">
												<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
												<canvas id="co-comp" style="display: block; height: 200px;" class="chartjs-render-monitor"></canvas>
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
                
    ?>
	
	<script>
		var spiderChart1 = document.getElementById('plo-ac-at').getContext('2d');
		var mySpiderChart1  = new Chart(spiderChart1 , {
			type: 'radar',
			data: {
				labels: [
					<?php
						foreach($p_perc as $p => $v){
							echo "'PLO$p', ";
						}
					?>
				],
				datasets : [{
					label: "Achieved",
					backgroundColor: 'rgba(23, 125, 255, 0.6)',
					borderColor: 'rgb(23, 125, 255)',
					data: [
						<?php
							foreach($p_perc as $p => $v){
								echo round(($v['achieved'] / $v['attempted'] * 100), 2).", ";
							}
						?>
					],
				},
				{
					label: "Failed",
					backgroundColor: 'rgba(242,89,975, 0.6)',
					borderColor: 'rgb(242,89,97)',
					data: [
						<?php
							foreach($p_perc as $p => $v){
								echo round((($v['attempted'] - $v['achieved']) / $v['attempted'] * 100), 2).", ";
							}
						?>
					],
				},
			],
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

		var barChart1 = document.getElementById('plo-atmtn').getContext('2d');
		var myBarChart1 = new Chart(barChart1, {
			type: 'bar',
			data: {
				labels: [
					<?php
                        foreach($p_perc as $k => $v){
                            echo "'PLO$k', ";
                        }
                    ?>
				],
				datasets : [{
					label: "# of Attemption",
					backgroundColor: 'rgba(23, 125, 255, 0.6)',
					borderColor: 'rgb(23, 125, 255)',
					data: [
						<?php
							foreach($p_perc as $k => $v){
								echo $v['attempted'].", ";
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

		var spiderChart2 = document.getElementById('plo-comp').getContext('2d');
		var mySpiderChart2  = new Chart(spiderChart2 , {
			type: 'radar',
			data: {
				labels: [
					<?php
						if(isset($_GET['qs']) && sizeof($c_stat)>0){
							foreach($p_stat as $p => $v){
								echo "'PLO$p', ";
							}
						}
					?>
				],
				datasets : [{
					label: "Achieved",
					backgroundColor: 'rgba(23, 125, 255, 0.6)',
					borderColor: 'rgb(23, 125, 255)',
					data: [
						<?php
							if(isset($_GET['qs']) && sizeof($c_stat)>0){
								foreach($p_stat as $p => $v){
									echo round(($v['achieved'] / $v['attempted'] * 100), 2).", ";
								}
							}
						?>
					],
				},
				{
					label: "Failed",
					backgroundColor: 'rgba(242,89,975, 0.6)',
					borderColor: 'rgb(242,89,97)',
					data: [
						<?php
							if(isset($_GET['qs']) && sizeof($c_stat)>0){
								foreach($p_stat as $p => $v){
									echo round((($v['attempted'] - $v['achieved']) / $v['attempted'] * 100), 2).", ";
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
					yAxes: [{
						ticks: {
							
						}
					}]
				},
			}
		});

		var spiderChart3 = document.getElementById('co-comp').getContext('2d');
		var mySpiderChart3  = new Chart(spiderChart3 , {
			type: 'radar',
			data: {
				labels: [
					<?php
						if(isset($_GET['qs']) && sizeof($c_stat)>0){
							foreach($c_stat as $p => $v){
								echo "'PLO$p', ";
							}
						}
					?>
				],
				datasets : [{
					label: "Achieved",
					backgroundColor: 'rgba(23, 125, 255, 0.6)',
					borderColor: 'rgb(23, 125, 255)',
					data: [
						<?php
							if(isset($_GET['qs']) && sizeof($c_stat)>0){
								foreach($c_stat as $p => $v){
									echo round(($v['achieved'] / $v['attempted'] * 100), 2).", ";
								}
							}
						?>
					],
				},
				{
					label: "Failed",
					backgroundColor: 'rgba(242,89,975, 0.6)',
					borderColor: 'rgb(242,89,97)',
					data: [
						<?php
							if(isset($_GET['qs']) && sizeof($c_stat)>0){
								foreach($c_stat as $p => $v){
									echo round((($v['attempted'] - $v['achieved']) / $v['attempted'] * 100), 2).", ";
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