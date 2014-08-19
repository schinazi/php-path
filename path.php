<?php

namespace Donut\Path;

function join($a, $b) {
  $parts = array($a, $b);
  return implode("/", $parts);
}
