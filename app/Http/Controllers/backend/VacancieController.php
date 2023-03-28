<?php

namespace App\Http\Controllers\backend;
use App\Models\Vacancie; 
use App\Http\Controllers\Controller;
use App\Models\Career; 
use App\Models\Department; 

use Illuminate\Http\Request;

class VacancieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // tìm kiếm
        // $name = request()->query('name');
        $name = $request->name;
        // dd($name);
        $career = Vacancie::orderBy('id','DESC');
        // kt name nếu có gtri
        if ($name) {
            $career = $career->where('name','like','%' .$name. '%');
        }
        $career = $career->get();
        
        //    ktr co bản ghi thì báo
        if ($career->count()) {
            $status = 'success';
        } else {
            $status = 'no_data';
        }
        $response = [
            'status' => $status,
            'data' => $career,
        ];
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // validate 
        $this->validation($request);

        // false -   Accept = application/json
        $method = $request ->method();
        if($method=='POST'){
                $career = Vacancie::create($request->all());
                $response = [
                    'status' => 'success',
                    'data' => $career,
                ];
            }else{
                $response = [
                    'status' => 'err',
                ];
            }
            return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // xem 1 ban ghi
    public function show($id)
    {
        // chuyển APP_DEBUG=false
        $career = Vacancie::find($id);
        // ktra
        if (!$career) {
            $status = 'no data';
        } else {
            $status = 'success';
        }
        // trả về
        $response = [
            'status' => $status,
            'data' => $career,
        ];
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
       
        $career = Vacancie::find($id);
        if (!$career) {
            $response = [
                'status' => 'no_data',
            ];
        } else {
            $career->update($request->all());
            $response = [
                'status' => 'success',
                'data' => $career,
            ];
            return $response;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $career = Vacancie::find($id);
        // ktr xóa không tc
        if ($career) {
            $career->delete();
            $response = [
                'status' => 'success delete',
            ];
        } else {
            $response = [
                'status' => 'err delete',
            ];
        }
        return $response;
    }

    public function validation($request, $id=0)
    { 
        $rules = [
            'name' => 'required',
            'career_id' => 'exists:vacancies',
            'department_id' => 'exists:vacancies'
        ];
        $messages = [
            'name.required' => 'tên không được trống',
            'career_id.exists' => 'career_id không tồn tại',
            'department_id.exists' => 'department_id không tồn tại',
        ];
        $request->validate($rules, $messages);
    }
    
}