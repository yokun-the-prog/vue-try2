<!-- ユーザー管理用 -->
<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
        <p>ユーザー</p>
    </a>
</li>

<!-- 観光スポット管理用 -->
<li class="nav-item">
    <a href="{{ route('spots.index') }}"
       class="nav-link {{ Request::is('admin/spots*') ? 'active' : '' }}">
        <p>観光スポット</p>
    </a>
</li>

<!-- 旅程管理用 -->
<li class="nav-item">
    <a href="{{ route('tours.index') }}"
       class="nav-link {{ Request::is('admin/tours*') ? 'active' : '' }}">
        <p>みんなの旅程</p>
    </a>        
</li>            

<!-- いらない -->
<!-- <li class="nav-item">
    <a href="{{ route('destinations.index') }}"
       class="nav-link {{ Request::is('admin/destinations*') ? 'active' : '' }}">
        <p>目的地</p>
    </a>
</li> -->

<!-- いらない -->
<!-- <li class="nav-item">
    <a href="{{ route('photorallyDivisions.index') }}"
       class="nav-link {{ Request::is('admin/photorallyDivisions*') ? 'active' : '' }}">
        <p>Photorally Divisions</p>
    </a>                
</li>                 -->

<!-- いらない -->
<!-- <li class="nav-item">
    <a href="{{ route('transportDivisions.index') }}"
       class="nav-link {{ Request::is('admin/transportDivisions*') ? 'active' : '' }}">
        <p>Transport Divisions</p>
    </a>                
</li>                 -->

<!-- いらない -->
<!-- <li class="nav-item">
    <a href="{{ route('erratumDivisions.index') }}"
       class="nav-link {{ Request::is('admin/erratumDivisions*') ? 'active' : '' }}">
        <p>Erratum Divisions</p>
    </a>        
</li>         -->

<!-- タグ管理用 -->
<li class="nav-item">
    <a href="{{ route('tags.index') }}"
        class="nav-link {{ Request::is('admin/tags*') ? 'active' : '' }}">
    <p>タグ</p>   
</a>    
</li>        

<!-- 観光スポットへのタグ紐付け用 -->
<li class="nav-item">
    <a href="{{ route('spotTags.index') }}"
    class="nav-link {{ Request::is('admin/spotTags*') ? 'active' : '' }}">
    <p>観光地紐付きタグ</p>
</a>    
</li>    

<!-- いらない -->
<!-- <li class="nav-item">
    <a href="{{ route('spotFilepaths.index') }}"
    class="nav-link {{ Request::is('spotFilepaths*') ? 'active' : '' }}">
    <p>Spot Filepaths</p>
</a>    
</li>     -->

<!-- いらない -->
<!-- <li class="nav-item">
    <a href="{{ route('tourFilepaths.index') }}"
       class="nav-link {{ Request::is('tourFilepaths*') ? 'active' : '' }}">
        <p>Tour Filepaths</p>
    </a>            
</li>             -->
