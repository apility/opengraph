# OpenGraph

OpenGraph is a helper class for generating Open Graph meta tags.

[![License: Beerware](https://img.shields.io/badge/license-beerware-green.svg)](https://spdx.org/licenses/Beerware)
[![Version](https://img.shields.io/github/tag/apility/php-opengraph.svg?label=version)](https://github.com/apility/opengraph/releases/latest)
[![CircleCI](https://circleci.com/gh/apility/opengraph/tree/dev.svg?style=shield&circle-token=5df30032f17a7be371fe2fe0f145664e3ca0945a)](https://circleci.com/gh/apility/opengraph/tree/dev)

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
