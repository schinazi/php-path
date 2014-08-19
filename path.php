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
  $is_absolute = is_absolute($path);

  $parts = array_filter(explode(DS, $path), function($part) {
    return strlen($part) !== 0 && $part !== ".";
  });

  $out = implode(DS, _normalize(array_slice($parts, 0), $is_absolute));

  if (strlen($out) === 0 && !$is_absolute) {
    $out = ".";
  }

  return sprintf("%s%s", ($is_absolute ? DS : ""), $out);
}

function _normalize(Array $parts, $is_absolute) {

  for ($up=0, $i=count($parts)-1; $i>=0; $i--) {

    if ($parts[$i] === "..") {
      array_splice($parts, $i, 1);
      $up++;
    }

    elseif ($up > 0) {
      array_splice($parts, $i, 1);
      $up--;
    }
  }

  if (!$is_absolute) {
    for (; $up > 0; $up--) {
      array_unshift($parts, "..");
    }
  }

  return $parts;
}
