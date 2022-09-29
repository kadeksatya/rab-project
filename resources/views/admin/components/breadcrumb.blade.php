<div class="page-header">
    <h2 class="header-title">{{$page_name}}</h2>
    <div class="header-sub-title">
        <nav class="breadcrumb breadcrumb-dash">
            <a href="{{route('dashboard.index')}}" class="breadcrumb-item"><i
                    class="anticon anticon-home m-r-5"></i>Home</a>
            @foreach ($breadcrumb as $item)
            <a class="breadcrumb-item" href="{{$item->link}}">{{$item->title}}</a>
            @endforeach
            <span class="breadcrumb-item active">{{$page_name}}</span>
        </nav>
    </div>
</div>
