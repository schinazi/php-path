<?php

namespace Donut\Path\Test;

use Donut\Path as p;

class IsAbsoluteTest extends \PHPUnit_Framework_TestCase {

  public function test_is_absolute_is_defined() {
    $actual = function_exists('\Donut\Path\is_absolute');
    $this->assertTrue($actual);
  }

}
