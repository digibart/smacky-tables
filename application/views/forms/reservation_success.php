<p class="success"><?php echo __('reservation booked with success'); ?></p>

<h2 class="fancy">Thank you for your reservation.</h2>

<p>We will get back to you as soon as possible with your reservation confirmation.</p>

<p>Below is a copy of your reservation:</p>
<dl>
	<dt class="span-5">Name:</dt>
	<dd class="span-6 last"><?php echo HTML::chars($reservation->name); ?></dd>

	<dt class="span-5">Phone:</dt>
	<dd class="span-6 last"><?php echo HTML::chars($reservation->phone); ?></dd>
	
	<dt class="span-5">Email:</dt>
	<dd class="span-6 last"><?php echo HTML::chars($reservation->email); ?>&nbsp;</dd>
	
	<dt class="span-5">Date:</dt>
	<dd class="span-6 last"><?php echo strftime("%a %e %b %Y" , strtotime($reservation->start)); ?></dd>
	
	<dt class="span-5">Time:</dt>
	<dd class="span-6 last"><?php echo strftime("%H:%M %P" , strtotime($reservation->start)); ?></dd>

</dl>

<p class="row">We look forward to seeing you.</p>
