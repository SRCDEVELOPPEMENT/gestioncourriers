<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>GESTION COURRIER</title>

    <link href="{{ url('fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ url('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/select.min.css') }}" rel="stylesheet">

    <link href="{{ url('datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <script src="{{ url('jquery/jquery.min.js') }}"></script>
    
    <script src="{{ url('jquery/jquery2.js') }}"></script>
    <script src="{{ url('jquery/select.min.js') }}"></script>
    <script src="{{ url('itineraire.js') }}"></script>

    @toastr_css
</head>
<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Gestion Courrier</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="fa fa-home"></i>
                    <span>Tableau De Bord</span></a>
                    
            </li>


            <!-- Nav Item - Pages Collapse Menu -->
            @can('ma-gestion')
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Ma Gestion</span>
                    <span class="badge badge-danger badge-counter">+</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Module Gestion Courrier</h6>
                        
                        @can(['lister-personne'], ['creer-personne'], ['supprimer-personne'], ['voir-personne'], ['editer-personne'])
                        <a class="collapse-item" href="{{ URL::to('personnes') }}">
                        <i class="fa fa-users fa-lg mr-3"></i>     
                        Emétteur/Récepteur</a>
                        @endcan
                    </div>
                </div>
            </li>
            @endcan

            @can('envoit-courrier')
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('courriers') }}"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-envelope"></i>
                    <span>Envoit De Courriers</span>
                </a>
            </li>
            @endcan

            @can('reception-courrier')
            <hr class="sidebar-divider">
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('receptCourrier') }}"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-download"></i>
                    <span>Réception De Courriers</span>
                </a>
            </li>
            @endcan

            @can('livraison-courrier')
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('livCourrier') }}"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-upload fa-xl"></i>
                    <span>Livraison De Courriers</span>
                </a>
            </li>
            @endcan

            @can('liste-courrier-livrer')
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('archiveCourrier') }}"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-truck fa-xl"></i>
                    <span>Liste Courriers Livrés</span>
                </a>
            </li>
            @endcan
            
            @can('consulter-courrier')
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('consultationCourrierRegion') }}"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-list-alt fa-xl"></i>
                    <span>Consultation Courriers</span>
                </a>
            </li>
            @endcan

            <!-- Divider -->
            @can('consulter-client')
            <hr class="sidebar-divider">
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('ihm_client') }}"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users fa-xl"></i>
                    <span>Interface Client</span>
                </a>
            </li>
            @endcan
            <!-- Nav Item - Pages Collapse Menu -->
            @can('configurations')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-2x fa-wrench"></i>
                    <span>Configurations</span>
                    <span class="badge badge-danger badge-counter">9+</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Accès A L'application</h6>

                        @can(['lister-itineraire'], ['creer-itineraire'], ['editer-itineraire'], ['supprimer-itineraire'])
                        <a class="collapse-item" href="{{ URL::to('itineraires') }}">
                        <i class="fa fa-road fa-lg mr-3"></i>     
                        Itinéraire Voyage</a>
                        @endcan

                        @can(['lister-region'], ['creer-region'], ['editer-region'], ['supprimer-region'])
                        <a class="collapse-item" href="{{ URL::to('regions') }}">
                        <i class="fa fa-globe fa-lg mr-3"></i>     
                        Région</a>
                        @endcan

                        @can(['lister-role'], ['creer-role'], ['supprimer-role'], ['voir-role'], ['editer-role'])
                        <a class="collapse-item" href="{{ URL::to('roles') }}">
                        <i class="fa fa-user-lock fa-lg mr-3"></i>     
                        Role</a>
                        @endcan

                        @can(['lister-site'], ['creer-site'], ['supprimer-site'], ['voir-site'], ['editer-site'])
                        <a class="collapse-item" href="{{ url('sites') }}">
                        <i class="fa fa-building fa-lg mr-3"></i>     
                        Site</a>
                        @endcan

                        @can(['lister-statut'], ['creer-statut'], ['supprimer-statut'], ['voir-statut'], ['editer-statut'])
                        <a class="collapse-item" href="{{ URL::to('statuts') }}">
                        <i class="fa fa-battery-empty fa-lg mr-3"></i>     
                        Statut</a>
                        @endcan
                        @can(['lister-vehicule'], ['creer-vehicule'], ['supprimer-vehicule'], ['voir-vehicule'], ['editer-vehicule'])
                        <a class="collapse-item" href="{{ URL::to('vehicules') }}">
                        <i class="fa fa-truck fa-lg mr-3"></i>     
                        Véhicule</a>
                        @endcan

                        @can(['lister-poste'], ['creer-poste'], ['supprimer-poste'], ['voir-poste'], ['editer-poste'])
                        <a class="collapse-item" href="{{ URL::to('postes') }}">
                        <i class="fa fa-toolbox fa-lg mr-3"></i>     
                        Poste</a>
                        @endcan

                        @can(['lister-utilisateur'], ['creer-utilisateur'], ['supprimer-utilisateur'], ['voir-utilisateur'], ['editer-utilisateur'])
                        <a class="collapse-item" href="{{ URL::to('users') }}">
                        <i class="fa fa-user fa-lg mr-3"></i>     
                        Utilisateur De L'applis</a>
                        @endcan

                        @can(['lister-permission'], ['creer-permission'], ['supprimer-permission'], ['voir-permission'], ['editer-permission'])
                        <a class="collapse-item" href="{{ URL::to('permissions') }}">
                        <i class="fa fa-unlock fa-lg mr-3"></i>     
                        Permission</a>
                        @endcan

                        <a class="collapse-item" 
                           data-toggle="modal" 
                           data-target="#modalSetSettings"
                           data-backdrop="static" 
                           data-keyboard="false">
                        <i class="fas fa-cogs fa-lg mr-3"></i>     
                        Paramètres</a>
                    </div>
                </div>
            </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider">
            
        </ul>
        <!-- End of Sidebar -->
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button class="btn btn-default" id="sidebarToggle"><i class="fas fa-solid fa-bars fa-lg"></i></button>
                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->
                    
                        <!-- <div class="dropdown show col-md-3 mr-3">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="icon text-white-80">
                                            <i class="fa fa-plus mr-3"></i>
                                    </span>
                                  Créer Un Nouveau
                                </a>

                                <div class="dropdown-menu dropdown-toggle-split" aria-labelledby="dropdownMenuLink">

                                    @can(['lister-region'], ['creer-region'], ['editer-region'], ['supprimer-region'])
                                    <a class="dropdown-item" href="{{ URL::to('regions') }}">
                                    <i class="fa fa-thin fa-globe fa-lg mr-3"></i>
                                    Région</a>
                                    @endcan

                                    @can(['lister-role'], ['creer-role'], ['supprimer-role'], ['voir-role'], ['editer-role'])
                                    <a class="dropdown-item" href="{{ URL::to('roles') }}">
                                    <i class="fa fa-user-lock fa-lg mr-3"></i> 
                                    Rôle</a>
                                    @endcan

                                    @can(['lister-site'], ['creer-site'], ['supprimer-site'], ['voir-site'], ['editer-site'])
                                    <a class="dropdown-item" href="{{ url('sites') }}">
                                    <i class="fa fa-building fa-lg mr-3"></i> 
                                    Site</a>
                                    @endcan

                                    @can(['lister-statut'], ['creer-statut'], ['supprimer-statut'], ['voir-statut'], ['editer-statut'])
                                    <a class="dropdown-item" href="{{ URL::to('statuts') }}">
                                    <i class="fa fa-battery-empty fa-lg mr-3"></i>  
                                    Statut</a>
                                    @endcan

                                    @can(['lister-vehicule'], ['creer-vehicule'], ['supprimer-vehicule'], ['voir-vehicule'], ['editer-vehicule'])
                                    <a class="dropdown-item" href="{{ URL::to('vehicules') }}">
                                    <i class="fa fa-truck fa-lg mr-3"></i>    
                                    Véhicule</a>
                                    @endcan

                                    @can(['lister-poste'], ['creer-poste'], ['supprimer-poste'], ['voir-poste'], ['editer-poste'])
                                    <a class="dropdown-item" href="{{ URL::to('postes') }}">
                                    <i class="fa fa-toolbox fa-lg mr-3"></i>     
                                    Poste</a>
                                    @endcan

                                    @can(['lister-utilisateur'], ['creer-utilisateur'], ['supprimer-utilisateur'], ['voir-utilisateur'], ['editer-utilisateur'])
                                    <a class="dropdown-item" href="{{ URL::to('users') }}">
                                    <i class="fa fa-user fa-lg mr-3"></i>
                                    Utilisateur De L'applis</a>
                                    @endcan

                                    @can(['lister-permission'], ['creer-permission'], ['supprimer-permission'], ['voir-permission'], ['editer-permission'])
                                    <a class="dropdown-item" href="{{ URL::to('permissions') }}">
                                    <i class="fa fa-unlock fa-lg mr-3"></i>         
                                    Permission</a>
                                    @endcan

                                    @can(['lister-personne'], ['creer-personne'], ['supprimer-personne'], ['voir-personne'], ['editer-personne'])
                                    <a class="dropdown-item" href="{{ URL::to('personnes') }}">
                                    <i class="fa fa-users fa-lg mr-3"></i>    
                                    Emétteur/Récepteur</a>
                                    @endcan
                                </div>
                        </div> -->
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->fullname}}</span>
                                <img class="img-profile rounded-circle"
                                src="{{ url('img/sorepco.jpg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <?php $site =  DB::table('sites')->where('id', '=', auth()->user()->site_id)->get()->first(); ?>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item"
                                   data-toggle="modal" 
                                   data-target="#ProfileUser"
                                   data-backdrop="static" 
                                   data-keyboard="false"
                                   data-password="{{ auth()->user()->password }}"
                                   data-user="{{ auth()->user() }}"
                                   id="profil"
                                   data-intituleSite="{{ $site ? $site->intituleSite : '' }}"
                                   >
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                 Activité Connexion
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal" data-backdrop="static" data-keyboard="false">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('content')
            </div> 
            <!-- End of Main Content -->
            

            <!-- Footer -->
            <footer class="sticky-footer bg-primary" style="font-family: 'Century Gothic';">
                <div class="container my-auto">
                    <div class="copyright text-center text-white my-auto">
                        <span class="text-xl mr-3">Copyright &copy; SOREPCO SA 2022</span>
                        <span class="mr-3">
                            <i class="fas fa-lg fa-eye mr-1"></i>
                            <a style="text-decoration: underline;" class="text-white text-xl" target="_blank" href="https://groupesorepco.com/">Site Web</a>
                        </span>
                        <span class="text-white text-xl mr-3">
                            <i class="fas fa-lg fa-crosshairs mr-1"></i>
                            Address: Salle des fêtes, Douala Cameroun
                        </span>
                        <span class="text-white text-xl mr-3">
                            <i class="fas fa-lg fa-envelope mr-1"></i>
                            Email: info@groupesorepco.com
                        </span>
                        <span class="mr-3">
                            <i class="fas fa-phone mr-1"></i>
                            Phone: (237) 6 999 66 000
                        </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    </div>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <i class="fas fa-sign-out-alt fa-2x fa-fw mr-2"></i>
                                            Pret A Partir ?
                                        </h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="color:black; font-size:17px;">Cliquer Sur Déconnexion méttra Fin à Votre Session. OK ? </div>
                                    <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                                <i class="fas fa-lg fa-times mr-2"></i>    
                                                Annuler
                                            </button>
                                            <form method="post" action="{{ URL::to('logout') }}">
                                                @csrf
                                                <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-lg fa-sign-out-alt mr-2"></i>    
                                                Déconnexion</button>
                                            </form>
                                    </div>
                    </div>
            </div>
    </div>

    <!-- Modal Profile User -->
    <div class="modal" id="ProfileUser" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header" style="background-color:#1761FD;">
                                      <h5 class="modal-title" id="exampleModalLabel" style="color:#FFFFFF;font-weight: bold;">
                                      <i class="fas fa-info fa-lg mr-3"></i>
                                      Informations Utilisateur  <span class="badge badge-success text-lg" id="fullname"></span></h5>
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
                                                                <div class="imgs" style="float:right; margin-bottom:-35rem; padding-top:3rem; padding-right:3rem;">
                                                                        <img src="{{asset('/img/tof.png')}}" alt="First slide">
                                                                </div>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#273A70;" class="fas fa-lg fa-signature mr-2"></i>
                                                                        <span  style="color:black;">
                                                                        Nom</span>
                                                                        </td>
                                                                        <td>
                                                                                <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="fulname">
                                                                                </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#273A70;" class="fa fa-lg fa-hashtag mr-2"></i>
                                                                        <span  style="color:black;">Matricule</span>
                                                                        </td>
                                                                        <td>
                                                                                <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="matricul">
                                                                                </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#273A70;" class="fa fa-lg fa-phone mr-2"></i>
                                                                            <span  style="color:black;">Téléphone</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                    <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="telefones">
                                                                              </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#273A70;" class="fas fa-lg fa-home mr-2"></i>
                                                                        <span style="color:black;">Site</span>
                                                                        </td>
                                                                        <td>
                                                                        <div class="form-group">
                                                                                    <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="sit">
                                                                              </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        <i style="color:#273A70;" class="fas fa-lg fa-at mr-2"></i>
                                                                        <span style="color:black;">Email</span>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                            <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="mail">
                                                                            </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#273A70;" class="fas fa-lg fa-sign-in-alt mr-2"></i>
                                                                            <span style="color:black;">Nom Utilisateur</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                      <input style="background-color:white; border-style: none; font-weight:bolder;" disabled type="text" id="usernames">
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#273A70;" class="fas fa-lg fa-key mr-2"></i>
                                                                            <span style="color:black;">Mot De Passe</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                              <textarea style="background-color:white; border-style: none; font-weight:bolder;" id="passwords" disabled rows="4" cols="30"></textarea>
                                                                                </div>
                                                                      </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <i style="color:#273A70;" class="fas fa-lg fa-toolbox mr-2"></i>
                                                                            <span style="color:black;">Role</span>
                                                                        </td>
                                                                        <td>
                                                                              <div class="form-group">
                                                                                    <textarea style="background-color:white; border-style: none; font-weight:bolder;" id="rol" disabled rows="3" cols="20"></textarea>
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
    
    <!-- Modal Parametres -->
    <div class="modal" id="modalSetSettings" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary text-white">
                        <i class="fas fa-3x fa-box-open"></i>
                        <h5 style="font-size:1.1em; margin-left: 4rem; font-weight:bolder;" class="modal-title text-justifiy">
                        GESTION COURRIER</h5>
                        <button type="button" id="btnExit_ihm_settings" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                <div class="modal-body">
                        <div class="col-md-12">
                            <button type="button" 
                                    class="btn btn-outline-primary col-md-12"
                                    data-toggle="modal" 
                                    data-target="#modalAddItineraire"
                                    data-backdrop="static" 
                                    data-keyboard="false">
                                <i class="fas fa-lg fa-road"></i>
                                <i class="fas fa-sm fa-car mr-3"></i>
                                ITINERAIRE
                                <i class="fas fa-lg fa-angle-right ml-5"></i>
                            </button>
                        </div>
                        <hr>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Itineraire -->
    <div class="modal" id="modalAddItineraire" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary text-white">
                        <i class="fas fa-2x fa-road"></i><i class="fas fa-sm fa-car mr-3"></i>
                        <h5 style="font-size:1.1em; margin-left: 4rem; font-weight:bolder;" class="modal-title text-justifiy">
                        ITINERAIRE</h5>
                        <button type="button" id="btnExit_itineraire_Main" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                <div class="modal-body">
                    <form id="ItineraireForm" autocomplete="off">
                            {{ csrf_field() }}
                                @csrf
                        <div class="col-md-12" style="color:black;">
                            <div class="form-group">
                                <label for=""><i class="fas fa-lg fa-plane-departure mr-3" style="color:#0069D9;"></i>Lieux De Départ</label>
                                <input type="text" class="form-control border-primary" id="lieux_depart_Main" name="lieux_depart">
                            </div>
                            <div class="form-group">
                                <label for=""><i class="fas fa-lg fa-plane-arrival mr-3" style="color:#0069D9;"></i>Lieux D'arrivé</label>
                                <input type="text" class="form-control border-primary" id="lieux_arrivee_Main" name="lieux_arrivee">
                            </div>
                            <div class="form-group">
                                <label for=""><i class="fas fa-lg fa-clock mr-3" style="color:#0069D9;"></i>Durée</label>
                                <input type="number" min="1" max="200" class="form-control border-primary" id="duree_Main" name="duree" max="48:00">
                            </div>
                            <hr>
                            <button type="button" 
                                    id="setItineraireMainPage" 
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

    <!-- Modal error validation-->
    <div class="modal fade" id="errorvalidationsMainPage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                          <textarea id="validationsMainPage" disabled style="width:100%;border-style:none;height:150px;background-color:white;resize: none; color:black; font-size:19px;" class="form-control"></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                            </div>
                    </div>
            </div>
    </div>

    <!-- Modal Confirmation Save Itineraire -->
    <div class="modal fade" id="modalConfirmMainPage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                                    <span style="color: black; font-size: 20px;" id="lieux_depart_conf_Main"></span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                    <i style="color:#E02D1B;" class="fas fa-globe mr-2"></i>
                                                                                                    <span  class="badge badge-success">
                                                                                                    Lieux Arrivée</span>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                    <span style="color: black; font-size: 20px;" id="lieux_arrive_conf_Main"></span>
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
                                                                                                            <span style="color: black; font-size: 20px;" id="duree_itineraire_conf_Main"></span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            <tbody>
                                                        </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="conf_MainPage_Itin" class="btn btn-primary">OUI</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                                </div>
                            </div>
                        </div>
    </div> 

</body>
@toastr_js
@toastr_render
</html>
<script>
        $(document).on('click', '#profil', function(){
            let userConnecter = JSON.parse($(this).attr('data-user'));

            $('#fullname').replaceWith(`<span class="badge badge-success text-lg" id="fullname">${userConnecter.login}</span>`)
            $('#fulname').val(userConnecter.fullname);
            $('#matricul').val(userConnecter.matricule);
            $('#telefones').val(userConnecter.telephone);
            $('#sit').val($(this).attr('data-intituleSite'));
            $('#mail').val(userConnecter.email);
            $('#usernames').val(userConnecter.login);
            $('#passwords').val($(this).attr('data-password'));
            if(userConnecter.roles.length > 1){
                let conc = "";
                for (let index = 0; index < userConnecter.roles.length; index++) {
                    const elt = userConnecter.roles[index];
                    conc += elt.name + "\n";
                }
                $('#rol').val(conc);
            }else{
                $('#rol').val(userConnecter.roles[0].name);
            }
        });
</script>
