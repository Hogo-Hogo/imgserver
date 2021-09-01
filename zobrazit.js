function zobrazit(obr) {
    if (obr.files && obr.files[0]) {
        var ctecka = new FileReader();
        ctecka.onload = function (e) {
            var obrazek = document.querySelector("#nahrany-img");
            obrazek.src = e.target.result;
            obrazek.style.display = "inline";
        };
        ctecka.readAsDataURL(obr.files[0]);
    }
}
