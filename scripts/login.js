const validateUser = (user, password, callback) => {
    fetch(`/Kosti/api/validate_user.php?user=${user}&pwd=${password}`, {
        method: "GET"
    })
    .then((response) => {
        return response.json()
    })
    .then((data) => {
        if(data["success"] == true) {
            callback(true)
            return
        }

        callback(false)
    })
    .catch((err) => {
        callback(false)
    })
}

document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("main-btn")
    const indicator = document.getElementById("indicator")

    btn.addEventListener("click", (ev) => {
        ev.preventDefault()
        validateUser(document.getElementById("username").value, document.getElementById("password").value, (state) => {
            if(state) {
                window.location.href = "../api/start_session.php?user=" + document.getElementById("username").value
            } else {
                indicator.style.display = "block"
            }
        })
    })
})
