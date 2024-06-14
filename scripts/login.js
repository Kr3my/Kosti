const validateUser = (user, password, callback) => {
    fetch(`/Kosti/api/validate_user.php?user=${user}&pwd=${password}`, {
        method: "GET"
    })
    .then((response) => {
        return response.json()
    })
    .then((data) => {
        callback(true)
    })
    .catch((err) => {
        callback(false)
    })
}

console.log(validateUser("hola", "mundo", (state) => {
    console.log(state)
}))