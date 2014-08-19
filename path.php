<?php

namespace Donut\Path;

function join() {
  $parts = func_get_args();
  return implode("/", $parts);
}
