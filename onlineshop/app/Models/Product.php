<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    //scopes 
    public function scopeAvailable($query)
    {
        return $query->where('quantity', '>', 0)->where('status', 1);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', '%' . trim($search) . '%')->orWhere('name', 'LIKE', '%' . trim($search) . '%');
    }

    public function scopeFilter($query, $filters)
    {
        if (!empty($filters['is_available'])) {
            $query->available();
        }

        if (!empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'max':
                    // $query->orderBy('price', 'desc');
                    $query->orderByRaw('
                        CASE 
                            WHEN sale_price IS NOT NULL 
                                AND sale_date_from < NOW() 
                                AND sale_date_to > NOW() 
                            THEN sale_price 
                            ELSE price 
                        END ' . 'desc');
                    break;
                case 'min':
                    $query->orderByRaw('
                        CASE 
                            WHEN sale_price IS NOT NULL 
                                AND sale_date_from < NOW() 
                                AND sale_date_to > NOW() 
                            THEN sale_price 
                            ELSE price 
                        END ' . 'asc');
                    break;
                case 'bestseller':
                    $query;
                    break;
                default:
                    $query;
                    break;
            }
        }
        return $query;
    }
    
    public function getIsAvailableAttribute()
    {
        return ($this->quantity > 0) && ($this->status == 1);
    }

    public function getIsOnSaleAttribute()
    {
        return ($this->quantity > 0) && ($this->sale_price) && ($this->sale_date_from < Carbon::now()) && ($this->sale_date_to > Carbon::now());
    }

    public function getSalePercentAttribute()
    {
        return round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    
}
