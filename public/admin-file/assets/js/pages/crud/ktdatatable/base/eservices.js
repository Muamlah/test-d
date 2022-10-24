"use strict";
// Class definition

let KTDatatableRemoteAjaxDemo = function() {
    // Private functions

    // basic demo
    let demo = function() {

        let datatable = $('#kt-eservices').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: HOST_URL +'/admin/get-data/e-services',
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
                            pay_status: 'test',
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
            }, {
                field: 'ımg',
                title: 'الصورة',
                sortable: false,
                textAlign: 'center',
                template:function (row){
                    return   `<div class="symbol symbol-120 symbol-sm flex-shrink-0">
                                    <img  src="${HOST_URL}/public/storage/${row.img}" alt="photo">
                              </div>`
                }
            }, {
                field: 'sections_name',
                title: 'القسم',
                sortable: false,
                overflow: 'visible',
                textAlign: 'center',
            }, {
                field: 'service_name',
                title: 'الخدمة',
                textAlign: 'center',
            }, {
                field: 'price',
                title: 'السعر',
                textAlign: 'center',
            }, {
                field: 'Actions',
                title: 'التحكم بالطلب',
                sortable: false,
                overflow: 'visible',
                autoHide: false,
                width: 150,
                template: function(row) {
                    return `<a href="${HOST_URL}/admin/e_services/${row.id}/edit" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="تعديل">
								<i class="flaticon-edit-1  text-primary"></i>
							</a>
							<button href="${HOST_URL}/admin/e_services/delete/${row.id}" onclick="return confirm('هل أنت متأكد من عملية الحذف؟')"   class="btn btn-sm btn-clean btn-icon btn-icon-md test" title="حذف">
								<i class="flaticon2-trash text-danger"></i>
							</button>`;
                },
            }],

        });
        $('#kt_datatable_search_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'status');
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'pay_status');
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
