<?php

/**
 * @file
 * Contains \Drupal\wunderhub_client\Form\WunderHubConfigForm.
 */

namespace Drupal\wunderhub_client\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

/**
 * Provides the WunderHub client configuration form.
 */
class WunderHubConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'wunderhub_client_config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = \Drupal::config('wunderhub_client.settings');

    $form['endpoints'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Endpoints'),
    ];

    $form['endpoints']['team_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Team URL'),
      '#description' => $this->t('Enter URL to team endpoint.'),
      '#default_value' => $config->get('team_url'),
    ];

    $form['endpoints']['team_member_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Single team member URL'),
      '#description' => $this->t('Enter URL to single team member endpoint. Note that <code>/[id]</code> is appended automatically.'),
      '#default_value' => $config->get('team_member_url'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::config('wunderhub_client.settings');

    foreach (Element::children($form['endpoints']) as $key) {
      $config->set($key, $form_state->getValue($key));
    }

    $config->save();

    drupal_set_message($this->t('The configuration options have been saved.'));
  }
}
