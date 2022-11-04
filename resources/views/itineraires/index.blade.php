@extends('layouts.main')


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid" style="font-family: 'Century Gothic';">

                    <!-- Page Heading -->

                    <p class="mb-4">
                        <div class="row">
                                <div class="col-md-6 text-left">
                                    <a href="{{ URL::to('dashboard')  }}" type="button" class="btn btn-info btn-icon-back">
                                                        <span class="icon text-white-80">
                                                            <i class="fas fa-reply"></i>
                                                        </span>
                                                        <span class="text">Retour</span>
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                                @can('creer-itineraire')
                                                    <button type="button" data-toggle="modal" data-target="#modalItineraireIndexPage" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-icon-split">
                                                        <span class="icon text-white-80">
                                                            <i class="fas fa-plus" style="font-size:10px;"></i>
                                                            <i class="fa fa-thin fa-road fa-lg"></i>
                                                        </span>
                                                        <span class="text">AJOUT ITINERAIRE</span>
                                                    </button>
                                                @endcan
                                </div>
                        </div>
                    </p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-6 text-lg text-left" style="color:black;">
                                    Liste Des Itinéraires
                                </div>
                                <div class="col-md-6 text-right">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th><i class="fa fa-lg fa-thin fa-store mr-3" style="color:#252A37;"></i>POINT DEPART</th>
                                                <th><i class="fa fa-lg fa-thin fa-store mr-3" style="color:#252A37;"></i>POINT ARRIVE</th>
                                                <th><i class="fa fa-lg fa-thin fa-clock mr-3" style="color:#252A37;"></i>DUREE (HEURE)</th>
                                                <th><i class="fa fa-lg fa-toolbox mr-3" style="color:#252A37;"></i>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="bg-primary text-white">
                                            <tr>
                                                <th><i class="fa fa-lg fa-thin fa-store mr-3" style="color:#252A37;"></i>POINT DEPART</th>
                                                <th><i class="fa fa-lg fa-thin fa-store mr-3" style="color:#252A37;"></i>POINT ARRIVE</th>
                                                <th><i class="fa fa-lg fa-thin fa-clock mr-3" style="color:#252A37;"></i>DUREE (HEURE)</th>
                                                <th><i class="fa fa-lg fa-toolbox mr-3" style="color:#252A37;"></i>ACTIONS</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                                @foreach($itineraires as $itineraire)
                                                    <tr style="font-size:20px; color:black;">
                                                        <td><label style="font-size:1.1em;"> {{ $itineraire->lieux_depart }} </label></td>
                                                        <td><label> {{ $itineraire->lieux_arrivee }} </label></td>
                                                        <td><label> {{ $itineraire->duree }} </label></td>
                                                        <td>
                                                            @can('editer-itineraire')
                                                            <button class="btn btn-sm btn-info mr-1"
                                                                    title="Edition" 
                                                                    name="btnItineraireEdit"
                                                                    data-toggle="modal"
                                                                    data-target="#modalItineraireIndexPageEdit"
                                                                    data-backdrop="static"
                                                                    data-keyboard="false"
                                                                    data-itineraire="{{ json_encode($itineraire) }}"
                                                                    >
                                                                    <span class="icon text-white-80 m-1">
                                                                        <i class="fas fa-lg fa-road"></i>
                                                                        <i class="fas fa-pen" style="font-size:13px;"></i>
                                                                    </span>
                                                            </button>
                                                            @endcan
                                                            @can('supprimer-itineraire')
                                                            <button class="btn btn-sm btn-danger mr-1"
                                                                    name="btnDeleteItineraire" 
                                                                    title="Supprimer"
                                                                    data-courriers="{{ $courriers }}"
                                                                    data-itineraire="{{ json_encode($itineraire) }}"
                                                                    >
                                                                    <span class="icon text-white-80 m-1">
                                                                        <i class="fas fa-lg fa-road"></i>
                                                                        <i class="fas fa-times" style="font-size:13px;"></i>
                                                                    </span>
                                                            </button>
                                                            @endcan
                                                        </td>

                                                    </tr>
                                                @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Modal Itineraire -->
    <div class="modal" id="modalItineraireIndexPage" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary text-white">
                        <i class="fas fa-2x fa-road"></i><i class="fas fa-sm fa-car mr-3"></i>
                        <h5 style="font-size:1.1em; margin-left: 4rem; font-weight:bolder;" class="modal-title text-justifiy">
                        ITINERAIRE</h5>
                        <button type="button" id="btnExit_itineraire" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                <div class="modal-body">
                    <form id="ItineraireFormIndexPage" autocomplete="off">
                            {{ csrf_field() }}
                                @csrf
                        <div class="col-md-12" style="color:black;">
                            <div class="form-group">
                                <label for=""><i class="fas fa-lg fa-plane-departure mr-3" style="color:#0069D9;"></i>Lieux De Départ</label>
                                <input type="text" class="form-control border-primary" id="lieux_depart_index" name="lieux_depart">
                            </div>
                            <div class="form-group">
                                <label for=""><i class="fas fa-lg fa-plane-arrival mr-3" style="color:#0069D9;"></i>Lieux D'arrivé</label>
                                <input type="text" class="form-control border-primary" id="lieux_arrivee_index" name="lieux_arrivee">
                            </div>
                            <div class="form-group">
                                <label for=""><i class="fas fa-lg fa-clock mr-3" style="color:#0069D9;"></i>Durée (Heure)</label>
                                <input type="number" min="1" max="200" class="form-control border-primary" id="duree_index" name="duree" max="48:00">
                            </div>
                            <hr>
                            <button type="button" 
                                    id="setItineraire" 
                                    class="btn btn-outline-primary col-md-12">
                                <i class="fas fa-lg fa-check"></i>
                                <i class="fas fa-sm fa-road mr-3"></i>
                                VALIDER
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Itineraire Edit -->
    <div class="modal" id="modalItineraireIndexPageEdit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary text-white">
                        <i class="fas fa-2x fa-road"></i><i class="fas fa-sm fa-car mr-3"></i>
                        <h5 style="font-size:1.1em; margin-left: 4rem; font-weight:bolder;" class="modal-title text-justifiy">
                        ITINERAIRE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                <div class="modal-body">
                    <form id="ItineraireFormIndexPageEdit" autocomplete="off">
                            {{ csrf_field() }}
                                @csrf
                        <div class="col-md-12" style="color:black;">
                            <div class="form-group">
                                <input id="id" type="hidden" name="id">
                            </div>
                            <div class="form-group">
                                <label for=""><i class="fas fa-lg fa-plane-departure mr-3" style="color:#0069D9;"></i>Lieux De Départ</label>
                                <input type="text" class="form-control border-primary" id="lieux_depart_index_edit" name="lieux_depart">
                            </div>
                            <div class="form-group">
                                <label for=""><i class="fas fa-lg fa-plane-arrival mr-3" style="color:#0069D9;"></i>Lieux D'arrivé</label>
                                <input type="text" class="form-control border-primary" id="lieux_arrivee_index_edit" name="lieux_arrivee">
                            </div>
                            <div class="form-group">
                                <label for=""><i class="fas fa-lg fa-clock mr-3" style="color:#0069D9;"></i>Durée (Heure)</label>
                                <input type="number" min="1" max="200" class="form-control border-primary" id="duree_index_edit" name="duree" max="48:00">
                            </div>
                            <hr>
                            <button type="button" 
                                    id="EditItineraire" 
                                    class="btn btn-outline-primary col-md-12">
                                <i class="fas fa-lg fa-check"></i>
                                <i class="fas fa-sm fa-road mr-3"></i>
                                Modifier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirmation Save Itineraire -->
    <div class="modal fade" id="modalSavingIndexPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                    <i class="fas fa-check fa-lg mr-3"></i>    
                                    Confirmez-Vous Ces Informations ?</h5>
                                </div>
                                <div class="modal-body">
                                                        <table class="table table-bordered mb-2">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-globe mr-2"></i>
                                                                                                    <span  class="badge badge-success">
                                                                                                    Lieux Départ</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <span style="color: black; font-size: 20px;" id="lieux_depart_conf_index"></span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-globe mr-2"></i>
                                                                                                    <span  class="badge badge-success">
                                                                                                    Lieux Arrivée</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <span style="color: black; font-size: 20px;" id="lieux_arrive_conf_index"></span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-info mr-2"></i>
                                                                                                    <span  class="badge badge-primary">
                                                                                                    Durée</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-group">
                                                                                                            <span style="color: black; font-size: 20px;" id="duree_itineraire_conf_index"></span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <tbody>
                                                        </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="conf_indexPage" class="btn btn-primary">OUI</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                                </div>
                            </div>
                        </div>
    </div> 

    <!-- Modal error validation-->
    <div class="modal fade" id="errorvalidationsItinePage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                    <div class="modal-content">
                            <div class="modal-header" style="background-color:red;">
                                <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Erreur</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                    <div class="form-group">
                                          <textarea id="validationsIndexItine" disabled style="width:100%;border-style:none;height:150px;background-color:white;resize: none; color:black; font-size:19px;" class="form-control"></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                            </div>
                    </div>
            </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ url('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ url('js/demo/datatables-demo.js') }}"></script>
  
@endsection