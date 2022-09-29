<!-- Side Nav START -->
<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown">
                <a href="{{route('dashboard.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-pie-chart"></i>
                    </span>
                    <span class="title">Harga Pekerjaan</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{route('material.index')}}">Bahan Material</a>
                    </li>
                    <li>
                        <a href="{{route('tool.index')}}">Alat</a>
                    </li>
                    <li>
                        <a href="{{route('work.index')}}">Pekerjaan</a>
                    </li>
                    <li>
                        <a href="{{route('salary.index')}}">Upah Pekerjaan</a>
                    </li>
                    <li>
                        <a href="{{route('workers.index')}}">Harga Satuan Pekerjaan</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="{{route('rabs.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-read"></i>
                    </span>
                    <span class="title">RAB</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="{{route('overbudget.index')}}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dollar"></i>
                    </span>
                    <span class="title">Over Budget</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Side Nav END -->
