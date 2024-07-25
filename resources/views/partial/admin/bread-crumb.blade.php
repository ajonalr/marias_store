<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="breadcrumbs-area clearfix">
            <h4 class="page-title pull-left">BIENVENIDO</h4>
            <ul class="breadcrumbs pull-left">
                <li>ESPERAMOS TENGAS UN BUEN DIA !</li>
            
            </ul>
        </div>
    </div>
    <div class="col-sm-6 clearfix">
        <div class="user-profile pull-right">

            <?php

            $email = \Auth::user()->email;
            $default = "https://www.somewhere.com/homestar.jpg";
            $size = 40;

            $avt = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;

            ?>

            <img class="rounded-circle user-thumb mx-2" src="{{$avt}}" alt="avatar">
            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}} <i class="fa fa-angle-down"></i></h4>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Message</a>
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Log Out</a>
            </div>
        </div>
    </div>
</div>