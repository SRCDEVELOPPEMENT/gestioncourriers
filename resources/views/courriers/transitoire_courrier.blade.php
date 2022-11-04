@extends('layouts.main')


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

                    <!-- Page Heading -->

                    <p class="mb-4">
                        <div class="row">
                                <div class="col-md-2 text-left">
                                    <a href="{{ URL::to('courriers')  }}" type="button" class="btn btn-info btn-icon-back">
                                                        <span class="icon text-white-80">
                                                            <i class="fas fa-reply"></i>
                                                        </span>
                                                        <span class="text">Retour</span>
                                    </a>
                                </div>
                                <div class="col-md-10 text-right">
                                                    <button type="button" data-toggle="modal" data-target="#modalTransitoireCourrier" data-backdrop="static" data-keyboard="false" class="btn btn-warning btn-icon-split mr-3">
                                                        <span class="icon text-white-80">
                                                            <i class="fas fa-plus"></i>
                                                            <i class="fas fa-lg fa-store"></i>
                                                        </span>
                                                        <span class="text">Ajout Transitoire</span>
                                                    </button>
                                </div>
                        </div>
                    </p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-6 text-left" style="color:black; font-size:15px;">
                                    <span title="Info" class="badge rounded-pill bg-info text-white mr-2">Note</span> |
                                    Lister Des Courriers Retirer Et A Transiter
                                </div>
                                <div class="col-md-6 text-right">
                                    <div>
                                        <button onclick="window.location='{{ url('receptCourrier') }}'" class="btn btn-sm" style="background-color: #47A44B; color:white;">
                                        <i class="fas fa-download mr-2"></i>
                                        Réception De Courrier</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th><i class="fas fa-hashtag mr-3" style="color:#E43270;"></i>Numéro Courrier</th>
                                                <th><i class="fas fa-user mr-3" style="color:#E43270;"></i>Expediteur</th>
                                                <th><i class="fas fa-user mr-3" style="color:#E43270;"></i>Recepteur</th>
                                                <th><i class="fas fa-chart-bar mr-3" style="color:#E43270;"></i>Statut</th>
                                                <th><i class="fas fa-calendar mr-3" style="color:#E43270;"></i>Date</th>
                                                <th><i class="fas fa-toolbox mr-3" style="color:#E43270;"></i>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="bg-primary text-white">
                                            <tr>
                                                <th><i class="fas fa-hashtag mr-3" style="color:#E43270;"></i>Numéro Courrier</th>
                                                <th><i class="fas fa-user mr-3" style="color:#E43270;"></i>Expediteur</th>
                                                <th><i class="fas fa-user mr-3" style="color:#E43270;"></i>Recepteur</th>
                                                <th><i class="fas fa-chart-bar mr-3" style="color:#E43270;"></i>Statut</th>
                                                <th><i class="fas fa-calendar mr-3" style="color:#E43270;"></i>Date</th>
                                                <th><i class="fas fa-toolbox mr-3" style="color:#E43270;"></i>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                                @foreach($courriers as $courrier)
                                                    <tr style="font-size:15px; color:black;">
                                                        <td><label style="font-size:1.1em;" class="badge badge-success"> {{ $courrier->code }} </label></td>
                                                        <td><label> {{ $courrier->emetteurs->fullname }} </label></td>
                                                        <td><label> {{ $courrier->recepteurs->fullname }} </label></td>
                                                        <td><label> {{ $courrier->status }} </label></td>
                                                        <td><label> {{ $courrier->date_create }} </label></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning mr-2" 
                                                                    data-courrier="{{ $courrier }}"
                                                                    data-toggle="modal" 
                                                                    data-target="#modalTransitoireCourrier"
                                                                    data-backdrop="static" 
                                                                    data-keyboard="false" 
                                                                    title="Transitoire" 
                                                                    name="btnSetTransitoire"
                                                                    id="btnTransitCourrier"
                                                                    {{ !$courrier->Transitoire ? : 'disabled' }}><span class="icon text-white-80"><i class="fas fa-plus mr-1" style="font-size:10px;"></i><i class="fas fa-lg fa-store mr-2"></i></span>Transitoire</button>

                                                            @can('voir-courrier')
                                                            <button class="btn btn-sm btn-primary" 
                                                                    data-courrier="{{ $courrier }}" 
                                                                    data-toggle="modal" 
                                                                    data-target="#viewCourrier"
                                                                    data-backdrop="static" 
                                                                    data-keyboard="false" 
                                                                    title="Voir" 
                                                                    name="btnVoirCourrierTransitoire"
                                                                    id="btnVoirCourrierTransit"><span class="icon text-white-80"><i class="fas fa-envelope fa-lg"></i><i class="fas fa-sm fa-eye mr-2"></i></span>VUE</button>
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

                    <!-- Modal Transitoire Courrier -->
                    <div class="modal" id="modalTransitoireCourrier" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header  bg-primary text-white">
                                <h5 class="modal-title">
                                <i class="fas fa-plus fa-sm"></i> 
                                <i class="fas fa-store fa-lg mr-3"></i> 
                                Transitoire Courrier <span class="badge badge-success" id="number_courriertransit"></span></h5>
                                <button type="button" id="btnExit_transitoire" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                    <form id="TransitoireCourrierForm" autocomplete="off">
                                    {{ csrf_field() }}
                                        @csrf
                                        @method('PUT')
                                                                <div class="form-group">
                                                                        <input id="id_transitoire" type="hidden" name="id">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="">Courrier</label>
                                                                        <select id='courrier_transitoire' name="courrier_transitoire" data-personnes="{{ $personnes }}" class="form-control border-primary">
                                                                            <option value="">Selectionner Un Courrier</option> 
                                                                            @foreach($courriers as $courrier)
                                                                                @if(!$courrier->Transitoire)
                                                                                    <option value="{{ $courrier->id }}">{{ $courrier->code }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="">Magasin</label>
                                                                        <select id='magasin' name="magasin" class="form-control border-primary">
                                                                            <option value="">Selectionner Un Magasin</option> 
                                                                            @foreach($transitoires as $transitoire)
                                                                            <option value="{{ $transitoire }}">{{ $transitoire }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="">Poste</label>
                                                                        <select id='poste_transitoire' name="poste" data-personnes="{{ $personnes }}" class="form-control border-primary">
                                                                            <option value="">Selectionner Un Poste</option> 
                                                                            @foreach($postes as $poste)
                                                                            <option value="{{ $poste->id }}">{{ $poste->intitulePoste }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="">Personne</label>
                                                                        <select id='chauffeur_transitoire' name="chauffeur_id" class="form-control border-primary">
                                                                            <option value="">Selectionner Une Personne</option> 
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="col-md-12">
                                                                    <button type="button" 
                                                                     id="btnTransitoireCourrier" class="btn btn-primary col-md-6 pull-left mr-4">
                                                                     <i class="fas fa-sm fa-check mr-1"></i><i class="fas fa-lg fa-store mr-3"></i>Enregistrer</button>
                                                                    <button type="button" id="btnClose_transitoire" class="btn btn-danger col-md-5 pull-right">
                                                                        <span class="icon text-white-80 mr-2">
                                                                                <i class="fas fa-lg fa-times"></i>
                                                                        </span>    
                                                                        Annuler
                                                                    </button>
                                                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal View Courrier -->
                    <div class="modal" id="viewCourrier" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header" style="background-color:#1761FD;">
                                      <h5 class="modal-title" id="exampleModalLabel" style="color:#FFFFFF;font-weight: bold;">
                                      <i class="fas fa-info fa-lg mr-3"></i>
                                      Informations Courrier <span class="badge badge-success" id="number_courrier_transit"></span></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <!-- <img class="rounded img-fluid mb-1" alt="robust admin logo" src="{{asset('/img/logo.png')}}"> -->
                                    <div class="modal-body">
                                      <div class="row" id="ui">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-content collapse show">
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive table-bordered mb-0">
                                                                    <div class="imgs" style="float:right; margin-bottom:-30rem; padding-top:15rem;">
                                                                        <img src="{{asset('/img/message.jpg')}}" alt="First slide">
                                                                    </div>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fas fa-hashtag mr-2"></i>
                                                                        <span  style="color:black;">
                                                                        Numéro Courrier</span>
                                                                        </td>
                                                                        <td>
                                                                                <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="numeroCourrier">
                                                                                </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fa fa-box mr-2"></i>
                                                                        <span  style="color:black;">Type De Courrier</span>
                                                                        </td>
                                                                        <td>
                                                                                <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="typecourrier">
                                                                                </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fa fa-envelope mr-2"></i>
                                                                            <span  style="color:black;">Type D'Envoie</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                    <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="typenvoi">
                                                                              </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fas fa-paperclip mr-2"></i>
                                                                        <span style="color:black;">objet</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                              <textarea style="background-color:white; border-style: none; font-weight:bolder;" id="object" disabled rows="4" cols="20"></textarea>
                                                                              </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fas fa-user mr-2"></i>
                                                                        <span style="color:black;">Chauffeur Courrier</span>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                            <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="chaufeur">
                                                                            </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-phone mr-2"></i>
                                                                            <span style="color:black;">Téléphone Chauffeur</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="chauffeur_telephone">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-user mr-2"></i>
                                                                            <span style="color:black;">Destinateur</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="destinat_courrier">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-phone mr-2"></i>
                                                                            <span style="color:black;">Téléphone Destinateur</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="destinat_telephone">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-user mr-2"></i>
                                                                            <span style="color:black;">Emétteur</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="emetteur">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-phone mr-2"></i>
                                                                            <span style="color:black;">Téléphone Emétteur</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="emetteur_telephone">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-user mr-2"></i>
                                                                            <span style="color:black;">Récepteur</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="recepteur">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-phone mr-2"></i>
                                                                            <span style="color:black;">Téléphone Récepteur</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="recepteur_telephone">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td>
                                                                                <i style="color:#E02D1B;" class="fas fa-user mr-2"></i>
                                                                                <span style="color:black;">Coursier</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                        <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="coursier_courrier_name">
                                                                                    </div>
                                                                            </td>
                                                                    </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <i style="color:#E02D1B;" class="fas fa-phone mr-2"></i>
                                                                                <span style="color:black;">Téléphone Coursier</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                        <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="coursier_courrier_telephone">
                                                                                    </div>
                                                                            </td>
                                                                        </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-building mr-2"></i>
                                                                            <span style="color:black;">Site De Reception</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                        <textarea style="background-color:white; border-style: none; font-weight:bolder;" id="site_recept" disabled rows="4" cols="20"></textarea>
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fa fa-battery-empty mr-2"></i>
                                                                        <span  style="color:black;">Statut Du Courrier</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="statut_cour">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fas fa-store mr-2"></i>
                                                                        <span style="color:black;">Transitoire</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="transitoir">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-calendar mr-2"></i>
                                                                            <span style="color:black;">Date Enrégistrement</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="date_create">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-calendar mr-2"></i>
                                                                            <span style="color:black;">Date Retrait</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="date_retrait_index">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                      </div>
                                    </div>
                                        
                                  </div>
                                </div>
                    </div>

                    
                    <!-- Modal Confirmation Transitoire -->
                    <div class="modal fade" id="modalConfirmationTransitoire" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header bg-info text-white">
                                <h5 class="modal-title" id="exampleModalLongTitle">
                                <i class="fas fa-check fa-lg mr-3"></i>    
                                Confirmer Vous Ces Informations ? <span class="badge badge-success" id="numero_courrier"></span></h5>
                            </div>
                            <div class="modal-body">
                                    <div style="margin: auto; width: 50%;">
                                        <label><span  class="badge badge-success mr-4">COURRIER</span>  <span style="color: black; font-size: 20px;" id="cour"></span></label></br>
                                        <label><span  class="badge badge-primary mr-4">MAGASIN</span> <span style="color: black; font-size: 20px;" id="mag"></span></label></br>
                                        <label><span  class="badge badge-warning mr-4">CHAUFFER</span> <span style="color: black; font-size: 20px;" id="chauff"></span></label>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" id="set_transitoire" class="btn btn-primary">OUI</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                            </div>
                            </div>
                        </div>
                    </div> 
                    
                    
    <script src="{{ url('courriers.js') }}"></script>
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