// Class definition
var KTFormControls = function () {
    let add_form;
    let edit_form;
    let validator_add;
    let validator_edit;
    // Private functions
    var add = function () {
        validator_add= FormValidation.formValidation(
            document.getElementById('kt_add_form'),
            {
                fields: {
                    service_name: {
                        validators: {
                            notEmpty: {
                                message: 'الرجاء ادخال اسم الخدمة'
                            }
                        }
                    },
                    price: {
                        validators: {
                            notEmpty: {
                                message: 'الرجاء ادخال السعر الخدمة'
                            }
                        }
                    },
                    section_id: {
                        validators: {
                            notEmpty: {
                                message: 'الرجاء اختيار قسم'
                            }
                        }
                    },
                    img: {
                        validators: {
                            notEmpty: {
                                message: 'الرجاء اختيار صورة'
                            },
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/png',
                                maxSize: 2097152,   // 2048 * 1024
                                message: 'نوع الملف الذي اخترتة غير مسموح بة او الحجم  '
                            },
                        }
                    },
                    details: {
                        validators: {
                            notEmpty: {
                                message: 'الرجاء ادخال وصف الخدمة'
                            },
                            stringLength: {
                                min: 20,
                                max: 200,
                                message: 'الرجاء ادخال وصف للخدمة لا يقل عن 20 حرف ولا يزيد عن 200'
                            }
                        }
                    },
                },
                plugins: {
                    //Learn more: https://formvalidation.io/guide/plugins
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                }
            }
        ).on('core.form.valid', function () {
            // Send the form data to back-end
            // You need to grab the form data and create an Ajax request to send them
            $('#kt_add_form').ajaxSubmit({
                success: function () {
                    // KTApp.unprogress(btn);
                    // KTApp.unblock(add_form);
                    // let datatable = $('.kt-datatable').KTDatatable();
                    // datatable.reload();
                    // $('#add').modal('hide');
                    // form_input([], 'add');
                }, error: function (data) {
                    // KTApp.unprogress(btn);
                    // KTApp.unblock(add_form);
                    // $.each(data.responseJSON, function (i, item) {
                    //     toastr.error(data.responseJSON[i][0]);
                    // })
                }
            });
        });
    };
    $('#price').on('change', function(){
        validator_add.revalidateField('price');
    });
    var edit = function () {
        FormValidation.formValidation(
            document.getElementById('kt_edit_form'),
            {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email is required'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            }
                        }
                    },

                    url: {
                        validators: {
                            notEmpty: {
                                message: 'Website URL is required'
                            },
                            uri: {
                                message: 'The website address is not valid'
                            }
                        }
                    },

                    digits: {
                        validators: {
                            notEmpty: {
                                message: 'Digits is required'
                            },
                            digits: {
                                message: 'The velue is not a valid digits'
                            }
                        }
                    },

                    creditcard: {
                        validators: {
                            notEmpty: {
                                message: 'Credit card number is required'
                            },
                            creditCard: {
                                message: 'The credit card number is not valid'
                            }
                        }
                    },

                    phone: {
                        validators: {
                            notEmpty: {
                                message: 'US phone number is required'
                            },
                            phone: {
                                country: 'US',
                                message: 'The value is not a valid US phone number'
                            }
                        }
                    },

                    option: {
                        validators: {
                            notEmpty: {
                                message: 'Please select an option'
                            }
                        }
                    },

                    options: {
                        validators: {
                            choice: {
                                min: 2,
                                max: 5,
                                message: 'Please select at least 2 and maximum 5 options'
                            }
                        }
                    },

                    memo: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter memo text'
                            },
                            stringLength: {
                                min: 50,
                                max: 100,
                                message: 'Please enter a menu within text length range 50 and 100'
                            }
                        }
                    },

                    checkbox: {
                        validators: {
                            choice: {
                                min: 1,
                                message: 'Please kindly check this'
                            }
                        }
                    },

                    checkboxes: {
                        validators: {
                            choice: {
                                min: 2,
                                max: 5,
                                message: 'Please check at least 1 and maximum 2 options'
                            }
                        }
                    },

                    radios: {
                        validators: {
                            choice: {
                                min: 1,
                                message: 'Please kindly check this'
                            }
                        }
                    },
                },

                plugins: { //Learn more: https://formvalidation.io/guide/plugins
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                }
            }
        );
    };
    // let initSubmit = function () {
    //     let btn = add_form.find('[data-ktwizard-type="action-submit"]');
    //     btn.on('click', function (e) {
    //         e.preventDefault();
    //         if (validator_add.form()) {
    //             // See: src\js\framework\base\app.js
    //             KTApp.progress(btn);
    //             KTApp.block(add_form);
    //             // See: http://malsup.com/jquery/form/#ajaxSubmit
    //             add_form.ajaxSubmit({
    //                 success: function () {
    //                     KTApp.unprogress(btn);
    //                     KTApp.unblock(add_form);
    //                     let datatable = $('.kt-datatable').KTDatatable();
    //                     datatable.reload();
    //                     $('#add').modal('hide');
    //                     form_input([], 'add');
    //                 }, error: function (data) {
    //                     KTApp.unprogress(btn);
    //                     KTApp.unblock(add_form);
    //                     $.each(data.responseJSON, function (i, item) {
    //                         toastr.error(data.responseJSON[i][0]);
    //                     })
    //                 }
    //             });
    //         }
    //     });
    // };
    // let initEditSubmit = function () {
    //     let datatable = $('.kt-datatable').KTDatatable();
    //     let btn = edit_form.find('[data-ktwizard-type="action-submit"]');
    //     btn.on('click', function (e) {
    //         e.preventDefault();
    //         if (validator_edit.form()) {
    //             KTApp.progress(btn);
    //             KTApp.block(edit_form);
    //             edit_form.ajaxSubmit({
    //                 success: function () {
    //                     datatable.reload();
    //                     KTApp.unprogress(btn);
    //                     KTApp.unblock(edit_form);
    //                     $('#edit').modal('hide');
    //                 },
    //                 error: function (data) {
    //                     KTApp.unprogress(btn);
    //                     KTApp.unblock(edit_form);
    //                     $.each(data.responseJSON, function (i, item) {
    //                         toastr.error(data.responseJSON[i][0]);
    //                     })
    //                 }
    //             });
    //         }
    //     });
    // };

    return {
        // public functions
        init: function () {
            add_form = $('#kt_add_form');
            edit_form = $('#kt_edit_form');
            add();
            edit();
            // initSubmit();
            // initEditSubmit();
        }
    };
}();

jQuery(document).ready(function () {
    KTFormControls.init();
});
