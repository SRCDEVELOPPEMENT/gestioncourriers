@extends('layouts.main')

@section('content')


        <!-- Begin Page Content -->
        <div class="container-fluid" style="font-family: 'Century Gothic';">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="row  float-left">
                            <h1 class="h3 mb-0" style="color:#290661;">
                            <i style="color:#290661" class="fas fa-chart-pie fa-lg mr-2"></i>  
                            Etat Statistique</h1>  
                        </div>
                        <div class="row float-right">
                        <i style="color:#290661" class="fas fa-chart-line fa-4x mr-2"></i>  
                        </div>
                        
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Générer Un Fichier</a> -->
                    </div>

                    <!-- Content Row -->
                    <!-- <div class="row"> -->

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="row">
                            <div class="col-xl-2 col-md-4 mb-2">
                                <div class="card border-left-primary shadow h-10">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Nombre Total De Courrier 
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nbre_courriers }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-envelope fa-2x text-primary"></i>
                                                <i class="fas fa-list fa-sm text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-2 col-md-4 mb-2">
                                <div class="card border-left-success shadow h-10">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Nombre De Courrier Interne</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nbre_courriers_interne }}</div>
                                            </div>
                                            <div class="col-auto">
                                            <i class="fas fa-envelope fa-2x text-success"></i>
                                                <i class="fas fa-arrow-left fa-1x text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-2 col-md-4 mb-2">
                                <div class="card border-left-success shadow h-10">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">NOMBRE DE COURRIER EXTERNE
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $nbre_courriers_externe }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-envelope fa-2x text-success"></i>
                                                <i class="fas fa-arrow-right fa-1x text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-2 col-md-4 mb-2">
                                <div class="card border-left-warning shadow h-10 py-1">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    NOMBRE DE COURRIER ENCOURS</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nbre_courriers_encours }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-envelope fa-2x text-warning"></i>
                                                <i class="fas fa-save fa-1x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-2 col-md-4 mb-2">
                                <div class="card border-left-warning shadow h-10 py-1">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    NOMBRE DE COURRIER EN TRANSIT</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nbre_courriers_entransit }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-envelope fa-2x text-warning"></i>
                                                <i class="fas fa-truck fa-1x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-2 col-md-4 mb-2">
                                <div class="card border-left-warning shadow h-10 py-1">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    NOMBRE DE COURRIER RECEPTIONNE</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nbre_courriers_receptionner }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-envelope fa-2x text-warning"></i>
                                                <i class="fas fa-download fa-1x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-2 col-md-4 mb-2">
                                <div class="card border-left-warning shadow h-10 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase">
                                                    NOMBRE DE COURRIER  LIVRE</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nbre_courriers_livrer }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-envelope fa-2x text-warning"></i>
                                                <i class="fas fa-upload fa-1x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-2 col-md-4 mb-2">
                                <div class="card border-left-warning border-radius-5 shadow h-10 py-1">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    NOMBRE DE COURRIER ANNULE</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nbre_courriers_annuler }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-envelope fa-2x text-warning"></i>
                                                <i class="fas fa-times fa-1x text-warning"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <span style="color:#E67E22; font-family: 'Century Gothic';">COURRIER EN RETARD</span><span style="font-weight:bolder;" class="text text-dark ml-3">{{ count($colis_en_retard) }}</span></br></br>
                            @if(count($colis_en_retard) == 0)
                                <span style="color:black; font-family: 'Century Gothic';">AUCUN COURRIER EN RETARD</span>
                            @endif
                        <div class="float-right">
                                    <div class="dropdown float-right">
                                            <button style="background-color:#E67E22; color:white;" class="btn dropdown-toggle" title="Sélectionner Une Année" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-calendar mr-2"></i>
                                                Année
                                            </button>
                                            <div class="dropdown-menu animated--fade-in"
                                                aria-labelledby="dropdownMenuButton">
                                                @foreach($years as $year)
                                                <a class="dropdown-item" href="{{ route('setColisEnRetard', ['year' => $year]) }}" name="region">{{ $year }}</a>
                                                @endforeach
                                            </div>
                                    </div>
                        </div>
                        </br></br>
                        <div class="row">
                            @foreach($colis_en_retard as $colis)
                                <div class="col-xl-2 col-md-4 mb-2">
                                    <div style="border: solid 2px; border-color:#E67E22;" class="card shadow h-10">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div style="color:#E67E22;" class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        Numéro Du Courrier 
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $colis->code }}</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i style="color:#E67E22;" class="fas fa-envelope-open-text fa-2x"></i>
                                                    <i style="color:#E67E22;" class="fas fa-clock fa-sm"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                            <hr>
                            <div class="float-right">
                                <select style="font-family: 'Century Gothic';" data-colis="{{ $courriers }}" data-sites="{{ $sites }}" data-regions="{{ $regions }}" class="form-control border-danger" name="year_colis" id="year_colis">
                                    <option value="">Année</option>    
                                    @foreach($years as $annee)
                                    <option value="{{ $annee }}">{{ $annee }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </br></br>
                          <div class="row">
                              @foreach($regions as $key => $region)
                                <div class="col-xl-2 col-md-4 mb-2">
                                        <div class="card border-left-danger shadow h-10">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            {{ $region->intituleRegion }}
                                                        </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="rege{{ $key }}">0</span></div>
                                                    </div>
                                                    <div class="col mr-1">
                                                        <i class="fas fa-envelope-open fa-2x text-danger"></i>
                                                        <i class="fab fa-twitter fa-1x text-danger"></i>
                                                    </div>
                                                    <div class="col">
                                                        <table class="table-bordered">
                                                            <tbody style="font-size:10px; color:black;">
                                                                <tr>
                                                                    <td>ENCOURS</td><td><span style="padding:3px;" id="staten{{ $key }}">0</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>ENTRANSIT</td><td><span style="padding:3px;" id="statentr{{ $key }}">0</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>RECEPTIONNE</td><td><span style="padding:3px;" id="statrecept{{ $key }}">0</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>LIVRE</td><td><span style="padding:3px;" id="statlivr{{ $key }}">0</span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                              @endforeach
                          </div>
                            <hr>
                            <div class="float-right">
                                <select style="border-color:#6610F2; font-family: 'Century Gothic';" data-colis="{{ $courriers }}" data-sites="{{ $sites }}" data-regions="{{ $regions }}" class="form-control" name="colis_par_region_par_mois" id="colis_par_region_par_mois">
                                    <option value="">Année</option>
                                    @foreach($years as $annee)
                                    <option value="{{ $annee }}">{{ $annee }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </br></br>
                            <div class="row">
                                @foreach($regions as $key => $region)
                                <div class="col-xl-2 col-md-4 mb-2">
                                    <div style="border: solid 2px; border-color:#6610F2;" class="card shadow h-10">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div style="color:#6610F2;" class="col-sm-3">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        {{ $region->intituleRegion }} 
                                                    </div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-900"><span id="qt{{ $key }}">0</span></div>
                                                </div>
                                                <div class="col-sm-1 mr-1">
                                                    <i style="color:#6610F2;" class="fas fa-calendar-day fa-sm"></i>
                                                </div>
                                                <div class="col-sm-2">
                                                    <table class="table-bordered">
                                                        <tbody style="font-size:10px; color:black;">
                                                            <tr>
                                                                <td>JANVIER</td><td><span style="padding:3px;" id="ja{{ $key }}">0</span></td><td>FEVRIER</td><td><span style="padding:3px;" id="fevr{{ $key }}">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>MARS</td><td><span style="padding:3px;" id="ma{{ $key }}">0</span></td><td>AVRIL</td><td><span style="padding:3px;" id="avri{{ $key }}">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>MAI</td><td><span style="padding:3px;" id="mais{{ $key }}">0</span></td><td>JUIN</td><td><span style="padding:3px;" id="jouin{{ $key }}">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>JUILLET</td><td><span style="padding:3px;" id="juille{{ $key }}">0</span></td><td>AOUT</td><td><span style="padding:3px;" id="aoute{{ $key }}">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SEPTEMBRE</td><td><span style="padding:3px;" id="septe{{ $key }}">0</span></td><td>OCTOBRE</td><td><span style="padding:3px;" id="octo{{ $key }}">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>NOVEMBRE</td><td><span style="padding:3px;" id="nove{{ $key }}">0</span></td><td>DECCEMBRE</td><td><span style="padding:3px;" id="decce{{ $key }}">0</span></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="float-right">
                                <select style="border-color:#984C0C; font-family: 'Century Gothic';" data-colis="{{ $courriers }}" data-sites="{{ $sites }}" data-regions="{{ $regions }}" class="form-control" name="colis_par_site_par_mois" id="colis_par_site_par_mois">
                                    <option value="">Année</option>
                                    @foreach($years as $annee)
                                    <option value="{{ $annee }}">{{ $annee }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </br></br>
                        <div class="row">
                            @foreach($sites as $key => $site)
                            <div class="col-xl-2 col-md-4 mb-2">
                                <div style="border: solid 2px; border-color:#984C0C;" class="card shadow h-10">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-sm-3">
                                                <div style="color:#984C0C;" class="text-xs font-weight-bold text-uppercase mb-1">
                                                    {{ $site->intituleSite }}
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="a{{ $key }}">0</span></div>
                                            </div>
                                            <div  style="color:#984C0C;" class="col-sm-1 mr-1">
                                                <i class="fas fa-envelope fa-sm"></i>
                                            </div>
                                            <div class="col-sm-2">
                                                    <table class="table-bordered">
                                                        <tbody style="font-size:10px; color:black;">
                                                            <tr>
                                                                <td>JANVIER</td><td><span style="padding:3px;" id="j_sit{{ $key }}">0</span></td><td>FEVRIER</td><td><span style="padding:3px;" id="fev_sit{{ $key }}">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>MARS</td><td><span style="padding:3px;" id="m_sit{{ $key }}">0</span></td><td>AVRIL</td><td><span style="padding:3px;" id="avril_sit{{ $key }}">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>MAI</td><td><span style="padding:3px;" id="mai_sit{{ $key }}">0</span></td><td>JUIN</td><td><span style="padding:3px;" id="juin_sit{{ $key }}">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>JUILLET</td><td><span style="padding:3px;" id="juill_sit{{ $key }}">0</span></td><td>AOUT</td><td><span style="padding:3px;" id="aout_sit{{ $key }}">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>SEPTEMBRE</td><td><span style="padding:3px;" id="sept_sit{{ $key }}">0</span></td><td>OCTOBRE</td><td><span style="padding:3px;" id="oct_sit{{ $key }}">0</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>NOVEMBRE</td><td><span style="padding:3px;" id="nov_sit{{ $key }}">0</span></td><td>DECCEMBRE</td><td><span style="padding:3px;" id="decc_sit{{ $key }}">0</span></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                            <hr>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="" class="text-info">REGION</label>
                                <select id='region' name="region" data-sites="{{ $sites }}" data-regions="{{ $regions }}" data-courriers="{{ $courriers }}" class="form-control border-info">
                                    <option value="">Selectionner Une Région</option> 
                                        @foreach($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->intituleRegion }}</option> 
                                        @endforeach
                                </select>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-md-9 mb-2">
                                <div class="card border-left-info shadow h-10 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-lg font-weight-bold text-info text-uppercase mb-1">NOMBRE DE COURRIER REGION <span style="color:gray;" id="name_region"></span>
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><span id="value_region"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-globe fa-2x text-info"></i>
                                                <i class="fas fa-envelope fa-1x text-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="" class="text-secondary">Site</label>
                                <select id='site' name="site" data-users="{{ $users }}" data-sites="{{ $sites }}" data-regions="{{ $regions }}" data-courriers="{{ $courriers }}" class="form-control border-secondary">
                                    <option value="">Selectionner Une Site</option> 
                                        @foreach($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->intituleSite }}</option> 
                                        @endforeach
                                </select>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-md-9 mb-2">
                                <div class="card border-left-secondary shadow h-10 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-lg font-weight-bold text-secondary text-uppercase mb-1">NOMBRE DE COURRIER SITE <span style="color:blue;" id="name_site"></span>
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><span id="value_site"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-city fa-2x text-secondary"></i>
                                                <i class="fas fa-envelope fa-1x text-secondary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label style="margin-top:10px;" class="text-dark" for="">Mois</label>
                                <input data-courriers="{{ $courriers }}" type="month" name=""  class="form-control border-dark" id="courrier_mois">
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-md-9 mb-2">
                                <div class="card border-left-dark shadow h-10 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-lg font-weight-bold text-dark text-uppercase mb-1">NOMBRE DE COURRIER MOIS <span style="color:blue;" id="name_mois"></span>
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-dark-800"><span id="value_mois"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar-day fa-2x text-dark"></i>
                                                <i class="fas fa-envelope fa-1x text-dark"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                    <hr>
                    <!-- Content Row -->
                    <div style="font-family: 'Century Gothic';" class="float-right">
                                    <div class="dropdown float-right">
                                            <button class="btn btn-dark dropdown-toggle" title="Sélectionner Une Année" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-calendar mr-2"></i>
                                                Année
                                            </button>
                                            <div class="dropdown-menu animated--fade-in"
                                                aria-labelledby="dropdownMenuButton">
                                                @foreach($years as $year)
                                                <a class="dropdown-item" id="region_selected" href="{{ route('setGraphColisParRegion', ['year' => $year]) }}" name="region">{{ $year }}</a>
                                                @endforeach
                                            </div>
                                    </div>
                    </div></br></br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">COURRIER PAR REGION</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div style="font-family: 'Century Gothic';" class="float-right">
                                    <div class="dropdown float-right">
                                            <button class="btn btn-primary dropdown-toggle" title="Sélectionner Une Année" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-calendar mr-2"></i>
                                                Année
                                            </button>
                                            <div class="dropdown-menu animated--fade-in"
                                                aria-labelledby="dropdownMenuButton">
                                                @foreach($years as $year)
                                                <a class="dropdown-item" id="region_selected" href="{{ route('setGraphColisParMois', ['year' => $year]) }}" name="region">{{ $year }}</a>
                                                @endforeach
                                            </div>
                                    </div>
                    </div>
                    </br></br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">COURRIER PAR MOIS</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart_mois"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">COURRIERS</h6>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="small font-weight-bold">Courriers Enrégistrer/EnCours <span
                                                class="float-right">{{ $percent_encours }}%</span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $percent_encours }}%"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Courriers EnTransit <span
                                                class="float-right">{{ $percent_entransit }}%</span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percent_entransit }}%"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Courriers Receptionner <span
                                                class="float-right">{{ $percent_receptionner }}%</span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $percent_receptionner }}%"
                                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Courriers Livrer <span
                                                class="float-right">{{ $percent_livrer }}%</span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $percent_livrer }}%"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Courrier Annuler <span
                                                class="float-right">{{ $percent_annuler }}%</span></h4>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percent_annuler }}%"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

        </div>
        <!-- /.container-fluid -->
    <script src="{{ url('dashboard.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('jquery/jquery.min.js') }}"></script>
    <script src="{{ url('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ url('chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ url('js/demo/chart-pie-demo.js') }}"></script>

    <script>
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
            }

            var ctx = document.getElementById("myAreaChart_mois");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                labels: ["JANVIER", "FEVRIER", "MARS", "AVRIL", "MAI", "JUIN", "JUILLET", "AOUT", "SEPTEMBRE", "OCTOBRE", "NOVEMBRE", "DECCEMBRE"],
                datasets: [{
                    label: "Earnings",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [ {{ $Qte_janvier }}, {{$Qte_fevrier}}, {{$Qte_mars}}, {{$Qte_avril}} , {{ $Qte_mai }} ,  {{$Qte_juin}} , {{$Qte_juillet}}, {{$Qte_aout}}, {{$Qte_septembre}}, {{$Qte_octobre}}, {{$Qte_novembre}}, {{$Qte_deccembre}} ],
                }],
                },
                options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                    }],
                    yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        //return '$' + number_format(value);
                        callback: function(value, index, values) {
                        return number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        //return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                        return number_format(tooltipItem.yLabel);
                    }
                    }
                }
                }
            });
    </script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
        }



        // Area Chart Example

        let allRegions = Array();

        let reg = {!! json_encode($regions); !!}
        reg.forEach(region => {
            allRegions.push(region.intituleRegion);
        });
        
        let allQte = Array();

        let Qte = {!! json_encode($Qte_total); !!}
        Qte.forEach(elt => {
            allQte.push(elt);
        });

        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: allRegions,
            datasets: [{
            label: "Earnings",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: allQte,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                display: false,
                drawBorder: false
                },
                ticks: {
                maxTicksLimit: 10
                }
            }],
            yAxes: [{
                ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                //return '$' + number_format(value);
                callback: function(value, index, values) {
                    return number_format(value);
                }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
            display: false
            },
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                //return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                return number_format(tooltipItem.yLabel);
                }
            }
            }
        }
        });
    </script>

@endsection