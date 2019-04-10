<?php

declare (strict_types = 1);

namespace Apility\OpenGraph\Tests;
require_once(__DIR__ . "/../src/OpenGraph.php");
use PHPUnit\Framework\TestCase;
use Apility\OpenGraph\OpenGraph;

final class OpenGraphTest extends TestCase
{
  public function testDoesSetDefaultTypeProperty (): void {
    $expexted = "<meta property=\"og:type\" content=\"website\" />";
    $meta = (new OpenGraph)
      ->toMetaTags();

    $this->assertEquals(
      $expexted,
      $meta
    );
  }

  public function testCanOverrideTypeProperty (): void {
    $expexted = "<meta property=\"og:type\" content=\"test\" />";
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
  
  public function testThrowsExceptionIfInvalid() {
    $m = new OpenGraph;
    $this->expectException(\TypeError::class);
    $m->addProperty(NULL, "something");
  }

  public function testThrowsExceptionIfInvalidEmptyString() {
    $this->expectException(\InvalidArgumentException::class);
    $m = new OpenGraph;
    $m->addProperty("", "something");
  }

  public function testDescriptiontruncate() {
    $m = new OpenGraph;
    $m->addProperty('description', "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat officia deserunt eveniet commodi harum modi voluptates, laboriosam praesentium fuga, veniam fugit. Velit odit aperiam dolor ad quo ut delectus architecto!Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat officia deserunt eveniet commodi harum modi voluptates, laboriosam praesentium fuga, veniam fugit. Velit odit aperiam dolor ad quo ut delectus architecto!Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat officia deserunt eveniet commodi harum modi voluptates, laboriosam praesentium fuga, veniam fugit. Velit odit aperiam dolor ad quo ut delectus architecto!Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat officia deserunt eveniet commodi harum modi voluptates, laboriosam praesentium fuga, veniam fugit. Velit odit aperiam dolor ad quo ut delectus architecto!");
    $this->assertEquals(
      strlen($m->getValue('description')),
      300
    );
  }
  public function testNestedValues() {
    $m = new OpenGraph;
    $m->addProperty("test", ["test1", [ 
      "best" => ["yo", []],
      "less" => ["bb", []]
    ]
  ]);
    $this->assertEquals(
      '<meta property="og:type" content="website" />
<meta property="og:test" content="test1" />
<meta property="og:test:best" content="yo" />
<meta property="og:test:less" content="bb" />',
      $m->toMetaTags()
    );
  }
}
