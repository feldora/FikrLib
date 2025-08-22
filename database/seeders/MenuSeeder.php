<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Dashboard',
                'icon' => 'fas fa-tachometer-alt',
                'route' => 'admin.dashboard',
                'permission' => 'view dashboard',
                'order' => 1
            ],
            [
                'name' => 'Master Data',
                'icon' => 'fas fa-database',
                'order' => 2,
                'children' => [
                    [
                        'name' => 'Books',
                        'icon' => 'fas fa-book',
                        'route' => 'admin.books.index',
                        'permission' => 'manage books',
                        'order' => 1
                    ],
                    [
                        'name' => 'Members',
                        'icon' => 'fas fa-users',
                        'route' => 'admin.members.index',
                        'permission' => 'manage members',
                        'order' => 2
                    ]
                ]
            ],
            [
                'name' => 'Transactions',
                'icon' => 'fas fa-exchange-alt',
                'order' => 3,
                'children' => [
                    [
                        'name' => 'Loans',
                        'icon' => 'fas fa-hand-holding-book',
                        'route' => 'admin.loans.index',
                        'permission' => 'manage loans',
                        'order' => 1
                    ]
                ]
            ]
        ];

        $this->createMenus($menus);
    }

    private function createMenus(array $menus, ?int $parentId = null)
    {
        foreach ($menus as $menu) {
            $children = $menu['children'] ?? [];
            unset($menu['children']);
            
            if ($parentId) {
                $menu['parent_id'] = $parentId;
            }
            
            $menuModel = \App\Models\Menu::create($menu);
            
            if ($children) {
                $this->createMenus($children, $menuModel->id);
            }
        }
    }
}
