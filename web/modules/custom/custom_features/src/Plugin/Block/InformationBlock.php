<?php

namespace Drupal\custom_features\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Provides an information block.
 *
 * @Block(
 *   id = "custom_features_information",
 *   admin_label = @Translation("Information"),
 *   category = @Translation("Custom")
 * )
 */
class InformationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\Core\Session\AccountProxy
   */
  protected $currentUser;

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;


  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->currentUser = $container->get('current_user');
    $instance->entityTypeManager = $container->get('entity_type.manager');

    return $instance;
  }

//  /**
//   * Provides a 'Node Type' condition.
//   *
//   * @Condition(
//   *   id = "node_type",
//   *   label = @Translation("User Bundle"),
//   *   context_definitions = {
//   *     "node" = @ContextDefinition("entity:user", label = @Translation("User"))
//   *   }
//   * )
//   *
//   */

  /**
   * {@inheritdoc}
   */
  public function build() {
    if(!$this->currentUser->isAuthenticated()) {
      $build['content'] = [
        '#markup' => $this->currentUser->getAccountName(),
      ];
      return $build;
    }
    $account=$this->currentUser;
    $id=$account->id();
    $storage = $this->entityTypeManager->getStorage('user');
    /** @var \Drupal\user\UserInterface $user */
    $user = $storage->load($this->currentUser->id());

    $viewBuilder=$this->entityTypeManager->getViewBuilder('user');
    $build['content'] = $viewBuilder->view($user,'card');
//    $node = $this->getContextValue('user');
  return $build;
  }
  /**
   * {@inheritdoc}
   */
  public function getCacheContexts() {
    return['user.roles'];
  }
}
