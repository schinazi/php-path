<?php

namespace Donut\Path\Test;

use Donut\Path as p;

class NormalizeTest extends \PHPUnit_Framework_TestCase {

  public function test_normalize_is_defined() {
    $actual = function_exists('\Donut\Path\normalize');
    $this->assertTrue($actual);
  }

  public function test_normalize_preserves_leading_slash_in_absolute_path() {
    $this->assertSame("/a/b/c", p\normalize("/a/b/c"));
  }

  public function test_normalize_removes_trailing_slash() {
    $this->assertSame("hello/donut", p\normalize("hello/donut/"));
  }

  public function test_normalize_resolves_repeated_separators() {
    $this->assertSame("hello/donut/club", p\normalize("hello//donut///club"));
  }

  public function test_normalize_resolves_single_dots() {
    $cases = array(
      "./a/b"     => "a/b",
      "a/./b"     => "a/b",
      "a/b/."     => "a/b",
      "./a/./b/." => "a/b",
      "./././."   => ""
    );

    foreach($cases as $path => $expected) {
      $this->assertSame($expected, p\normalize($path));
    }
  }

}
