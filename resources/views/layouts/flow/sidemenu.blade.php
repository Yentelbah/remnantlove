@if(Auth()->user()->email == "faithflow@yensoftgh.com" )

@include('layouts.flow.sidemenu.super')

@elseif(Auth()->user()->churchRole->role->id === 2 )

@include('layouts.flow.sidemenu.admin')

@elseif(Auth()->user()->churchRole->role->id === 3 )

@include('layouts.flow.sidemenu.branch')

@elseif(Auth()->user()->churchRole->role->id === 4 )

@include('layouts.flow.sidemenu.accountant')

@elseif(Auth()->user()->churchRole->role->id === 5 )

@include('layouts.flow.sidemenu.leader')

@elseif(Auth()->user()->churchRole->role->id === 6 )

@include('layouts.flow.sidemenu.cashier')

@elseif(Auth()->user()->churchRole->role->id === 7 )

@include('layouts.flow.sidemenu.user')

@endif
