<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="enamad" content="595012" >

    <title>11919696</title>

    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="{{asset('front/css/font.css')}}">
    <meta name="enamad" content="11919696">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="My description here">
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.js"></script>
    <link rel="manifest" href="{{asset('manifest.json')}}">

    @vite(['resources/js/front.js'])

</head>

<body>
<button id="installButton" style="display: none;margin-top: 300px">Install App</button>

<div id="app">



</div>

<script>
    function urlBase64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding)
            .replace(/\-/g, '+')
            .replace(/_/g, '/');
        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);

        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    }

    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/service-worker.js')
                .then(registration => {
                    console.log('Service Worker registered with scope: ', registration.scope);
                })
                .catch(error => {
                    console.error('Service Worker registration failed: ', error);
                });
        });


        navigator.serviceWorker.register('/service-worker.js')
            .then(function(registration) {
                return registration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: urlBase64ToUint8Array("BIVr-kL5NdbUc46_TdS9PyppX05H7OMFsNrOcwdV02w4VFT7F1NbJtID2sN9EcWemP4MBNibavHLKyepDMmutOw"), // یا کلید عمومی VAPID که مستقیما وارد کردید
                });
            })
            .then(function(subscription) {
                // ارسال اطلاعات اشتراک به سرور
                // axios.post('/api/subscribe', subscription);
                console.log({
                    endpoint: subscription.endpoint,
                    publicKey: subscription.keys.p256dh,
                    authToken: subscription.keys.auth
                })
            })
            .catch(function(error) {
                console.error('Subscription failed:', error);
            });


    }







</script>
</body>

</html>

