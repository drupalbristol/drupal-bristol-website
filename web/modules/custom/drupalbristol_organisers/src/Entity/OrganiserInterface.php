<?php

namespace Drupal\drupalbristol_organisers\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Organiser entities.
 *
 * @ingroup drupalbristol_organisers
 */
interface OrganiserInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Organiser name.
   *
   * @return string
   *   Name of the Organiser.
   */
  public function getName();

  /**
   * Sets the Organiser name.
   *
   * @param string $name
   *   The Organiser name.
   *
   * @return \Drupal\drupalbristol_organisers\Entity\OrganiserInterface
   *   The called Organiser entity.
   */
  public function setName($name);

  /**
   * Gets the Organiser creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Organiser.
   */
  public function getCreatedTime();

  /**
   * Sets the Organiser creation timestamp.
   *
   * @param int $timestamp
   *   The Organiser creation timestamp.
   *
   * @return \Drupal\drupalbristol_organisers\Entity\OrganiserInterface
   *   The called Organiser entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Organiser published status indicator.
   *
   * Unpublished Organiser are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Organiser is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Organiser.
   *
   * @param bool $published
   *   TRUE to set this Organiser to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\drupalbristol_organisers\Entity\OrganiserInterface
   *   The called Organiser entity.
   */
  public function setPublished($published);

  /**
   * Gets the Organiser revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Organiser revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\drupalbristol_organisers\Entity\OrganiserInterface
   *   The called Organiser entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Organiser revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Organiser revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\drupalbristol_organisers\Entity\OrganiserInterface
   *   The called Organiser entity.
   */
  public function setRevisionUserId($uid);

}
