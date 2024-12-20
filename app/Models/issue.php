<?php

namespace App\Models;

use Database\Seeders\ComputersTableSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class issue extends Model
{
    use HasFactory;

    // Định nghĩa các cột có thể điền (fillable)
    protected $fillable = ['computer_id', 'reported_by', 'reported_date', 'description', 'urgency', 'status', 'computer_id'];

    // Định nghĩa mối quan hệ với Computer (issue thuộc về một máy tính)
    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }
}
