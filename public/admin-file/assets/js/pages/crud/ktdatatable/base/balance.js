"use strict";
// Class definition

let KTDatatableRemoteAjaxDemo = function() {
    let demo = function() {
        let datatable = $('#kt-balance').KTDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: HOST_URL +'/admin/get-data/balance-requests',
                        map: function(raw) {
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
                field: 'user_name',
                title: 'اسم العميل',
                textAlign: 'center',
                template: function(row) {
                    return `<a target="_blank" href="user-informations/${row.user_id}">${row.user_name}</a>`;
                },
            },
            {
                field: 'user_phone',
                title: 'رقم العميل',
                textAlign: 'center',
                template: function(row) {
                    return `
                        <a href="${HOST_URL}/admin/user_orders/${row.user_id}" class="" title="رقم العميل">
                            ${row.user_phone}
                        </a>
                    `;
                },
            },
            {
                field: 'account_number',
                title: 'رقم الأيبان	',
                textAlign: 'center',
            },
            {
                field: 'available_balance',
                title: 'الرصيد المتاح',
                textAlign: 'center',
            },
            {
                field: 'amount',
                title: 'المبلغ المطلوب سحبه',
                textAlign: 'center',
            },
            {
                field: 'created_at',
                title: 'تاريخ الطلب',
                textAlign: 'center',
            },
            {
                field: 'payment_status',
                title: 'الحالة',
                textAlign: 'center',
                template: function(row) {
                    if(row.payment_status == '' || row.payment_status == 'waiting')
                    {
                        return `<span class="badge badge-danger">قيد الانتظار</span>`;
                    }else{
                        return `<span class="badge badge-success">تم التحويل</span>`;
                    }
                },
            },
            {
                field: 'ref',
                title: 'رقم الحوالة	',
                textAlign: 'center',
            },
            {
                field: 'Actions',
                title: 'تحويل',
                textAlign: 'center',
                template: function(row) {
                    return `
                        <a href="${HOST_URL}/admin/balance_request/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="تحويل">
                            <i class="flaticon-edit-1 text-primary"></i>
                        </a>
                    `;
                },
            },
        ],

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

        $('#kt_datatable_name').on('keyup', function() {
            datatable.search($(this).val(), 'name');
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
