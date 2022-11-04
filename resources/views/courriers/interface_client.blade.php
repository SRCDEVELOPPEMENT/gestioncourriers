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
                                    @can('options-ihm_client')
                                    <button onclick="window.location='{{ route('ihm_client', ['tous' => true]) }}'" style="background-color:#474748; color:white;" title="Afficher Tous Les Courriers" class="btn mr-3"><i class="fas fa-lg fa-list mr-1"></i><i style="font-size:10px;" class="fas fa-envelope mr-2"></i>Tous Les Courriers</button>
                                    
                                    <div class="dropdown float-right">
                                        <button style="background-color:#252A37;" class="btn dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i style="color:white;" class="fa fa-caret-down mr-2"></i>
                                            <span style="color:white;">Selectionner Un Service</span>
                                        </button>
                                        <div class="dropdown-menu animated--fade-in"
                                            aria-labelledby="dropdownMenuButton">
                                            @foreach($services as $service)
                                            <a class="dropdown-item" href="{{ route('ihmClient', ['id' => $service->id]) }}" name="statut">{{ $service->intituleSite }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endcan
                                </div>
                        </div>
                    </p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-6 text-lg text-left" style="color:black;">
                                    Etat De Progréssion Des Courriers
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
                                                <th><i class="fa fa-lg fa-thin fa-hashtag mr-3" style="color:#252A37;"></i>CODE</th>
                                                <th><i class="fa fa-lg fa-thin fa-building mr-3" style="color:#252A37;"></i>SITE EXPEDITEUR</th>
                                                <th><i class="fa fa-lg fa-thin fa-building mr-3" style="color:#252A37;"></i>SITE RECEPTEUR</th>
                                                <th><i class="fa fa-lg fa-thin fa-calendar mr-3" style="color:#252A37;"></i>DATE CREATION</th>
                                                <th><i class="fa fa-lg fa-thin fa-calendar mr-3" style="color:#252A37;"></i>DATE RETRAIT</th>
                                                <th><i class="fa fa-lg fa-thin fa-calendar mr-3" style="color:#252A37;"></i>DATE RECEPTION</th>
                                                <th><i class="fa fa-lg fa-thin fa-calendar mr-3" style="color:#252A37;"></i>DATE LIVRAISON</th>
                                                <th><i class="fa fa-lg fa-toolbox mr-3" style="color:#252A37;"></i>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="bg-primary text-white">
                                            <tr>
                                                <th><i class="fa fa-lg fa-thin fa-hashtag mr-3" style="color:#252A37;"></i>CODE</th>
                                                <th><i class="fa fa-lg fa-thin fa-building mr-3" style="color:#252A37;"></i>SITE EXPEDITEUR</th>
                                                <th><i class="fa fa-lg fa-thin fa-building mr-3" style="color:#252A37;"></i>SITE RECEPTEUR</th>
                                                <th><i class="fa fa-lg fa-thin fa-calendar mr-3" style="color:#252A37;"></i>DATE CREATION</th>
                                                <th><i class="fa fa-lg fa-thin fa-calendar mr-3" style="color:#252A37;"></i>DATE RETRAIT</th>
                                                <th><i class="fa fa-lg fa-thin fa-calendar mr-3" style="color:#252A37;"></i>DATE RECEPTION</th>
                                                <th><i class="fa fa-lg fa-thin fa-calendar mr-3" style="color:#252A37;"></i>DATE LIVRAISON</th>
                                                <th><i class="fa fa-lg fa-toolbox mr-3" style="color:#252A37;"></i>ACTIONS</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                                @foreach($courriers as $courrier)
                                                    <tr style="font-size:20px; color:black;">
                                                        <td><label style="font-size:1.1em;"> {{ $courrier->code }} </label></td>
                                                        <td><label> {{ $courrier->site_exps ? $courrier->site_exps->intituleSite : "" }} </label></td>
                                                        <td><label> {{ $courrier->site_recepts ? $courrier->site_recepts->intituleSite : "" }} </label></td>
                                                        <td><label> {{ $courrier->date_create }} </label></td>
                                                        <td><label> {{ $courrier->DateRetraitCourrier }} </label></td>
                                                        <td><label> {{ $courrier->DateReceptCourrier }} </label></td>
                                                        <td><label> {{ $courrier->DateLivraionCourrier }} </label></td>
                                                        <td>

                                                            @can('voir-courrier')
                                                            <button class="btn btn-sm btn-block btn-success" 
                                                                    data-courrier="{{ $courrier }}" 
                                                                    data-cars="{{ $vehicules }}"
                                                                    data-toggle="modal" 
                                                                    data-target="#viewCourrier"
                                                                    data-backdrop="static" 
                                                                    data-keyboard="false" 
                                                                    title="Voir Tous Les Information Du Courrier" 
                                                                    name="btnVoirCourrierClient"
                                                                    id="btnVoirCourrierClient"><span class="icon text-white-80"><i class="fa fa-thin fa-lg fa-eye mr-2"></i></span>VUE</button>
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

    <!-- Modal View Courrier -->
    <div class="modal" id="viewCourrier" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header" style="background-color:#1761FD;">
                                      <h5 class="modal-title" id="exampleModalLabel" style="color:#FFFFFF;font-weight: bold;">
                                      <i class="fas fa-info fa-lg mr-3"></i>
                                      Informations Courrier <span class="badge badge-success" id="number_courrier_client"></span></h5>
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