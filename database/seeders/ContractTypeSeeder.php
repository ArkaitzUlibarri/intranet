<?php

namespace Database\Seeders;

use App\Models\ContractType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        ContractType::truncate();

        $contract_types = [
            ['code' => '100', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'ORDINARIO', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '109', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'FOMENTO CONTRATACIÓN INDEFINIDA', 'characteristic_2' => 'TRANSFORMACIÓN CONTRATO TEMPORAL', 'holidays' => 22],
            ['code' => '130', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'DISCAPACITADOS', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '139', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'DISCAPACITADOS', 'characteristic_2' => 'TRANSFORMACIÓN CONTRATO TEMPORAL', 'holidays' => 22],
            ['code' => '150', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'FOMENTO CONTRATACIÓN INDEFINIDA', 'characteristic_2' => 'INICIAL', 'holidays' => 22],
            ['code' => '189', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => null, 'characteristic_2' => 'TRANSFORMACIÓN CONTRATO TEMPORAL', 'holidays' => 22],
            ['code' => '200', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'ORDINARIO', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '209', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'FOMENTO CONTRATACIÓN INDEFINIDA', 'characteristic_2' => 'TRANSFORMACIÓN CONTRATO TEMPORAL', 'holidays' => 22],
            ['code' => '230', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'DISCAPACITADOS', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '239', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'DISCAPACITADOS', 'characteristic_2' => 'TRANSFORMACIÓN CONTRATO TEMPORAL', 'holidays' => 22],
            ['code' => '250', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'FOMENTO CONTRATACIÓN INDEFINIDA', 'characteristic_2' => 'INICIAL', 'holidays' => 22],
            ['code' => '289', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => null, 'characteristic_2' => 'TRANSFORMACIÓN CONTRATO TEMPORAL', 'holidays' => 22],
            ['code' => '300', 'name' => 'INDEFINIDO', 'working_day' => 'FIJO DISCONTINUO', 'characteristic_1' => null, 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '309', 'name' => 'INDEFINIDO', 'working_day' => 'FIJO DISCONTINUO', 'characteristic_1' => 'FOMENTO CONTRATACIÓN INDEFINIDA', 'characteristic_2' => 'TRANSFORMACIÓN CONTRATO TEMPORAL', 'holidays' => 22],
            ['code' => '330', 'name' => 'INDEFINIDO', 'working_day' => 'FIJO DISCONTINUO', 'characteristic_1' => 'DISCAPACITADOS', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '339', 'name' => 'INDEFINIDO', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'DISCAPACITADOS', 'characteristic_2' => 'TRANSFORMACIÓN CONTRATO TEMPORAL', 'holidays' => 22],
            ['code' => '350', 'name' => 'INDEFINIDO', 'working_day' => 'FIJO DISCONTINUO', 'characteristic_1' => 'FOMENTO CONTRATACIÓN INDEFINIDA', 'characteristic_2' => 'INICIAL', 'holidays' => 22],
            ['code' => '389', 'name' => 'INDEFINIDO', 'working_day' => 'FIJO DISCONTINUO', 'characteristic_1' => null, 'characteristic_2' => 'TRANSFORMACIÓN CONTRATO TEMPORAL', 'holidays' => 22],
            ['code' => '401', 'name' => 'DURACIÓN DETERMINADA', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'OBRA O SERVICIO DETERMINADO', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '402', 'name' => 'DURACIÓN DETERMINADA', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'EVENTUAL CIRCUNSTANCIAS DE LA PRODUCCIÓN', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '403', 'name' => 'DURACIÓN DETERMINADA', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'INSERCIÓN', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '408', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => null, 'characteristic_2' => 'CARÁCTER ADMINISTRATIVO', 'holidays' => 22],
            ['code' => '410', 'name' => 'DURACIÓN DETERMINADA', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'INTERINIDAD', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '418', 'name' => 'DURACIÓN DETERMINADA', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'INTERINIDAD', 'characteristic_2' => 'CARÁCTER ADMINISTRATIVO', 'holidays' => 22],
            ['code' => '420', 'name' => 'TEMPORAL TIEMPO', 'working_day' => 'COMPLETO', 'characteristic_1' => 'PRÁCTICAS', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '421', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'FORMACIÓN Y APRENDIZAJE', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '430', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'DISCAPACITADOS', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '441', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'RELEVO', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '450', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'FOMENTO CONTRATACIÓN INDEFINIDA', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '452', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO COMPLETO', 'characteristic_1' => 'EMPRESAS DE INSERCIÓN', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '501', 'name' => 'DURACIÓN DETERMINADA', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'OBRA O SERVICIO DETERMINADO', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '502', 'name' => 'DURACIÓN DETERMINADA', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'EVENTUAL CIRCUSTANCIAS DE LA PRODUCCIÓN', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '503', 'name' => 'DURACIÓN DETERMINADA', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'INSERCIÓN', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '508', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => null, 'characteristic_2' => 'CARÁCTER ADMINISTRATIVO', 'holidays' => 22],
            ['code' => '510', 'name' => 'DURACIÓN DETERMINADA', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'INTERINIDAD', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '518', 'name' => 'DURACIÓN DETERMINADA', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'INTERINIDAD', 'characteristic_2' => 'CARÁCTER ADMINISTRATIVO', 'holidays' => 22],
            ['code' => '520', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'PRÁCTICAS', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '530', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'DISCAPACITADOS', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '540', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'JUBILADO PARCIAL', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '541', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'RELEVO', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '550', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'FOMENTO CONTRATACIÓN INDEFINIDA', 'characteristic_2' => null, 'holidays' => 22],
            ['code' => '552', 'name' => 'TEMPORAL', 'working_day' => 'TIEMPO PARCIAL', 'characteristic_1' => 'EMPRESAS DE INSERCIÓN', 'characteristic_2' => null, 'holidays' => 22],
        ];

        foreach ($contract_types as $type) {
            ContractType::insert($type + ['created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
