import './bootstrap';

import flatpickr from "flatpickr";
import { Japanese } from "flatpickr/dist/l10n/ja.js";
import "flatpickr/dist/flatpickr.min.css";

flatpickr(".datepicker", {
    altInput: true,
    altFormat: "Y年m月d日",
    locale: Japanese,
});