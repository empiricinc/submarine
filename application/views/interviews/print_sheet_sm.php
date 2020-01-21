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
		font-size: 10px;
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
	table#comments{
		text-align: left;
		padding: 2px 3px 5px 5px;
	}
</style>
<body>
	<h1>CHIP Training and Consulting (Pvt) Ltd.</h1>
	<h4>Interview Assessment Sheet for SM/UCCSO</h4>
	<table border="1" id="personal_info">
		<tbody>
			<tr>
			<td>Candidate's Name</td>
			<td><?php echo $sheet->fullname; ?></td>
			</tr>
			<tr>
				<td>Position</td>
				<td><?php echo $sheet->designation_name; ?></td>
			</tr>
			<tr>
				<td>Location: District / Agency</td>
				<td></td>
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
				<td>Personality</td>
				<td>Appearance, Dress, Manner of conducting him/herself</td>
				<td align="center">5 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Qualification</td>
				<td>Relevance to position</td>
				<td align="center">5 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Experience</td>
				<td>Relevance to position</td>
				<td align="center">5 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Job knowledge</td>
				<td>Knowledge of job contents, development world</td>
				<td align="center">10 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Personal attributes/ Supervisory skills</td>
				<td>Competencies (integrity, ambition, leadership, initiative, loyalty, learning, resourceful)</td>
				<td align="center">10 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Reporting and Computer skills</td>
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
				<td>Communication Skills</td>
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
	<br><br>
	<table border="1" id="comments">
		<tbody>
			<tr>
				<td>*Maximum marks to be assigned to each area of assessment must be decided by the interview panel, in light of the vacancy to be filled, before the start of the interview exercise, the total marks for all areas must add up 50.</td>
			</tr>
		</tbody>
	</table>
</body>
</html>