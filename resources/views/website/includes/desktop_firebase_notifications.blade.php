<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-messaging.js"></script>
<!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
<script src="https://www.gstatic.com/firebasejs/7.19.1/firebase-analytics.js"></script>
<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
      apiKey: "AIzaSyDCf7ZGQhSoVCDEPB5tTa35uN8sBnLgKr0",
      authDomain: "new-muamlah.firebaseapp.com",
      projectId: "new-muamlah",
      storageBucket: "new-muamlah.appspot.com",
      messagingSenderId: "400735104186",
      appId: "1:400735104186:web:9d545690add5ab35182683",
      measurementId: "G-DWCFZLB9LM"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

  const messaging = firebase.messaging();
  messaging.usePublicVapidKey("BCUjNUJXXocaXlUgULzE5CS4XV28koDR9soST-WpbpWjP3Jke7f_pcS5HsGKzSRziHD9pfYsmABdFYgUYk-ijsg");
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker
        .register('/service-worker.js')
        .then(function(registration) {
            messaging.useServiceWorker( registration );
        })
        .catch(function(err) {

        });
    }
    StartNotificationApp();
    function StartNotificationApp() {
        messaging.getToken()
        .then((currentToken) => {
            if (currentToken) {
                saveToken(currentToken);
            }
            else {
                // Show permission request.
                console.log('No Instance ID token available. Request permission to generate one.');
            }
        })
        .catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
        });
        messaging.onTokenRefresh(() => {
            messaging.getToken()
            .then((refreshedToken) => {
                saveToken(refreshedToken);
            })
            .catch((err) => {
                // console.log('Unable to retrieve refreshed token ', err);
            });
        });
    }

    var saveToken = function(_FIREBASE_TOKEN_){
        $.ajax({
            url      : "{!! route('firebase.save_web_token') !!}",
            method   : 'POST',
            dataType : 'json',
            data     : {
                data_token : _FIREBASE_TOKEN_,
                _token     : '{!! csrf_token() !!}',
            },
            statusCode: {
                404: function(xhr) {
                    var data = xhr.responseJSON;
                    // console.log(data);
                },
                403: function(xhr) {
                    var data = xhr.responseJSON;
                    // console.log(data);
                },
                401: function(xhr) {
                    var data = xhr.responseJSON;
                    // console.log(data);
                },
                500: function(xhr) {
                    var data = xhr.responseJSON;
                    // console.log(data);
                },
                200: function(data) {
                    // console.log(data);
                }
            }
        });
    };

    if( navigator.serviceWorker ) {
        navigator.serviceWorker.addEventListener('message', function(event) {
            update_notification_count(event.data.notification);
        });
    }
    else {
        messaging.onMessage(function(event){
            update_notification_count(event.data.notification);
        });
    }


    function update_notification_count(data){
        let count = parseInt($('#notification-count').text());
        $('#notification-count').html(count + 1).css('opacity','1');
        $('#unreadNotifications').prepend(`<a href="${data.click_action}">
        <p class="pt-2">
            ${data.body}
        </p>
    </a>
    <div class="w-100 divider mb-2 bg-divider"></div>`);
    }
    function append_message(data){
        let message_data = data.data;
        let div = $('.order-chat').length;
        if(div){
            console.log(message_data.more_data);
            let html = JSON.parse(message_data.more_data).html;
            $('.order-chat').append(html);
            console.log(html);
        }
    }


</script>
