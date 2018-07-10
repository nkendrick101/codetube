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
   MAIL_HOST=smtp.gmail.com
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

3. Install the dependencies with [Composer](https://getcomposer.org/).

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

## Expose the Application to the Wider Internet

Optionally, you can expose the application to the wider Internet using [ngrok](http://ngrok.com/) using `ngrok http <port>`. Once ngrok is running, open up your browser and go to your ngrok URL. It will look something like this: `http://<sub-domain>.ngrok.io`.


## Example Pages

| Video Player |
|:---:|
![Preview](https://ucarecdn.com/bac5e4ea-3248-4a1e-a692-cc0463b710df/videoplayer.png)

| Premium Subscription With Braintree |
|:---:|
![Preview](https://ucarecdn.com/1c56026a-1c96-4bd6-b9ad-c115aa6e5128/premiumsubscription.png)

| Credit Card Server Side Validation & Storage with Braintree |
|:---:|
![Preview](https://ucarecdn.com/93e16c88-c4b1-4f0d-93c8-29decae81767/storagevalidation.png)

| 2-Factor Aunthentication |
|:---:|
![Preview](https://ucarecdn.com/011b29bb-c7be-4604-be08-fe3dc260cfd8/2factorauthentication.png)