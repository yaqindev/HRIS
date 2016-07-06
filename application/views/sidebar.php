
<div id="sidebar"  class="nav-collapse ">
  <!-- sidebar menu start-->
<ul class="sidebar-menu" id="nav-accordion">
	<p class="centered">
	</p>
	<h5 class="centered">&nbsp;</h5>
  		
		
	<li class="sub-menu">
		<a href="<?php echo base_url()."dashboard";?>" class="dropdown-toggle">
            <i class="fa fa-desktop"></i>
            <span>Home</span>
        </a>
	</li>
	<!--MASTER-EMPLOYEE-->
	<?php if ($_SESSION['level']=='1'): ?>
	
	<li class="sub-menu">
        <a href="javascript:;" class="dropdown-toggle">
            <i class="fa fa-user"></i>
            <span>&nbsp;Data Employee</span>
        </a>
        <ul class="sub">
            <li><a  href="<?php echo base_url()."master/user";?>"><i class="menu-icon fa fa-caret-right"></i>Master User</a> </li>
            <li><a  href="<?php echo base_url()."master/employee";?>"><i class="menu-icon fa fa-caret-right"></i>Master Employee</a> </li>
			<li><a  href="<?php echo base_url()."master/department";?>"><i class="menu-icon fa fa-caret-right"></i>Master Department</a></li>
			<li><a  href="<?php echo base_url()."master/segment";?>"><i class="menu-icon fa fa-caret-right"></i>Master Segment</a></li>
			<li><a  href="<?php echo base_url()."master/group";?>"><i class="menu-icon fa fa-caret-right"></i>Master Group</a></li>
			<li><a  href="<?php echo base_url()."master/joblist";?>"><i class="menu-icon fa fa-caret-right"></i>Master Job</a></li>
		</ul>
    </li>

	<!--PERFORMANCE-->
	<li class="sub-menu">
		<a href="#">
			<i class="fa fa-dashboard"></i>
			<span>&nbsp;Data Appraisal</span>
		</a>
		<ul class="sub">
		<!--KPI-->
		<li class="sub">
			<a href="<?php echo base_url()."appraisal/kpi";?>">
				<span>Master KPI</span>
			</a>
			
		</li>
		<!--COMPETENCY-->
		<li class="sub">
			<a href="<?php echo base_url()."appraisal/competency";?>">
				<span>Master Competency</span>
			</a>
		</li>
		</ul>
	</li>
	<?php endif ?>
	<?php if ($_SESSION['level']=='1' || $_SESSION['level']=='2'): ?>
		
	<li class="sub-menu">
		<a href="#">
			<i class="fa fa-plus"></i>
			<span>&nbsp;Performance</span>
		</a>
		<ul class="sub">
			<li class="sub">
			<a href="<?php echo base_url()."performance/performance_kpi";?>">
				<span>KPI</span>
			</a>
			</li>
			<li class="sub">
			<a href="<?php echo base_url()."performance/performance_competency";?>">
				<span>Competency</span>
			</a>
			</li>
			<li class="sub">
			<a href="<?php echo base_url()."performance/performance_zap";?>">
				<span>ZAP</span>
			</a>
			</li>
			<li class="sub">
			<a href="<?php echo base_url()."performance/performance_disciplinary";?>">
				<span>Diciplinary</span>
			</a>
			</li>
			<li class="sub">
			<a href="<?php echo base_url()."performance/performance_appraisal";?>">
				<span>Performance Appraisal</span>
			</a>
			</li>
		</ul>
	</li>
	<?php endif ?>
	<li class="sub-menu">
		<a href="<?php echo base_url()."laporan/report";?>" class="dropdown-toggle">
			<i class="fa fa-book"></i>
			<span>&nbsp;Report</span>
		</a>		
	</li>
    </ul>
  <!-- sidebar menu end-->
</div>