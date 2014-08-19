<?php

namespace Donut\Path;

function is_absolute($path) {
  return substr($path, 0, 1) === "/";
}

function join() {
  $parts = func_get_args();
  return implode("/", $parts);
}

function normalize() {}
