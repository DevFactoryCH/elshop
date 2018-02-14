<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Elshop - @yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body class="w3-light-grey">
        <div class="w3-top">
          <div class="w3-bar w3-black w3-card">
            <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
            <a href="#" class="w3-bar-item w3-button w3-padding-large">ELSHOP</a>
            <div class="w3-dropdown-hover w3-hide-small">
              <button class="w3-padding-large w3-button" title="More">CATEGORY <i class="fa fa-caret-down"></i></button>     
              <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="#" class="w3-bar-item w3-button">Aspiro</a>
                <a href="#" class="w3-bar-item w3-button">Lave vaisselle</a>
                <a href="#" class="w3-bar-item w3-button">PQ</a>
              </div>
            </div>
            <a href="{{ route('login') }}" class="w3-padding-large w3-hover-red w3-hide-small w3-right" style="text-decoration: none"><i class="fa fa-lock"></i> LOGIN</a>
            <a href="{{ route('register') }}" class="w3-padding-large w3-hover-red w3-hide-small w3-right" style="text-decoration: none"><i class="fa fa-user"></i> REGISTER</a>
            <a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa-shopping-cart w3-margin-right"></i></a>
            <a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa fa-commenting-o"></i></a>
            <a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>
          </div>
        </div>
      <div style="width: 100%">
        <div class="w3-padding-64 w3-large w3-text-dark-grey" style="font-weight:bold;z-index:3;width:250px;float: left">
            <a href="#" class="w3-bar-item w3-button">Shirts</a><br>
            <a href="#" class="w3-bar-item w3-button">Dresses</a><br>
            <a href="#" class="w3-bar-item w3-button">Jackets</a><br>
            <a href="#" class="w3-bar-item w3-button">Gymwear</a><br>
            <a href="#" class="w3-bar-item w3-button">Blazers</a><br>
            <a href="#" class="w3-bar-item w3-button">Shoes</a><br>
        </div>
        <div style="float:left;margin-top: 72px;">
          Contenu
        </div>
      </div>
    </body>
</html>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body class="w3-light-grey">
        <div class="w3-top">
          <div class="w3-bar w3-black w3-card">
            <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
            <a href="#" class="w3-bar-item w3-button w3-padding-large">ELSHOP</a>
            <div class="w3-dropdown-hover w3-hide-small">
              <button class="w3-padding-large w3-button" title="More">CATEGORY <i class="fa fa-caret-down"></i></button>     
              <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="#" class="w3-bar-item w3-button">Aspiro</a>
                <a href="#" class="w3-bar-item w3-button">Lave vaisselle</a>
                <a href="#" class="w3-bar-item w3-button">PQ</a>
              </div>
            </div>
            <a href="{{ route('login') }}" class="w3-padding-large w3-hover-red w3-hide-small w3-right" style="text-decoration: none"><i class="fa fa-lock"></i> LOGIN</a>
            <a href="{{ route('register') }}" class="w3-padding-large w3-hover-red w3-hide-small w3-right" style="text-decoration: none"><i class="fa fa-user"></i> REGISTER</a>
            <a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa-shopping-cart w3-margin-right"></i></a>
            <a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa fa-commenting-o"></i></a>
            <a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>
          </div>
        </div>
      <div style="width: 100%">
        <div class="w3-padding-64 w3-large w3-text-dark-grey" style="font-weight:bold;z-index:3;width:250px;float: left">
            <a href="#" class="w3-bar-item w3-button">Shirts</a><br>
            <a href="#" class="w3-bar-item w3-button">Dresses</a><br>
            <a href="#" class="w3-bar-item w3-button">Jackets</a><br>
            <a href="#" class="w3-bar-item w3-button">Gymwear</a><br>
            <a href="#" class="w3-bar-item w3-button">Blazers</a><br>
            <a href="#" class="w3-bar-item w3-button">Shoes</a><br>
        </div>
        <div style="float:left;margin-top: 72px;">
          @yield('content')
        </div>
      </div>
    </body>
</html>
