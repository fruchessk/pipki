<?php

namespace Drupal\custom_features;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;

/**
* class RandomMessageGenerator
*
* @package Drupal\custom_features
*/
class MyService {

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * @param EntityTypeManagerInterface $entityTypeManager
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * Gets count.
   *
   * @return float
   */
  public function getLox() {
    $count = 0;
    /**
     * @var ContentEntityStorageInterface $storage
     */
    $storage = $this->entityTypeManager->getStorage('node');

    $query = $storage->getQuery()
      ->condition('status', TRUE)
      ->condition('type', 'products');
    $idsOfEntities = $query->execute(); // array of ids
    /** @var NodeInterface[] $entities */
    $entities = $storage->loadMultiple($idsOfEntities);

    foreach ($entities as $product) {
      $price = $product->get('field_kolichestvo')->value;
      $count = $product->get('field_cena')->value;
      $count += $price * $count;
    }
    return $count;
  }

}
