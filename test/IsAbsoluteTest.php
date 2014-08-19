<?php

namespace Donut\Path\Test;

use Donut\Path as p;

class IsAbsoluteTest extends \PHPUnit_Framework_TestCase {

  public function test_is_absolute_is_defined() {
    $actual = function_exists('\Donut\Path\is_absolute');
    $this->assertTrue($actual);
  }

  public function test_path_with_leading_slash_is_absolute() {
    $actual = p\is_absolute("/hello/donut");
    $this->assertTrue($actual);
  }

  public function test_path_without_leading_slash_is_not_absolute() {
    $actual = p\is_absolute("hello/donut");
    $this->assertFalse($actual);
  }

}
