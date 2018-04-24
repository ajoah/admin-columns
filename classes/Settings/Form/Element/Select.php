<?php

namespace AC\Settings\Form\Element;

use AC\Form;

class Select extends Form\Element\Select {

	protected function render_ajax_message() {
		return '<div class="msg"></div>';
	}

	/**
	 * @return string|false
	 */
	protected function render_description() {
		return parent::render_description() . $this->render_ajax_message();
	}

}