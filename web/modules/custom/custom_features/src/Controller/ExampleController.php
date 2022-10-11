<?php

namespace Drupal\custom_features\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * An example controller.
 */
class ExampleController extends ControllerBase {

  protected $myservice;

  public static function create(ContainerInterface $container) {
    $instance = new static();
    $instance->myservice = $container->get('custom_features.get_lox');
    return $instance;
  }


  /**
   * Returns a render-able array for a test page.
   */
  public function content() {
    $count = $this->myservice->getLox();
    $build['content'] = [
      '#markup' => $this->t('Summary @value', ['@value' => $count]),
    ];
    return $build;
  }

}
