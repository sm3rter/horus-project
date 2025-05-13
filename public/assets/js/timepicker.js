// tempusdominus-bootstrap-4
$(function() {
  'use strict';

  $('#datetimepickerStart').datetimepicker({
    format: 'LT',
    defaultDate: moment()
  });
  $('#datetimepickerEnd').datetimepicker({
    format: 'LT',
    defaultDate: moment()
  });
});