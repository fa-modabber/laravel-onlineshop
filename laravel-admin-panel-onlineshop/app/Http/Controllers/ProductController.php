<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(4);
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function make_slug_products($string)
    {
        $slug = \slugify($string);
        $count = Product::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        $result = $count ? "{$slug}-{$count}" : $slug;
        return $result;
    }

    public function store(Request $request)
    {
        try {
            $sale_date_from = $request->sale_date_from ? convert_jalali_to_gregorian_date($request->sale_date_from) : null;
        } catch (\Exception $e) {
            return redirect()->route('products.create')->with('error', 'تاریخ شروع حراجی صحیح نیست');
        }

        try {
            $sale_date_to = $request->sale_date_to ? convert_jalali_to_gregorian_date($request->sale_date_to) : null;
        } catch (\Exception $e) {
            return redirect()->route('products.create')->with('error', 'تاریخ پایان حراجی صحیح نیست');
        }

        $request->merge([
            'sale_date_from' => $sale_date_from,
            'sale_date_to' => $sale_date_to
        ]);

        $request->validate([
            'primary_image' => 'required|image',
            'images.*' => 'image|nullable',
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'status' => 'required|integer',
            'sale_price' => 'nullable|integer',
            'sale_date_from' => 'nullable|date_format:Y-m-d H:i:s',
            'sale_date_to' => 'nullable|date_format:Y-m-d H:i:s',
        ]);


        $primaryImageName = Carbon::now()->microsecond . '-' . $request->primary_image->getClientOriginalName();
        $request->primary_image->storeAs('images/products/', $primaryImageName);

        if ($request->has('images') && $request->images !== null) {
            $imageNameList = [];
            foreach ($request->images as $image) {
                $imageName = Carbon::now()->microsecond . '-' . $image->getClientOriginalName();
                $image->storeAs('images/products/', $imageName);
                array_push($imageNameList, $imageName);
            }
        }


        DB::beginTransaction();
        $product = Product::create([
            'slug' => $this->make_slug_products($request->name),
            'primary_image' => $primaryImageName,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'sale_price' => $request->filled('sale_price') ? $request->sale_price : 0,
            'sale_date_from' => $request->sale_date_from,
            'sale_date_to' => $request->sale_date_to
        ]);

        if ($request->has('images') && $request->images !== null) {
            foreach ($imageNameList as $imageName) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'name' => $imageName
                ]);
            }
        }
        DB::commit();

        return redirect()->route('products.index')->with('success', 'محصول با موفقیت ایجاد شد');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $sale_date_from = $request->sale_date_from ? convert_jalali_to_gregorian_date($request->sale_date_from) : null;
        } catch (\Exception $e) {
            return redirect()->route('products.create')->with('error', 'تاریخ شروع حراجی صحیح نیست');
        }

        try {
            $sale_date_to = $request->sale_date_to ? convert_jalali_to_gregorian_date($request->sale_date_to) : null;
        } catch (\Exception $e) {
            return redirect()->route('products.create')->with('error', 'تاریخ پایان حراجی صحیح نیست');
        }

        $request->merge([
            'sale_date_from' => $sale_date_from,
            'sale_date_to' => $sale_date_to
        ]);

        $request->validate([
            'primary_image' => 'nullable|image',
            'images.*' => 'nullable|image',
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'status' => 'required|integer',
            'sale_price' => 'nullable|integer',
            'sale_date_from' => 'nullable|date_format:Y-m-d H:i:s',
            'sale_date_to' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        if ($request->has('primary_image') && $request->primary_image !== null) {
            Storage::delete('/images/products/' . $product->primary_image);
            $primaryImageName = Carbon::now()->microsecond . '-' . $request->primary_image->getClientOriginalName();
            $request->primary_image->storeAs('images/products/', $primaryImageName);
        }

        if ($request->has('images') && $request->images !== null) {
            foreach ($product->images as $image) {
                Storage::delete('/images/products/' . $image->name);
                $image->delete();
            }
            $imageNameList = [];
            foreach ($request->images as $image) {
                $imageName = Carbon::now()->microsecond . '-' . $image->getClientOriginalName();
                $image->storeAs('images/products/', $imageName);
                array_push($imageNameList, $imageName);
            }
        }

        DB::beginTransaction();
        $product->update([
            'slug' => ($product->name != $request->name) ? $this->make_slug_products($request->name) : $product->slug,
            'primary_image' => $request->primary_image ? $primaryImageName : $product->primary_image,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'sale_price' => $request->filled('sale_price') ? $request->sale_price : 0,
            'sale_date_from' => $request->sale_date_from,
            'sale_date_to' => $request->sale_date_to
        ]);

        if ($request->has('images') && $request->images !== null) {
            foreach ($imageNameList as $imageName) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'name' => $imageName
                ]);
            }
        }
        DB::commit();

        return redirect()->route('products.index')->with('success', 'محصول با موفقیت ویرایش شد');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('warning', 'محصول با موفقیت حذف شد');
    }
}
