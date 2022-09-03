<?php

namespace Database\Seeders;

use App\Models\ManajemanMenu;
use App\Models\ManajemanMenuRole;
use App\Models\ManajemenSubMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManajemenMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $default_menus = [
            [
                'name' => 'manajemen user',
                'amount_child' => 4,
                'sub_menu' => [
                    [
                        'name' => 'karyawan',
                        'url' => 'users',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'pelanggan',
                        'url' => 'customers',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'role',
                        'url' => 'roles',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'hak akses',
                        'url' => 'permissions',
                        'is_active' => 1
                    ],
                ],
                'icon' => 'users.png',
                'is_active' => 1,
                'role_id' => [
                    2
                ],
                'created_at' => now()
            ],

             [
                'name' => 'list pesanan',
                'amount_child' => 0,
                'icon' => 'pesanan.png',
                'is_active' => 1,
                'url' => 'orders',
                'role_id' => [
                    2,
                    1,
                ],
                'created_at' => now()
            ],

            [
                'name' => 'manajemen penginapan',
                'amount_child' => 5,
                'sub_menu' => [
                    [
                        'name' => 'penginapan',
                        'url' => 'accomodations',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'kamar',
                        'url' => 'rooms',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'tipe kamar',
                        'url' => 'room_types',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'fasilitas',
                        'url' => 'facilities',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'nomor kamar',
                        'url' => 'room_numbers',
                        'is_active' => 1
                    ],
                ],
                'icon' => 'penginapan.png',
                'is_active' => 1,
                'role_id' => [2],
                'created_at' => now()
            ],

            [
                'name' => 'manajemen keuangan',
                'amount_child' => 2,
                'sub_menu' => [
                    [
                        'name' => 'keuangan',
                        'url' => 'finance',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'transaksi',
                        'url' => 'finance/transaction/list',
                        'is_active' => 1
                    ],
                ],
                'icon' => 'transaksi.png',
                'is_active' => 1,
                'role_id' => [
                     1,
                    2
                ],
                'created_at' => now()
            ],

            [
                'name' => 'manajemen kantor',
                'amount_child' => 0,
                'icon' => 'kantor.png',
                'is_active' => 1,
                'url' => 'offices',
                'role_id' => [
                    2
                ],
                'created_at' => now()
            ],
            [
                'name' => 'manajemen poin',
                'amount_child' => 3,
                'sub_menu' => [
                    [
                        'name' => 'daftar tukar poin',
                        'url' => 'point',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'daftar merchandise',
                        'url' => 'product',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'daftar penukaran merchandise',
                        'url' => 'product/redeem/lists',
                        'is_active' => 1
                    ],
                ],
                'icon' => 'point.png',
                'is_active' => 1,
                'role_id' => [
                    1,
                    2
                ],
                'created_at' => now()
            ],

            [
                'name' => 'artikel',
                'amount_child' => 2,
                'sub_menu' => [
                    [
                        'name' => 'daftar artikel',
                        'url' => 'post',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'daftar kategori artikel',
                        'url' => 'category-post',
                        'is_active' => 1
                    ],
                ],
                'icon' => 'berita.png',
                'is_active' => 1,
                'role_id' => [
                      1,
                     2
                ],
                'created_at' => now()
            ],

            // [
            //     'name' => 'produk',
            //     'amount_child' => 2,
            //     'sub_menu' => [
            //         [
            //             'name' => 'daftar produk',
            //             'url' => 'product',
            //             'is_active' => 1
            //         ],
            //          [
            //             'name' => 'daftar penukaran produk',
            //             'url' => 'product/redeem/lists',
            //             'is_active' => 1
            //         ],
            //     ],
            //     'icon' => 'produk.png',
            //     'is_active' => 1,
            //     'role_id' => [
            //          1,
            //         2
            //     ],
            //     'created_at' => now()
            // ],

            [
                'name' => 'voucher',
                'amount_child' => 2,
                'sub_menu' => [
                    [
                        'name' => 'daftar voucher',
                        'url' => 'voucher',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'daftar penukaran voucher',
                        'url' => 'voucher/redeem/lists',
                        'is_active' => 1
                    ],
                ],
                'icon' => 'voucher.png',
                'is_active' => 1,
                'role_id' => [
                     1,
                    2
                ],
                'created_at' => now()
            ],

            [
                'name' => 'manajemen refferral',
                'amount_child' => 0,
                'icon' => 'referal.png',
                'is_active' => 1,
                'url' => 'refferals',
                'role_id' => [
                    2
                ],
                'created_at' => now()
            ],

            [
                'name' => 'refund',
                'amount_child' => 0,
                'icon' => 'refund.png',
                'is_active' => 1,
                'url' => 'refunds',
                'role_id' => [
                    2
                ],
                'created_at' => now()
            ],

            [
                'name' => 'promo',
                'amount_child' => 0,
                'icon' => 'promo.png',
                'is_active' => 1,
                'url' => 'promotion',
                'role_id' => [
                    2
                ],
                'created_at' => now()
            ],

            [
                'name' => 'kabijakan privasi',
                'amount_child' => 0,
                'icon' => 'privasi.png',
                'is_active' => 1,
                'url' => 'privacy',
                'role_id' => [
                    2
                ],
                'created_at' => now()
            ],

            [
                'name' => 'notifikasi',
                'amount_child' => 2,
                'sub_menu' => [
                    [
                        'name' => 'daftar notifikasi',
                        'url' => 'notifications',
                        'is_active' => 1
                    ],
                    [
                        'name' => 'push notifikasi',
                        'url' => 'notifikasi/push',
                        'is_active' => 1
                    ],
                ],
                'icon' => 'notifikasi.png',
                'is_active' => 1,
                'role_id' => [
                    1,
                      2
                ],
                'created_at' => now()
            ],
        ];

        foreach ($default_menus as $menus) {

            

            $menu = ManajemanMenu::create([
                'name' => $menus['name'],
                'url' => $menus['url'] ?? NULL,
                'is_active' => $menus['is_active'],
                'amount_child' => $menus['amount_child'] ?? NULL,
                'created_at' => now()
            ]);

            //dd($menus);

            if(@$menus['sub_menu']){

                $submenu = [];

                foreach ($menus['sub_menu'] as $key => $sub) {
               
                    array_push($submenu, [
                        'manajeman_menu_id' => $menu->id,
                        'name' => $sub['name'],
                        'url' => $sub['url'],
                        'is_active' => $sub['is_active'],
                    ]);
                }

                ManajemenSubMenu::insert($submenu);
            }

            //dd($menus['role_id']);

            foreach($menus['role_id'] as $r){
                ManajemanMenuRole::create(
                    [
                        'menu_id' => $menu->id,
                        'role_id' => $r
                    ]
                );
            } 
            
            $menu->image()->create([
                'image' => $menus['icon']
            ]);
        }
        
    }
}
