$( document ).ready(function() {

    var page = 1;

    var current_page = 1;

    var total_page = 0;

    var is_ajax_fire = 0;

    /* Create new Item */

    $(".crud-submit-category").click(function(e){

        e.preventDefault();
        var form_action = $("#createModalCategory").find("form").attr("action");
        var nom_categorie = $("#createModalCategory").find("input[name='nom_fiche']").val();

        if(nom_categorie != ''){
            $.ajax({
                dataType: 'json',
                type:'POST',
                url: url + form_action,
                data:{nom_categorie:nom_categorie}
            }).done(function(data){
                $("#add-category-form").find("input[name='nom_categorie']").val();
                listFiche();
                $(".modal").hide();
                $("#add-category-form").hide();
            });
        }else{

            alert('Completez le nom category et/ou description.')

        }



    });
    //Remove
    $("body").on("click",".remove-itemgggg1",function(){
        var id = $(this).parent("td").data('id');

        var c_obj = $(this).parents("tr");
        //confirm(['Vous avez supprimé le '+id,"OK"]);
        $.ajax({

            dataType: 'json',

            type:'POST',

            url: url + 'categories/remove/'+id,

            data:{id:id}

        }).done(function(data){

            c_obj.remove();

            // toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});

            listFiche();

        });

    });
    //Edit
    $("body").on("click",".edit-category-form",function(){

        var id = $(this).parent("td").data('id');
        var nom_fiche = $(this).parent("td").prev("td").prev("td").text();
        var description = $(this).parent("td").prev("td").text();
        var id_categorie = $(this).parent("td").prev("td").find("input[name='id_categorie']").val();
        var id_desc = $(this).parent("td").prev("td").find("input[name='id_desc']").val();
        var option = '';
        console.log(id_desc);
        console.log(id+'====='+nom_fiche+'====='+description+'====='+id_categorie+'=====');
        $("#edit-category-modal").find("input[name='id']").val(id);
        $("#edit-category-modal").find("input[name='nom_fiche']").val(nom_fiche);
        $("#edit-category-modal").find("textarea[name='description']").val(description);
        $("#edit-category-modal").find("input[name='id_desc']").val(id_desc);
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
            $("#edit-category-modal").find("select[name='id_categorie']").val(id_categorie);
        });


    });
    /* Updated new Item */

    $(".crud-submit-edit").click(function(e){
        e.preventDefault();
        var form_action = $("#edit-category-modal").find("form").attr("action");
        var id = $("#edit-category-modal").find("input[name='id']").val();
        var nom_fiche = $("#edit-category-modal").find("input[name='nom_fiche']").val();
        var description = $("#edit-category-modal").find("textarea[name='description']").val();
        var id_desc = $("#edit-category-modal").find("input[name='id_desc']").val();
        var id_categorie = $("#edit-category-modal").find("select[name='id_categorie']").val();

        if(nom_fiche != '' && description != ''  && id_categorie != ''){
            $.ajax({
                dataType: 'json',
                type:'POST',
                url: url + form_action,
                data:{id:id, nom_fiche:nom_fiche, description:description, id_categorie:id_categorie,id_desc:id_desc}
            }).done(function(data){
                $("#edit-category-modal").find("input[name='nom_fiche']").val();
                $("#edit-category-modal").find("textarea[name='description']").val();
                $("#edit-category-modal").find("select[name='id_categorie']").val();
                $("#edit-category-modal").toggle();
            });
        }else{

            alert('Completez le nom category et/ou description.')

        }
    });
    if ($("body").find("table[id='category']")){
        listCategory();
    }
    /* Category data list */
    function listCategory() {
        $.ajax({
            dataType: 'json',
            url: url+'categories/search'
        }).done(function(data){
            console.log(data.descriptions);
            categoryRow(data);
        });
    }
    $("body").on("keyup","#search",function(){
        var search = $(this).val();
        $.ajax({
            dataType: 'json',
            method:'POST',
            url: url+'categories/search',
            data:{search:search}
        }).done(function(data){
            console.log(data);
            categoryRow(data);
        });
    });
    function categoryRow(data) {
        var categories = data.categories;
        var descriptions = data.descriptions;
        console.log(categories);
        var	rows = '';
        if (categories.length == 0){
            rows = rows + '<tr align="right"><td style="border: none"></td><td style="border: none"><label>Aucune donne</label></td><td style="border: none"></td><td style="border: none"></td></tr>';
        }else {
            $.each( categories, function( key, value ) {
                console.log(value);
                rows = rows + '<tr>';
                rows = rows + '<td>'+value.id+'</td>';
                rows = rows + '<td>'+value.nom_categorie+'</td>';
                if(descriptions.length > 0){
                    rows = rows + '<td>';
                    $.each( descriptions, function( key1, value1 ) {
                        if (value.id==value1.id_categorie){
                            rows = rows + value1.nb;
                        }
                    });
                    rows = rows +'</td>';
                }else{
                    rows = rows + '<td>0</td>';
                }
                rows = rows + '<td data-id="'+value.id+'">';
                rows = rows + '<button data-toggle="modal" data-target="#editModalCategory" class="btn btn-primary edit-category-form">Modifier</button> ';
                rows = rows + '<button class="btn btn-danger remove-item-category" data-toggle="modal" data-target="#confirmModal'+value.id+'">Supprimer</button>';
                rows = rows + '</td>';
                rows = rows + '</tr>';

            });
        }

        $("table#category tbody").html(rows);

    }

});