<?php

//avoid direct calls to this file
if (!function_exists('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/************************
* Logged user conditional
************************/
add_action('wp_footer', 'banl_user_logged');
function banl_user_logged()
{
    $logged = get_option('banl_data');
    if (is_user_logged_in() && $logged['loggedU'] == 'loggedYes') {
        do_action('exec_banl_script');
    } else if (is_user_logged_in() && $logged['loggedU'] == 'loggedNo') {
	//Do not show
    } else {
        do_action('exec_banl_script');
    }
}

/**********
* Css class
**********/
add_action('wp_head', 'banl_notice_styles');
function banl_notice_styles () {

$options = get_option('banl_data');
$bgImage = banl_URL . '/assets/css/images/gradient.svg';

?>
<!-- Blocked Ads Notifier Lite Start
  ================================================== -->
<style type="text/css">
	.banl-notice{
	background-color: <?php echo $options['containerbg']; ?>;
	border-radius: <?php echo $options['bRadius'];?>px;
	background-image: url(<?php echo $bgImage  ?>); 
	}
</style>
<!-- Blocked Ads Notifier Lite End
  ================================================== -->
<?php
} //END Css class

/*******************************
* Detector functions
*******************************/
add_action('exec_banl_script', 'banl_detect');
function banl_detect() {

$options = get_option('banl_data');

?>

<script type="text/javascript">
jQuery(document).ready(function() {

/*****************!
* Variables
******************/
var icon 		= '<?php echo $options['image']; ?>';
var message 	= '<?php echo $options['msg']; ?>';
var title 		= '<?php echo $options['title']; ?>';
var wrapClass   = '<?php echo $options['divClass']; ?>';

/**********!
* Detector
**********/
	window.setTimeout(function () {
		if (document.getElementById("lu_advert") == undefined || 
			jQuery('.'+wrapClass).height() < 50 || 
			jQuery('.'+wrapClass+ 'iframe:hidden').length || 
			jQuery('.'+wrapClass+ 'iframe').is(':hidden')) {
			var blockStatus = true;
		} else {
			var blockStatus = false;
		}
/**************!
* Create notice
***************/
			if (blockStatus == true) {
				 jQuery('.' + wrapClass)<?php  echo $options['method']; ?>('<div class="banl-notice"><img class="ad-block-logo" src="' + [icon] + '" /><span class="ad-block-title">' + [title] + '</span><br /><span class="ad-block-msg">' + [message] + '</span></div>');
			 }
	}, 500);
});
</script>

<?php
} //END Detector

?>