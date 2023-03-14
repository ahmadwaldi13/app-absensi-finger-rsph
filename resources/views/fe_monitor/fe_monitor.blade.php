<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app" />
    <title> Antrian Farmasi</title>
    <script defer="defer" src="{{ asset('js/fe_monitor/index.js')}}"></script>
    <script>
        var base_url = "{{url('/')}}/";
        var data = JSON.parse('{!!json_encode($data)!!}');
        console.log(data);
    </script>
    <link href="{{asset('css/fe_monitor/index.css')}}" rel="stylesheet">
</head>

<body><noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>
</body>

<script src="{{ asset('js/antrian_farmasi/responsiveVoice.js') }}"></script>
</html>