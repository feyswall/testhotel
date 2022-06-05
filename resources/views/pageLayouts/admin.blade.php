<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	@include('_partials._head')
</head>
<!--
  HOW TO USE: 
  data-theme: default (default), dark, light, colored
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-layout: default (default), compact
-->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
	<div class="wrapper">
		<!-- sidebar -->
		@include('_partials._sideBar')

		<div class="main">
		<!-- top navigation -->
		@include('_partials._topNavigation')


			@yield('content')

			{{-- content --}}
			

			{{-- footer --}}
			@include('_partials._footer')
		</div>
	</div>

	<!-- down script -->
	@include('_partials._downScript')

	@yield('ourScript')
</body>

</html>