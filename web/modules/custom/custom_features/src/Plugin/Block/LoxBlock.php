<?php

namespace Drupal\custom_features\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a lox block.
 *
 * @Block(
 *   id = "custom_features_lox",
 *   admin_label = @Translation("Lox"),
 *   category = @Translation("User"),
 *   context_definitions = {
 *     "user"= @ContextDefinition("entity:user", label = @Translation("user"))
 *   }
 * )
 */
class LoxBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $user = $this->getContextValue('user');

    $build['content'] = [
      '#markup' => $this->t('kklk'),
    ];

    return $build;
  }
}


