# OpenGraph

OpenGraph is a helper class for generating Open Graph meta tags.

[![License: Beerware](https://img.shields.io/badge/license-beerware-green.svg)](https://spdx.org/licenses/Beerware)
[![Version](https://img.shields.io/github/tag/apility/php-opengraph.svg?label=version)](https://github.com/apility/opengrahph/releases/latest)
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

## OpenGraphAttribute Interface
In order to have the ability to let objects describe themselves, we have an interface called `OpenGraphAttribute`.

Assuming implementation of an Image class that has the following method:
```php

class Image extends SomeORM {
  ...

  public function openGraphNode() {
    $node = new OpenGraph;
    $node->setBaseValue("https://ulv.no/bilde.jpg");
    $node->addProperty("width", 500);
    $node->addProperty("height", 200);
    return node;
  }
}

```

This object be used as the content attribute and added as a property to another Open Graph
and will in the case below generate the correct `og:image`, `og:image:width`, and `og:image:height` meta tags.
```php

// Image implements OpenGraphAttribute
$image = Image::findorFai(1234);

$og = new OpenGraph;
$og->addProperty("image", $image);

print($og->toMetaTags("og"));

```

