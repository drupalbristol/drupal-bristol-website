<?php

/**
 * @file
 * Contains organiser.page.inc.
 *
 * Page callback for Organiser entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Organiser templates.
 *
 * Default template: organiser.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_organiser(array &$variables) {
  // Fetch Organiser Entity Object.
  $organiser = $variables['elements']['#organiser'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
