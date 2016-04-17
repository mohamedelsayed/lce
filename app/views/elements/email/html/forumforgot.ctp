Hi <?php echo $member['Member']['fullname'];?>,<br />
Your username: <?php echo $member['Member']['username'];?>,<br />
Your Password is encrypted to change it please click on the link below:<br />
<a href="<?php echo $url.'/forum/forget/'.$member['Member']['id'].'/'.$code;?>">
	Change your password
</a>
<br />Thank you.