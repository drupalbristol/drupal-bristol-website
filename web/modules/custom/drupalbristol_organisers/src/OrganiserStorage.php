<?php

namespace Drupal\drupalbristol_organisers;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\drupalbristol_organisers\Entity\OrganiserInterface;

/**
 * Defines the storage handler class for Organiser entities.
 *
 * This extends the base storage class, adding required special handling for
 * Organiser entities.
 *
 * @ingroup drupalbristol_organisers
 */
class OrganiserStorage extends SqlContentEntityStorage implements OrganiserStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(OrganiserInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {organiser_revision} WHERE id=:id ORDER BY vid',
      array(':id' => $entity->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {organiser_field_revision} WHERE uid = :uid ORDER BY vid',
      array(':uid' => $account->id())
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(OrganiserInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {organiser_field_revision} WHERE id = :id AND default_langcode = 1', array(':id' => $entity->id()))
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('organiser_revision')
      ->fields(array('langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED))
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
