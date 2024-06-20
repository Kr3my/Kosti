const DOMItems = {
    cardContainer: document.getElementById("card-container"),
    addListButton: document.getElementById("add-list-button"),
    shareLink: document.getElementById("share-link")
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

    input.addEventListener("blur", () => {
        fetch(`../api/update_list.php?id=${data.id}&content=${input.value}`)
    })

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
    
        const removeButton1 = document.createElement('button')
        removeButton1.className = 'top-2 right-2 text-[#ff5858] p-[6px] text-md transition-all duration-700'
        removeButton1.textContent = 'Remover carta'
        firstLi.appendChild(removeButton1)

        if(d.titulo.length > 1) {
            textarea.value = d.titulo
        }

        textarea.addEventListener("blur", () => {
            fetch(`../api/update_card.php?id=${d.id}&list=${data.id}&content=${textarea.value}`)
        })

        removeButton1.addEventListener("click", () => {
            fetch(`../api/remove_card.php?id=${d.id}&list=${data.id}`)
            .then(async (response) => {
                if(response.ok) {
                    DOMItems.cardContainer.innerHTML = ""
                    renderTables(await getData())
                }
            })
        })
    }

    data.cards.forEach((current) => {
        createCard(current)
    })

    const secondLi = document.createElement('li')
    secondLi.className = 'bg-[#202125] hover:w-[20%] transition-all duration-700 w-[15%] min-h-[30px] rounded-xl flex justify-center items-center text-center'
    ul.appendChild(secondLi)

    const addButton = document.createElement('button')
    addButton.className = 'text-3xl w-full h-full text-white hover:text-[#a8a8a8] font-thin text-center flex justify-center items-center transition-all duration-700 hover:rotate-12'
    addButton.textContent = '+'
    secondLi.appendChild(addButton)

    addButton.addEventListener("click", () => {
        const boardId = getCookie("board_id")

        fetch(`../api/add_card.php?tab=${boardId}&list=${data.id}`, {
            method: "GET",
        })
        .then(async (response) => {
            if(response.ok) {
                DOMItems.cardContainer.innerHTML = ""
                renderTables(await getData())
            }
        })
    })

    const thirdLi = document.createElement('li')
    thirdLi.className = 'bg-[#ff5858] rounded-xl'
    ul.appendChild(thirdLi)

    const removeButton2 = document.createElement('button')
    removeButton2.className = 'text-[#ffffff] hover:text-[#ff8f8f] p-[6px] text-xl hover:pl-[18px] hover:pr-[18px] transition-all duration-700'
    removeButton2.textContent = 'Remover Lista'
    thirdLi.appendChild(removeButton2)
    
    removeButton2.addEventListener("click", () => {
        const boardId = getCookie("board_id")

        fetch(`../api/remove_list.php?tab=${boardId}&list=${data.id}`, {
            method: "GET",
        })
        .then(async (response) => {
            if(response.ok) {
                DOMItems.cardContainer.innerHTML = ""
                renderTables(await getData())
            }
        })
    })

    return mainLi
}

const renderTables = (data) => {
    data.forEach((current) => {
        console.log(current)
        const newList = createListElement({
            name: current.nombre,
            id: current.id,
            cards: current.tarjetas
        })

        DOMItems.cardContainer.appendChild(newList)
    })
}

const getData = async () => {
    const boardId = getCookie("board_id")
    const response = await fetch(`../api/get_data.php?id_tablero=${boardId}`, {
        method: "GET"
    })

    if (!response.ok) {
        throw new Error("Error trying to send request: " + response.statusText);
    }

    return await response.json()
}

const createList = () => {
    const boardId = getCookie("board_id")

    fetch(`../api/create_list.php?tab=${boardId}`, {
        method: "GET"
    })
    .then(response => response.json())
    .then(async (data) => {
        console.log(data)
        DOMItems.cardContainer.innerHTML = ""

        renderTables(await getData())
    })
    .catch((exception) => {
        console.log(exception)
    })
}

document.addEventListener("DOMContentLoaded", async () => {
    const data = await getData()
    renderTables(data)

    DOMItems.addListButton.addEventListener("click", () => {
        createList()
    })

    DOMItems.shareLink.addEventListener("click", () => {
        navigator.clipboard.writeText(window.location.href + "?share=" + btoa(getCookie("board_id"))).then(() => {
            console.log("clipped")
        })
    })
})