<?php

class ImportDataController
{
    public function import()
    {
        return (new PromotionModel())->importDataFromCSV();
    }
}