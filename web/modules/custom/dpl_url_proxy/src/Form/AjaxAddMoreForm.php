<?php

namespace Drupal\dpl_url_proxy\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Class AjaxAddMoreForm.
 *
 * @package Drupal\dpl_url_proxy\Form
 */
class AjaxAddMoreForm extends ConfigFormBase {
  use StringTranslationTrait;
  use MessengerTrait;

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'dpl_url_proxy.settings',
    ];
  }

  /**
   * Form with 'add more' and 'remove' buttons.
   *
   * This example shows a button to "add more" - add another textfield, and
   * the corresponding "remove" button.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $settings = $this->config('dpl_url_proxy.settings');
    var_dump($settings->get('values'));

    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('This example shows an add-more and a remove-last button.'),
    ];

    // Gather the number of names in the form already.
    $num_names = $form_state->get('num_names');

    // We have to ensure that there is at least one name field.
    if ($num_names === NULL) {
      $num_names = [1];
    }

    $form['#tree'] = TRUE;
    $form['names_fieldset'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Hostnames'),
      '#prefix' => '<div id="names-fieldset-wrapper">',
      '#suffix' => '</div>',
    ];

    foreach($num_names as $value) {
      $form['names_fieldset'][$value] = [
        '#type' => 'fieldset',
        '#title' => $this->t('Hostname'),
      ];
      $form['names_fieldset'][$value]['name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Name'),
      ];
      $form['names_fieldset'][$value]['shoe_size'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Shoe size'),
      ];
      $form['names_fieldset'][$value]['remove_this'] = [
        '#name' => $value,
        '#type' => 'submit',
        '#value' => $this->t('Remove this'),
        '#submit' => ['::removeOne'],
        '#ajax' => [
          'callback' => '::addmoreCallback',
          'wrapper' => 'names-fieldset-wrapper',
        ],
      ];
    }

    $form['names_fieldset']['actions'] = [
      '#type' => 'actions',
    ];
    $form['names_fieldset']['actions']['add_name'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add one more'),
      '#submit' => ['::addOne'],
      '#ajax' => [
        'callback' => '::addmoreCallback',
        'wrapper' => 'names-fieldset-wrapper',
      ],
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'form_api_example_ajax_addmore';
  }

  /**
   * Callback for both ajax-enabled buttons.
   *
   * Selects and returns the fieldset with the names in it.
   */
  public function addmoreCallback(array &$form, FormStateInterface $form_state) {
    return $form['names_fieldset'];
  }

  /**
   * Submit handler for the "add-one-more" button.
   *
   * Increments the max counter and causes a rebuild.
   */
  public function addOne(array &$form, FormStateInterface $form_state) {
    $num_names = $form_state->get('num_names');
    if ($num_names === NULL) {
      $num_names = [1];
    }
    // var_dump($num_names); die;
    $last = end($num_names);
    $num_names[] = $last + 1;
    $form_state->set('num_names', $num_names);
    $form_state->setRebuild();
  }


  public function removeOne(array &$form, FormStateInterface $form_state) {
    $remove_value = $form_state->getTriggeringElement()['#name'];
    $key = array_search($remove_value, $form_state->get('num_names'));
    if ($key !== false) {
      unset($form_state->get('num_names')[$key]);
    }
    $form_state->setRebuild();
  }

  /**
   * Final submit handler.
   *
   * Reports what values were finally set.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = array_reduce($form_state->getValue(['names_fieldset']), function($carry, $item) {
      if(!empty($item['name'])) {
        unset($item['remove_this']);
        $carry[] = $item;
      }
      return $carry;
    }, []);

    $output = json_encode($values, JSON_PRETTY_PRINT);
    $this->messenger()->addMessage($output);

    $this->config('dpl_url_proxy.settings')
      ->set('values', $values)
      ->save();

    parent::submitForm($form, $form_state);
  }
}
