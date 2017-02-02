<?php

namespace Drupal\drupalbristol_organisers\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Organiser entities.
 */
class OrganiserViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
