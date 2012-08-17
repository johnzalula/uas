<div class="sf_admin_userList">
	<table>
		<thead>
			<tr>
				<th class="check-box"><input type="checkbox" id="allUsers" name="allUsers-checkbox" value="true" /> </th>
				<th>Login Name</th>
				<th>Full Name</th>
				<th>ID No</th>
				<th>Status</th>
				<th class="sf_admin_user_action">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $i => $user):?>
			<tr>
				<td><input type="checkbox" id="allUsers" name="allUsers-checkbox" value="true" /></td>
				<td><?php echo $user->getLogin() ?></td>
				<td><?php echo $user->getFullName() ?></td>
				<td><?php echo $user->getLogin() ?></td>
				<td><?php echo $user->getStatus() ?></td>
				<td class="sf_admin_user_action_list">
					<ul>
						<li><a href="">Activate</a></li>
						<li><a href="">Disactivate</a></li>
					</ul>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan=6>&nbsp;</th>
			</tr>
		</tfoot>
	</table>
</div>
