<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fungsi untuk menampilkan halaman menu dan mengirim data menu,kategori
        $data = Menu::all();
        $join = Kategori::all();
        return view('menu',compact('data','join'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // fungsi untuk menambah data menu
        $data = $request->all();
        $data['foto'] = Storage::put('public/artikel/foto',$request->file('foto'));
        Menu::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        // fungsi untuk mengedit menu
        $data = $request->all();
        try {
            $data['foto'] = Storage::put('public/artikel/foto',$request->file('foto'));
            $menu->update($data);
        } catch (\Throwable $th) {
            $data['foto'] = $menu->foto;
            $menu->update($data);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        // fungsi untuk menghapus menu
        $menu->delete();
        return redirect()->back();
    }

    public function beranda()
    {
        $data = Menu::all();
        return view('beranda',compact('data'));
    }
}
