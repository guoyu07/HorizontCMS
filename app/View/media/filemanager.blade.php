<section class='container'>

  <section class='row'>

  <div class='col-md-4'>
    <h2>File manager</h2>
  </div>

  <div class='col-md-8' style='text-align:right;padding-top:15px;'>
    <a class='btn btn-primary' data-toggle='modal' data-target='.upload_file_to_storage'><i class="fa fa-upload" aria-hidden="true"></i></a>
    <a class='btn btn-primary' data-toggle='modal' data-target='.new_folder'><i class="fa fa-folder" aria-hidden="true"></i></a>
  </div>

  </section>

<div class='panel panel-default col-md-2' style='padding:0px;'>
 <ul class="list-group">
  <a href='admin/file-manager?path=images'><li class="list-group-item">images</li></a>
  <li class="list-group-item">uploads</li>
  <li class="list-group-item">themes</li>
  <li class="list-group-item">plugins</li>
</ul>
</div>


<div class="panel panel-default col-md-10" >
  <div class="panel-body">
      <ol class="breadcrumb">
			  <li><a href="admin/file-manager/{{$action}}?path=">root</a></li>
        @foreach($tree as $dir)
          <li><a href="admin/file-manager/{{$action}}?path={{$dir}}">{{$dir}}</a></li>
        @endforeach
			</ol>

            @foreach($dirs as $dir)
                <div class='file col-md-2' style='overflow:hidden;height:140px;cursor:pointer;' ondblclick=" window.location.href = 'admin/file-manager/{{$action}}?path=<?= $old_path.$dir ?>' ">
                  {!! Html::img('resources/images/icons/dir.png',"style='width:100%;'") !!}
                  <center><b>{{$dir}}</b></center><br>
                </div>
            @endforeach

            @foreach($files as $file)
                <?php $file_parts = pathinfo($file) ?>
                <div class='file col-md-2' style='overflow:hidden;height:140px;cursor:pointer;' @if($action=='ckbrowse') onclick='returnFileUrl("<?= 'storage/'.$old_path.$file ?>");' @else data-toggle='modal' data-target='.{{$file}}-modal-xl' @endif >
                @if(isset($file_parts['extension']) && in_array($file_parts['extension'],$allowed_extensions['image']))
                  <img src="{{'storage/'.$old_path.$file}}" style='object-fit:cover;width:100%;height:100px;' />
                @else
                 <img src="resources/images/icons/file.png" style='object-fit:cover;width:100%;height:100px;margin-bottom:15px;' />
                @endif
                  <center><b>{{$file}}</b></center><br>
                </div>
            @endforeach


  </div>
</div>

</section>


<style>

	.list-group-item:hover{
		border-radius: 0px;
		color:white;
		background-color: #337ab7;	
	}

	.file:hover{
		border-radius:3px;
		color:white;
		background-color: #337ab7;
	}
</style>







<div class='modal upload_file_to_storage' id='upload_file_to_storage' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header modal-header-primary'>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title'>Upload file</h4>
      </div>
      <div class='modal-body'>

      <form action='admin/file-manager/fileupload' method='POST' enctype='multipart/form-data'>
      {{ csrf_field() }}
      <div class='form-group'>
        <label for='file'>Upload file:</label>
        <input type='hidden' name='dir_path' value="{{ $current_dir }}">
        <input name='up_file[]' id='input-2' type='file' class='file' multiple='true' data-show-upload='false' data-show-caption='true'>
      </div>


      </div>
      <div class='modal-footer'>
        <button type='submit' class='btn btn-primary'>Upload</button></form>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class='modal new_folder' id='new_folder' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header modal-header-primary'>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title'>Create new folder</h4>
      </div>
      <div class='modal-body'>

<form action='admin/file-manager/newfolder' method='POST' enctype='multipart/form-data'>
      {{ csrf_field() }}
<div class='form-group'>
      <input type='hidden' name='dir_path' value="{{ $old_path }}">
      <div class='form-group' >
       <label for='title'>Name:</label>  
        <input type='text' class='form-control' name='new_folder_name' placeholder='Enter folder name' required>
      </div>    
    </div>


      </div>
      <div class='modal-footer'>
        <button type='submit' class='btn btn-primary'>Create</button></form>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
        // Helper function to get parameters from the query string.
        function getUrlParam( paramName ) {
            var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
            var match = window.location.search.match( reParam );

            return ( match && match.length > 1 ) ? match[1] : null;
        }
        // Simulate user action of selecting a file to be returned to CKEditor.
        function returnFileUrl(filepath) {

            var funcNum = 1;/*getUrlParam( 'CKEditorFuncNum' );*/
            var fileUrl = filepath;
            window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
            window.close();
        }
</script>