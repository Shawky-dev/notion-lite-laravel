<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Section\SectionRequest;
use App\Models\Board;
use App\Models\Section;
use App\Services\SectionServices;
use Illuminate\Http\Request;

class SectionController extends ApiController
{
    protected $sectionServices;


    public function __construct(SectionServices $sectionServices)
    {
        $this->sectionServices = $sectionServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request, Board $board)
    {
        $newSection = $this->sectionServices->store($request->all(), $board, $request->user());
        $success['section'] = $newSection;
        return $this->sendResponse($success, 'Create a new section successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, Section $section)
    {
        $updatedSection = $this->sectionServices->update($request->all(), $section, $request->user());
        $success['section'] = $updatedSection;
        return $this->sendResponse($success, 'Section updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Section $section)
    {
        $this->sectionServices->destroy($section, $request->user());
        return $this->sendResponse([], 'Section deleted successfully');
    }
}
