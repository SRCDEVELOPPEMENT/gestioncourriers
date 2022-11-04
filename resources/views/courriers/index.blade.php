@extends('layouts.main')


@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

                    <!-- Page Heading -->

                    <p class="mb-4">
                        <div class="row mb-5" style="font-family: 'Century Gothic';">
                                <div class="col-md-1 col-sm-6 text-left">
                                        <a href="{{ URL::to('dashboard')  }}" type="button" class="btn btn-info btn-icon-back">
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
                                    <span class="mr-2">COURRIERS ANNULER</span><span class="badge badge-success text-lg mr-3">{{ $annuler }}</span>
                                </div>
                                <div class="col-md-2 col-sm-6 text-right">
                                                @can('creer-courrier')
                                                    <button type="button" id="btnewcolis" data-toggle="modal" data-target="#create" data-backdrop="static" data-keyboard="false" class="btn btn-primary btn-icon-split">
                                                        <span class="icon text-white-80">
                                                            <i class="fas fa-plus" style="font-size:10px;"></i>
                                                            <i class="fa fa-thin fa-envelope fa-lg"></i>
                                                        </span>
                                                        <span class="text">AJOUT COURRIER</span>
                                                    </button>
                                                @endcan
                                </div>
                        </div>
                    </p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4" style="font-family: 'Century Gothic';">
                        <div class="card-header py-1">
                            <div class="row">
                                <div style="color:black;" class="col-md-4 text-lg text-left">
                                    Liste Des Courriers Enrégistrés
                                </div>
                                <div class="col-md-8 text-right row">
                                    <form action="{{ url('generate-pdf-date') }}">
                                        @csrf
                                        @method('GET')
                                        <input type="date" style="background-color:#252A37; color:white;" class="form-control-sm mr-2" name="date_create" id="date_print">
                                        <button id="btn_pdf_date" title="PDF Courrier Par Date" disabled style="background-color:#252A37; color:white;" type="submit" class="btn btn-sm btn-icon-split mr-5">
                                            <span class="icon text-white-80">
                                                <i class="fas fa-file-pdf" style="font-size:10px;"></i>
                                                <i class="fa fa-lg fa-solid fa-envelope"></i>
                                            </span>
                                            <span class="text">PDF COURRIERS PAR DATE</span>
                                        </button>
                                    </form>
                                    <div>
                                        <button onclick="window.location='{{ route('generate-pdf-journalier') }}'" class="btn btn-dark btn-sm mr-5">
                                        <i class="fas fa-file-pdf" style="font-size:10px;"></i>
                                        <i class="fas fa-thin fa-lg fa-envelope mr-1"></i>
                                        PDF JOURNALIER</button>

                                        <button onclick="location.reload()" class="btn btn-sm btn-light ml-5">
                                        <i class="fas fa-solid fa-2x fa-spinner"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" name="dataTableCourrier" id="dataTable" width="100%" cellspacing="0">
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
                                                            @can('editer-courrier')
                                                            <button class="btn btn-sm btn-info mr-1"
                                                                    title="Edition" 
                                                                    id="btnEdit"
                                                                    data-sites="{{ $sites }}"
                                                                    name="btnEditCourrierViews"
                                                                    data-courrier="{{ $courrier }}"
                                                                    data-personnes="{{ $persons }}"
                                                                    data-toggle="modal"
                                                                    data-target="#edit"
                                                                    data-backdrop="static"
                                                                    data-keyboard="false"
                                                                    {{ $courrier->status != 'ENCOURS' &&  $courrier->status != 'ENTRANSIT' ? 'disabled' : '' }}>
                                                                    <span class="icon text-white-80 m-1">
                                                                        <i class="fas fa-lg fa-envelope"></i>
                                                                        <i class="fas fa-pen" style="font-size:13px;"></i>
                                                                    </span>
                                                            </button>
                                                            @endcan
                                                            @can('supprimer-courrier')
                                                            <button class="btn btn-sm btn-danger mr-1"
                                                                    name="btnCancelCourrier" 
                                                                    title="Annuler" 
                                                                    id="btnAnnulerCourrier" 
                                                                    data-id="{{ $courrier->id }}"
                                                                    data-code="{{ $courrier->code }}"
                                                                    {{ $courrier->status == 'ENCOURS' ? : 'disabled' }}>
                                                                    <span class="icon text-white-80 m-1">
                                                                        <i class="fas fa-lg fa-envelope"></i>
                                                                        <i class="fas fa-times" style="font-size:13px;"></i>
                                                                    </span>
                                                            </button>
                                                            @endcan
                                                            @can('voir-courrier')
                                                            <button class="btn btn-sm btn-primary mr-1" 
                                                                    data-courrier="{{ $courrier }}"
                                                                    data-cars="{{ $vehicules }}" 
                                                                    data-toggle="modal" 
                                                                    data-target="#viewCourrier"
                                                                    data-backdrop="static" 
                                                                    data-keyboard="false" 
                                                                    title="Voir" 
                                                                    name="btnViewCours"
                                                                    id="btnViewCourrier">
                                                                    <span class="icon text-white-80 m-1">
                                                                        <i class="fas fa-lg fa-envelope"></i>
                                                                        <i class="fas fa-eye" style="font-size:13px;"></i>
                                                                    </span>
                                                            </button>
                                                            @endcan
                                                            @can('retirer-courrier')
                                                            <button class="btn btn-sm btn-dark mr-1" 
                                                                    title="Retrait" 
                                                                    id="btnRetrait" 
                                                                    data-courrier="{{ $courrier }}"
                                                                    data-id="{{ $courrier->id }}" 
                                                                    data-toggle="modal" 
                                                                    data-target="#modalRetraitCourrier" 
                                                                    data-backdrop="static" 
                                                                    data-keyboard="false"
                                                                    {{ $courrier->status == 'ENCOURS' ? : 'disabled' }}>
                                                                    <span class="icon text-white-80 m-1">
                                                                        <i class="fas fa-lg fa-envelope"></i>
                                                                        <i class="fas fa-upload" style="font-size:13px;"></i>
                                                                    </span>
                                                            </button>
                                                            @endcan

                                                            <button title="PDF COURRIER" 
                                                                    id="preview_button" 
                                                                    onclick="window.location='{{ route('preview', ['courrier' => json_encode($courrier)]) }}'" 
                                                                    class="btn btn-sm" 
                                                                    style="background-color:#E63673; color:white;">
                                                                    <span class="icon text-white-80 m-1">
                                                                        <i class="fas fa-lg fa-envelope"></i>
                                                                        <i class="fas fa-file-pdf" style="font-size:13px;"></i>
                                                                    </span>
                                                            </button>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                        </tbody>
                                </table>

                                <a title="PDF Courrier ENCOURS" href="{{ route('generate-file', ['status' => 'ENCOURS']) }}" type="button" class="btn btn-primary btn-icon-split mt-4">
                                        <span class="icon text-white-80">
                                            <i class="fas  fa-file-pdf" style="font-size:10px;"></i>
                                            <i class="fa fa-lg fa-solid fa-envelope mr-2"></i>
                                        </span>
                                        <span class="text">PDF COURRIERS ENCOURS</span>
                                </a>
                            </div>
                        </div>
                    </div>

    </div>
    <!-- /.container-fluid -->

                    <!-- Modal Add Courrier -->
                    <div class="modal" id="create" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#1761FD;">
                                    <h5 class="modal-title" id="exampleModalLabel" style="color:#FFFFFF;font-weight: bold;">
                                        <i class="fas fa-save" style="font-size:10px;"></i>    
                                        <i class="fas fa-2x fa-envelope"></i>
                                     <span style="font-size:1.1em; margin-left:25rem;" >Ajout Informations Courrier</span></h5>
                                    <button type="button" id="btnClose" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body" style="color: black;">
                                        <form id="InsertFormCourrier" style="font-family: 'Century Gothic';">
                                            @csrf
                                            @method('POST')
                                                <input id="stats" value="ENCOURS" type="hidden" name="status">
                                                <div class="card" style="width: 100%; margin-bottom: 20px; border-color: #CFE2FF;">
                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-box-open mr-2"></i>TYPE DE COURRIER <span style="color:red;">*</span></label>
                                                                                                        <select id="TypeCourrier" name="TypeCourrier" class="form-control border-primary">
                                                                                                            <option value="">Selectionner Un Type</option>
                                                                                                                <option value="Document">DOCUMENT</option>
                                                                                                                <option value="Colis">COLIS</option>
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-envelope mr-2"></i>TYPE ENVOIE <span style="color:red;">*</span></label>
                                                                                                        <select data-sites="{{ $sites }}" id="TypeEnvoie" name="TypeEnvoie" class="form-control border-primary">
                                                                                                            <option value="">Selectionner Un Type</option>
                                                                                                                <option value="INTERNE">INTERNE</option>
                                                                                                                <option value="EXTERNE">EXTERNE</option>
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card" style="width: 100%; margin-bottom: 20px; border-color: #CFE2FF;">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-user-tie mr-2"></i>DESTINATEUR</label>
                                                                <input type="text" id="fullname_destinateur" name="fullname_destinateur" class="form-control border-primary">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-phone mr-2"></i>TELEPHONE DESTINATEUR</label>
                                                                <input type="tel" id="phone_desti" name="phone_desti" class="form-control border-primary">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-user-tie mr-2"></i>DESTINATEUR</label>
                                                                    <select id="selDestinateur" style="width:100%;" name="destinateur_courrier" class="form-control border-primary">
                                                                        <option value="">Selectionner Un Destinateur</option>
                                                                            @foreach($persons as $personne)
                                                                               <option value="{{ $personne->id }}">{{ $personne->fullname }} - {{ $personne->telephone }}</option>
                                                                            @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card" style="width: 48%; margin-bottom: 20px; border-color: #CFE2FF;">
                                                    <div class="card-body">
                                                                                    <div class="row">
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                            <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-user-tag mr-2"></i>NOM EXPEDITEUR</label>
                                                                                                            <input type="text" id="destinateur" name="destinateur" class="form-control border-primary">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                    <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-phone mr-2"></i>TELEPHONE EXPEDITEUR</label>
                                                                                                    <input type="tel" id="telephone_destinateur" name="telephone_destinateur" class="form-control border-primary">
                                                                                                    </div>
                                                                                                </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                            <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-user-tag"></i>
                                                                                                            <i style="color:#0069D9;" class="fas fa-sm fa-phone mr-2"></i>
                                                                                                            EXPEDITEUR</label>
                                                                                                            <select id="selPersonne" style="width:100%;" name="emetteur_id" class="form-control border-primary">
                                                                                                                <option value="">Selectionner Un Expéditeur</option>
                                                                                                                @foreach($persons as $personne)
                                                                                                                <option value="{{ $personne->id }}">{{ $personne->fullname }} - {{ $personne->telephone }}</option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                    </div>
                                                                                    <?php 
                                                                                        $region_site_user_logger = NULL;
                                                                                        if(Auth::user()->site_id){
                                                                                            $site_user_logger = DB::table('sites')->where('id', '=', Auth::user()->site_id)->get()->first();
                                                                                            $region_site_user_logger = DB::table('regions')->where('id', '=', $site_user_logger->region_id)->get()->first();
                                                                                        }
                                                                                    ?>
                                                                                    <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                            <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-building mr-2"></i>SITE EXPEDITEUR <span style="color:red;"> *</span></label>
                                                                                                            <select id="site_expediteur" name="site_exp_id" class="form-control border-primary">
                                                                                                                <option value="">Selectionner Un Site</option>
                                                                                                                @foreach($sites as $site)
                                                                                                                  @if($region_site_user_logger)
                                                                                                                    @if($site->region_id == $region_site_user_logger->id)
                                                                                                                        <option value="{{ $site->id }}">{{ $site->intituleSite }}</option>
                                                                                                                    @endif
                                                                                                                  @else
                                                                                                                  <option value="{{ $site->id }}">{{ $site->intituleSite }}</option>
                                                                                                                  @endif
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                </div>
                                                                                    </div>

                                                    </div>
                                                </div>
                                                <div class="card" style="width: 50.5%; float:right; margin-top: -19rem; border-color: #CFE2FF;">
                                                        <div class="card-body">
                                                                                        <div class="row">
                                                                                                <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                        <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-user mr-2"></i>NOM RECEPTEUR</label>
                                                                                                        <input type="text" id="destinataire" name="destinataire" class="form-control border-primary">
                                                                                                </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                    <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-phone mr-2"></i>TELEPHONE RECEPTEUR</label>
                                                                                                    <input type="tel" id="telephone_destinataire" name="telephone_destinataire" class="form-control border-primary">
                                                                                                    </div>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-user"></i>
                                                                                                    <i style="color:#0069D9;" class="fas fa-sm fa-phone mr-2"></i>
                                                                                                    RECEPTEUR</label>
                                                                                                    <select id="selUser" style="width:100%;" name="recepteur_id" class="form-control border-primary">
                                                                                                        <option value="">Selectionner Un Récepteur</option>
                                                                                                        @foreach($persons as $personne)
                                                                                                        <option value="{{ $personne->id }}">{{ $personne->fullname }} - {{ $personne->telephone }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-building mr-2"></i>SITE RECEPTEUR <span style="color:red;"> *</span></label>
                                                                                                    <select id="site_recept_id" name="site_recept_id" class="form-control border-primary">
                                                                                                        <option value="">Selectionner Un Site</option>
                                                                                                        @foreach($sites as $site)
                                                                                                            <option value="{{ $site->id }}">{{ $site->intituleSite }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="card" style="width: 50%; margin-top: 1rem; margin-left: 34rem; border-color:#CFE2FF;">
                                                    <div class="card-body">
                                                                                    <div class="row">
                                                                                            <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label for="userinput1">
                                                                                                    <i style="color:#0069D9;" class="fas fa-lg fa-road"></i>
                                                                                                    <i style="color:#0069D9;" class="fas fa-sm fa-car mr-2"></i>
                                                                                                ITINERAIRE  <span style="color:red;"> *</span></label>
                                                                                                <select class="form-control border-primary" name="road" id="road">
                                                                                                    <option value="">Selectionner Un Itinéraire</option>
                                                                                                    @foreach($itineraires as $itineraire)
                                                                                                    <option value="{{ $itineraire->id }}">{{ $itineraire->lieux_depart }} - {{ $itineraire->lieux_arrivee }} - {{ $itineraire->duree }} H </option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                            </div>
                                                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card" style="width: 48%; margin-top: -8rem; margin-right:15rem; border-color:#CFE2FF;">
                                                    <div class="card-body">
                                                                                    <div class="row">
                                                                                            <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-paperclip mr-2"></i>OBJET <span style="color:red;">*</span></label>
                                                                                                <textarea rows="3" id="objet" name="objet" class="form-control"></textarea>
                                                                                            </div>
                                                                                            </div>
                                                                                    </div>
                                                    </div>
                                                </div>

                                                <div style="margin-left:34rem; margin-top:-2rem;">
                                                    <div class="row">
                                                                    <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                    <button type="button" id="btnResetForm" class="btn btn-outline-danger btn-block">
                                                                                    <span class="icon text-white-80 mr-2">
                                                                                        <i class="fas fa-times" style="font-size:10px;"></i>
                                                                                        <i class="fas fa-lg fa-envelope"></i>
                                                                                    </span>
                                                                                            Annuler Le Courrier
                                                                                    </button>
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                    <button id="btnAddCourrier" type="button" class="btn btn-outline-info btn-block">
                                                                                    <span class="icon text-white-80 mr-2">
                                                                                    <i class="fas fa-save" style="font-size:10px;"></i>    
                                                                                    <i class="fas fa-lg fa-envelope"></i>
                                                                                    </span>
                                                                                            Enrégistrer Le Courrier
                                                                                    </button> 
                                                                            </div>
                                                                    </div>
                                                    </div>
                                                </div>
                                        </form>
                                </div>
                            </div>
                          </div>
                    </div>

                    <!-- Modal Edit Courrier -->
                    <div class="modal" id="edit" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#1761FD;">
                                    <h5 class="modal-title" id="exampleModalLabel" style="color:#FFFFFF;font-weight: bold;">
                                    <i class="fa fa-2x fa-envelope" aria-hidden="true"></i>
                                    <i class="fas fa-pen  mr-4" style="font-size:12px;"></i>
                                    <span style="font-size:1.1em; margin-left:20rem;">Edition Informations Courrier </span>
                                    <span class="badge badge-success" id="numero_edit_courrier"></span></h5>
                                    <button type="button" id="btnCloseEdit" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body" style="color: black;">
                                        <form id="EditFormCourrier" action="{{ url('preview') }}" style="font-family: 'Century Gothic';">
                                        {{ csrf_field() }}
                                            @csrf
                                                
                                                <div class="card" style="width: 100%; margin-bottom: 20px; border-color:#CFE2FF;">
                                                    <div class="card-body">
                                                                                        <input id="stats_edit" value="ENCOURS" type="hidden" name="status">
                                                                                        <div class="form-group">
                                                                                                <input id="id_edit_courrier" type="hidden" name="id">
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-box-open mr-2"></i>Type De Courrier <span style="color:red;">*</span></label>
                                                                                                        <select id="TypeCourrierEdit" name="TypeCourrier" class="form-control border-primary">
                                                                                                            <option value="">Selectionner Un Type</option>
                                                                                                                <option value="Document">Document</option>
                                                                                                                <option value="Colis">Colis</option>
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-envelope mr-2"></i> Type Envoie <span style="color:red;">*</span></label>
                                                                                                        <select id="TypeEnvoieEdit" data-sites="{{ $sites }}" name="TypeEnvoie" class="form-control border-primary">
                                                                                                            <option value="">Selectionner Un Type</option>
                                                                                                                <option value="INTERNE">INTERNE</option>
                                                                                                                <option value="EXTERNE">EXTERNE</option>
                                                                                                        </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card" style="width: 100%; margin-bottom: 20px; border-color:#CFE2FF;">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-user-tie mr-2"></i>Destinateur</label>
                                                                <input type="text" id="fullname_destinateur_edit" name="fullname_destinateur" class="form-control border-primary">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-phone mr-2"></i>Téléphone Destinateur</label>
                                                                <input type="tel" id="phone_desti_edit" name="phone_desti" class="form-control border-primary">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-user-tie mr-2"></i>Destinateur</label>
                                                                    <select id="selDestin_cour" style="width:100%;" name="destinateur_courrier_edit" class="form-control border-primary">
                                                                        <option value="">Selectionner Un Destinateur</option>
                                                                            @foreach($persons as $personne)
                                                                               <option value="{{ $personne->id }}">{{ $personne->fullname }} - {{ $personne->telephone }}</option>
                                                                            @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card" style="width: 48%; margin-bottom: 20px; border-color:#CFE2FF;">
                                                    <div class="card-body">
                                                                                    <div class="row">
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                            <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-user-tag mr-2"></i>Nom Expéditeur</label>
                                                                                                            <input type="text" id="destinateurEdit" name="destinateur" class="form-control border-primary">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                    <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-phone mr-2"></i>Téléphone Expéditeur</label>
                                                                                                    <input type="tel" id="telephone_destinateurEdit" name="telephone_destinateur" class="form-control border-primary">
                                                                                                    </div>
                                                                                                </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                        <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-user-tag"></i>
                                                                                                        <i style="color:#0069D9;" class="fas fa-sm fa-phone mr-2"></i>
                                                                                                        Expéditeur</label>
                                                                                                        <select id="selPersonneEdit" style="width:100%;" name="emetteur_id" class="form-control border-primary">
                                                                                                            <option value="">Selectionner Un Expéditeur</option>
                                                                                                            @foreach($persons as $personne)
                                                                                                            <option value="{{ $personne->id }}">{{ $personne->fullname }} - {{ $personne->telephone }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                </div>
                                                                                                </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                            <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-building mr-2"></i> Site Expéditeur <span style="color:red;"> *</span></label>
                                                                                                            <select id="site_expediteur_edit" name="site_exp_id" class="form-control border-primary">
                                                                                                                <option value="">Selectionner Un Site</option>
                                                                                                                @foreach($sites as $site)
                                                                                                                <option value="{{ $site->id }}">{{ $site->intituleSite }}</option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                </div>
                                                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card" style="width: 51%; float:right; margin-top: -19rem; border-color:#CFE2FF;">
                                                        <div class="card-body">
                                                                                        <div class="row">
                                                                                                <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                        <label for=""> <i style="color:#0069D9;" class="fas fa-lg fa-user mr-2"></i>Nom Recepteur</label>
                                                                                                        <input type="text" id="destinataireEdit" name="destinataire" class="form-control border-primary">
                                                                                                </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                    <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-phone mr-2"></i>Téléphone Recepteur</label>
                                                                                                    <input type="tel" id="telephone_destinataireEdit" name="telephone_destinataire" class="form-control border-primary">
                                                                                                    </div>
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-user"></i>
                                                                                                    <i style="color:#0069D9;" class="fas fa-sm fa-phone mr-2"></i>
                                                                                                    Recepteur</label>
                                                                                                    <select id="selUserEdit" style="width:100%;" name="recepteur_id" class="form-control border-primary">
                                                                                                        <option value="">Selectionner Un Récepteur</option>
                                                                                                        @foreach($persons as $personne)
                                                                                                        <option value="{{ $personne->id }}">{{ $personne->fullname }} - {{ $personne->telephone }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-building mr-2"></i>Site Recepteur <span style="color:red;"> *</span> </label>
                                                                                                    <select id="site_recept_idEdit" name="site_recept_id" class="form-control border-primary">
                                                                                                        <option value="">Selectionner Un Site</option>
                                                                                                        @foreach($sites as $site)
                                                                                                            <option value="{{ $site->id }}">{{ $site->intituleSite }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="card" style="width: 48%; margin-top: 1rem; margin-right:15rem; border-color:#CFE2FF;">
                                                    <div class="card-body">
                                                                                    <div class="row">
                                                                                            <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label for="userinput1"><i style="color:#0069D9;" class="fas fa-lg fa-paperclip mr-2"></i> Objet <span style="color:red;">*</span></label>
                                                                                                <textarea rows="3" id="objetEdit" name="objet" class="form-control"></textarea>
                                                                                            </div>
                                                                                            </div>
                                                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card" style="width: 51%; margin-top: -12rem; margin-left:34rem; border-color:#CFE2FF;">
                                                    <div class="card-body">
                                                                                    
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label> 
                                                                                                    Poste (Chauffeur/Coursier)</label>
                                                                                                    <select id="posteIndexPage" data-personnes="{{ $persons }}" class="form-control border-primary">
                                                                                                            <option value="">Selectionner Un Poste</option>
                                                                                                            @foreach($postes as $poste)
                                                                                                                <option value="{{ $poste->id }}">{{ $poste->intitulePoste }}</option>
                                                                                                            @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="userinput1"> 
                                                                                                        <i style="color:#0069D9;" class="fas fa-lg fa-user"></i>
                                                                                                        <i style="color:#0069D9;" class="fas fa-sm fa-car mr-2"></i>
                                                                                                    Conducteur</label>
                                                                                                    <select id="chauffeur_id" name="chauffeur_id" class="form-control border-primary">
                                                                                                            <option value="">Selectionner Un Conducteur</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="form-group">
                                                                                                    <label for="userinput1 mr-2"> <i style="color:#0069D9;" class="fas fa-lg fa-truck mr-2"></i>Véhicule</label>
                                                                                                    <select id="vehicule_effectif_id" name="vehicule_effectif_id" class="form-control border-primary">
                                                                                                            <option value="">Selectionner Un Véhicule</option>
                                                                                                            @foreach($vehicules as $vehicule)
                                                                                                                <option value="{{ $vehicule->id }}">{{ $vehicule->Immatriculation }}</option>
                                                                                                            @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card" style="width: 50%; margin-top: 1rem; margin-left: 34rem; border-color:#CFE2FF;">
                                                    <div class="card-body">
                                                                                    <div class="row">
                                                                                            <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label for="userinput1">
                                                                                                    <i style="color:#0069D9;" class="fas fa-lg fa-road"></i>
                                                                                                    <i style="color:#0069D9;" class="fas fa-sm fa-car mr-2"></i>
                                                                                                ITINERAIRE</label>
                                                                                                <select class="form-control border-primary" name="road" id="road_edit">
                                                                                                    <option value="">Selectionner Un Itinéraire</option>
                                                                                                    @foreach($itineraires as $itineraire)
                                                                                                    <option value="{{ $itineraire->id }}">{{ $itineraire->lieux_depart }} - {{ $itineraire->lieux_arrivee }} - {{ $itineraire->duree }} </option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                            </div>
                                                                                    </div>
                                                    </div>
                                                </div>

                                                <div  style="margin-top:-4rem;">
                                                    <div class="row col-md-6">
                                                                <div class="col-md-6">
                                                                        <div class="form-group">
                                                                                <button type="button" id="btnResetFormEdit" class="btn btn-outline-danger btn-block">
                                                                                <span class="icon text-white-80 mr-2">
                                                                                    <i class="fas fa-times" style="font-size:10px;"></i>
                                                                                    <i class="fas fa-lg fa-envelope"></i>
                                                                                </span>
                                                                                        Annuler
                                                                                </button>
                                                                        </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                        <div class="form-group">
                                                                                <button id="btnEditCourrier" data-personnes="{{ $persons }}" type="button" class="btn btn-outline-info btn-block">
                                                                                <span class="icon text-white-80 mr-2">
                                                                                    <i class="fas fa-edit" style="font-size:10px;"></i>
                                                                                    <i class="fas fa-lg fa-envelope"></i>
                                                                                </span>
                                                                                        Modifier
                                                                                </button> 
                                                                        </div>
                                                                </div>
                                                    </div>
                                                </div>
                                        </form>
                                </div>
                            </div>
                          </div>
                    </div>

                    <!-- Modal Retrait Courrier -->
                    <div class="modal" id="modalRetraitCourrier" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header  bg-primary text-white">
                                <h5 class="modal-title">
                                <i class="fas fa-lg fa-envelope"></i> 
                                <i class="fas fa-upload mr-3" style="font-size:11px;"></i> 
                                Retrait Courrier <span class="badge badge-success" id="numero_courrier"></span></h5>
                                <button type="button" id="btnExit_retrait" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                    <form id="RetraitCourrierForm" autocomplete="off" style="color:black;">
                                    {{ csrf_field() }}
                                        @csrf
                                        @method('PUT')
                                                                <div class="form-group">
                                                                        <input id="id_retrait" type="hidden" name="id">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for=""><i style="color:#0069D9;" class="fas fa-lg fa-user-tag mr-2 ml-3"></i> Enléveur</label>
                                                                        <select id='coursier' name="coursier_id" class="form-control border-primary">
                                                                            <option value="">Selectionner Un Enléveur </option> 
                                                                            @foreach($persons as $personne)
                                                                            <option value="{{ $personne->id }}">{{ $personne->fullname }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <p style="text-align:center;">OU</p>
                                                                <div class="card" style="padding: 20px;">
                                                                    <div class="form-group">
                                                                            <label><i style="color:#0069D9;" class="fas fa-lg fa-user-tag mr-2"></i> Nom De L'Enléveur</label>
                                                                            <input type="text" class="form-control border-primary"
                                                                            id="fullname_retrait" name="fullname"
                                                                            >
                                                                    </div>
                                                                    <div class="form-group">
                                                                            <label><i style="color:#0069D9;" class="fas fa-lg fa-phone mr-2"></i>Téléphone De L'Enléveur</label>
                                                                            <input type="tel" class="form-control border-primary"
                                                                            id="telephone_retrait" name="telephone"
                                                                            >
                                                                    </div>
                                                                </div>
                                                                <p style="text-align:center;">OU</p>
                                                                <hr>
                                                                <div class="row ml-3">
                                                                    <div class="form-group mr-4">
                                                                            <label><i style="color:#0069D9;" class="fas fa-lg fa-id-card mr-2"></i>CNI De L'Enléveur</label>
                                                                            <input type="text" class="form-control border-primary"
                                                                            id="cni" name="cni"
                                                                            >
                                                                    </div>
                                                                    <div class="form-group">
                                                                            <label><i style="color:#0069D9;" class="fas fa-lg fa-clock mr-2"></i>Date Validité CNI</label>
                                                                            <input type="date" class="form-control border-primary"
                                                                            id="date_validite_cni" name="date_validite_cni"
                                                                            >
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                            <label><i style="color:#0069D9;" class="fas fa-lg fa-city mr-2 ml-3"></i>Transitoire</label>
                                                                            <select class="form-control border-primary" name="Transitoire" id="Transitoire">
                                                                                <option value="">Selectionner Un Transitoire</option>
                                                                                @foreach($transitoires as $transitoire)
                                                                                <option value="{{ $transitoire }}">{{ $transitoire }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="col-md-12">
                                                                    <button type="button" id="btnRetraitCourrier" data-personnes="{{ $persons }}" class="btn btn-primary col-md-6 mr-3">
                                                                    <i class="fas fa-lg fa-check m-0"></i>
                                                                    <i class="fas fa-sm fa-envelope" style="font-size:10px; margin-left:-2px;"></i>      
                                                                    <i class="fas fa-sm fa-upload mr-3" style="font-size:7px; margin-left:-3px;"></i>
                                                                    Retirer Courrier</button>
                                                                    <button type="button" id="btnClose_retrait" class="btn btn-danger col-md-5">
                                                                        <span class="icon text-white-80 mr-2">
                                                                                <i class="fas fa-sm fa-times"></i>
                                                                                <i class="fas fa-lg fa-trash"></i>
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

                    <!-- Modal Confirmation Save Courrier -->
                    <div class="modal fade" id="modalconfirm_courrier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-signature mr-2"></i>
                                                                                                                    <span style="color:black;">
                                                                                                                    Type Courrier</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                    <span style="color: black; font-size: 15px;" id="type_conf"></span>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-signature mr-2"></i>
                                                                                                                    <span style="color:black;">
                                                                                                                    Type Envoie</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="envoie_conf"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-user mr-2"></i>
                                                                                                                    <span style="color:black;">
                                                                                                                    Destinateur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="dest_conf"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-phone-volume mr-2"></i>
                                                                                                                    <span style="color:black;">
                                                                                                                    Téléphone Destinateur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="tel_dest_conf"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-user mr-2"></i>
                                                                                                                    <span style="color:black;">
                                                                                                                    Expéditeur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="exp_conf"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-phone-volume mr-2"></i>
                                                                                                                    <span style="color:black;">
                                                                                                                    Téléphone Expéditeur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="tel_exp_conf"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-user mr-2"></i>
                                                                                                                    <span style="color:black;">
                                                                                                                    Recepteur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="recept_conf"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-phone-volume mr-2"></i>
                                                                                                                    <span style="color:black;">
                                                                                                                    Téléphone Recepteur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="tel_recept_conf"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-bullseye mr-2"></i>
                                                                                                                    <span style="color:black;">
                                                                                                                    Objet</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <textarea  style="background-color:white; border-style: none; font-weight:bolder; color: black;" disabled id="object_courrier_conf" cols="10" rows="3"></textarea>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-building mr-2"></i>
                                                                                                                    <span style="color:black;">
                                                                                                                    Site Expéditeur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="site_exp_conf"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-building mr-2"></i>
                                                                                                                    <span style="color:black;">
                                                                                                                    Site Récepteur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="site_recept_conf"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-road"></i>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-sm fa-car mr-1"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Itineraire</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="itineraire_ka"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            <tbody>
                                                                        </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="conf_save_courrier" data-personnes="{{ $persons }}" class="btn btn-primary">OUI</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                                                </div>
                                            </div>
                                        </div>
                    </div>

                    <!-- Modal Confirmation Edit Courrier -->
                    <div class="modal fade" id="modalconfirm_edit_courrier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-signature mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Type Courrier</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                    <span style="color: black; font-size: 15px;" id="type_conf_edit"></span>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-signature mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Type Envoie</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="envoie_conf_edit"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-user mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Destinateur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="dest_conf_edit"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-phone-volume mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Téléphone Destinateur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="tel_dest_conf_edit"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-user mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Expéditeur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="exp_conf_edit"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-phone-volume mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Téléphone Expéditeur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="tel_exp_conf_edit"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-user mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Recepteur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="recept_conf_edit"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-phone-volume mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Téléphone Recepteur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="tel_recept_conf_edit"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-bullseye mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Objet</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="object_courrier_conf_edit"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-building mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Site Expéditeur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="site_exp_conf_edit"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-building mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Site Récepteur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="site_recept_conf_edit"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-user mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Chauffeur Courrier</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="chauffeur_courrier"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-truck mr-2"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Véhicule Chauffeur</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="chauffeur_vehicule"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-lg fa-road"></i>
                                                                                                                    <i style="color:#36B9CC;" class="fas fa-sm fa-car mr-1"></i>
                                                                                                                    <span style="font-size:1.1em; color:black;">
                                                                                                                    Itineraire</span>
                                                                                                                    </td>
                                                                                                                    <td>
                                                                                                                        <div class="form-group">
                                                                                                                            <span style="color: black; font-size: 15px;" id="itineraire_c"></span>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            <tbody>
                                                                        </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="conf_edit_courrier" class="btn btn-primary">OUI</button>
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
                                          <textarea id="validation" disabled style="width:100%;border-style:none;height:300px;background-color:white;resize: none; color:black; font-size:19px;" class="form-control"></textarea>
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