<?php

namespace Donut\Path\Test;

use Donut\Path as p;

class NormalizeTest extends \PHPUnit_Framework_TestCase {

  public function test_normalize_is_defined() {
    $actual = function_exists('\Donut\Path\normalize');
    $this->assertTrue($actual);
  }

  public function test_normalize_removes_trailing_slash() {
    $this->assertSame("hello/donut", p\normalize("/hello/donut/"));
  }

}
