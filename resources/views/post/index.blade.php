@extends('layouts.master')

@section('content')
    @if(count($errors->all()))
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-md-center">
            <form class="form-inline create-post-form app-tertiary-bg" action="{{ route('post.create') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="form-group">
                    <div class="app-rounded-image">
                        <img src="{{ URL::to(Auth::user()->profiles->img_uri) }}" alt="profile picture">      
                    </div>
                </div>
                <div class="form-group input-content mx-sm-3">
                    <input type="text" class="form-control" id="post-content" name="content" placeholder="¿En que esta pensando?">
                </div>
                <input type="file" id="input-post-img" name="post_image" accept='img' hidden>
                {{csrf_field()}}
                <button type="submit" id="btn-send-post" class="btn btn-primary app-primary-bg" disabled>Post</button>
            </form>
        </div>
        <div class="row justify-content-md-center">
        <div class="add-post-img app-tertiary-bg">
                <label for="input-post-img" class="app-primary-color"><i class="far fa-images"></i> <span class="ml-2" id="attached-img"></span></label>
            </div>
        </div>
    </div>

    <div class="row justify-content-md-center mt-2">
        <div class="user-post">
            @include('post.post-temp')
        </div>
    </div>

    <script>
        $('document').ready(function(){
            $('#post-content').keyup(function(){
                if($('#post-content').val().length > 0){
                    enableButton(false);
                }else{
                    enableButton(true);
                }
            });

            $('#input-post-img').change(function(){
                isValid = isValidFile($(this));

                enableButton(isValid ? false : true);
                attachedImage(isValid ? true : false);
            });

            //This method validates if the file extension is allowed
            function isAllowedExtension(extension){
                var error = true;
                var allowedExtension = ['.png','.jpg','.jpeg','.gif']; //Include or remove extensions
                if (!allowedExtension.includes(extension)) { error = false; }
                return error;
            }

            //This method get the file extension
            function getExtension(path){
                var indexOf = path.lastIndexOf('.');
                return path.substr(indexOf, path.length).toLowerCase();
            }
            
            function attachedImage(value){
                $('#attached-img').text(value ? 'Imagen adjunta' : 'Archivo no permitido');
                //$('#attached-img').prop('hidden',true);
            }

            function isValidFile(inputFile){
                isValid = false;

                if ($(inputFile).get(0).files.length > 0) {
                    if (isAllowedExtension(getExtension($(inputFile).val()))){
                        if ($(inputFile).get(0).files[0].size <= 3145728) { //Increase or decrease the size. It's initialed with 3mb. 1 megabyte = 1048576 bytes
                            isValid = true;

                        }
                    }
                }

                return isValid;
            }

            function enableButton(enable){
                if(enable === false && ($('#post-content').val().length > 0 && ($('#input-post-img').get(0).files.length == 0 || isValidFile($('#input-post-img')))) || 
                isValidFile($('#input-post-img'))){ 
                    $('#btn-send-post').prop('disabled', false);
                }else{
                    $('#btn-send-post').prop('disabled', true);
                }
            }
        });
    </script>
@endsection