$( document ).ready(function() {

    var page = 1;

    var current_page = 1;

    var total_page = 0;

    var is_ajax_fire = 0;
    if ($("body").find("table[id='fiches']")){
        listFiche();
    }

    /* manage data list */
    function listFiche() {
        $.ajax({
            dataType: 'json',
            url: url+'fiches/indexAjax'
        }).done(function(data){
            fichesRow(data.data.fiches);
        });
    }

    $("body").on("keyup","#search",function(){
        var search = $(this).val();
        $.ajax({
            dataType: 'json',
            method:'POST',
            url: url+'fiches/search',
            data:{search:search}
        }).done(function(data){
            console.log(data.fiches);
            fichesRow(data.fiches);
        });
        console.log(search);
    });
    function fichesRow(data) {

        var	rows = '';
        if (data.length == 0){
            rows = rows + '<tr align="right"><td style="border: none"></td><td style="border: none"><label>Aucune donne</label></td><td style="border: none"></td><td style="border: none"></td></tr>';
        }else {
            $.each( data, function( key, value ) {
console.log(value);
                rows = rows + '<tr>';
                rows = rows + '<td>'+value.id+'</td>';
                rows = rows + '<td>'+value.nom_fiche+'</td>';
                rows = rows + '<td><input type="hidden" name="id_categorie" id="id_categorie" value="'+value.id_categorie+'"><input type="hidden" name="id_desc" id="id_desc" value="'+value.id_desc+'">'+value.description+'</td>';
                rows = rows + '<td data-id="'+value.id+'">';
                rows = rows + '<button data-toggle="modal" data-target="#edit-fiche-modal" class="btn btn-primary edit-fiche-form">Modifier</button> ';
                rows = rows + '<button class="btn btn-danger remove-item" data-toggle="modal" data-target="#confirmModal'+value.id+'">Supprimer</button>';
                rows = rows + '</td>';
                rows = rows + '</tr>';

            });
        }

        $("table#fiches tbody").html(rows);

    }
    /* Create new Item */

    $(".crud-submit").click(function(e){

        e.preventDefault();
        var form_action = $("#add-fiche-form").find("form").attr("action");
        var nom_fiche = $("#add-fiche-form").find("input[name='nom_fiche']").val();
        var description = $("#add-fiche-form").find("textarea[name='description']").val();
        var id_categorie = $("#add-fiche-form").find("select[name='id_categorie']").val();
        if(nom_fiche != '' && description != ''  && id_categorie != ''){
            $.ajax({
                dataType: 'json',
                type:'POST',
                url: url + form_action,
                data:{nom_fiche:nom_fiche, description:description, id_categorie:id_categorie}
            }).done(function(data){
                $("#add-fiche-form").find("input[name='nom_fiche']").val();
                $("#add-fiche-form").find("textarea[name='description']").val();
                $("#add-fiche-form").find("select[name='id_categorie']").val();
                $("#add-fiche-form").toggle();
                $("#add-fiche-form").close();
            });
            $("#add-fiche-form").toggle();
            $("#add-fiche-form").hide();
            $("#add-fiche-form").close();
            listFiche();
        }else{

            alert('Completez le nom fiche et/ou description.')

        }



    });
    //Remove
    $("body").on("click",".remove-item",function(){
        var id = $(this).parent("td").data('id');

        var c_obj = $(this).parents("tr");
        if(confirm(['Vous avez supprimé le '+id,"OK"])){
            $.ajax({

                dataType: 'json',

                type:'POST',

                url: url + 'fiches/remove/'+id,

                data:{id:id}

            }).done(function(data){

                c_obj.remove();

                // toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});


            });
        }
        listFiche();

    });
    //Edit
    $("body").on("click",".edit-fiche-form",function(){

        var id = $(this).parent("td").data('id');
        var nom_fiche = $(this).parent("td").prev("td").prev("td").text();
        var description = $(this).parent("td").prev("td").text();
        var id_categorie = $(this).parent("td").prev("td").find("input[name='id_categorie']").val();
        var id_desc = $(this).parent("td").prev("td").find("input[name='id_desc']").val();
        var option = '';
        console.log(id_desc);
        console.log(id+'====='+nom_fiche+'====='+description+'====='+id_categorie+'=====');
        $("#edit-fiche-modal").find("input[name='id']").val(id);
        $("#edit-fiche-modal").find("input[name='nom_fiche']").val(nom_fiche);
        $("#edit-fiche-modal").find("textarea[name='description']").val(description);
        $("#edit-fiche-modal").find("input[name='id_desc']").val(id_desc);
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: url + 'categories/search',
            data:{id:id_categorie}
        }).done(function(data){
            console.log(data);
            $.each( data.categories, function( key, value ) {
                if (value.id==id_categorie){
                    option = option + '<option value="'+value.id+'" selected>'+value.nom_categorie+'</option>';
                }else {
                    option = option + '<option value="'+value.id+'">'+value.nom_categorie+'</option>';
                }
            });
            $("select#id_categorie").html(option);
            $("#edit-fiche-modal").find("select[name='id_categorie']").val(id_categorie);
        });


    });
    /* Updated new Item */

    $(".crud-submit-edit").click(function(e){
        e.preventDefault();
        var form_action = $("#edit-fiche-modal").find("form").attr("action");
        var id = $("#edit-fiche-modal").find("input[name='id']").val();
        var nom_fiche = $("#edit-fiche-modal").find("input[name='nom_fiche']").val();
        var description = $("#edit-fiche-modal").find("textarea[name='description']").val();
        var id_desc = $("#edit-fiche-modal").find("input[name='id_desc']").val();
        var id_categorie = $("#edit-fiche-modal").find("select[name='id_categorie']").val();

        if(nom_fiche != '' && description != ''  && id_categorie != ''){
            $.ajax({
                dataType: 'json',
                type:'POST',
                url: url + form_action,
                data:{id:id, nom_fiche:nom_fiche, description:description, id_categorie:id_categorie,id_desc:id_desc}
            }).done(function(data){
                $("#edit-fiche-modal").find("input[name='nom_fiche']").val();
                $("#edit-fiche-modal").find("textarea[name='description']").val();
                $("#edit-fiche-modal").find("select[name='id_categorie']").val();
                $("#edit-fiche-modal").toggle();
                $("#edit-fiche-modal").close();
                console.log($("#edit-fiche-modal").find("input[name='nom_fiche']").val());
            });
            listFiche();
            $("#edit-fiche-modal").hide();
            $("#edit-fiche-modal").close();
        }else{

            alert('Completez le nom fiche et/ou description.')

        }
    });

});