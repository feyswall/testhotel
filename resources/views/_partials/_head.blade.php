<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="main content">
<meta name="hospitalSolution" content="ok">
<meta name="keywords" content="admin">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}">
<link rel="canonical" href="pages-blank.html">
<link rel="canonical" href="tables-datatables-column-search.html">

@yield('title')

<link href="css2.css?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

<!-- Choose your prefered color scheme -->
<!-- <link href="css/dark.css" rel="stylesheet"> -->

<!-- BEGIN SETTINGS -->
<!-- Remove this after purchasing -->
<link  href="{{ asset('assets/css/light.css') }}" rel="stylesheet">
<link  href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
{{-- <link  href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet"> --}}
<link  href="{{ asset('assets/css/line-awesome.min.css') }}" rel="stylesheet">
{{-- <script src="{{ asset('assets/js/settings.js') }}"></script> --}}
<style>
    body {
        opacity: 1;
    }
</style>
<!-- END SETTINGS -->
{{-- <script async="" src="gtag/js.js?id=UA-120946860-10"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-120946860-10', { 'anonymize_ip': true });
</script> --}}
<script src="{{ asset('assets/js/vue.js') }}"></script>