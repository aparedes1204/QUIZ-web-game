$.getJSON("https://api.freegeoip.app/json/?apikey=c656e670-4196-11ec-9bff-c741f5d19ced",
function (data) {
	for (var i in data) {
		if (i == "city"){
            $("#visitorCity").html(data[i]+"-tik ari zara bisitatzen web orria")
        }
        else if (i == "latitude"){
            $("#visitorLat").html("Latitudea: "+data[i])
        }
        else if (i == "longitude"){
            $("#visitorLong").html("Longitudea: "+data[i])
        }
	}
});