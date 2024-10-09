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
 *   id = "UniloginTokens",
 * )
 */
class UniloginTokensType extends GraphQLComposeSchemaTypeBase {

  /**
   * {@inheritdoc}
   */
  public function getTypes(): array {
    $types = [];

    $types[] = new ObjectType([
      'name' => $this->getPluginId(),
      'description' => (string) $this->t('Mikkel, også her, tester for sindsygt.'),
      'fields' => fn () => [
        'access_token' => ['type' => Type::nonNull(Type::string())],
        'id_token' => ['type' => Type::nonNull(Type::string())],
        'refresh_token' => ['type' => Type::nonNull(Type::string())],
        'expires_in' => ['type' => Type::nonNull(Type::int())],
      ],
    ]);

    return $types;
  }

}
