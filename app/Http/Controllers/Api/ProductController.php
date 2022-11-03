<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\AddProductRequest;
use App\Http\Requests\Api\Product\AssignProductsRequest;
use App\Http\Requests\Api\Product\DeleteProductRequest;
use App\Http\Requests\Api\Product\GetUserProductsRequest;
use App\Http\Requests\Api\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;
use App\Services\ImageService;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add_product(AddProductRequest $request)
    {
        try {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => ImageService::storeFiles($request->file('image'), 'Products/Images'),
            ]);

            return $this->sendResponse('product added successfully', []);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function edit_product(UpdateProductRequest $request)
    {
        try {
            $product = Product::find($request->product_id);

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            if (isset($request->image)) {
                $new_image = ImageService::storeFiles($request->file('image'), 'Products/Images');
                $product->update([
                    'image' => $new_image,
                ]);
            }

            return $this->sendResponse('product updated successfully', $product);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function get_all_products()
    {
        try {
            $products = Product::paginate(10);

            return $this->sendResponse('', $products);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function get_user_products_by_admin(GetUserProductsRequest $request)
    {
        try {
            $products = Product::where('user_id', $request->user_id)->paginate(10);

            return $this->sendResponse('', $products);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function get_user_products_by_user(Request $request)
    {
        try {
            $products = Product::where('user_id', $request->user()->id)->paginate(10);

            return $this->sendResponse('', $products);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function assign_product_to_user(AssignProductsRequest $request)
    {
        try {
            $user = User::find($request->user_id);
            $product = Product::find($request->product_id);
            $user->products()->save($product);

            return $this->sendResponse('product assigned to user successfully', []);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function delete_product(DeleteProductRequest $request)
    {
        try {
            $product = Product::where('id', $request->product_id)->first();

            $product->delete();

            return $this->sendResponse('product deleted successfully', []);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }
}
