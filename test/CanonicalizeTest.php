<?php

namespace Donut\Path\Test;

use Donut\Path as p;

class CanonicalizeTest extends \PHPUnit_Framework_TestCase {

  public function test_canonicalize_is_defined() {
    $actual = function_exists('\Donut\Path\canonicalize');
    $this->assertTrue($actual);
  }

}
