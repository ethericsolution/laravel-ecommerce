<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $fillable = ['user_id', 'session_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function getTotalAttribute(): float
    {
        return $this->items?->sum('total');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function taxes()
    {
        return $this->morphMany(Taxable::class, 'taxable');
    }

    /**
     * Get the total tax amount for the cart.
     */
    public function getTaxBreakdownAttribute()
    {
        return $this->getTaxBreakdown();
    }

    public function getTotalTaxAmountAttribute(): float
    {
        return $this->getTaxBreakdown()->sum('total_amount');
    }

    /**
     * Get total tax amounts grouped by tax type (CGST, SGST, etc.)
     */
    public function getTaxBreakdown(): \Illuminate\Support\Collection
    {
        // Collect all CartItem IDs for this Order
        $itemIds = $this->items()->pluck('id');

        // Fetch related taxables for these items
        $taxGroups = Taxable::with('tax')
            ->where('taxable_type', CartItem::class)
            ->whereIn('taxable_id', $itemIds)
            ->get()
            ->groupBy('tax_id');

        // Map result with tax name, rate, type, and total amount
        return $taxGroups->map(function ($group) {
            $tax = $group->first()->tax;

            return [
                'name' => $tax->name,
                'type' => $tax->type, // e.g. 'cgst', 'sgst', 'igst'
                'rate' => $tax->rate,
                'total_amount' => $group->sum('tax_amount'),
            ];
        });
    }
}
