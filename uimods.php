<?php

require_once 'uimods.civix.php';
use CRM_Uimods_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function uimods_civicrm_config(&$config) {
  _uimods_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function uimods_civicrm_xmlMenu(&$files) {
  _uimods_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function uimods_civicrm_install() {
  _uimods_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function uimods_civicrm_postInstall() {
  _uimods_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function uimods_civicrm_uninstall() {
  _uimods_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function uimods_civicrm_enable() {
  _uimods_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function uimods_civicrm_disable() {
  _uimods_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function uimods_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _uimods_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function uimods_civicrm_managed(&$entities) {
  _uimods_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function uimods_civicrm_caseTypes(&$caseTypes) {
  _uimods_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function uimods_civicrm_angularModules(&$angularModules) {
  _uimods_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function uimods_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _uimods_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function uimods_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function uimods_civicrm_navigationMenu(&$menu) {
  _uimods_civix_insert_navigation_menu($menu, NULL, array(
    'label' => E::ts('The Page'),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _uimods_civix_navigationMenu($menu);
} // */

/**
 * Implements hook_civicrm_buildForm().
 *
 * @param string $formName
 * @param CRM_Core_Form $form
 */
function uimods_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Activity_Form_Activity') {
    /* @var \CRM_Activity_Form_Activity $form */
    CRM_Uimods_Activity::buildForm($formName, $form);
  }
}

/**
 * @param $formName
 * @param CRM_Profile_Form $form
 */
function uimods_civicrm_preProcess($formName, &$form) {
  if (
    $formName == 'CRM_Activity_Form_Activity'
    || $formName == 'CRM_Activity_Form_Search'
  ) {
    /* @var \CRM_Activity_Form_Activity $form */
    CRM_Uimods_Activity::preProcess($formName, $form);
  }
}

/**
 * Implements hook_civicrm_pageRun().
 *
 * @param CRM_Core_Page $page
 */
function uimods_civicrm_pageRun(&$page) {
  $pageName = $page->getVar('_name');

//  if ($pageName == 'CRM_Contact_Page_View_Summary') {
//    CRM_Uimods_Contact::pageRun($page);
//  }
//
//  if ($pageName == 'CRM_Contact_Page_View_Note') {
//    $extensionSettings = array(
//      'ts' => array(
//        'noteSubject' => ts('Subject'),
//      ),
//    );
//    $script = 'CRM.uimods = CRM.uimods || ' . json_encode($extensionSettings);
//    CRM_Core_Region::instance('page-header')->add(array(
//      'script' => $script,
//    ));
//  }
}

/**
 * Implements hook_civicrm_searchColumns().
 *
 * @param $objectName
 * @param $headers
 * @param $rows
 * @param \CRM_Core_Selector_Controller $selector
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_searchColumns
 */
function uimods_civicrm_searchColumns($objectName, &$headers, &$rows, &$selector) {
  if ($objectName == 'activity') {
    $actions = array_pop($headers);
    unset($headers[2]);
    $headers[] = array(
      'name' => 'DSD-Betreuer',
      'field_name' => 'dsd_betreuer',
    );
    $headers[] = array(
      'name' => 'Standort',
      'field_name' => 'standort',
    );
    $headers[] = $actions + array('field_name' => 'action');

    // set the values for 'Balance Due' column
    foreach ($rows as $key => $row) {
      $activity = civicrm_api3('Activity', 'getsingle', array(
        'id' => $row['activity_id'],
        'return' => array(
          'custom_5',
          'location',
        )
      ));

      $rows[$key]['dsd_betreuer'] = isset($activity['custom_5']) ? $activity['custom_5'] : NULL;
      $rows[$key]['standort'] = isset($activity['location']) ? $activity['location'] : NULL;
    }
  }
}

/**
 * The extra search column (see above) does not alter the template,
 * so we inject javascript into the template-content.
 */
function uimods_civicrm_alterContent(&$content, $context, $tplName, &$object) {
  // get page- resp. form-class of the object
  $class_name = get_class($object);
  if ($class_name == 'CRM_Activity_Form_Search') {
    // parse the template with smarty
    $smarty = CRM_Core_Smarty::singleton();
    $path = E::path('/templates/CRM/Activity/SearchColumns.tpl');
    $html = $smarty->fetch($path);
    // append the html to the content
    $content .= $html;
  }
}
