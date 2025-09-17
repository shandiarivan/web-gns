<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'name', 'tagline', 'price', 'benefits', 'is_published'];
    // protected $fillable = ['type', 'name', 'tagline', 'price', 'benefits'];
}