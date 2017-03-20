<?php

class AC_Settings_Column_WordsPerMinute extends AC_Settings_Column
	implements AC_Settings_FormatValueInterface {

	/**
	 * @var int
	 */
	private $words_per_minute;

	protected function define_options() {
		return array(
			'words_per_minute' => 200,
		);
	}

	public function create_view() {

		$setting = $this->create_element( 'number' )
		                ->set_attributes( array(
			                'min'         => 0,
			                'step'        => 1,
			                'placeholder' => $this->get_words_per_minute(),
		                ) );

		$view = new AC_View( array(
			'label'   => __( 'Words per minute', 'codepress-admin-columns' ),
			'tooltip' => __( 'Estimated reading time in words per minute.', 'codepress-admin-columns' ) . ' ' . sprintf( __( 'By default: %s', 'codepress-admin-columns' ), $this->get_words_per_minute() ),
			'setting' => $setting,
		) );

		return $view;
	}

	/**
	 * @return int
	 */
	public function get_words_per_minute() {
		return $this->words_per_minute;
	}

	/**
	 * @param int $words_per_minute
	 *
	 * @return $this
	 */
	public function set_words_per_minute( $words_per_minute ) {
		$this->words_per_minute = $words_per_minute;

		return $this;
	}

	/**
	 * Returns estimate reading time in seconds
	 *
	 * @param AC_ValueFormatter $value_formatter
	 *
	 * @return AC_ValueFormatter
	 */
	public function format( AC_ValueFormatter $value_formatter ) {
		$value_formatter->value = ac_helper()->string->get_estimated_reading_time_in_seconds( $value_formatter->value, $this->get_words_per_minute() );

		return $value_formatter;
	}

}