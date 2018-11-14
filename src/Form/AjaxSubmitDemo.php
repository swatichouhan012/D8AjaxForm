<?php

namespace Drupal\ajax_form_submit\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Implementing a ajax form.
 */
class AjaxSubmitDemo extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ajax_submit_demo';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="result_message"></div>',
    ];

    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Number 1'),
    ];

    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Number 2'),
    ];

    $form['actions'] = [
      '#type' => 'button',
      '#value' => $this->t('Submit'),
      '#ajax' => [
        'callback' => '::setMessage',
      ],
    ];

    return $form;
  }

  /**
   * Setting the message in our form.
   */
  public function setMessage(array $form, FormStateInterface $form_state) {
foreach ($form_state as $value) {
	echo $value;
}  

  $response = new AjaxResponse();
    $response->addCommand(
      new HtmlCommand(
        '.result_message',
'<div class="my_top_message">' . t('Your First Name is @result <br> Your Last Name is @result1', ['@result' => ($form_state->getValue('first_name') ),'@result1' => ($form_state->getValue('last_name') )]) . '</div>'
      )
    );
    return $response;
  }

  /**
   * Submitting the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
