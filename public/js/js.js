function horariosDisponibles(NumConsulta)
{
    var fecha=document.getElementById('fecha').value;
    var selectHora=document.getElementById('hora');
    if(NumConsulta!=1)
        selectHora.innerHTML='';
    //alert(fecha);
   fetch('./../HorariosLibres/'+fecha)
  //fetch('https://pokeapi.co/api/v2/pokemon/ditto')
    // Exito
        .then(res => res.json())  // convertir a json
        .then(resp =>{
            console.log(resp);
            for (let i in resp) 
            {
                for (let j in resp[i]) {
                    var option = document.createElement('option');
                    option.value = resp[i].hora;
                    option.text = resp[i].hora+':00:00';
                    selectHora.appendChild(option);
                }
            }
        })  // convertir a json
        .catch(err => console.log('Solicitud fallida', err)); // Capturar errores
}
document.addEventListener("DOMContentLoaded",function(e){
    let nav=document.querySelector("nav");
    let altura=nav.offsetTop;
    window.addEventListener("scroll", function(){
        alert(altura);
        console.log(altura);
        if(window.scrollY > altura)
        {
            nav.classList.remove("nav-top");
            nav.classList.add("nav-fixed");
        }
        else{
            nav.classList.remove("nav-fixed");
            nav.classList.add("nav-top");
        }
    });
});