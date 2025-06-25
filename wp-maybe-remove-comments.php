<?php
/*
Plugin Name:  WP Maybe Remove Comments
Plugin URI:   https://github.com/Horttcore/wp-maybe-remove-comments
Description:  Maybe disable comments admin menu entry.
Version:      1.4.0
Author:       Ralf Hortt
Author URI:   https://horttcore.de/
License:      GPL
*/

namespace RalfHortt\MaybeDisableComments;

global $wpdb;

// Do nothing if not logged in
if (!is_user_logged_in()) {
    return
}

$commentStatus = get_option('default_comment_status');
$commentsClosed = $commentStatus == 'closed' || !$commentStatus ? true : false;
$commentCount = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = ''");

if (!$commentsClosed || $commentCount > 0) {
    return;
}

// Remove menu entry
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php'); // Kommentare
});

// Remove from admin bar
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
})
