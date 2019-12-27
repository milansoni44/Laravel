<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting_info = Setting::all()[0];
        return view('settings.setting', ['setting_info'=>$setting_info]);
    }

    public function save(Request $request, $id = 1)
    {
        $validatedData = $request->validate([
            'system_name' => ['required', 'string', 'max:191'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $settingArr = array(
            'system_name'=>$request->post('system_name')
        );

        /* upload file start */
        if ($request->hasFile('logo')) {
            $setting_info = Setting::all()[0];
            $uploadPath = public_path('uploads/logo');
            $oldFilePath = $uploadPath.'/'.$setting_info->logo;
            if(file_exists($oldFilePath)){
                File::delete($oldFilePath);
            }
            // check directory exist or not
            File::isDirectory($uploadPath) or File::makeDirectory($uploadPath, 0777, true, true);
            $imageName = time() . '.' . $request->logo->getClientOriginalExtension();

            $request->logo->move($uploadPath, $imageName);
            if ($imageName != "" || !$imageName) {
                $settingArr['logo'] = $imageName;
            }
        }
        /* upload file end */

        $result = DB::table('settings')
            ->where('id', $id)
            ->update($settingArr);

        if ($result) {
            return redirect()->route('settings')
                ->with('success', 'Settings saved successfully');
        }
        return back()->withInput()->with('failure', 'Error in setting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
