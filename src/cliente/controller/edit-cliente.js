$(document).ready(function(){

    $('#table-cliente').on('click', 'button.btn-edit', function(e){
        e.preventDefault()
    
        $('.modal-title').empty()
        $('.modal-body').empty()
    
        $('.modal-title').append("Edição de registro");
    
        let ID =`ID=${$(this).attr('id')}`
    
        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: ID,
            url: 'src/cliente/model/view-cliente.php',
            success: function(dado) {
                if (dado.tipo == "success") {
                    $('.modal-body').load('src/cliente/view/form-cliente.html', function() {
                    $('#NOME').val(dado.dados.NOME)                  
                    $('#RG').val(dado.dados.RG)                   
                    $('#CPF').val(dado.dados.CPF)                   
                    $('#CEP').val(dado.dados.CEP)                   
                    $('#LOGRADOURO').val(dado.dados.LOGRADOURO)                   
                    $('#NUMERO').val(dado.dados.NUMERO)                                    
                    $('#CIDADE').val(dado.dados.CIDADE)                  
                    $('#UF').val(dado.dados.UF)
                    $('#EMAIL').val(dado.dados.EMAIL)
                    $('#BAIRRO').val(dado.dados.BAIRRO)                  
                    $('#CELULAR').val(dado.dados.CELULAR)
                    $('#ID').val(dado.dados.ID)
                    })
                    
                    $('#modal-cliente').modal('show')
                    $('.btn-save').removeAttr('data-operation', 'insert')
                    $('.btn-save').show()
                } else {
                    Swal.fire({ // Inicialização do SweetAlert
                        title: 'Sistema Para Gerenciamento de Cantina', // Título da janela SweetAler
                        text: dado.mensagem, // Mensagem retornada do microserviço
                        type: dado.tipo, // Tipo de retorno [success, info ou error]
                        confirmButtonText: 'OK'
                    })
                }
            }
        })
    
    
    })
    
    })