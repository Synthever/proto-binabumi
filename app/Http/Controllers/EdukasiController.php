<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function index()
    {
        $active = 'edukasi';
        
        // Data edukasi untuk halaman
        $edukasiData = [
            'hero' => [
                'title' => 'Kamu Bisa Jadi Pahlawan Bumi',
                'subtitle' => 'Mulai dari satu botol plastik!',
                'description' => 'Yuk, jadi bagian dari perubahan positif untuk lingkungan'
            ],
            'facts' => [
                [
                    'icon' => 'fas fa-globe-asia',
                    'number' => '12.6 juta',
                    'text' => 'ton sampah plastik dihasilkan Indonesia per tahun'
                ],
                [
                    'icon' => 'fas fa-water',
                    'number' => '1-2 juta',
                    'text' => 'ton dari botol plastik yang mencemari sungai dan laut'
                ],
                [
                    'icon' => 'fas fa-coins',
                    'number' => 'Rp 4.000',
                    'text' => 'per kg insentif yang bisa kamu dapatkan'
                ]
            ],
            'articles' => [
                [
                    'id' => 1,
                    'title' => 'Dampak Mikroplastik Terhadap Kesehatan Manusia',
                    'excerpt' => 'Penelitian terbaru menunjukkan bahwa mikroplastik telah ditemukan dalam darah manusia. Pelajari bagaimana cara melindungi diri dan keluarga.',
                    'image' => 'https://images.unsplash.com/photo-1583128017301-c43de3d65ffe?w=500&h=300&fit=crop',
                    'category' => 'Kesehatan',
                    'read_time' => '5 menit',
                    'date' => '2025-08-05'
                ],
                [
                    'id' => 2,
                    'title' => 'Cara Mudah Mengurangi Sampah Plastik di Rumah',
                    'excerpt' => 'Tips praktis untuk mengurangi penggunaan plastik dalam kehidupan sehari-hari. Mulai dari dapur hingga kamar mandi.',
                    'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=500&h=300&fit=crop',
                    'category' => 'Tips',
                    'read_time' => '7 menit',
                    'date' => '2025-08-03'
                ],
                [
                    'id' => 3,
                    'title' => 'Inovasi Daur Ulang Plastik Terbaru di Indonesia',
                    'excerpt' => 'Teknologi terbaru mengubah sampah plastik menjadi bahan bakar. Simak perkembangan inovasi daur ulang di Indonesia.',
                    'image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=500&h=300&fit=crop',
                    'category' => 'Teknologi',
                    'read_time' => '8 menit',
                    'date' => '2025-08-01'
                ],
                [
                    'id' => 4,
                    'title' => 'Program SIGMA: Mengubah Sampah Jadi Berkah',
                    'excerpt' => 'Bagaimana program SIGMA membantu masyarakat mengubah sampah plastik menjadi penghasilan tambahan yang berkelanjutan.',
                    'image' => 'https://images.unsplash.com/photo-1556075798-4825dfaaf498?w=500&h=300&fit=crop',
                    'category' => 'Program',
                    'read_time' => '6 menit',
                    'date' => '2025-07-30'
                ],
                [
                    'id' => 5,
                    'title' => 'Komunitas Peduli Lingkungan di Sekitar Kita',
                    'excerpt' => 'Bergabung dengan komunitas lokal untuk aksi nyata menjaga lingkungan. Temukan komunitas terdekat di daerah Anda.',
                    'image' => 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=500&h=300&fit=crop',
                    'category' => 'Komunitas',
                    'read_time' => '4 menit',
                    'date' => '2025-07-28'
                ],
                [
                    'id' => 6,
                    'title' => 'Ekonomi Sirkular: Masa Depan Pengelolaan Sampah',
                    'excerpt' => 'Konsep ekonomi sirkular memberikan solusi berkelanjutan untuk masalah sampah. Pelajari bagaimana penerapannya di Indonesia.',
                    'image' => 'https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?w=500&h=300&fit=crop',
                    'category' => 'Ekonomi',
                    'read_time' => '9 menit',
                    'date' => '2025-07-25'
                ]
            ],
            'tips' => [
                [
                    'title' => 'Pilah Sampah dengan Benar',
                    'description' => 'Pisahkan botol plastik dari sampah lainnya untuk memudahkan proses daur ulang',
                    'icon' => 'fas fa-recycle'
                ],
                [
                    'title' => 'Bersihkan Sebelum Buang',
                    'description' => 'Bilas botol plastik dari sisa makanan atau minuman sebelum dibuang',
                    'icon' => 'fas fa-tint'
                ],
                [
                    'title' => 'Kumpulkan dalam Jumlah Banyak',
                    'description' => 'Semakin banyak botol yang dikumpulkan, semakin besar dampak positifnya',
                    'icon' => 'fas fa-layer-group'
                ],
                [
                    'title' => 'Gunakan Mesin SIGMA',
                    'description' => 'Setor botol plastik ke mesin SIGMA terdekat dan dapatkan poin rewards',
                    'icon' => 'fas fa-robot'
                ]
            ]
        ];
        
        return view('edukasi.index', compact('active', 'edukasiData'));
    }

    public function show($id)
    {
        $active = 'edukasi';
        
        // Simulasi data artikel (dalam implementasi nyata, ambil dari database)
        $articles = [
            1 => [
                'id' => 1,
                'title' => 'Dampak Mikroplastik Terhadap Kesehatan Manusia',
                'content' => 'Artikel lengkap tentang dampak mikroplastik...',
                'image' => 'https://images.unsplash.com/photo-1583128017301-c43de3d65ffe?w=800&h=400&fit=crop',
                'category' => 'Kesehatan',
                'read_time' => '5 menit',
                'date' => '2025-08-05',
                'author' => 'Tim SIGMA'
            ],
            2 => [
                'id' => 2,
                'title' => 'Cara Mudah Mengurangi Sampah Plastik di Rumah',
                'content' => 'Tips praktis untuk mengurangi penggunaan plastik...',
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800&h=400&fit=crop',
                'category' => 'Tips',
                'read_time' => '7 menit',
                'date' => '2025-08-03',
                'author' => 'Tim SIGMA'
            ],
            3 => [
                'id' => 3,
                'title' => 'Inovasi Daur Ulang Plastik Terbaru di Indonesia',
                'content' => 'Teknologi terbaru mengubah sampah plastik...',
                'image' => 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=800&h=400&fit=crop',
                'category' => 'Teknologi',
                'read_time' => '8 menit',
                'date' => '2025-08-01',
                'author' => 'Tim SIGMA'
            ],
            4 => [
                'id' => 4,
                'title' => 'Program SIGMA: Mengubah Sampah Jadi Berkah',
                'content' => 'Bagaimana program SIGMA membantu masyarakat...',
                'image' => 'https://images.unsplash.com/photo-1556075798-4825dfaaf498?w=800&h=400&fit=crop',
                'category' => 'Program',
                'read_time' => '6 menit',
                'date' => '2025-07-30',
                'author' => 'Tim SIGMA'
            ],
            5 => [
                'id' => 5,
                'title' => 'Komunitas Peduli Lingkungan di Sekitar Kita',
                'content' => 'Bergabung dengan komunitas lokal...',
                'image' => 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=800&h=400&fit=crop',
                'category' => 'Komunitas',
                'read_time' => '4 menit',
                'date' => '2025-07-28',
                'author' => 'Tim SIGMA'
            ],
            6 => [
                'id' => 6,
                'title' => 'Ekonomi Sirkular: Masa Depan Pengelolaan Sampah',
                'content' => 'Konsep ekonomi sirkular memberikan solusi...',
                'image' => 'https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?w=800&h=400&fit=crop',
                'category' => 'Ekonomi',
                'read_time' => '9 menit',
                'date' => '2025-07-25',
                'author' => 'Tim SIGMA'
            ]
            // Tambahkan artikel lainnya...
        ];
        
        $article = $articles[$id] ?? null;
        
        if (!$article) {
            abort(404);
        }
        
        return view('edukasi.detail', compact('active', 'article'));
    }
}
