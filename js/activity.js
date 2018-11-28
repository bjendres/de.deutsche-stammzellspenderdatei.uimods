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

(function ($) {
  /**
   * Change element type of all elements in the current set.
   *
   * @link https://gist.github.com/etienned/2934516
   *
   * @param newType
   */
  $.fn.changeElementType = function(newType) {
    var newSet = $();

    this.each(function() {
      var attrs = {};

      $.each(this.attributes, function(idx, attr) {
        attrs[attr.nodeName] = attr.nodeValue;
      });

      var newElement = $("<" + newType + "/>", attrs).append($(this).contents());

      $(this).replaceWith(newElement);
      newSet = newSet.add(newElement);
    });

    return newSet;
  };


  $(document).on('crmLoad', function () {
    var $activityForm = $('form.CRM_Activity_Form_Activity');
    var $detailsBlock = $('.crm-activity-form-block-details', $activityForm);
    var $additionalInformationDaysAnchor = $('#custom_group_' + CRM.vars.uimods.activityDaysGroupId + '_1');
    var $additionalInformationDaysBlock = $additionalInformationDaysAnchor.prev('.custom-group');

    // Move additional information block before details block and format it as a
    // table.
    if ($detailsBlock.length && $additionalInformationDaysBlock.length) {
      var $existing = $('[data-source="' + $additionalInformationDaysAnchor.attr('id') + '"]', $activityForm);
      $additionalInformationDaysAnchor.remove();
      $additionalInformationDaysBlock.attr('data-source', $additionalInformationDaysAnchor.attr('id'));
      $additionalInformationDaysBlock = $additionalInformationDaysBlock.changeElementType('tr');
      $additionalInformationDaysBlock
        .removeClass('crm-accordion-wrapper crm-custom-accordion')
        .children().changeElementType('td')
          .first()
            .attr('class', 'label')
            .wrapInner('<label>')
            .end()
          .last()
            .attr('class', 'view-value')
            .find('table.form-layout-compressed').removeClass('form-layout-compressed').addClass('form-layout')
            .find('tr').changeElementType('td').children().changeElementType('div');

      // Group fields per day (three fields: start, end, notes).
      $additionalInformationDaysBlock
        .find('.custom_field-row:nth-child(3n + 1)').each(function () {
        var $fields = $(this).add($(this).nextAll(':lt(2)'));
        var $row = $('<tr>').css('display', 'table-row').insertBefore($(this)).append($fields);

        // Resize time fields.
        $row.find('.crm-form-time')
          .attr('size', 5)
          .css({
            width: 'auto',
            minWidth: 0
          });

        // When the start date changes, set the end date accordingly.
        $row.children(':eq(0)').find('.crm-form-date').on('change', function () {
          $row.children(':eq(1)').find('.crm-form-date').val($(this).val())
        });
        $row.children(':eq(0)').find('.crm-hidden-date').on('change', function () {
          $row.children(':eq(1)').find('.crm-hidden-date').val($(this).val())
        });

        // Hide the end date field.
        $row.children(':eq(1)')
          .find('.crm-form-date').removeClass('hasDatepicker')
          .next('.addon.fa-calendar').andSelf().hide();
      });

      if ($existing.length) {
        $existing.remove();
      }
      $additionalInformationDaysBlock.insertBefore($detailsBlock);
    }

    // Hide the "Time" component of the activity_date_time field and remove its
    // value.
    var $activityDateTimeFields = $('#activity_date_time', $activityForm).siblings('[name^="activity_date_time_display_"]').andSelf();
    $activityDateTimeFields.on('change', function() {
      $(this).siblings('#activity_date_time_time').val('');
    });
    $activityDateTimeFields
      .change()
      .siblings('#activity_date_time_time').hide().end()
      .siblings('label[for="activity_date_time_time"]').hide();

    // Hide "Duration" block.
    $('.crm-activity-form-block-duration', $activityForm).hide();

    // Move "Activity status" field behind "Priority" field.
    $('.crm-activity-form-block-status_id', $activityForm).insertAfter($('.crm-activity-form-block-priority_id', $activityForm));

    // Hide "Priority" field.
    $('.crm-activity-form-block-priority_id', $activityForm).hide();
  });

})(cj);
