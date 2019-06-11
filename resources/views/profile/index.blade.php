@extends('layouts.master')

@section('content')
    <div class="row equal" id="user-info-container">
        <div class="col-sm-3 text-center app-tertiary-bg">
            <div class="profile-img-container mb-3">
                <img src="{{ URL::to($profile->img_uri) }}" />
            </div>
            <h5><strong>{{ $profile->username }}</strong></h5>
            <h6 class="app-icon-size-3"><i class="fas fa-users app-icon-primary-color"></i> Seguidores: <span id="total-followers">{{ $profile->totalFollowers}}</span></h6>
            @if($profile->id !== Auth::user()->profiles->id)
                <button class="btn btn-dark btn-sm rounded-pill app-btn-secondary app-btn-lg app-font-size-2 px-4 ml-2" id="btn-follow" data-user-id="{{ $profile->id }}" data-follow-status="{{ ($following) ? 'unfollow' : 'follow'}}">{{ ($following) ? 'Dejar de seguir' : 'Seguir'}}</button>
            @else
                <button class="btn btn-dark btn-sm rounded-pill app-btn-secondary app-btn-lg app-font-size-2 px-4 ml-2" data-toggle="modal" data-target="#add-new-photo">Cambiar foto</button>
            @endif
        </div>

        <div class="col-sm-8 app-equal-left-space app-tertiary-bg">

            <h4 class="personal-info-heading">Información personal</h4>

            <div class="row">
                <div class="col-sm-3">
                    <label><i class="fas fa-user app-icon-primary-color app-icon-size-3"></i> Nombre</label>
                </div>
                <div class="col-sm-8">
                    <h6>{{ $profile->username }}</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <label><i class="fas fa-envelope app-icon-primary-color app-icon-size-3"></i> Correo</label>
                </div>
                <div class="col-sm-8">
                    <h6>{{ $profile->email }}</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <label><i class="fas fa-map-marker app-icon-primary-color app-icon-size-3"></i> Ubicación</label>
                </div>
                <div class="col-sm-8">
                    <h6>{{ $profile->location }}</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <label><i class="fas fa-birthday-cake app-icon-primary-color app-icon-size-3"></i> Cumpleaños</label>
                </div>
                <div class="col-sm-8">
                    <h6>{{ $profile->birthday }}</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <label>
                        <span>
                            <i class="fas fa-female app-icon-primary-color app-icon-size-3"></i>
                            <i class="fas fa-male app-icon-primary-color app-icon-size-3"></i>
                        </span>
                        Genero
                    </label>
                </div>
                <div class="col-sm-8">
                    <h6>{{ $profile->gender }}</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <label><i class="fas fa-birthday-cake app-icon-primary-color app-icon-size-3"></i> Biografia</label>
                </div>
                <div class="col-sm-8">
                    <h6>{{ $profile->bio }}</h6>
                </div>
            </div>

        </div>
    </div>
    <br />

    <div class="row">
        <div class="col-sm-3 user-friends">
            <label class="heading app-primary-bg app-color-tertiary">Amigos</label>
            <ul class="friends" id="friends">
                @include('friend.friend-temp')
            </ul>
        </div>

        <div class="col-sm-8 user-post app-equal-left-space">
            <label class="heading app-secondary-bg app-color-tertiary">Publicaciones</label>
            @include('post.post-temp')
        </div>
    </div>

    <!-- Init styles of add new photo-->
    <div class="modal fade" id="add-new-photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <label id="error-message-id" class="alert alert-primary">Por favor seleccione una imagen menor de 3mb con los siguientes formatos: .png, .jpg, .jpeg, .gif</label>
                    <form id='upload-file-form' action="{{ route('profile.image') }}" enctype='multipart/form-data' method='post'>
                        {{ csrf_field() }}
                        <label for='input-file' class='text-center label-for-input-file'>Agregar imagen</label>
                        <input type='file' id='input-file' name='file' accept='img'/>
                        <div class='upload-image-container'>
                            <img src='' id='image-to-upload' alt='No ha seleccionado ninguna imagen'/>
                        </div>

                        <input type='submit' id='btn-upload-image' class='btn btn-sm app-btn-primary' value='Cambiar foto de perfil' disabled/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End styles of add new photo-->
<script type="text/javascript" src="{{ URL::to('js/service/followService.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('js/controller/followController.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('js/helper/FileHelperValidation.js') }}"></script>
<script>
    $('document').ready(function(){
        $('#btn-follow').click(function(){
            FollowController.following();
        });
    });
</script>
@endsection