function editarParticipar(id_usuario, id_investimento, id_admin){
      console.log(id_usuario)
    $.ajax({
        url: '../Action/editar_participar.php',
        method: 'POST',
        data: {"id": id_usuario, "id_investimento": id_investimento, "id_admin": id_admin },
        success: function(data) {
            console.log(data)
            location.reload();
        }, 
        error: function(data){
             console.log(data); 
        }
    });
}

function listarParticipantes(id){

}