<?php

namespace Drupal\mydata\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'MydatatextBlock' block.
 *
 * @Block(
 *  id = "mydatatext_block",
 *  admin_label = @Translation("Mydata Text block"),
 * )
 */
class MydatatextBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    ////$build = [];
    //$build['mydata_block']['#markup'] = 'Implement MydataBlock.';

    //$form = \Drupal::formBuilder()->getForm('Drupal\mydata\Form\MydataForm');

    //return $form;
	
		return [
		  '#markup' => $this->t('This is a simple block!'),
		];
  }
  
	  /**
	   * {@inheritdoc}
	   */
	  protected function blockAccess(AccountInterface $account) {
		return AccessResult::allowedIfHasPermission($account, 'access content');
	  }

	  /**
	   * {@inheritdoc}
	   */
	  public function blockForm($form, FormStateInterface $form_state) {
		$config = $this->getConfiguration();

		return $form;
	  }

	  /**
	   * {@inheritdoc}
	   */
	  public function blockSubmit($form, FormStateInterface $form_state) {
		$this->configuration['my_block_settings'] = $form_state->getValue('my_block_settings');
	  }

}
