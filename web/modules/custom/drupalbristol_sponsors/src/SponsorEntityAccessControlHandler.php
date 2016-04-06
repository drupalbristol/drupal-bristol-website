<?php

/**
 * @file
 * Contains \Drupal\drupalbristol_sponsors\SponsorEntityAccessControlHandler.
 */

namespace Drupal\drupalbristol_sponsors;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Sponsor entity.
 *
 * @see \Drupal\drupalbristol_sponsors\Entity\SponsorEntity.
 */
class SponsorEntityAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\drupalbristol_sponsors\SponsorEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished sponsor entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published sponsor entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit sponsor entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete sponsor entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add sponsor entities');
  }

}
