<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductFilter
{
    protected Request $request;
    protected Builder $query;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $query)
    {
        $this->query = $query;

        if ($this->request->category) {
            $this->category($this->request->category);
        }

        if ($this->request->vendor) {
            $this->vendor($this->request->vendor);
        }

        if ($this->request->search) {
            $this->search($this->request->search);
        }

        if ($this->request->min_price) {
            $this->minPrice($this->request->min_price);
        }

        if ($this->request->max_price) {
            $this->maxPrice($this->request->max_price);
        }

        return $this->query;
    }

    protected function category($category)
    {
        $this->query->where('category_id', $category);
    }

    protected function vendor($vendor)
    {
        $this->query->where('vendor_id', $vendor);
    }

    protected function search($search)
    {
        $this->query->where('name', 'ilike', "%{$search}%");
    }

    protected function minPrice($price)
    {
        $this->query->where('price', '>=', $price);
    }

    protected function maxPrice($price)
    {
        $this->query->where('price', '<=', $price);
    }
}