<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KopiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fungsi untuk menampilkan halaman dashboard
        return view('home');
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
        // fungsi untuk mengolah data dari kelas TotalPembayaran dan dikrim ke halaman Dashboard
        $nama = $request->nama;
        $status = "member";
        $jpesanan = explode(',',$request->pesanan);
        $jumlah = count($jpesanan);
        $total = $jumlah * 50000;
        $d = new totalPembayaran($status,$total);
        if($d->diskon() >= 10000){
            $ddd = "20%";
        } else if($d->diskon() < 10000){
            $ddd = "10%";
        }
        $data = [
            "nama" => $nama,
            "jumlah" => $jumlah,
            "total" => $total,
            "status" => $status,
            "diskon" => $ddd,
            "tbayar" => $d->total(),
        ];
        return view('home',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

// kelas pesan 
class Pesan{
    // fungsi untuk menerima input yang dijalankan awal dan memiliki parameter
    public function __construct($pesanan)
    {
        $this->pesanan = $pesanan;
    }


}

// interface Diskon yang memiliki method diskon
interface Disk {
    public function diskon();
  }
  
// Class yang memiliki implements dari interface Disk 
class jumDisk implements Disk {
    // fungsi yang dieksekusi paling awal untuk mendapat nilai dari parameter yang dimiliki
    public function __construct($status,$total)
    {
        $this->status = $status;
        $this->total = $total;
    }

    // fungsi untuk diskon
    public function diskon() {
      if($this->status == "member" && $this->total >= 100000)
      {
        return $this->total * 0.2;
      } else if($this->status == "member" && $this->total < 100000)
      {
        return $this->total * 0.1;
      }
    }
  } 

// Class yang memiliki pewarisan dari kelas jumDisk
class totalPembayaran extends jumDisk{
    public function total()
    {
        return $this->total - $this->diskon();
    }
}
