
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="keywords" content="Login, log-in, log in, aml, idlc aml, mutual fund, aml login"/>
        <meta name="description" content="Log-in to your account for IDLC Mutual Funds at IDLC Asset Management Limited"/>
        <meta name="robots" content="index,follow"/>

        <title>IDLC AML - Login</title>

        <link href="{{ asset('division/css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{ asset('division/css/style.css')}}" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <script type="text/javascript">
            var baseURL = '{{ url("/") }}';
            </script>
    </head>
    <body>
        <div class="col-md">
    	   @yield('section')            
        </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="{{ asset('division/js/divisionDelete.js') }}" type="text/javascript"></script>
        <script src="{{ asset('division/js/thana.js') }}" type="text/javascript"></script>
    </body>
</html>
