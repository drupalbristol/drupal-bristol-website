<?php

/**
 * @file
 * Contains \Drupal\drupalbristol_sponsors\SponsorEntityInterface.
 */

namespace Drupal\drupalbristol_sponsors;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Sponsor entities.
 *
 * @ingroup drupalbristol_sponsors
 */
interface SponsorEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.
  /**
   * Gets the Sponsor type.
   *
   * @return string
   *   The Sponsor type.
   */
  public function getType();

  /**
   * Gets the Sponsor name.
   *
   * @return string
   *   Name of the Sponsor.
   */
  public function getName();

  /**
   * Sets the Sponsor name.
   *
   * @param string $name
   *   The Sponsor name.
   *
   * @return \Drupal\drupalbristol_sponsors\SponsorEntityInterface
   *   The called Sponsor entity.
   */
  public function setName($name);

  /**
   * Gets the Sponsor creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Sponsor.
   */
  public function getCreatedTime();

  /**
   * Sets the Sponsor creation timestamp.
   *
   * @param int $timestamp
   *   The Sponsor creation timestamp.
   *
   * @return \Drupal\drupalbristol_sponsors\SponsorEntityInterface
   *   The called Sponsor entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Sponsor published status indicator.
   *
   * Unpublished Sponsor are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Sponsor is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Sponsor.
   *
   * @param bool $published
   *   TRUE to set this Sponsor to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\drupalbristol_sponsors\SponsorEntityInterface
   *   The called Sponsor entity.
   */
  public function setPublished($published);

}
