    $(document).on("change", '#region', function(){
        let colis = [];
        let courriers = JSON.parse($(this).attr('data-courriers'));
        let sites = JSON.parse($(this).attr('data-sites'));
        let regions = JSON.parse($(this).attr('data-regions'));
        
        if($(this).val()){

            courriers.forEach(courrier => {
                let site_courant = sites.find(site => parseInt(site.id) == parseInt(courrier.users.site_id));
                if(site_courant){
                    if(parseInt($(this).val()) == parseInt(site_courant.region_id)){
                        colis.push(courrier);
                    }
                }
            });
            var region = regions.find(region => parseInt(region.id) == parseInt($(this).val()));
            $('#name_region').replaceWith(`<span style="color:blue;" id="name_region">${region.intituleRegion}</span>`);
            $('#value_region').replaceWith(`<span id="value_region">${colis.length}</span>`);
        }
    });

    $(document).on('change', '#site', function(){
        let colis = [];
        let courriers = JSON.parse($(this).attr('data-courriers'));
        let sites = JSON.parse($(this).attr('data-sites'));

        if($(this).val()){
            select_site = sites.find(site => parseInt(site.id) == parseInt($(this).val()));
            courriers.forEach(courrier => {
                if(parseInt(courrier.site_exp_id) == parseInt($(this).val())){
                    colis.push(courrier);
                }
            });

            $('#name_site').replaceWith(`<span style="color:blue;" id="name_site">${select_site.intituleSite}</span>`);
            $('#value_site').replaceWith(`<span id="value_site">${colis.length}</span>`);
        }
    });

    $(document).on('input', '#courrier_mois', function(){
        if($(this).val()){

            let colis = [];
            let courriers = JSON.parse($(this).attr('data-courriers'));

            if(courriers.length > 0){
                courriers.forEach(courrier => {
                    let annee_mois_colis_courant = parseInt(courrier.date_create.slice(0,7).replace("-", ""));
                    let annee_mois_selectionner = parseInt($(this).val().slice(0,7).replace("-", ""));
                    if(annee_mois_colis_courant == annee_mois_selectionner){
                        colis.push(courrier);
                    }
                });
            }
            switch (parseInt($(this).val().slice(5,7))) {
                case 1:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">JANVIER</span>`);
                    break;
                case 2:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">FEVRIER</span>`);
                    break;
                case 3:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">MARS</span>`);
                    break;
                case 4:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">AVRIL</span>`);
                    break;
                case 5:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">MAI</span>`);
                    break;
                case 6:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">JUIN</span>`);
                    break;
                case 7:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">JUILLET</span>`);
                    break;
                case 8:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">AOUT</span>`);
                    break;
                case 9:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">SEPTEMBRE</span>`);
                    break;
                case 10:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">OCTOBRE</span>`);
                    break;
                case 11:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">NOVEMBRE</span>`);
                    break;
                case 12:
                    $('#name_mois').replaceWith(`<span style="color:blue;" id="name_mois">DECCEMBRE</span>`);
                    break;
                default:
                    break;
            }
            $('#value_mois').replaceWith(`<span id="value_mois">${colis.length}</span>`)
        }
    });

    $(document).on('click', '#year_colis', function(){
        if($(this).val()){
            let newCourDate = [];
            let courriers = JSON.parse($(this).attr('data-colis'));
            let sites = JSON.parse($(this).attr('data-sites'));
            let regions = JSON.parse($(this).attr('data-regions'));

            courriers.forEach(courrier => {
                if(parseInt($(this).val()) == parseInt(courrier.date_create.slice(0,4))){
                    newCourDate.push(courrier);
                }
            });

            let Qte_total = [];

            for (let i = 0; i < regions.length; i++) {
                const region = regions[i];
                
                let Qte_region_courant = 0;
                let tab_colis = [];
                for (let j = 0; j < newCourDate.length; j++) {
                    const courrier = newCourDate[j];
                    
                    let site = sites.find(site => parseInt(site.id) == parseInt(courrier.users.site_id));
                    if(parseInt(region.id) == parseInt(site.region_id)){
                        Qte_region_courant +=1;
                        tab_colis.push(courrier);
                    }
                }
                Qte_total.push(Qte_region_courant);
                
                let Qte_encours = 0;
                let Qte_entransit = 0;
                let Qte_receptionner = 0;
                let Qte_livrer = 0;

                for (let index = 0; index < tab_colis.length; index++) {
                    const courrier = tab_colis[index];
                    switch (courrier.status) {
                        case "ENCOURS":
                            Qte_encours +=1;
                            break;
                        case "ENTRANSIT":
                            Qte_entransit +=1;
                            break;
                        case "RECEPTIONNER":
                            Qte_receptionner +=1;
                            break;
                        case "LIVRER":
                            Qte_livrer +=1;
                            break;
                        default:
                            break;
                    }
                }

                $('#staten'+i+'').replaceWith(`<span style="padding:3px;" id="staten${i}">${Qte_encours}</span>`);
                $('#statentr'+i+'').replaceWith(`<span style="padding:3px;" id="statentr${i}">${Qte_entransit}</span>`);
                $('#statrecept'+i+'').replaceWith(`<span style="padding:3px;" id="statrecept${i}">${Qte_receptionner}</span>`);
                $('#statlivr'+i+'').replaceWith(`<span style="padding:3px;" id="statlivr${i}">${Qte_livrer}</span>`);
                
                for (let index = 0; index < Qte_total.length; index++) {
                    const Qte = Qte_total[index];
                    $('#rege'+index+'').replaceWith(`<span id='rege${index}'>${Qte}</span>`);
                }    
            }
        }
    });

    $(document).on('click', '#colis_par_region_par_mois', function(){
        if($(this).val()){
            let newtabcolis = [];
            let courriers = JSON.parse($(this).attr('data-colis'));
            let sites = JSON.parse($(this).attr('data-sites'));
            let regions = JSON.parse($(this).attr('data-regions'));

            courriers.forEach(courrier => {
                if(parseInt($(this).val()) == parseInt(courrier.date_create.slice(0,4))){
                    newtabcolis.push(courrier);
                }
            });

            let Qte_total = [];
            for (let i = 0; i < regions.length; i++) {
                const region = regions[i];
                
                let Qte_region_courant = 0;
                let tab_colis = [];
                for (let j = 0; j < newtabcolis.length; j++) {
                    const courrier = newtabcolis[j];
                    
                    let site = sites.find(site => parseInt(site.id) == parseInt(courrier.users.site_id));
                    if(parseInt(region.id) == parseInt(site.region_id)){
                        Qte_region_courant +=1;
                        tab_colis.push(courrier);
                    }
                }
                Qte_total.push(Qte_region_courant);
                
                let Qte_janv = 0;
                let Qte_fev = 0;
                let Qte_mars = 0;
                let Qte_avril = 0;
                let Qte_mai = 0;
                let Qte_juin = 0;
                let Qte_juillet = 0;
                let Qte_aout = 0;
                let Qte_sept = 0;
                let Qte_oct = 0;
                let Qte_nov = 0;
                let Qte_decc = 0;

                for (let index = 0; index < tab_colis.length; index++) {
                    const courrier = tab_colis[index];
                    switch (parseInt(courrier.date_create.slice(5,7))) {
                        case 1:
                            Qte_janv +=1;
                            break;
                        case 2:
                            Qte_fev +=1;
                            break;
                        case 3:
                            Qte_mars +=1;
                            break;
                        case 4:
                            Qte_avril +=1;
                            break;
                        case 5:
                            Qte_mai +=1;
                            break;
                        case 6:
                            Qte_juin +=1;
                            break;
                        case 7:
                            Qte_juillet +=1;
                            break;
                        case 8:
                            Qte_aout +=1;
                            break;
                        case 9:
                            Qte_sept +=1;
                            break;
                        case 10:
                            Qte_oct +=1;
                            break;
                        case 11:
                            Qte_nov +=1;
                            break;
                        case 12:
                            Qte_decc +=1;
                            break;
                        default:
                            break;
                    }
                }

                $('#ja'+i+'').replaceWith(`<span style="padding:3px;" id="ja${i}">${Qte_janv}</span>`);
                $('#fevr'+i+'').replaceWith(`<span style="padding:3px;" id="fevr${i}">${Qte_fev}</span>`);
                $('#ma'+i+'').replaceWith(`<span style="padding:3px;" id="ma${i}">${Qte_mars}</span>`);
                $('#avri'+i+'').replaceWith(`<span style="padding:3px;" id="avri${i}">${Qte_avril}</span>`);
                $('#mais'+i+'').replaceWith(`<span style="padding:3px;" id="mais${i}">${Qte_mai}</span>`);
                $('#jouin'+i+'').replaceWith(`<span style="padding:3px;" id="jouin${i}">${Qte_juin}</span>`);
                $('#juille'+i+'').replaceWith(`<span style="padding:3px;" id="juille${i}">${Qte_juillet}</span>`);
                $('#aoute'+i+'').replaceWith(`<span style="padding:3px;" id="aoute${i}">${Qte_aout}</span>`);
                $('#septe'+i+'').replaceWith(`<span style="padding:3px;" id="septe${i}">${Qte_sept}</span>`);
                $('#octo'+i+'').replaceWith(`<span style="padding:3px;" id="octo${i}">${Qte_oct}</span>`);
                $('#nove'+i+'').replaceWith(`<span style="padding:3px;" id="nove${i}">${Qte_nov}</span>`);
                $('#decce'+i+'').replaceWith(`<span style="padding:3px;" id="decce${i}">${Qte_decc}</span>`);

                for (let index = 0; index < Qte_total.length; index++) {
                    const Qte = Qte_total[index];
                    $('#qt'+index+'').replaceWith(`<span id='qt${index}'>${Qte}</span>`);
                }    
            }

        }
    });

    $(document).on('change', '#colis_par_site_par_mois', function(){
        if($(this).val()){
            let newtab = Array();
            let courriers = JSON.parse($(this).attr('data-colis'));
            let sites = JSON.parse($(this).attr('data-sites'));

            courriers.forEach(courrier => {
                if(parseInt($(this).val()) == parseInt(courrier.date_create.slice(0,4))){
                    newtab.push(courrier);
                }
            });

            let Qte_total = [];
            for (let i = 0; i < sites.length; i++) {
                const site = sites[i];
                
                Qte_Par_Site = 0;
                let tab_colis = [];
                for (let j = 0; j < newtab.length; j++) {
                    const courrier = newtab[j];
                    
                    if(parseInt(site.id) == parseInt(courrier.site_exp_id)){
                        Qte_Par_Site +=1;
                        tab_colis.push(courrier);
                    }
                }

                Qte_total.push(Qte_Par_Site);

                let Qte_janv = 0;
                let Qte_fev = 0;
                let Qte_mars = 0;
                let Qte_avril = 0;
                let Qte_mai = 0;
                let Qte_juin = 0;
                let Qte_juillet = 0;
                let Qte_aout = 0;
                let Qte_sept = 0;
                let Qte_oct = 0;
                let Qte_nov = 0;
                let Qte_decc = 0;

                for (let index = 0; index < tab_colis.length; index++) {
                    const courrier = tab_colis[index];
                    switch (parseInt(courrier.date_create.slice(5,7))) {
                        case 1:
                            Qte_janv +=1;
                            break;
                        case 2:
                            Qte_fev +=1;
                            break;
                        case 3:
                            Qte_mars +=1;
                            break;
                        case 4:
                            Qte_avril +=1;
                            break;
                        case 5:
                            Qte_mai +=1;
                            break;
                        case 6:
                            Qte_juin +=1;
                            break;
                        case 7:
                            Qte_juillet +=1;
                            break;
                        case 8:
                            Qte_aout +=1;
                            break;
                        case 9:
                            Qte_sept +=1;
                            break;
                        case 10:
                            Qte_oct +=1;
                            break;
                        case 11:
                            Qte_nov +=1;
                            break;
                        case 12:
                            Qte_decc +=1;
                            break;
                        default:
                            break;
                    }
                }

                $('#j_sit'+i+'').replaceWith(`<span style="padding:3px;" id="j_sit${i}">${Qte_janv}</span>`);
                $('#fev_sit'+i+'').replaceWith(`<span style="padding:3px;" id="fev_sit${i}">${Qte_fev}</span>`);
                $('#m_sit'+i+'').replaceWith(`<span style="padding:3px;" id="m_sit${i}">${Qte_mars}</span>`);
                $('#avril_sit'+i+'').replaceWith(`<span style="padding:3px;" id="avril_sit${i}">${Qte_avril}</span>`);
                $('#mai_sit'+i+'').replaceWith(`<span style="padding:3px;" id="mai_sit${i}">${Qte_mai}</span>`);
                $('#juin_sit'+i+'').replaceWith(`<span style="padding:3px;" id="juin_sit${i}">${Qte_juin}</span>`);
                $('#juill_sit'+i+'').replaceWith(`<span style="padding:3px;" id="juill_sit${i}">${Qte_juillet}</span>`);
                $('#aout_sit'+i+'').replaceWith(`<span style="padding:3px;" id="aout_sit${i}">${Qte_aout}</span>`);
                $('#sept_sit'+i+'').replaceWith(`<span style="padding:3px;" id="sept_sit${i}">${Qte_sept}</span>`);
                $('#oct_sit'+i+'').replaceWith(`<span style="padding:3px;" id="oct_sit${i}">${Qte_oct}</span>`);
                $('#nov_sit'+i+'').replaceWith(`<span style="padding:3px;" id="nov_sit${i}">${Qte_nov}</span>`);
                $('#decc_sit'+i+'').replaceWith(`<span style="padding:3px;" id="decc_sit${i}">${Qte_decc}</span>`);

            }

            for (let index = 0; index < Qte_total.length; index++) {
                const Qte = Qte_total[index];
                $('#a'+index+'').replaceWith(`<span id='a${index}'>${Qte}</span>`);
            }
        }
    });