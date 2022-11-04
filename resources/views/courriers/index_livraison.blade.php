@extends('layouts.main')


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid" style="font-family: 'Century Gothic';">

                    <!-- Page Heading -->

                    <p class="mb-4">
                        <div class="row mb-5">
                            <div class="col-md-1 col-sm-6 text-left">
                                <a href="{{ URL::to('receptCourrier')  }}" type="button" class="btn btn-info float-left btn-icon-back">
                                                    <span class="icon text-white-80">
                                                        <i class="fas fa-reply"></i>
                                                    </span>
                                                    <span class="text">Retour</span>
                                </a>
                            </div>
                            <div class="col-md-9 col-sm-6" style="color:black;">
                                    <span class="mr-2">COURRIERS ENCOURS</span><span class="badge badge-success text-lg mr-3">{{ $encours }}</span>
                                    <span class="mr-2">COURRIERS ENTRANSIT</span><span class="badge badge-success text-lg mr-3">{{ $entransit }}</span>  
                                    <span class="mr-2">COURRIERS RECEPTIONNER</span><span class="badge badge-success text-lg mr-3">{{ $receptionner }}</span>
                                    <span class="mr-2">COURRIERS LIVRER</span><span class="badge badge-success text-lg mr-3">{{ $livrer }}</span>
                                    <span class="mr-2">COURRIERS ANNULER</span><span class="badge badge-success text-lg">{{ $annuler }}</span>
                            </div>
                            <div class="col-md-2 col-sm-6 text-right">
                                <a title="PDF Courrier Réceptionner" href="{{ route('generate-pdf', ['status' => 'RECEPTIONNER']) }}" type="button" class="btn btn-lg" style="background-color:#252A37;color:white; font-size:10px;"><i class="fas fa-file-pdf mr-2"></i>PDF COURRIERS RECEPTIONNER</a>
                            </div>
                        </div>
                    </p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                    <div class="col-md-6 text-left text-lg" style="color:black;">
                                        Liste Des Courriers En Attente De Livraison
                                    </div>
                                    <!-- <div class="col-md-6 text-right">
                                            <a href="{{ url('archiveCourrier') }}" type="button" class="btn float-right" style="background-color: #9C27B0; color:white;">
                                            <i class="fas fa-lg fa-truck"></i>
                                            <i class="fas fa-eye fa-sm mr-2" style="font-size:10px;"></i>
                                            
                                            Courrier Livrer</a>
                                    </div> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                            <th><i class="fas fa-lg fa-hashtag mr-3" style="color:#252A37;"></i>NUMERO</th>
                                                <th><i class="fas fa-lg fa-user-tag mr-3" style="color:#252A37;"></i>EXPEDITEUR</th>
                                                <th><i class="fas fa-lg fa-user mr-3" style="color:#252A37;"></i>RECEPTEUR</th>
                                                <th><i class="fas fa-lg fa-chart-bar mr-3" style="color:#252A37;"></i>STATUT</th>
                                                <th><i class="fas fa-lg fa-calendar mr-3" style="color:#252A37;"></i>DATE</th>
                                                <th><i class="fas fa-lg fa-toolbox mr-3" style="color:#252A37;"></i>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="bg-primary text-white">
                                            <tr>
                                            <th><i class="fas fa-lg fa-hashtag mr-3" style="color:#252A37;"></i>NUMERO</th>
                                                <th><i class="fas fa-lg fa-user-tag mr-3" style="color:#252A37;"></i>EXPEDITEUR</th>
                                                <th><i class="fas fa-lg fa-user mr-3" style="color:#252A37;"></i>RECEPTEUR</th>
                                                <th><i class="fas fa-lg fa-chart-bar mr-3" style="color:#252A37;"></i>STATUT</th>
                                                <th><i class="fas fa-lg fa-calendar mr-3" style="color:#252A37;"></i>DATE</th>
                                                <th><i class="fas fa-lg fa-toolbox mr-3" style="color:#252A37;"></i>ACTIONS</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                                @foreach($courriers as $courrier)
                                                    <tr style="font-size:20px; color:black;">
                                                        <td><label style="font-size:1.1em;"> {{ $courrier->code }} </label></td>
                                                        <td><label> {{ $courrier->emetteurs->fullname }} </label></td>
                                                        <td><label> {{ $courrier->recepteurs->fullname }} </label></td>
                                                        <td><label> {{ $courrier->status }} </label></td>
                                                        <td><label> {{ $courrier->date_create }} </label></td>
                                                        <td>
                                                            @can('voir-courrier')
                                                            <button class="btn btn-primary mr-2" 
                                                                    title="Voir" 
                                                                    id="btnView"
                                                                    name="btnColisViews"
                                                                    data-courrier="{{ $courrier }}"
                                                                    data-cars="{{ $vehicules }}"
                                                                    data-toggle="modal" 
                                                                    data-target="#ColisView"
                                                                    data-backdrop="static" 
                                                                    data-keyboard="false"><span class="icon text-white-80"><i class="fas fa-lg fa-envelope"></i><i class="fas fa-eye fa-sm"></i></span></button>
                                                            @endcan
                                                            @can('livrer-courrier')
                                                            <a type="button" 
                                                               class="btn" style="background-color:#F33527;" title="Livrer" id="btnLivraison" data-courrier="{{ $courrier }}" data-toggle="modal" data-target="#modalLivraisonCourrier" data-backdrop="static" data-keyboard="false"><span class="icon text-white-100"><i class="fas fa-lg fa-envelope" style="color:white;"></i><i style="color:white;" class="fas fa-upload fa-sm"></i></span></a>
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

    
                    <!-- Modal Livraison Courrier -->
                    <div class="modal" id="modalLivraisonCourrier" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header  bg-primary text-white">
                                <h5 class="modal-title"><i class="fas fa-2x fa-envelope"></i><i class="fas fa-sm fa-upload mr-4"></i>Livraison Courrier <span class="badge badge-success" id="numero_courrier"></span></h5>
                                <button type="button" id="btnExit_livraison" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                    <form id="LivraisonCourrierForm" autocomplete="off">
                                    {{ csrf_field() }}
                                        @csrf
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                            <input id="id_livraison" type="hidden" name="id">
                                                                    </div>
                                                                    <div class="form-group">
                                                                            <input id="status_livraison" type="hidden" name="status">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="card" style="padding:10px;">
                                                                        <div class="form-group">
                                                                                <label for="">Récepteur Effectif Courrier</label>
                                                                                <select id='selUserLivraison' name="recepteur_effectif_id" style='width: 100%;' class="form-control border-primary">
                                                                                    <option value="">Selectionner Une Personne</option>
                                                                                    @foreach($personnes as $personne)
                                                                                    <option value="{{ $personne->id }}">{{ $personne->fullname }}</option>
                                                                                    @endforeach
                                                                                </select> 
                                                                        </div>
                                                                        <p style="text-align:center;">OU</p>
                                                                        <div class="form-group">
                                                                                <label> Nom</label>
                                                                                <input type="text" class="form-control"
                                                                                id="fullname_livraison" name="fullname"
                                                                                >
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>Téléphone</label>
                                                                                <input type="tel" class="form-control"
                                                                                id="telephone_livraison" name="telephone"
                                                                                >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="col-md-10 ml-5">
                                                                    <button type="button" id="btnLivraisonCourrier" data-personnes="{{ $personnes }}" class="btn btn-primary col-md-5 mr-3"><i class="fas fa-check mr-1" style="font-size:10px;"></i><i class="fas fa-lg fa-envelope mr-3"></i>Livrer Courrier</button>
                                                                    
                                                                    <button type="button" id="btnClose_index_livraison" class="btn btn-danger col-md-5"><i class="fas fa-times mr-1" style="font-size:10px;"></i><i class="fas fa-lg fa-envelope mr-3"></i>Annuler Livraison</button>
                                                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal View Courrier -->
                    <div class="modal fade" id="ColisView" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header" style="background-color:#1761FD;">
                                      <h5 class="modal-title" id="exampleModalLabel" style="color:#FFFFFF;font-weight: bold;">
                                      <i class="fas fa-info fa-lg mr-3"></i>
                                      Informations Courrier <span class="badge badge-success" id="number_courrier"></span></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row" id="ui">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-content collapse show">
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive table-bordered mb-2">
                                                                    <div class="imgs" style="margin-left: 29rem; margin-bottom: -25rem; padding-top: 10rem;">
                                                                        <img src="{{asset('/img/message.jpg')}}" alt="First slide">
                                                                    </div>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-hashtag mr-2"></i>
                                                                            <span  style="color:black;">Numéro Courrier</span>
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
                                                                            <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="chauffeurs">
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
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="chauffeurs_telephone">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-truck mr-2"></i>
                                                                            <span style="color:black;">Vehicule Chauffeur</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="vehicule_chauffeur">
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
                                                                                <span style="color:black;">Site Expéditeur</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                <textarea style="background-color:white; border-style: none; font-weight:bolder;" id="site_exp" disabled rows="4" cols="20"></textarea>
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
                                                                                        <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="site_recept">
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
                                                                                <span style="color:black;">Date Retrait Courrier</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                        <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="date_retrait_courrier">
                                                                                    </div>
                                                                        </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <i style="color:#E02D1B;" class="fas fa-calendar mr-2"></i>
                                                                                <span style="color:black;">Date Reception Courrier</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                        <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="date_rec_courrier">
                                                                                    </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <i style="color:#E02D1B;" class="fas fa-lg fa-road"></i>
                                                                                <i style="color:#E02D1B;" class="fas fa-car mr-2"></i>
                                                                                <span style="color:black;">Itineraire</span>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                        <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="itin_colis">
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
                                          <textarea id="validation" disabled style="width:100%;border-style:none;height:180px;background-color:white;resize: none;font-weight:bold;" class="form-control"></textarea>
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
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