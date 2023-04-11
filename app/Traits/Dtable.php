<?php

namespace App\Traits;

trait Dtable {
    /**
     * @author Jayesh
     * 
     * @uses Performs searching, sorting, pagination, per page functionality on records
     * 
     * @param  mixed $request
     * @param  mixed $model
     * @return void
     */
    public function datatable($request, $model)
    {
        $model = new $model();
        $searchableColumns = $model->searchable;
        $selectableColumns = $model->selectable;
        $orderableColumns = $model->orderable;

        $draw = $request->post('draw');
        $start = $request->post("start");
        $limit = $request->post("length");

        $search = $request->post('search')['value'];
        $direction = $request->post('order')[0]['dir'];
        $columnName = $orderableColumns[$request->post('order')[0]['column']];

        // Total records count
        $recordsTotal = $model::select('COUNT(*) AS allcount')->count();

        // Filtered records count
        $recordsFiltered = $model::select('COUNT(*) AS allcount')
                                        ->whereLike($searchableColumns, $search)
                                        ->count();

        // Fetch records
        $records = $model->orderBy($columnName, $direction)
                        ->whereLike($searchableColumns, $search)
                        ->select($selectableColumns)
                        ->skip($start)
                        ->take($limit)
                        ->get();

        $data['draw'] = intval($draw);
        $data['recordsTotal'] = intval($recordsTotal);
        $data['recordsFiltered'] = intval($recordsFiltered);
        $data['records'] = $records;

        return $data;
    }
}