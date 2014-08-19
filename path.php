<?php

namespace Donut\Path;

function is_absolute() {}

function join() {
  $parts = func_get_args();
  return implode("/", $parts);
}

function normalize() {}
