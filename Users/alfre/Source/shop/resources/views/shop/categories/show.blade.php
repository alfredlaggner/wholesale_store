@component('layouts.master')

    @slot('title')
        {{ $category['name'] }} - {{ config('app.name') }}
    @endslot

    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('shop') }}">Shop</a></li>
                @if ($parentCategory['parent_id'] > 0)
                    <li>...</li>
                @endif
                @if ($parentCategory)
                    <li>
                        <a href="{{ route('shop.category', [$parentCategory['uri'], $parentCategory['id']]) }}">{{ $parentCategory['name'] }}</a>
                    </li>
                @endif
                <li class="active">{!! $category['name'] !!}</li>
            </ol>

            <h1>
                {!! $category['name'] !!} <small class="text-muted">({{ $products->total() }})</small>

                <span class="pull-right">
                    <div class="btn-group">
                        <a href="{{ route('shop.category', ['uri' => $category['uri'], 'category' => $category['id'], 'sort' => request()->get('sort'), 'order' => request()->get('order')]) }}" class="btn btn-default{{ request()->get('display') == 'list' ? '' : ' active' }}" title="Display items in a grid view"><i class="fa fa-th-large"></i></a>
                        <a href="{{ route('shop.category', ['uri' => $category['uri'], 'category' => $category['id'], 'display' => 'list', 'sort' => request()->get('sort'), 'order' => request()->get('order')]) }}" class="btn btn-default{{ request()->get('display') == 'list' ? ' active' : '' }}" title="Display items in a list view"><i class="fa fa-th-list"></i></a>
                    </div>

                    <div class="dropdown" style="display: inline-block;">
                        <a id="sort" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="btn btn-default">
                            <i class="fa fa-sort-alpha-asc"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="sort">
                            <li{!! request()->get('sort') == 'date' && request()->get('order') == 'desc' ? ' class="active"' : '' !!}>
                                <a href="{{ route(Route::currentRouteName(), ['uri' => $category['uri'], 'category' => $category['id'], 'display' => request()->get('display'), 'sort' => 'date', 'order' => 'desc']) }}" tabindex="-1" title="Sort by Date - Newest first">Date - New to Old</a>
                            </li>
                            <li{!! request()->get('sort') == 'date' && request()->get('order') == 'asc' ? ' class="active"' : '' !!}>
                                <a href="{{ route(Route::currentRouteName(), ['uri' => $category['uri'], 'category' => $category['id'], 'display' => request()->get('display'), 'sort' => 'date', 'order' => 'asc']) }}" tabindex="-1" title="Sort by Date - Oldest first">Date - Old to New</a>
                            </li>
                            <li{!! request()->get('sort') == 'price' && request()->get('order') == 'asc' ? ' class="active"' : '' !!}>
                                <a href="{{ route(Route::currentRouteName(), ['uri' => $category['uri'], 'category' => $category['id'], 'display' => request()->get('display'), 'sort' => 'price', 'order' => 'asc']) }}" tabindex="-1" title="Sort by Price - Lowest first">Price - Low to High</a>
                            </li>
                            <li{!! request()->get('sort') == 'price' && request()->get('order') == 'desc' ? ' class="active"' : '' !!}>
                                <a href="{{ route(Route::currentRouteName(), ['uri' => $category['uri'], 'category' => $category['id'], 'display' => request()->get('display'), 'sort' => 'price', 'order' => 'desc']) }}" tabindex="-1" title="Sort by Price - Highest first">Price - High to Low</a>
                            </li>
                            <li{!! request()->get('sort') == 'name' && request()->get('order') == 'asc' ? ' class="active"' : '' !!}>
                                <a href="{{ route(Route::currentRouteName(), ['uri' => $category['uri'], 'category' => $category['id'], 'display' => request()->get('display'), 'sort' => 'name', 'order' => 'asc']) }}" tabindex="-1" title="Sort by Product Name - A to Z">Name - A to Z</a>
                            </li>
                            <li{!! request()->get('sort') == 'name' && request()->get('order') == 'desc' ? ' class="active"' : '' !!}>
                                <a href="{{ route(Route::currentRouteName(), ['uri' => $category['uri'], 'category' => $category['id'], 'display' => request()->get('display'), 'sort' => 'name', 'order' => 'desc']) }}" tabindex="-1" title="Sort by Product Name - Z to A">Name - Z to A</a>
                            </li>
                        </ul>
                    </div>
                </span>
            </h1>
        </div>
    </div>

    <!-- Product Listing -->
    @if ($products->total() > 0)
        @if (request()->get('display') == 'list')
            @include('shop.products.list_list')
        @else
            @include('shop.products.list_grid')
        @endif
    @else
        <div class="alert alert-warning">There are no products in this category at the present.</div>
    @endif

    <!-- Pagination -->
    <div class="row">
        <div class="col-md-12">
            {{ $products->appends(['display' => request()->get('display'), 'sort' => request()->get('sort'), 'order' => request()->get('order')])->links() }}
        </div>
    </div>

@endcomponent