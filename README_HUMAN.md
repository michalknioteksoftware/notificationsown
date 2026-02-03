Installation: see README.md

Usable tools:

Scripts with curl POST requests that will add notifications into database.
test-notify.ps1 (windows "curl")
test-notify.sh

adding notifications is checkecd by middleware if right token is provided in header under Bearer, comparing with hardcoded token from .env API_TOKEN

Usable pages with lists:
http://localhost/notifications
http://localhost/notifications/sent

Daemon worker, that contains basic logic that will flag notification as sent. Here could go logic with third party notifications.
docker-compose exec app php artisan notifications:process

Pushy requires in admin panel extra web application or android/ios application. Don't have such.

Twillio admin Panel throws me an error that parts of the application is not loading and infinite loop.

Documentation about Amazon emails documenation is too vast. Looks like configuartion of trusted emails is the work for DevOps.