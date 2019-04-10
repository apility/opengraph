<?php

namespace Apility\OpenGraph;

class OpenGraph
{
  private $list;

  public function __construct($list = [])
  {
    $this->list = collect($list);
  }

  /**
   * Add OpenGraph property
   *
   * @param string $property Property name
   * @param string|int $content Property content
   * @return OpenGraph self
   */
  public function addProperty (string $property, $content = NULL): self {
    if (!is_null($property) && !is_null($content)) {
      $this->list->push([
        'property' => $property,
        'content' => $content
      ]);
    }

    return $this;
  }

  /**
   * Generate meta tags markup
   *
   * @return string Meta tags markup
   */
  public function toMetaTags (): string {
    if (!$this->list->search(function ($item) {
      return $item['property'] === 'type';
    })) {
      $this->addProperty('type', 'website');
    }

    return $this->list->map(function ($item) {
      if ($item['property'] === 'image') {
        $width = $this->list->where('property', 'image:width')->first()['content'];
        $height = $this->list->where('property', 'image:height')->first()['content'];

        $item['content'] = get_cdn_media($item['content'], $width . 'x' . $height, 'rc');
      }

      if ($item['property'] === 'description') {
        if (strlen($item['content']) >= 300) {
          $item['content'] = substr($item['content'], 0, 300) . '…';
        }
      }

      return '<meta property="og:' . htmlentities($item['property']) . '" content="' . htmlentities($item['content']) . '" />';
    })
    ->implode(PHP_EOL);
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
   * Magic method to override __toString
   *
   * @return string
   */
  public function __toString(): string
  {
    return $this->toMetaTags();
  }
}
