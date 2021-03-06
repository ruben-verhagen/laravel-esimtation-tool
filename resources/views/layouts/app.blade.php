<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" ng-app="ofciApp" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" ng-app="ofciApp" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" ng-app="ofciApp" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" ng-app="ofciApp" class="no-js"> <!--<![endif]-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@section('title') OFCI Estimation @show</title>
    @section('meta_keywords')
        <meta name="keywords" content="ofci, estimation, flooring, web, app"/>
    @show @section('meta_author')
        <meta name="author" content="Ruben Verhagen"/>
    @show @section('meta_description')
        <meta name="description"
              content="Simple tool to make estimation of flooring services."/>
    @show

		<link href="{{ asset('css/site.css') }}" rel="stylesheet">
    <script>
      var SITE_URL = "{{ url('/') }}";
    </script>
    <script src="{{ asset('js/site.js') }}"></script>

    @yield('styles')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="{!! asset('assets/site/ico/favicon.ico')  !!} ">
</head>
<body data-ng-controller="AppCtrl">
@include('partials.nav')

<div class="container" ng-view>
@yield('content')
</div>
@include('partials.footer')

<!-- Scripts -->
@yield('scripts')

</body>
</html>
