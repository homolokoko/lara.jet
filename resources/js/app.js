import './bootstrap';
import Lodash from 'lodash';
import Swal from 'sweetalert2';
import Fuse from 'fuse.js';
import Axios from 'axios';
import Sortable from 'sortablejs/modular/sortable.complete.esm.js';
import SlimSelect from 'slim-select';
import QrScanner from 'qr-scanner';
import QrCode from 'qrcode';
import Flatpickr from 'flatpickr';
import Webcam from 'webcam-easy';
import { TabulatorFull as Tabulator } from 'tabulator-tables';
import country from './lib/country';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask';
import intersect from '@alpinejs/intersect';
import resize from '@alpinejs/resize';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';
import anchor from '@alpinejs/anchor';
import morph from '@alpinejs/morph';
import sort from '@alpinejs/sort';
window.Alpine = Alpine;

window._ = Lodash;
window.swal = Swal;
window.Fuse = Fuse;
window.Sortable = Sortable;
window.axios = Axios;
window.SlimSelect = SlimSelect;
window.QrScanner = QrScanner;
window.QrCode = QrCode;
window.Flatpickr = Flatpickr;
window.Webcam = Webcam;
window.Tabulator = Tabulator;
window.QMS = {
    "fuse" : Fuse,
    "country": country,
}

Alpine.start();
Alpine.plugin(mask)
Alpine.plugin(intersect)
Alpine.plugin(resize)
Alpine.plugin(focus)
Alpine.plugin(collapse)
Alpine.plugin(anchor)
Alpine.plugin(morph)
Alpine.plugin(sort)
