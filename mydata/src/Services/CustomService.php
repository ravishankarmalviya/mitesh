<?php

namespace Drupal\mydata\Services;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Language\LanguageManagerInterface;


/**
 * Class CustomService.
 */
class CustomService  {

  protected $database;

  /**
   * Constructs a new CustomService object.
   */
  public function __construct(Connection $connection) {
        $this->database = $connection;

  }

  public function getServiceData() {
    echo "test";die;
    //Do something here to get any data.
  }
  /**
   * Here you can pass your values as $array.
   */
  public function postServiceData($array) {
    //Do something here to post any data.
  }

  public function Drupalise() {
    $query = $this->database->query('SELECT nid FROM {node}');
    $result = $query->fetchAssoc();
    return $result;
  }

  public function mydatarecords($somedata='',$header_table){

      $query = $this->database->select('mydata', 'm');
      $query->fields('m', ['id','name','mobilenumber','email','age','gender','website']);
      if(!empty($somedata)){
        $query->condition('name', $somedata, '=');
      }
      
      $table_sort = $query->extend('Drupal\Core\Database\Query\TableSortExtender')
                          ->orderByHeader($header_table);
      //For the pagination we need to extend the pagerselectextender and
      //limit in the query
      $pager = $table_sort->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit(3);
      $results = $pager->execute()->fetchAll();

      return $results;

  }
}