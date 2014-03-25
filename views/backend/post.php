<form method="POST" action="<?php echo admin_url( 'admin.php' ); ?>">
    <input type="hidden" name="action" value="og_post" />

		<?php screen_icon(); ?>
		<h2><?php _e('OpenGraph Client'); ?></h2>

<input type="hidden" name="page" value="wp-og-client-post" />

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="url"><?php _e('URL'); ?></label>
					</th>
					<td>
						<input type="text"
							class="regular-text"
							id="og_url"
							name="og_url"
							value="http://" />
						<p class="description"><?php _e('The URL you put here will be scraped for OpenGraph content, and the title and description will be saved as a new draft post.'); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input type="submit" class="button button-primary" value="<?php _e('Commodify'); ?>" />
		</p>
</form>
