<a name="list"></a>
<div class="twenty columns">
	<form method="get" class="table">
		<div class="filter row">
			<div class="three columns"><?php echo Killeradmin::filterField('number', $filter); ?></div>
			<div class="nineteen last columns"><?php echo Killeradmin::filterButton(); ?></div>
		</div>
		<div class="header row">
			<div class="three columns"><?php echo ucfirst(__('number')); ?>&nbsp;<?php echo Killeradmin::sortAnchor('number'); ?></div>
			<div class="four columns"><?php echo ucfirst(__('size')); ?>&nbsp;<?php echo Killeradmin::sortAnchor('size'); ?></div>
			<div class="seven columns"><?php echo ucfirst(__('nickname')); ?>&nbsp;<?php echo Killeradmin::sortAnchor('nickname'); ?></div>
			<div class="ten columns last"><?php echo ucfirst(__('served by')); ?></div>
		</div>
		<?php $i = 0; foreach ($objects as $table) :?>
			<div class="row <?php echo Text::alternate('odd', 'even');?>" id="<?php echo $i++; ?>">
				<div class="three columns"><?php echo $table->number; ?></div>	
				<div class="four columns"><?php echo $table->size; ?> persons</div>	
				<div class="seven columns"><?php echo $table->nickname; ?></div>
				<div class="seven columns nowrap"><?php echo (($table->user->name) ? $table->user->name : $table->user->username); ?></div>	
				<div class="three tools columns last">
					<?php echo html::anchor($controller_url . '/edit/' . $table->id, KillerAdmin::spriteImg('pencil', __('edit') )); ?> 
					<?php echo html::anchor($controller_url . '/delete/' . $table->id, KillerAdmin::spriteImg('bin', __('delete')), array('class' => 'delete')); ?>
				</div>
			</div>
		<?php endforeach; ?>
	</form>
</div>
<div class="row">
<?php echo Killeradmin::newButton('table'); ?>
</div>
	
<div class="row pagination">
	<?php echo $pagination;?>
</div>
