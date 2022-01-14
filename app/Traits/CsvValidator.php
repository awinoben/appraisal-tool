<?php


namespace App\Traits;


use Exception;
use Illuminate\Support\Facades\Validator;

trait CsvValidator
{
    private $csvData;
    private $csvRules;
    private $headingRow;
    private $errors;

    public function construct()
    {
        //
    }

    /**
     * @param $csvPath
     * @param $rules
     * @param string $encoding
     * @return $this
     * @throws Exception
     */
    public function open($csvPath, $rules, string $encoding = 'UTF-8'): static
    {
        $this->csvData = [];
        $this->setRules($rules);

        $csvData = $this->getCsvAsArray($csvPath);

        if (empty($csvData)) {
            throw new Exception('No data found.');
        }

        $newCsvData = [];
        $ruleKeys = array_keys($this->csvRules);
        foreach ($csvData as $rowIndex => $csvValues) {
            foreach ($ruleKeys as $ruleKeyIndex) {
                $newCsvData[$rowIndex][$ruleKeyIndex] = $csvValues[$ruleKeyIndex];
            }
        }

        $this->csvData = $newCsvData;

        return $this;
    }

    /**
     * Given a File Path, convert to associate array.
     * If keyField is set then this will be used as a key else
     * it will use normal ascending indexes.
     *
     * E.g. when keyField = 'ID'
     * data in:
     * ID | Name
     * 10,Rick
     * data out:
     * [10 => ['ID' => 10, 'Name' => 'Rick']]
     *
     * E.g. when keyField = null
     * data in:
     * ID | Name
     * 10,Rick
     * data out:
     * [0 => ['ID' => 10, 'Name' => 'Rick']]
     *
     * @param string $filePath
     * @param string|null $keyField
     * @return array
     * @throws Exception
     */
    public function getCsvAsArray(string $filePath, string|null $keyField = null): array
    {
        $rows = array_map('str_getcsv', file($filePath));
        $rowKeys = array_shift($rows);

        $formattedData = [];
        foreach ($rows as $row) {
            // heck if the arrays are equal
            if (count($rowKeys) == count($row)) {
                $associatedRowData = array_combine($rowKeys, $row);

                if (empty($keyField)) {
                    $formattedData[] = $associatedRowData;
                } else {
                    $formattedData[$associatedRowData[$keyField]] = $associatedRowData;
                }
            } else {
                throw new Exception('The arrays have unequal length for ' . json_encode($row));
            }
        }

        return $formattedData;
    }

    public function fails(): bool
    {
        $errors = [];
        foreach ($this->csvData as $rowIndex => $csvValues) {
            $validator = Validator::make($csvValues, $this->csvRules);
            if (!empty($this->headingRow)) {
                $validator->setAttributeNames($this->headingRow);
            }
            if ($validator->fails()) {
                $errors[$rowIndex] = $validator->messages()->toArray();
            }
        }
        $this->errors = $errors;

        return (!empty($this->errors));
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getData()
    {
        return $this->csvData;
    }

    public function setAttributeNames($attribute_names)
    {
        $this->headingRow = $attribute_names;
    }

    private function setRules($rules)
    {
        $this->csvRules = $rules;
        $headingKeys = array_keys($rules);
    }
}
