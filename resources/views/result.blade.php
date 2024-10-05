<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Telegram Chat Analyser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 style="text-align: center">Analysis Result</h1>
<div class="container-fluid">
    <div class="row">
        @foreach(collect($total) as $key => $user)
            <h3 class="col-3 border border-secondary">
                {{ $key }} : {{ $user['messages'] }}
            </h3>
        @endforeach
    </div>
</div>


<div id="app">
    <h2>Chart by months</h2>
    {!! $monthMessagesChart->container() !!}
</div>
<div id="app">
    <h2>Chart by years</h2>
    {!! $yearMessagesChart->container() !!}
</div>
<div id="app">
    <h2>Chart by type</h2>
    {!! $typeMessages->container() !!}
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $monthMessagesChart->script() !!}
{!! $typeMessages->script() !!}
{!! $yearMessagesChart->script() !!}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
