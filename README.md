Laravel Hashids
===============

### 添加到 app.php

```php
Lingxi\Hashids\HashidsServiceProvider::class
```

```php
'Hashids' => Lingxi\Hashids\Facades\Hashids::class
```

### Config

```bash
php artisan vendor:publish
```

### Middleware

添加中间件

```php
\Lingxi\Hashids\Middleware\DecodePublicIdMiddleware::class,
```

在 config/hashids.php 中去配置需要解密的路由参数以及请求参数

### Model

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Lingxi\Hashids\ModelTraits\PublicId;

class Post extends Model
{
    use PublicId;

    public function comments()
    {
        return $this->morphMany(\App\Comment::class, 'commentable');
    }
}
```

Then, get public id.

```php
Post::first()->public_id
```

### Debug

    php artisan id:en 1 --uri=p

    php artisan id:de sdfghjkla;sdjhasjhdfgahjsdjasd
