<?php $level = $_SESSION['level']; ?>
	<table width="100%" height="102px">
		<tr>
			<td width="100%" style="text-align:left; background:url('./assets/img/logo_eta.png') no-repeat right;">
				<h3><b>PERFORMANCE DEPARMENT <?php echo strtoupper($department); ?></b> </h3>
			</td>
		</tr>
	</table>
	<br>
	<table style="width:100%">
		<tr>
			<td style="width:15%"><b>Kriteria</b></td>
			<td style="width:35%">: <?= $kriteria ?> </td>
			<td style="width:15%"><b>Periode</b></td>
			<td style="width:35%">: <?= ucfirst(strtolower($periode)) ?>, <?= $tahun ?></td>
		</tr>
	</table>
	<br>
	<table style="width:100%" border="1px" cellspacing="0" cellpadding="4px">
			<tr>
				<th style ="text-align:center;" width="5%">No.</th>
				<th style ="text-align:center;" width="60%"><?php if ($level == '1'||$level == '3') {echo "Department";}else{echo "Segment";} ?></th>
				<th style ="text-align:center;" width="15%">Nilai</th>
			</tr>
		<?php 
		$no = 1;
		if ($_SESSION['level']=='1'||$_SESSION['level']=='3')
		{
			foreach ($dept as $dept) {
			echo '
			<tr>
				<td style="text-align:center">'.$no++.'</td>
				<td>'.$dept->DEPARTMENT_NAME.'</td>
				<td style="text-align:center">'.round($dept->DEPT,2).'</td>
			</tr>
			';
			}
		}else{
			foreach ($dept as $dept) {
			echo '
			<tr>
				<td style="text-align:center">'.$no++.'</td>
				<td>'.$dept->SEGMENT_NAME.'</td>
				<td style="text-align:center">'.round($dept->DEPT,2).'</td>
			</tr>
			';
			}
		}
		?>
	</table>
	<br>
	<br>
	<table style="width:100%;">
		<tr>
			<td style="width:70%;text-align:center;"></td>
			<td style="width:30%;text-align:center;">
				<p>Surabaya, <?= date("d").' '.$this->tanggal->bulan(date("m")).' '.date("Y") ?></p>
				<p>Dicetak oleh,</p>
				<br>
				<br>
				<br>
				<p><b><u>.....................................</u></b></p>
				<p>NIK :
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</p>
			</td>
		</tr>
	</table>
