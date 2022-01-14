<?php


namespace App\Traits;


use App\Models\CSVData;
use Exception;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

trait StoreCsvData
{
    /**
     * -----------------------------------------------
     * process the csv file and extract data to store
     * -----------------------------------------------
     * @param string $file
     * @param array $data
     * @param $queued_at
     * @return string
     * @throws Exception
     */
    public function storeCsvData(string $file, array $data, $queued_at): string
    {
        try {
            // generate uuid
            $uuid = Uuid::generate()->string;

            // store to db
            DB::transaction(function () use ($uuid, $file, $data, $queued_at) {
                DB::table((new CSVData())->getTable())->insert([
                    'id' => $uuid,
                    'file' => $file,
                    'data' => json_encode($data),
                    'queued_at' => $queued_at,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }, 5);// attempt 5 times storing the extracted data if it fails then throw exception

            return $uuid;

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
