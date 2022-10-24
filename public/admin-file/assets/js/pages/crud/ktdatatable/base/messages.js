"use strict";
// Class definition
var urlParams = new URLSearchParams(window.location.search);
var unseen = urlParams.get('unseen');
if(unseen != null){
    var url = '/admin/messages/get-data?unseen=1';
}else{
    var url = '/admin/messages/get-data';
}
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
                        url: HOST_URL + url,
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
                field: 'email',
                title: 'البريد الإلكتروني',
                sortable: false,
                overflow: 'visible',
                textAlign: 'center',
            }, {
                field: 'name',
                title: 'الاسم',
                textAlign: 'center',
            }, {
                field: 'subject',
                title: 'الموضوع',
                textAlign: 'center',
            }, {
                field: 'created_at',
                title: 'تاريخ الارسال',
                textAlign: 'center',
                template:function (row){
                    return '<span class="label font-weight-bold label-lg label-light-primary label-inline">' + new Date(row.created_at).toDateString() + '</span>';
                }
            }, {
                field: 'reply_at',
                title: 'تاريخ الرد',
                textAlign: 'center',
                template:function (row){
                    if(row.reply_at == null){
                        return "";
                    }
                    return '<span class="label font-weight-bold label-lg label-light-success label-inline">' + new Date(row.reply_at).toDateString() + '</span>';
                }
            }, {
                field: 'Actions',
                title: 'التحكم بالرسالة',
                sortable: false,
                overflow: 'visible',
                autoHide: false,
                width: 150,
                template: function(row) {
                    return `<a href="${HOST_URL}/admin/messages/show/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="عرض">
								<i class="flaticon-eye  text-primary"></i>
							</a>`;
                },
            }],

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
