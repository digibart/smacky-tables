<?php
$tables = ORM::factory('table')->find_all(); //finds all tables
?>

<div class="last ten columns prefix-8">
	<form method="post" class="validate" action="<?php echo url::site(Route::get('admin/base_url')->uri(array('controller' => 'reservations', 'action' => 'save', 'id' =>  $reservation->id)));?>">
		<dl>
			<dt class="eight columns"><label for="name"><?php echo ucfirst(__('name'));?></label></dt>
			<dd class="sixteen last columns"><input type="text" name="name" id="name" class="required" maxlength="10" value="<?php echo addslashes($reservation->name);?>"></dd>
		    
	   		<dt class="eight columns"><label for="email"><?php echo ucfirst(__('email'));?></label></dt>
			<dd class="sixteen last columns"><input type="text" name="email" id="email" class="required email" maxlength="100" value="<?php echo addslashes($reservation->email);?>"></dd>
	
	   		<dt class="eight columns"><label for="phone"><?php echo ucfirst(__('phone'));?><span>0123-4567890</span></label></dt>
			<dd class="sixteen last columns"><input type="text" name="phone" id="phone" class="required" value="<?php echo addslashes($reservation->phone);?>"></dd>
	
	   		<dt class="eight columns"><label for="start"><?php echo ucfirst(__('from'));?><span><?php echo date("d-m-Y H:i");?></span></label></dt>
			<dd class="sixteen last columns"><input type="text" name="start" id="start" class="required" value="<?php echo ($reservation->start) ? date("d-m-Y H:i", strtotime($reservation->start)) : date("d-m-Y");?>"></dd>
	
	  		<dt class="eight columns"><label for="end"><?php echo ucfirst(__('till'));?><span><?php echo date("d-m-Y H:i");?></span></label></dt>
			<dd class="sixteen last columns"><input type="text" name="end" id="end" class="required" value="<?php echo ($reservation->end ? date("H:i", strtotime($reservation->end)) : "22:00");?>"></dd>
		
			<dt class="eight columns"><label for="table"><?php echo ucfirst(__('table'));?></label></dt>
			<dd class="sixteen last columns">		
				<select name="table_id" id="table">
					<?php foreach ($tables as $table) : ?>
						<option value="<?php echo $table->id; ?>" <?php echo (($reservation->belongs_to('table', $table)) ? "selected=selected" : "" ); ?>>
							<?php echo $table->number; ?>
						</option>			
					<?php endforeach; ?>
				</select>
			</dd>
			
			<?php if ($reservation->created) : ?>			
			<dt class="eight columns"><label><?php echo ucfirst(__('created'));?></label></dt>
			<dd class="sixteen last columns"><?php echo $reservation->created;?></dd>
			<?php endif; ?>
			
			<?php if ($reservation->updated) : ?>	
			<dt class="eight columns"><label><?php echo ucfirst(__('updated'));?></label></dt>
			<dd class="sixteen last columns"><?php echo $reservation->updated;?></dd>
			<?php endif; ?>

			<dt class="eight columns"><?php echo html::anchor($referrer, __('go back'), array('class' => 'nice button')); ?></dt>
			<dd class="sixteen last columns"><button type="submit" class="nice primary button"><?php echo KillerAdmin::spriteImg('save');?><?php echo __('save'); ?></button></dd>
		</dl>
	</form>
</div>
