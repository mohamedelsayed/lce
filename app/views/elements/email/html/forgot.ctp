Hi <?php echo $member['User']['name'];?>,<br />
Your Password is encrypted to change it please click on the link below:<br />
<a href="<?php echo $url.'/forget-password/'.$member['User']['id'].'/'.$code;?>">
	Change your password
</a>
<br />Thank you.