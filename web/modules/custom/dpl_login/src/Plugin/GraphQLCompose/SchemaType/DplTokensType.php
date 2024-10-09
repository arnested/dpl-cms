<?php

declare(strict_types=1);

namespace Drupal\dpl_login\Plugin\GraphQLCompose\SchemaType;

use Drupal\graphql\GraphQL\ResolverBuilder;
use Drupal\graphql_compose\Plugin\GraphQLCompose\GraphQLComposeSchemaTypeBase;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * {@inheritdoc}
 *
 * @GraphQLComposeSchemaType(
 *   id = "DplTokens",
 * )
 */
class DplTokensType extends GraphQLComposeSchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public function getTypes(): array {
    $types = [];

    $types[] = new ObjectType([
      'name' => $this->getPluginId(),
      'description' => (string) $this->t('Mikkel tester for sindsygt.'),
      'fields' => fn () => [
        'adgangsplatformen' => ['type' => Type::nonNull(static::type('AdgangsplatformenTokens'))],
        'unilogin' => ['type' => static::type('UniloginTokens')],
      ],
    ]);

    return $types;
  }

  /**
   * {@inheritdoc}
   */
  public function getExtensions(): array {
    $extensions = parent::getExtensions();

    $extensions[] = new ObjectType([
      'name' => 'Query',
      'fields' => fn () => [
        'dplTokens' => [
          'type' => Type::nonNull(static::type($this->getPluginId())),
          'description' => (string) $this->t('Mik information.'),
        ],
      ],
    ]);

    return $extensions;
  }

}
