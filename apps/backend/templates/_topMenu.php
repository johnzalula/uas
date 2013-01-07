<?php if(($sf_request->getParameter('module')== "user")): ?>
<ul>
	
    <li><a <?php echo $sf_request->getParameter('user_status') == 'all_users' ? 'class="active"' : ''; ?> href="<?php echo url_for('user/show?user_status=all_users'.'&pagesize='.$sf_request->getParameter('pagesize', 10));?>" ><?php echo ('All Users');?></a></li>

    <li><a <?php echo $sf_request->getParameter('user_status') == 'activated' ? 'class="active"' : ''; ?> href="<?php echo url_for('user/show?user_status=activated'.'&pagesize='.$sf_request->getParameter('pagesize', 10));?>" ><?php echo ('Activated');?></a></li>
    <li><a <?php echo $sf_request->getParameter('user_status') == 'disactivated' ? 'class="active"' : ''; ?> href="<?php echo url_for('user/show?user_status=disactivated'.'&pagesize='.$sf_request->getParameter('pagesize', 10));?>" ><?php echo ('Disactivated');?></a></li>
    <li><a <?php echo $sf_request->getParameter('user_status') == 'preregistered' ? 'class="active"' : ''; ?> href="<?php echo url_for('user/show?user_status=preregistered'.'&pagesize='.$sf_request->getParameter('pagesize', 10));?>" ><?php echo ('Preregistered');?></a></li>
</ul>

<?php endif; ?>
