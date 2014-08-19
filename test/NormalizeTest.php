<?php

namespace Donut\Path\Test;

use Donut\Path as p;

class NormalizeTest extends \PHPUnit_Framework_TestCase {

  private function assertEachSame(Array $cases) {
    foreach($cases as $path => $expected) {
      $this->assertSame($expected, p\normalize($path));
    }
  }

  public function test_normalize_is_defined() {
    $actual = function_exists('\Donut\Path\normalize');
    $this->assertTrue($actual);
  }

  public function test_normalize_preserves_leading_slash_in_absolute_path() {
    $cases = array(
      "/"       => "/",
      "/a"      => "/a",
      "/a/b/c"  => "/a/b/c"
    );

    $this->assertEachSame($cases);
  }

  public function test_normalize_removes_trailing_slash() {
    $cases = array(
      "a/"      => "a",
      "a/b/"    => "a/b",
      "a/b/c/"  => "a/b/c"
    );

    $this->assertEachSame($cases);
  }

  public function test_normalize_resolves_repeated_separators() {
    $cases = array(
      "a//b"        => "a/b",
      "a///b///c"   => "a/b/c",
      "//a//b//c//" => "/a/b/c"
    );

    $this->assertEachSame($cases);
  }

  public function test_normalize_resolves_single_dots() {
    $cases = array(
      "./a/b"     => "a/b",
      "a/./b"     => "a/b",
      "a/b/."     => "a/b",
      "./a/./b/." => "a/b",
      "./././."   => "."
    );

    $this->assertEachSame($cases);
  }

  public function test_normalize_empty_path_should_return_single_dot() {
    $cases = array(
      ""      => ".",
      "."     => ".",
      "./."   => ".",
      "././." => "."
    );

    $this->assertEachSame($cases);
  }

  public function test_normalize_resolves_double_dots() {
    $cases = array(
      "a/.."              => ".",
      "a/b/.."            => "a",
      "a/b/c/../.."       => "a",
      "a/b/../c/../d/.."  => "a",
      "a/b/../c"          => "a/c"
    );

    $this->assertEachSame($cases);
  }

  public function test_normalize_double_dots_cannot_go_above_absolute_path() {
    $cases = array(
      "/a/.."         => "/",
      "/a/../.."      => "/",
      "/a/b/../.."    => "/",
      "/a/b/../../.." => "/",
      "/a/../../../b" => "/b"
    );

    $this->assertEachSame($cases);
  }

  public function test_normalize_double_dots_can_go_above_relative_path() {
    $cases = array(
      ".."          => "..",
      "a/../.."     => "..",
      "a/../../.."  => "../..",
      "a/../../b/c" => "../b/c"
    );

    $this->assertEachSame($cases);
  }

  public function test_normalize_insane_paths() {
    $cases = array(
      ".//a//b//..//c//.//d//e.ext"     => "a/c/d/e.ext",
      "//a/..//.//..//b.ext//..//c.ext" => "/c.ext"
    );

    $this->assertEachSame($cases);
  }

}
