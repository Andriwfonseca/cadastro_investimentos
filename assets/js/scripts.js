function editarParticipar(id_usuario, id_investimento, id_admin){
      
    $.ajax({
        url: '../Action/editar_participar.php',
        method: 'POST',
        data: {"id": id_usuario, "id_investimento": id_investimento, "id_admin": id_admin },
        success: function(data) {            
            location.reload();
        }, 
        error: function(data){
             console.log(data); 
        }
    });
}

function mostrarModal(id){
    $.ajax({
        url: '../Action/listar_participantes.php',
        method: 'POST',
        data: {"id_investimento": id },
        success: function(data) {
            console.log(JSON.parse(data));
            const dados = JSON.parse(data);
            const lista = document.querySelector('#lista-participantes');
            dados.map((item, key) =>{
                lista.innerHTML += `<li key="${key}">${item.nome}</li>`;
            
            });
            //location.reload();
        }, 
        error: function(data){
             console.log(data); 
        }
    });

    const modal = document.querySelector('#modal-participantes');    
    modal.classList.remove('hide');
}
function esconderModal(){
    const modal = document.querySelector('#modal-participantes'); 
    const lista = document.querySelector('#lista-participantes');
    lista.innerHTML = "";
    modal.classList.add('hide');
}