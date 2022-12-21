<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\ModuleService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Http\Requests\StoreUpdateModule;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course)
    {
        $modules = $this->moduleService->getModulesByCourse($course);

        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateModule $request, $course)
    {
        $module = $this->moduleService->createNewModule($request->validated());
        
        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function show($course, string $identify)
    {
        $module = $this->moduleService->getModuleByCourse($course, $identify);
        
        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateModule $request, $course, $identify)
    {
        $this->moduleService->updateModule($identify, $request->validated());

        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function destroy($course, string $identify)
    {
        $module = $this->moduleService->deleteModule($identify);
        
        // após deletado, retorna status de 'no content'
        return response()->json([], 204);
    }
}
