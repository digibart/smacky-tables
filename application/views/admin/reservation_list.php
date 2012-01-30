<?php
	$may_delete = Auth::instance()->logged_in(Kohana::$config->load('admin.menu.admin/tables.secure_actions.delete'));
?>
<a name="list"></a>
<div class="twentytwo columns">
	<form method="get" class="table">
		<div class="filter row">
			<div class="three columns">&nbsp;</div>
			<div class="five columns"><?php echo Killeradmin::filterField('name', $filter); ?></div>
			<div class="four columns"><?php echo Killeradmin::filterField('phone', $filter); ?></div>
			<div class="four columns"><?php echo Killeradmin::filterField('email', $filter); ?></div>
			<div class="three columns"><input type="checkbox" name="hide-past" value="1" id="hide-past" <?php echo (Arr::get($_GET,'hide-past') ? 'checked' : ''); ?>><label for="hide-past"><?php echo __('hide past'); ?></label></div>
			<div class="last columns"><?php echo Killeradmin::filterButton(); ?></div>
		</div>
		<div class="header row">
			<div class="one columns">&nbsp;</div>
			<div class="two columns"><?php echo ucfirst(__('table')); ?>&nbsp;</div>
			<div class="five columns"><?php echo ucfirst(__('name')); ?>&nbsp;<?php echo Killeradmin::sortAnchor('size'); ?></div>
			<div class="four columns"><?php echo ucfirst(__('phone')); ?>&nbsp;<?php echo Killeradmin::sortAnchor('nickname'); ?></div>
			<div class="four columns"><?php echo ucfirst(__('email')); ?>&nbsp;<?php echo Killeradmin::sortAnchor('nickname'); ?></div>
			<div class="five columns last"><?php echo ucfirst(__('date')); ?>&nbsp;<?php echo Killeradmin::sortAnchor('start'); ?></div>
		</div>
		<?php $i = 0; foreach ($objects as $reservation) :?>
			<div class="row <?php echo Text::alternate('odd', 'even');?>" id="<?php echo $i++; ?>">
				<div class="one columns"><?php echo (date("Y-m-d", strtotime($reservation->start)) == date("Y-m-d") ? Killeradmin::spriteimg('star', __('today!')) : ""); ?>&nbsp;</div>
				<div class="two columns"><?php echo $reservation->table->number; ?>&nbsp;</div>
				<div class="five columns"><?php echo $reservation->name; ?></div>
				<div class="four columns"><?php echo $reservation->phone; ?></div>
				<div class="four columns"><?php echo $reservation->email; ?></div>
				<div class="five columns last"><?php echo strftime("%a %e %b %R", strtotime($reservation->start)); ?> - <?php echo strftime("%R", strtotime($reservation->end)); ?></div>

				<div class="three tools columns last">
					<?php echo html::anchor($controller_url . '/edit/' . $reservation->id, KillerAdmin::spriteImg('pencil', __('edit') )); ?> 
					<?php echo ($may_delete ? html::anchor($controller_url . '/delete/' . $reservation->id, KillerAdmin::spriteImg('bin', __('delete')), array('class' => 'delete')) : ""); ?>
				</div>
			</div>
		<?php endforeach; ?>
	</form>
</div>
<?php if (Auth::instance()->logged_in(Kohana::$config->load('admin.menu.admin/tables.secure_actions.add'))) : ?>
	<div class="row">
		<?php echo Killeradmin::newButton('reservation'); ?>
	</div>
<?php endif; ?>
<div class="row pagination">
	<?php echo $pagination;?>
</div>
