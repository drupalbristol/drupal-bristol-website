<?php

namespace Drupal\drupalbristol_organisers;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Organiser entities.
 *
 * @ingroup drupalbristol_organisers
 */
class OrganiserListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Organiser ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\drupalbristol_organisers\Entity\Organiser */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.organiser.edit_form', array(
          'organiser' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}