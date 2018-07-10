# Codetube

A lighweight YouTube clone built around Laravel and Vue.js.


## Local development

1. Grab latest source from git.

   ```
   $ git clone https://github.com/filemonmateus/codetube.git
   ```

2. Setup your environment variables at .env.

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=database
   DB_USERNAME=username
   DB_PASSWORD=password

   MAIL_DRIVER=smtp
   MAIL_HOST=smtp.host
   MAIL_PORT=587
   MAIL_USERNAME=email
   MAIL_PASSWORD=password
   MAIL_ENCRYPTION=tls

   GOOGLE_CLOUD_PROJECT_ID=project_id
   GOOGLE_CLOUD_STORAGE_IMAGES_BUCKET=images_bucket
   GOOGLE_CLOUD_STORAGE_VIDEOS_BUCKET=videos_bucket
   GOOGLE_CLOUD_STORAGE_API_URI=https://storage.googleapis.com

   FFMPEG_BINARY=/path/to/ffmpeg/binary
   FFPROBE_BINARY=/path/to/ffprobe/binary
   FFMPEG_THREADS=12
   TIMEOUT=3600

   ALGOLIA_APP_ID=app_id
   ALGOLIA_SECRET=app_secret
   ```

3. Load project dependencies with [Composer](https://getcomposer.org/).

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

6. Start the server.

   ```
   $ php artisan serve.
   ```

7. Inspect jobs.

   ```
   $ php artisan queue:work --timeout=0
   ```



## Example Pages

| Video Player |
|:---:|
![Preview](https://ucarecdn.com/a4a1e70b-083a-42cb-804c-68826041dc11/videoPlayer.png)

| Premium Subscription With Braintree |
|:---:|
![Preview](https://ucarecdn.com/e7133d43-2bec-41f2-94e3-8bddd6b0b84a/premiumSubscriptions.png)

| Credit Card Server Side Validation & Storage with Braintree |
|:---:|
![Preview](https://ucarecdn.com/95d5fab8-5b3a-4591-bf02-994bb3066778/Payments.png)