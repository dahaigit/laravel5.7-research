
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册邮件</title>
</head>
<body>
mauto 欢迎 {{ $username }} 光临！
<img src="{{ $message->embedData('哇哈哈哈', 'wahaha') }}" />
</body>
</html>


