<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $sortable = [
        'price', 'created_at', 'area'
    ];




    public function scopeWithoutSold(Builder $query)
    {
        // return $query->doesntHave('offers')->orWhereHas(
        //     'offers',
        //     fn ($query) => $query->whereNull('accepted_at')
        //         ->whereNull('rejected_at')
        // );

        return $query->whereNull('sold_at');
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        return $query->when(
            $filters['priceFrom'] ?? null,
            function ($query, $priceFrom) {
                $query->where('price', '>=', $priceFrom);
            }
        )
            ->when(
                $filters['priceTo'] ?? null,
                function ($query, $priceTo) {
                    $query->where('price', '<=', $priceTo);
                }
            )
            ->when(
                $filters['beds'] ?? null,
                function ($query, $beds) {
                    $query->where('beds', $beds);
                }
            )
            ->when(
                $filters['baths'] ?? null,
                function ($query, $baths) {
                    $query->where('baths', $baths);
                }
            )
            ->when(
                $filters['areaFrom'] ?? null,
                function ($query, $areaFrom) {
                    $query->where('area', '>=', $areaFrom);
                }
            )
            ->when(
                $filters['areaTo'] ?? null,
                function ($query, $areaTo) {
                    $query->where('area', '<=', $areaTo);
                }
            )
            ->when($filters['deleted'] ?? null, function ($query) {
                $query->withTrashed();
            })
            ->when(
                $filters['by'] ?? null,
                fn ($query, $value) => in_array($value, $this->sortable) ? $query->orderBy($value, $filters['order'] ?? 'desc') : $query
            );
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'listing_id');
    }
}
