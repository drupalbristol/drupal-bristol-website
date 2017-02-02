<?php

namespace Drupal\drupalbristol_organisers;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Organiser entity.
 *
 * @see \Drupal\drupalbristol_organisers\Entity\Organiser.
 */
class OrganiserAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\drupalbristol_organisers\Entity\OrganiserInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished organiser entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published organiser entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit organiser entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete organiser entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add organiser entities');
  }

}
