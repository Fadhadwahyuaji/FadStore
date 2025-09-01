<?php

namespace Database\Seeders;
// namespace Dipantry\Rajaongkir\Seeds;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Dipantry\Rajaongkir\Policies\PackagePolicy;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
class ROProvinceSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = config('rajaongkir.table_prefix').'provinces';
        $this->filename = public_path('csv/province.csv');
        $this->csv_delimiter = ',';
        $this->offset_rows = 1;
        $this->mapping = [
            0 => 'id',
            1 => 'name',
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = config('rajaongkir.package');
        if (!(new PackagePolicy($package))->allowGetProvinces()) {
            return;
        }

        DB::disableQueryLog();
        parent::run();
    }
}
