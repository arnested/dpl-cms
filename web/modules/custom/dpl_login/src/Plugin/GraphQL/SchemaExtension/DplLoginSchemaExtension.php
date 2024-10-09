<?php

namespace Drupal\dpl_login\Plugin\GraphQL\SchemaExtension;

use Drupal;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\graphql\GraphQL\ResolverBuilder;
use Drupal\graphql\GraphQL\ResolverRegistryInterface;
use Drupal\graphql_compose\Plugin\GraphQL\SchemaExtension\ResolverOnlySchemaExtensionPluginBase;

/**
 * @SchemaExtension(
 *   id = "mik",
 *   name = "Mik",
 *   description = @Translation("Misc schema extensions for GraphQL Compose."),
 *   schema = "graphql_compose",
 * )
 */
class DplLoginSchemaExtension extends ResolverOnlySchemaExtensionPluginBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function registerResolvers(ResolverRegistryInterface $registry) {

    $builder = new ResolverBuilder();

    // TODO: This is a hack. We should not be using the service container directly.
    $library_token_handler = Drupal::service('dpl_library_token.handler');
    $user_token_handler = Drupal::service('dpl_login.user_tokens');
    $user_token = $user_token_handler->getCurrent();

    $registry->addFieldResolver(
      type: 'Query',
      field: 'dplTokens',
      resolver: $builder->callback(fn() => [
        'adgangsplatformen' => [
          'library' => $library_token_handler->getToken(),
          'user' => $user_token ? $user_token->token : NULL,
        ],
        'unilogin' => [
          'access_token' => 'heps access_token',
          'id_token' => 'heps id_token',
          'refresh_token' => 'heps refresh_token',
          'expires_in' => 3600,
        ],
      ])
    );
  }

}
