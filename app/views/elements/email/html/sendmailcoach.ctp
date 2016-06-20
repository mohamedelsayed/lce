<?php $dark_color1 = '#f58521';
$dark_color2 = '#000000';
$medium_color = '#cdcbcc';
$light_color = '#FFFFFF';?>
<html>
	<head></head>
	<body>
		<style type="text/css">
		@import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
		.element{
			text-shadow:<?php echo $dark_color2;?>;
			font-size:16px;		
			color: <?php echo $dark_color2;?>;
			font-family: Montserrat; 		
		}
		.title{
			font-family: Montserrat;
			text-shadow:<?php echo $dark_color1;?>;
			font-size:16px;
			color:<?php echo $light_color;?>;
		}
		.bold{
			font-weight: bold;
		}
		</style>
		<?php if($coach_admin == 1){
			if(isset($additional_admin_info)){
				echo $additional_admin_info;
			}
		}?>
		<?php if($normal_coach == 1 || $coach_admin == 1){?>
		<table style="direction: ltr;" class="maintable" width='100%' cellspacing='0' cellpadding='2' bgcolor="<?php echo $medium_color;?>">
			<tr bgcolor='<?php echo $dark_color1;?>'>
				<td height='30' colspan='2'>
					<font class="title">
						<strong><?php echo $subject;?></strong>
					</font>
				</td>
			</tr>
			<tr>
				<td colspan='2' align='center' height="30"></td>
			</tr>
			<?php if($first_name != ''){?>
				<tr>
					<td align='left'>
						<font class="element bold">First Name:</font>
					</td>
					<td>
						<font class="element"><?php echo $first_name;?></font>
					</td>
				</tr>
			<?php }?>
			<?php if($last_name != ''){?>
				<tr>
					<td align='left'>
						<font class="element bold">Last Name:</font>
					</td>
					<td>
						<font class="element"><?php echo $last_name;?></font>
					</td>
				</tr>
			<?php }?>
			<?php if($email != ''){?>
				<tr>
					<td align='left'>
						<font class="element bold">Email:</font>
					</td>
					<td>
						<font class="element"><?php echo $email;?></font>
					</td>
				</tr>
			<?php }?>
			<?php if($mobile_number != ''){?>
				<tr>
					<td align='left'>
						<font class="element bold">Mobile Number:</font>
					</td>
					<td>
						<font class="element"><?php echo $mobile_number;?></font>
					</td>
				</tr>
			<?php }?>	
			<?php if($message != ''){?>
				<tr>
					<td align='left'>
						<font class="element bold">Message:</font>
					</td>
					<td>
						<font class="element"><?php echo $message;?></font>
					</td>
				</tr>
			<?php }?>
			<tr>
				<td colspan='2' height="30"></td>
			</tr>
			<tr>
				<td height='30' colspan='2' bgcolor='<?php echo $dark_color1;?>'></td>
			</tr>
		</table>
		<?php }?>
		<?php if($coach_admin == 1){
			$subject = 'Coach info';
		}?>
		<?php if($normal_user == 1 || $coach_admin == 1){?>
			<?php if($normal_user == 1 ){?>
			<p>Dear <?php echo $user_full_name;?>,</p>
			<p>Thank you for your interest in our services. Kindly find below the contacts of <?php echo $name;?>.</p>
		<?php }?>
		<br />
		<table style="direction: ltr;" class="maintable" width='100%' cellspacing='0' cellpadding='2' bgcolor="<?php echo $medium_color;?>">
			<tr bgcolor='<?php echo $dark_color1;?>'>
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
					<td align='left'>
						<font class="element bold">Coache Name:</font>
					</td>
					<td>
						<font class="element"><?php echo $name;?></font>
					</td>
				</tr>
			<?php }?>
			<?php if($email != ''){?>
				<tr>
					<td align='left'>
						<font class="element bold">Email:</font>
					</td>
					<td>
						<font class="element"><?php echo $email;?></font>
					</td>
				</tr>
			<?php }?>
			<?php if($facebook != ''){?>
				<tr>
					<td align='left'>
						<font class="element bold">Facebook:</font>
					</td>
					<td>
						<font class="element"><?php echo $facebook;?></font>
					</td>
				</tr>
			<?php }?>	
			<?php if($linkedin != ''){?>
				<tr>
					<td align='left'>
						<font class="element bold">Linkedin:</font>
					</td>
					<td>
						<font class="element"><?php echo $linkedin;?></font>
					</td>
				</tr>
			<?php }?>
			<?php if($mobile != ''){?>
				<tr>
					<td align='left'>
						<font class="element bold">Mobile:</font>
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
				<td height='30' colspan='2' bgcolor='<?php echo $dark_color1;?>'></td>
			</tr>
		</table>
		<?php }?>
		<p>Warm regards,</p>
		<p>LCE Team</p>
	</body>
</html>