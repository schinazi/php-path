<?php

namespace Donut\Path;

function getcwd() {
  return "/fake";
}

namespace Donut\Path\Test;

use Donut\Path as p;

class CanonicalizeTest extends \PHPUnit_Framework_TestCase {

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

    foreach ($cases as $input => $expected) {
      $this->assertSame($expected, p\canonicalize($input));
    }
  }

  public function test_canonicalize_accepts_second_argument_as_pwd() {
    $cases = array(
      "."         => "/donut",
      "a"         => "/donut/a",
      "a/b"       => "/donut/a/b",
      "a/b/c/.."  => "/donut/a/b"
    );

    foreach ($cases as $input => $expected) {
      $this->assertSame($expected, p\canonicalize($input, "/donut"));
    }
  }

  public function test_canonicalize_absolute_path_returns_original() {
    $cases = array(
      "/"     => "/",
      "/a"    => "/a",
      "/a/b"  => "/a/b"
    );

    foreach ($cases as $input => $expected) {
      $this->assertSame($expected, p\canonicalize($input));
    }
  }

  public function test_canonicalize_absolute_path_ignores_second_arg() {
    $cases = array(
      "/"     => "/",
      "/a"    => "/a",
      "/a/b"  => "/a/b"
    );

    foreach ($cases as $input => $expected) {
      $this->assertSame($expected, p\canonicalize($input, "/donut"));
    }
  }

}
