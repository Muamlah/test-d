<script>

    "use strict";
    let KTDatatableRemoteAjaxDemoPublic = function() {
        let demo = function() {
            let datatable = $('#kt-report-public-orders').KTDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: HOST_URL +'/admin/get-data/report-public-orders',
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
                }, 
                {
                    field: 'title',
                    title: 'عنوان الطلب',
                    textAlign: 'center',
                }, 
                {
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
                }, 
                {
                    field: 'service_provider_phone',
                    title: 'رقم مقدم الخدمه',
                    textAlign: 'center',
                    template: function(row) {
                        return `<a target="_blank" href="https://api.whatsapp.com/send?phone=966${row.service_provider_phone.slice(1)}" class="">
                                ${row.service_provider_phone}
                                <i class="fab fa-whatsapp"></i>
                            </a>`;
                    },
                }, 
                {
                    field: 'price',
                    title: 'السعر',
                    textAlign: 'center',
                    width: 40,
                }, 
                {
                    field: 'created_at',
                    title: 'تاريخ الطلب',
                    textAlign: 'center',
                }, 
                {
                    field: 'deadline',
                    title: 'تاريخ الانتهاء',
                    textAlign: 'center',
                }, 
                {
                    field: 'status',
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
                                'title': 'مفتوح',
                                'class': ' label-light-info'
                            },
                        };
                        // console.log(status);
                        return '<span class="label font-weight-bold label-lg ' + status[row.status].class + ' label-inline">' + status[row.status].title + '</span>';
                    },
                }, 
                {
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
                }, 
                {
                    field: 'Actions',
                    title: 'التحكم بالطلب',
                    sortable: false,
                    overflow: 'visible',
                    autoHide: false,
                    width: 150,
                    template: function(row) {
                        var following = '';
                        if(row.check)
                        {
                            following = `<a target="_blank" href="following_public_orders/${row.id}" title="تعميد تابع">
                                <i class="fa fa-link"></i>
                            </a>`;
                        }
                        return `<a href="${HOST_URL}/admin/public_orders/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
                                    <i class="flaticon-edit-1  text-primary"></i>
                                </a>
                                <a href="${HOST_URL}/admin/chat/public/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="محادثة">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                ${following}
                                `;
                    },
                }],

            });
            $('#kt_datatable_search_status').on('change', function() {
                datatable.search($(this).val().toLowerCase(), 'status');
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

            $('#kt_datatable_date_from').on('change', function() {
                datatable.search($(this).val(), 'date_from');
            });

            $('#kt_datatable_date_to').on('change', function() {
                datatable.search($(this).val(), 'date_to');
            });

            $('#kt_datatable_phone').on('keyup', function() {
                datatable.search($(this).val(), 'phone');
            });

        };

        return {
            // public functions
            init: function() {
                demo();
            },
        };
    }();

    jQuery(document).ready(function() {
        KTDatatableRemoteAjaxDemoPublic.init();
    });
    

</script>