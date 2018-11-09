# Codetube

A lighweight YouTube clone built around Laravel and Vue.js.


## Local development

1. Grab latest source from git.

   ```
   $ git clone https://github.com/filemonmateus/codetube.git
   ```

2. Setup environment variables.

   ```
   APP_NAME=Codetube
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_PORT=8000
   APP_URL="http://localhost:${APP_PORT}"

   LOG_CHANNEL=stack

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=homestead
   DB_USERNAME=homestead
   DB_PASSWORD=secret

   BROADCAST_DRIVER=log
   CACHE_DRIVER=file
   SESSION_DRIVER=file
   SESSION_LIFETIME=120
   QUEUE_DRIVER=database

   REDIS_HOST=127.0.0.1
   REDIS_PASSWORD=null
   REDIS_PORT=6379

   MAIL_DRIVER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_ENCRYPTION=null

   PUSHER_APP_ID=
   PUSHER_APP_KEY=
   PUSHER_APP_SECRET=
   PUSHER_APP_CLUSTER=mt1

   MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
   MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

   GOOGLE_CLOUD_PROJECT_ID=
   GOOGLE_CLOUD_STORAGE_IMAGES_BUCKET=images_codetube
   GOOGLE_CLOUD_STORAGE_VIDEOS_BUCKET=videos_codetube
   GOOGLE_CLOUD_STORAGE_API_URI=https://storage.googleapis.com

   FFMPEG_BINARY=/path/to/ffmpeg
   FFPROBE_BINARY=/path/to/ffprobe
   FFMPEG_THREADS=12
   TIMEOUT=3600

   ALGOLIA_APP_ID=
   ALGOLIA_SECRET=

   BRAINTREE_ENV=sandbox
   BRAINTREE_MERCHANT_ID=
   BRAINTREE_PUBLIC_KEY=
   BRAINTREE_PRIVATE_KEY=

   FACEBOOK_CLIENT_ID=
   FACEBOOK_CLIENT_SECRET=
   FACEBOOK_REDIRECT_URL="${APP_URL}/facebook/login/callback"

   GOOGLE_CLIENT_ID=
   GOOGLE_CLIENT_SECRET=
   GOOGLE_REDIRECT_URL="${APP_URL}/google/login/callback"

   TWITTER_CLIENT_ID=
   TWITTER_CLIENT_SECRET=
   TWITTER_REDIRECT_URL="${APP_URL}/twitter/login/callback"

   SCOUT_DRIVER=algolia
   SCOUT_QUEUE=true
   ```

3. Load project dependencies with [composer](https://getcomposer.org).

   ```
   $ composer install
   ```

4. Run migrations.

   ```
   $ php artisan migrate
   ```

5. Generate an `APP_KEY`.

   ```
   $ php artisan key:generate
   ```

6. Serve project files with artisan.

   ```
   $ php artisan serve
   ```

7. Inspect jobs.

   ```
   $ php artisan queue:work --timeout=0
   ```



## Example Pages

| Video Player |
|:---:|
![Preview](https://ucarecdn.com/ec3baa00-4226-4c9b-a0ff-3789c1515528/videoPlayer.png)

| Credit Card Server Side Validation & Storage with Braintree |
|:---:|
![Preview](https://ucarecdn.com/8ed238a4-2cab-47fe-9422-84a88a2205c5/payments.png)