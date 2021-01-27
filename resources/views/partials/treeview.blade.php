<li class="nav-item has-treeview">
    <a href="#" class="nav-link 
      @if($segment==$type.'s') 
        active 
      @endif 
      ">
      <i class="nav-icon fas fa-{{$icon}} "></i>
      <p>
        @lang(ucfirst($type).'s')
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
        @foreach ($items as $item)
            <li class="nav-item">
                <a href="{{ $item['route']}} " class="nav-link">
                    <i class="fas fa-{{$item['icon']}} nav-icon "></i>
                    <p>@lang($item['command'])</p>
                </a>
            </li>
        @endforeach
    </ul>
</li>