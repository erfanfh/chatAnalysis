<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Telegram Analysis Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <form class="container d-flex align-items-center flex-column mt-5" method="post" action="{{ route('check') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 w-100">
            <label for="jsonFile" class="form-label fw-lighter fs-1">Upload .json File <span class="text-danger">(Recommended)</span></label>
            <input class="form-control" type="file" id="jsonFile" name="jsonFile">
            <div class="fs-6 text-light-emphasis">Max: 128MB</div>
        </div>
        @error('jsonFile')
            <div class="text-danger w-100">{{ $message }}</div>
        @enderror
        <span class="fw-lighter fs-1 text-center py-5">OR</span>
        <div class="mb-3 w-100">
            <label for="jsonText" class="form-label fw-lighter fs-1">Paste Json Text</label>
            <textarea class="form-control" id="jsonText" name="json" rows="15"
                      placeholder="{
    'name': 'Chat Analysis',
    'type': 'private_chat',
    'id': 4584340972,
    'messages': [
    {
        'id': 277647,
        'type': 'message',
        'date': '2024-10-06T14:26:28',
        'date_unixtime': '1728212188',
        'from': 'Human',
        'from_id': 'user223170235',
        'text': 'Hello World!',
        'text_entities': [
        {
        'type': 'plain',
        'text': 'Hello World!'
        }
      ]
    }
  ]
}"
            ></textarea>
            <div class="fs-6 text-light-emphasis">Max: 128MB</div>

        </div>
        <div class="mb-3 w-100">
            <button class="btn btn btn-outline-primary w-100" type="submit" name="submit" value="graph">Show Graph
                Analysis
            </button>
        </div>
        <div class="mb-3 w-100">
            <button class="btn btn btn-outline-primary w-100" type="submit" name="submit" value="raw">Show full raw
                file (more details)
            </button>
        </div>
        <div class="mb-3 w-100">
            <button class="btn btn btn-outline-primary w-100" type="submit" name="submit" value="file">Download full raw
                file
            </button>
        </div>
    </form>
    @if(session()->has('error'))
        <div class="alert alert-danger text-center fs-5">{{ session('error') }}</div>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
