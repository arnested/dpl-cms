<?php

declare(strict_types=1);

namespace Drupal\dpl_login\Plugin\GraphQLCompose\SchemaType;

use Drupal\graphql_compose\Plugin\GraphQLCompose\GraphQLComposeSchemaTypeBase;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * {@inheritdoc}
 *
 * @GraphQLComposeSchemaType(
 *   id = "AdgangsplatformenTokens",
 * )
 */
class AdgangsplatformenTokensType extends GraphQLComposeSchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public function getTypes(): array {
    $types = [];

    $types[] = new ObjectType([
      'name' => $this->getPluginId(),
      'description' => (string) $this->t('Mikkel tester for sindsygt.'),
      'fields' => fn () => [
        'library' => ['type' => Type::nonNull(Type::string())],
        'user' => ['type' => Type::string()],
      ],
    ]);

    return $types;
  }

}
