# OpenGraph

OpenGraph is a helper class for generating Open Graph meta tags.

[![License: Beerware](https://img.shields.io/badge/license-beerware-green.svg)](https://spdx.org/licenses/Beerware)
[![Version](https://img.shields.io/github/tag/apility/php-opengraph.svg?label=version)](https://github.com/apility/vipps-php/releases/latest)

**[Documentation](http://htmlpreview.github.io/?https://github.com/apility/opengraph/blob/master/docs/index.html)**

## Installation

Use the package manager [Composer](https://getcomposer.org/) to install OpenGraph.

```bash
composer require apility/opengraph
```

## Usage

```php
use Apility\OpenGraph\OpenGraph;

$og = new OpenGraph;
$og->addProperty('title', 'Hello World');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php print($og->toMetaTags()); ?>
  <title>Document</title>
</head>
<body>
  <h1>Hello World</h1>
</body>
</html>
```

## License
[Beerware License](https://spdx.org/licenses/Beerware)

<erikdju@gmail.com> wrote this file. As long as you retain this notice you can do whatever you want with this stuff. If we meet some day, and you think this stuff is worth it, you can buy me a beer in return.
