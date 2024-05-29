<?php

declare(strict_types = 1);

namespace Drupal\collation_fixer\Form;

use Drupal\collation_fixer\CollationFixer;
use Drupal\collation_fixer\TableCollation;
use Drupal\Core\Database\DatabaseException;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Administrative form for fixing the collation of a single table.
 */
final class CollationFixerForm extends ConfirmFormBase {

  /**
   * Constructor.
   */
  public function __construct(
    private CollationFixer $collationFixer,
    private ?TableCollation $table = NULL,
  ) {}

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) : static {
    return new static(
      $container->get('collation_fixer.collation_fixer')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'collation_fixer_collation_fixer';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion(): TranslatableMarkup {
    if (!$this->table) {
      throw new \RuntimeException('Unable to determine table');
    }
    return $this->t('Fix table %table', ['%table' => $this->table->table]);
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    if (!$this->table) {
      throw new \RuntimeException('Unable to determine table');
    }
    return $this->t(
      'Do you want to fix collation of table %table by converting charset from %from_charset to %to_charset and collation from %from_collation to %to_collation?',
      [
        '%table' => $this->table->table,
        '%from_charset' => $this->table->currentCharset,
        '%from_collation' => $this->table->currentCollation,
        '%to_charset' => $this->table->expectedCharset,
        '%to_collation' => $this->table->expectedCollation,
      ]
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl(): Url {
    return new Url('system.status');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, string $table = '') {
    $tableCollations = $this->collationFixer->checkCollation($table);
    if (empty($tableCollations)) {
      throw new NotFoundHttpException();
    }
    $this->table = reset($tableCollations);
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    if (!$this->table) {
      throw new \RuntimeException('Unable to determine table');
    }
    try {
      $this->collationFixer->fixCollation($this->table->table);
      $this->messenger()->addStatus($this->t(
        'Fixed collation of table %table. Converted charset from %from_charset to %to_charset and collation from %from_collation to %to_collation.',
        [
          '%table' => $this->table->table,
          '%from_charset' => $this->table->currentCharset,
          '%from_collation' => $this->table->currentCollation,
          '%to_charset' => $this->table->expectedCharset,
          '%to_collation' => $this->table->expectedCollation,
        ]
      ));
    }
    catch (DatabaseException $e) {
      $this->messenger()->addError($this->t(
        'Unable to fix collation and charset for table %table: %message',
        ['%table' => $this->table, '%message' => $e->getMessage()]
      ));
    }
    $form_state->setRedirectUrl(new Url('system.status'));
  }

}
