<?php
/**
 * Template part for displaying header contact.
 *
 * @since Gutener
 */

?>

<?php if( !get_theme_mod( 'disable_contact_detail', false ) ){ ?>
	<div class="header-contact">
		<ul>
			<li>
				<?php if( get_theme_mod( 'contact_phone', '' ) ){ ?>
					<a href="tel:<?php echo esc_url( get_theme_mod( 'contact_phone', '' )); ?>"><i class="fas fa-phone"></i>
						<?php echo esc_html(get_theme_mod( 'contact_phone', '' ) ); ?>
					</a>
				<?php } ?>
			</li>
			<li>
				<?php if( get_theme_mod( 'contact_email', '' ) ){ ?>
					<a href="mailto:<?php echo esc_url( get_theme_mod( 'contact_email', '' )); ?>"><i class="fas fa-envelope"></i>
					<?php echo esc_html( get_theme_mod( 'contact_email', '' ) ); ?>
					</a>
				<?php } ?>
			</li>
			<li>
				<?php if( get_theme_mod( 'contact_address', '' ) ){ ?>
					<i class="fas fa-map-marker-alt"></i>
					<?php echo esc_html( get_theme_mod( 'contact_address', '' ) ); ?>
				<?php } ?>
			</li>
		</ul>
	</div>
<?php } ?>