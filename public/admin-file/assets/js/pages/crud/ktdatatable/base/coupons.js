"use strict";
// Class definition

let KTDatatableRemoteAjaxDemo = function() {
    // Private functions

    // basic demo
    let demo = function() {

        let datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: HOST_URL +'/admin/coupon/get-data',
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
                            type: 'coupon',
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
                field: 'owner_name',
                title: 'الاسم',
                sortable: false,
                overflow: 'visible',
                textAlign: 'center',
            },{
                field: 'code',
                title: 'الرمز',
                sortable: false,
                overflow: 'visible',
                textAlign: 'center',
            }, {
                field: 'instances_count',
                title: 'عدد المستفيدين',
                textAlign: 'center',
            }, {
                field: 'number_of_use',
                title: 'عدد مرات الإستخدام',
                textAlign: 'center',
            }, {
                field: 'used_instances_count',
                title: 'الكوبونات المستخدمة',
                textAlign: 'center',
            }
            , {
                field: 'discount',
                title: 'قيمة الحسم',
                textAlign: 'center',
            }
            , {
                field: 'discount_type',
                title: 'نوع الحسم',
                textAlign: 'center',
            }
             , {
                field: 'Actions',
                title: 'التحكم بالقسيمة',
                sortable: false,
                overflow: 'visible',
                autoHide: false,
                template: function(row) {
                    return ` <a href="${HOST_URL}/admin/coupon/edit/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="تعديل">
								<i class="flaticon-edit-1  text-primary"></i>
							</a>
							<a href="${HOST_URL}/admin/coupon/delete/${row.id}" onclick="return confirm('هل أنت متأكد من عملية الحذف؟')"  class="btn btn-sm btn-clean btn-icon btn-icon-md test" title="Edit details">
								<i class="flaticon2-trash text-danger"></i>
							</a>`;
                },
            }],

        });
        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'type');
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
