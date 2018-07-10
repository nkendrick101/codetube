# Codetube

A lighweight YouTube clone built around Laravel and Vue.js.


## Local development

1. Grab latest source from git.

   ```
   $ git clone https://github.com/filemonmateus/codetube.git
   ```

2. Setup environment variables.

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
![Preview](https://ucarecdn.com/ec3baa00-4226-4c9b-a0ff-3789c1515528/videoPlayer.png)

| Credit Card Server Side Validation & Storage with Braintree |
|:---:|
![Preview](https://ucarecdn.com/8ed238a4-2cab-47fe-9422-84a88a2205c5/payments.png)

| Premium Subscription |
|:---:|
![Preview](https://ucarecdn.com/a3e87bef-de43-424f-9a06-ed1887dc672f/premiumSubscription.png)