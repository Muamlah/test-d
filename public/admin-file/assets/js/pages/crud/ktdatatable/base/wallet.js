"use strict";
// Class definition

let KTDatatableRemoteAjaxDemo = function() {
    // Private functions

    // basic demo
    let demo = function() {

        let datatable = $('#kt-wallet').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: HOST_URL + '/admin/get-data/wallet',
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
            columns: [{
                field: 'id',
                title: '#',
                sortable: 'asc',
                type: 'number',
                selector: false,
                textAlign: 'center',
                width: 40
            }, {
                field: 'order_id',
                title: 'رقم الطلب',
                textAlign: 'center',
            }, {
                field: 'order_type',
                title: 'نوع الطلب ',
                textAlign: 'center',
            }, {
                field: 'amount',
                title: 'قيمة الطلب',
                textAlign: 'center',
            }, {
                field: 'balance',
                title: 'عمولة المنصة',
                textAlign: 'center',
            }, {
                field: 'type',
                title: 'الحركة',
                textAlign: 'center',
            }, {

                field: 'description',
                title: 'وصف الحركة',
                textAlign: 'center',
                width: 100
            },
            // {
            //     field: 'Actions',
            //     title: 'التحكم بالطلب',
            //     sortable: false,
            //     overflow: 'visible',
            //     autoHide: false,
            //     width: 150,
            //     template: function(row) {
            //         return ` <a href="${HOST_URL}/admin/update_request/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
			// 					<i class="flaticon-edit-1  text-primary"></i>
			// 				</a>`;
            //     },
            // }
            ],

        });
        $('#kt_datatable_search_period').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'search_period');
        });


        $('#kt_datatable_date_from').on('change', function() {
            datatable.search($(this).val(), 'date_from');
        });

        $('#kt_datatable_date_to').on('change', function() {
            datatable.search($(this).val(), 'date_to');
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
