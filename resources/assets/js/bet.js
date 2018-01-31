window.$ = window.jQuery = require('jquery');
require('glyphicons');
require('eonasdan-bootstrap-datetimepicker');

$(function () {
  $('.datetimepicker-bet').datetimepicker({
    locale: 'ru',
  });
});
