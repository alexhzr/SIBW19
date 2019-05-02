var palabrotas = ["puta", "gilipollas", "maricon", "polla", "chupapollas", "chapero", "comemierdas", "subnormal", "capullo", "cabron"];

window.onload = function () {
    document.getElementById('mensaje').addEventListener('keyup', listenerPalabrotas);
}

function ParaComentarios() {
    var x = document.getElementById("comentarios");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function HoraActual(){
    /*21/03/2054 18:17*/
    var fecha = new Date();
    var final = fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear()+"   "+fecha.getHours()+":"+fecha.getMinutes();
    return String(final);
}

function MuestroComentario(){
    var nombre = document.getElementById('nombre').value;
    var email = document.getElementById('email').value;
    var mensaje = document.getElementById('mensaje').value;
    var emailRegexp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;


    if ((nombre != "") && (email.match(emailRegexp)) && (mensaje != "")) {
      document.getElementById("nombre_nuevo").innerHTML = nombre;
      document.getElementById("fecha_nueva").innerHTML = HoraActual();
      document.getElementById("mensaje_nuevo").innerHTML = mensaje;
      var ver_nuevo = document.getElementById("nuevo_comentario");
      if (ver_nuevo.style.display === "none") {
          ver_nuevo.style.display = "block";
      }
    } else {
      alert("Por favor, asegúrese de que todos los campos del comentario son correctos.");
    }
}

function listenerPalabrotas() {
    var comentario = document.getElementById('mensaje').value;
    var palabrasComentario = comentario.split(" ");
    console.log(palabrasComentario);

    for(id in palabrasComentario){
      console.log(id);
        var position = palabrotas.indexOf(palabrasComentario[id]);
        if(palabrotas.indexOf(palabrasComentario[id]) != -1){
            comentario = comentario.replace(palabrotas[position], ''.padStart(palabrotas[position].length, "*"))
        }
    }

    document.getElementById('mensaje').value = comentario;
}
