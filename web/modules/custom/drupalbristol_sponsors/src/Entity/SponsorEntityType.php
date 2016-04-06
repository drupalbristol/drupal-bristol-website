<?php

/**
 * @file
 * Contains \Drupal\drupalbristol_sponsors\Entity\SponsorEntityType.
 */

namespace Drupal\drupalbristol_sponsors\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\drupalbristol_sponsors\SponsorEntityTypeInterface;

/**
 * Defines the Sponsor type entity.
 *
 * @ConfigEntityType(
 *   id = "sponsor_type",
 *   label = @Translation("Sponsor type"),
 *   handlers = {
 *     "list_builder" = "Drupal\drupalbristol_sponsors\SponsorEntityTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\drupalbristol_sponsors\Form\SponsorEntityTypeForm",
 *       "edit" = "Drupal\drupalbristol_sponsors\Form\SponsorEntityTypeForm",
 *       "delete" = "Drupal\drupalbristol_sponsors\Form\SponsorEntityTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\drupalbristol_sponsors\SponsorEntityTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "sponsor_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "sponsor",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/sponsor_type/{sponsor_type}",
 *     "add-form" = "/admin/structure/sponsor_type/add",
 *     "edit-form" = "/admin/structure/sponsor_type/{sponsor_type}/edit",
 *     "delete-form" = "/admin/structure/sponsor_type/{sponsor_type}/delete",
 *     "collection" = "/admin/structure/sponsor_type"
 *   }
 * )
 */
class SponsorEntityType extends ConfigEntityBundleBase implements SponsorEntityTypeInterface {
  /**
   * The Sponsor type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Sponsor type label.
   *
   * @var string
   */
  protected $label;

}
