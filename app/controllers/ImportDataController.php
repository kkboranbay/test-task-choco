<?php

class ImportDataController
{
    public function import()
    {
        $fileName = $_FILES["file"]["tmp_name"];

        if ($_FILES["file"]["size"] > 0) {

            $file = fopen($fileName, "r");

            fgetcsv($file);
            while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
                $id = "";
                if (isset($column[0])) {
                    $id = trim($column[0]);
                }
                $title = "";
                if (isset($column[1])) {
                    $title = trim($column[1]);
                }
                $startDate = "";
                if (isset($column[2])) {
                    $startDate = strtotime(trim($column[2]));
                }
                $endDate = "";
                if (isset($column[3])) {
                    $endDate = strtotime(trim($column[3]));
                }
                $status = "";
                if (isset($column[4])) {
                    $status = trim($column[4]);

                    if ($status == 'On') {
                        $status = 1;
                    } elseif ($status == 'Off') {
                        $status = 0;
                    }
                }

                $params = [
                    'id'         => $id,
                    'title'      => $title,
                    'start_date' => $startDate,
                    'end_date'   => $endDate,
                    'status'     => $status
                ];

                App::get('database')->insert('promotions', $params);

            }

            if (Request::wantsJson()) {
                return Response::json('Imported');
            }

            redirect('.');

        }
    }
}