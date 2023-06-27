<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Url Shortener Site</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
</head>

<body>
    <div id="container">
        <form action="/" method="post">
            @csrf
            <h2>Url Shortener</h2>
            <div>
                <input type="text" name="urltext" id="urltext" class=""
                placeholder="Insert your Url here and press Enter" value="{{ old('urltext') }}">
            </div>
            @error('urltext')

            <!-- <div class="alert alert-danger">{{$message}}</div> -->
            <h3 class="error">{{$message}}</h3>

            @enderror
        </form>

        <!-- @if (Session::has('errors'))
            <h3 class="error">{{ $errors->first('link') }}</h3>
        @endif -->

        @if(Session::has('link'))
            <h3 class="success">{{ Session::get('link') }}</h3>
            <a href="{{ Session::get('link') }}"> Click here to get your shorterned url</a>
        @endif
        @if(Session::has('message'))
            <h3 class="error">{{ Session::get('message') }}</h3>
        @endif
    </div>
</body>

</html>