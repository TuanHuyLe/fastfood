<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recursive;
use App\Http\Requests\ProductAddRequest;
use App\Product;
use App\ProductImage;
use App\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use DB;
use Log;

class AdminProductController extends Controller
{
    use StorageImageTrait;

    private $product;
    private $category;
    private $tag;
    private $productImage;

    public function __construct(Product $product, Category $category, Tag $tag, ProductImage $productImage)
    {
        $this->product = $product;
        $this->category = $category;
        $this->tag = $tag;
        $this->productImage = $productImage;
    }

    public function index()
    {
        $data = $this->product->latest()->paginate(10);
        return view('admin.product.index', compact('data'));
    }

    public function getCategory($pid)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        return $recursive->timcon($pid);
    }

    public function create()
    {
        $htmlOption = $this->getCategory('');
        return view('admin.product.add', compact('htmlOption'));
    }

    public function store(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreated = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreated['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreated['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreated);
            //insert data to product images
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            //insert tag to product tag
            $tagIds = [];
            if (!empty($request['tags'])) {
                foreach ($request['tags'] as $tagItem) {
                    $tag = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tag->id;
                }
            }
            $product->tags()->attach($tagIds);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        } finally {
            return redirect()->route('product.index');
        }
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $pid = $product->category_id;
        $htmlOption = $this->getCategory($pid);
        return view('admin.product.edit', compact('htmlOption', 'product'));
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdated = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdated['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdated['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdated);
            $product = $this->product->find($id);
            //insert data to product images
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            //insert tag to product tag
            $tagIds = [];
            if (!empty($request['tags'])) {
                foreach ($request['tags'] as $tagItem) {
                    $tag = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tag->id;
                }
            }
            $product->tags()->sync($tagIds);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        } finally {
            return redirect()->route('product.index');
        }
    }

    public function delete($id)
    {
        try {
            $this->product->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
