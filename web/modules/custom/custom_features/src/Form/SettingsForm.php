<?php

namespace Drupal\custom_features\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Custom features settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_features_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['custom_features.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_features.settings');
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $config->get('title'),
    ];

    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#default_value' => $this->config('custom_features.settings')->get('message'),
    ];

    $form['copy'] = array(
      '#type' => 'checkbox',
      '#title' => $this
        ->t('Send me a copy'),
      '#default_value' => $this->config('custom_features.settings')->get('copy'),
    );

    $form['settings']['active'] = [
      '#type' => 'radios',
      '#title' => $this
        ->t('Poll status'),
      '#default_value' => 1,
      '#options' => [
        0 => $this
          ->t('все хорошо'),
        1 => $this
          ->t('все плохо'),
      ],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if(mb_strlen($form_state->getValue('message')) <10) {
      $form_state->setErrorByName('message', $this->t('The value is not correct.'));
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('custom_features.settings')
      ->set('title', $form_state->getValue('title'))
      ->set('message', $form_state->getValue('message'))
      ->set('copy', $form_state->getValue('example'))
      ->set('settings', $form_state->getValue('settings'))
      ->set('active', $form_state->getValue('active'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
