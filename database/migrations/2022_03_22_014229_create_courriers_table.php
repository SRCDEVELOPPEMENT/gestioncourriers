<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateCourriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courriers', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('code')->unique();

            $table->enum('TypeCourrier', ['Document', 'Colis']);

            $table->enum('TypeEnvoie', ['INTERNE', 'EXTERNE']);

            $table->string('objet', 4000);

            $table->string('cni')->nullable();

            $table->string('date_validite_cni')->nullable();

            $table->unsignedBigInteger('itineraire')->nullable();
            $table->foreign('itineraire')->references('id')->on('itineraires')->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->unsignedBigInteger('chauffeur_id')->nullable();
            $table->foreign('chauffeur_id')->references('id')->on('personnes')->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->unsignedBigInteger('coursier_id')->nullable();
            $table->foreign('coursier_id')->references('id')->on('personnes')->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->unsignedBigInteger('destinateur_id')->nullable();
            $table->foreign('destinateur_id')->references('id')->on('personnes')->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->unsignedBigInteger('emetteur_id');
            $table->foreign('emetteur_id')->references('id')->on('personnes')->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->bigInteger('recepteur_id')->nullable();
            $table->foreign('recepteur_id')->references('id')->on('personnes')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            
            $table->bigInteger('recepteur_effectif_id')->nullable();
            $table->foreign('recepteur_effectif_id')->references('id')->on('personnes')->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->unsignedBigInteger('site_exp_id')->nullable();
            $table->foreign('site_exp_id')->references('id')->on('sites')->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->unsignedBigInteger('site_recept_id')->nullable();
            $table->foreign('site_recept_id')->references('id')->on('sites')->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->unsignedBigInteger('user_create_id');
            $table->foreign('user_create_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->unsignedBigInteger('user_recept_id')->nullable();
            $table->foreign('user_recept_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->string('DateRetraitCourrier')->nullable();

            $table->string('DateReceptCourrier')->nullable();

            $table->string('DateLivraionCourrier')->nullable();

            $table->enum('status', ['ENCOURS', 'ENTRANSIT', 'RECEPTIONNER', 'LIVRER', 'ANNULER', 'ARCHIVER'])->default('ENCOURS');

            $table->unsignedBigInteger('statut_id')->nullable();
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('NO ACTION')->onUpdate('NO ACTION');

            $table->string('Transitoire')->nullable();
            $table->string('date_create');
            $table->string('created_at')->default(Carbon::now()->format('Y-m-d'));
            $table->string('updated_at')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courriers');
    }
}
