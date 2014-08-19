Path
====

Utilities for handling and transforming file paths.

The file system is not checked to verify whether paths are valid.

Installation
============

**path** lives on [packagist.org][packagist]

```
$ composer require donut/path
```

Usage
=====

```php
<?php require "vendor/autoload.php";

use \Donut\Path as p;

$path = p\join("/usr/local", "bin", "/donut");
// /usr/local/bin/donut
```

API
===

bool **is_absolute(** string `$path` **)**

```php
<?php is_absolute("/home/donut");
// true
```

-----

string **normalize(** string `$path` **)**

```php
<?php normalize("/a/b/../c/./d.ext");
// /a/c/d.ext
```

-----

string **join(** string `$part1` [, string `$...`] **)**

```php
<?php join("/usr", "local", "/bin", "./donut");
// /usr/local/bin/donut
```

Attribution
===========

* duchess <code@donut.club>
* Donut&reg; Club <http://github.com/donutclub>

License
=======

BSD 3-Clause

[packagist]: http://packagist.org/packages/donut/path
