<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
   protected $table = 'products';
   protected $primaryKey = 'id';
   protected $keyType = 'int';
   public $incrementing = true;
   public $timestamps = true;

   // Add relation to table categories : 1 to Many
   public function category(): BelongsTo
   {
      return $this->belongsTo(Category::class, 'category_id', 'id');
   }
}
