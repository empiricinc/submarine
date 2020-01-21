<!DOCTYPE html>
<html>
<head>
	<title>Offer Letter</title>
</head>
<style type="text/css">
	body{
		margin: 45px;
		padding: 25px;
		line-height: 12px;
		font-family: sans-serif, book antiqua;
		font-size: 9px;
	}
	h1, h4{
		text-align: center;
		font-family: sans-serif, book antiqua;
		line-height: 2px;
	}
	table#personal_info{
		text-align: left;
		padding: 2px 3px 5px 5px;
	}
	table#assessment{
		text-align: left;
		padding: 1px;
	}
	table#remarks{
		text-align: left;
		padding: 2px 3px 5px 5px;
	}
</style>
<body>
	<h1>CHIP Training and Consulting (Pvt) Ltd.</h1>
	<h4>Interview Assessment Sheet for FCW/CHW</h4>
	<table border="1" id="personal_info">
		<tbody>
			<tr>
			<td>Candidate's Name</td>
			<td><?php echo $sheet->fullname; ?></td>
			</tr>
			<tr>
				<td>Father / Husband Name</td>
				<td></td>
			</tr>
			<tr>
				<td>CNIC #</td>
				<td><?php echo $sheet->cnic; ?></td>
			</tr>
			<tr>
				<td>Contact #</td>
				<td><?php //echo $sheet->cnic; ?></td>
			</tr>
			<tr>
				<td>Position applied for</td>
				<td><?php echo $sheet->designation_name; ?></td>
			</tr>
			<tr>
				<td>District/UC/Area code</td>
				<td><?php //echo $sheet->cnic; ?></td>
			</tr>
			<tr>
				<td>Date of Interview</td>
				<td><?php echo date('M d, Y', strtotime($sheet->sdt)); ?></td>
			</tr>
		</tbody>
	</table>
	<br><br>
	<table border="1" id="assessment">
		<tbody>
			<tr>
				<td>Areas of Assessment</td>
				<td>Points of Importance</td>
				<td>Max Marks</td>
				<td>Marks Awarded</td>
				<td>Remarks (If any)</td>
			</tr>
			<tr>
				<td>Age / D.O.B</td>
				<td>Below 25 year=0, 25-35 years = 5, above 35 years=10</td>
				<td align="center">10 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Marital Status</td>
				<td>Married, Widow, Divorce = 5, Single above 30 years = 3, Young single = 2</td>
				<td align="center">5 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Qualification</td>
				<td>Literate = 5, Matric = 10, Illiterate = 0</td>
				<td align="center">10 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Experience/ Professional Affiliation</td>
				<td>Working experience upto 5 years in polio program = 5, Midwife, LHW, Health program related experience etc = 5</td>
				<td align="center">10 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Commnunication skills</td>
				<td>As per question</td>
				<td align="center">5 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Mobility</td>
				<td>As per question</td>
				<td align="center">5 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Local language skills</td>
				<td>As per question</td>
				<td align="center">5 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Total score</td>
				<td></td>
				<td align="center"><?php echo $sheet->total_marks; ?></td>
				<td align="center"><?php echo $sheet->obtain_marks; ?></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<br><br>
	<table border="1" id="remarks">
		<tbody>
			<tr>
				<td>Overall Remarks</td>
				<td><?php echo $sheet->remark10; ?></td>
			</tr>
			<tr>
				<td>Interviewer's Signature</td>
				<td></td>
			</tr>
			<tr>
				<td>Interviewer's Name</td>
				<td></td>
			</tr>
		</tbody>
	</table>
</body>
</html>