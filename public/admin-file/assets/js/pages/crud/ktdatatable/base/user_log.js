"use strict";
// Class definition

let KTDatatableRemoteAjaxDemo = function() {
    // Private functions

    // basic demo
    let demo = function() {

        let datatable = $('#kt-user-log').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: HOST_URL +'/admin/get-log/users',
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
            }, 
            {
                field: 'user_name',
                title: 'اسم العميل',
                textAlign: 'center',
            }, 
            {
                field: 'user_email',
                title: 'البريد الالكتروني',
                textAlign: 'center',
            },
            
            {
                field: 'price',
                title: 'السعر',
                textAlign: 'center',
            }, 
            {
                field: 'action',
                title: 'العملية',
                textAlign: 'center',
            },
            {
                field: 'description',
                title: 'شرح العملية',
                textAlign: 'center',
            },
            {
                field: 'date',
                title: 'التاريخ',
                textAlign: 'center',
            },
            
            ],
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
