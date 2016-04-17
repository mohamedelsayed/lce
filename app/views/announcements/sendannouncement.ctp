<div class="announcements form">
	<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]?>" method="post" id="sendannouncementform" enctype="multipart/form-data">
		<fieldset>
	 		<legend><?php __('Send Announcement'); ?></legend>
			<input type="hidden" name="announcementid" value="<?php echo $id;?>" />
			<div class="wrap">
				<table class="head">
					<tr>
						<td class="firstcolumn"><input id="selectall" type="checkbox"></td>
						<td class="secondcolumn">User</td>
					</tr>
				</table>
				<div class="inner_table">
					<table>
						<?php foreach ($members as $key => $member) {?>								
							<tr>
								<td class="firstcolumn" align="center">
									<input class="membersids" name="membersids[]" value="<?php echo $member['Member']['id'];?>" type="checkbox">
								</td>
								<td class="secondcolumn">
									<?php echo $member['Member']['fullname'];?>
								</td>
							</tr>						
						<?php }?>
					</table>
				</div>
			</div>								
		</fieldset>
		<div class="submit">
			<input type="submit" value="Send">
		</div>
	</form>
</div>
<script language="javascript">
$(function(){
	$("#selectall").click(function(){
		$('.membersids').attr('checked',this.checked);
	});
	$(".membersids").click(function(){
		if($(".membersids").length==$(".membersids:checked").length){
			$("#selectall").attr("checked","checked");
		}else{
			$("#selectall").removeAttr("checked");
		}
	});
});
</script>
<style type="text/css">
.wrap {
	width: 920px;
	margin: 15px;
}
.wrap table {
	width: 920px;
	table-layout: fixed;
}
table tr td {
	padding: 5px;
	border: 1px solid #eee;
	width: 200px;
	word-wrap: break-word;
}
table.head tr td {
	background: #eee;
}
.inner_table {
    height: 400px;
    overflow-y: auto;
    overflow-x:hidden;
}
.firstcolumn{
	width: 1px;
}
.secondcolumn{
	width: 250px;
}
table.head{
	margin-bottom: 0px;
	
}
.inner_table{
	width: 920px;
}
</style>