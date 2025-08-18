self.addEventListener('push', function(event) {
    const data = event.data.json();
    const title = data.title || 'Pesan Baru';
    const options = {
        body: data.body || 'Anda mendapatkan pesan baru.',
        icon: data.icon || 'gambar/pesan.png',
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