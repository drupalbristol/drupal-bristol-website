<?php

namespace Drupal\drupalbristol_organisers\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\drupalbristol_organisers\Entity\OrganiserInterface;

/**
 * Class OrganiserController.
 *
 *  Returns responses for Organiser routes.
 *
 * @package Drupal\drupalbristol_organisers\Controller
 */
class OrganiserController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Organiser  revision.
   *
   * @param int $organiser_revision
   *   The Organiser  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($organiser_revision) {
    $organiser = $this->entityManager()->getStorage('organiser')->loadRevision($organiser_revision);
    $view_builder = $this->entityManager()->getViewBuilder('organiser');

    return $view_builder->view($organiser);
  }

  /**
   * Page title callback for a Organiser  revision.
   *
   * @param int $organiser_revision
   *   The Organiser  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($organiser_revision) {
    $organiser = $this->entityManager()->getStorage('organiser')->loadRevision($organiser_revision);
    return $this->t('Revision of %title from %date', ['%title' => $organiser->label(), '%date' => format_date($organiser->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Organiser .
   *
   * @param \Drupal\drupalbristol_organisers\Entity\OrganiserInterface $organiser
   *   A Organiser  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(OrganiserInterface $organiser) {
    $account = $this->currentUser();
    $langcode = $organiser->language()->getId();
    $langname = $organiser->language()->getName();
    $languages = $organiser->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $organiser_storage = $this->entityManager()->getStorage('organiser');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $organiser->label()]) : $this->t('Revisions for %title', ['%title' => $organiser->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all organiser revisions") || $account->hasPermission('administer organiser entities')));
    $delete_permission = (($account->hasPermission("delete all organiser revisions") || $account->hasPermission('administer organiser entities')));

    $rows = [];

    $vids = $organiser_storage->revisionIds($organiser);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\drupalbristol_organisers\OrganiserInterface $revision */
      $revision = $organiser_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->revision_timestamp->value, 'short');
        if ($vid != $organiser->getRevisionId()) {
          $link = $this->l($date, new Url('entity.organiser.revision', ['organiser' => $organiser->id(), 'organiser_revision' => $vid]));
        }
        else {
          $link = $organiser->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->revision_log_message->value, '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('organiser.revision_revert_translation_confirm', [
                'organiser' => $organiser->id(),
                'organiser_revision' => $vid,
                'langcode' => $langcode,
              ]) :
              Url::fromRoute('organiser.revision_revert_confirm', ['organiser' => $organiser->id(), 'organiser_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('organiser.revision_delete_confirm', ['organiser' => $organiser->id(), 'organiser_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['organiser_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
