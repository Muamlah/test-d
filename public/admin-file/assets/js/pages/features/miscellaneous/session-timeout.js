var KTSessionTimeoutDemo = function () {
    var initDemo = function () {
        $.sessionTimeout({
            title: 'مهلة عدم استخدام',
            message: 'سوف يتم تسجيل الخروج بعد انتهاء المهلة',
            redirUrl: HOST_URL +'/admin/logout',
            logoutUrl: HOST_URL +'/admin/logout',
            warnAfter: 900000,
            redirAfter: 15000, //redirect after 15 secons,
            ajaxType:'POST',
            keepAlive:false,
            logoutButton:'تسجيل خروج',
            keepAliveButton:'متابعة العمل',
            ignoreUserActivity: false,
            countdownMessage: '{timer} ثانية.',
            countdownBar: true
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initDemo();
        }
    };
}();

jQuery(document).ready(function() {
    KTSessionTimeoutDemo.init();
});
