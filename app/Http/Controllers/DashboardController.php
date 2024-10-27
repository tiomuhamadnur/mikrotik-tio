<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RouterOS\Client;
use RouterOS\Query;

class DashboardController extends Controller
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

    public function index()
    {
        $all_user = $this->all_users();
        $active_user = $this->active_users();
        $voucher = $this->voucher();
        $uptime = $this->uptime();

        return view('pages.dashboard.index', compact([
            'all_user',
            'active_user',
            'voucher',
            'uptime',
        ]));
    }

    public function all_users()
    {
        $query = (new Query('/ip/hotspot/user/print'))
        ->equal('.proplist', 'name,password,mac-address,limit-uptime,uptime,comment,profile'); // Menampilkan kolom yang dibutuhkan

        $user = $this->client->query($query)->read();

        return count($user);
    }

    public function active_users()
    {
        $query = (new Query('/ip/hotspot/active/print'))
                ->equal('.proplist', 'user,mac-address,address,uptime,session-time-left,bytes-in,bytes-out,comment');

        $user = $this->client->query($query)->read();

        return count($user);
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

        return count($user);
    }

    public function uptime()
    {
        $query = new Query('/system/resource/print');
        $systemInfo = $this->client->query($query)->read();
        $uptime = $systemInfo[0]['uptime'];

        return $uptime;
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
