$.getJSON("http://www.geoplugin.net/json.gp",
function (data) {
	for (var i in data) {
		if (i == "geoplugin_city"){
            $("#visitorCity").html(data[i]+"-tik ari zara bisitatzen web orria")
        }
        else if (i == "geoplugin_latitude"){
            $("#visitorLat").html("Latitudea: "+data[i])
        }
        else if (i == "geoplugin_longitude"){
            $("#visitorLong").html("Longitudea: "+data[i])
        }
	}
});