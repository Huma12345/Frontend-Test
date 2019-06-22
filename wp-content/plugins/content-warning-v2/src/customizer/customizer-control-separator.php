<?php

if ( ! class_exists( 'PSAG_Separator_Control' ) ) {
	return null;
}
/**
 * Class Prefix_Separator_Control
 *
 * Custom control to display separator
 */
class PSAG_Separator_Control extends WP_Customize_Control {

	/**
	 * Render the separator control
	 *
	 * @return void
	 */
	public function render_content() {
		?>
		<label> <br>
			<hr>
			<br> </label>
		<?php
	}
}
