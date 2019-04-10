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
  public function toMetaTags(): string
  {
    $metaTags = '';

    if (!$this->list->search(function ($item) {
      return $item['property'] === 'type';
    })) {
      $this->addProperty('type', 'website');
    }

    if ($this->list->contains('property', 'image')) {
      if (!$this->list->contains('property', 'image:width')) {
        $this->addProperty('image:width', 1200);
      }

      if (!$this->list->contains('property', 'image:height')) {
        $this->addProperty('image:height', 1200);
      }
    }

    $this->list->each(function ($item) use (&$metaTags) {
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

      $metaTags .= '<meta property="og:' . htmlentities($item['property']) . '" content="' . htmlentities($item['content']) . '" />' . PHP_EOL;
    });

    return $metaTags;
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
