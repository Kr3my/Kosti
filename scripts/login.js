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
    const btn = document.getElementById("submit")

    btn.addEventListener("click", (ev) => {
        ev.preventDefault()
        validateUser(document.getElementById("username").value, document.getElementById("password").value, (state) => {
            
        })
    })
})
