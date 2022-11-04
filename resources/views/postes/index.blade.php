@extends('layouts.main')


@section('content')


    <!-- Begin Page Content -->
    <div class="container-fluid" style="font-family: 'Century Gothic';">

                    <!-- Page Heading -->

                    <p class="mb-2">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a href="{{ URL::to('dashboard')  }}" type="button" class="btn btn-info float-left btn-icon-back">
                                                        <span class="icon text-white-80">
                                                            <i class="fas fa-reply"></i>
                                                        </span>
                                                        <span class="text">Retour</span>
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                @can('creer-poste')
                                    <button type="button" data-toggle="modal" data-target="#modalPoste" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-icon-split float-right">
                                                        <span class="icon text-white-80">
                                                            <i class="fas fa-plus" style="font-size:10px;"></i>
                                                            <i class="fas fa-lg fa-toolbox mr-2"></i>
                                                        </span>
                                                        <span class="text">Ajout Poste</span>
                                    </button>
                                @endcan
                            </div>
                      </div>
                    </p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header text-lg py-3" style="color:black;">
                            Liste Des Postes De L'entreprise
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th><i class="fas fa-lg fa-briefcase mr-3" style="color:#252A37;"></i>POSTE</th>
                                                <th><i class="fas fa-lg fa-info mr-3" style="color:#252A37;"></i>DESCRIPTION POSTE</th>
                                                <th><i class="fas fa-lg fa-toolbox mr-3" style="color:#252A37;"></i>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="bg-primary text-white">
                                            <tr>
                                                <th><i class="fas fa-lg fa-briefcase mr-3" style="color:#252A37;"></i>POSTES</th>
                                                <th><i class="fas fa-lg fa-info mr-3" style="color:#252A37;"></i>DESCRIPTION POSTE</th>
                                                <th><i class="fas fa-lg fa-toolbox mr-3" style="color:#252A37;"></i>ACTIONS</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                                @foreach($postes as $poste)
                                                    <tr style="font-size:15px; color:black;">
                                                        <td><label>{{ $poste->intitulePoste }}</label></td>
                                                        <td>{{ $poste->descriptionPoste ? $poste->descriptionPoste : '' }}</td>
                                                        <td>
                                                            @can('editer-poste')
                                                            <button class="btn btn-sm btn-info btn-icon-split mr-2" id="btnEdit" data-id="{{ $poste->id }}" data-intitulePoste="{{ $poste->intitulePoste }}"  data-descriptionPoste="{{ $poste->descriptionPoste }}">
                                                                <span class="icon text-white-80">
                                                                    <i class="fas fa-lg fa-toolbox"></i>
                                                                    <i class="fas fa-sm fa-pen"></i>
                                                                </span>
                                                                <span class="text">Editer</span>
                                                            </button>
                                                            @endcan
                                                            @can('supprimer-poste')
                                                            <button class="btn btn-sm btn-danger btn-icon-split" id="btnDelete" data-intitulePoste="{{ $poste->intitulePoste }}" data-id="{{ $poste->id }}">
                                                                <span class="icon text-white-80">
                                                                    <i class="fas fa-lg fa-toolbox"></i>
                                                                    <i class="fas fa-sm fa-times mr-2"></i>
                                                                </span>
                                                                <span class="text">Supprimer</span>
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

    <div class="modal fade" id="modalPoste" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-title">
                    <span class="icon text-white-80">
                        <i class="fas fa-plus" style="font-size:10px;"></i>
                        <i class="fas fa-lg fa-toolbox mr-3"></i>
                    </span>
                Ajout Poste</h5>
                <button type="button" id="btnClose" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form id="posteFormInsert" autocomplete="off">
                    {{ csrf_field() }}
                        @csrf
                                                <div class="form-group">
                                                    <label for="">Poste <span style="color:red;">  *</span></label>
                                                    <input type="text" class="form-control"
                                                        id="poste" name="intitulePoste"
                                                        placeholder="EX: caissière">
                                                </div>
                                                <div class="form-group">
                                                    <label>Description Poste</label></br>
                                                    <textarea rows="3" id="Description" name="descriptionPoste" class="form-control"></textarea>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <button type="button" id="btnAddPoste" class="btn btn-primary col-md-6 mr-3 ml-2"><i class="fas fa-lg fa-save mr-2"></i>Enregistrer</button>
                                                    <button type="button" id="btnExit" class="btn btn-danger col-md-5"><i class="fas fa-lg fa-trash mr-3"></i>Annuler</button>
                                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditposte" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                <span class="icon text-white-80">
                            <i class="fas fa-edit mr-3"></i>
                    </span>
                Edition Poste</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form id="posteFormEdit" autocomplete="off">
                    {{ csrf_field() }}
                        @csrf
                                                <div class="form-group">
                                                        <input id="id" type="hidden" name="id">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                        id="postes" name="intitulePoste"
                                                        placeholder="Région">
                                                </div>
                                                <div class="form-group">
                                                <label>Description Poste</label></br>
                                                <textarea rows="3" id="Descriptions" name="descriptionPoste" class="form-control"></textarea>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                <button type="button" id="btnEditposte" class="btn btn-primary col-md-6 mr-2 ml-2"><i class="fas fa-lg fa-save mr-2"></i>Enregistrer</button>
                                                <button type="button" id="btnExit" class="btn btn-danger col-md-5" data-dismiss="modal"><i class="fas fa-lg fa-times mr-2"></i>Fermer</button>
                                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirmation Save Poste -->
    <div class="modal fade" id="modalConfirmationPoste" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                                    <i style="color:#E02D1B;" class="fas fa-briefcase mr-2"></i>
                                                                                                    <span  class="badge badge-success">
                                                                                                    POSTE</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <span style="color: black; font-size: 20px;" id="poste_conf"></span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-info mr-2"></i>
                                                                                                    <span  class="badge badge-primary">
                                                                                                    DESCRIPTION</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-group">
                                                                                                            <span style="color: black; font-size: 20px;" id="desc_conf"></span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <tbody>
                                                        </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="conf_save_poste" data-postes="{{ $posts }}" class="btn btn-primary">OUI</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                                </div>
                            </div>
                        </div>
    </div> 

    <!-- Modal error validation-->
    <div class="modal fade" id="errorvalidationsModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                          <textarea id="validation" disabled style="width:100%; height:80px ;border-style:none; background-color:white;resize: none; color:black; font-size:19px;" class="form-control"></textarea>
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                                      </div>
                                    </div>
                                  </div>
    </div>

    <script src="{{ url('postes.js') }}"></script>
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