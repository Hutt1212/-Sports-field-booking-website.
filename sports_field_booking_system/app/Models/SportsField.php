<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SportsField extends Model
{
    protected $fillable = [
        'name',
        'sport_type',
        'description',
        'type',
        'location',
        'address',
        'size',
        'surface',
        'price_per_90min',
        'status',
        'image',
        'amenities',
        'opening_time',
        'closing_time',
        'time_slots',
        'image',
    ];

    protected $casts = [
        'amenities' => 'array',
        'opening_time' => 'datetime',
        'closing_time' => 'datetime',
        // price stored as integer (whole currency units)
        'time_slots' => 'array',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    /**
     * Generate 90-minute time slots based on opening and closing times
     */
    public function generateTimeSlots(): array
    {
        $slots = [];
        $opening = \Carbon\Carbon::parse($this->opening_time);
        $closing = \Carbon\Carbon::parse($this->closing_time);
        
        $current = $opening->copy();
        
        while ($current->addMinutes(90)->lte($closing)) {
            $startTime = $current->copy()->subMinutes(90);
            $endTime = $current->copy();
            
            $slots[] = [
                'start_time' => $startTime->format('H:i'),
                'end_time' => $endTime->format('H:i'),
                'label' => $startTime->format('H:i') . ' - ' . $endTime->format('H:i'),
                'available' => true
            ];
        }
        
        return $slots;
    }

    /**
     * Get available time slots for a specific date
     */
    public function getAvailableSlotsForDate($date): array
    {
        $slots = $this->generateTimeSlots();
        $bookedSlots = $this->bookings()
            ->whereDate('booking_date', $date)
            ->where('status', 'confirmed')
            ->pluck('start_time', 'end_time')
            ->toArray();
        
        foreach ($slots as &$slot) {
            $slot['available'] = !in_array($slot['start_time'], $bookedSlots);
        }
        
        return $slots;
    }
}
