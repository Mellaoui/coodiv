<?php

namespace Database\Seeders;

use App\Models\Matiere;
use Illuminate\Database\Seeder;

class MatiereSeeder extends Seeder
{
    private $jewelryMaterials = [
        'Gold',
        'Silver',
        'Platinum',
        'Diamond',
        'Pearl',
        'Ruby',
        'Sapphire',
        'Emerald',
        'Topaz',
        'Amethyst',
        'Opal',
        'Garnet',
        'Aquamarine',
        'Peridot',
        'Tourmaline',
        'Citrine',
        'Tanzanite',
        'Quartz',
        'Jade',
        'Onyx',
        'Turquoise',
        'Coral',
        'Mother of Pearl',
        'Lapis Lazuli',
        'Moonstone',
        'Agate',
        'Alexandrite',
        'Zircon',
        'Cubic Zirconia',
        'Lab-Grown Diamonds',
        'Titanium',
        'Stainless Steel',
        'Brass',
        'Copper',
        'Enamel',
        'Leather',
        'Wood',
        'Glass',
        'Resin',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Matiere::factory()->count(count($this->jewelryMaterials))->create();
    }
}
