<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'guest_name', 'guest_email', 'order_number', 'total_amount', 'payment_method',
        'payment_status', 'order_status', 'address', 'city', 'phone',
    ];

    public function customerName(): string
    {
        return $this->user?->name ?? $this->guest_name ?? 'Guest';
    }

    public function customerEmail(): ?string
    {
        return $this->user?->email ?? $this->guest_email;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
