<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Menu extends Model
{
    use HasFactory, HasRoles;
    
    protected $fillable = [
        'name',
        'icon',
        'route',
        'permission',
        'parent_id',
        'order',
        'is_active'
    ];
    
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
    
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }
    
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }
    
    public function hasPermissionToView()
    {
        if (!$this->permission) {
            return true;
        }
        
        return auth()->user()->hasPermissionTo($this->permission);
    }
}