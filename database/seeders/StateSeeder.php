<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        // Central Government
        State::updateOrCreate(['slug' => 'central-government'], [
            'name' => 'Central Government',
            'is_central' => true,
        ]);

        $states = [
            'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar',
            'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana',
            'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala',
            'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya',
            'Mizoram', 'Nagaland', 'Odisha', 'Punjab',
            'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana',
            'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal',
        ];

        $uts = [
            'Andaman and Nicobar Islands', 'Chandigarh',
            'Dadra and Nagar Haveli and Daman and Diu',
            'Delhi', 'Jammu and Kashmir', 'Ladakh',
            'Lakshadweep', 'Puducherry',
        ];

        foreach (array_merge($states, $uts) as $name) {
            $slug = \Illuminate\Support\Str::slug($name);
            State::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'is_central' => false]
            );
        }
    }
}
