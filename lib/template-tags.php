<?php

function wp_og_client_has_template_tag() {
	return apply_filters('wp_og_client_has_template_tag', !!(wp_og_client_get_template_tag()));
}
function wp_og_client_get_template_tag() {
	return apply_filters('wp_og_client_get_template_tag', WP_OG_Client::template_tag());
}
function wp_og_client_the_template_tag() {
	echo apply_filters('wp_og_client_the_template_tag', wp_og_client_get_template_tag());
}
