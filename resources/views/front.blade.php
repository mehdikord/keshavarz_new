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
    }


    // let deferredPrompt;
    //
    // window.addEventListener('beforeinstallprompt', (e) => {
    //     // جلوگیری از نمایش خودکار پیشنهاد نصب
    //     e.preventDefault();
    //     deferredPrompt = e;
    //
    //     // نمایش یک دکمه برای نصب برنامه
    //     const installButton = document.getElementById('installButton');
    //     installButton.style.display = 'block';
    //
    //     installButton.addEventListener('click', () => {
    //         installButton.style.display = 'none';
    //         deferredPrompt.prompt();
    //         deferredPrompt.userChoice.then((choiceResult) => {
    //             if (choiceResult.outcome === 'accepted') {
    //                 console.log('User accepted the install prompt');
    //             } else {
    //                 console.log('User dismissed the install prompt');
    //             }
    //             deferredPrompt = null;
    //         });
    //     });
    // });




</script>
</body>

</html>

