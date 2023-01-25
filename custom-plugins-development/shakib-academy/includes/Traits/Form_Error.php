<?php

namespace Shakib\Academy\Traits;

/**
 * Form error handler trait
 */
trait Form_Error {

	/**
   * Holds the errors
   *
   * @return array
   */
	public $errors = [];
  

  
	/**
	 * Check if the form has error
	 * 
	 * @param string $key
	 * 
	 * @return boolean
	 */
	public function has_error( $key ) {

		if( isset( $this->errors[ $key ] ) ) {
			return true;
		}

		return false;

	}



	/**
	 * Get the error by key
	 * 
	 * @param string $key
	 * 
	 * @return string|false
	 */
	public function get_error( $key ) {

		if( isset( $this->errors[ $key ] ) ) {
			return $this->errors[ $key ];
		}

		return false;

	}

}
