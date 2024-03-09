<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class ProductDebugResource extends JsonResource
{
   // public $additional = [
   //    "author" => "whydandrian"
   // ];
   public static $wrap = "data";
   public function toArray(Request $request): array
   {
      return [
         "author" => "whydandrian",
         "server_time" => now()->toDateTimeString(),
         "data" => [
            "id" => $this->id,
            "name" => $this->name,
            "price" => $this->price
         ]
      ];
   }
}
