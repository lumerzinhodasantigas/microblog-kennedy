'use strict';

/* Selecionando todos os links de Excluir */

const links = document.querySelectorAll('.excluir');
console.log(links);

for(const link of links){
    link.addEventListener("click", function(event){
        //Anular o comportamento padrão do evento
        event.preventDefault();
        
        let resposta = confirm("Deseja realmente excluir este registro?");

        /* Se a resposta for TRUE */
        if(resposta){
            // Redicerionamos para o endereço (href) do link
            location.href = link.href;
        }
    });
}