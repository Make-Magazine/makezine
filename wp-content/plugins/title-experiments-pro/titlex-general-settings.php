<!-- The rest of the markup comes from wpex -->
<tr valign="top">
	<th scope="row"><label for="sample_size">Visitor Experiment Percentage</label></th>
	<td>
		<select name="sample_size">
			<option value="1">100%</option>
			<option value="0.9" <?php if($sample_size == 0.9): ?>selected<?php endif; ?>>90%</option>
			<option value="0.8" <?php if($sample_size == 0.8): ?>selected<?php endif; ?>>80%</option>
			<option value="0.7" <?php if($sample_size == 0.7): ?>selected<?php endif; ?>>70%</option>
			<option value="0.6" <?php if($sample_size == 0.6): ?>selected<?php endif; ?>>60%</option>
			<option value="0.5" <?php if($sample_size == 0.5): ?>selected<?php endif; ?>>50%</option>
			<option value="0.4" <?php if($sample_size == 0.4): ?>selected<?php endif; ?>>40%</option>
			<option value="0.3" <?php if($sample_size == 0.3): ?>selected<?php endif; ?>>30%</option>
			<option value="0.2" <?php if($sample_size == 0.2): ?>selected<?php endif; ?>>20%</option>
			<option value="0.1" <?php if($sample_size == 0.1): ?>selected<?php endif; ?>>10%</option>
		</select>
		<p class="description">The percentage of your visitors on which to perform experiments.</p>
	</td>
</tr>
<tr valign="top">
	<th scope="row"><label for="freeze_after">Stop experiments after</label></th>
	<td>
		<select name="freeze_after">
			<option value="-1" <?php if($freeze_after == -1): ?>selected<?php endif; ?>>Never</option>
			<option value="-1 hour" <?php if($freeze_after == "-1 hour"): ?>selected<?php endif; ?>>1 hour</option>
			<option value="-2 hours" <?php if($freeze_after == "-2 hours"): ?>selected<?php endif; ?>>2 hours</option>
			<option value="-4 hours" <?php if($freeze_after == "-4 hours"): ?>selected<?php endif; ?>>4 hours</option>
			<option value="-6 hours" <?php if($freeze_after == "-6 hours"): ?>selected<?php endif; ?>>6 hours</option>
			<option value="-8 hours" <?php if($freeze_after == "-8 hours"): ?>selected<?php endif; ?>>8 hours</option>
			<option value="-10 hours" <?php if($freeze_after == "-10 hours"): ?>selected<?php endif; ?>>10 hours</option>
			<option value="-12 hours" <?php if($freeze_after == "-12 hours"): ?>selected<?php endif; ?>>12 hours</option>
			<option value="-1 day" <?php if($freeze_after == "-1 day"): ?>selected<?php endif; ?>>1 day</option>
			<option value="-2 days" <?php if($freeze_after == "-2 days"): ?>selected<?php endif; ?>>2 days</option>
			<option value="-3 days" <?php if($freeze_after == "-3 days"): ?>selected<?php endif; ?>>3 days</option>
			<option value="-4 days" <?php if($freeze_after == "-4 days"): ?>selected<?php endif; ?>>4 days</option>
			<option value="-5 days" <?php if($freeze_after == "-5 days"): ?>selected<?php endif; ?>>5 days</option>
			<option value="-6 days" <?php if($freeze_after == "-6 days"): ?>selected<?php endif; ?>>6 days</option>
			<option value="-1 week" <?php if($freeze_after == "-1 week"): ?>selected<?php endif; ?>>1 week</option>
			<option value="-2 weeks" <?php if($freeze_after == "-2 weeks"): ?>selected<?php endif; ?>>2 weeks</option>
			<option value="-3 weeks" <?php if($freeze_after == "-3 weeks"): ?>selected<?php endif; ?>>3 weeks</option>
			<option value="-1 month" <?php if($freeze_after == "-1 month"): ?>selected<?php endif; ?>>1 month</option>
			<option value="-2 months" <?php if($freeze_after == "-2 months"): ?>selected<?php endif; ?>>2 months</option>
			<option value="-3 months" <?php if($freeze_after == "-3 months"): ?>selected<?php endif; ?>>3 months</option>
			<option value="-6 months" <?php if($freeze_after == "-6 months"): ?>selected<?php endif; ?>>6 months</option>
			<option value="-1 year" <?php if($freeze_after == "-1 year"): ?>selected<?php endif; ?>>1 year</option>
		</select>
		<p class="description">Stop the title experiment after a while and set the post title to the leader.</p>
	</td>
</tr>