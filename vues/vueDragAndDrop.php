<?php
?>
<html><head>
    <meta charset="utf-8">
    <title></title>

    <style>
        .rowPerso{
            display: flex;
            flex-direction: row;
            justify-content: center;
            heigth-min: 100%;
        }
        .dropper{
            display: flex;
            flex-direction: column;
            justify-content: center;
            heigth: 100vh;
            width: 88vw;
            margin-left: 20vw;
            border: solid blue;
        }
        .Selection{
            position: fixed;
            top:0;
            left:0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            heigth: 100vh;
            width: 18vw;
            margin-rigth: 2vw;
            border: solid blue;
        }
        iframe{
            heigth: 25vh;
            width: 60vw;
            margin-rigth: 2vw;
            margin-left: 2vw;
        }
    </style>
</head>

<body>

<div class="rowPerso">

    <div class="Selection">
        <div class="draggable" draggable="true">QCM</div>
        <div class="draggable" draggable="true">QCU</div>
    </div>

    <div class="dropper">
    </div>

​</div>
<script>
    var idIframe = 0;
    (function() {

        var dndHandler = {

            draggedElement: null, // Propriété pointant vers l'élément en cours de déplacement

            applyDragEvents: function(element) {

                element.draggable = true;

                var dndHandler = this; // Cette variable est nécessaire pour que l'événement "dragstart" ci-dessous accède facilement au namespace "dndHandler"

                element.addEventListener('dragstart', function(e) {
                    dndHandler.draggedElement = e.target; // On sauvegarde l'élément en cours de déplacement
                    e.dataTransfer.setData('text/plain', ''); // Nécessaire pour Firefox
                }, false);

            },

            applyDropEvents: function(dropper) {

                dropper.addEventListener('dragover', function(e) {
                    e.preventDefault(); // On autorise le drop d'éléments
                }, false);

                dropper.addEventListener('dragleave', function() {
                    //lorsque l'élément quitte la zone de drop
                });

                var dndHandler = this; // Cette variable est nécessaire pour que l'événement "drop" ci-dessous accède facilement au namespace "dndHandler"

                dropper.addEventListener('drop', function(e) {

                    var target = e.target,
                        draggedElement = dndHandler.draggedElement, // Récupération de l'élément concerné
                        clonedElement = draggedElement.cloneNode(true); // On créé immédiatement le clone de cet élément

                    while(target.className.indexOf('dropper') == -1) { // Cette boucle permet de remonter jusqu'à la zone de drop parente
                        target = target.parentNode;
                    }

                    target.className = 'dropper'; // Application du design par défaut

                    clonedElement = target.appendChild(clonedElement); // Ajout de l'élément cloné à la zone de drop actuelle
                    clonedElement.id = idIframe;
                    AjouterQuestion(idIframe)
                    idIframe = idIframe + 1;
                    dndHandler.applyDragEvents(clonedElement); // Nouvelle application des événements qui ont été perdus lors du cloneNode()

                    if (target == draggedElement.parentNode){
                        draggedElement.parentNode.removeChild(draggedElement);
                    }

                });

            }

        };

        var elements = document.querySelectorAll('.draggable'),
            elementsLen = elements.length;

        for(var i = 0 ; i < elementsLen ; i++) {
            dndHandler.applyDragEvents(elements[i]); // Application des paramètres nécessaires aux élément déplaçables
        }

        var droppers = document.querySelectorAll('.dropper'),
            droppersLen = droppers.length;

        for(var i = 0 ; i < droppersLen ; i++) {
            dndHandler.applyDropEvents(droppers[i]); // Application des événements nécessaires aux zones de drop
        }

    })();

    function AjouterQuestion(idIframe) {
        divdropper = document.getElementById(idIframe);
        if (divdropper.innerHTML == "QCM"){
            typeQuestion = "1";
        }
        else{
            typeQuestion = "0";
        }
        divdropper.innerHTML="";
        const iframe = document.createElement('iframe');
        iframe.src = './Composant_form/FormQestion.php?estQCM='+typeQuestion;
        divdropper.appendChild(iframe);


    }

</script>


</body></html>
