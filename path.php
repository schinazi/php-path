<?php

namespace Donut\Path;

define("DS", \DIRECTORY_SEPARATOR);

function canonicalize() {}

function is_absolute($path) {
  return substr($path, 0, 1) === DS;
}

function join() {
  $parts = func_get_args();
  return normalize(implode(DS, $parts));
}

function normalize($path) {

  $up     = 0;
  $parts  = array();

  // normalize each path component
  foreach (explode(DS, $path) as $p) {

    // skip empty and "." components
    if ($p === "" || $p === ".") continue;

    // go up a directory
    elseif ($p === "..") {
      if (is_null(array_pop($parts))) $up++;
      continue;
    }

    array_push($parts, $p);
  }

  // reattach trailing slash, if present
  if (substr($path, -1) === DS && count($parts) > 0) {
    array_push($parts, "");
  }

  // exceptions for relative urls
  if (!is_absolute($path)) {

    // allow relative urls to go "up" beyond their starting point
    for (; $up > 0; $up--) {
      array_unshift($parts, "..");
    }

    // if a relative path is empty, set to "."
    if (count($parts) === 0) {
      array_push($parts, ".");
    }
  }

  return sprintf("%s%s", (is_absolute($path) ? DS : ""), implode(DS, $parts));
}
