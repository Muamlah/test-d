<script>
    "use strict";
    // Class definition

    let KTDatatableRemoteAjaxDemo = function() {
        // Private functions

        // basic demo
        let demo = function() {

            let datatable = $('#kt-private-orders').KTDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: HOST_URL +'/admin/get-data/private-orders',
                            // sample custom headers
                            // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                            map: function(raw) {
                                // sample data mapping
                                let dataSet = raw;
                                if (typeof raw.data !== 'undefined') {
                                    dataSet = raw.data;
                                }
                                return dataSet;
                            }
                        },
                    },
                    pageSize: 10,
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true,
                },

                // layout definition
                layout: {
                    scroll: false,
                    footer: false,
                },

                // column sorting
                sortable: true,

                pagination: true,

                search: {
                    input: $('#kt_datatable_search_query'),
                    key: 'generalSearch'
                },

                // columns definition
                columns: [
                {
                    field: 'id',
                    title: '#',
                    sortable: 'asc',
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                    width: 40,
                }, {
                    field: 'user_phone',
                    title: 'رقم العميل',
                    textAlign: 'center',
                    template: function(row) {
                        return `
                            <a target="_blank" href="user-informations/${row.user_id}">${row.user_name}</a><br>
                            <a target="_blank" href="https://api.whatsapp.com/send?phone=966${row.user_phone.slice(1)}" class="">
                                ${row.user_phone}
                                <i class="fab fa-whatsapp"></i>
                            </a>`;
                    },
                }, {
                    field: 'service_provider_phone',
                    title: 'رقم مقدم الخدمه',
                    textAlign: 'center',
                    template: function(row) {
                        return `<a target="_blank" href="https://api.whatsapp.com/send?phone=966${row.service_provider_phone.slice(1)}" class="">
                                ${row.service_provider_phone}
                                <i class="fab fa-whatsapp"></i>
                            </a>`;
                    },
                }, {
                    field: 'price',
                    title: 'السعر',
                    textAlign: 'center',
                    width: 40,
                },
                //     {
                //     field: 'payment_mathod',
                //     title: 'بوابة الدفع',
                //     textAlign: 'center',
                // },
                    {
                    field: 'created_at',
                    title: 'تاريخ الطلب',
                    textAlign: 'center',
                }, {
                    field: 'deadline',
                    title: 'تاريخ الانتهاء',
                    textAlign: 'center',
                }, {
                    field: 'status_id',
                    title: 'الحالة',
                    // callback function support for column rendering
                    template: function(row) {
                        let status = {
                            1: {
                                'title': 'بانتظار المراجعة',
                                'class': ' label-light-success'
                            },
                            5: {
                                'title': ' تم التسليم',
                                'class': ' label-light-success'
                            },
                            3: {
                                'title': 'قيد التنفيذ',
                                'class': ' label-light-primary'
                            },
                            11: {
                                'title': 'تنفيذ واتس اب',
                                'class': ' label-light-primary'
                            },
                            4: {
                                'title': ' بإنتظار الإستلام',
                                'class': ' label-light-success'
                            },
                            6: {
                                'title': 'بانتظار الغاء مقدم الخدمة',
                                'class': ' label-light-warning'
                            },
                            8: {
                                'title': 'بلاغ',
                                'class': ' label-light-warning'
                            },
                            9: {
                                'title': 'غير موافق',
                                'class': ' label-light-warning'
                            },
                            7: {
                                'title': 'ملغي',
                                'class': ' label-light-danger'
                            },
                            2: {
                                'title': 'بإنتظار الموافقة',
                                'class': ' label-light-info'
                            },
                        };
                        if(row.status_id == 1){
                            return '<span class="label font-weight-bold label-lg label-light-success label-inline">بانتظار المراجعة</span>';
                        }else if(row.status_id == 5){
                            return '<span class="label font-weight-bold label-lg label-inline label-light-success">تم التسليم</span>';
                        }else if(row.status_id == 10){
                            return '<span class="label font-weight-bold label-lg label-inline label-light-success">تسليم مشرف</span>';
                        }else if(row.status_id == 3){
                            return '<span class="label font-weight-bold label-lg label-inline label-light-primary">قيد التنفيذ</span>';
                        }else if(row.status_id == 4){
                            return '<span class="label font-weight-bold label-lg label-inline label-light-success">بإنتظار الإستلام</span>';
                        }else if(row.status_id == 11){
                            return '<span class="label font-weight-bold label-lg label-inline label-light-success">تنفيذ واتس اب</span>';
                        }else if(row.status_id == 6){
                            return '<span class="label font-weight-bold label-lg label-inline label-light-warning">بانتظار الغاء مقدم الخدمة</span>';
                        }else if(row.status_id == 8){
                            return '<span class="label font-weight-bold label-lg label-inline label-light-warning">بلاغ</span>';
                        }else if(row.status_id == 9){
                            return '<span class="label font-weight-bold label-lg label-inline label-light-danger">الغاء مشرف</span>';
                        }else if(row.status_id == 7){
                            return '<span class="label font-weight-bold label-lg label-inline label-light-danger">ملغي</span>';
                        }else if(row.status_id == 2){
                            return '<span class="label font-weight-bold label-lg label-inline label-light-info">بإنتظار الموافقة</span>';
                        }else{
                            return '';
                        }
                    },
                }, {
                    field: 'pay_status',
                    title: 'حالة الدفع',
                    // callback function support for column rendering
                    template: function(row) {
                        let status = {
                            processing_convert: {
                                'title': 'بانتظار التحويل',
                                'state': 'danger'
                            },
                            complete_convert: {
                                'title': 'تم الدفع',
                                'state': 'success'
                            },
                        };
                        return '<span class="label label-' + status[row.pay_status].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.pay_status].state + '">' +
                            status[row.pay_status].title + '</span>';
                    },
                }, {
                    field: 'Actions',
                    title: 'التحكم بالطلب',
                    sortable: false,
                    width: 150,
                    overflow: 'visible',
                    autoHide: false,
                    template: function(row) {
                        var UPDATE_PRIVATE_ORDER     = "{{can('UPDATE_PRIVATE_ORDER')}}";
                        var update_btn          = '';
                        if(UPDATE_PRIVATE_ORDER)
                        {
                            update_btn = `<a href="${HOST_URL}/admin/private_orders/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
                                    <i class="flaticon-edit-1  text-primary"></i>
                                </a>`;
                        }
                        var following = '';
                        if(row.check)
                        {
                            following = `<a target="_blank" href="following_private_orders/${row.id}" title="تعميد تابع">
                                <i class="fa fa-link"></i>
                            </a>`;
                        }
                        return ` ${update_btn}
                                <a href="${HOST_URL}/admin/chat/private/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="محادثة">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                ${following}
                                `;
                    },
                }],

            });
            $('#kt_datatable_search_status').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'status_id');
            });

            $('#kt_datatable_search_type').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'pay_status');
            });

            $('#kt_datatable_amount_from').on('keyup', function() {
                datatable.search($(this).val(), 'amount_from');
            });

            $('#kt_datatable_amount_to').on('keyup', function() {
                datatable.search($(this).val(), 'amount_to');
            });

            $('.kt_datatable_date_from').on('change', function() {
                datatable.search($(this).val(), 'date_from');
            });

            $('#kt_datatable_date_to').on('change', function() {
                datatable.search($(this).val(), 'date_to');
            });

            $('#kt_datatable_phone').on('keyup', function() {
                datatable.search($(this).val(), 'phone');
            });

            $('#kt_datatable_order_number').on('keyup', function() {
                datatable.search($(this).val(), 'order_number');
            });



            $('.status-parent').on('click', function() {
                datatable.search($(this).find('.status-input').val(), 'all_status');
            });

            // $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
        };

        return {
            // public functions
            init: function() {
                demo();
            },
        };
    }();

    jQuery(document).ready(function() {
        KTDatatableRemoteAjaxDemo.init();
    });

</script>
