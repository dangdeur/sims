self.addEventListener('push', function(event) {
    const data = event.data.json();
    const title = data.title || 'Notification';
    const options = {
        body: data.body || 'You have a new notification.',
        icon: data.icon || '/path/to/default/icon.png',
        badge: data.badge || '/path/to/default/badge.png',
        data: {
            url: data.data.url || '/',
        },
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    const urlToOpen = event.notification.data.url;

    event.waitUntil(
        clients.openWindow(urlToOpen)
    );
});