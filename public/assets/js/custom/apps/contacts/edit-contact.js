"use strict";
var KTAppContactEdit = {
    init: function () {
        var t;
        (() => {
            const t = document.getElementById("kt_ecommerce_settings_general_form");
            if (!t) return;
            const e = t.querySelectorAll(".required");
            var n, o = {
                fields: {},
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            };
            e.forEach((t => {
                const e = t.closest(".fv-row").querySelector("input");
                e && (n = e);
                const r = t.closest(".fv-row").querySelector("select");
                r && (n = r);
                const i = n.getAttribute("name");
                o.fields[i] = {
                    validators: {
                        notEmpty: {
                            message: t.innerText + " is required"
                        }
                    }
                }
            }));
            var r = FormValidation.formValidation(t, o);
            const i = t.querySelector('[data-kt-contacts-type="submit"]');
            i.addEventListener("click", (function (t) {
                t.preventDefault(), r && r.validate().then((function (t) {
                    t.submit();
                }))
            }))
        })(), t = function (t) {
            if (!t.id) return t.text;
            var e = document.createElement("span"),
                n = "";
            return n += '<img src="' + t.element.getAttribute("data-kt-select2-country") + '" class="rounded-circle me-2" style="height:19px;" alt="image"/>', n += t.text, e.innerHTML = n, $(e)
        }, $('[data-kt-ecommerce-settings-type="select2_flags"]').select2({
            placeholder: "Select a country",
            minimumResultsForSearch: 1 / 0,
            templateSelection: t,
            templateResult: t
        })
    }
};
KTUtil.onDOMContentLoaded((function () {
    KTAppContactEdit.init()
}));
