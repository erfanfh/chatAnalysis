<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Telegram Analysis Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<form class="container d-flex align-items-center flex-column mt-5" method="post" action="{{ route('check') }}">
    @csrf
    <div class="mb-3 w-100">
        <label for="jsonText" class="form-label">Json Text</label>
        <textarea class="form-control" id="jsonText" name="json" rows="15"></textarea>
    </div>
    <div class="mb-3 w-100">
        <button class="btn btn btn-outline-primary w-100" type="submit" name="submit" value="graph">Show Graph Analysis</button>
    </div>
    <div class="mb-3 w-100">
        <button class="btn btn btn-outline-primary w-100" type="submit" name="submit" value="raw">Show full raw file</button>
    </div>
    <div class="mb-3 w-100">
        <button class="btn btn btn-outline-primary w-100" type="submit" name="submit" value="file">Download full raw file</button>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
