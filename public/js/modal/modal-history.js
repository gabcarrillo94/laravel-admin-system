function beforeModalHistory(name, data, token, id) {
    $("#exampleModalLabel").html(name);
    
    if (data===undefined) {
        $(".modal-body").html('<legend style="font-size: 1.5em;margin-bottom: 10px;">El cliente aún no registra sus medidas</legend>')
    }
    else {
        let html = "<div class='table-responsive' style='margin-bottom: 15px;overflow-x: auto;overflow-y: hidden;-webkit-overflow-scrolling: touch;-ms-overflow-style: -ms-autohiding-scrollbar;border: .6px solid #ddd;'>" +
					"<table class='table table-striped table-bordered table-hover' id='dataTables-example'>" +
						"<thead>" +
							"<tr>" +
								"<th style='text-align:center'>Fecha</th>" +
								"<th style='text-align:center'>Jackson/Pollock 7</th>" +
								"<th style='text-align:center'>Parrillo Caliper</th>" +
								"<th style='text-align:center'>Navy Tape Measure</th>" +
                                "<th style='text-align:center'>Acciones</th>" +
							"</tr>" +
						"</thead>" +
						"<tbody>";
        
        for (i in data) {
            html = html + "<tr style='cursor:pointer'>" +
                    "<td>" + data[i].calculation_date + "</td>" +
                    "<td>" + ((data[i].jp7!==null) ? data[i].jp7 : "NC") + "</td>" +
                    "<td>" + ((data[i].pcm!==null) ? data[i].pcm : "NC") + "</td>" +
                    "<td>" + ((data[i].ntm!==null) ? data[i].ntm : "NC") + "</td>" +
                    "<td>" +
                        "<form method='POST' name='formSearch' action='search'>" +
                            "<input type='hidden' id='dateSearch' name='dateSearch' value='" + data[i].calculation_date + "'>" +
                            "<input type='hidden' name='_token' value='" + token + "'>" +
                            "<input type='hidden' name='user_id' value='" + id + "'>" +
                            "<button class='btn btn-info'>" +
                                "Ver" +
                            "</button>" +
                        "</form>" +
                    "</td>" +
                    "</tr>";
        }
        
        html = html + "</tbody></table></div>";
        
        $(".modal-body").html(html);
    }
}