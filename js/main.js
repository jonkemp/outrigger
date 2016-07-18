(function (window) {
  'use strict';

  var utilities = {};

  function formatDateMonthDayYear(date) {
     var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

      if (date) {
          date = new Date(date);
      } else {
          date = new Date();
      }
      return months[date.getMonth()] +
          ' ' + date.getUTCDate() +
          ', ' + date.getFullYear();
  }

  utilities.formatDate = formatDateMonthDayYear;

  window.utilities = utilities;
}(window));
