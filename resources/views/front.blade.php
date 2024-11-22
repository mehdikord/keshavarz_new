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

<script src="{{asset('service-worker.js')}}" ></script>
<script>

    navigator.serviceWorker.register('/service-worker.js').then(registration => {
        const vapidPublicKey = 'BIVr-kL5NdbUc46_TdS9PyppX05H7OMFsNrOcwdV02w4VFT7F1NbJtID2sN9EcWemP4MBNibavHLKyepDMmutOw'; // جایگزین کنید
        const convertedVapidKey = urlBase64ToUint8Array(vapidPublicKey);

        registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: convertedVapidKey
        }).then(subscription => {
            const subscriptionData = {
                endpoint: subscription.endpoint,
                publicKey: btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh')))),
                authToken: btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth'))))
            };
            console.log(subscriptionData)
            // axios.post('/api/save-subscription', subscriptionData);
        });
    });

    // Convert VAPID key to Uint8Array
    function urlBase64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
        const rawData = window.atob(base64);
        return Uint8Array.from([...rawData].map(char => char.charCodeAt(0)));
    }



</script>
</body>

</html>

