<?php

namespace Drupal\drupalbristol_organisers;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface OrganiserStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Organiser revision IDs for a specific Organiser.
   *
   * @param \Drupal\drupalbristol_organisers\Entity\OrganiserInterface $entity
   *   The Organiser entity.
   *
   * @return int[]
   *   Organiser revision IDs (in ascending order).
   */
  public function revisionIds(OrganiserInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Organiser author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Organiser revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\drupalbristol_organisers\Entity\OrganiserInterface $entity
   *   The Organiser entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(OrganiserInterface $entity);

  /**
   * Unsets the language for all Organiser with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
