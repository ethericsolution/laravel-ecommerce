<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Settings\PrefixSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'order_date',
        'user_id',
        'status',
        'ip_address',
        'sub_total',
        'delivery_charge',
        'grand_total',
        'payment_method',
        'payment_status',
        'notes'
    ];

    protected $casts = [
        'status'          => OrderStatus::class,
        'payment_status'  => PaymentStatus::class,
        'sub_total'       => 'decimal:2',
        'delivery_charge' => 'decimal:2',
        'grand_total'     => 'decimal:2',
        'paid_amount'     => 'decimal:2',
        'order_date'      => 'date:Y-m-d'
    ];

    public static function generateOrderNumber(): string
    {
        return setting('prefix.order_prefix') . str_pad(setting('prefix.order_sequence'), setting('prefix.order_digit_length'), '0', STR_PAD_LEFT);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, "addressable");
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function taxes()
    {
        return $this->morphMany(Taxable::class, 'taxable');
    }

    public function scopeSearch($query, $term)
    {
        if (! $term) return $query;

        return $query->where(function ($q) use ($term) {
            $q->where('order_number', 'like', "%{$term}%")
                ->orWhere('order_date', 'like', "%{$term}%")
                ->orWhere('sub_total', 'like', "%{$term}%")
                ->orWhere('grand_total', 'like', "%{$term}%");
        });
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
        // Collect all OrderItem IDs for this Order
        $itemIds = $this->items()->pluck('id');

        // Fetch related taxables for these items
        $taxGroups = Taxable::with('tax')
            ->where('taxable_type', OrderItem::class)
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
                'total_taxable_amount' => $group->sum('base_amount'),
                'total_amount' => $group->sum('tax_amount'),
            ];
        });
    }
}
