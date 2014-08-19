<?php

namespace Donut\Path;

function getcwd() {
  return "/fake";
}

namespace Donut\Path\Test;

use Donut\Path as p;

class CanonicalizeTest extends \PHPUnit_Framework_TestCase {

  private function assertEachSame(Array $cases) {
    foreach ($cases as $input => $expected) {
      $this->assertSame($expected, p\canonicalize($input));
    }
  }

  public function test_canonicalize_is_defined() {
    $actual = function_exists('\Donut\Path\canonicalize');
    $this->assertTrue($actual);
  }

  public function test_canonicalize_relative_path_uses_pwd_by_default() {
    $cases = array(
      "."         => "/fake",
      "a"         => "/fake/a",
      "a/b"       => "/fake/a/b",
      "a/b/c/.."  => "/fake/a/b"
    );

    $this->assertEachSame($cases);
  }

}
