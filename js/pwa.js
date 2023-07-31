if ("serviceWorker" in navigator) {
    navigator.serviceWorker
        .register("./serv-worker.js")
        .then(function(reg) {
            console.log("successfully registered", reg);
        })
        .catch(function(err) {
            console.log(err);
        });
}