<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveApplicatinRequest;
use App\Models\Application;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\FileUploaded;
use App\Http\Requests\UpdateApplicationRequest;
use App\Services\ApplicationService;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    private $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $applications = $this->applicationService->index($request);

        session()->flashInput($request->input());

        return view('admin.applications.index')->with('applications', $applications);
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
            
            $data = [
                'name' => $request->name,
                'lname' => $request->lname,
                'cv' => null,
            ];

            if ($request->hasFile('cv')) 
            {
                $cv = $request->file('cv');
                $destination = 'public/Application_cv'; // Destination directory
            
                $path = event(new FileUploaded($cv, $destination));
            
                // Ensure $path is an array and retrieve the first element
                $path = is_array($path) ? reset($path) : $path;
            
                // Update the $data array with the retrieved path
                $data['cv'] = $path;
            }

            $this->applicationService->create($data);
    
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
        $application = $this->applicationService->edit($id);

        return view('admin.applications.edit')->with('application', $application);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        try {
            $validated = $request->validated();

            $data = [
                'name' => $request->name,
                'lname' => $request->lname,
                'cv' => $application->cv
            ];

            if ($request->hasFile('cv')) 
            {
                Storage::delete($application->cv);

                $cv = $request->file('cv');
                $destination = 'public/Application_cv'; // Destination directory
            
                $path = event(new FileUploaded($cv, $destination));
            
                // Ensure $path is an array and retrieve the first element
                $path = is_array($path) ? reset($path) : $path;
            
                // Update the $data array with the retrieved path
                $data['cv'] = $path;
            }

            $application->update($data);

            return back()->with('success', 'Application Updated');
        } 
        catch (\Exception $e) 
        {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        try 
        {
            $application = $this->applicationService->delete($application);

            return back()->with('success', 'Application Deleted');

        } 
        catch (\Exception $e) 
        {
            return back()->with('error', $e->getMessage());
        }
    }
}
