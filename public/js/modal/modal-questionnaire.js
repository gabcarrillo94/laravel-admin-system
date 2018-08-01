function beforeModalQuestionnaire(name, qtr, sex) {
    $("#exampleModalLabel").html(name);
    
    if (qtr===undefined) {
        $(".modal-body").html('<legend style="font-size: 1.5em;margin-bottom: 10px;">El cliente aún no completa el cuestionario</legend>')
    }
    else {
        let html = '<legend style="font-size: 1.5em;margin-bottom: 10px;">Cuestionario</legend>' +
            '<div class="row">' +
                '<div class="col-md-12">' +
                    '<strong>¿Cómo te describes a ti mismo(a)? Escribe una breve reseña.</strong> ' +
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_1 +
                '</div>' +
                '<div class="col-md-12">' +
                    '<strong>¿Tienes algún objetivo en específico el cual te gustaría llegar?</strong> ' + 
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_2 +
                '</div>' +
                '<div class="col-md-12">' +
                    '<strong>¿Cuál de estos objetivos es más importante para ti a nivel personal? Usa un puntaje del 1 al 10 para cada una en orden de importancia para ti. </strong> ' + 
                '</div>' +
                '<div class="col-md-12">' +
                    '<p>Mejorar tu salud ' + qtr.qst_3_1 + '</p>' +
                    '<p>Mejorar tu resistencia ' + qtr.qst_3_2 + '</p>' +
                    '<p>Incrementar masa muscular ' + qtr.qst_3_3 + '</p>' +
                    '<p>Perder grasa ' + qtr.qst_3_4 + '</p>' +
                    '<p>Aumentar de peso ' + qtr.qst_3_5 + '</p>' +
                    '<p>Incrementar fuerza ' + qtr.qst_3_6 + '</p>' +
                '</div>' +
            '</div>' +
            '<div class="row">' +
                '<div class="col-md-12">' +
                    '<strong>Si tuvieras que escoger entre las siguientes 2 opciones, ¿Cual escogerías y por qué? </strong> ' +
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_4 +
                '</div>' +
                '<div class="col-md-12">' +
                    '<strong>Crees que hay algún tipo de impedimento que pueda separarte de lograr tu objetivo con el programa?</strong> ' + 
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_5 +
                '</div>' +
                '<div class="col-md-12">' +
                    '<strong>En caso de responder si a la pregunta anterior. ¿Qué crees que podemos hacer para superarlo?</strong> ' + 
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_6 +
                '</div>' +
            '</div>' +
            '<div class="row">' +
                '<div class="col-md-12">' +
                    '<strong>¿Cómo describirías tus hábitos alimenticios?</strong> ' +
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_7 +
                '</div>' +
                '<div class="col-md-12">' +
                    '<strong>¿Sufres de ansiedad por comida y/o atracones frecuentemente?</strong> ' + 
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_8 +
                '</div>' +
                '<div class="col-md-12">' +
                    '<strong> ¿A que te dedicas? ¿Cómo es tu horario de trabajo?</strong> ' + 
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_9 +
                '</div>' +
            '</div>' +
            '<div class="row">' +
                '<div class="col-md-12">' +
                    '<strong>¿Crees que tu familia, amigos, esposo, hijos, colegas te apoyarán en el proceso de mejorar tus hábitos alimenticios? </strong> ' +
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_10 +
                '</div>' +
                '<div class="col-md-12">' +
                    '<strong>¿Estás tomando algún tipo de medicamento actualmente? </strong> ' + 
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_11 +
                '</div>' +
                '<div class="col-md-12">' +
                    '<strong>¿Eres alérgico(a) algún tipo de alimento? </strong> ' + 
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_12 +
                '</div>' +
            '</div>' +
            '<div class="row">' +
                '<div class="col-md-12">' +
                    '<strong>¿Actualmente consumes algún tipo de suplemento?</strong> ' +
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_13 +
                '</div>' +
                '<div class="col-md-12">' +
                    '<strong>¿Cuántas horas de sueño tienes normalmente? </strong> ' + 
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_14 +
                '</div>' +
                '<div class="col-md-12">' +
                    '<strong>Cuantos días a la semana te ejercitas y a que hora del día?</strong> ' + 
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_15 +
                '</div>' +
            '</div>' +
            '<div class="row">' +
                '<div class="col-md-12">' +
                    '<strong>Cuanto tiempo dura tu entrenamiento? Y que tipo de ejercicios realizas? </strong> ' +
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_16 +
                '</div>';
            
        if (sex==='F') {
            html= html + '<div class="col-md-12">' +
                    '<strong>¿Qué día tendrás siguiente período?</strong> ' + 
                '</div>' +
                '<div class="col-md-12">' +
                    qtr.qst_17 +
                '</div>' +
            '</div>';
        }
        else {
            html = html + '</div>';
        }
        
        $(".modal-body").html(html);
    }
}