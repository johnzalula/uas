<script language="JavaScript">

	var text_val = document.getElementById("page_no_display").value;
	alert(text_val);	
	
}
</script>

<?php if($sf_request->getParameter('user_status')): ?>
<?php $sf_response->setTitle('UAS - '.('User'));?>

<?php if ($sf_user->getFlash('selectfield.error', 0) != 0):?>
<div id="messageLayer">
	<div class="alert alert-error">
		<a class="close" data-dismiss="alert">&times;</a>
		Please select <strong>Users </strong> from the list.
	</div>
</div>
<?php endif; ?>

<?php if ($sf_user->getFlash('select.error', 0) != 0):?>
<div id="messageLayer">
	<div class="alert alert-error">
		<a class="close" data-dismiss="alert">&times;</a> 
		Please select action!
	</div>
</div>
<?php endif; ?>

<?php if ($sf_user->getFlash('user_activated.success', 0) != 0):?>
<div id="messageLayer">
	<div class="alert alert-success">
		<a class="close" data-dismiss="alert">&times;</a>
			<strong>User status activated</strong> successfully.
	</div>
</div>
<?php endif; ?>

<?php if ($sf_user->getFlash('user_disactivated.success', 0) != 0):?>
<div id="messageLayer">
	<div class="alert alert-success">
		<a class="close" data-dismiss="alert">&times;</a>
			<strong>User status disactivated</strong> successfully.
	</div>
</div>
<?php endif; ?>


<?php if ($sf_user->getFlash('disactivated.success', 0) != 0):?>
<div id="messageLayer">
	<div class="alert alert-success">
		<a class="close" data-dismiss="alert">&times;</a>
			<strong>Users status disactivated</strong> successfully.
	</div>
</div>
<?php endif; ?>

<?php if ($sf_user->getFlash('activated.success', 0) != 0):?>
<div id="messageLayer">
	<div class="alert alert-success">
		<a class="close" data-dismiss="alert">&times;</a>
			<strong>Users status activated</strong> successfully.
	</div>
</div>
<?php endif; ?>

<?php if ($sf_user->getFlash('delete.success', 0) != 0):?>
<div id="messageLayer">
	<div class="alert alert-success">
		<a class="close" data-dismiss="alert">&times;</a>
		<strong>User</strong> deleted successfully.
	</div>
</div>
<?php endif; ?>
 
<div class="sf_admin_userPanel">
	<div class="sf_admin_userHeader">
	<h1><?php echo ucfirst($sf_request->getParameter('user_status')) ?> Users </h1>
		<?php include_partial('global/topMenu');?>
	</div>
	<div class="sf_admin_userContent">
		<?php include_partial('display', array('users' => $pager->getResults())) ?>
	</div>
	<div class="sf_admin_paginationBox-cont">
		<div class="sf_admin_pagination-Box">	
			<?php if ($pager->haveToPaginate()): ?> 
	<div class="paginationBox">
		<form class="form-horizontal" action="<?php echo url_for('@show_user') ?>" method="get">
			<div class="paginateBox">
				<div class="paginate">
					<ul>
						
						<li class="display_list" id="display">Display: # 
						<select onclick="<?php echo url_for('@show_user') ?>" name="pagesize" class="selspan" id="pagesize">
                <option value="5" <?php echo $sf_request->getParameter('pagesize', 5) == 5? 'selected' : '';?>>5</option>
                <option value="10" <?php echo $sf_request->getParameter('pagesize', 5) == 10? 'selected' : '';?>>10</option>
                <option value="15" <?php echo $sf_request->getParameter('pagesize', 5) == 15? 'selected' : '';?>>15</option>
                <option value="20" <?php echo $sf_request->getParameter('pagesize', 5) == 20? 'selected' : '';?>>20</option>
                <option value="25" <?php echo $sf_request->getParameter('pagesize', 5) == 25? 'selected' : '';?>>25</option>
                <option value="30" <?php echo $sf_request->getParameter('pagesize', 5) == 30? 'selected' : '';?>>30</option>
            </select>	
						<input type="hidden" name="user_status" value="<?php echo $sf_request->getParameter('user_status') ?>" >	
						
						<input type="submit" class="btn btn-primary" value="ok">			
						</li>
						<li class="first_page"><a href="<?php echo url_for('user/show?user_status='.$sf_request->getParameter('user_status').'&pagesize='.$sf_request->getParameter('pagesize', 5).'&page=1', $users) ?>"><span class="all"><span class="imag"><img src="<?php echo image_path('enabled_first4');?>"></span><span class="txt">First</span></span></a></li>
						<li class="prev_page"><a href="<?php echo url_for('user/show?user_status='.$sf_request->getParameter('user_status').'&pagesize='.$sf_request->getParameter('pagesize', 5).'&page='.$pager->getPreviousPage(), $users) ?>"><span class="all"><span class="imag"><img src="<?php echo image_path('enabled_prev3');?>"></span><span class="txt">Prev</span></span></a></li>
						<li class="all_pages">
							<span class="all_page">
								<ul>
									<?php foreach ($pager->getLinks() as $page): ?> 
										<?php if ($page == $pager->getPage()): ?>
											<li class="active"><?php echo $page ?></li>
										<?php else: ?>
									<li class=""><a href="<?php echo url_for('user/show?user_status='.$sf_request->getParameter('user_status').'&pagesize='.$sf_request->getParameter('pagesize', 5).'&page='.$page, $users) ?>"><?php echo $page ?></a></li>
										<?php endif; ?>
									<?php endforeach; ?>	
								</ul>
							</span>
						</li>
						<li class="next_page"><a href="<?php echo url_for('user/show?user_status='.$sf_request->getParameter('user_status').'&pagesize='.$sf_request->getParameter('pagesize', 5).'&page='.$pager->getNextPage(), $users) ?>"><span class="all"><span class="txt">Next</span><span class="imag"><img src="<?php echo image_path('enabled_next2');?>"></span></span></a></li>

						<li class="last_page"><a href="<?php echo url_for('user/show?user_status='.$sf_request->getParameter('user_status').'&pagesize='.$sf_request->getParameter('pagesize', 5).'&page='.$pager->getLastPage(), $users) ?>"><span class="all"><span class="txt">Last</span><span class="imag"><img src="<?php echo image_path('enabled_last3');?>"></span></span></a></li>
						<li class="last_page no_of_pages"><span> 
							<?php if($sf_request->getParameter('page')): ?>						
								<?php echo "Page ".$sf_request->getParameter('page')." of ".count($pager) ?>	
							<?php else: ?>
								<?php echo "Page 1 of ".count($pager). count($users) ?>	
							<?php endif; ?>
								</span> </li>
					</ul>
				</div>
			</div>
		</form>
		
		<div class="clearFix"></div>

	</div>

	<?php endif; ?>
		</div>
	</div>
</div>
<?php else: ?>
	<div id="messageLayer">
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">&times;</a>
			<strong><?php echo "Page does not exist" ?></strong>
		</div> 
	</div>

<?php endif; ?>
