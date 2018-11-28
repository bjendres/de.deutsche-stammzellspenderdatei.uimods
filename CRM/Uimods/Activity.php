<?php
/*-------------------------------------------------------+
| DSD UI modifications                                   |
| Copyright (C) 2017 SYSTOPIA                            |
| Author: J. Schuppe (schuppe@systopia.de)               |
| http://www.systopia.de/                                |
+--------------------------------------------------------+
| This program is released as free software under the    |
| Affero GPL license. You can redistribute it and/or     |
| modify it under the terms of this license which you    |
| can read by viewing the included agpl.txt or online    |
| at www.gnu.org/licenses/agpl.html. Removal of this     |
| copyright header is strictly prohibited without        |
| written permission from the original author(s).        |
+--------------------------------------------------------*/

use CRM_Uimods_ExtensionUtil as E;

  /**
 * Class CRM_Uimods_Activity
 */
class CRM_Uimods_Activity {

  /**
   * Perform actions on hook_civicrm_pageRun().
   *
   * @param $page
   */
  public static function pageRun(&$page) {

  }

  /**
   * Perform actions on hook_civicrm_buildForm().
   *
   * @param string $formName
   * @param CRM_Activity_Form_Activity $form
   */
  public static function buildForm($formName, &$form) {
    $script = file_get_contents(__DIR__ . '/../../js/activity.js');
    CRM_Core_Region::instance('page-body')->add(array(
      'script' => $script,
    ));

    try {
      $custom_group_result = civicrm_api3('CustomGroup', 'getsingle', array(
        'name' => 'zusatzinformationen_aktivitaeten_tage',
      ));
      CRM_Core_Resources::singleton()->addVars('uimods', array('activityDaysGroupId' => $custom_group_result['id']));
    }
    catch (CiviCRM_API3_Exception $exception) {
      // CustomGroup seems to not exist.
    }

    $location_field = $form->getElement('location');
    $location_field->setLabel($location_field->getLabel() . ', Adresse der Aktivität');

    $date_field = $form->getElement('activity_date_time');
    $date_field->setLabel($date_field->getLabel() . ', Beginn der Aktivität');
  }

  /**
   * Perform actions on hook_civicrm_preProcess().
   *
   * @param string $formName
   * @param CRM_Activity_Form_Activity $form
   */
  public static function preProcess($formName, &$form) {
    // Make the subject field a select list with pre-defined options.
    // Keys must be the same as values to not break displaying of activity
    // subjects, thus, values may only contain characters valid for array keys.
    $subject_options = array(
      'öffentlich - mit DSD-Beteiligung' => 'öffentlich - mit DSD-Beteiligung',
      'nicht öffentlich - mit DSD Beteiligung' => 'nicht öffentlich - mit DSD Beteiligung',
      'öffentlich - ohne DSD-Beteiligung' => 'öffentlich - ohne DSD-Beteiligung',
      'nicht öffentlich - ohne DSD-Beteiligung' => 'nicht öffentlich - ohne DSD-Beteiligung',
    );
    $form->_fields['subject'] = array(
      'type' => 'select',
      'label' => 'Öffentlich/ DSD-Beteiligung',
      'attributes' => array('' => '- ' . ts('select subject') . ' -') + $subject_options,
      'extra' => array('class' => 'crm-select2'),
      'required' => TRUE,
    );
  }

}
