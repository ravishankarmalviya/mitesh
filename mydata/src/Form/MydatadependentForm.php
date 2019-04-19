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
 * Class MydataForm.
 *
 * @package Drupal\mydata\Form
 */
class MydatadependentForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mydata_formdependent';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['input_fields']['nid'] = array(
      '#type' => 'textfield',
      '#title' => t('Name of the referenced node'),
      '#autocomplete_route_name' => 'mydata.autocomplete',
      '#description' => t('Node Add/Edit type block'),
      '#default' => ($form_state->isValueEmpty('nid')) ? null : ($form_state->getValue('nid')),
      '#required' => true,
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Create'),
    );

    $form['test_contenair'] = array(
       '#type' => 'contenair',
       '#prefix' => '<div id="dropdown_second_replace">',
       '#suffix' => 'contenair',
    );
   $options = array(""=> "-select-","1"=> "england", "2" => "scotland");
   $selected = '';
   $form['test_contenair']['jm_country'] = array(
        '#type' => 'select',
        '#title' => 'Country',
        '#options' => $options,
        '#default_value' => $selected,
        '#ajax' => array(
          'event' => 'change',
          'callback' => '::ajax_example_dependent_dropdown_callback',
          'wrapper' => 'dropdown_second_replace',
        ),
    );

    $jurisdiction_options = array();

    if($form_state->getValue('jm_country')){
         switch ($form_state->getValue('jm_country')) {
                case 1:
                    $jurisdiction_options= array('1' => 'Test 1', '2' => 'Test 2');
                    break;

                case 2:
                    $jurisdiction_options= array('3' => 'Test 3', '4' => 'Test 4');
                    break;

                default:
                    break;
            }
    }


    $form['test_contenair']['jm_jurisdiction'] = array(
        '#type' => 'select',
        '#title' => 'Jurisdiction',
        '#options' => $jurisdiction_options,
      );


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

  function ajax_example_dependent_dropdown_callback(array $form, FormStateInterface $form_state) {
      return $form['test_contenair'];
  }

}
