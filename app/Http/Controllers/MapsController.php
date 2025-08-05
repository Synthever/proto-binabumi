<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapsController extends Controller
{
    /**
     * Display the main maps/cari mesin page
     */
    public function cariMesin()
    {
        return view('maps.cari-mesin-1');
    }

    /**
     * Display the not found page
     */
    public function notFound()
    {
        return view('maps.cari-mesin-2');
    }
    /**
     * Display the not active page
     */
    public function notActive()
    {
        return view('maps.cari-mesin-3');
    }

    /**
     * Get nearby machines data (API endpoint)
     */
    public function getNearbyMachines(Request $request)
    {
        // This would typically fetch from database
        // For now, returning dummy data
        $machines = [
            [
                'id' => 'amikom',
                'name' => 'AMIKOM Yogyakarta',
                'description' => 'Jl. Ring Road Utara, Ngringin, Condongcatur, Sleman, Daerah Istimewa Yogyakarta',
                'distance' => '1.5 KM',
                'available_machines' => 8,
                'status' => 'active',
                'latitude' => -7.7334,
                'longitude' => 110.3467,
                'image' => asset('assets/images/amikom-building.jpg')
            ],
            [
                'id' => 'teras-malioboro',
                'name' => 'Teras Malioboro 1',
                'description' => 'Jl. Malioboro No.55-59, Gk.Gunung Condong, Sosromenduran, Kota Yogyakarta, Daerah Istimewa Yogyakarta',
                'distance' => '0.9 KM',
                'available_machines' => 8,
                'status' => 'active',
                'latitude' => -7.7925,
                'longitude' => 110.3656,
                'image' => asset('assets/images/teras-malioboro.jpg')
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $machines
        ]);
    }

    /**
     * Get machine details by ID
     */
    public function getMachineDetails($id)
    {
        // This would typically fetch from database
        $machines = [
            'amikom' => [
                'id' => 'amikom',
                'name' => 'AMIKOM Yogyakarta',
                'description' => 'Jl. Ring Road Utara, Ngringin, Condongcatur, Sleman, Daerah Istimewa Yogyakarta',
                'full_address' => 'Jl. Ring Road Utara, Ngringin, Condongcatur, Sleman, Daerah Istimewa Yogyakarta 55283',
                'distance' => '1.5 KM',
                'available_machines' => 8,
                'total_machines' => 12,
                'status' => 'active',
                'operating_hours' => '24 Jam',
                'latitude' => -7.7334,
                'longitude' => 110.3467,
                'image' => asset('assets/images/amikom-building.jpg'),
                'contact' => '+62 274 884201',
                'facilities' => ['WiFi', 'Parkir', 'ATM', 'Toilet']
            ],
            'teras-malioboro' => [
                'id' => 'teras-malioboro',
                'name' => 'Teras Malioboro 1',
                'description' => 'Jl. Malioboro No.55-59, Gk.Gunung Condong, Sosromenduran, Kota Yogyakarta, Daerah Istimewa Yogyakarta',
                'full_address' => 'Jl. Malioboro No.55-59, Gk.Gunung Condong, Sosromenduran, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55271',
                'distance' => '0.9 KM',
                'available_machines' => 8,
                'total_machines' => 10,
                'status' => 'active',
                'operating_hours' => '06:00 - 23:00',
                'latitude' => -7.7925,
                'longitude' => 110.3656,
                'image' => asset('assets/images/teras-malioboro.jpg'),
                'contact' => '+62 274 562892',
                'facilities' => ['WiFi', 'Parkir', 'Food Court', 'Toilet']
            ]
        ];

        if (!isset($machines[$id])) {
            return response()->json([
                'success' => false,
                'message' => 'Machine not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $machines[$id]
        ]);
    }
}
