<?php

declare (strict_types = 1);

namespace Apility\OpenGraph\Tests;

use PHPUnit\Framework\TestCase;
use Apility\OpenGraph\OpenGraph;

final class OpenGraphTest extends TestCase
{
  public function testDoesSetDefaultTypeProperty (): void {
    $expexted = "<meta property=\"og:type\" content=\"website\" />\n";
    $meta = (new OpenGraph)
      ->toMetaTags();

    $this->assertEquals(
      $expexted,
      $meta
    );
  }

  public function testCanOverrideTypeProperty (): void {
    $expexted = "<meta property=\"og:type\" content=\"test\" />\n";
    $meta = (new OpenGraph)
      ->addProperty('type', 'test')
      ->toMetaTags();

    $this->assertEquals(
      $expexted,
      $meta
    );
  }

  public function testCanStringify (): void {
    $meta = (new OpenGraph);

    $this->assertEquals(
      $meta->toMetaTags(),
      (string) $meta
    );
  }
}
