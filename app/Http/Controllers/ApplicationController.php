<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveApplicatinRequest;
use App\Models\Applications;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveApplicatinRequest $request)
    {
        try 
        {
            $validated = $request->validated();

            $application = new Applications;
    
            $application->name = $request->name;
            $application->lname = $request->lname;
            
            if ($request->file('cv')) 
            {
                $cv = $request->file('cv');
                $filenameWithExt = $cv->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $cv->getClientOriginalExtension();
                $filenametostore = $filename . '_' . time() . '.' . $extension; //makes the name unique
    
                $filenametostore = str_replace(' ', '', $filenametostore);  //delete spaces
                $path = $cv->storePubliclyAs('public/applications_cv', $filenametostore);
    
                $application->cv = $path;
            }
    
            $application->save();
    
            return back()->with('success', 'Application Submited');
    
        } 
        catch (Exception $e)
        { 
            return back()->with('error', "$e");
            //return back()->with('error', 'Something Went Wrong');
        }
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
