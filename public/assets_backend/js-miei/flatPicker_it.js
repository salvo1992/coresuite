!function(e, o) {
    "object" == typeof exports && "undefined" != typeof module ? o(exports) : "function" == typeof define && define.amd ? define(["exports"], o) : o((e = "undefined" != typeof globalThis ? globalThis : e || self).it = {})
}(this, function(e) {
    "use strict";
    var o = "undefined" != typeof window && void 0 !== window.flatpickr ? window.flatpickr : {
            l10ns: {}
        },
        n = {
            weekdays: {
                shorthand: ["Dom", "Lun", "Mar", "Mer", "Gio", "Ven", "Sab"],
                longhand: ["Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato"]
            },
            months: {
                shorthand: ["Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dic"],
                longhand: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"]
            },
            firstDayOfWeek: 1,
            ordinal: function() {
                return "°"
            },
            rangeSeparator: " al ",
            weekAbbreviation: "Se",
            scrollTitle: "Scrolla per aumentare",
            toggleTitle: "Clicca per cambiare",
            time_24hr: !0
        };
    o.l10ns.it = n;
    o = o.l10ns;
    e.Italian = n,
        e.default = o,
        Object.defineProperty(e, "__esModule", {
            value: !0
        })
});
