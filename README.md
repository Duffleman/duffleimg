# duffleimg
Quick image sharing program for ShareX

**Inspired by starbs/yeh**

## Installation
1. Upload/deploy on a server
2. SSH in (or use command prompt)
3. Copy .env.example to .env
4. Run composer update
5. Build a database
6. Populate database information in .env (root directory)
7. Set an APP_KEY and your URL.
8. Run php artisan migrate in your console.
9. Open your database editor, alter the images table, set the image field to LONGBLOB instead of just BLOB.
10. Sit back and relax :)