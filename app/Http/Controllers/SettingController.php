<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use anlutro\LaravelSettings\Facades\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config_variables = DB::table('settings')->get();
        return view('setting.index')->with('config_variables', $config_variables);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $key = strtolower($request->key);
        $key = str_replace(' ', '_', $key);

        Setting::set($key, $request->value);
        Setting::save();
        
        
        $config_variables = DB::table('settings')->get();
        return redirect()->route('setting.index')->with('config_variables', $config_variables)
                                    ->with('success', 'Variable almacenada');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {

        $var = DB::table('settings')->where('id', $id)
                                    ->update([ 'value' => $request->value ]);
        $config_variables = DB::table('settings')->get();
        return redirect()->route('setting.index')->with('config_variables', $config_variables)
                                    ->with('success', 'Variable actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {

        $var = DB::table('settings')->where('id', $id)->delete();

        $config_variables = DB::table('settings')->get();
        return redirect()->route('setting.index')->with('config_variables', $config_variables)
                                    ->with('success', 'Variable eliminada');
    }
}
