<?php

/**
 * @file
 * Contains \Drupal\wunderhub_client_blog\Form\WunderHubBlogConfigForm.
 */

namespace Drupal\wunderhub_client_blog\Form;

use Drupal\wunderhub_client\Form\WunderHubConfigForm;
use Drupal\Core\Form\FormStateInterface;

class WunderHubBlogConfigForm extends WunderHubConfigForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
//    $config = \Drupal::configFactory()->get('wunderhub_client.settings');
    dpm($form);
  }
}