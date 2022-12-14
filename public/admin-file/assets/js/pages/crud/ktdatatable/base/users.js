"use strict";
// Class definition
var urlParams = new URLSearchParams(window.location.search);
var in_review = urlParams.get('in_review');
if(in_review != null){
    var url = '/admin/get-data/users?in_review=1';
}else{
    var url = '/admin/get-data/users';
}
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
                title: '??????????',
                sortable: false,
                textAlign: 'center',
                template: function(row) {
                    return `<a target="_blank" href="user-informations/${row.id}">${row.name}</a>`;
                },
            },
            {
                field: 'phone',
                title: '?????? ????????????',
                sortable: false,
                textAlign: 'center',
                template: function(row) {
                    return `<a target="_blank" href="user-informations/${row.id}">${row.phone}</a>`;
                },
            },
            {
                field: 'email',
                title: '???????????? ????????????????????',
                textAlign: 'center',
            },
            {
                field: 'total_balance',
                title: '???????????? ??????????',
                textAlign: 'center',
            },
            {
                field: 'pinding_balance',
                title: '???????????? ????????????',
                textAlign: 'center',
            },
            {
                field: 'available_balance',
                title: '???????????? ????????????',
                textAlign: 'center',
            },
            {
                field: 'created_at',
                title: '?????????? ??????????????',
                textAlign: 'center',
            },
            {
                field: 'status',
                title: '????????????',
                template: function(row) {
                    let status = {
                        active: {
                            'title': '????????',
                            'state': 'danger'
                        },
                        not_active: {
                            'title': '?????? ????????',
                            'state': 'success'
                        },
                    };
                    return '<span class="label label-' + status[row.status].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.status].state + '">' +
                        status[row.status].title + '</span>';
                },
            },
            {
                field: 'number_of_reference_orders',
                title: '?????? ?????????? ???????????????? ?????? ??????????',
            },
            {
                field: 'owner_amount_of_reference_orders',
                title: '???????? ???????????? ???????? ?????? ???????? ???? ???????? ?????? ??????',
            },
            {
                field: 'user_amount_of_reference_orders',
                title: '???????? ?????????? ???????? ?????? ???????? ???? ???????? ?????? ??????',
            },
            {
                field: 'Actions',
                title: '???????????? ??????????????',
                sortable: false,
                overflow: 'visible',
                autoHide: false,
                width: 250,
                template: function(row) {
                    return ` <a href="${HOST_URL}/admin/users/edit/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
								<i class="flaticon-edit-1  text-primary"></i>
							</a>
                            <a href="${HOST_URL}/admin/users/log/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
								??????????
							</a>
							<a href="${HOST_URL}/admin/users/create-request-balance/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
								??????
							</a>
                            <a href="${HOST_URL}/admin/users/reset_password/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="?????????? ?????????? ???????? ????????????">
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
