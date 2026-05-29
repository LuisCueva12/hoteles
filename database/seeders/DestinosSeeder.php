<?php

namespace Database\Seeders;

use App\Models\Destino;
use Illuminate\Database\Seeder;

class DestinosSeeder extends Seeder
{
    public function run(): void
    {
        $destinos = [
            // CAJAMARCA
            ['slug' => 'cajamarca', 'nombre' => 'Cajamarca', 'departamento' => 'Cajamarca', 'tipo' => 'departamento', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/c/ca/Plaza_de_cajamarca.jpg'],
            ['slug' => 'chota', 'nombre' => 'Chota', 'departamento' => 'Cajamarca', 'tipo' => 'ciudad', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/6/6d/Catedral_de_Chota.jpg'],
            ['slug' => 'cutervo', 'nombre' => 'Cutervo', 'departamento' => 'Cajamarca', 'tipo' => 'ciudad', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/c/c0/Plaza_de_aras.jpg'],
            ['slug' => 'cajabamba', 'nombre' => 'Cajabamba', 'departamento' => 'Cajamarca', 'tipo' => 'ciudad', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/8/84/Vista_de_la_Plaza_de_Armas_de_Cajabamba%2C_Per%C3%BA.jpg'],
            ['slug' => 'celendin', 'nombre' => 'Celendín', 'departamento' => 'Cajamarca', 'tipo' => 'ciudad', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/a/ab/Celend%C3%ADn_1998_Plaza_Mayor_e_Iglesia.jpg'],
            ['slug' => 'san-miguel-cajamarca', 'nombre' => 'San Miguel', 'departamento' => 'Cajamarca', 'tipo' => 'ciudad', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/e/ed/Plaza_de_Armas_terminada.jpg'],
            ['slug' => 'santa-cruz-cajamarca', 'nombre' => 'Santa Cruz', 'departamento' => 'Cajamarca', 'tipo' => 'ciudad', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/3/3a/Provincia_de_Santa_Cruz_-_Cajamarca.jpg'],
            ['slug' => 'bambamarca', 'nombre' => 'Bambamarca', 'departamento' => 'Cajamarca', 'tipo' => 'ciudad', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/0/0c/Iglesia_bambamarca.jpg'],

            // AMAZONAS
            ['slug' => 'amazonas', 'nombre' => 'Amazonas', 'departamento' => 'Amazonas', 'tipo' => 'departamento', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/16/Gocta.jpg'],
            ['slug' => 'chachapoyas', 'nombre' => 'Chachapoyas', 'departamento' => 'Amazonas', 'tipo' => 'ciudad', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/8/8f/Chachapoyas.jpg'],
            ['slug' => 'gocta', 'nombre' => 'Gocta', 'departamento' => 'Amazonas', 'tipo' => 'atractivo', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/16/Gocta.jpg'],

            // ÁNCASH
            ['slug' => 'ancash', 'nombre' => 'Áncash', 'departamento' => 'Áncash', 'tipo' => 'departamento', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Alpamayo.jpg/1920px-Alpamayo.jpg'],
            ['slug' => 'huaraz', 'nombre' => 'Huaraz', 'departamento' => 'Áncash', 'tipo' => 'ciudad', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/a/a1/HuarazyHuascaran.jpg'],
            ['slug' => 'chimbote', 'nombre' => 'Chimbote', 'departamento' => 'Áncash', 'tipo' => 'ciudad', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Playa_La_Caleta_desde_el_Cerro_de_la_Paz_-_DSC_0305.jpg/1920px-Playa_La_Caleta_desde_el_Cerro_de_la_Paz_-_DSC_0305.jpg'],

            // CUSCO
            ['slug' => 'cusco', 'nombre' => 'Cusco', 'departamento' => 'Cusco', 'tipo' => 'departamento', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/Plaza_de_Cusco_Allison_Bellido.jpg/1920px-Plaza_de_Cusco_Allison_Bellido.jpg'],
            ['slug' => 'machupicchu', 'nombre' => 'Machupicchu', 'departamento' => 'Cusco', 'tipo' => 'atractivo', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Machu_Picchu%2C_Peru_%282018%29.jpg/1920px-Machu_Picchu%2C_Peru_%282018%29.jpg'],
            ['slug' => 'valle-sagrado', 'nombre' => 'Valle Sagrado', 'departamento' => 'Cusco', 'tipo' => 'zona', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/Around_Cusco_11-22_%2823622234585%29.jpg/1920px-Around_Cusco_11-22_%2823622234585%29.jpg'],

            // LIMA
            ['slug' => 'lima', 'nombre' => 'Lima', 'departamento' => 'Lima', 'tipo' => 'departamento', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/d/df/Lima2017_A.jpg'],
            ['slug' => 'miraflores', 'nombre' => 'Miraflores', 'departamento' => 'Lima', 'tipo' => 'distrito', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/LarcoMar_Shopping_Center%2C_Miraflores%2C_Lima%2C_Peru.jpg/1920px-LarcoMar_Shopping_Center%2C_Miraflores%2C_Lima%2C_Peru.jpg'],
            ['slug' => 'barranco', 'nombre' => 'Barranco', 'departamento' => 'Lima', 'tipo' => 'distrito', 'activo' => true, 'imagen_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/PUENTE_DE_LOS_SUSPIROS.jpg/1920px-PUENTE_DE_LOS_SUSPIROS.jpg'],
        ];

        foreach ($destinos as $destino) {
            Destino::updateOrCreate(['slug' => $destino['slug']], $destino);
        }
    }
}
