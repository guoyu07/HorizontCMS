<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Libs\Controller;


class FileManagerController extends Controller{
 


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug){


        $current_dir = $this->request->get('path')==NULL? "" : ltrim($this->request->get('path'),"/");

        //dd($current_dir);


        $this->view->title(trans('File Manager'));
        return $this->view->render('media/fmframe',[
                'action' => 'index',
                'old_path' => ($current_dir==""? "":$current_dir."/"),
                'current_dir' => $current_dir,
                'tree' => explode("/",$current_dir),
                'dirs' => collect(\File::directories(storage_path().DIRECTORY_SEPARATOR.$current_dir))->map(function($dir){
                    return str_replace(storage_path().DIRECTORY_SEPARATOR.$this->request->get('path').DIRECTORY_SEPARATOR,"",$dir);
                }),
                'files' => collect(\File::files(storage_path().DIRECTORY_SEPARATOR.$current_dir))->map(function($file){
                    return str_replace(storage_path().DIRECTORY_SEPARATOR.$this->request->get('path')."/","",$file);
                }),
                'allowed_extensions' => [
                                          'image' => ['jpg','png','jpeg']
                                        ],
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileupload(){
        
        if($this->request->isMethod('POST')){

            if ($this->request->hasFile('up_file')){

            foreach($this->request->up_file as $file){
               $asd = $file->store(ltrim($this->request->input('dir_path'),"storage/"));
            }
               
            return $this->redirectToSelf()->withMessage(['success' => 'Files uploaded successfully']);

            }

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newfolder(){
        
        if($this->request->isMethod('POST')){
            
            if(!file_exists($this->request->input('dir_path')."/".$this->request->input('new_folder_name'))){
                \File::makeDirectory("storage/".$this->request->input('dir_path')."/".$this->request->input('new_folder_name'), $mode = 0777, true, true);
                return $this->redirectToSelf()->withMessage(['success' => 'Folder created successfully!']);
            }else{
                return $this->redirectToSelf()->withMessage(['danger' => 'Folder already exists!']);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ckbrowse(){
         $current_dir = $this->request->get('path')==NULL? "" : ltrim($this->request->get('path'),"/");


        $this->view->title(trans('File Manager'));
        return $this->view->render('media/fmframeckeditor',[
                'action' => 'ckbrowse',
                'old_path' => ($current_dir==""? "":$current_dir."/"),
                'current_dir' => $current_dir,
                'tree' => explode("/",$current_dir),
                'dirs' => collect(\File::directories(storage_path().DIRECTORY_SEPARATOR.$current_dir))->map(function($dir){
                    return str_replace(storage_path().DIRECTORY_SEPARATOR.$this->request->get('path').DIRECTORY_SEPARATOR,"",$dir);
                }),
                'files' => collect(\File::files(storage_path().DIRECTORY_SEPARATOR.$current_dir))->map(function($file){
                    return str_replace(storage_path().DIRECTORY_SEPARATOR.$this->request->get('path')."/","",$file);
                }),
                'allowed_extensions' => [
                                          'image' => ['jpg','png','jpeg']
                                        ],
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }


    /**
     * Remove the specified resource from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        
    }


    public function browse(){
        return "asd";
    }


    public function upload(){
        
    }


}
