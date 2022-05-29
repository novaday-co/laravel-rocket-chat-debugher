# Laravel Rocket chat Debugher

### First you need to set your channel url to config/debugher.php
```php
        return [
            'end_point' => YOUR_ROCKET_CHAT_CHANNEL_URL_WITH_TOKEN,
            'channel_name' => YOUR_ROCKET_CHAT_CHANNEL_Name,
        ];
```

### Then you need to import Logger to Exceptions/Handler.php
```php
        use Novaday\Debugher\Logger;
```

### Finally, put the following code to Exceptions/Handler.php where ever you need to push log

```php
            resolve(Logger::class)
                ->fromUser(auth()->user())
                ->withIp(request()->ip())
                ->withException($exception)
                ->send();
```
