<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="p-10">

    @if ($errors->any())
    <div class="bg-red-800 text-white py-2 px-5 rounded shadow-lg shadow-red-500/20 text-sm mb-10">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <section class="w-5/12 mx-auto">

        <form action="{{ route('forecast.post') }}" method="post" class="flex items-end">
            <div class="grow">
                <label class="text-[10px] uppercase text-gray-400 text-center block mb-2">SAVE IP ADDRESS</label>
                <input type="text" class="border border-blue-100 h-14 px-3 w-full text-center text-lg rounded shadow-sm outline-none focus:border-blue-400 focus:shadow-blue-500/50 focus:shadow" placeholder="0.0.0.0" name="ip" value="{{ old('ipx') }}" required />
            </div>
            <button type="submit" class="block border border-blue-100 h-14 w-24 px-3 ml-3 text-center text-lg rounded shadow-sm bg-gray-100 hover:bg-gray-200">Save</button>
            @csrf
        </form>

        <form action="{{ route('forecast.post') }}" method="post" class="flex items-end mt-5">
            <div class="grow">
                <label class="text-[10px] uppercase text-gray-400 text-center block mb-2">CHOOSE EXISTING IP</label>
                <select class="border border-blue-100 h-14 px-3 w-full text-center text-lg rounded shadow-sm outline-none focus:border-blue-400 focus:shadow-blue-500/50 focus:shadow" name="ip" required />
                    <option value=""></option>
                    @foreach($ips as $ip)
                    <option value="{{ $ip['ip_address'] }}">{{ $ip['ip_address'] }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="block border border-blue-100 h-14 w-24 px-3 ml-3 text-center text-lg rounded shadow-sm bg-gray-100 hover:bg-gray-200">Show</button>
            @csrf
        </form>



    </section>





</body>

</html>
