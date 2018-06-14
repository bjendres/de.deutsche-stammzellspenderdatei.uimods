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
   * @param $formName
   * @param $form
   */
  public static function buildForm($formName, &$form) {
    $script = file_get_contents(__DIR__ . '/../../js/activity.js');
    CRM_Core_Region::instance('page-body')->add(array(
      'script' => $script,
    ));
  }

}
