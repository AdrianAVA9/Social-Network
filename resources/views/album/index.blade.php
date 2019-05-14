@extends('layouts.master')

@section('content')
    <div class="alert alert-success alert-dismissible fade show message hidden" role="alert">
        El album fue exitosamente eliminado.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="alert alert-primary app-primary-bg app-color-tertiary" role="alert">
                Albumes
            </div>
            <ul class="album-container">
                @foreach($albums as $user_album)
                    <li class="album-item" data-album-id="{{ $user_album->id }}"><a href="{{ route('album.index',['id' => $user_album->user_id, 'album_id' => $user_album->id]) }}">{{ $user_album->name }}</a></li>
                @endforeach
            </ul>
            @if($is_mine)
                <a href="#" class="float-right app-primary-color app-font-size-3" data-toggle="modal" data-target="#add-new-album"><span class="app-icon-size-3">+ </span>Agregar album</a>
            @endif
        </div>

        <div class="col-sm-9 album-photos-container">
            @if($is_mine and $album != null)
                <ul class="nav float-right mr-5 mt-3 album-options">
                    <li class="nav-item mr-3">
                        <a href="#" class="app-primary-color app-font-size-3" id="add-new-photo" data-toggle="modal" data-target="#add-new-photo"><span class="app-icon-size-3">+ </span>Agregar foto</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="app-primary-color app-font-size-3" id="delete-album" data-album-id="{{ ($album !== null) ? $album->id : '-1'}}">- Eliminar album</a>                        
                    </li>
                </ul>
            @endif
            <h6 class="album-name mt-5" id="current-album-name">Album: <strong>{{ ($album != null) ? $album->name : '' }}</strong></h6>
            <div class="app-container">
                @if($album != null)
                    @if(count($album->images) > 0)
                        @foreach($album->images as $image)
                            <div class="album-img mx-2 my-2">
                                <img src="{{ URL::to($image->img_uri) }}" alt="{{ $image->name }}">
                            </div>
                        @endforeach
                    @else
                        <div class="jumbotron any-picture-container text-center">
                            <h6 class="app-font-size-3"><strong>No hay fotos registradas!!!</strong></h6>
                            @if($is_mine)
                                <button class="btn btn-small app-btn-primary rounded px-3 py-1 app-font-size-3" data-toggle="modal" data-target="#add-new-photo">Agregar</button>
                            @endif
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    @if($is_mine and $album != null or count($albums) < 1)
        <!-- Init styles of add new album-->
        <div class="modal fade" id="add-new-album" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('album.create') }}" method="post">
                            {{ csrf_field() }}
                            <label for="album_name">Nombre</label>
                            <input type="text"  class="form-control mb-1" placeholder="Nombre del album" name="album_name">
                            <div class="form-inline mb-3">
                                <input type="checkbox" name="is_public" id="is_public" class="mr-1 ml-2">
                                <label for="is_public" class="app-font-size-3">Publico</label>
                            </div>
                            <br>
                            <button type="button" class="btn btn-sm btn-secondary app-btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-sm btn-primary app-btn-primary">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End styles of add new album-->
        @endif

        @if($is_mine and $album != null)
        <!-- Init styles of add new photo-->
        <div class="modal fade" id="add-new-photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <label id="error-message-id" class="alert alert-primary">Por favor seleccione una imagen menor de 3mb con los siguientes formatos: .png, .jpg, .jpeg, .gif</label>
                        <form id='upload-file-form' action="{{ route('album.image') }}" enctype='multipart/form-data' method='post'>
                            {{ csrf_field() }}
                            <label for='input-file' class='text-center label-for-input-file'>Agregar imagen</label>
                            <input type='file' id='input-file' name='file' accept='img'/>
                            <input type="text" name="album-id" value="{{ ($album !== null) ? $album->id : '-1'}}" hidden>
                            <div class='upload-image-container'>
                                <img src='' id='image-to-upload' alt='No ha seleccionado ninguna imagen'/>
                            </div>

                            <input type='submit' id='btn-upload-image' class='btn btn-sm app-btn-primary' value='Guardar imagen' disabled/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End styles of add new photo-->
        <script src="{{ URL::to('js/helper/fileHelperValidation.js') }}"></script>
    @endif

    <script src="{{ URL::to('js/bootbox.min.js') }}"></script>
    <script>
        $('document').ready(function(){

            $('#delete-album').click(function(e){
                var link = $(e.target);
				bootbox.dialog({
					message: "Esta seguro que quiere eliminar el "+ $('#current-album-name').text() +"?",
					title: "Confirm",
					buttons: {
						No: {
							label: "Cancelar",
							className: "btn-default",
							callback: function() {
								bootbox.hideAll();
							}
						},
						Yes: {
							label: "Aceptar",
							className: "btn-danger",
							callback: function(result) {
								$.ajax({
										url: "/profile/album/" + link.attr("data-album-id"),
                                        method: "DELETE",
                                        data: {
                                            "_token": "{{ csrf_token() }}" 
                                        }
									})
									.done(function() {
                                        removeAlbum(link.attr("data-album-id"));
                                        $('.album-options').hide();
                                        $('#current-album-name').text('Album:')
                                        $('.app-container').hide();
                                        $('.message').show();
									})
									.fail(function(error) {
                                        console.log('Something fail');
										console.log(error);
									});
							}
						}
					}
                });
                
                function removeAlbum(id){
                    var albums = $('.album-container').children();

                    for(var i=0; i < albums.length; i++){
                        var album = albums[i];

                        if($(album).attr('data-album-id') == id){
                            $(album).fadeOut(function(){
                                this.remove();
                            });
                        }
                    }
                }
            });

        });
    </script>
@endsection