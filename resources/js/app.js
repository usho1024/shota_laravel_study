import './bootstrap';

import flatpickr from "flatpickr";
import { Japanese } from "flatpickr/dist/l10n/ja.js";
import "flatpickr/dist/flatpickr.min.css";

const endDatePicker = flatpickr("#end-date", {
    altInput: true,
    altFormat: "Y年m月d日",
    locale: Japanese,
});

const startDatePicker = flatpickr("#start-date", {
    altInput: true,
    altFormat: "Y年m月d日",
    locale: Japanese,
    onChange: function(selectedDates, dateStr, instance) {
        endDatePicker.set("minDate", selectedDates[0]);        
    },
});