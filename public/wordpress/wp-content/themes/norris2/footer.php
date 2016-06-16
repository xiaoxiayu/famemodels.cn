<?php global $smof_data;?>		

</div><!-- #wi-content -->

<footer id="wi-footer">
	<div class="container">
		
		<?php if ( isset ( $smof_data['footer-social'] ) &&  $smof_data['footer-social'] ):?>
			<?php
				$target = isset ( $smof_data['footer-social-target'] ) ? $smof_data['footer-social-target'] : '_blank';
				$show_title = ( isset ( $smof_data['footer-social-title'] ) && $smof_data['footer-social-title'] ) ? true : false;
			?>	
			<div class="social">
				<ul>
					<?php foreach ( wi_social_array() as $s => $c ):?>
						<?php if ( isset ( $smof_data['social-' . $s] ) && $smof_data['social-' . $s] ):?>
						<li><a href="<?php echo esc_url( $smof_data['social-' . $s] );?>" target="<?php echo $target;?>" rel="alternate"<?php if ( $show_title ) echo ' title="' . $c . '"';?>><i class="icon-<?php echo $s;?>"></i></a></li>
						<?php endif;?>
					<?php endforeach;?>
					
					<?php // Custom Social Icon 
						$custom_social_icon = isset( $smof_data['custom-social-icon'] ) ? esc_url( $smof_data['custom-social-icon'] ) : '';
						$custom_social_icon_url = isset( $smof_data['custom-social-icon-url'] ) ? esc_url( $smof_data['custom-social-icon-url'] ) : '';
						$custom_title = isset( $smof_data['custom-social-icon-title'] ) ? esc_attr( $smof_data['custom-social-icon-title'] ) : '';
						
					if ( $custom_social_icon_url ) { ?>
						<li><a href="<?php echo $custom_social_icon_url;?>" target="<?php echo $target;?>" rel="alternate"<?php if ( $show_title && $custom_title) echo ' title="' . $custom_title . '"';?>><img src="<?php echo $custom_social_icon;?>" alt="<?php echo $custom_title;?>" width="40" height="40" /></a></li>
					
					<?php } // endif custom social icon ?>
										
				</ul>
			</div><!-- .social -->

	<?php endif;	// footer social ?>
	
	<?php if ( isset ( $smof_data['footer-logo'] ) &&  $smof_data['footer-logo'] ) :?>	
		
		<div class="footer-logo">
			<a href="<?php echo esc_url( home_url() );?>" rel="home">
				<img src="<?php echo esc_url( $smof_data['footer-logo'] );?>" />
			</a>
		</div><!-- .footer-logo -->
		
	<?php endif; ?>
		
	<div class="copyright">
		<div class="footer-text">				
				<?php echo isset( $smof_data['footer-text'] ) ? trim($smof_data['footer-text']) : '';?>
		</div><!-- .footer-text -->
	</div><!-- .copyright -->
			
	<div class="clearfix"></div>
	
	</div><!-- .container -->
</footer><!-- #footer -->

<?php wp_footer(); ?>
</body>
</html>