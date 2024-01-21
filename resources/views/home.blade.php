<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
    <form action="/api/video/upload" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="video" id="" accept="video">
        <button type="submit">Upload</button>
    </form>
</body>
</html>