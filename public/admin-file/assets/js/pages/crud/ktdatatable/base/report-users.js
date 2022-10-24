"use strict";
// Class definition

let KTDatatableRemoteAjaxDemo = function() {
    // Private functions

    // basic demo
    let demo = function() {

        let datatable = $('#kt-users').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: HOST_URL +'/admin/get-data/report-users',
                        // sample custom headers
                        // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        map: function(raw) {
                            // sample data mapping
                            let dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                        params: {
                            status: 'test',
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
            columns: [{
                field: 'id',
                title: '#',
                sortable: 'asc',
                type: 'number',
                selector: false,
                textAlign: 'center',
                width:40
            }, 
            {
                field: 'name',
                title: 'الاسم',
                sortable: false,
                textAlign: 'center',
                template: function(row) {
                    return `<a target="_blank" href="user-informations/${row.id}">${row.name}</a>`;
                },
            },
            {
                field: 'phone',
                title: 'رقم الهاتف',
                sortable: false,
                textAlign: 'center',
                template: function(row) {
                    return `<a target="_blank" href="user-informations/${row.id}">${row.phone}</a>`;
                },
            },
            {
                field: 'email',
                title: 'البريد الالكتروني',
                textAlign: 'center',
            }, 
            {
                field: 'pinding_balance',
                title: 'الرصيد المعلق',
                textAlign: 'center',
            }, {
                field: 'created_at',
                title: 'تاريخ التسجيل',
                textAlign: 'center',
            },
            {
                field: 'status',
                title: 'الحالة',
                template: function(row) {
                    let status = {
                        active: {
                            'title': 'فعال',
                            'state': 'danger'
                        },
                        not_active: {
                            'title': 'غير فعال',
                            'state': 'success'
                        },
                    };
                    return '<span class="label label-' + status[row.status].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.status].state + '">' +
                        status[row.status].title + '</span>';
                },
            },
            {
                field: 'Actions',
                title: 'التحكم بالعميل',
                sortable: false,
                overflow: 'visible',
                autoHide: false,
                width: 250,
                template: function(row) {
                    return `
                            <a href="${HOST_URL}/admin/all-report-users/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="'طلبات الإبلاغ'">
                                <i class="fa fa-reply-all"></i>
							</a>
                                `;
                },
            }
            ],
        });
        $('#kt_datatable_user_name').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'name');
        });
        $('#kt_datatable_user_phone').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'phone');
        });
        $('#kt_datatable_user_email').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'email');
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
    KTDatatableRemoteAjaxDemo.init();
});
