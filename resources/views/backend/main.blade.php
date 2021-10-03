<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @php $siteSetting = site_settings() @endphp
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" href="/favicon.ico">

    <meta name="description" content="" />
    <meta name="keywords" content="" />    
    <title>{{ $siteSetting->title }}</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">

    <link href="/css/owl.carousel.min.css" rel="stylesheet">
    <link href="/css/owl.theme.default.min.css" rel="stylesheet">
    <link href="/css/dashboard.min.css" rel="stylesheet">
    <link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- jQuery library -->
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script src="/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/js/apexcharts.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/menu.js"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'title' => $siteSetting->title,
            'company_address' => $siteSetting->company_address,
            'company_title' => $siteSetting->company_title,
            'website_logo' => $siteSetting->website_logo,
        ]) !!};
    </script>

    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title', $siteSetting->title)" />
    <meta property="og:description" content="@yield('description', $siteSetting->meta_description)" />
    <meta property="og:url" content="@yield('URL', env('APP_URL'))" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:image" content="@yield('image', env('APP_URL').'/storage/'.$siteSetting->website_logo)" />
    <meta property="og:image:secure_url" content="@yield('image', env('APP_URL').'/storage/'.$siteSetting->website_logo)" />
    <meta property="og:image:width" content="444" />
    <meta property="og:image:height" content="444" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="@yield('description', $siteSetting->meta_description)" />
    <meta name="twitter:title" content="@yield('title', $siteSetting->title)" />
    <meta name="twitter:image" content="@yield('image', env('APP_URL').'/storage/'.$siteSetting->website_logo)" />
    

    <meta property="fb:pages" content="" />
    <meta property="fb:app_id" content="" />

    <style>
      .file-upload-input { left: 0 ;}
      .sidenav{ height: 100vh; overflow-y: scroll; }
    </style>

    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
  </script>

  </head>

  <body>
    <noscript>
      <strong>We're sorry but this app doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <div id="app"></div>
    <!-- built files will be auto injected -->

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
      //Back to Top
      var btn = $('#back-top');
      $(window).scroll(function() {
          if ($(window).scrollTop() > 300) {
              btn.addClass('show');
          } else {
              btn.removeClass('show');
          }
      });
      btn.on('click', function(e) {
          e.preventDefault();
          $('html, body').animate({scrollTop:0}, '300');
      });
    </script>

  </body>
</html>
