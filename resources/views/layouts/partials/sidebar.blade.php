{{-- sidebar.blade.php --}}
@php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$menu = config('adminlte.menu');

function filterMenu($items, $user) {
$filtered = [];
foreach ($items as $item) {
// Skip item if 'permission' is set and user doesn't have it
if (isset($item['permission']) && !$user->can($item['permission'])) {
continue;
}

// If item has children, filter them recursively
if (isset($item['children']) && is_array($item['children'])) {
$item['children'] = filterMenu($item['children'], $user);
if (empty($item['children'])) {
continue;
}
}

$filtered[] = $item;
}
return $filtered;
}

$menu = filterMenu($menu, $user);
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard') }}" class="brand-link text-decoration-none">
            <span class="fw-bold fs-6 text-dark">
                  School <span class="text-primary">Management</span>
                  <span class="text-success">System</span>
            </span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
            <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        @foreach ($menu as $item)
                        @php
                        $hasChildren = isset($item['children']) && count($item['children']) > 0;
                        $label = $item['text'] ?? $item['label'] ?? ($item['header'] ?? '');
                        $url = $item['url'] ?? '#';
                        $icon = $item['icon'] ?? 'far fa-circle';

                        // Active state check
                        $isActive = request()->is(trim($url, '/').'*');
                        $menuOpen = $hasChildren && collect($item['children'])->contains(function ($child) {
                        return request()->is(trim($child['url'] ?? '', '/').'*');
                        });
                        @endphp

                        {{-- Header --}}
                        @if(isset($item['header']))
                        <li class="nav-header">{{ $item['header'] }}</li>
                        @continue
                        @endif

                        <li
                              class="nav-item {{ $hasChildren ? 'has-treeview' : '' }} {{ $menuOpen ? 'menu-open' : '' }}">
                              <a href="{{ $hasChildren ? '#' : url($url) }}"
                                    class="nav-link {{ $isActive || $menuOpen ? 'active' : '' }}">
                                    <i class="nav-icon {{ $icon }}"></i>
                                    <p>
                                          {{ $label }}
                                          @if($hasChildren)
                                          <i class="right fas fa-angle-left"></i>
                                          @endif
                                    </p>
                              </a>

                              {{-- Children --}}
                              @if($hasChildren)
                              <ul class="nav nav-treeview">
                                    @foreach ($item['children'] as $child)
                                    @php
                                    $childLabel = $child['text'] ?? $child['label'] ?? '';
                                    $childUrl = $child['url'] ?? '#';
                                    $childIcon = $child['icon'] ?? 'far fa-circle';
                                    $childActive = request()->is(trim($childUrl, '/').'*');
                                    @endphp
                                    <li class="nav-item">
                                          <a href="{{ url($childUrl) }}"
                                                class="nav-link {{ $childActive ? 'active' : '' }}">
                                                <i class="nav-icon {{ $childIcon }}"></i>
                                                <p>{{ $childLabel }}</p>
                                          </a>
                                    </li>
                                    @endforeach
                              </ul>
                              @endif
                        </li>
                        @endforeach
                  </ul>
            </nav>
      </div>
</aside>