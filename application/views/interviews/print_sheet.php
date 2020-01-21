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
	<h4>Interview Assessment Sheet for DHCSO</h4>
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
				<td>Guiding Points</td>
				<td>Marking Criteria</td>
				<td>Max Marks</td>
				<td>Marks Awarded</td>
				<td>Remarks (If any)</td>
			</tr>
			<tr>
				<td>Personality</td>
				<td>Appearance, Dressing</td>
				<td>Interviewer should assess whether s/he properly dressed up for the interview = 2, Not = 0</td>
				<td align="center">2 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Conduct during interview</td>
				<td>General conduct/communication with coordinators and panel members</td>
				<td>Satisfactory = 3, Normal = 1, Poor = 0</td>
				<td align="center">3 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Qualification</td>
				<td>Relevant qualification as per TORs or Master level qualification however not</td>
				<td>Relevant qualification = 5, Not Relavant = 2</td>
				<td align="center">5 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Experience</td>
				<td>Relavant experience as per TORs and general experience</td>
				<td>One mark per year for relevant experience while for general experience not relevant to the position total marks will be max. 2.</td>
				<td align="center">5 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Job Competence Assessment</td>
				<td>Competence assessment through scenario based questions taken from TORs</td>
				<td>Ask 5 scenario based questions relevant to the position, (2 marks each * 5 questions)</td>
				<td align="center">10 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Job Knowledge</td>
				<td>Knowledge of the position and TORs s/he has applied for</td>
				<td>Ask three questions on the job position and TORs (2 marks each * 3 questions)</td>
				<td align="center">10 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Computer proficiency</td>
				<td>Competence assessment through scenario based questions taken from TORs</td>
				<td>Ask 3 scenario based questions relevant to the position, (2 marks each * 3 questions)</td>
				<td align="center">6 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Personal attributes</td>
				<td>Competencies (integrity, ambition, initiative, learning aptitude)</td>
				<td>As per panel members judgement</td>
				<td align="center">5 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Communication skills</td>
				<td>Effectively expressing and conveying ideas in response to questions</td>
				<td>Ask questions on strength and weaknesses and mark accordingly</td>
				<td align="center">8 * 3</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Total score</td>
				<td></td>
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