<?php

namespace Drupal\custom_features\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a kipka block.
 *
 * @Block(
 *   id = "custom_features_kipka",
 *   admin_label = @Translation("Kipka"),
 *   category = @Translation("Custom")
 * )
 */
class KipkaBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' =>date('Y-m-d H:i:s'),
    ];
    return $build;
  }

}
