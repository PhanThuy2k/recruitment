<?php

namespace App\Http\Controllers\backend;
use App\Models\Recruitment_channel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate_source;

class RecruitmentChannelController extends Controller
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
        $career = Recruitment_channel::orderBy('id','DESC');
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
        // false -   Accept = application/json
        $rules = [
            'name' => 'required|min:3|unique:careers',
        ];
        $messages = [
            'name.required' => 'tên không được trống',
            'name.min' => 'tên ít nhất 3 kí tự',
            'name.unique' => 'tên đã tồn tại',
        ];
        $request->validate($rules, $messages);
        $career = Recruitment_channel::create($request->all());

        if ($career->id) {
            $response = [
                'status' => 'success',
                'data' => $career,
            ];
            return $response;
        }

        // return redirect()->route('career.index')->with('success','thêm mới thành công');
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
        $career = Recruitment_channel::find($id);
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
        $rules = [
            'name' => 'required|min:3|unique:careers',
        ];
        $messages = [
            'name.required' => 'tên không được trống',
            'name.min' => 'tên ít nhất 3 kí tự',
            'name.unique' => 'tên đã tồn tại',
        ];
        $request->validate($rules, $messages);
        $career = Recruitment_channel::find($id);
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
        $career = Recruitment_channel::find($id);
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
}

