<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingAddRequest;
use App\Http\Requests\SettingEditRequest;
use App\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        $data = $this->setting->latest()->paginate(5);
        return view('admin.setting.index', compact('data'));
    }

    public function add()
    {
        return view('admin.setting.add');
    }

    public function store(SettingAddRequest $request)
    {
        $this->setting->create([
            'config_key' => $request['config_key'],
            'config_value' => $request['config_value'],
            'type' => $request['type']
        ]);
        return redirect()->route('setting.index');
    }

    public function edit($id)
    {
        $setting = $this->setting->find($id);
        return view('admin.setting.edit', compact('setting'));
    }

    public function update($id, SettingEditRequest $request)
    {
        $this->setting->find($id)->update([
            'config_key' => $request['config_key'],
            'config_value' => $request['config_value']
        ]);
        return redirect()->route('setting.index');
    }

    public function delete($id)
    {
        try {
            $this->setting->find($id)->delete();
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
