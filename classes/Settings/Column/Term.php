<?php

class AC_Settings_Column_Term extends AC_Settings_Column
	implements AC_Settings_FormatValueInterface {

	/**
	 * @var string
	 */
	private $term_property;

	protected function set_name() {
		$this->name = 'term';
	}

	protected function define_options() {
		return array( 'term_property' );
	}

	public function create_view() {
		$setting = $this
			->create_element( 'select' )
			->set_options( array(
				''     => __( 'Title' ),
				'slug' => __( 'Slug' ),
				'id'   => __( 'ID' ),
			) );

		$view = new AC_View( array(
			'label'   => __( 'Display', 'codepress-admin-columns' ),
			'setting' => $setting,
		) );

		return $view;
	}

	/**
	 * @return string
	 */
	public function get_term_property() {
		return $this->term_property;
	}

	/**
	 * @param string $term_property
	 *
	 * @return bool
	 */
	public function set_term_property( $term_property ) {
		$this->term_property = $term_property;

		return true;
	}

	/**
	 * @param AC_ValueFormatter $value_formatter
	 *
	 * @return AC_ValueFormatter
	 */
	public function format( AC_ValueFormatter $value_formatter ) {
		switch ( $this->get_term_property() ) {
			case 'slug' :
				$label = ac_helper()->taxonomy->get_term_field( 'slug', $value_formatter->get_id(), $this->column->get_taxonomy() );

				break;
			case 'id' :
				$label = $value_formatter->get_id();

				break;
			default :
				$label = ac_helper()->taxonomy->get_term_field( 'name', $value_formatter->get_id(), $this->column->get_taxonomy() );
		}

		if ( empty( $label ) ) {
			$value_formatter->value = false;
		}

		return $value_formatter;
	}

}