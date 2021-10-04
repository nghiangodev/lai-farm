<?php 

get_header(); ?>

		<section class="errorPage boldSection topExtraSpaced bottomExtraSpaced gutter wBackground" style = "background-image: url(<?php echo esc_url_raw( get_template_directory_uri() . '/gfx/plug.png' ) ;?>); background-position: 30% bottom;">
			<div class="port">
				<div class="boldCell">
					<div class="boldRow ">
						<div class="rowItem col-ms-12 btTextCenter">
							<div class="rowItemContent">
								<?php echo boldthemes_get_heading_html( esc_html__( 'We are sorry, page not found.', 'industrial' ), esc_html__( 'Error 404.', 'industrial' ), '<a href="' . site_url() . '">' . esc_html__( 'Back to homepage', 'industrial' ) . '</a>', 'huge', '', '', '' ) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

<?php get_footer();