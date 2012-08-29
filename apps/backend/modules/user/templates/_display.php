<script type="text/javascript">

	$(function(){
 
    // add multiple select / deselect functionality
    $("#allcheckBox").click(function () {
          $('.checkBox').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".checkBox").click(function(){
 
        if($(".checkBox").length == $(".checkBox:checked").length) {
            $("#allcheckBox").attr("checked", "checked");
        } else {
            $("#allcheckBox").removeAttr("checked");
        }
 
    }); 
});

</script>
<div id="userListDisplay">
<form class="form-inline" action="<?php echo url_for('user/batch');?>" method="post" name="alluserfrm">

<div class="sf_admin_userList" >
	<table>
		<thead>
			<tr>
				<th class="check-box"><input type="checkbox" id="allcheckBox" name="all-check-box" value="true" /></td>
				</th>
				<th>Login Name</th>
				<th>Full Name</th>
				<th>ID No</th>
				<th>Status</th>
				<th class="sf_admin_user_action">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $i => $user):?>
			<tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
				<td><input type="checkbox" id="check-box<?php echo $i;?>" name="check-box[<?php echo $user->getId();?>]" class="checkBox"  /></td>
		</td>
				<td><?php echo $user->getLogin() ?></td>
				<td><?php echo $user->getFullName() ?></td>
				<td><?php echo $user->getLogin() ?></td>
				<td><strong><?php echo ucfirst($user->getStatus()) ?></strong></td>

				<td class="sf_admin_user_action_list">
					<ul>
						<?php if(($sf_request->getParameter('user_status') == "disactivated") || ($sf_request->getParameter('user_status') == "preregistered") || ($sf_request->getParameter('user_status') == "all_users")): ?>
						<li><a href="<?php echo url_for('user/activate?user_id='.$user->getId()) ?>"><img src="<?php echo image_path('tick') ?>" alt="activate user"></a></li>
						<?php endif; ?>
						<?php if(($sf_request->getParameter('user_status') == "activated") || ($sf_request->getParameter('user_status') == "all_users")): ?>
						<li><a href="<?php echo url_for('user/disactivate?user_id='.$user->getId()) ?>""><img src="<?php echo image_path('deny') ?>" alt="disactivate user"></a></li>
						<?php endif; ?>
						<li><a href="<?php echo url_for('user/disactivate?user_id='.$user->getId()) ?>""><img src="<?php echo image_path('delete') ?>" alt="delete user"></a></li>
					</ul>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan=6>
					<div class="footerInput"> 
						<input type="hidden" name="user_status" value="<?php echo $sf_request->getParameter('user_status') ?>">           
						<label>With selected do:</label>
						 <select id="select1" name="groupaction" class="">
				          <option>Batch Action</option>
				          <option>Activate</option>
				          <option>Disactivate</option>
				          <option>Delete</option>
				        </select>
						 <button type="submit" class="button">Go</button>
					</div>
				</th>
			</tr>
		</tfoot>
	</table>
</div>
</form>
</div>
