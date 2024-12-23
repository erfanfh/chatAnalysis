<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Telegram Chat Analyser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="px-5">
    <h1 class="text-center mt-3">Analysis Result</h1>

    <div class="py-5">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Number of messages</th>
            </tr>
            </thead>
            <tbody>
            @php($i = 1)
            <tr>
                <th scope="row"> - </th>
                <td>Total</td>
                <td>{{ collect($total)->sum('messages') }}</td>
            </tr>
            @foreach(collect($total) as $key => $user)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $key }}</td>
                    <td>{{ $user['messages'] }}</td>
                </tr>
                @php($i++)
            @endforeach
            </tbody>
        </table>
    </div>

    <hr>
    <div id="app" class="my-4">
        <h2 class="pt-5">Chart by months</h2>
        <div class="d-flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#495057"
                 class="bi bi-question-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path
                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
            </svg>
            <p class="fs-6 text-light-emphasis">This graph shows the dispersion of the number of chat messages in the
                months of a year.</p>
        </div>
        {!! $monthMessagesChart->container() !!}
    </div>
    <hr>
    <div id="app" class="my-4">
        <h2 class="">Chart by years</h2>
        <div class="d-flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#495057"
                 class="bi bi-question-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path
                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
            </svg>
            <p class="fs-6 text-light-emphasis">This graph shows the dispersion of the number of chat messages over the
                years.</p>
        </div>
        {!! $yearMessagesChart->container() !!}
    </div>
    <hr>
    <div id="app" class="my-4">
        <h2 class="">Chart by days</h2>
        <div class="d-flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#495057"
                 class="bi bi-question-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path
                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
            </svg>
            <p class="fs-6 text-light-emphasis">This graph shows the dispersion of the number of chat messages over the
                years.</p>
        </div>
        {!! $dayMessagesChart->container() !!}
    </div>
    <hr>
    <div id="app" class="my-4">
        <h2 class="">Chart by type</h2>
        <div class="d-flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#495057N"
                 class="bi bi-question-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path
                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
            </svg>
            <p class="fs-6 text-light-emphasis">This graph shows the variety of types of sent messages.</p>
        </div>
        {!! $typeMessages->container() !!}
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $monthMessagesChart->script() !!}
{!! $typeMessages->script() !!}
{!! $yearMessagesChart->script() !!}
{!! $dayMessagesChart->script() !!}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
