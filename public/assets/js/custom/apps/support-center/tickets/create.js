"use strict";
var KTModalNewTicket = function () {
    var t, e, n, i, o, a;
    return {
        init: function () {
            (a = document.querySelector("#kt_modal_new_ticket")) && (o = new bootstrap.Modal(a), i = document.querySelector("#kt_modal_new_ticket_form"), t = document.getElementById("kt_modal_new_ticket_submit"), e = document.getElementById("kt_modal_new_ticket_cancel"), new Dropzone("#kt_modal_create_ticket_attachments", {
                url: "https://keenthemes.com/scripts/void.php",
                paramName: "file",
                maxFiles: 10,
                maxFilesize: 10,
                addRemoveLinks: !0,
                accept: function (t, e) {
                    "justinbieber.jpg" == t.name ? e("Naha, you don't.") : e()
                }
            }), $(i.querySelector('[name="tgl_keluhan"]')).flatpickr({
                enableTime: 0,
                dateFormat: "Y/m/d"
            }), $(i.querySelector('[name="user"]')).on("change", (function () {
                n.revalidateField("user")
            })), $(i.querySelector('[name="status"]')).on("change", (function () {
                n.revalidateField("status")
            })), n = FormValidation.formValidation(i, {
                fields: {
                    master_jenis_keluhan_id: {
                        validators: {
                            notEmpty: {
                                message: "Jenis Keluhan is required"
                            }
                        }
                    },
                    master_uid_id: {
                        validators: {
                            notEmpty: {
                                message: "UID is required"
                            }
                        }
                    },
                    master_up3_id: {
                        validators: {
                            notEmpty: {
                                message: "UP3 is required"
                            }
                        }
                    },
                    master_ulp_id: {
                        validators: {
                            notEmpty: {
                                message: "ULP is required"
                            }
                        }
                    },
                    master_project_id: {
                        validators: {
                            notEmpty: {
                                message: "Project is required"
                            }
                        }
                    },
                    isi_keluhan: {
                        validators: {
                            notEmpty: {
                                message: "Isi Keluhan is required"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), t.addEventListener("click", (function (e) {
                e.preventDefault(), n && n.validate().then((function (e) {
                    console.log("validated!"), "Valid" == e ? (t.setAttribute("data-kt-indicator", "on"), t.disabled = !0, setTimeout((function () {
                        t.removeAttribute("data-kt-indicator"), t.disabled = !1, Swal.fire({
                            text: "Form has been successfully submitted!",
                            icon: "success",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then((function (t) {
                            t.isConfirmed && o.hide();
                            i.submit();
                        }))
                    }), 2e3)) : Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            })), e.addEventListener("click", (function (t) {
                t.preventDefault(), Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then((function (t) {
                    t.value ? (i.reset(), o.hide()) : "cancel" === t.dismiss && Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    })
                }))
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalNewTicket.init()
}));
