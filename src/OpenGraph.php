<?php
declare (strict_types = 1);
namespace Apility\OpenGraph;

class OpenGraph implements \Countable {

  /**
   * the list is a structure of nested arrays.
   * 
   * Consider a type Attribute, which is an array where the first value is the current attributes value
   * and the second value is another Array of child attributes
   * 
   * ```php
   * $attribute = ['value', ...$attribute]
   * ```
   * The root node is the "og" node and should have no value. 
   * 
   * 
   * @property array
   */
  private $list;

  public function __construct($list = [])
  {
    $this->list = [NULL, []];
    $this->list[1]['type'] = ["website", []];
  }

  /**
   * Add OpenGraph property
   *
   * @param string|OpenGraphAttribute $property Property name
   * @param string|int $content Property content
   * @return OpenGraph self
   */
  public function addProperty (string $property, $content): self {

    if($property === "description") {
      $content = substr($content, 0, 300);
    }
    if(is_null($property) || strlen($property) === 0) {
      throw new \InvalidArgumentException("Property attribute can not be null or empty");
    }
    if($content instanceof OpenGraphAttribute) {
      $this->list[1][$property] = $content->openGraphNode();
    } if(is_array($content)) {
      $this->list[1][$property] = $content;
    } else if (!is_null($content)) {
      $this->list[1][$property] = [$content, []];
    }

    return $this;
  }

  /**
   * Generate meta tags markup
   *
   * @return string Meta tags markup
   */
  public function toMetaTags (): string {
    $list = self::genObjects("", $this->list, "og");
    $tags = array_map(function($key, $value) {
      return '<meta property="' . htmlentities($key) . '" content="' . htmlentities($value) . '" />';
    }, array_keys($list), array_values($list));
    return implode(PHP_EOL, $tags);
  }


  /**
   * Get length of properties collection
   *
   * @return int Length of properties collection
   */
  public function length(): int
  {
    return count($this->list);
  }

  /**
   * Implements Countable interface
   * 
   * @return int Length of properties collection
   */
  public function count(): int {
    return count($this->list);
  }

  /**
   * Magic method to override __toString
   *
   * @return string
   */
  public function __toString(): string
  {
    return $this->toMetaTags();
  }

  private static function genObjects($key, $object, $prefix="og") {
    $prefix = implode(":", [rtrim($prefix, ":"), rtrim($key, ":")]);
    $root = !is_null($object[0]) ? [$prefix => $object[0]] : [];
    $children = array_map(function($childKey, $value) use ($prefix) {
      return self::genObjects($childKey, $value, $prefix);
    }, array_keys($object[1]), array_values($object[1]));
    return array_merge($root, ...$children);
  }

}
