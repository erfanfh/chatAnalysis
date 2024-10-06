<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show raw source</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.5.6/jsoneditor.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
<div id="json-output"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.5.6/jsoneditor.min.js"></script>
<script>
    var container = document.getElementById("json-output");
    var options = {
        mode: 'view',
        mainMenuBar: false,
        navigationBar: false
    };

    var jsonData = @json($static);
    var editor = new JSONEditor(container, options);
    editor.set(jsonData);
</script>
</body>
</html>
