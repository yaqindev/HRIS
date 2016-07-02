	<table width="100%" height="102px">
		<tr>
			<td width="100%" style="text-align:left; background:url('./assets/img/logo_eta.png') no-repeat right;">
				<h3><b>PERFORMANCE APPRAISAL</b> </h3>
			</td>
		</tr>
	</table>
	<br>
	<table style="width:100%">
		<tr>
			<td style="width:15%"><b>Department</b></td>
			<td style="width:35%">: <?= $department ?> </td>
			<td style="width:15%"><b>Name</b></td>
			<td style="width:35%">: <?= $nama_karyawan ?></td>
		</tr>
		<tr>
			<td style="width:15%"><b>Segment</b></td>
			<td style="width:35%">: <?= $segment ?> </td>
			<td style="width:15%"><b>NIK</b></td>
			<td style="width:35%">: <?= $nik ?></td>
		</tr>
		<tr>
			<td style="width:15%"><b>Job Position</b></td>
			<td style="width:35%">: <?= $job ?></td>
			<td style="width:15%"><b>Periode</b></td>
			<td style="width:35%">: <?= ucfirst(strtolower($periode)) ?>, <?= $tahun ?></td>
		</tr>
	</table>
	<br>
	<table style="width:100%" border="1px" cellspacing="0" cellpadding="4px">
		<thead>
			<tr>
				<th style ="text-align:center;" width="5%">No.</th>
				<th style ="text-align:center;" width="40%">Criteria</th>
				<th style ="text-align:center;" width="15%">Score</th>
				<th style ="text-align:center;" width="15%">Weight</th>
				<th style ="text-align:center;" width="15%">Total Score</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				echo '	
				<tr>
					<td style="text-align:center">1</td>
					<td>KPI Department</td>
					<td style="text-align:center">'.$score_kpi.'</td>
					<td style="text-align:center">20%</td>
					<td style="text-align:center">'.$total_score_kpi.'</td>
				</tr>';
				echo '	
				<tr>
					<td style="text-align:center">2</td>
					<td>Competency</td>
					<td style="text-align:center">'.$score_competency.'</td>
					<td style="text-align:center">60%</td>
					<td style="text-align:center">'.$total_score_competency.'</td>
				</tr>';
				echo '	
				<tr>
					<td style="text-align:center">3</td>
					<td>ZAP</td>
					<td style="text-align:center">'.$score_zap.'</td>
					<td style="text-align:center">20%</td>
					<td style="text-align:center">'.$total_score_zap.'</td>
				</tr>';
				echo '	
				<tr>
					<td style="text-align:center">4</td>
					<td>Disciplinary</td>
					<td style="text-align:center">'.$score_disciplinary.'</td>
					<td style="text-align:center"></td>
					<td style="text-align:center">'.$total_score_disciplinary.'</td>
				</tr>';
				echo '	
				<tr>
					<td colspan="4" style="text-align:right"><b>Total Score</b></td>
					<td style="text-align:center"><b>'.$total_score.'</b></td>
				</tr>';
				echo '	
				<tr>
					<td colspan="4" style="text-align:right"><b>Nilai</b></td>
					<td style="text-align:center"><b>'.$grade.'</b></td>
				</tr>';
			?>
		</tbody>
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
