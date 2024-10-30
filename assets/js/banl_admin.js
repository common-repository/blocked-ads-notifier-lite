/*! Admin dashboard functionality
* BAN - Blocked Ads Notifier Lite http://www.plugarized.com
* Copyright 2013 Plugarized */

jQuery(document).ready(function ($) {
    $(".wp-color-picker-field").wpColorPicker()
});
jQuery("#click-ban-content").click(function () {
    jQuery("#ban-content").slideToggle("slow");
    jQuery("#click-ban-content").toggleClass("expand")
});
jQuery("#click-ban-style").click(function () {
    jQuery("#ban-style").slideToggle("slow");
    jQuery("#click-ban-style").toggleClass("expand")
});
jQuery("#click-ban-functions").click(function () {
    jQuery("#ban-functions").slideToggle("slow");
    jQuery("#click-ban-functions").toggleClass("expand")
});

