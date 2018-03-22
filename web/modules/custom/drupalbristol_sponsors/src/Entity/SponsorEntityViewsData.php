<?php

namespace Drupal\drupalbristol_sponsors\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Sponsor entities.
 */
class SponsorEntityViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['sponsor']['table']['base'] = [
      'field' => 'id',
      'title' => $this->t('Sponsor'),
      'help' => $this->t('The Sponsor ID.'),
    ];

    return $data;
  }

}
