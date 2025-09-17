<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSummary extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'title', 'tagline', 'price_prefix', 'price', 'price_suffix', 'features'];
}