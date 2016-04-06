<?php

namespace Drupal\drupalbristol_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Source plugin for speakers.
 *
 * @MigrateSource(id="venue_term")
 */
class VenueTerm extends SqlBase {

  /**
   * @{@inheritdoc}
   */
  public function query() {
    return $this->select('venues', 'v')
      ->fields('v', ['id', 'name', 'website']);
  }

  /**
   * @{@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'v',
      ],
    ];
  }

  /**
   * @{@inheritdoc}
   */
  public function fields() {
    return [
      'id' => $this->t('ID of the venue'),
      'name' => $this->t('Name of the venue'),
    ];
  }

}
