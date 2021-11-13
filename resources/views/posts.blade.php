<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>MyBlog</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/app.css">
        <script src="/app.js" ></script>

    </head>
    <body>
        <?php foreach ($posts as $post) :?>
            <article>
                <h1><a href="/posts/<?= $post->slug; ?>"><?= $post->title ;?></a></h1>

                <div>
                    <?= $post->excerpt ;?>
                </div>
            </article> 
        <?php endforeach; ?>
    </body>
</html>