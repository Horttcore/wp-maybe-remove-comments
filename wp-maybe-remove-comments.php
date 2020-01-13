<?php
/*
Plugin Name:  WP Maybe Remove Comments
Plugin URI:   https://github.com/Horttcore/wp-maybe-remove-comments
Description:  Maybe disable comments admin menu entry.
Version:      1.2.0
Author:       Ralf Hortt
Author URI:   https://horttcore.de/
License:      GPL
*/
namespace RalfHortt\MaybeDisableComments;

global $wpdb;
$commentsClosed = get_option('default_comment_status') == 'closed' ? true : false;
$commentCount = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = ''");

if (!$commentsClosed || $commentCount > 0) {
    return;
}

add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php'); // Kommentare
});
