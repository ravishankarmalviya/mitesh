<?php

namespace Drupal\mydata\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class MydatafiltersForm.
 *
 * @package Drupal\mydata\Form
 */
class MydatafiltersForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mydata_formfilters';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

	$form['filters'] = array(
    '#type' => 'fieldset',
    '#title' => t('Filters'),
  );
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

}
