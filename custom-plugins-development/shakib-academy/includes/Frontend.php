<?php

/**
 * Root namespace
 */
namespace Shakib\Academy;


/**
 * The Frontend Class
 */

class Frontend {

  /**
   * Initializes the class
   */
  
  public function __construct() {
    
    new Frontend\Enquiry();
    
    new Frontend\Shortcode();

  }

}