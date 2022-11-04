@extends('layouts.main')


@section('content')


    <!-- Begin Page Content -->
    <div class="container-fluid" style="font-family: 'Century Gothic';">

                    <!-- Page Heading -->

                    <p class="mb-4">
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
                            @can('creer-utilisateur')
                                <button type="button" data-toggle="modal" data-target="#modalUser" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-icon-split">
                                                    <span class="icon text-white-80">
                                                        <i class="fas fa-user-plus"></i>
                                                    </span>
                                                    <span class="text">Ajout Utilisateur</span>
                                </button>
                            @endcan
                           </div>
                        </div>
                    </p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 text-lg" style="color:black;">
                            Liste Des Utilisateurs De L'application</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th><i class="fas fa-lg fa-signature mr-3" style="color:#252A37;"></i>NOM</th>
                                                <!-- <th><i class="fas fa-sign-in-alt mr-3" style="color:#252A37;"></i>Nom Utilisateur</th> -->
                                                <th><i class="fas fa-lg fa-phone mr-3" style="color:#252A37;"></i>TELEPHONE</th>
                                                <th><i class="fas fa-lg fa-city mr-3" style="color:#252A37;"></i>SITE</th>
                                                <th><i class="fa fa-lg fa-user-lock mr-3" style="color:#252A37;"></i>ROLE</th>
                                                <th><i class="fa fa-lg fa-toolbox mr-3" style="color:#252A37;"></i>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tfoot class="bg-primary text-white">
                                            <tr>
                                            <th><i class="fas fa-lg fa-signature mr-3" style="color:#252A37;"></i>NOM</th>
                                                <!-- <th><i class="fas fa-sign-in-alt mr-3" style="color:#252A37;"></i>Nom Utilisateur</th> -->
                                                <th><i class="fas fa-lg fa-phone mr-3" style="color:#252A37;"></i>TELEPHONE</th>
                                                <th><i class="fas fa-lg fa-city mr-3" style="color:#252A37;"></i>SITE</th>
                                                <th><i class="fa fa-lg fa-user-lock mr-3" style="color:#252A37;"></i>ROLE</th>
                                                <th><i class="fa fa-lg fa-toolbox mr-3" style="color:#252A37;"></i>ACTIONS</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                                @foreach($utilisateurs as $user)
                                                    <tr style="font-size:15px; color:black;">
                                                        <td><label>{{ $user->fullname }}</label></span></td>
                                                        <td><label>{{ $user->telephone }}</label></td>
                                                        <td><label>{{ $user->sites != NULL ? $user->sites->intituleSite : '' }}</label></td>
                                                        <td>
                                                            @if(!empty($user->getRoleNames()))
                                                              @foreach($user->getRoleNames() as $v)
                                                                <label style="font-size:1.1em;" class="badge badge-success">{{ $v }}</label>
                                                              @endforeach
                                                            @endif
                                                        </td>                                                      
                                                        <td>
                                                            @can('editer-utilisateur')
                                                            <button class="btn btn-sm btn-info mr-2" id="btnEdit" data-user="{{ $user }}" data-toggle="modal" data-target="#modalEditUser" data-backdrop="static" data-keyboard="false"><span class="icon text-white-80"><i class="fas fa-user-edit mr-2"></i></span>Editer</button>
                                                            @endcan
                                                            @can('supprimer-utilisateur')
                                                            <button class="btn btn-sm btn-danger mr-2" id="btnDelete" data-fullname="{{ $user->fullname }}" data-courriers="{{ $courriers }}" data-id="{{ $user->id }}"><span class="icon text-white-80"><i class="fas fa-user-minus mr-2"></i></span>Supprimer</button>
                                                            @endcan
                                                            @can('voir-utilisateur')
                                                            <button class="btn btn-sm btn-primary"
                                                                    data-toggle="modal" 
                                                                    data-target="#viewUser"
                                                                    data-backdrop="static" 
                                                                    data-keyboard="false"
                                                                    id="btnViewUser" 
                                                                    data-password="{{ $user->password }}"
                                                                    data-fullname="{{ $user->fullname }}"  
                                                                    data-user="{{ $user }}" 
                                                                    ><span class="icon text-white-80"><i class="fas fa-user"></i><i class="fas fa-sm fa-eye mr-2"></i></span>Vue</button>
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

    <!-- Modal Add User -->
    <div class="modal fade"  id="modalUser" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-title">
                    <span class="icon text-white-80">
                            <i class="fas fa-user-plus mr-2"></i>
                    </span>
                    Ajout Utilisateur
                </h5>
                <button type="button" id="btnCloseAddUser" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form id="userFormInsert" autocomplete="off">
                    {{ csrf_field() }}
                        @csrf
                                                <div class="form-group">
                                                    <input type="hidden" name="id">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                        id="fullname" name="fullname"
                                                        placeholder="Nom Complet">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                        id="matricule" name="matricule" placeholder="Matricule">
                                                </div>
                                                <div class="row" style="margin-left:5px;">
                                                    <div class="form-group">
                                                        <input type="tel" class="form-control"
                                                            id="telephone" name="telephone" placeholder="Téléphone">
                                                    </div>
                                                    <div class="form-group" style="margin-left:10px; width: 230px;">
                                                        <select class="form-control col-md-12" id="site_id" name="site_id">
                                                            <option value="">Site</option>
                                                            @foreach($sites as $site)
                                                            <option value="{{ $site->id }}">{{ $site->intituleSite }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control form-control-user"
                                                            id="email" name="email" placeholder="Email">
                                                    </div>
                                                <div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-user"
                                                            id="login" name="login" placeholder="Nom Utilisateur">
                                                    </div>
                                                </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control"
                                                            id="password" name="password" placeholder="Mot De Passe">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control"
                                                            id="confirm-password" name="confirm-password" placeholder="Confirmer Mot De Passe">
                                                    </div>
                                                    <select class="form-control" id="roles" name="roles">
                                                        <option value="">Role</option>
                                                        @foreach($roles as $role)
                                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                <hr>
                                                <div class="row">
                                                    <button type="button" id="btnAddUser" class="btn btn-primary col-md-6 mr-2 ml-2"><i class="fas fa-lg fa-user-check mr-2"></i>Enregistrer</button>
                                                    <button type="button" id="btnExitAddForm" class="btn btn-danger col-md-5"><i class="fas fa-lg fa-user-times mr-2"></i>Annuler</button>
                                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal fade"  id="modalEditUser" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-title">
                    <span class="icon text-white-80">
                            <i class="fas fa-user-edit mr-3"></i>
                    </span>
                    Edition Utilisateur
                </h5>
                <button type="button" id="btnClose" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form id="userFormEdit" autocomplete="off">
                    {{ csrf_field() }}
                        @csrf
                        @method('PUT')
                                                <div class="form-group">
                                                    <input id="idEditUser" type="hidden" name="id">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                        id="fullnameEditUser" name="fullname"
                                                        placeholder="Nom Complet">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control"
                                                        id="matriculeEditUser" name="matricule" placeholder="Matricule">
                                                </div>
                                                <div class="row" style="margin-left:5px;">
                                                    <div class="form-group">
                                                        <input type="tel" class="form-control"
                                                            id="telephoneEditUser" name="telephone" placeholder="Téléphone">
                                                    </div>
                                                    <div class="form-group" style="margin-left:10px; width: 230px;">
                                                        <select class="form-control col-md-12" id="site_idEditUser" name="site_id">
                                                            <option value="">Site</option>
                                                            @foreach($sites as $site)
                                                            <option value="{{ $site->id }}">{{ $site->intituleSite }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-user"
                                                            id="emailEditUser" name="email" placeholder="Email">
                                                    </div>
                                                <div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-user"
                                                            id="loginEditUser" name="login" placeholder="Nom Utilisateur">
                                                    </div>
                                                </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control"
                                                            id="passwordEditUser" name="password" placeholder="Mot De Passe">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" class="form-control"
                                                            id="confirm-passwordEditUser" name="confirm-password" placeholder="Confirmer Mot De Passe">
                                                    </div>
                                                    <select class="form-control" id="rolesEditUser" name="roles">
                                                        <option value="">Role</option>
                                                        @foreach($roles as $role)
                                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                <hr>
                                                <div class="row">
                                                <button type="button" id="btnEditUser" class="btn btn-primary col-md-6 mr-2 ml-2"><i class="fas fa-lg fa-user"></i><i class="fas fa-sm fa-check mr-2"></i>Modifier</button>
                                                <button type="button" id="btnExitEditUser" class="btn btn-danger col-md-5"><i class="fas fa-lg fa-user"></i><i class="fas fa-sm fa-times mr-2"></i>Annuler</button>
                                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Confirmation Save USER -->
    <div class="modal fade" id="modalconfirm_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                                    <i style="color:#E02D1B;" class="fas fa-signature mr-2"></i>
                                                                                                    <span  class="badge badge-primary">
                                                                                                    NOM</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <span style="color: black; font-size: 15px;" id="fullname_conf"></span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-hashtag mr-2"></i>
                                                                                                    <span  class="badge badge-primary">
                                                                                                    MATRICULE</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-group">
                                                                                                            <span style="color: black; font-size: 15px;" id="mat_conf"></span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-phone mr-2"></i>
                                                                                                    <span  class="badge badge-primary">
                                                                                                    TELEPHONE</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-group">
                                                                                                            <span style="color: black; font-size: 15px;" id="phone_conf"></span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-city mr-2"></i>
                                                                                                    <span  class="badge badge-primary">
                                                                                                    SITE</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-group">
                                                                                                            <span style="color: black; font-size: 15px;" id="site_conf"></span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-at mr-2"></i>
                                                                                                    <span  class="badge badge-primary">
                                                                                                    EMAIL</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-group">
                                                                                                            <span style="color: black; font-size: 15px;" id="mail_conf"></span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-sign-in-alt mr-2"></i>
                                                                                                    <span  class="badge badge-primary">
                                                                                                    NOM UTILISATEUR</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-group">
                                                                                                            <span style="color: black; font-size: 15px;" id="username_conf"></span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-sign-in-alt mr-2"></i>
                                                                                                    <span  class="badge badge-primary">
                                                                                                    MOT DE PASSE</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-group">
                                                                                                            <span style="color: black; font-size: 15px;" id="pass_conf"></span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-user-lock mr-2"></i>
                                                                                                    <span  class="badge badge-primary">
                                                                                                    ROLE</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <div class="form-group">
                                                                                                            <span style="color: black; font-size: 15px;" id="role_conf"></span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <tbody>
                                                        </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="conf_save_user" data-utilisateurs="{{ $utilisateurs }}" class="btn btn-primary">OUI</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                                </div>
                            </div>
                        </div>
    </div>

    <!-- Modal View User -->
    <div class="modal" id="viewUser" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header" style="background-color:#1761FD;">
                                      <h5 class="modal-title" id="exampleModalLabel" style="color:#FFFFFF;font-weight: bold;">
                                      <i class="fas fa-info fa-lg mr-3"></i>
                                      Informations Utilisateur  <span class="badge badge-success" id="use_name"></span></h5>
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
                                                            <table class="table table-responsive table-bordered mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fas fa-signature mr-2"></i>
                                                                        <span  style="color:black;">
                                                                        Nom</span>
                                                                        </td>
                                                                        <td>
                                                                                <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="name_user">
                                                                                </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fa fa-hashtag mr-2"></i>
                                                                        <span  style="color:black;">Matricule</span>
                                                                        </td>
                                                                        <td>
                                                                                <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="matricule_user">
                                                                                </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fa fa-phone mr-2"></i>
                                                                            <span  style="color:black;">Téléphone</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                    <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="phone_user">
                                                                              </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fas fa-home mr-2"></i>
                                                                        <span style="color:black;">Site</span>
                                                                        </td>
                                                                        <td>
                                                                        <div class="form-group">
                                                                                    <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="site_user">
                                                                              </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#E02D1B;" class="fas fa-at mr-2"></i>
                                                                        <span style="color:black;">Email</span>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                            <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="email_user">
                                                                            </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-sign-in-alt mr-2"></i>
                                                                            <span style="color:black;">Nom Utilisateur</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="username">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-key mr-2"></i>
                                                                            <span style="color:black;">Mot De Passe</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                              <textarea style="background-color:white; border-style: none; font-weight:bolder;" id="password_user" disabled rows="4" cols="30"></textarea>
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#E02D1B;" class="fas fa-toolbox mr-2"></i>
                                                                            <span style="color:black;">Role</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                    <textarea style="background-color:white; border-style: none; font-weight:bolder;" id="role_user" disabled rows="3" cols="20"></textarea>
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
                                          <textarea id="validation" disabled style="width:100%;border-style:none;height:300px;background-color:white;resize: none; color:black; font-size:19px;" class="form-control"></textarea>
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                                      </div>
                                    </div>
                                  </div>
    </div>

    <script src="{{ url('users.js') }}"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="{{ url('jquery/jquery.min.js') }}"></script>
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