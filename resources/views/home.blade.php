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
        @if(session()->has('error'))
            <div class="alert alert-danger text-center fs-5">{{ session('error') }}</div>
        @endif
        @csrf
        <div class="mb-3 w-100">
            <label for="jsonFile" class="form-label fw-lighter fs-1">Upload .json File <span class="text-danger">(Recommended)</span></label>
            <input class="form-control" type="file" id="jsonFile" name="jsonFile">
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
        </div>

        <span class="fw-lighter fs-1 text-center py-5">OR</span>
        <div class="mb-5 w-100">
            <div class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
                </svg>
                <div class="fw-lighter fs-1">
                    Setup your own self-hosted server
                </div>
            </div>
            <div class="fs-6 text-light-emphasis">
                If the chat you wanna analysis is <span class="text-danger-emphasis">bigger than 15MB</span> you should use your own server on your local system  cause our online server cannot handle your request.
                <br>
                We suggest to use this method if you're a bit familiar with setting up apache server, though a full step-by-step guide is described in github page.
                <br>
                Check the application document for setup your own self-hosted application.
                <br>
                <span class="fw-medium fs-5">Want to setup now?</span>
                <br>
                Check our Github! <a href="https://github.com/erfanfh/chatAnalysis">Documentation</a>
            </div>
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
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
