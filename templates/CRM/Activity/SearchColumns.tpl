{*-------------------------------------------------------+
| SYSTOPIA Donation Receipts Extension                   |
| Copyright (C) 2013-2016 SYSTOPIA                       |
| Author: N.Bochan (bochan -at- systopia.de)             |
| http://www.systopia.de/                                |
+--------------------------------------------------------+
| License: AGPLv3, see LICENSE file                      |
+--------------------------------------------------------*}

{* create a temporary table with the data *}
<table id="activity_search_data">
  {foreach from=$rows item=row}
    <tr id="rowid{$row.activity_id}" class="{cycle values="odd-row,even-row"} crm-activity_{$row.activity_id}">
      <td class="crm-activity-dsd_betreuer">{$row.dsd_betreuer}</td>
      <td class="crm-activity-standort">{$row.standort}</td>
    </tr>
  {/foreach}
</table>

{* then move the column from the temporary table into the original one *}
{literal}
  <script type="text/javascript">
    (function($) {
      var $selectorTable = $('form.CRM_Activity_Form_Search table.selector:first');
      var $headerRow = $selectorTable.find('tr:first');

      // get the penultimate column index
      var columnNr = $headerRow.find('th:last').prev('th').index();
      // iterate over all items
      $('#activity_search_data tr').each(function(rowIndex) {
        $(this).find('td').insertAfter($selectorTable.find('tbody tr:nth-child(' + (rowIndex+2) + ') td:nth-child(' + columnNr + ')'))
      });

      // finally delete the temp table
      $('#activity_search_data').remove();

      // Rename and reorder columns.
      $headerRow.find('th:nth-child(3)')
        .find('a:link').text('Öffentlich/DSD-Beteiligung');

      $headerRow.find('th:nth-child(6)').insertAfter($headerRow.find('th:nth-child(3)'));

      $headerRow.find('th:nth-child(8)').insertAfter($headerRow.find('th:nth-child(4)'));

      $headerRow.find('th:nth-child(9)').insertAfter($headerRow.find('th:nth-child(5)'));

      $headerRow.find('th:nth-child(8)').insertAfter($headerRow.find('th:nth-child(6)'));

      $headerRow.find('th:nth-child(9)').insertAfter($headerRow.find('th:nth-child(7)'));

      $headerRow.find('th:nth-child(9)').remove();

      $selectorTable.find('tbody tr').each(function(rowIndex) {
        // Skip first row, which is the header.
        if (!rowIndex) {
          return;
        }

        // Move date column data.
        $(this).find('td:nth-child(7)').insertAfter($(this).find('td:nth-child(3)'));

        // Move "DSD-Betreuer" column data.
        $(this).find('td:nth-child(9)').insertAfter($(this).find('td:nth-child(4)'));

        // Move "Standort" column data.
        $(this).find('td:nth-child(10)').insertAfter($(this).find('td:nth-child(5)'));

        // Move "Assignee" column data.
        $(this).find('td:nth-child(9)').insertAfter($(this).find('td:nth-child(6)'));

        // Move "Status" column data.
        $(this).find('td:nth-child(10)').insertAfter($(this).find('td:nth-child(7)'));

        // Remove leftover columns.
        $(this).find('td:nth-child(9)').remove();
        $(this).find('td:nth-child(9)').remove();
      });

    })(jQuery);
  </script>
{/literal}
