<?php

namespace Drupal\mydata\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\OpenModalDialogCommand;

use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Url;

/**
 * Class MydatafiltersajaxForm
 *
 * @package Drupal\mydata\Form
 */
class MydataajaxForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mydata_formfiltersajax';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

	$form['filters'] = array(
    '#type' => 'fieldset',
    '#title' => t('Filters test'),
  );
  
	$form['filters']['container']['output'] = [
			  '#type' => 'textfield',
			  '#size' => '60',
			  '#disabled' => TRUE,
			  '#value' => 'Hello, 1111World!',
			  
		];
		
	$form['filters']['input'] = [
					  '#type' => 'textfield',
					  '#title' => 'A Textfield',
					  '#description' => 'Enter a number to be validated via ajax.',
					  '#size' => '60',
					  '#maxlength' => '200',
					  '#required' => TRUE,
					  '#ajax' => [
						'callback' => '::sayHello',
						'event' => 'keyup',
						'wrapper' => 'edit-output',
						'progress' => [
						  'type' => 'throbber',
						  'message' => t('Verifying entry...'),
						],
					  ],
					];
    //$form = array();
    $form['filters']['text'] = array(
      '#title' => $this->t('Text'),
      '#type' => 'textfield',
      '#default_value' => \Drupal::request()->get('text'),
    );
    $form['filters']['submit_apply'] = [
      '#type' => 'submit',
      '#value' => t('Filter'),
	  '#submit' => array('::newSubmissionHandlerOne'),
    ];
	$form['filters']['buttons']['reset'] = array('#type' => 'submit', '#value' => t('Reset'),'#submit' => array('::newSubmissionHandlerTwo'));
    return $form;
  }

  /**
    * {@inheritdoc}
    */
  public function validateForm(array &$form, FormStateInterface $form_state) {

         
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
			
     }
	 
	 /**
   * Custom submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function newSubmissionHandlerOne(array &$form, FormStateInterface $form_state) {
    // Get the form values here as $form_state->getValue(array('sample_field')) 
    // and process it.
	
	//print "<pre>";print_r($form);die;
			$text = \Drupal::request()->get('text');
			//$_SESSION['mymodule_name']['my_variable_name'] = $text ;
			$form_state->setRebuild(true);
  }
  
  /**
   * Custom function.
   */
  public function newSubmissionHandlerTwo(array &$form, FormStateInterface $form_state) {
    // Do any other process for the button click without form values.
	$form_state->setRebuild(false);
  }
  
  public function sayHello(array &$form, FormStateInterface $form_state) : AjaxResponse {
	  
	  $form = [];
	  $header_table = array(
				array('data' => $this->t('SrNo'), 'field' => 'id', 'sort' => 'asc'),
				array('data' => $this->t('Name ajax'), 'field' => 'name', 'sort' => 'asc'),
				array('data' => $this->t('MobileNumber'), 'field' => 'mobilenumber', 'sort' => 'asc'),
				//'email'=>t('Email'),
				array('data' => $this->t('Age'), 'field' => 'age', 'sort' => 'asc'),
				'gender' => t('Gender'),
				//'website' => t('Web site'),
				'opt' => t('operations'),
				'opt1' => t('operations'),
			);
			$somedata = $form_state->getValue('input');
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
	
	$form['table'] = [
		  '#type' => 'table',
		  '#header' => $header_table,
		  '#rows' => $rows,
		  '#empty' => t('No users found'),
		  '#attributes' => [
				'id' => ['edit-output-table'],
		  ]
		];
		unset($form['pager']);
	  // Finally add the pager.
		$form['pager'] = array(
		  '#type' => 'pager'
		);
	  
	  //create a text field render array
  $elem = [
    '#type' => 'textfield',
    '#size' => '60',
    '#disabled' => TRUE,
    '#value' => 'Hello, ' . $form_state->getValue('input') . '!',
    '#attributes' => [
      'id' => ['edit-output'],
    ],
  ];

  $renderer = \Drupal::service('renderer');
  $response = new AjaxResponse();

  //issue a command that replaces the element #edit-output 
  //with the rendered markup of the field created above.
  $response->addCommand(new ReplaceCommand('#edit-output-table', $renderer->render($form)));

  //show a dialog box
  $dialogText['#markup'] = "Nice text ...";
  $dialogText['#attached']['library'][] = 'core/drupal.dialog.ajax';
  //$response->addCommand(new OpenModalDialogCommand("My title", $dialogText, ['width' => '300']));

  return $response;
}

}
