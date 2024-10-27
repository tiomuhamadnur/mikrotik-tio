<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Query;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    protected $client;

    public function __construct()
    {
        // Inisialisasi klien hanya sekali
        $this->client = new Client([
            'host' => config('services.mikrotik.host'),
            'user' => config('services.mikrotik.user'),
            'pass' => config('services.mikrotik.pass'),
        ]);
    }

    public function index() {
        $query = (new Query('/ip/hotspot/user/print'))
                ->equal('.proplist', 'name,password,mac-address,limit-uptime,uptime,comment,profile'); // Menampilkan kolom yang dibutuhkan

        $user = $this->client->query($query)->read();
        $comment = collect($user)
                    ->pluck('comment')
                    ->filter(function ($comment) {
                        return str_contains($comment, 'up');
                    })
                    ->unique();
        // dd($comment);

        // dd($user);

        return view('pages.user.index', compact([
            'user',
            'comment',
        ]));
    }

    public function active()
    {
        $query = (new Query('/ip/hotspot/active/print'))
                ->equal('.proplist', 'user,mac-address,address,uptime,session-time-left,bytes-in,bytes-out,comment');

        $user = $this->client->query($query)->read();

        return view('pages.active-user.index', compact([
            'user',
        ]));
    }

    public function voucher()
    {
        $query = (new Query('/ip/hotspot/user/print'))
                    ->equal('.proplist', 'name,password,mac-address,limit-uptime,uptime,comment,profile'); // Menampilkan kolom yang dibutuhkan

        $users = $this->client->query($query)->read();

        // Filter data sesuai kondisi yang diinginkan
        $user = array_filter($users, function($user) {
            $macAddress = $user['mac-address'] ?? null;
            $profile = $user['profile'] ?? null;

            return is_null($macAddress) && !is_null($profile) && $profile !== 'default';
        });

        // Mengambil 'comment' dari hasil filter yang mengandung kata 'up' dan unik
        $comment = collect($user)
                        ->map(function ($user) {
                            return [
                                'comment' => $user['comment'] ?? null,
                                'profile' => $user['profile'] ?? null
                            ];
                        })
                        ->filter(function ($item) {
                            return isset($item['comment']) && str_contains($item['comment'], 'up');
                        })
                        ->unique('comment'); // Unik berdasarkan 'comment' saja

        return view('pages.voucher.index', compact('user', 'comment'));
    }


    public function voucher_pdf(Request $request)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $query = (new Query('/ip/hotspot/user/print'))
                ->equal('.proplist', 'name,password,mac-address,limit-uptime,uptime,comment,profile') // Menampilkan kolom yang dibutuhkan
                ->where('comment', $request->comment);

        $users = $this->client->query($query)->read();

        // Filter data sesuai kondisi yang diinginkan
        $user = array_filter($users, function($user) {
            // Menggunakan ?? untuk memastikan nilainya aman
            $macAddress = $user['mac-address'] ?? null;
            $profile = $user['profile'] ?? null;

            return is_null($macAddress) && !is_null($profile) && $profile !== 'default';
        });

        $pdf = Pdf::loadView('pages.voucher.export.pdf', [
            'user' => $user,
        ]);

        return $pdf->setPaper('a4', 'landscape')->stream(Carbon::now()->format('Ymd_') . 'Data Voucher.pdf');
    }

    public function getUserProfiles()
    {
        // $query = (new Query('/ip/hotspot/user/profile/print'));
        $query = new Query('/log/print');
        $logs = $this->client->query($query)->read();

        // Ambil 10 data terakhir dari logs
        $lastLogs = array_slice($logs, -10);

        // Urutkan hasil dalam urutan descending
        $lastLogs = array_reverse($lastLogs);

        dd($lastLogs);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
