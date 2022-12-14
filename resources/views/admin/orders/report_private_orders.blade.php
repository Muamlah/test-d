<script>
    setTimeout(function() { 
        "use strict";
        // Class definition

        let KTDatatableRemoteAjaxDemoPrivate = function() {
            // Private functions

            // basic demo
            let demo = function() {

                let datatable = $('#kt-report-private-orders').KTDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: HOST_URL +'/admin/get-data/report-private-orders',
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
                    }, {
                        field: 'user_phone',
                        title: '?????? ????????????',
                        textAlign: 'center',
                        template: function(row) {
                            return `
                                <a target="_blank" href="user-informations/${row.user_id}">${row.user_name}</a><br>
                                <a target="_blank" href="https://api.whatsapp.com/send?phone=966${row.user_phone.slice(1)}" class="">
                                    ${row.user_phone}
                                    <i class="fab fa-whatsapp"></i>
                                </a>`;
                        },
                    }, {
                        field: 'service_provider_phone',
                        title: '?????? ???????? ????????????',
                        textAlign: 'center',
                        template: function(row) {
                            return `<a target="_blank" href="https://api.whatsapp.com/send?phone=966${row.service_provider_phone.slice(1)}" class="">
                                    ${row.service_provider_phone}
                                    <i class="fab fa-whatsapp"></i>
                                </a>`;
                        },
                    }, {
                        field: 'price',
                        title: '??????????',
                        textAlign: 'center',
                        width: 40,
                    },
                    //     {
                    //     field: 'payment_mathod',
                    //     title: '?????????? ??????????',
                    //     textAlign: 'center',
                    // },
                        {
                        field: 'created_at',
                        title: '?????????? ??????????',
                        textAlign: 'center',
                    }, {
                        field: 'deadline',
                        title: '?????????? ????????????????',
                        textAlign: 'center',
                    }, {
                        field: 'status_id',
                        title: '????????????',
                        // callback function support for column rendering
                        template: function(row) {
                            let status = {
                                1: {
                                    'title': '?????????????? ????????????????',
                                    'class': ' label-light-success'
                                },
                                5: {
                                    'title': ' ???? ??????????????',
                                    'class': ' label-light-success'
                                },
                                3: {
                                    'title': '?????? ??????????????',
                                    'class': ' label-light-primary'
                                },
                                4: {
                                    'title': ' ?????????????? ????????????????',
                                    'class': ' label-light-success'
                                },
                                6: {
                                    'title': '?????????????? ?????????? ???????? ????????????',
                                    'class': ' label-light-warning'
                                },
                                8: {
                                    'title': '????????',
                                    'class': ' label-light-warning'
                                },
                                9: {
                                    'title': '?????? ??????????',
                                    'class': ' label-light-warning'
                                },
                                7: {
                                    'title': '????????',
                                    'class': ' label-light-danger'
                                },
                                2: {
                                    'title': '?????????????? ????????????????',
                                    'class': ' label-light-info'
                                },
                            };

                            if(row.status_id == 1){
                                return '<span class="label font-weight-bold label-lg label-light-success label-inline">?????????????? ????????????????</span>';
                            }else if(row.status_id == 5){
                                return '<span class="label font-weight-bold label-lg label-inline label-light-success">???? ??????????????</span>';
                            }else if(row.status_id == 3){
                                return '<span class="label font-weight-bold label-lg label-inline label-light-primary">?????? ??????????????</span>';
                            }else if(row.status_id == 4){
                                return '<span class="label font-weight-bold label-lg label-inline label-light-success">?????????????? ????????????????</span>';
                            }else if(row.status_id == 6){
                                return '<span class="label font-weight-bold label-lg label-inline label-light-warning">?????????????? ?????????? ???????? ????????????</span>';
                            }else if(row.status_id == 8){
                                return '<span class="label font-weight-bold label-lg label-inline label-light-warning">????????</span>';
                            }else if(row.status_id == 9){
                                return '<span class="label font-weight-bold label-lg label-inline label-light-warning">?????? ??????????</span>';
                            }else if(row.status_id == 7){
                                return '<span class="label font-weight-bold label-lg label-inline label-light-danger">????????</span>';
                            }else if(row.status_id == 2){
                                return '<span class="label font-weight-bold label-lg label-inline label-light-info">?????????????? ????????????????</span>';
                            }else{
                                return '';
                            }
                        },
                    }, {
                        field: 'pay_status',
                        title: '???????? ??????????',
                        // callback function support for column rendering
                        template: function(row) {
                            let status = {
                                processing_convert: {
                                    'title': '?????????????? ??????????????',
                                    'state': 'danger'
                                },
                                complete_convert: {
                                    'title': '???? ??????????',
                                    'state': 'success'
                                },
                            };
                            return '<span class="label label-' + status[row.pay_status].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.pay_status].state + '">' +
                                status[row.pay_status].title + '</span>';
                        },
                    }, {
                        field: 'Actions',
                        title: '???????????? ????????????',
                        sortable: false,
                        width: 150,
                        overflow: 'visible',
                        autoHide: false,
                        template: function(row) {
                            var following = '';
                            if(row.check)
                            {
                                following = `<a target="_blank" href="following_private_orders/${row.id}" title="?????????? ????????">
                                    <i class="fa fa-link"></i>
                                </a>`;
                            }
                            return `<a href="${HOST_URL}/admin/private_orders/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
                                        <i class="flaticon-edit-1  text-primary"></i>
                                    </a>
                                    <a href="${HOST_URL}/admin/chat/private/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="????????????">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    ${following}
                                    `;
                        },
                    }],

                });
                $('#kt_datatable_search_status').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'status_id');
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

                $('.kt_datatable_date_from').on('change', function() {
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
            KTDatatableRemoteAjaxDemoPrivate.init();
        });
    }, 2000);
        

</script>