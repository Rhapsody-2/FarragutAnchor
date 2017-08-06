/*global jQuery,Materialize*/
(function ($) {
    $(function () {});
    $(document).ready(function () {
        $('#terms').modal({
            dismissible: false
        });
        $('#privacy').modal({
            dismissible: false
        });
        $('.modal').modal();
        $('select').material_select();
        $(".button-collapse").sideNav();
        $(".open-nav").sideNav();
        $(".datepicker").pickadate({
            selectMonths: true, // Creates a dropdown to control month
            /*selectYears: 40, // Creates a dropdown of 15 years to control year, */
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: false // Close upon selecting a date,
        });
    });
})(jQuery);
