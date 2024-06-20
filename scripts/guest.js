const DOMItems = {
    cardContainer: document.getElementById("card-container")
}

const getCookie = (cookieName) => {
    let nameEq = cookieName + "="
    let ca = document.cookie.split(";")

    for(let i = 0; i < ca.length; i++) {
        let c = ca[i]

        while(c.charAt(0) == ' ') {
            c = c.substring(1, c.length)
        }

        if(c.indexOf(nameEq) == 0) {
            return c.substring(nameEq.length, c.length)
        }
    }

    return null
}

const createListElement = (data) => {
    const mainLi = document.createElement('li')
    mainLi.className = 'bg-[#e9e9e9] w-[25%] min-w-[150px] 2xl:min-w-[420px] h-[100%] flex justify-center flex-col items-center rounded-md shadow-md'

    const headerDiv = document.createElement('div')
    headerDiv.className = 'w-full bg-[#202125] h-[13%] rounded-t-md flex justify-center items-center'
    mainLi.appendChild(headerDiv)

    const input = document.createElement('input')
    input.type = 'text'
    input.className = 'text-center font-light font-sans text-[#ffffff] text-xl 2xl:text-2xl transition-all duration-500 bg-transparent border-b-[1px] outline-none w-[40%] hover:w-[55%]'
    input.placeholder = 'Carta'
    input.value = data.name;
    headerDiv.appendChild(input)

    const ul = document.createElement('ul')
    ul.className = 'my-4 w-full list-none h-[100%] gap-4 flex flex-col items-center overflow-y-scroll'
    mainLi.appendChild(ul)

    const createCard = (d) => {
        const firstLi = document.createElement('li')
        firstLi.className = 'bg-transparent w-[86%] min-h-[130px] rounded-xl overflow-auto flex justify-start items-start flex-col'
        ul.appendChild(firstLi)
    
        const textarea = document.createElement('textarea')
        textarea.placeholder = "Escribe el contenido de la carta aquí..."
        textarea.className = 'w-[100%] h-[100%] px-2 resize-y overflow-hidden outline-none font-thin rounded-xl text-[#242424]'
        firstLi.appendChild(textarea)

        if(d.titulo.length > 1) {
            textarea.value = d.titulo
        }
    }

    data.cards.forEach((current) => {
        console.log(current)
        createCard(current)
    })

    return mainLi
}

const renderTables = (data) => {
    data.forEach((current) => {
        const newList = createListElement({
            name: current.nombre,
            id: current.id,
            cards: current.tarjetas
        })

        DOMItems.cardContainer.appendChild(newList)
    })
}

const getData = async () => {
    const searchParams = new URLSearchParams(window.location.search)

    const response = await fetch(`../api/get_data.php?id_tablero=${atob(searchParams.get("share"))}`, {
        method: "GET"
    })

    if (!response.ok) {
        throw new Error("Error trying to send request: " + response.statusText);
    }

    return await response.json()
}

document.addEventListener("DOMContentLoaded", async () => {
    const data = await getData()
    renderTables(data)
})