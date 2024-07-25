<header id="header" class="header">
   <div class="header-menu">
      <div class="col-sm-7">
         <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
      </div>
      <div class="col-sm-5">
         <div class="user-area dropdown float-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <img class="user-avatar rounded-circle" src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" alt="{{config('app.name')}}">
            </a>
            <div class="user-menu dropdown-menu">
               <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="btn btn-info"><i class="fa fa-power-off"></i> Cerrar Sesion</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</header>