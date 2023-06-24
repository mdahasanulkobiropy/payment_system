
<!doctype html>
<html lang="en">

@include('dashboard.includes.head')

<body>
	<!--wrapper-->
	<div class="wrapper">

        @if (empty(Auth::user()->id))

        @elseif(Auth::user()->status == '1')
            @include('dashboard.includes.sidebar-wrapper')
            @include('dashboard.includes.header')
        @endif
		<!--start header -->
		<!--end header -->
		<!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        @if (empty(Auth::user()->id))

        @elseif(Auth::user()->status == '0')
            <div class="page-content text-center">
                <h2>Your status is Pandding . Wait Untill Admin Approve!</h2>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="btn btn"></i><span>Logout</span></button>
                </form>
            </div>
        @endif
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
        @include('dashboard.includes.footer')
	</div>
	<!--end wrapper-->
	<!--start switcher-->
    @include('dashboard.includes.switcher')
	<!-- Bootstrap JS -->
    @include('dashboard.includes.js')
</body>

</html>
