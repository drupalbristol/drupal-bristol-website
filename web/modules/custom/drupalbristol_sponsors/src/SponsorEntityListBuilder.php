<?php

/**
 * @file
 * Contains \Drupal\drupalbristol_sponsors\SponsorEntityListBuilder.
 */

namespace Drupal\drupalbristol_sponsors;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Sponsor entities.
 *
 * @ingroup drupalbristol_sponsors
 */
class SponsorEntityListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Sponsor ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\drupalbristol_sponsors\Entity\SponsorEntity */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.sponsor.edit_form', array(
          'sponsor' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
