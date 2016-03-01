<?php

namespace Drupal\drupalbristol_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for talks.
 *
 * @MigrateSource(id="talk_node")
 */
class TalkNode extends SqlBase {

  /**
   * @{@inheritdoc}
   */
  public function query() {
    return $this->select('talks', 't')
      ->fields('t', ['id', 'title', 'event_id', 'speaker_ids', 'abstract', 'slides_link', 'slides_embed']);
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 't',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }

    $speakerIds = $row->getSourceProperty('speaker_ids');
    $row->setSourceProperty('speaker_ids', explode(',', $speakerIds));
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    return [
      'id' => $this->t('ID of the speaker.'),
      'title' => $this->t('The title of the talk.'),
      'event_id' => $this->t('The ID of the event that the talk was given at.'),
      'speaker_ids' => $this->t('A string of comma-separated speaker IDs.'),
      'abstract' => $this->t('The abstract for the talk.'),
      'slides_link' => $this->t('A link to the slides.'),
      'slides_embed' => $this->t('Embed code for the slides.'),
    ];
  }

}
