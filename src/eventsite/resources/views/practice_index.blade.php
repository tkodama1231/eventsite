

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>My BBS</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>My BBS</h1>
        <ul>
            {{-- <li><?php echo htmlspecialchars($posts[0], ENT_QUOTES, 'UTF-8'); ?></li> --}}
            <li>{{ $posts[0] }}</li>
            <li>{{ $posts[1] }}</li>
            <li>{{ $posts[2] }}</li>
        </ul>
    </div>

</body>
</html>
