var firebaseConfig = {
    apiKey: "AIzaSyCnNUyhsWgYC3xUGtVv65KEkUIw6-CeeIM",
    authDomain: "core-site-274306.firebaseapp.com",
    databaseURL: "https://core-site-274306.firebaseio.com",
    projectId: "core-site-274306",
    storageBucket: "core-site-274306.appspot.com",
    messagingSenderId: "485535666009",
    appId: "1:485535666009:web:81b4f570f86007e744c648",
    measurementId: "G-80TEH3V91N"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/firebase-messaging-sw.js').then(function(registration) {
        // Registration was successful
        console.log('ServiceWorker registration successful with scope: ', registration.scope);
        messaging.useServiceWorker(registration);
    }).catch(function(err) {
        // registration failed :(
        console.log('ServiceWorker registration failed: ', err);
    });
}

messaging.usePublicVapidKey('BM0dCGba4ZebhnheLVOTFxk5W4Srkfr0HNZrrdczN1gpxKLkdxCGCOtXw9huI3tpID7VRfgm1zKkIN_ONLFf3tI');
requestPermission();

messaging.onMessage((payload) => {
    console.log('Message received. ', payload);
    // [START_EXCLUDE]
    // Update the UI to include the received message.
    // appendMessage(payload);
    // [END_EXCLUDE]
    if (Notification.permission === 'granted') {
        notifyMe(payload);
    }
});

messaging.onTokenRefresh(() => {
    messaging.getToken().then((refreshedToken) => {
        console.log('Token refreshed.');
        // Indicate that the new Instance ID token has not yet been sent to the
        // app server.
        setTokenSentToServer(false);
        // Send Instance ID token to app server.
        sendTokenToServer(refreshedToken);
        // [START_EXCLUDE]
        // Display new Instance ID token and clear UI of all previous messages.
        resetUI();
        // [END_EXCLUDE]
    }).catch((err) => {
        console.log('Unable to retrieve refreshed token ', err);
    });
});

function isTokenSentToServer() {
    return window.localStorage.getItem('sentToServer') === '1';
}

function notifyMe(payload) {
    if (!("Notification" in window)) {
        console.log("This browser does not support desktop notification");
    } else if (Notification.permission === "granted") {
        showWin(payload);
    } else if (Notification.permission !== 'denied' || Notification.permission === "default") {
        Notification.requestPermission(function(permission) {
            if (permission === "granted") {
                showWin(payload);
            };
        });
    };
};

function requestPermission() {
    console.log('Requesting permission...');
    // [START request_permission]
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
            // TODO(developer): Retrieve an Instance ID token for use with FCM.
            // [START_EXCLUDE]
            // In many cases once an app has been granted notification permission,
            // it should update its UI reflecting this.
            resetUI();
            // [END_EXCLUDE]
        } else {
            console.log('Unable to get permission to notify.');
        }
    });
    // [END request_permission]
}

function resetUI() {
    // [START get_token]
    // Get Instance ID token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    messaging.getToken().then((currentToken) => {
        if (currentToken) {
            console.log(currentToken);
            sendTokenToServer(currentToken);
        } else {
            // Show permission request.
            console.log('No Instance ID token available. Request permission to generate one.');
            setTokenSentToServer(false);
        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        setTokenSentToServer(false);
    });
    // [END get_token]
}

function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
        console.log('Sending token to server...');
        // TODO(developer): Send the current token to your server.
        setTokenSentToServer(true);
    } else {
        console.log('Token already sent to server so won\'t send it again ' +
            'unless it changes');
    }
}

function showWin(payload) {
    // console.log('onMessage: ', payload);
    var notifyMsg = payload.notification;
    // console.log(payload);
    var notification = new Notification(notifyMsg.title, {
        body: notifyMsg.body,
        icon: notifyMsg.icon
    });
    notification.onclick = function(e) {
        e.preventDefault(); // prevent the browser from focusing the Notification's tab
        window.open(notifyMsg.click_action);
    }
}

function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
}