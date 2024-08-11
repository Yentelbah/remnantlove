<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    @if(Auth()->user()->role == "Admin")

    @include('layouts.partials.sidemenu.admin')

    @elseif(Auth()->user()->role == "SuperAdmin")

        @include('layouts.partials.sidemenu.super')

    @elseif(Auth()->user()->role == "Manager")

        @include('layouts.partials.sidemenu.teacher')


    @elseif(Auth()->user()->role == "Cashier")

        @include('layouts.partials.sidemenu.cashier')

    @endif

</ul>
