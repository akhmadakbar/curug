<?php echo $content; ?>
<form action="..\approve\<?php echo $id;?>" method="post">
	<div class="form-group">
	  <label for="comment">Comment:</label>
	  <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
	</div>
	<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;">
		<tr>
			<td style="border-radius: 3px; background: #065497; text-align: center;" class="button-td">
				<button type="submit" name="approve" style="background: #065497; border: 15px solid #065497; font-family: sans-serif; font-size: 13px; line-height: 110%; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold; color:#ffffff;" class="button-a" value="approve">
				Approve</button>
			</td>
			<td style="width: 10px;">
			</td>
			<td style="border-radius: 3px; background: #065497; text-align: center;" class="button-td">
				<button type="submit" name="reject" style="background: #065497; border: 15px solid #065497; font-family: sans-serif; font-size: 13px; line-height: 110%; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold; color:#ffffff;" class="button-a" value="reject">
				Reject</button>
			</td>
		</tr>
	</table>
</form>

<!--

	<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;">
		<tr>
			<td style="border-radius: 3px; background: #065497; text-align: center;" class="button-td">
				<a href="<?php echo $link_approve;?>" style="background: #065497; border: 15px solid #065497; font-family: sans-serif; font-size: 13px; line-height: 110%; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
					<span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;Approve&nbsp;&nbsp;&nbsp;&nbsp;</span>
				</a>
			</td>
			<td style="width: 10px;">
			</td>
			<td style="border-radius: 3px; background: #065497; text-align: center;" class="button-td">
				<a href="<?php echo $link_reject;?>" style="background: #065497; border: 15px solid #065497; font-family: sans-serif; font-size: 13px; line-height: 110%; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
					<span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;Reject&nbsp;&nbsp;&nbsp;&nbsp;</span>
				</a>
			</td>
		</tr>
	</table>

-->