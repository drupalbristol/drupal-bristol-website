<?php

/**
 * @file
 * Contains \Drupal\drupalbristol_sponsors\Form\SponsorEntityForm.
 */

namespace Drupal\drupalbristol_sponsors\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Sponsor edit forms.
 *
 * @ingroup drupalbristol_sponsors
 */
class SponsorEntityForm extends ContentEntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\drupalbristol_sponsors\Entity\SponsorEntity */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Sponsor.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Sponsor.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.sponsor.canonical', ['sponsor' => $entity->id()]);
  }

}
