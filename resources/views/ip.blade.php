<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="p-10">

    <div class="text-center mb-5">
        <div class="text-2xl">{{ $ip }}</div>
        <div>{{ $forecast->location_name }}</div>
        <div><a href="{{ route('forecast.index') }}" class="text-[10px] uppercase text-gray-400 hover:underline">&laquo; Search again</a></div>
    </div>

    @if(!count($forecast->forecast5Days))

        <div class="text-center">No data as of yet!</div>

    @else

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-{{ count($forecast->forecast5Days) >= 5 ? 5 : 3 }} gap-5 justify-center">


        @foreach($forecast->forecast5Days as $day)

            <div class="border border-blue-200 p-5 text-center rounded shadow-lg shadow-blue-500/30">
                <div class="font-bold">{{ $day->date->isToday() ? 'Today' : $day->date->format('l') }}</div>

                <div class="text-[10px] text-gray-400 mb-5">{{ $day->date->format('d M Y') }}</div>

                @if($day->icon)
                <div class="flex justify-center"><img src="{{ $day->icon }}" loading="lazy" /></div>
                @endif

                <div class="text-3xl font-bold mt-5">{{ number_format($day->maxtemp_c, 1) }}&deg;</div>

                @if($day->condition_text)
                <div>{{ $day->condition_text }}</div>
                @endif
            </div>
        @endforeach
    </div>


    <div class="flex flex-col space-y-2 items-end mt-10">
        <div class="uppercase text-[10px] text-gray-400">Powered By</div>

        <div>
        @if(config('ecce-weather-forecast.provider') == 'open-meteo')
            <div class="flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-cloud-sun me-2" viewBox="0 0 16 16">
                <path d="M7 8a3.5 3.5 0 0 1 3.5 3.555.5.5 0 0 0 .624.492A1.503 1.503 0 0 1 13 13.5a1.5 1.5 0 0 1-1.5 1.5H3a2 2 0 1 1 .1-3.998.5.5 0 0 0 .51-.375A3.502 3.502 0 0 1 7 8zm4.473 3a4.5 4.5 0 0 0-8.72-.99A3 3 0 0 0 3 16h8.5a2.5 2.5 0 0 0 0-5h-.027z"></path>
                <path d="M10.5 1.5a.5.5 0 0 0-1 0v1a.5.5 0 0 0 1 0v-1zm3.743 1.964a.5.5 0 1 0-.707-.707l-.708.707a.5.5 0 0 0 .708.708l.707-.708zm-7.779-.707a.5.5 0 0 0-.707.707l.707.708a.5.5 0 1 0 .708-.708l-.708-.707zm1.734 3.374a2 2 0 1 1 3.296 2.198c.199.281.372.582.516.898a3 3 0 1 0-4.84-3.225c.352.011.696.055 1.028.129zm4.484 4.074c.6.215 1.125.59 1.522 1.072a.5.5 0 0 0 .039-.742l-.707-.707a.5.5 0 0 0-.854.377zM14.5 6.5a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"></path>
            </svg>
            <span>Open-Meteo</span>
            </div>


        @else
            <img src="https://cdn.weatherapi.com/v4/images/weatherapi_logo.png" loading="lazy" class="h-8">

        @endif
        </div>


    </div>

    @endif

</body>

</html>

