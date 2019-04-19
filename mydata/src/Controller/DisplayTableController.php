<?php

namespace Drupal\mydata\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormState;
use Drupal\Core\Url;

/**
 * Class DisplayTableController.
 *
 * @package Drupal\mydata\Controller
 */
class DisplayTableController extends ControllerBase {


  public function getContent() {
    // First we'll tell the user what's going on. This content can be found
    // in the twig template file: templates/description.html.twig.
    // @todo: Set up links to create nodes and point to devel module.
    $build = [
      'description' => [
        '#theme' => 'mydata_description',
        '#description' => 'foo',
        '#attributes' => [],
      ],
    ];
    return $build;
  }

  /**
   * Display.
   *
   * @return string
   *   Return Hello string.
   */
  public function display() {
	  
	  $node = \Drupal\node\Entity\Node::load(2);
	  
	  // Node::$in_preview  public property Whether the node is being previewed or not.
	  
	  // Node::access  public function Checks data value access.Overrides ContentEntityBase::access boolean true
	
	  //var_dump($node->access());
	  
	  // Node::baseFieldDefinitions  public static function Provides base field definitions for an entity type. Overrides ContentEntityBase::baseFieldDefinitions
	  
	  // Node::getCreatedTime  public function  Gets the node creation timestamp.Overrides NodeInterface::getCreatedTime return string timestamp

	  //var_dump($node->getCreatedTime());
	  
	  // Node::getCurrentUserId   public static  function  Default value callback for 'uid' base field definition.  return array
	  //var_dump($node->getCurrentUserId());
	  
	  
	  //print_r($node->getOwner()); // public function Returns the entity owner's user entity. Overrides EntityOwnerInterface::getOwner return object
	  
	  //echo $node->getOwnerId(); public function Returns the entity owner's user ID.Overrides EntityOwnerInterface::getOwnerId return string

	  //var_dump($node->getOwnerId());
	  
	  // Node::getRevisionAuthor  public function Gets the node revision author.Overrides NodeInterface::getRevisionAuthor return object
	  
	  //var_dump($node->getRevisionAuthor());
	  
	  // Node::getRevisionCreationTime  public function Gets the node revision creation timestamp.Overrides NodeInterface::getRevisionCreationTime return string timestamp
	  
	  //var_dump($node->getRevisionCreationTime());
	  
	  // Node::getRevisionLogMessage  public function  Returns the entity revision log message.Overrides RevisionLogInterface::getRevisionLogMessage return string

	  //var_dump($node->getRevisionLogMessage());
	  
	  // Node::getRevisionUser  public function  Gets the entity revision author.Overrides RevisionLogInterface::getRevisionUser return object
	  
	  //var_dump($node->getRevisionUser());
	  
	  // Node::getRevisionUserId  public function  Gets the entity revision author ID.Overrides RevisionLogInterface::getRevisionUserId return string
		//var_dump($node->getRevisionUserId());
		
	 // Node::getTitle  public function  Gets the node title.Overrides NodeInterface::getTitle return string
		//var_dump($node->getTitle());
		
	 //  Node::getType  public function  Gets the node type.Overrides NodeInterface::getType return string
			//var_dump($node->getType());
			
	 // Node::isPromoted  public function Returns the node promotion status.Overrides NodeInterface::isPromoted
	 
	 // Node::isPublished  public function  Returns the node published status indicator.Overrides NodeInterface::isPublished
	 
	 //Node::isSticky  public function  Returns the node sticky status.Overrides NodeInterface::isSticky
	 
	 // Node::postDelete 	public static 	function 	Acts on deleted entities before the delete hook is invoked.Overrides Entity::postDelete
	 
	 // Node::postSave 	public 	function 	Acts on a saved entity before the insert or update hook is invoked.Overrides Entity::postSave
	 
	 //Node::preDelete 	public static 	function 	Acts on entities before they are deleted and before hooks are invoked.Overrides Entity::preDelete
	 
	 //Node::preSave 	public 	function 	Acts on an entity before the presave hook is invoked.Overrides ContentEntityBase::preSave
	 
	 // Node::preSaveRevision 	public 	function 	Acts on a revision before it gets saved.Overrides ContentEntityBase::preSaveRevision
	 
	 
	 //---------------------------------------------------------------------------
	 
	 //Node::setCreatedTime 	public 	function 	Sets the node creation timestamp.Overrides NodeInterface::setCreatedTime
	 
	 //Node::setOwner 	public 	function 	Sets the entity owner's user entity.Overrides EntityOwnerInterface::setOwner
	
	 // Node::setOwnerId 	public 	function 	Sets the entity owner's user ID.Overrides EntityOwnerInterface::setOwnerId
	 
	 //Node::setPromoted 	public 	function 	Sets the node promoted status.Overrides NodeInterface::setPromoted
	 
	 // Node::setPublished 	public 	function 	Sets the published status of a node..Overrides NodeInterface::setPublished
	 
	 // Node::setRevisionAuthorId 	public 	function 	Sets the node revision author.Overrides NodeInterface::setRevisionAuthorId
	 
	 // Node::setRevisionCreationTime 	public 	function 	Sets the node revision creation timestamp.Overrides NodeInterface::setRevisionCreationTime
	 
	 // Node::setRevisionLogMessage 	public 	function 	Sets the entity revision log message.Overrides RevisionLogInterface::setRevisionLogMessage
	 
	 //Node::setRevisionUser 	public 	function 	Sets the entity revision author.Overrides RevisionLogInterface::setRevisionUser
	 
	 // Node::setRevisionUserId 	public 	function 	Sets the entity revision author by ID.Overrides RevisionLogInterface::setRevisionUserId
	 
	 // Node::setSticky 	public 	function 	Sets the node sticky status.Overrides NodeInterface::setSticky
	 
	 // Node::setTitle 	public 	function 	Sets the node title.Overrides NodeInterface::setTitle
	
			//$node->setTitle("testing checking");
			//$node->save();
		//var_dump($node);
	
	
	
	


	

	  //echo "hello";
	  //die;
    
		$somedata = '';
		//if(isset($_SESSION['mymodule_name']['my_variable_name'])){
			$somedata =  \Drupal::request()->get('text');;
			//unset($_SESSION['mymodule_name']['my_variable_name']);
		//}
		
		
		$header_table = array(
				array('data' => $this->t('SrNo'), 'field' => 'id', 'sort' => 'asc'),
				array('data' => $this->t('Name'), 'field' => 'name', 'sort' => 'asc'),
				array('data' => $this->t('MobileNumber'), 'field' => 'mobilenumber', 'sort' => 'asc'),
				//'email'=>t('Email'),
				array('data' => $this->t('Age'), 'field' => 'age', 'sort' => 'asc'),
				'gender' => t('Gender'),
				//'website' => t('Web site'),
				'opt' => t('operations'),
				'opt1' => t('operations'),
			);
			
		
						
		$query = \Drupal::database()->select('mydata', 'm');
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
	
	
	// Initialize an empty array
	$rows=array();
    foreach($results as $data){
        $delete = Url::fromUserInput('/mydata/form/delete/'.$data->id);
        $edit   = Url::fromUserInput('/mydata/form/mydata?num='.$data->id);

      //print the data from table
             $rows[] = array(
            'id' =>$data->id,
            'name' => $data->name,
            'mobilenumber' => $data->mobilenumber,
                //'email' => $data->email,
            'age' => $data->age,
            'gender' => $data->gender,
                //'website' => $data->website,

            \Drupal::l('Delete', $delete),
            \Drupal::l('Edit', $edit),
            );

    }
	
	
	

    //add you custom code here...

	$form = \Drupal::formBuilder()->getForm('Drupal\mydata\Form\MydatafiltersForm');
    //$form['form'] = $form;


		$form['table'] = [
		  '#type' => 'table',
		  '#header' => $header_table,
		  '#rows' => $rows,
		  '#empty' => t('No users found'),
		];
	  // Finally add the pager.
		$form['pager'] = array(
		  '#type' => 'pager'
		);
	

        return $form;

  }
  
  
	
	/**
   * Display.
   *
   * @return string
   *   Return Hello string.
   */
  public function displayajax() {
    $form = array (
	  '#attributes' => [
					'id' => ['edit-output-table'],
			  ]
	);
		$somedata = '';
		//if(isset($_SESSION['mymodule_name']['my_variable_name'])){
			$somedata =  \Drupal::request()->get('text');;
			//unset($_SESSION['mymodule_name']['my_variable_name']);
		//}
		
		
		$header_table = array(
				array('data' => $this->t('SrNo'), 'field' => 'id', 'sort' => 'asc'),
				array('data' => $this->t('Name'), 'field' => 'name', 'sort' => 'asc'),
				array('data' => $this->t('MobileNumber'), 'field' => 'mobilenumber', 'sort' => 'asc'),
				//'email'=>t('Email'),
				array('data' => $this->t('Age'), 'field' => 'age', 'sort' => 'asc'),
				'gender' => t('Gender'),
				//'website' => t('Web site'),
				'opt' => t('operations'),
				'opt1' => t('operations'),
			);
			
		
						
		$query = \Drupal::database()->select('mydata', 'm');
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
	
	
	// Initialize an empty array
	$rows=array();
    foreach($results as $data){
        $delete = Url::fromUserInput('/mydata/form/delete/'.$data->id);
        $edit   = Url::fromUserInput('/mydata/form/mydata?num='.$data->id);

      //print the data from table
             $rows[] = array(
            'id' =>$data->id,
            'name' => $data->name,
            'mobilenumber' => $data->mobilenumber,
                //'email' => $data->email,
            'age' => $data->age,
            'gender' => $data->gender,
                //'website' => $data->website,

            \Drupal::l('Delete', $delete),
            \Drupal::l('Edit', $edit),
            );

    }
	
	
	

    //add you custom code here...

	$form_filters = \Drupal::formBuilder()->getForm('Drupal\mydata\Form\MydataajaxForm');
    $form['form'] = $form_filters;
	
	


		$form['table'] = [
		  '#type' => 'table',
		  '#header' => $header_table,
		  '#rows' => $rows,
		  '#empty' => t('No users found'),
		  
		];
	

	  // Finally add the pager.
		$form['pager'] = array(
		  '#type' => 'pager'
		);
	

        return $form;

  }

}
