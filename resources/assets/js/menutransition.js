function likeButton(product_id){
    var id = product_id.substring(8,product_id.length);

    if($('#btnLikes' + id).hasClass('hasLike')){
        //DELETE LIKE RELATION
        $('#btnLikes' + id).removeClass('hasLike');
        $('#spanLikes' + id).removeClass('badge-success').addClass('badge-primary');
        $('#numLikes' + id).text( Number($('#spanLikes' + id).text()) - 1 );

        var url = 'deleteLike';
        axios.post(url, {
            'product_id' : id,
        }).then(response => {
            menuVue.initializeProducts();
            toastr.info('¡Ya no te gusta el producto!', 'Información', {
            positionClass: "toast-top-left"
            });
        });
    }else{
        //ADD LIKE RELATION
        $('#btnLikes' + id).addClass('hasLike');
        $('#spanLikes' + id).removeClass('badge-primary').addClass('badge-success');
        $('#numLikes' + id).text( Number($('#spanLikes' + id).text()) + 1 );

        var url = 'addLike';
        axios.post(url, {
            'product_id' : id,
        }).then(response => {
            menuVue.initializeProducts();
            toastr.info('¡Te gusta un nuevo producto!', 'Información', {
            positionClass: "toast-top-left"
            });
        });
    }
}