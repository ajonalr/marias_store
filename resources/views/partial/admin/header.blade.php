<div class="header-area">
   <div class="row align-items-center">
      <!-- nav and search button -->
      <div class="col-md-6 col-sm-8 clearfix">
         <div class="nav-btn pull-left">
            <span></span>
            <span></span>
            <span></span>
         </div>
         <div class="search-box pull-left">

         </div>
      </div>
      <!-- profile info & task notification -->
      <div class="col-md-6 col-sm-4 clearfix">
         <ul class="notification-area pull-right">
            <li id="full-view"><i class="fa fa-window-maximize" aria-hidden="true"></i></li>
            <li id="full-view-exit"><i class="fa fa-window-minimize" aria-hidden="true"></i></li>
            <li class="dropdown">

               <i class="fa fa-comment" aria-hidden="true" data-toggle="dropdown">
                  <span>2</span>
               </i>
               <div class="dropdown-menu bell-notify-box notify-box">
                  <span class="notify-title">{{Auth::user()->name}}<a href="#">{{Auth::user()->role->short_code}}</a></span>
                  <div class="nofity-list">
                     <a href="#" class="notify-item">
                        <div class="notify-thumb"><i class="fa fa-money" aria-hidden="true"></i></div>
                        <div class="notify-text">
                           <form action="{{route('caja.movimientos_dia')}}" method="post">
                              @csrf
                              <div class="form-group">

                                 <?php
                                 $hoy = date('d/m/Y');
                                 ?>
                                 <input type="hidden" name="fecha" class="form-control" value="{{$hoy}}">
                              </div>


                              <button type="submit" class="btn btn-dark"><i class="fa fa-print" aria-hidden="true"></i> MOVIEMITOS DE HOY</button>
                           </form>
                        </div>
                     </a>
                     <a href="#" class="notify-item">
                        <div class="notify-thumb"><i class="fas fa-hand-paper    "></i></div>
                        <div class="notify-text">
                           <form action="{{route('logout')}}" method="post">
                              @csrf
                              <button type='submit' class='btn btn-danger' onclick="return confirm('Esta Seguro de Cerrar Sesion?')" ><i class='fa fa-trash' aria-hidden='true'></i> CERRAR SESION</button>
                           </form>
                        </div>
                     </a>

                  </div>
               </div>
            </li>

         </ul>
      </div>
   </div>
</div>