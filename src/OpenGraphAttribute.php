<?php
namespace Apility\OpenGraph;

interface OpenGraphAttribute {
  /**
   * This function returns an OpenGraphAttribute in array form
   * 
   * The output should look like this recursive data structure
   * [value, [OpenGraphAttribute]]
   * 
   * @return array
   */
  function openGraphNode();
}