var vid = document.getElementById("myVideo");
var pregunta = document.getElementById("pregunta");
var label1 = document.getElementById("label1");
var label2 = document.getElementById("label2");
var label3 = document.getElementById("label3");
var enunciat = document.getElementById("enunciat");
var opcio1 = document.getElementById("opcio1");
var opcio2 = document.getElementById("opcio2");
var opcio3 = document.getElementById("opcio3");
var presentacio = document.getElementById("presentacio");
vid.ontimeupdate= function() {preguntas()};
var contador = 0;
var temps = 0;

function endavant()
{
    vid.play();
    presentacio.style.display="none";

}

function preguntas() {

  if(Math.floor(vid.currentTime)==33 &&  vid.currentTime<33.3 && contador==0)
  {

    vid.pause();
    pregunta.style.display = "block";
    contador++;


  }
  else if(Math.floor(vid.currentTime)==48 &&  vid.currentTime<48.3 && contador==1)
  {
    vid.pause();
    pregunta.style.display = "block";
    enunciat.innerHTML="Pregunta 2: Quantes compressions toraciques se li ha d'aplicar al pacient quan es te el primer contacte? ";
    label1.innerHTML = "60 a ritme de 100/minut";
    label2.innerHTML = "100 a ritme de 60/minut";
    label3.innerHTML = "30 a ritme de 100/minut";
    contador++;

  }
  else if(Math.floor(vid.currentTime)==60 &&  vid.currentTime<60.3 && contador==2)
  {
    vid.pause();
    pregunta.style.display = "block";
    enunciat.innerHTML="Pregunta 3: Despres de fer les primeres compression i abans d'aplicar el DESA hem de fer...";
    label1.innerHTML = "2 ventilacions i 30 compressions";
    label2.innerHTML = "4 ventilacions i 45 compressions";
    label3.innerHTML = "3 ventilacions i 30 compressions";
    contador++;
  }
  else if(Math.floor(vid.currentTime)==100 &&  vid.currentTime<100.3 && contador==3)
  {
    vid.pause();
    pregunta.style.display = "block";
    enunciat.innerHTML="Pregunta 4: Una vegada aplicat el DESA, quan anem a fer la descarrega, es molt important...";
    label1.innerHTML = "Tocar al pacient per comprovar si te pols";
    label2.innerHTML = "No tocar al pacient";
    label3.innerHTML = "Fer el massatge cardiovascular mentres s'aplica la descarrega";
    contador++;
  }
  else if(Math.floor(vid.currentTime)==180 &&  vid.currentTime<180.3 && contador==4)
  {
    vid.pause();
    pregunta.style.display = "block";
    enunciat.innerHTML="Pregunta 5: Si la primera descarrega no reanima al pacient, que hem de fer?";
    label1.innerHTML = "Aplicar un altre descarrega inmediatament";
    label2.innerHTML = "60 compressions a ritme de 100/minut i aplicar un altre descarrega";
    label3.innerHTML = "30 compressions i 2 ventilacions 3 vegades abans d'aplicar un altre decarrega";
    contador++;
  }
}

function validarPregunta()
{
    var validar = false;

    if(Math.floor(vid.currentTime)==33)
    {
        if(opcio1.checked)
        {
            pregunta.style.backgroundColor = "lightgreen";
            validar=true;
        }else
        {
            pregunta.style.backgroundColor = "lightcoral";
            validar = false;
            contador--;
            temps = 10;


        }
    }
    else if(Math.trunc(vid.currentTime)==48)
    {
        if(opcio3.checked)
        {
            validar = true;
        }else
        {
            contador--;
            pregunta.style.display="none";
            validar = false;
            temps = 33;

        }
    }else if(Math.trunc(vid.currentTime)==60)
    {
        if(opcio1.checked)
        {
            validar = true;
        }else
        {
            contador--;
            validar = false;
            temps = 49;
            vid.play();
        }
    }
    else if(Math.trunc(vid.currentTime)==100)
    {
        if(opcio2.checked)
        {
            validar = true;
        }else
        {
            contador--;
            validar = false;
            temps = 61;
            vid.play();
            pregunta.style.display="none";
        }
    }
    else if(Math.trunc(vid.currentTime)==180)
    {
        if(opcio3.checked)
        {
            validar = true;
        }else
        {
            contador--;
            validar = false;
            vid.currentTime = 101;
            vid.play();
            pregunta.style.display="none";
        }
    }
    return validar;
}

function reanudar()
{

    if(validarPregunta())
    {
        ErrorPregunta();
        opcio1.checked = false;
        opcio2.checked = false;
        opcio3.checked = false;
    }
    else
    {
        ErrorPregunta();
        opcio1.checked = false;
        opcio2.checked = false;
        opcio3.checked = false;
    }

    function ErrorPregunta() {
        setTimeout(function(){
            if(!(validar)){
            pregunta.style.display="none";
            pregunta.style.backgroundColor = "white";
            vid.currentTime = temps;
            vid.play();
            }
            else
            {
                vid.play();
                pregunta.style.display="none";
            }
        }, 3000);
      }
}

