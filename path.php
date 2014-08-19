<?php

namespace Donut\Path;

define("DS", \DIRECTORY_SEPARATOR);

function is_absolute($path) {
  return substr($path, 0, 1) === DS;
}

function join() {
  $parts = func_get_args();
  return implode(DS, $parts);
}

function normalize($path) {
  $parts = array_filter(explode(DS, $path));
  return implode(DS, $parts);
}
