<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\DeveloperController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TablesController extends DeveloperController
{
    public function __construct()
    {
        $this->data['active'] = 'table_builder';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $default_table = config('starter.default_tables');

        $available_tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();

        $tables = [];

        foreach ($available_tables as $at) {
            if (!in_array($at, $default_table)) {
                array_push($tables, $at);
            }
        }

        $this->data['tables'] = $tables;
        $this->data['title'] = 'Tables List';
        return $this->dev_view('tables.list', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = 'Table Add';
        return $this->dev_view('tables.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
