<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function create()
    {
        return view(
            'branchs.create'
        );
    }

    public function store(Request $request)
    {
        // validation 
        $request->validate([
            'content' => 'required|string',
        ]);

        Branch::create([
            'content' => $request->content,
            'product_id' =>Product::all()->id,
        ]);

        return redirect( route('books.index') );
    }
}
