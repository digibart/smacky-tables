<div class="row">
	<form method="post">
		<p class="center">Please fill out the form below to book a table.</p>
		<hr>
		<?php
		
		if (count($errors)) {
			echo "<p class='error'><strong>Fix the following errors:</strong><br />";
			foreach ($errors as $field => $msg) {
				echo "- " . $msg . "<br />";
			}
			echo "</p>";	
		}
		
		?>
		<dl>
			<dt class="span-6"><?php echo Form::label('name', __('your name:')); ?></dt>
			<dd class="span-6 last">
				<?php echo Form::input('name', Arr::get($_POST,'name'), array('class' => (array_key_exists('name', $errors) ? 'invalid' : ''))) . " *"; 
				 if (array_key_exists('name', $errors)) echo "<span class='error'>" . $errors['name'] . "</span>"; ?>
			</dd>
			
			<dt class="span-6"><?php echo Form::label('phone', __('phone:')); ?> *</dt>
			<dd class="span-6 last">
				<?php echo Form::input('phone', Arr::get($_POST,'phone'), array('class' => (array_key_exists('phone', $errors) ? 'invalid' : ''))) . " *"; 
				if (array_key_exists('phone', $errors)) echo "<span class='error'>" . $errors['phone'] . "</span>"; ?>
			</dd>
			
			<dt class="span-6"><?php echo Form::label('email', __('email:')); ?></dt>
			<dd class="span-6 last">
				<?php echo Form::input('email', Arr::get($_POST,'email'), array('class' => (array_key_exists('email', $errors) ? 'invalid' : ''))) . " *"; 
				if (array_key_exists('email', $errors)) echo "<span class='error'>" . $errors['email'] . "</span>"; ?>
			</dd>
			
			<dt class="span-6"><?php echo Form::label('date', __('date:')); ?></dt>
			<dd class="span-6 last">
				<?php echo Form::input('date', Arr::get($_POST,'date'), array('class' => (array_key_exists('date', $errors) ? 'invalid' : ''))) . " *"; 
				if (array_key_exists('date', $errors)) echo "<span class='error'>" . $errors['date'] . "</span>";
				if (array_key_exists('start', $errors)) echo "<span class='error'>" . $errors['start'] . "</span>"; ?>
			</dd>
			
			<dt class="span-6"><?php echo Form::label('time', __('time:')); ?></dt>
			<dd class="span-6 last">
				<?php echo Form::input('time', Arr::get($_POST,'time'), array('class' => (array_key_exists('time', $errors) ? 'invalid' : ''))) . " *"; 
				if (array_key_exists('time', $errors)) echo "<span class='error'>" . $errors['time'] . "</span>"; ?>
			</dd>
			
			<dt class="span-6"><?php echo Form::label('table_id', __('table:')); ?></dt>
			<dd class="span-6 last">
				<?php foreach ($tables as $table) {
					echo "<div>" . Form::radio('table_id', $table->id, (Arr::get($_POST,'table_id') == $table->id), array('id' => "table_id_" . $table->id)) . " <label for='table_id_" . $table->id. "'>" . $table->number . " <span class='small'>(" . $table->size . " " . __('persons') . ")</span></label>";
				}  if (array_key_exists('table_id', $errors)) echo "<span class='error'>" . $errors['table_id'] . "</div>"; ?>
			</dd>
			<dt class="span-6">&nbsp;</dt>
			<dd class="span-6 last"><button class="positive"><?php echo __('book table'); ?></button></dd>
			
		</dl>
		
	
		

	</form>


</div>
