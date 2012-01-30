<div class="eight columns">
		<h2><?php echo ucfirst(__('reservations')); ?></h2>
		
		<div class="twentyfour table columns">
			<div class="header row"  style="min-width: 0">
				<div class="eighteen columns"><?php echo __('date'); ?></div>
				<div class="six columns last"><?php echo __('persons'); ?></div>
			</div>
		
		<?php foreach ($persons as $date => $amount) : ?>
			<div class="row" style="min-width: 0">
				<div class="three columns"><?php echo strftime("%a", strtotime($date)); ?></div>
				<div class="fiveteen columns"><?php echo strftime("%e %b", strtotime($date)); ?></div>
				<div class="six columns last"><?php echo $amount; ?></div>
			</div>
		<?php endforeach; ?>
		</div>
</div>
