<?php

namespace Drupal\mydata\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Unicode;

class DefaultController extends ControllerBase
{

  /**
   * Returns response for the autocompletion.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The current request object containing the search string.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JSON response containing the autocomplete suggestions.
   */

  public function autocomplete(request $request) {
    $matches = array();
    $string = $request->query->get('q');
    if ($string) {
      $matches = array();
      $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('title', '%'.db_like($string).'%', 'LIKE');
      //->condition('field_tags.entity.name', 'node_access');
      $nids = $query->execute();
      $result = entity_load_multiple('node', $nids);
      foreach ($result as $row) {
        //$matches[$row->nid->value] = $row->title->value;
        $matches[] = ['value' => $row->nid->value, 'label' => $row->title->value];
      }
    }
    return new JsonResponse($matches);
  }
}