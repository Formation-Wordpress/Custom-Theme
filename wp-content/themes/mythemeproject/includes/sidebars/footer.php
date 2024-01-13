<div id="footer" class="container wpex-row clr">
	<div id="footer-widgets" class="clr">
		<div class="footer-box span_1_of_4 col col-1">
			<?php
				if (is_active_sidebar('before_footer_widget_area_1')) {
					dynamic_sidebar('before_footer_widget_area_1');
				}
			?>
		</div>
		<!-- .footer-box -->
		<div class="footer-box span_1_of_4 col col-2">
			<?php
				if (is_active_sidebar('before_footer_widget_area_2')) {
					dynamic_sidebar('before_footer_widget_area_2');
				}
			?>
		</div>
		<!-- .footer-box -->
		<div class="footer-box span_1_of_4 col col-3">
			<?php
				if (is_active_sidebar('before_footer_widget_area_3')) {
					dynamic_sidebar('before_footer_widget_area_3');
				}
			?>
		</div>
		<!-- .footer-box -->
		<div class="footer-box span_1_of_4 col col-4">
			<?php
				if (is_active_sidebar('before_footer_widget_area_4')) {
					dynamic_sidebar('before_footer_widget_area_4');
				}
			?>

			<div class="footer-widget widget_text clr">
				<div class="textwidget">
					<a href="#" title="Total Theme">
						<img src="http://wordpress_project.test/wp-content/themes/mythemeproject/files/uploads/2014/09/total-theme.png" alt="Total Theme" />
					</a>
				</div>
			</div>
		</div>
		<!-- .footer-box -->
	</div>
	<!-- #footer-widgets -->
</div>
<!-- #footer -->