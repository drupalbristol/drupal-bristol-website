<?php

namespace Drupal\drupalbristol_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Source plugin for speakers.
 *
 * @MigrateSource(id="speaker_node")
 */
class SpeakerNode extends SqlBase {

  /**
   * @{@inheritdoc}
   */
  public function query() {
    return $this->select('speakers', 's')
      ->fields('s', ['id', 'name', 'bio', 'twitter', 'drupalorg', 'website']);
  }

  /**
   * @{@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 's',
      ],
    ];
  }

  /**
   * @{@inheritdoc}
   */
  public function fields() {
    return [
      'id' => $this->t('ID of the speaker'),
      'name' => $this->t('Name of the speaker'),
      'bio' => $this->t('The tagline for the speaker.'),
      'twitter' => $this->t('The speaker\'s Twitter username.'),
      'drupalorg_url' => $this->t('The speaker\'s account on Drupal.org.'),
    ];
  }

}
