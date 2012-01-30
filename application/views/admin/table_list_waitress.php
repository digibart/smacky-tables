<a name="list"></a>
	<div class="twelve columns prefix-6">
		You're serving the following tables:
		<form method="get" class="table">
			<div class="header row">
				<div class="three columns"><?php echo ucfirst(__('number')); ?>&nbsp;<?php echo Killeradmin::sortAnchor('number'); ?></div>
				<div class="six columns"><?php echo ucfirst(__('size')); ?>&nbsp;<?php echo Killeradmin::sortAnchor('size'); ?></div>
				<div class="ten columns"><?php echo ucfirst(__('nickname')); ?>&nbsp;<?php echo Killeradmin::sortAnchor('nickname'); ?></div>
				<div class="last four columns"><?php echo ucfirst(__('reservations today')); ?>&nbsp;</div>
			</div>

			<?php $i = 0; foreach ($objects as $table) :?>
				<div class="row <?php echo Text::alternate('odd', 'even');?>" id="<?php echo $i++; ?>">
					<div class="three columns"><?php echo $table->number; ?></div>	
					<div class="six columns"><?php echo $table->size; ?> persons</div>	
					<div class="ten columns"><?php echo $table->nickname; ?></div>
					<div class="last three columns">
						<?php if ($table->reservation
									->where('table_id','=',$table->id)
									->where('start', 'like', date("Y-m-d") . ' %')
									->count_all()
								) {
									echo html::anchor(
										Route::get('admin/base_url')->uri(array('controller' => 'reservations')) . '?' . urlencode('filter[table_id]') . '=' . $table->id,
										Killeradmin::spriteimg('star', __('reservations today!'))
									);
								}
						?>
					</div>
				</div>
			<?php endforeach; ?>
		</form>
	</div>
<div class="row pagination">
	<?php echo $pagination;?>
</div>
