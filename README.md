# OpenGraph

OpenGraph is a helper class for generating Open Graph meta tags.

## Installation

Use the package manager [Composer](https://getcomposer.org/) to install OpenGraph.

```bash
composer require apility/opengraph
```

## Usage

```php
use Apility\OpenGraph\OpenGraph;

$og = new OpenGraph();
$og->addProperty('title', 'Hello World');

echo $og->toMetaTags();
```

## License
[Beerware License](https://spdx.org/licenses/Beerware) 

<erikdju@gmail.com> wrote this file. As long as you retain this notice you can do whatever you want with this stuff. If we meet some day, and you think this stuff is worth it, you can buy me a beer in return.
