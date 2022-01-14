<?php


namespace App\Traits;


trait CsvRules
{
    /**
     * Create all the csv validation rules here
     * @return string[][]
     */
    public function uploadEmployeeRules()
    {
        // validate the csv here
        return [
            'name' => ['string', 'nullable'],
            'employee_number' => ['string', 'max:255', 'nullable'],
            'employee_designation' => ['string', 'nullable'],
            'joining_date' => ['date', 'nullable'],
            'email' => ['string', 'nullable'],
            'cost center' => ['string', 'nullable'],
        ];
    }

    /**
     * Create all the csv validation rules here
     * @return string[][]
     */
    public function assignEmployeeRules()
    {
        // validate the csv here
        return [
            'EMPLOYEE NUMBER' => ['string', 'required'],
            'DEPARTMENT' => ['string', 'required'],
        ];
    }

    /**
     * Create all the csv validation rules here
     * @return string[][]
     */
    public function branchRules()
    {
        // validate the csv here
        return [
            'NAME' => ['string', 'required']
        ];
    }

    /**
     * Create all the csv validation rules here
     * @return string[][]
     */
    public function departmentRules()
    {
        // validate the csv here
        return [
            'DEPARTMENT' => ['string', 'required'],
            'SUPERVISOR EMAIL' => ['string', 'required', 'email'],
            'HEAD OF DEPARTMENT EMAIL' => ['string', 'required', 'email'],
        ];
    }

    /**
     * Create all the csv validation rules here
     * @return string[][]
     */
    public function teamRules()
    {
        // validate the csv here
        return [
            'EMAIL' => ['string', 'required', 'email'],
            'SUPERVISOR EMAIL' => ['string', 'required', 'email'],
        ];
    }
}
