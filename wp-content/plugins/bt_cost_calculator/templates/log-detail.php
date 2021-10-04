<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<style>
	.wrap .form-table td {
		background-color: #fff;
		border-color: #aaa;
		border-width: 1px;
		border-style: solid;
	}

	nav.log-emails-next-prev {
		text-align: center;
		margin-top: 15px;
		margin-bottom: 20px;
	}

	a.log-emails-link-prev, a.log-emails-link-list, a.log-emails-link-next {
    	text-decoration: none;
	}

	.icongray:before {
    	color: #aaa !important;
	}
</style>

<div class="wrap">

	<h1><?php esc_html_e( 'Email Log Item', 'bt-cost-calculator' ); ?></h1>

	<nav class="log-emails-next-prev">
		<?php if ( $previous ): ?>
			<a class="log-emails-link-prev" title="<?php echo esc_attr_x( 'Previous', 'move to previous log', 'bt-cost-calculator' ); ?>" href="<?php echo esc_url( $previous ); ?>"><div class="dashicons dashicons-arrow-left-alt2" aria-hidden="true"></div></a>
		<?php else: ?>
			<div class="dashicons dashicons-arrow-left-alt2 icongray" aria-hidden="true"></div>
		<?php endif; ?>
		<a class="log-emails-link-list" title="<?php esc_attr_e( 'Return to list', 'bt-cost-calculator' ); ?>" href="<?php echo esc_url( $list ); ?>"><div class="dashicons dashicons-list-view" aria-hidden="true"></div></a>
		<?php if ( $next ): ?>
			<a class="log-emails-link-next" title="<?php echo esc_attr_x( 'Next', 'move to next log', 'bt-cost-calculator'); ?>" href="<?php echo esc_url( $next ); ?>"><div class="dashicons dashicons-arrow-right-alt2" aria-hidden="true"></div></a>
		<?php else: ?>
			<div class="dashicons dashicons-arrow-right-alt2 icongray" aria-hidden="true"></div>
		<?php endif; ?>
	</nav>

	<table class='form-table'>
		<tbody>
			<tr>
				<th scope="row"><label><?php echo esc_html( 'Sent', 'time and date an email was sent', 'bt-cost-calculator' ); ?></label></th>
				<td>
					<?php echo date_i18n( 'Y-m-d H:i:s', strtotime( $post->post_date ) ); ?>
					&nbsp;&nbsp;&nbsp;(<?php echo date_i18n( 'Y-m-d H:i:s', strtotime( $post->post_date_gmt ) ); ?> UTC)
				</td>
			</tr>

			<tr>
				<th scope="row"><label><?php echo esc_html_x( 'Subject', 'email subject', 'bt-cost-calculator' ); ?></label></th>
				<td><?php echo esc_html( $post->post_title ); ?></td>
			</tr>
			<?php if ( $cc = get_post_meta( $post->ID, self::PLUGIN_PREFIX . 'log_cc', true ) ): ?>
			<tr>
				<th scope="row"><label><?php echo esc_html_x( 'CC', 'courtesy copy addresses', 'bt-cost-calculator' ); ?></label></th>
				<td><?php echo esc_html( $cc ); ?></td>
			</tr>
			<?php endif; ?>

			<?php if ( $bcc = get_post_meta( $post->ID, self::PLUGIN_PREFIX . 'log_bcc', true ) ): ?>
			<tr>
				<th scope="row"><label><?php echo esc_html_x( 'BCC', 'blind courtesy copy addresses', 'bt-cost-calculator' ); ?></label></th>
				<td><?php echo esc_html( $bcc ); ?></td>
			</tr>
			<?php endif; ?>

			<?php if ($content_type = get_post_meta( $post->ID, self::PLUGIN_PREFIX . 'content-type', true ) ): ?>
			<tr>
				<th scope="row"><label><?php esc_html_e( 'Content Type', 'bt-cost-calculator' ); ?></label></th>
				<td><?php echo esc_html( $content_type ); ?></td>
			</tr>
			<?php endif; ?>

			<tr>
				<th scope="row">
					<label><?php echo esc_html_x( 'Message', 'content of email', 'bt-cost-calculator' ); ?></label></br>
					<?php if ( ! empty( $content_type ) && strpos( $content_type, 'text/html' ) !== false && empty( $_GET['raw'] ) ): ?>
						<a href="<?php echo esc_url( $current . '&raw=1' ); ?>"><button type="button" id="message_type" class="button button-primary" style="margin-top:10px;"><?php esc_html_e( 'View Raw Message', 'bt-cost-calculator' ); ?></button></a>
					<?php else: ?>
						<?php if ( ! empty( $content_type ) && strpos( $content_type, 'text/html' ) !== false && ! empty( $_GET['raw'] ) ): ?>
							<a href="<?php echo esc_url( $current ); ?>"><button type="button" id="message_type" class="button button-primary" style="margin-top:10px;"><?php esc_html_e( 'View HTML Message', 'bt-cost-calculator' ); ?></button></a>
						<?php endif; ?>
					<?php endif; ?>
				</th>
				<?php if ( ! empty( $content_type ) && strpos( $content_type, 'text/html' ) !== false && empty( $_GET['raw'] ) ): ?>
					<td class="log-emails-content log-emails-content-html">
						<?php echo wp_kses_post( $post->post_content ); ?>
					</td>
				<?php else: ?>
					<td class="log-emails-content log-emails-content-raw">
						<?php echo nl2br( esc_html( $post->post_content ) ); ?>
					</td>
				<?php endif; ?>
			</tr>

			<?php if ( $altbody = get_post_meta( $post->ID, self::PLUGIN_PREFIX . 'log_altbody', true ) ): ?>
			<tr>
				<th scope="row"><?php esc_html_e( 'Alternative Content', 'bt-cost-calculator' ); ?></th>
				<td><?php echo nl2br( esc_html( $altbody ) ); ?></td>
			</tr>
			<?php endif; ?>

			<?php if ( $headers = get_post_meta( $post->ID, self::PLUGIN_PREFIX . 'log_headers', true ) ): ?>
			<tr>
				<th scope="row"><?php esc_html_e( 'Headers', 'bt-cost-calculator' ); ?></th>
				<td><?php echo nl2br( esc_html( $headers ) ); ?></td>
			</tr>
			<?php endif; ?>
		<tbody>

	</table>

	<br class="clear" />
</div>
