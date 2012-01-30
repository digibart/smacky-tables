<?php
$waitresses = ORM::factory('role', array('name' => 'waitress'))->users->find_all(); //finds all waitresses
?>

<div class="last ten columns prefix-8">
	<form method="post" class="validate" action="<?php echo url::site(Route::get('admin/base_url')->uri(array('controller' => 'tables', 'action' => 'save', 'id' =>  $table->id)));?>">
		<dl>
				
			<dt class="eight columns"><label for="number"><?php echo ucfirst(__('number'));?></label></dt>
			<dd class="sixteen last columns"><input type="text" name="number" id="number" class="required" maxlength="6" value="<?php echo $table->number;?>"></dd>
		    
			<dt class="eight columns"><label for="size"><?php echo ucfirst(__('size'));?><span><?php echo __('how many persons'); ?></span></label></dt>
			<dd class="sixteen last columns"><input type="text" name="size" id="size" class="required number" value="<?php echo $table->size;?>"></dd>
		        
			<dt class="eight columns"><label for="nickname"><?php echo ucfirst(__('nickname'));?></label></dt>
			<dd class="sixteen last columns"><input type="text" name="nickname" id="nickname" maxlength="20" value="<?php echo addslashes($table->nickname);?>"></dd>
	
			<dt class="eight columns"><label for="waitress"><?php echo ucfirst(__('waitress'));?><span><?php echo __('who serves this table?'); ?></span></label></dt>
			<dd class="sixteen last columns">
				<select name="user_id" id="waitress">
					<?php foreach ($waitresses as $waitress) : ?>
						<option value="<?php echo $waitress->id; ?>" <?php echo (($table->user_id == $waitress->id) ? 'selected=selected' : '') ?>>
							<?php echo (($waitress->name) ?  $waitress->name :  $waitress->username); ?>
						</option>			
					<?php endforeach; ?>
				</select>
			</dd>
			
			<dt class="eight columns"><?php echo html::anchor($referrer, __('go back'), array('class' => 'nice button')); ?></dt>
			<dd class="sixteen last columns"><button type="submit" class="nice primary button"><?php echo KillerAdmin::spriteImg('save');?><?php echo __('save'); ?></button></dd>
		</dl>
	</form>
</div>
