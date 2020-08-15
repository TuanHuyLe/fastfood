<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Http\Requests\SliderEditRequest;
use App\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminSliderController extends Controller
{
    use StorageImageTrait;

    private $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {
        $data = $this->slider->latest()->paginate(5);
        return view('admin.slider.index', compact('data'));
    }

    public function add()
    {
        return view('admin.slider.add');
    }

    protected function dataSlider(Request $request)
    {
        $dataSlider = [
            'name' => $request['name'],
            'description' => $request['description']
        ];
        $dataUploadImage = $this->storageTraitUpload($request, 'image_path', 'sliders');
        if (!empty($dataUploadImage)) {
            $dataSlider['image_name'] = $dataUploadImage['file_name'];
            $dataSlider['image_path'] = $dataUploadImage['file_path'];
        }
        return $dataSlider;
    }

    public function store(SliderAddRequest $request)
    {
        try {
            $dataSlider = $this->dataSlider($request);
            $this->slider->create($dataSlider);
            return redirect()->route('slider.index');
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $slider = $this->slider->find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update($id, SliderEditRequest $request)
    {
        try {
            $dataSlider = $this->dataSlider($request);
            $this->slider->find($id)->update($dataSlider);
            return redirect()->route('slider.index');
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
        }
    }

    public function delete($id){
        try {
            $this->slider->find($id)->delete();
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
