<?php

namespace Drupal\drupalbristol_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for events.
 *
 * @MigrateSource(id="event_node")
 */
class EventNode extends SqlBase {

  /**
   * @{@inheritdoc}
   */
  public function query() {
    return $this->select('events', 'e')
      ->fields('e', ['id', 'name', 'date', 'link', 'venue_id']);
  }

  /**
   * @{@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'e',
      ],
    ];
  }

  /**
   * @{@inheritdoc}
   */
  public function fields() {
    return [
      'id' => $this->t('ID of the event'),
      'name' => $this->t('Name of the event'),
      'date' => $this->t('The date of the event'),
      'link' => $this->t('A link to the event page'),
      'venue_id' => $this->t('The ID of the venue'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }

    $date = $row->getSourceProperty('date');
    $row->setSourceProperty('date', date('Y-m-d', $date));
  }

}
