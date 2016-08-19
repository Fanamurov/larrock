<div class="nav-left">
        <!-- Menu toggle for mobile version -->
    <button class="action action--open" aria-label="Open Menu">Открыть меню</button>
    <!-- Menu -->
    <nav id="ml-menu" class="menu">
        <!-- Close button for mobile version -->
        <button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>
        <div class="menu__wrap">
            <?$count=0;?>
            <ul data-menu="main" class="level-1 menu__level list-unstyled @if(null === Route::current()->parameter('categoryId')) menu__level--current @endif">
                @foreach($menu[1] as $key => $data_value)
                    <?$count++;?>
                    <li class="menu__item"><a class="menu__link" data-submenu="submenu-{{ (string)$data_value->Id }}" href="#">{{ (string)$data_value->Name }}</a></li>
                @endforeach
            </ul>
            @foreach($menu[2] as $key => $data_value)
                    <?$count++;?>
                @if($key === Route::current()->parameter('categoryId') OR $data_value[0]->ParentId === Route::current()->parameter('categoryId'))
                    <?$inner_options = TRUE;?>
                @endif
                <ul data-menu="submenu-{{ $key }}" class="level-2 menu__level
                @if($key === Route::current()->parameter('categoryId') OR $data_value[0]->ParentId === Route::current()->parameter('categoryId')) <?$inner_options = TRUE;?> menu__level--current @endif
                @foreach($data_value as $value_item)@if(Route::current()->parameter('categoryId') === $value_item->Id) <?$inner_options = TRUE;?> menu__level--current @endif @endforeach">
                    @foreach($data_value as $value_item)
                        @if($value_item->IsParent !== 'true')
                            <li class="menu__item"><a class="menu__link @if(Route::current()->parameter('categoryId') === $value_item->Id) current <?$inner_options = TRUE;?> @endif" href="/otapi/{{ (string)$value_item->Id }}">{{ (string)$value_item->Name }}</a></li>
                        @else
                            <li class="menu__item"><a class="menu__link" data-submenu="submenu-{{ (string)$value_item->Id }}" href="#">{{ (string)$value_item->Name }}</a></li>
                        @endif
                    @endforeach
                </ul>
            @endforeach
            @foreach($menu[3] as $key => $data_value)
                    <?$count++;?>
                @if($key === Route::current()->parameter('categoryId')) <?$inner_options = TRUE;?> @endif
                    @foreach($data_value as $value_item)@if(Route::current()->parameter('categoryId') === $value_item->Id) <?$inner_options = TRUE;?> @endif @endforeach
                <ul data-menu="submenu-{{ $key }}" class="level-3 menu__level @if($key === Route::current()->parameter('categoryId')) menu__level--current @endif
                        @foreach($data_value as $value_item)@if(Route::current()->parameter('categoryId') === $value_item->Id) menu__level--current @endif @endforeach">
                    @foreach($data_value as $value_item)
                        <li class="menu__item"><a class="menu__link @if(Route::current()->parameter('categoryId') === $value_item->Id) current @endif" data-submenu="submenu-{{ (string)$value_item->Id }}" href="/otapi/{{ (string)$value_item->Id }}">{{ (string)$value_item->Name }}</a></li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </nav>
</div>

@section('scripts')
    <script src="/_assets/tbkhv/_js/modernizr-custom.js" type="text/javascript"></script>
    <script src="/_assets/tbkhv/_js/classie.js" type="text/javascript"></script>
    <script src="/_assets/tbkhv/_js/menu.js" type="text/javascript"></script>
    <script>
        (function() {
            var menuEl = document.getElementById('ml-menu'),
                    mlmenu = new MLMenu(menuEl, {
                        breadcrumbsCtrl : false, // show breadcrumbs
                        initialBreadcrumb : 'Главная', // initial breadcrumb text
                        backCtrl : true, // show back button
                        @if(isset($inner_options))
                            current: {{ $count }}
                        @else
                                current: 0
                        @endif
                        // itemsDelayInterval : 60, // delay between each menu item sliding animation
                        //onItemClick: loadDummyData // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
                    });

            // mobile menu toggle
            var openMenuCtrl = document.querySelector('.action--open'),
                    closeMenuCtrl = document.querySelector('.action--close');

            openMenuCtrl.addEventListener('click', openMenu);
            closeMenuCtrl.addEventListener('click', closeMenu);

            function openMenu() {
                classie.add(menuEl, 'menu--open');
            }

            function closeMenu() {
                classie.remove(menuEl, 'menu--open');
            }
            @if(isset($inner_options))
                document.querySelector('.menu__back--hidden').style.setProperty('display', 'block!');
            @endif
        })();

        $(document).ready(function(){
            @if(isset($inner_options))
                $('.menu__back--hidden').removeClass('menu__back--hidden');
            @endif
            $('.menu__link').click(function () {
                $('.nav-left').find('.menu__level').css('top', '50px');
            });
        });
    </script>
@endsection