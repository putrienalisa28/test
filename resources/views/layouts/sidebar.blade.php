@section('sidebar')


<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <!-- <li class="nav-label first">Main Menu</li> -->
            <li><a class="" href="javascript:void()" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <polygon fill="#000000" opacity="0.3" points="5 7 5 15 19 15 19 7" />
                            <path d="M11,19 L11,16 C11,15.4477153 11.4477153,15 12,15 C12.5522847,15 13,15.4477153 13,16 L13,19 L14.5,19 C14.7761424,19 15,19.2238576 15,19.5 C15,19.7761424 14.7761424,20 14.5,20 L9.5,20 C9.22385763,20 9,19.7761424 9,19.5 C9,19.2238576 9.22385763,19 9.5,19 L11,19 Z" fill="#000000" opacity="0.3" />
                            <path d="M5,7 L5,15 L19,15 L19,7 L5,7 Z M5.25,5 L18.75,5 C19.9926407,5 21,5.8954305 21,7 L21,15 C21,16.1045695 19.9926407,17 18.75,17 L5.25,17 C4.00735931,17 3,16.1045695 3,15 L3,7 C3,5.8954305 4.00735931,5 5.25,5 Z" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            @foreach($menuHeaders as $item)

            <li class="nav-label">{{$item->menuhdr_title}}</li>
            @foreach($item->subMenus as $sub_menu)
            <li>
                <a class="" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-circle" aria-hidden="true"></i>
                    <span class="nav-text">{{ $sub_menu->menudtl_title }}</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="index.html">Light</a></li>
                    <li><a href="index-2.html">Dark</a></li>
                    <li><a href="index-3.html">Mini Sidebar</a></li>
                    <li><a href="index-4.html">Sidebar</a></li>
                </ul>
            </li>
            @endforeach
            @endforeach
        </ul>
    </div>


</div>
@endsection