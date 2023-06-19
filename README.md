## Tentang

Repo ini dibuat dengan library [tymon/jwt](https://jwt-auth.readthedocs.io/en/develop/).

## Installasi

pull atau clone repo ini kemudian jalan kan perintah
`composer install`

konfigurasikan file .env dan setting database kemudian lakukan migrasi dengan perintah
`php artisan migrate`

generate secret key dengan menjalankan perintah
`php artisan jwt:secret`

jalankan aplikasi dengan menjalankan perintah
`php artisan serve`

## Penggunaan

### Register

methode: POST
url: `/resgiter`

Lakukan register untuk mendaftarkan akun member dengan format JSON seperti ini

```javascript
{
    "nama":"Regen",
    "email":"ronaregen@gmail.com",
    "password":"password",
    "phone":628123456789,
    "hobbies":[
        {
            "hobby":"writting"
        },
        {
            "hobby":"reading"
        }
    ]
}
```

jika berhasil maka akan mendapat respon:

```javascript
{
    "message": "Registered Successfully"
}
```

Jika email sudah pernah didaftarkan akan muncul response

```javascript
{
    "email": [
        "The email has already been taken."
    ]
}
```

Jika data tidak lengkap makan akan mendapat respon berdasarkan data yang kurang, seperti contoh di bawah ini

```javascript
{
    "nama": [
        "The nama field is required."
    ],
    "password": [
        "The password field is required."
    ],
    "email": [
        "The email field is required."
    ],
    "phone": [
        "The phone field is required."
    ]
}
```

Jika Phone diisi dengan selain angka maka akan mendapat respon

```javascript
{
    "phone": [
        "The phone field must be an integer."
    ]
}
```

### Login

methode: POST
url: `/login`

Silakan login dengan menggunakan email dan password yang dibuat
jika berhasil login maka akan mendapat respon

```javascript
{
    "access_token": "your-token",
    "token_type": "bearer",
    "expires_in": 3600
}
```

jika gagal akan mendapat respon

```javascript
{
    "error": "Unauthorized"
}
```

### Me

methode: POST
url: `/me`

jika ingin melihat detail silakan lakukan request dengan menggunakan bearer-token dari token jwt yang didapat saat login

### Update

methode: POST
url: `/update`

Untuk mengupdate data user, silakan lakukan request dengan menggunakan bearer-token dan kirimkan json data yang akan diupdate, contoh

```javascript
{
    "nama":"Rona Regen",
    "phone":6289514492642
}
```

Jika berhasil akan mendapat respon

```javascript
{
    "message": "Updated Successfully"
}
```
