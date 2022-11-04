@extends('layouts.main')


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid" style="font-family: 'Century Gothic';">

                    <!-- Page Heading -->

                    <p class="mb-2">
                        <div class="row">
                                <div class="col-md-6 text-left">
                                <a href="{{ URL::to('livCourrier')  }}" type="button" class="btn btn-info float-left btn-icon-back">
                                                    <span class="icon text-white-80">
                                                        <i class="fas fa-reply"></i>
                                                    </span>
                                                    <span class="text">Retour</span>
                                </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a title="PDF Courrier Livrer" href="{{ route('generate-pdf', ['status' => 'LIVRER']) }}" type="button" class="btn" style="background-color:#252A37;color:white;"><i class="fas fa-file-pdf mr-2"></i>PDF COURRIERS LIVRER</a>
                                </div>
                        </div> 
                    </p>
                    <!-- DataTales Example -->
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-6 text-left text-lg" style="color:black;">
                                        Liste Des Courriers Livrés
                                </div>
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
                                                            <button class="btn btn-sm btn-block btn-success mr-2"
                                                                    name="btnViewLiv"
                                                                    data-courrier="{{ $courrier }}"
                                                                    data-cars="{{ $vehicules }}"
                                                                    data-toggle="modal"
                                                                    data-target="#viewCourrierLiv"
                                                                    data-backdrop="static"
                                                                    data-keyboard="false"
                                                                    title="Voir" 
                                                                    id="btnIndexLivView"><span class="icon text-white-80"><i class="fas fa-lg fa-envelope"></i><i class="fas fa-sm fa-eye mr-2"></i></span>VUE</button>
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
                      <div class="modal fade" id="viewCourrierLiv" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    <div class="imgs" style="float:right; margin-left: 35rem; margin-bottom:-70rem; margin-top: 40rem; padding-top:15rem;">
                                                                        <img style="width:80%;" src="{{asset('/img/message.jpg')}}" alt="First slide">
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
                                                                        <i style="color:#E02D1B;" class="fas fa-user mr-2"></i>
                                                                        <span style="color:black;">Chauffeur Courrier</span>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                            <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="chauffeur">
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
                                                                            <span style="color:black;">Récepteur Effectif</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="recepteur_eff">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-phone mr-2"></i>
                                                                            <span style="color:black;">Téléphone Récepteur Effectif</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="recepteur_eff_phone">
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
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="coursier_courrier">
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
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="coursier_courrier_phone">
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
                                                                                      <input style="width: 100%; background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="date_create">
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
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="date_retrait">
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
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="date_recept">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-calendar mr-2"></i>
                                                                            <span style="color:black;">Date Livraison Courrier</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="date_liv">
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
                                                                    <div class="imgs" style="float:right; margin-left: 35rem; margin-bottom:-20rem; padding-top:5rem;">
                                                                        <img style="width:80%;" src="{{asset('/img/message.jpg')}}" alt="First slide">
                                                                    </div>
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