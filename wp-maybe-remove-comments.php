<?php
/**
 * Maybe disable comments.
 *
 * @version 1.0
 *
 * @author Ralf Hortt <me@horttcore.de>
 */

namespace RalfHortt\MaybeDisableComments;

$commentsClosed = get_option('default_comment_status') == 'closed' ? true : false;
$commentCount = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments");

if (!$commentsClosed || $commentCount > 0) {
    return;
}

add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php'); // Kommentare
});
