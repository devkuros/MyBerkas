// Flatpickr

var f5 = flatpickr(document.getElementById('basicFlatpickr'));
var f6 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});
var f7 = flatpickr(document.getElementById('rangeCalendarFlatpickr'), {
    mode: "range",
});
var f8 = flatpickr(document.getElementById('timeFlatpickr'), {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "13:45"
});
