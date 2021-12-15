<?php
/*-------------------------------
Template Name: Redirect URL
--------------------------------*/

$redirect_url = get_field("redirect_url");
wp_redirect( $redirect_url );
?>