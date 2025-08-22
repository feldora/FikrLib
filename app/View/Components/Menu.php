<?php

namespace App\View\Components;

use App\Models\Menu as MenuModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * The menu model instance.
     *
     * @var \App\Models\Menu|null
     */
    public ?\App\Models\Menu $menu;

    /**
     * Whether the menu is responsive.
     *
     * @var bool
     */
    public bool $isResponsive;

    /**
     * Create a new component instance.
     *
     * @param  \App\Models\Menu|null  $menu
     * @param  bool  $isResponsive
     */
    public function __construct(?\App\Models\Menu $menu = null, bool $isResponsive = false)
    {
        $this->menu = $menu;
        $this->isResponsive = $isResponsive;
    }

    /**
     * Get the view / contents that represent the component.
     */
    /**
     * Get the menus based on user permissions
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getMenus()
    {
        try {
            if ($this->menu) {
                return $this->menu->children()
                    ->where('is_active', true)
                    ->orderBy('order')
                    ->get();
            }

            $query = MenuModel::where('is_active', true)
                ->whereNull('parent_id')
                ->orderBy('order');

            if (Auth::check()) {
                $user = Auth::user();
                $query->where(function($q) use ($user) {
                    $q->whereNull('permission')
                      ->orWhere(function($q) use ($user) {
                          $q->whereNotNull('permission')
                            ->whereIn('permission', $user->getPermissionNames());
                      });
                });
            } else {
                $query->whereNull('permission');
            }

            $menus = $query->get();
            
            // Filter out menus with undefined routes
            $filteredMenus = $menus->filter(function ($menu) {
                if (!$menu->route) {
                    return true; // Keep menu items without routes (like headers or separators)
                }
                
                if (!Route::has($menu->route)) {
                    Log::warning('Menu route not found', [
                        'menu_id' => $menu->id,
                        'menu_name' => $menu->name,
                        'route' => $menu->route,
                        'user_id' => Auth::id()
                    ]);
                    return false;
                }
                
                return true;
            });

            Log::debug('Menu fetched successfully', [
                'total_count' => $menus->count(),
                'filtered_count' => $filteredMenus->count(),
                'user_id' => Auth::id(),
                'is_responsive' => $this->isResponsive,
                'has_parent' => $this->menu ? true : false
            ]);
            
            return $filteredMenus;
        } catch (\Exception $e) {
            Log::error('Menu Query Error', [
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'user_id' => Auth::id(),
                'is_responsive' => $this->isResponsive,
                'has_parent' => $this->menu ? true : false
            ]);
            return collect();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        try {
            $menus = $this->getMenus();
            Log::debug('Menu component rendering', [
                'menu_count' => $menus->count(),
                'is_responsive' => $this->isResponsive,
                'view' => 'components.menu'
            ]);
            
            return view('components.menu', ['menus' => $menus]);
        } catch (\Throwable $e) {
            Log::error('Menu Render Error', [
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'user_id' => Auth::id(),
                'is_responsive' => $this->isResponsive
            ]);
            
            if (config('app.debug')) {
                throw $e;
            }
            
            return view('components.menu', ['menus' => collect()]);
        }
    }
}
