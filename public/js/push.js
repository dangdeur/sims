// Get VAPID public key from your server
const vapidPublicKey = "<?= env('VAPID_PUBLIC_KEY'); ?>"; // Or fetch it from a CI4 endpoint

// Function to convert base64 to Uint8Array
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

// Check for service worker and push manager support
if ('serviceWorker' in navigator && 'PushManager' in window) {
    console.log('Service Worker and Push is supported');

    navigator.serviceWorker.register('sw.js')
        .then(function(swReg) {
            console.log('Service Worker is registered', swReg);
            return swReg.pushManager.getSubscription()
                .then(function(subscription) {
                    if (subscription === null) {
                        // User is not subscribed, so subscribe them
                        const applicationServerKey = urlBase64ToUint8Array(vapidPublicKey);
                        return swReg.pushManager.subscribe({
                            userVisibleOnly: true,
                            applicationServerKey: applicationServerKey,
                        });
                    } else {
                        // User is already subscribed
                        console.log('User is already subscribed');
                        return subscription;
                    }
                });
        })
        .then(function(subscription) {
            console.log('User is subscribed:', subscription);
            // Send the subscription to your CI4 server
            fetch('/api/subscribe', {
                method: 'POST',
                body: JSON.stringify(subscription.toJSON()),
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(function(response) {
                if (response.ok) {
                    console.log('Subscription successfully sent to server.');
                } else {
                    console.log('Failed to send subscription to server.');
                }
            })
            .catch(function(error) {
                console.error('Error sending subscription:', error);
            });
        })
        .catch(function(error) {
            console.error('Service Worker Error', error);
        });
} else {
    console.warn('Push messaging is not supported');
}