function ValidateFieldsQuestionJS(eposta, galdera, e_zuzena, e_okerra1, e_okerra2, e_okerra3, zailtasuna, arloa) {


    if (eposta.value.trim() === "" || galdera.value.trim() === "" || e_zuzena.value.trim() === "" || e_okerra1.value.trim() === "" || e_okerra2.value.trim() === ""
        || e_okerra3.value.trim() === "" || zailtasuna.value == "" || arloa.value.trim() === "") {

        alert("Bete derrigorrezkoak diren eremuak (*)")
        return false

    }

    var emailRE = /^[a-zA-Z]+([0-9]{3}@ikasle\.ehu|(\.[a-zA-Z]+){0,1}[a-zA-Z]+@ehu)\.(eus|es)$/


    if (!emailRE.test(eposta.value)) {

        alert("Eposta okerra")
        return false

    }

    alert(zailtasuna.value)


    if (galdera.value.length < 10) {
        alert("Galdera motzegia (10 karaktere baina gutxiago)")
        return false

    }

    return true
}