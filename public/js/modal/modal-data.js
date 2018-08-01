function beforeModalData(name, data) {
    $("#exampleModalLabel").html(name);
    
    if (data===undefined) {
        $(".modal-body").html('<legend style="font-size: 1.5em;margin-bottom: 10px;">El cliente aún no registra sus medidas</legend>')
    }
    else {
        let ms = "";
        
        if (data.metric_system==="IS")
            ms = "(Kg/Cm)";
        else
            ms = "(Lb/Inch)";
        
        $(".modal-body").html(
            '<legend style="font-size: 1.5em;margin-bottom: 10px;">Mediciones ' + ms + '</legend>' +
            '<div class="row">' +
                '<div class="col-md-2">' +
                    '<strong>Chest</strong> ' +
                '</div>' +
                '<div class="col-md-2">' +
                    data.chest +
                '</div>' +
                '<div class="col-md-2">' +
                    '<strong>Abdominal</strong> ' + 
                '</div>' +
                '<div class="col-md-2">' +
                    data.abdominal +
                '</div>' +
                '<div class="col-md-2">' +
                    '<strong>Bicep</strong> ' + 
                '</div>' +
                '<div class="col-md-2">' +
                    data.bicep +
                '</div>' +
            '</div>' +
            '<div class="row">' +
                '<div class="col-md-2">' +
                    '<strong>Calf</strong> ' +
                '</div>' +
                '<div class="col-md-2">' +
                    data.calf +
                '</div>' +
                '<div class="col-md-2">' +
                    '<strong>Hips</strong> ' + 
                '</div>' +
                '<div class="col-md-2">' +
                    data.hips +
                '</div>' +
                '<div class="col-md-2">' +
                    '<strong>Lower Back</strong> ' + 
                '</div>' +
                '<div class="col-md-2">' +
                    data.lower_back +
                '</div>' +
            '</div>' +
            '<div class="row">' +
                '<div class="col-md-2">' +
                    '<strong>Midaxillary</strong> ' +
                '</div>' +
                '<div class="col-md-2">' +
                    data.midaxillary +
                '</div>' +
                '<div class="col-md-2">' +
                    '<strong>Neck</strong> ' + 
                '</div>' +
                '<div class="col-md-2">' +
                    data.neck +
                '</div>' +
                '<div class="col-md-2">' +
                    '<strong>Subscapular</strong> ' + 
                '</div>' +
                '<div class="col-md-2">' +
                    data.subscapular +
                '</div>' +
            '</div>' +
            '<div class="row">' +
                '<div class="col-md-2">' +
                    '<strong>Suprailiac</strong> ' +
                '</div>' +
                '<div class="col-md-2">' +
                    data.suprailiac +
                '</div>' +
                '<div class="col-md-2">' +
                    '<strong>Thigh</strong> ' + 
                '</div>' +
                '<div class="col-md-2">' +
                    data.thigh +
                '</div>' +
                '<div class="col-md-2">' +
                    '<strong>Tricep</strong> ' + 
                '</div>' +
                '<div class="col-md-2">' +
                    data.tricep +
                '</div>' +
            '</div>' +
            '<div class="row">' +
                '<div class="col-md-2">' +
                    '<strong>Waist</strong> ' +
                '</div>' +
                '<div class="col-md-2">' +
                    data.waist +
                '</div>' +
                '<div class="col-md-2">' +
                    '<strong>Height</strong> ' + 
                '</div>' +
                '<div class="col-md-2">' +
                    data.height +
                '</div>' +
                '<div class="col-md-2">' +
                    '<strong>Bodyweight</strong> ' + 
                '</div>' +
                '<div class="col-md-2">' +
                    data.bodyweight +
                '</div>' +
            '</div>' +
            '<hr>' +
            '<div class="row">' +
                '<div class="col-md-4">' +
                    '<strong>Jackson/Pollock 7 Caliper Method</strong>' +
                '</div>' +
                '<div class="col-md-4">' +
                    '<strong>Parrillo Caliper Method</strong>' +
                '</div>' +
                '<div class="col-md-4">' +
                    '<strong>Navy Tape Measure Method</strong>' +
                '</div>' +
            '</div>' +
            '<div class="row">' +
                '<div class="col-md-4">' +
                    data.jp7 +
                '</div>' +
                '<div class="col-md-4">' +
                    data.pcm +
                '</div>' +
                '<div class="col-md-4">' +
                    data.ntm +
                '</div>' +
            '</div>'
        );
    }
}