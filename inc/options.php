<?php

//avoid direct calls to this file
if (!function_exists('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}
 
/***************
Options template 
***************/
function banl_display_menu() {
$options = get_option('banl_data');
?>

<div class="wrap">
<?php screen_icon('options-general'); ?>

<h2>BAN - Blocked Ads Notifier Lite 1.0 Settings</h2>
<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
	<div>
	<div style="width: 35%;float:right">
						<table class="widefat" border="0" style="margin-top: 15px;">
			<thead>
			<tr>
				<th><a title="Go Premium Now!" href="http://codecanyon.net/item/ban-blocked-ads-notifier-with-statistics/5740058/?ref=plugarized">
					<span class="options-heading" style="font-size:18px">Our premium plugin, packs more options and unique features!</span></a>
				</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>
					<div id="ban-functions" style="margin: 10px;">
					<div style="text-align: center;">
					<a title="Go Premium Now!" href="http://codecanyon.net/item/ban-blocked-ads-notifier-with-statistics/5740058/?ref=plugarized">
					<img src="http://www.plugarized.com/gfx/ban/ban.png"></div></a>

					</div>
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
	<div style="width: 49%;float:left">
			<table class="widefat" style="margin-top: 15px;">
			<thead>
			<tr>
				<th>
					<span id="click-ban-mode" class="options-heading">Functionality</span>
				</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>
					<div class="wrap-functions">
					<div class="wrap-info" title="class name used to wrap ads (default:advert)"></div>
					<label for="divClass">Wrapper class:</label>
						<input style="width:100px" type="text" maxlength="10" id="divClass" name="banl_data[divClass]" value="<?php echo $options['divClass']; ?>" /> 
					</div>
					<div class="wrap-functions">
					<div class="wrap-info" title="display notification to logged users"></div>
					<label>Registered users:</label>
					<label for="loggedYes">Yes</label>
						<input type="radio" id="loggedYes" name="banl_data[loggedU]" value="loggedYes" <?php checked( $options['loggedU'], 'loggedYes' ); ?> />
					<label for="loggedNo">No</label>
						<input type="radio" id="loggedNo" name="banl_data[loggedU]" value="loggedNo" <?php checked( $options['loggedU'], 'loggedNo' ); ?> /> 
					</div>
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
	<div style="width: 49%;float: left;clear: left;">
			<table class="widefat" border="0" style="margin-top: 15px;">
			<thead>
			<tr>
				<th>
					<span id="click-ban-functions" class="collapse options-heading" title="Toggle">Notice Type</span>
				</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>
					<div id="ban-functions" style="margin: 10px;">
					<div class="options-wrap">
					<?php screen_icon('themes'); ?>
					<label for="multiple">Multiple:</label>
						<input type="radio" id="multiple" name="banl_data[noticeType]" value="multi" <?php checked( $options['noticeType'], 'multi' ); ?> /> <span class="option_ex">display notification on each blocked ad space</span></br>
					<label for="method">Method:</label>
						<select name="banl_data[method]" id="method"/>
							<option value=".append" <?php selected( $options['method'], '.append' ); ?>>Append</option>
							<option value=".prepend" <?php selected( $options['method'], '.prepend' ); ?>>Prepend</option>
							<option value=".wrap" <?php selected( $options['method'], '.wrap' ); ?>>Wrap</option>
							<option value=".parent().parent().wrap" <?php selected( $options['method'], '.parent().parent().wrap' ); ?>>Parent</option>
						</select> <span class="option_ex">if multiple notifications arent showing try other methods</span>
					</div>
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div style="width: 49%;float: left;clear: left;">
			<table class="widefat" border="0" style="margin-top: 15px;">
			<thead>
			<tr>
				<th>
					<span id="click-ban-content" class="collapse options-heading" title="Toggle">Content</span>
				</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>
					<div id="ban-content" style="margin: 10px;">
						<label for="title">Notification Title:</label>
						<input style="width:100%" type="text" name="banl_data[title]" id="title" value="<?php echo sanitize_text_field($options['title']); ?>" /></p>
						<label for="message">Message:</label>
						<textarea style="width:100%" name="banl_data[msg]" id="message" cols="40" rows="5" /><?php echo esc_textarea($options['msg']); ?></textarea>
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<div style="width: 49%;float: left;clear: left;">
			<table class="widefat" style="margin-top: 15px;">
			<thead>
			<tr>
				<th>
					<span id="click-ban-style" class="collapse options-heading" title="Toggle">Style</span>
				</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td>
					<div id="ban-style" style="margin: 10px;">
						<label for="image">Notification Image URL:</label> <span class="option_ex">click <a href="http://plugarized.imgur.com/all/" target="_blank">link</a> for more icons</span>
						<p><input style="width:85%" type="text" name="banl_data[image]" id="image" value="<?php echo esc_url($options['image']); ?>" /><img style="margin: -12px 0 -20px 20px;" width="50px" src="<?php echo esc_url($options['image']); ?>" /></p>
						<label for="containerbg">Background:</label>
						<p><input type="text" name="banl_data[containerbg]" id="containerbg" class="wp-color-picker-field" data-default-color="#ffffff" value="<?php echo $options['containerbg']; ?>" /></p>
						  <label for="pixels">Border Radius:</label>
						<input type="text" name="banl_data[bRadius]" maxlength="2" id="pixels" value="<?php echo $options['bRadius']; ?>" style="color: #f6931f; font-weight: bold;width:23px;" />
						<p><div id="slider-range-min"></div>
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
	</div>
	<input type="hidden" name="action" value="update"/>
	<input type="hidden" name="page_options" value="banl_data"/>
	<input style="float:left;margin-top: 10px; margin-bottom: 10px; vertical-align: middle; clear: both;" class="button-primary" type="submit" value="<?php _e('save changes') ?>" />
</form>
</div>
<?php
}

?>