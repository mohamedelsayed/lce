<html>
	<head></head>
	<body>
		<style type="text/css">
			.element{
				text-shadow:#000000;
				font-size:16px;		
				color: #000000;
				font-family: Verdana, Arial, Helvetica, sans-serif; 		
			}
			.title{
				font-family: Verdana, Arial, Helvetica, sans-serif;
				text-shadow:#000000;
				font-size:16px;
				color:#FFFFFF;
			}
			.maintable{
				border-bottom-color:#384270;
				border-left-color: #384270;
				border-right-color:#384270;
				border-top-color:#384270;
			}
		</style>
		<table style="direction: ltr;" class="maintable" width='500' cellspacing='0' cellpadding='2' bgcolor="#cdcbcc">
			<tr bgcolor='#000000'>
				<td height='30' colspan='2'>
					<font class="title">
						<strong><?php echo $subject;?></strong>
					</font>
				</td>
			</tr>
			<tr>
				<td colspan='2' align='center' height="30"></td>
			</tr>
			<?php if($name != ''){?>
				<tr>
					<td align='left' style='color:#FFFF00'>
						<font class="element">Coache Name:</font>
					</td>
					<td>
						<font class="element"><?php echo $name;?></font>
					</td>
				</tr>
			<?php }?>
			<?php if($email != ''){?>
				<tr>
					<td align='left' style='color:#FFFF00'>
						<font class="element">Email:</font>
					</td>
					<td>
						<font class="element"><?php echo $email;?></font>
					</td>
				</tr>
			<?php }?>
			<?php if($facebook != ''){?>
				<tr>
					<td align='left' style='color:#FFFF00'>
						<font class="element">Facebook:</font>
					</td>
					<td>
						<font class="element"><?php echo $facebook;?></font>
					</td>
				</tr>
			<?php }?>	
			<?php if($linkedin != ''){?>
				<tr>
					<td align='left' style='color:#FFFF00'>
						<font class="element">Linkedin:</font>
					</td>
					<td>
						<font class="element"><?php echo $linkedin;?></font>
					</td>
				</tr>
			<?php }?>
			<?php if($mobile != ''){?>
				<tr>
					<td align='left' style='color:#FFFF00'>
						<font class="element">Mobile:</font>
					</td>
					<td>
						<font class="element"><?php echo $mobile;?></font>
					</td>
				</tr>
			<?php }?>
			<tr>
				<td colspan='2' height="30"></td>
			</tr>
			<tr>
				<td height='30' colspan='2' bgcolor='#000000'></td>
			</tr>
		</table>
	</body>
</html>