"use strict";
// Class definition

let KTDatatableRemoteAjaxDemo = function() {
    // Private functions

    // basic demo
    let demo = function() {

        let datatable = $('#kt-transactions').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: HOST_URL +'/admin/get-data/transactions',
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
                field: 'created_at',
                title: 'التاريخ والوقت',
                textAlign: 'center',
            }, 
            {
                field: 'phone',
                title: 'رقم العميل',
                textAlign: 'center',
                width: 130,
            }, 
            {
                field: 'description',
                title: 'التفاصيل',
                textAlign: 'center',
                width: 220,
            },
            {
                field: 'amount',
                title: 'القيمة',
                textAlign: 'center',
                template: function(row) {
                    return `
                            ${row.amount}  ريال
                        `;
                },
            },
            {
                field: 'type',
                title: 'نوع العملية',
                textAlign: 'center',
                template: function(row) {
                    if(row.type == 'withdrawal')
                    {
                        return `
                            سحب
                        `;
                    }else{
                        return `
                            إيداع
                        `;
                    }
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
